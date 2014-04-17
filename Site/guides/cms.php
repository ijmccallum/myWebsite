<?php $iainPageTitle = 'Content Managment Systems'; $docDepth = 1; ?>
<?php include '../partials/head.php'; ?>

<ol class="breadcrumb">
  <li><a href=<?php echo $homePath . 'guides.php"' ?>>Guides</a></li>
  <li class="active">CMS</li>
</ol>

<div class="row">
    <div class="col-md-6">
        <p>
            Note on my experiance with various Content Managment Systems
        </p>
    </div> <!-- END 6 column for text -->
</div> <!-- END intro row -->

<div class="list-group">
  <a href="CMS/wordpress.php" class="list-group-item">WordPress</a>
  <a href="CMS/joomla.php" class="list-group-item">Joomla</a>
  <a href="CMS/drupal.php" class="list-group-item">Drupal</a>
  <a href="CMS/keystone.php" class="list-group-item">KeystoneJS</a>
  <a href="CMS/mediawiki.php" class="list-group-item">MediaWiki</a>
</div>
                
<?php include '../partials/footer.php'; ?>