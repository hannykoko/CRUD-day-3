<?php
require 'auth.php';

if(!auth()){
    header('Location: login.php');
}

$link = mysqli_connect('localhost','root','','demo2');

if($link === false){
    die("Error :: could not connect ".mysqli_connect_error());
}

$sql = 'SELECT * FROM employees';

if($result = mysqli_query($link,$sql)){
        $row = mysqli_fetch_all($result,MYSQLI_ASSOC);
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
<body>
    <!-- nav -->
   <?php require "navBar.php";?>


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
   
    <div class="d-md-flex mt-5 justify-content-between">
  
        <h3>Employee Details</h3>
        
        <a href="insert.php" class="btn btn-success">Add New Employee <i class="fa-solid fa-plus ml-2"></i></a>
    </div>
    <div class="table-responsive">
        <input type="text" name="search" id="search" placeholder="Search Name...">
    <table class="table table-bordered mt-3" id="data-table">

      
            <?php
            if(count($row) != 0){
                ?>
            <thead style="background-color: #347deb; color:white">
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Salary</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
            $no = 1;
            foreach($row as $r){
            ?>
           
            <tr id="<?php echo $r['id']?>">
                <td>
                    <?php echo $no++; ?>
                </td>
                <td>
                    <?php echo $r['name'];?>
                </td>
                <td>
                    <?php echo $r['address'];?>
                </td>
                <td>
                    <?php echo $r['salary'];?>
                </td>
                <th>
                    <a href="view.php?id=<?php echo $r['id'];?>" data-toggle="tooltip" title="View"  style="cursor:pointer; text-decoration:none" class="fa-solid fa-eye mr-2 text-primary link"></a>
                    <a href="update.php?id=<?php echo $r['id'];?>" data-toggle="tooltip" title="Edit" style="cursor:pointer; text-decoration:none" class="fa-solid fa-pen-to-square mr-2 text-primary link"></a>
                    <a href="delete.php?id=<?php echo $r['id'];?>" data-toggle="tooltip" title="Delete"  style="cursor:pointer; text-decoration:none" class="fa-solid fa-trash-can mr-2 text-primary link"></a>
                </th>
            </tr>
            
            <?php
            }
        }else {
            echo "<hr>";
            echo "<h1><i>No Records found.</i></h1>";
        }
            ?>
       </tbody>
    </table>
        </div>
  
    </div>
    <!-- script file Bootstrap -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  
    <script type="text/javascript">
    $(document).ready(function() {
       

        function tableReload(){
            let trElements = document.getElementsByTagName("tr");
            
            let trArr = Array.from(trElements);
            
            trArr.forEach(el => el.style.backgroundColor = 'transparent');
        }

        function searchTrue(){
           console.log($(this)); 
        }

        $( "#search" ).keyup(function() {
            let inputSearch = document.getElementById("search").value; 
            $.ajax({
                url: "search.php",
                type: "post",
                data:  {
                    search: inputSearch,
                },
                success: function (response) {
                    let result = JSON.parse(response);

                    let trElements = document.getElementsByTagName("tr");
                    let trArr = Array.from(trElements);

                    //Search box style
                    if((result.length == 0 ) && (inputSearch.trim() != '')){
                        //Found no result
                        tableReload();
                        document.getElementById("search").style.backgroundColor = '#eb0c31';
                    }else if((result.length == 0 ) && (inputSearch.trim() == '')){ 
                        tableReload();
                        document.getElementById("search").style.backgroundColor = 'transparent';
                    }


                    //table
                    if(result.length != 0){
                        //result found
                        tableReload();
                        result.forEach(el => {
                        let searchItem = document.getElementById(el); 
                        searchItem.style.backgroundColor = 'yellow';
                            })
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
                }
            });
        });

        
    }); 
    </script>
<?php include "footer.php"?>
</body>
</body>
</html>



<?php

}else{
    header('Location: error.php');
}
?>
