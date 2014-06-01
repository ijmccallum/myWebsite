<?php $iainPageTitle = 'Security'; $docDepth = 1; ?>
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
  <a href="#" class="list-group-item greyout">SQL Injection</a>
  <a href="security/XSS.php" class="list-group-item">Cross Site Scripting (XSS)</a>
  <a href="#" class="list-group-item greyout">Mutation XSS</a>
  <a href="#" class="list-group-item greyout">Cross Site Request Forgery (same as XSS?)</a>
</div>
                
<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>