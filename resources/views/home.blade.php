@extends('layouts.app')

@section('styles')
    {{-- Custom for this page --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 col-md-offset-2">
            <!-- document Add Modal -->
            <div class="modal fade" id="documentAddModal" tabindex="-1" role="dialog"
                aria-labelledby="documentAddModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="documentAddModalLabel">Add Files</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="multi-file-upload-ajax" accept-charset="utf-8" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <input type="file" class="form-control" name="files[]" id="files" multiple>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="save" id="submit" class="btn btn-primary">Submit</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Begin Page Content -->
    <div class="container" style="margin-top: 2%">

        <!-- Page Heading -->
        <div style="text-align: initial;margin-left: 23px">
            <h1 class="h3 mb-2" style="text-align: center">Documents</h1>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="" id="add_button" style="text-decoration: none;margin:0px;padding: 0px;" class="fa fa-plus fa-2x"
                    aria-hidden="true" data-toggle="modal" data-target="#documentAddModal"></a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="documentTable" width="100%" height="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Document Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    </div>
    </div>
@endsection
@section('javascripts')
    <script src="{{ URL::to('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::to('js/addDocument.js') }}"></script>
@endsection
