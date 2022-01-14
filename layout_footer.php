</div>
  

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
  
</body>

<script type="text/javascript">
    function getID(id){
    if(id){
        $.ajax({
            type: 'POST',
            url: 'switch.php',
            data:{type_id:id},
            success:function(data){
                console.log(data);
                $("#switch").html(data);
            }
        });
    }
}

</script>

</html>