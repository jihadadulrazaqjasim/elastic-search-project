$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // For upload files::::

    $('#multi-file-upload-ajax').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        let TotalFiles = $('#files')[0].files.length; //Total files
        let files = $('#files')[0];
        for (let i = 0; i < TotalFiles; i++) {
        formData.append('files' + i, files.files[i]);
        }
        formData.append('TotalFiles', TotalFiles);

        // console.log(files[0]);

        $.ajax({
        type:'POST',
        url: "/saveDocuments",
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: (data) => {
        
        alert(data.message);
        location.reload();
        this.reset();    
        },
        error: function(data){
         alert('error, ' . data.message);
        }
        });
        });
    // Get all indices (documents)
    getIndices()
    

        $(document).on("click",'.delete',function(){
            var index = $(this).attr("index");

            $.ajax({
                url: "deleteIndex/",
                type: "post",
                data: {"index" : index},
                success: function (res) {
                    getIndices();
                    // console.log(res);
                },
            }).done(function (res) {
            });

        });

        // $("#delete").

});

function getIndices(){
    $.ajax({
        url: "getIndices/",
        type: "get",
        success: function (res) {
            // console.log(typeof(res));
            if(res=="")
            $("#documentTable tbody").html('<tr><td>No Documents found!</td><td></td><tr/>')
            else{
                // console.log(res);
            $("#documentTable tbody").html(res);
            }
            
        },
    }).done(function (res) {
    });
}