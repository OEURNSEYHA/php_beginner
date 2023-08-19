<div class="container wrap-content">
    <div class="row">
        <?php 
                   $sql = "SELECT id,name,disc,img,date FROM category WHERE lang=$lang AND status= 1";
                   $result = $cn->query($sql);
                   while($row = $result->fetch_array()){
                    ?>
        <div class="col-3">
            <div class="item-box">
                <div class="box-img">
                    <img src="../index/Category/image/<?php echo $row[3] ?>" alt="">
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
            </div>
        </div>
        <?php
                }
                ?>
    </div>
</div>