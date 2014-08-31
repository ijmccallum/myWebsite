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
    <link href='http://fonts.googleapis.com/css?family=Waiting+for+the+Sunrise' rel='stylesheet' type='text/css'>
    <link href=<?php echo $homePath . 'prism/prism.css"' ?> rel="stylesheet" />

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
    

<body class="language-js">

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
            } else if ($iainPageTitle == "@ijmccallum") {
                $iainPageClass = "indexHeadPic";
            } else {
                $iainPageClass = "makeSmallPageFullHeight";
            }
        ?>
        
        <!-- Page content -->
        <div id="page-content-wrapper" class="<?php echo $iainPageClass; ?>">
            <div class="content-header">

                <?php if ($iainPageTitle == "@ijmccallum"){ ?>
                <?php //The home page ?>
                        <a id="menu-toggle" href="#" class="btn btn-default homeTgl">
                        <div id="hotdog1"></div>
                        <div id="hotdog2"></div>
                        <div id="hotdog3"></div>
                        </a>
                    <div class="indexHeadPicWrap">
                        <img src="pics/indexBG/Scotland-1440-900.jpg" class="indexHeadPic">
                    </div>
                    <!--
                    <div id="homeBtnsWrap">
                        <div id="homeBtnsCenter">
                            <a href="/webdev.php">
                                <img src="pics/projectsBtn.png" id="projectsBtn">
                                <div id="projectsBtnOverlay" class="homeBtnReveal"><img src="pics/projectsBtn.png"></div>
                            </a>
                            <a href="/guides.php" id="toolsBtn">
                                <img src="pics/toolsBtn.png" id="toolsBtn">
                                <div id="toolsBtnOverlay" class="homeBtnReveal"><img src="pics/toolsBtn.png"></div>
                            </a>
                        </div>
                    </div>
                    -->

                <?php } else { ?>
                <?php //other pages ?>
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
                <?php } ?>

            </div>
            <div class="page-content inset">