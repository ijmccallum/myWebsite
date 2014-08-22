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

<h4>Front End</h4>
<div class="list-group">
  <a href="#" class="list-group-item">HTML</a>
  <a href="#" class="list-group-item">CSS</a>
  <a href="languages/javascript.php" class="list-group-item">Javascript</a>
</div>

<h4>Back End</h4>
<div class="list-group">
  <a href="#" class="list-group-item">PHP (twig/laravel/WordPress/MySQL...)</a>
  In new project file:  <code>composer create-project laravel/laravel your-project-name</code>
  <a href="#" class="list-group-item">Javascript (Jade/Node/MongoDB...)</a>
  <a href="languages/jade.php" class="list-group-item greyout">Jade (Javascript on Node)</a>
</div>

<hr />
<h2>Web application layers</h2>

...
                
<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>