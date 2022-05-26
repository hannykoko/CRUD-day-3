<?php
session_start();
if(isset($_POST['delete'])){
    
    $link = mysqli_connect('localhost','root','','demo2');

    if($link === false){
        die("Error :: could not connect ".mysqli_connect_error());
    }

    $id = $_POST['id'];

    $sql = "DELETE FROM employees WHERE id=$id";

    if(mysqli_query($link,$sql)){
        $_SESSION['success_message'] = "Employee Deleted Successfully";
        header('Location: index.php');
    }else{
        header('Location: error.php');
    }
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
            <h2>Delete Record</h2>
            <hr>
            <form action="" method="post">
                <div class="alert alert-danger">
                    Are you sure to delete record?
                    <br>
                    <br>
                    <input type="hidden" name="id" value="<?php echo $_REQUEST['id'];?>">
                    <input type="submit" value="Yes" name="delete" class="btn btn-danger">
                    <a href="index.php" class="btn btn-primary">No</a>
                </div>
            </form>     
        </div>
    </div>
</div>
</body>
</html>