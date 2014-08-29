<?php $iainPageTitle = 'Web Stacks (Languages/Technologies/combinations...)'; $docDepth = 1; ?>
<?php include '../partials/head.php'; ?>

<?php $breadcrumbAddress = (ltrim($homePath,'"')) . 'partials/breadcrumbs.php'; ?>
<?php include $breadcrumbAddress; ?>

<div class="row">
    <div class="col-md-6">
        <p>
            
        </p>
    </div> <!-- END 6 column for text -->
</div> <!-- END intro row -->

<h4>Languages</h4>
<div class="list-group">
  <a href="#" class="list-group-item greyout">HTML</a>
  <a href="#" class="list-group-item greyout">CSS</a>
  <a href="languages/javascript.php" class="list-group-item">Javascript</a>
  <a href="languages/jade.php" class="list-group-item">Jade</a>
  <a href="#" class="list-group-item greyout">PHP</a>
</div>

<h4>Frameworks / ...</h4>
<div class="list-group">
  <a href="languages/angularjs.php" class="list-group-item">AngularJS</a>
  <a href="#" class="list-group-item greyout">Laravel</a>
</div>

<hr />

<h2>Web application layers</h2>

...

<hr />

<h2>Programming Patterns</h2>

...
                
<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>