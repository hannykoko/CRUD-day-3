<?php

if(isset($_REQUEST['id'])){
    $link = mysqli_connect('localhost','root','','demo2');

    if($link === false){
        die("Error :: could not connect ".mysqli_connect_error());
    }

    $id = $_REQUEST['id'];

    

    $sql = "SELECT * FROM employees WHERE id = $id ";
    if($result = mysqli_query($link,$sql)){
        if(mysqli_num_rows($result)>0){
            $row = mysqli_fetch_assoc($result);
        }else{
            header('Location: error.php');
        }
    }else{
        header('Location: error.php');
    }
    
}else{
    header('Location: error.php');
}
?>
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
            <h2>View Record</h2>
            <hr>
            <label><strong> Name:</strong></label>
            <p><?php echo $row['name'];?></p>

            <label><strong> Address:</strong></label>
            <p><?php echo $row['address'];?></p>

            <label><strong>Salary:</strong> </label>
            <p><?php echo $row['salary'];?></p>
             
            <a href="index.php" class="btn btn-primary">Back</a> 
        </div>
    </div>
</div>
</body>
</html>