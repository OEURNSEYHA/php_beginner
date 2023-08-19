<?php  
    include('../config.php');
    date_default_timezone_set("Asia/Phnom_Penh");
    $editid = $_POST['editid'];
    $cate_id = $_POST['cateid'];
    $name = trim($_POST['name']);
    $name = $cn->real_escape_string($name);
    $disc = trim($_POST['desc']);
    $disc = str_replace("\n","</br>", $disc);
    $disc = $cn -> real_escape_string($disc);
    $date = date('j-F-Y');
   
    $status = $_POST['status'];
    $lang = $_POST['lang'];
    $img = $_POST['img'];

    $sql    = "SELECT * FROM item WHERE name='$name' && id != $editid ";
    $result = $cn->query($sql);
    $numrow = $result->num_rows;
    if($numrow > 0){
        $msg['dpl']=true;
    }else{
        if($editid == 0){
            $msg['edit']=false;
            $sql = "INSERT INTO item VALUES(null, $cate_id,'$name', '$img', '$disc', $lang, $status,'$date')";
            $cn->query($sql);
            $msg['autoid'] = $cn-> insert_id;
           
        }else{
            $msg['edit']=true;
            $sql = "UPDATE `item` SET `cate_id`=$cate_id, `name`='$name',`img`='$img',`disc`='$disc',`lang`= $lang,`status`=$status WHERE id=$editid";
            $cn->query($sql);
           
        }
      

        $msg['dpl']=false;
    }

    echo json_encode($msg);

   


?>