<?php
    include('../config.php');
    $sql = "SELECT MAX(id) FROM item";
    $result = $cn->query($sql);
    $row = $result->fetch_array();
    $autoid = $row[0] + 1;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style/item.css">
    <link rel="stylesheet" href="../../../PHP/link/fontawesome-free-6.1.1-web/css/all.css">

    <script src="../../../Php1/link/jquery.min.js"> </script>
    <title>Document</title>
</head>

<body>
    <div class="wrapage">
        <!-- form -->
        <div class="form-popup">
            <form class="upload">
                <div class="form-left">
                    <input type="text" name="editid" id="editid" value="0" hidden>
                    <input type="text" name="" id="id" value="<?php echo $autoid ?>" placeholder="ID" /><br>
                    <input type=" text" name="name" id="name" placeholder="Name" /><br>
                    <select name="cateid" id="cateid">
                        <option value="0">Category id</option>
                        <?php
                            $sql = "SELECT id, name FROM category WHERE status= 1";
                           
                            $result = $cn -> query($sql);
                            while($row = $result->fetch_array()){
                        ?>
                        <option value="<?php echo $row[0];?>"> <?php echo $row[1]; ?> </option>

                        <?php

                               
                        }
                        ?>
                        <!-- <option value=" 1"> 1</option>
                        <option value="2"> 2</option> -->
                    </select>
                    <select name="lang" id="lang">
                        <option value="0"> Language </option>
                        <option value="1"> English </option>
                        <option value="2"> Khmer </option>
                    </select><br>

                    <select name="status" id="status">
                        <option value="0">Status</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                    </select>
                    <div class="box-img">
                        <input type="file" name="img-file" id="img-file" />
                        <div class="loading-inputimg"></div>
                        <img src="../../" alt="">
                    </div>
                    <input type="text" name="img" id="img" hidden>
                </div>
                <div class=" form-right">
                    <textarea name="desc" id="desc" placeholder="Description"></textarea>
                    <div class="btn-save">
                        <span>Save</span>
                    </div>
                </div>


            </form>
            <div>

            </div>
        </div>
        <!-- form -->
        <div class="sidebar">
            <h1>PROJECT PHP</h1>
            <div class="content-sidebar">
                <ul>
                    <li>
                        <a href="../Category/category.php">

                            <span>Category </span>
                            <i class="fa-solid fa-envelope"></i>

                        </a>
                    </li>
                    <li>
                        <a href="../Item/item.php">
                            <span>Item</span>
                            <i class="fa-solid fa-list"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="contentright">
            <div class="header-content">
                <div class="btn-add">
                    <span> ADD NEW</span>
                </div>
            </div>
            <table id="tbl-data">
                <tr>
                    <th>ID</th>
                    <th>Category Id</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Language</th>
                    <th>Status</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
                <?php
                    // $sql = "SELECT * FROM item ORDER BY id DESC" ;
                    $sql = "SELECT 
                            item.id, category.name, item.name, item.img, item.disc,  item.lang, item.status, category.id
                            FROM item INNER JOIN category ON category.id = item.cate_id ORDER BY item.id DESC";
          
                    $result = $cn -> query($sql);
                    if($result-> num_rows > 0){
                        while( $row = $result -> fetch_array()){
                ?>
                <tr>
                    <td><?php echo $row[0] ?></td>
                    <td><span hidden><?php echo $row[7] ?></span> <?php echo $row[1] ?></td>
                    <td><?php echo $row[2] ?></td>
                    <td><?php echo $row[4] ?></td>
                    <td><?php echo $row[5] ?></td>
                    <td> <?php echo $row[6] ?></td>
                    <td> <img src="../Item/image/<?php echo $row[3] ?>" alt="<?php echo $row[3] ?>" width="100px" />
                    </td>
                    <td><i class="fa-solid fa-pen-to-square btn-edit "></i></td>
                </tr>

                <?php
                    }
                }
                ?>
            </table>
        </div>
    </div>


    <div class="popup"> </div>
    <script src="../../js/item.js"> </script>
</body>

</html>