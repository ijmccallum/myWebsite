<?php $iainPageTitle = 'Databases'; $docDepth = 1;?>
<?php include '../partials/head.php'; ?>

<?php $breadcrumbAddress = (ltrim($homePath,'"')) . 'partials/breadcrumbs.php'; ?>
<?php include $breadcrumbAddress; ?>

<div class="row">
    <div class="col-md-6">
        <p>
            MySQL has always been there through my WordPress involvement but I've been getting deeper into the land of Mongo through Node development projects.  As the WikiLogic project progresses databases are going to come increasingly into my focus so this will be an interesting space to watch!  Also, I like the look of a Flat File system but haven't yet had the chance to work with one.
        </p>
    </div> <!-- END 6 column for text -->
</div> <!-- END intro row -->
<div class="list-group">
  <a href="#" class="list-group-item">MySQL</a>
  <a href="#" class="list-group-item">MongoDB</a>
  <a href="#" class="list-group-item">Flat File</a>
</div>
                
<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>