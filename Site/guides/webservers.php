<?php $iainPageTitle = 'Webservers'; $docDepth = 1;?>
<?php include '../partials/head.php'; ?>

<?php $breadcrumbAddress = (ltrim($homePath,'"')) . 'partials/breadcrumbs.php'; ?>
<?php include $breadcrumbAddress; ?>

<div class="row">
    <div class="col-md-6">
        <p>
            I'm focusing on the software here, not the hardware - that'll be a few years down the road!  With my development roots in WordPress I was using Apache but never really interacting with it.  The first server software I really worked with was NodeJS and it's been pretty great!  Nginx is on the horizon, I'll hopefully get into that once Node is solid. 
        </p>
    </div> <!-- END 6 column for text -->
</div> <!-- END intro row -->
<div class="list-group">
  <a href="#" class="list-group-item greyout">NodeJS</a>
  <a href="#" class="list-group-item greyout">Apache</a>
  <a href="#" class="list-group-item greyout">IIS</a>
  <a href="#" class="list-group-item greyout">Nginx</a>
  <!-- <a href="guides/webservers.php" class="list-group-item">NodeJS</a>
  <a href="guides/frameworks.php" class="list-group-item">Apache</a>
  <a href="guides/cms.php" class="list-group-item">Nginx</a> -->
</div>
                
<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>