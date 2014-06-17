<?php 
$homePath = '"';
for ($x=0; $x<$docDepth; $x++){
  //add ../ to paths
    $homePath = $homePath . "../";
} 
?>
 <!DOCTYPE html>
<html lang="en">

<head>
	<link rel="icon" 
      type="image/png" 
      href=<?php echo $homePath . 'favicon.ico"' ?>>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $iainPageTitle; ?></title>

    <!-- Bootstrap core CSS -->
    <link href=<?php echo $homePath . 'bootstrap/css/bootstrap.css"' ?> rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href=<?php echo $homePath . 'bootstrap/css/simple-sidebar.css"' ?> rel="stylesheet">
    <link href=<?php echo $homePath . 'bootstrap/css/font-awesome.min.css"' ?> rel="stylesheet">
    <link href=<?php echo $homePath . 'styles.css"' ?>  rel="stylesheet">


<!-- Universal analytics -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-41554643-2', 'iainjmccallum.com');
  ga('send', 'pageview');

</script>


</head>
    

<body>

    <div id="wrapper">
        <?php $navLocation = (ltrim($homePath,'"')) . 'partials/nav.php' ?>
        <?php include $navLocation; ?>

        <?php 
            //Setting up the page wrapper class
            if ($iainPageTitle == "Tools"){ 
                $iainPageClass="psdTexture";
            } else if ($iainPageTitle == "Threadless") {
                $iainPageClass="threadlessBG";
            } else if ($iainPageTitle == "Synergy") {
                $iainPageClass="synergyBG";
            } else {
                $iainPageClass = "makeSmallPageFullHeight";
            }
        ?>
        
        <!-- Page content -->
        <div id="page-content-wrapper" class="<?php echo $iainPageClass; ?>">
            <img id="cornerPic" src=<?php echo $homePath . 'pics/me.png"' ?> onClick="secretSlide()" alt=""/>
            <div class="content-header">
                <h1>
                    <a id="menu-toggle" href="#" class="btn btn-default">
                    <div id="hotdog1"></div>
                    <div id="hotdog2"></div>
                    <div id="hotdog3"></div>
                    </a>
                    <?php if ($iainPageTitle == "Synergy") { ?>
                            <img src="pics/SynergyLogo2.jpg" alt="">
                    <?php } else {
                            echo $iainPageTitle; 
                    } ?> 
                </h1>
            </div>
            <div class="page-content inset">