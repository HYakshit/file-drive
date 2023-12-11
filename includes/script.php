<script>
$(document).on("click", "#edit", function () {
    let edit_val = $(this).val();
    console.log("edit ----" + edit_val);
  });
  $(document).on("click", "#delete", function () {
    let del_val = $(this).val();
    console.log("del ----" + del_val);
    $.ajax({
        url:'../database/operations.php',
        data:{
          actionby:'city',
          del_val:del_val,
        },
        success:function(res){
          console.log("sucess");
     
        }
    })
  });
</script>