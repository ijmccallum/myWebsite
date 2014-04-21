<?php $iainPageTitle = 'Guides - a work in progress'; $docDepth = 0;?>
<?php include 'partials/head.php'; ?>

<?php $breadcrumbAddress = (ltrim($homePath,'"')) . 'partials/breadcrumbs.php'; ?>
<?php include $breadcrumbAddress; ?>
<p style="text-align:right;margin-top: -22px;margin-bottom: 0px;font-size: 12px;"><a href="https://gist.github.com/ijmccallum/11146821">PHP Breadcrumb class in a gist >></a></p>
<div class="row">
    <div class="col-md-6">
        <p>
            The consolidation and refinement of my learning, I find that explaining a subject in easily understandable language really helps a thorough understanding.
            This is not an official resource, it's just a byproduct of my development which I thought might be quite useful for others, and for my future self brushing up
            on old topics.  If you find anything in here that you disagree with or know to be out of date or wrong, please get in contact with me!  I'm keen to keep this as correct as possible!
        </p>
    </div> <!-- END 6 column for text -->
</div> <!-- END intro row -->
<div class="list-group">
  <a href="guides/webservers.php" class="list-group-item">Web servers</a>
  <a href="guides/optimisation.php" class="list-group-item">Optimisation</a>
  <a href="guides/frameworks.php" class="list-group-item">Frameworks</a>
  <a href="guides/cms.php" class="list-group-item">Content Managment Systems</a>
  <a href="guides/databases.php" class="list-group-item">Database Systems</a>
  <a href="guides/designtheory.php" class="list-group-item">Design Theory</a>
  <a href="guides/inspiration.php" class="list-group-item">Inspiration</a>
</div>
                
<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>