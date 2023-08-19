<div class=" header">
    <div class="container content-header">
        <div class="menubar"> <i class="fa-solid fa-bars"></i></div>

        <ul class="sidebar">
            <li class="<?php echo $home_active  ?>">
                <a href=" ../index/index.php?lang=<?php echo $lang; ?>"> <i class=" fa-solid fa-house-user"></i></a>
            </li>
            <?php
                $sql = "SELECT id,name FROM category WHERE lang = $lang && status = 1";
                 $result = $cn->query($sql);
                 while($row = $result->fetch_array()){
                    if($mid == $row[0]){
                        $active = "home-pageactive";
                    }else{
                        $active = "";
                    }
             ?>
            <li class="<?php echo $active ?>">
                <a
                    href="../index/index.php?lang=<?php echo $lang; ?>&cate=<?php echo $row[0]; ?>"><?php echo $row[1] ?></a>
            </li>
            <?php
                    }
                    ?>
        </ul>

        <div class=" languages">
            <i class="fa-solid fa-language icon-lang"></i>
            <div class="lang-list">
                <li><a href="../index/index.php?lang=1"> English</a></li>
                <li><a href="../index/index.php?lang=2"> Khmer</a></li>
            </div>
        </div>
    </div>
</div>