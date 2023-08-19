<?php 
    $sql = "SELECT name,disc,img FROM item WHERE id = $itemid";
    $result = $cn->query($sql);
    while($row = $result->fetch_array()){
        ?>
<div class="col-12">
    <div class="box-detail">
        <div class="box-imgdetail">
            <img src="../index/Item/image/<?php echo $row[2]; ?>" alt="">
        </div>
        <div class="box-descdetail">
            <div class="box-namedetail">
                <span> <?php echo  $row[0]  ?></span>
            </div>
            <div class="box-textdetail">
                <span> <?php echo $row[1]  ?></span>
            </div>
        </div>
    </div>
</div>

<?php } ?>