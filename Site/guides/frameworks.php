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
<p>Frameworks</p>
<div class="list-group">
  <a href="#" class="list-group-item">ExpressJS</a>
  <a href="#" class="list-group-item">SailsJS</a>
  <a href="#" class="list-group-item greyout">Sencha</a>
  <a href="#" class="list-group-item greyout">ExtJS</a>
  <a href="#" class="list-group-item greyout">Django</a>
  <a href="#" class="list-group-item greyout">Rails</a>
</div>
<hr />
<p>Tools</p>
<div class="list-group">
  <a href="#" class="list-group-item greyout">Socket.IO</a>
  <a href="#" class="list-group-item greyout">Web Audio API</a>
  <a href="#" class="list-group-item greyout">Proximity API</a>
  <a href="#" class="list-group-item greyout">Web Notifications API</a>
  <a href="#" class="list-group-item greyout">Web Speech API</a>
</div>
<hr />
<p>MiddleWare / cross platform</p>
<div class="list-group">
  <a href="#" class="list-group-item greyout">PhoneGap | Cordova</a>
  <a href="#" class="list-group-item greyout">RhoMobile</a>
  <a href="#" class="list-group-item greyout">Appcelerator</a>
</div>
                
<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>