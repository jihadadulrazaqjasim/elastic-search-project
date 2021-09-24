$(document).ready(function () {
    // alert("searcging...");

      $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });

        // $("#searchBtn").on('click', function (e) {
          $('#searchedText').on('keyup', async function(){
            $(this).val()==''?$("#parentDiv").html(''):'';

            let searchedText = $("#searchedText").val();
            
            // alert(searchedText);
            $.ajax(
                {
                    url: "searchProcess/" + searchedText,
                    type: "get",
                    success:function (res){
                        $("#parentDiv").html(res);
                        console.log(res);

                        $("em").css({"background-color":"yellow","padding":"2px"});
                    },
                }).done(function(res) {
            });
        });

});