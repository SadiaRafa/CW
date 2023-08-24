<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Promocode</title>
</head>
<body>
    
<div class="container">
    <h2></h2>
     <div class="form-group">
        <label for="email">Total Price:</label>
        <input type="text" class="form-control" id="total_price" name="total_price" value="1000.00">
</div>

<div class=""form-group">
        <label for="promo_code">Apply Promocode:</label>
        <input type="text" class="form-control" id="coupon_code" placeholder="Apply Promocode" name="total_price">
        <b><span id="message" style="color:green;"></span></b>
</div>

<button id="apply" class="btn btn-default">Apply</button>
<button id="edit" class="btn btn-default" style="dispaly:none;">Apply</button>
</div>

<script>
    $("#apply").click(function(){
        if ($('#promo_code').val()!=''){
           $.ajax({
            type: "POST",
            url: "process.php",
            data:{
                coupon_code: $('#coupon_code').val()
            },
            success: funtional(dataresult){
                var dataResult= JSON.parse(dataResult);
                if(dataResult.statuscode==200){
                    var after_apply=$('#total_price').val()-dataResult.value;
                    $('#total_price').val(after_apply);
                    $('#apply').hide();
                    $('#edit').show();
                    $('#message').html("Promocode applied successfully !");
                }
                else if (dataResult.statusCode==201){
                    $('#message').html("Invalid Promocode !");
                }
            }
           });
        }
        else{
            $('#message').html("Promocode can not be blank. Enter a Valid Promocode !");
        }
    });

    $("#edit").click(function(){
        $('#coupon_code').val("");
        $('#apply').show();
        $('#edit').hide();
        location.reload;
    })
</body>
</html>