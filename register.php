<?php
    require_once "db.php";
    $error=[];
    $tmp = [];
    if (isset($_POST['signup'])) {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']); 
        
        if(trim($name) == ''){
        $error['name'] ="Please Enter Name.";
        }else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
            $error['name'] = "Name must contain only alphabets and space";
        }else{
        // check user exist
        $sql = "SELECT * FROM users WHERE name = '$name'";
    
        if($result = mysqli_query($conn,$sql)){
            if(mysqli_num_rows($result)>0){
    
                // echo 'here';
                $error['name'] = 'Username already exists'; 
            }else{

                $tmp['name'] = $_POST['name']; 
            }
        }
        }

        if(trim($password) == ''){
            $error['password'] ="Please Enter Password.";
        }else if(strlen($password) < 6) {
            $error['password'] = "Password must be minimum of 6 characters";
        }else{
            $tmp['password']=$password;
        } 

        if(trim($cpassword) == ''){
            $error['cpassword'] ="Please confirm your password.";
        }else if($password != $cpassword) {
            $error['cpassword'] = "Password and confirm Password doesn't match";
        }else{
            $tmp['cpassword']=$cpassword;
        }


        if(count($error) == 0){
            if(mysqli_query($conn, "INSERT INTO users(name,password) VALUES('" . $name . "','" . md5($password) . "')")) {
                session_start();
                $_SESSION['success_message'] = "Register completed , Login again !!";
                header('Location: login.php');
            }else{
                echo "Error :: could not add record ".mysqli_error($conn);
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
            <div class="row justify-content-center mt-5">
                <div class="col-md-6">
                    <div class="page-header">
                        <h2>Sign Up</h2>
                    </div>
                    <p>Please fill this form to create an account.</p>
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

                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" name="cpassword" class="form-control" value="<?php if (isset($tmp['cpassword'])) echo $tmp['cpassword']; ?>" maxlength="8" >
                            <span class="text-danger"> <?php if (isset($error['cpassword'])) echo $error['cpassword']; ?></span>
                        </div>
                        <input type="submit" class="btn btn-success" name="signup" value="Submit">
                        <input type="reset" class="btn btn-success" name="reset" value="Reset">
                        <br>
                        Already have an account?<a href="login.php" class="btn btn-default" style="color:blue;">Login here</a>
                    </form>
                </div>
            </div>    
        </div>
    </body>
</html>