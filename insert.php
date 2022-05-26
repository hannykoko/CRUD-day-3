<?php
session_start();
if(isset($_POST['addSubmit'])){
    $link = mysqli_connect('localhost','root','','demo2');

    if($link === false){
        die("Error :: could not connect ".mysqli_connect_error());
    }
 
    $errors = [];
    $tmp = [];

    if(trim($_REQUEST['name']) == ''){
        $errors['name'] = 'Please Enter Name'; 
    }elseif (!preg_match("/^[a-zA-Z-' ]*$/",$_REQUEST['name'])) {
        $errors['name'] = 'Please Enter Valid Name'; 
        $tmp['name_value'] = ''; 
    }else{
        $tmp['name_value'] = $_REQUEST['name']; 
    } 

    if (trim($_REQUEST['address']) == '') {
        $errors['address'] = 'Please Enter address'; 
    }
    else{
        $tmp['address_value'] = $_REQUEST['address'];
    }
    

    if ($_REQUEST['salary'] == '') {
        $errors['salary'] = 'Please Enter salary'; 
    }elseif (!is_numeric(trim($_REQUEST['salary']))) {
        $errors['salary'] = 'Please Enter Numbers only'; 
        $tmp['salary_value'] = ''; 
    }elseif (number_format(trim($_REQUEST['salary']))< 0) {
        $errors['salary'] = 'Please Enter Positive value'; 
        $tmp['salary_value'] = '';
    }else{
        $tmp['salary_value'] = $_REQUEST['salary'];
    }

    

    if(count($errors) == 0){
        
    $name = mysqli_real_escape_string($link ,$_REQUEST['name']);
    $address = mysqli_real_escape_string($link ,$_REQUEST['address']);
    $salary =  mysqli_real_escape_string($link ,$_REQUEST['salary']);

    
    
    $sql = 'INSERT INTO employees (name, address, salary) VALUES 
        ("'.$name.'", "'.$address.'", "'.$salary.'")';
    
    if(mysqli_query($link,$sql)){
        $_SESSION['success_message'] = "Employee Added Successfully";
        header('Location: index.php');
    }else{
        echo "Error :: could not add record ".mysqli_error($link);
    }
    
    mysqli_close($link);
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <h2>Create Record</h2>

            <hr>
            <p>Please fill this form and submit to add employee record to database</p>
            <form action="" method="post">
                <!-- name -->
                <div class="form-group">
                    <labe><strong>Name</strong> </label>
                    <input value="<?php if(isset($tmp['name_value'])){ echo $tmp['name_value'];}?>" type="text" class="form-control <?php if(isset($errors['name'])){ ?>is-invalid <?php
                        }
                    ?>" name="name">
                    <!-- validation error message -->
                    <?php
                        if(isset($errors['name'])){
                    ?>
                    <span class="text-danger">
                        <?php
                            echo $errors['name'];
                        ?>
                    </span>

                    <?php
                        }
                    ?>
                </div>

                <!-- address -->
                <div class="form-group">
                    <label><strong>Address</strong> </label>
                    <textarea name="address" id="" rows="2" class="form-control <?php if(isset($errors['address'])){ ?>is-invalid <?php
                        }
                    ?>"><?php 
                    if(isset($tmp['address_value'])){ echo $tmp['address_value'];
            
                        }?></textarea>
                      <!-- validation error message -->
                      <?php
                        if(isset($errors['address'])){
                    ?>
                    <span class="text-danger">
                        <?php
                            echo $errors['address'];
                        ?>
                    </span>

                    <?php
                        }
                    ?>
                </div>
                

                <!-- salary -->
                <div class="form-group">
                    <label><strong>Salary</strong> </label>
                    <input value="<?php if(isset($tmp['salary_value'])){ echo $tmp['salary_value'];}?>" type="text" class="form-control <?php if(isset($errors['salary'])){ ?>is-invalid <?php
                        }
                    ?>" name="salary" value="">
                      <!-- validation error message -->
                      <?php
                        if(isset($errors['salary'])){
                    ?>
                    <span class="text-danger">
                        <?php
                            echo $errors['salary'];
                        ?>
                    </span>

                    <?php
                        }
                    ?>
                </div>

                <input type="submit" value="Submit" name="addSubmit" class="btn btn-primary">
                <a href="index.php"  class="btn btn-light" style="background-color:#e0dfdc">Cancel</a>
            </form>
            
        </div>
    </div>
</div>
</body>
</html>