<?php $iainPageTitle = 'Frameworks'; $docDepth = 1;?>
<?php include '../partials/head.php'; ?>

<?php $breadcrumbAddress = (ltrim($homePath,'"')) . 'partials/breadcrumbs.php'; ?>
<?php include $breadcrumbAddress; ?>

<div class="row">
    <div class="col-md-6">
        <p>
            Through working with NodeJS I have inevitably fallen in with Express though mainly through Sails and Keystone.  These have been the first tools I've used which employ the MVC pattern and I'm glad I've had the pleasure of their company - it's brilliant!  The rest of the guys at Swarm use ExtJS and Sencha which I've helped to theme but not been deep into development with.
            Django and Rails are on the horizon - topics for my future.
        </p>
    </div> <!-- END 6 column for text -->
</div> <!-- END intro row -->
<div class="list-group">
  <a href="#" class="list-group-item">ExpressJS</a>
  <a href="#" class="list-group-item">SailsJS</a>
  <a href="#" class="list-group-item">Sencha</a>
  <a href="#" class="list-group-item">ExtJS</a>
  <a href="#" class="list-group-item">Django</a>
  <a href="#" class="list-group-item">Rails</a>
 <!--  <a href="guides/webservers.php" class="list-group-item">ExpressJS</a>
  <a href="guides/frameworks.php" class="list-group-item">SailsJS</a>
  <a href="guides/cms.php" class="list-group-item">Sencha</a>
  <a href="guides/databases.php" class="list-group-item">ExtJS</a>
  <a href="guides/designtheory.php" class="list-group-item">Django</a>
  <a href="inspiration.php" class="list-group-item">Rails</a> -->
</div>
                
<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>