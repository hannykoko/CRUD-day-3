
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <h2>Invalid Request</h2>
            <hr>
            <form action="" method="post">
                <div class="alert alert-danger">
                   Sorry , you have made the invalid request. PLease <a  onClick = "back()" class="text-danger"><strong>go back</strong>  </a>and try.
                </div>
            </form>     
        </div>
    </div>
</div>
<script>
    function back(){
        history.go(-1);
    }
</script>
</body>
</html>
<?php 

?>