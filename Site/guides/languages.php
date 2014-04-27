<?php $iainPageTitle = 'Languages'; $docDepth = 1; ?>
<?php include '../partials/head.php'; ?>

<?php $breadcrumbAddress = (ltrim($homePath,'"')) . 'partials/breadcrumbs.php'; ?>
<?php include $breadcrumbAddress; ?>

<div class="row">
    <div class="col-md-6">
        <p>
            
        </p>
    </div> <!-- END 6 column for text -->
</div> <!-- END intro row -->

<h4>Major Languages</h4>
<div class="list-group">
  <a href="#" class="list-group-item">Javascript</a>
  <a href="#" class="list-group-item">HTML</a>
  <a href="#" class="list-group-item">CSS</a>
  <a href="#" class="list-group-item">PHP</a>
  <a href="#" class="list-group-item greyout">Ruby</a>
</div>
<h4>Templating Languages</h4>
<div class="list-group">
  <a href="#" class="list-group-item">Jade (Javascript on Node)</a>
  <a href="#" class="list-group-item">EJS (Javascript)</a>
  <a href="#" class="list-group-item greyout">Haml (HTML ??)</a>
  <a href="#" class="list-group-item greyout">Handlebars</a>
  <a href="#" class="list-group-item greyout">JSP (Java)</a>
  <a href="#" class="list-group-item greyout">Smarty (PHP)</a>
  <a href="#" class="list-group-item greyout">ERB (Ruby)</a>
</div>
                
<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>