<?php 
    include('../index/config.php');
    $lang = 1;
    if(isset($_GET['lang'])){
        $lang = $_GET['lang'];
    }
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/index.css">
    <link rel="stylesheet" href="../../PHP/link/fontawesome-free-6.1.1-web/css/all.css">

    <link rel="stylesheet" href="../../PHP/link/bootstrap.min.css">
    <script src="../../Php1/link/jquery.min.js"></script>
    <title>Document</title>
</head>

<body>
    <div class="wrapage">
        <?php 
         $home_active = "home-pageactive";
         $mid = 0;
         if(isset($_GET['cate'])){
             $home_active = " ";
             $mid = $_GET['cate'];
         }
            include('../index/Page/menu.php');
           
           
            
        ?>
        <div class="container wrap-content">

            <div class="row">
                <?php 
                  
                   
                    if(isset($_GET['itemid'])){
                        $itemid = $_GET['itemid'];
                        include('../index/Page/itemdetail.php');
                    }else if(isset($_GET['cate'])){
                        $cate = $_GET['cate'];
                        include('../index/Page/category1.php');
                    }else{
                        include('../index/Page/Home.php');
                       
                    }
                ?>
            </div>
        </div>
    </div>
</body>

</html>
<script>
$(document).ready(function() {
    $(".lang-list").hide();
    $(".languages").click(function() {
        $(".lang-list").slideToggle();
    })
})
</script>
</script>