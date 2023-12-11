<!-- JavaScript files-->
<script src="../assets/js/jquery-3.7.1.min.js"></script>
<script src="../assets/vendor/bootstrap/js/popper.min.js"></script>
<script src="../assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
    integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">


    <script>
        // function routeView(url = 'index.php'){
        //     $.ajax({
        //         type : 'get',
        //         url : url,
        //         success : function(res){
        //             $('#app').html(res);
        //         },
        //         error :function(){
        //             alert('Error');
        //         }
        //     });
        // }
        // delete functionality
       
        $(document).on("click", ".delete", function () {
            var index = $(this).val();
            var table = $(this).attr('name');
            // console.log("del ----" + index);
            $.ajax({
                url: 'ajax_files/delete.php',
                data: {
                    table_index:table+'.'+index,
                },
                success: function (res) {
                    if(res){
                        // location.reload();
                        alert('Record Deleted')
                    }else{
                        alert('Record Not Deleted')
                    }
                }
            });
        });
    </script>