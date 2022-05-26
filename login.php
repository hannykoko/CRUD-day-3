<?php
    require_once "db.php";
    require 'auth.php';
    require 'header.php';
    // $db= $conn;
    $error=[];
    $tmp = [];
    if (isset($_POST['login'])) {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $pass = mysqli_real_escape_string($conn, $_POST['password']);
        $password = md5($pass);

        if(trim($name) == ''){
            $error['name'] ="Please Enter Name."; 
            }else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
                $error['name'] = "Name must contain only alphabets and space";
            }else{
                // check user exist
                $sql = "SELECT * FROM users WHERE name = '$name'"; 
                $tmp['name'] = $_POST['name']; 

                if($result = mysqli_query($conn,$sql)){
                    if(mysqli_num_rows($result) > 0){ 
                        $user = mysqli_fetch_assoc($result);
                        // print_r($user);
                        // die();

                    if($password!== $user['password']){
                        $error['password'] = 'Password is incorrect'; 
                        $tmp['password'] = ''; 
                    }

                    else if(trim($password) == ''){
                        $error['password'] ="Please Enter Password.";
                    }else if(strlen($password) < 6) {
                        $error['password'] = "Password must be minimum of 6 characters";
                    }
                         
                    }else{
                        $error['name'] = 'Username was invalid';
                        $tmp['name'] = $_POST['name']; 
                    }
                }
                }
    
            // if(trim($password) == ''){
            //     $error['password'] ="Please Enter Password.";
            // }else if(strlen($password) < 6) {
            //     $error['password'] = "Password must be minimum of 6 characters";
            // }
            //     // print_r($error);
            //     // die();
              
            if(count($error) == 0){
                // echo 'no errors';
                // die();
                // $sql = "SELECT id FROM users WHERE name = '$name' and password = '$password'";
                // print_r($sql);
                // die();
                $result = mysqli_query($conn,"SELECT id FROM users WHERE name = '$name' and password = '$password'");
                // print_r($result);
                // die();
                $row = mysqli_fetch_all($result,MYSQLI_ASSOC);
                // $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
                
                $count = count($row);
                
                // If result matched $name and $password, table row must be 1 row
                  
                if($count == 1) {
                  // session_register("name");
                   session_start();
                   $_SESSION['name'] = $name;
                   $_SESSION['success_message'] = "Welcome to Brycen Myanmar !!";
                   header("location: index.php");
                    }
                }
                mysqli_close($conn);
            }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Sign Up</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        
        <div class="container">
        <?php
            if(isset($_SESSION['success_message'])) {
                $message = $_SESSION['success_message'];
                unset($_SESSION['success_message']);

        ?>
        <div class="alert alert-success alert-dismissible fade show mt-5" role="alert">
            <strong><?php  echo $message;?></strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
    
        <?php
            }
        ?>
            <div class="row justify-content-center mt-5">
                <div class="col-md-6">
                    <div class="page-header">
                        <h2>Login</h2>
                    </div>
                    <p>Please fill in your credentials to login.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="<?php if (isset($tmp['name'])) echo $tmp['name']; ?>" maxlength="50" >
                            <span class="text-danger"><?php if (isset($error['name'])) echo $error['name']; ?></span>
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" value="<?php if (isset($tmp['password'])) echo $tmp['password']; ?>" maxlength="8" >
                            <span class="text-danger"><?php if (isset($error['password'])) echo $error['password']; ?></span>
                        </div>

                        <input type="submit" class="btn btn-success" name="login" value="Submit">
                        Don't have an account?<a href="register.php" class="btn btn-default" style="color:blue;">Sign Up now.</a>
                    </form>
                </div>
            </div>    
        </div>
    </body>
</html>