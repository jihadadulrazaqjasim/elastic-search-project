<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

use Elasticsearch\ClientBuilder;
use Elasticsearch\Common\Exceptions\Missing404Exception;

class HomeController extends Controller
{
    protected static $client;

    public function __construct()
    {
        self::$client = ClientBuilder::create()
            ->setElasticCloudId('My_deployment:ZWFzdHVzMi5henVyZS5lbGFzdGljLWNsb3VkLmNvbTo5MjQzJDkzOTU1YWJlYTQ4OTQwZGU5Y2EzOWI0NTZmZTgzMWI5JDhmNzZjZDQ2MTY3YTQ3ZTk5ZTg4NGJiMDVjMDRhYTE1')
            ->setBasicAuthentication('elastic', 'j9CZ9UbIQcMVywO0ZO5f8z90')
            ->build();
    }

    public function index()
    {

        return view('home');
    }

    public function saveDocuments(Request $request)
    {
        $validatedData = $request->validate([
            'files' => 'required',
            'files.*' => 'mimes:csv,txt,xlx,xls,pdf'
        ]);

        if ($request->TotalFiles > 0) {
            for ($x = 0; $x < $request->TotalFiles; $x++) {
                if ($request->hasFile('files' . $x)) {
                    $file = $request->file('files' . $x);
                    $name = $file->getClientOriginalName();
                    $path = $file->storeAs('public/files', $name);
                    $params = [
                        'id' => 'attachment',
                        'body' => [
                            'description' => 'Extract attachment information',
                            'processors' => [
                                [
                                    'attachment' => [
                                        'field' => 'content',
                                        "properties" => ["content", "title"],
                                        'indexed_chars' => -1
                                    ]
                                ]
                            ]
                        ],
                        "settings"=> [],
                            "analysis"=> [
                              "analyzer"=> [
                                "custom_edge_ngram_analyzer"=> [
                                  "tokenizer"=> "custom_edge_ngram_tokenizer",
                                  "filter"=>["lowercase"]
                                ]
                              ],
                              "tokenizer"=> [
                                "custom_edge_ngram_tokenizer"=> [
                                  "type"=> "edge_ngram",
                                  "min_gram"=>1,
                                  "max_gram"=>100,
                                  "max_token_length"=> 5
                                ]
                              ]
                            ],
                          

                          "mappings"=>[
                              "properties"=>[
                                  "content"=>[
                                      "type" =>"text",
                                      "term_vector"=>"with_positions_offsets",
                                      "fields"=>[
                                          "ngrams"=>[
                                              "type"=>"text",
                                              "search_analyzer"=>"standard",
                                              "analyzer"=>"custom_edge_ngram_tokenizer",
                                              "term_vector"=>"with_positions_offsets"
                                          ]
                                      ]
                                  ]
                              ]
                          ],
                    ];
                    self::$client->ingest()->putPipeline($params);
                    $params = [
                        'index' => $name,
                        'type'  => 'attachment',
                        'id'    => '1',
                

                        'pipeline' => 'attachment',
                        'body'  => [
                            'content' => base64_encode(file_get_contents($file)),
                            'file_path' => $path
                        ]
                    ];
                    try {
                        self::$client->index($params);
                        return response()->json(['message' => 'document successfully saved, search now.']);
                    } catch (Missing404Exception $e) {
                        return response()->json(["message" => "Error while saving, " . $e]);
                    }
                }
            }
        } else {
            return response()->json(["message" => "No files"]);
        }
    }

    public function saveData(Request $request)
    {
        if ($request->has('fullname') && $request->has('school_name')) {
            $school_name = $request->school_name;
            $fullname = $request->fullname;
            $grade = $request->grade;

            $params = [
                'index' => $school_name,
                'body' => [
                    'student_name' => $fullname,
                    'student_grade' => $grade
                ]
            ];

            try {
                $result = self::$client->index($params);
                return json_encode(['message' => 'successfully saved'], 200);
            } catch (Missing404Exception $e) {
                return json_encode(['message' => 'failed: ' . $e], 404);
            }
        } else {
            return json_encode(['message' => 'Failed to save'], 404);
        }
    }

    //Search View
    public function search()
    {
        return view('search.search');
    }

    // Process search request
    public function searchProcess($searchedText)
    {
        $params = [
            'index' => '*',
            // 'type' => 'attachment',
            'body' => [
                'query' => [
                    'match'=>[
                        'attachment.content.ngrams'=>$searchedText
                    ]
                    // 'query_string' => [
                    //     'fields' => ['attachment.content'],
                    //     'query' => $searchedText . '*',
                    ]
                    // 'match_phrase_prefix' => [
                    //     'student_name' => [
                    //         'query' => $searchedText
                    //     ]
                    // ]
                ],
                'highlight' => [
                    'fields' => [
                        // 'title' => [
                        //     "type" => "plain",
                        //     // "fragment_size"=> 15,
                        //     "number_of_fragments" => 0,
                        //     // "fragmenter"=> "simple"
                        // ],

                            'attachment.content.ngrams' => [
                                // "type" => "plain",
                                // "number_of_fragments" => 0,
                                ]
                        ]
                    ],
                    'type'=>'fvh'
            ];
        try {
            $response = self::$client->search($params);
            // dd($response);

            $output = "";
            if ($response['hits']['total'] > 0) {
                $hits = $response['hits']['hits'];
                foreach ($hits as $key => $hit) {
                    $output .= '<li class = "list-group-item" id="list">';
                    $output .=    '<h3 class = "list-group-item-heading" >' . $hit['_index'] . '</h3>';
                    $output .=   '<p class = "list-group-item-text">' . $hit['highlight']['attachment.content'][0] . '</p>';
                    // $output .= ''
                }
                return $output;
            } else {
                return json_encode(['data' => 'no records found'], 400);
            }
        } catch (Missing404Exception $e) {
            return json_encode(['data' => 'Documet is not found: ' . $e->getMessage()], 400);
        }
    }

    // Get all Indices
    public function getIndices(Request $request)
    {
        if ($request->ajax()) {
            // $params = [
            //     'v' => true,
            //     // ...
            //     'index' => '*'
            // ];
            $output = '';
            try {

                $indices = self::$client->cat()->indices(array('index' => "*.pdf"));


                foreach ($indices as $index) {

                    $output .= "<tr>";
                    // $output .="";
                    $output .= "<td>";
                    $output .= str_replace('+',' ',$index['index']);

                    $output .= "<td>";
                    $output.= "<a class='delete' href='#' style='color:red;text-decoration:underline'  index=".$index['index'].">Delete</a>";                    
                    $output.="</td>";
                    $output.="</tr>";
                }
                // dd($output);
                return $output;
            } catch (Missing404Exception $e) {
                return json_encode(['message' => 'No index is found' . $e], 404);
            }
        }
    }
    
    public function deleteIndex(Request $request)
    {
        if($request->has('index')){
            
            $response = self::$client->indices()->delete(['index'=>$request->index]);
            
             return $response;
        }
       

    }
}
