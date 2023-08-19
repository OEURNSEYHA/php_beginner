<?php
    include('../config.php');
    date_default_timezone_set("Asia/Phnom_Penh");
    
    $editId = $_POST['editid'];
    $name = trim($_POST['name']);
    $name = $cn->real_escape_string($name);
    $disc = $_POST['desc'];
    $status = $_POST['status'];
    $lang = $_POST['lang'];
    $img = $_POST['img'];
    $date   = date("j-F-Y");
    
    // $msg['date'] = $date;
    
    $sql = " SELECT * FROM category WHERE name = '$name' && id != $editId";
    $Result = $cn->query($sql);
    $numrow = $Result -> num_rows;

    if( $numrow > 0){ 
        $msg['dpl'] = true;

    }else{
        if($editId == 0){
            $sql  = "INSERT INTO category VALUES(null,'$name', '$disc', '$img', $lang, $status, '$date')";
            $cn->query($sql);
            $msg['autoid']  = $cn-> insert_id;
            $msg['edit']=false;
        }else{
            $sql = "UPDATE `category` SET `name`='$name',`disc`='$disc',`img`='$img',`lang`=$lang,`status`= $status WHERE `id`=$editId";
            $cn->query($sql);
            $msg['edit']=true;
        }
        $msg['dpl'] = false;
    }

   

    echo json_encode($msg); 

?>