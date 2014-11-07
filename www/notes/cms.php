<?php $iainPageTitle = 'Content Managment Systems'; $docDepth = 1; ?>
<?php include '../partials/head.php'; ?>

<?php $breadcrumbAddress = (ltrim($homePath,'"')) . 'partials/breadcrumbs.php'; ?>
<?php include $breadcrumbAddress; ?>

<div class="row">
    <div class="col-md-6">
        <p>
            WordPress is my number 1 here, for ease of understanding from the point of view of a client it seems to be unbeatable.  But for the more interesting, technical and exciting projects, I like to move beyond the WP bubble.
        </p>
    </div> <!-- END 6 column for text -->
</div> <!-- END intro row -->

<div class="list-group">
  <a href="cms/wordpress.php" class="list-group-item greyout">WordPress</a>
  <a href="cms/keystone.php" class="list-group-item greyout">KeystoneJS</a>
  <a href="cms/mediawiki.php" class="list-group-item greyout">MediaWiki</a>
  <a href="#" class="list-group-item greyout">Ghost</a>
  <a href="cms/joomla.php" class="list-group-item greyout">Joomla</a>
  <a href="cms/drupal.php" class="list-group-item greyout">Drupal</a>
  <a href="cms/kirby.php" class="list-group-item greyout">Kirby</a>
</div>
                
<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>