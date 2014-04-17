<ol class="breadcrumb">
    <li class="active">Guides</li>
    <?php 

        $crumbs = explode("/",$_SERVER["REQUEST_URI"]);

        foreach($crumbs as $crumb){
            $word = ucfirst(str_replace(array(".php","_"),array(""," "),$crumb) . ' ');

            ?>    <li><a href=<?php echo $homePath . $word . '.php" >' . $word; ?> </a></li>    <?php
        }

    ?>
  <li class="guidemap"><a href=<?php echo $homePath . 'guides/map.php"' ?>>map</a></li>
</ol>