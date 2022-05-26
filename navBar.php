<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        .dropdown-item:hover{
            background-color: green;
            color: white;
        }
    </style>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-success text-white">
    <div class="container">
    <a class="navbar-brand" href="#"><img src="img/company_logo.png" width="100" alt="" srcset=""></a>


        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
            <a class="nav-link  text-white" href="#">Welcome To Our Site <span class="sr-only">(current)</span></a>
            </li>
            
        </ul>
        <div class="dropdown">
            <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa-solid fa-user"></i>
                <?php
                echo $_SESSION['name'];
                ?>
            
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item " id="logoutBtn"  href="logout.php">Logout</a>
            </div>
        </div>
        
        </div>
    </div>

</nav>
</body>
</html>

