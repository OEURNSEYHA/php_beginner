<?php

    $photo  = $_FILES['img-file'];
    $photoName = $photo['name'];
    $photoSize = $photo['size'];
    $imgName = mt_rand(100000,999999);

    $tmp = $photo['tmp_name'];
    $ext = pathinfo($photoName, PATHINFO_EXTENSION);
    $img = time().$imgName.'.'.$ext;
    $msg['imgname'] = $img;
    $condition_ext = array('jpg','JPG','jpeg','JPEG');
    if(!in_array($ext, $condition_ext)){
        $msg['extension'] = true;
    }else{
        $msg['extension'] = false;
        $msg['img']= $img;
        move_uploaded_file($tmp,'../Item/image/'.$img);

    }

    echo json_encode($msg);

?>