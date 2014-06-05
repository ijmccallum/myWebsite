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
  <a href="security/XSS.php" class="list-group-item">Cross Site Scripting (XSS)</a>
  <a href="security/mobileAppInjection.php" class="list-group-item">HTML5 Mobile app code injection</a>
  <a href="security/CSRF.php" class="list-group-item">Cross Site Request Forgery (CSRF)</a>
  <a href="#" class="list-group-item greyout">SQL Injection</a>
  <a href="#" class="list-group-item greyout">Mutation XSS</a>
</div>
                
<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>