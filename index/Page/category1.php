<?php 
                   $sql = "SELECT id,name,disc,img,date,cate_id FROM item WHERE  status= 1 AND lang =  $lang AND cate_id = $cate";
                   $result = $cn->query($sql);
                   while($row = $result->fetch_array()){
                    ?>
<div class="col-3">
    <div class="item-box">
        <a href="../index/index.php?lang=<?php echo $lang ?>&cate=<?php echo $row[5] ?>&itemid=<?php echo $row[0]   ?>">
            <div class="box-img">
                <img src="../index/Item/image/<?php echo $row[3] ?>" alt="">
            </div>
            <div class="box-desc">
                <div class="desc-name">
                    <span><?php  echo $row[1] ?></span>
                </div>
                <div class="desc-text">
                    <span><?php  echo $row[2] ?></span>
                </div>
                <div class="date">
                    <span> <i class="fa-solid fa-calendar-days"></i> <?php echo $row[4] ?></span>
                </div>
            </div>
        </a>

    </div>
</div>
<?php
                }
                ?>