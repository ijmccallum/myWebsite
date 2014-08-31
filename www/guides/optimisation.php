<?php $iainPageTitle = 'Optimisation'; $docDepth = 1;?>
<?php include '../partials/head.php'; ?>

<?php $breadcrumbAddress = (ltrim($homePath,'"')) . 'partials/breadcrumbs.php'; ?>
<?php include $breadcrumbAddress; ?>

<div class="row">
    <div class="col-md-6">
        <p>
            
        </p>
    </div> <!-- END 6 column for text -->
</div> <!-- END intro row -->
<div class="list-group">
  <a href="optimisation/seo.php" class="list-group-item">SEO</a>
  <a href="optimisation/speed.php" class="list-group-item">Speed</a>
  <a href="optimisation/smo.php" class="list-group-item greyout">SMO</a>
</div>
                
<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>