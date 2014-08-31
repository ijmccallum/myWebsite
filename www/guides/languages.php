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

<h4>Front End Frameworks / ...</h4>
<div class="list-group">
  <a href="languages/angularjs.php" class="list-group-item"><strong>AngularJS</strong><br />
    Making HTML dynamic, like ExpressJS except it runs <em>in the browser!</em></a>
</div>

<hr />

<h4>Back End Frameworks / ...</h4>
<div class="list-group">
  <a href="#" class="list-group-item greyout"><strong>ExpressJS</strong><br />
    MVC (and more?) for NodeJS</a>
  <a href="#" class="list-group-item greyout"><strong>Laravel</strong><br />
    Looks like a closs PHP equivolent of ExpressJS</a>
</div>

<hr />

<h4>API's and things, need to sort out</h4>
<div class="list-group">
  <a href="#" class="list-group-item greyout">Socket.IO</a>
  <a href="#" class="list-group-item greyout">Web Audio API</a>
  <a href="#" class="list-group-item greyout">Proximity API</a>
  <a href="#" class="list-group-item greyout">Web Notifications API</a>
  <a href="#" class="list-group-item greyout">Web Speech API</a>
  <a href="#" class="list-group-item greyout"><strong>Webrtc</strong><br />Real time communication: http://www.webrtc.org/</a>
  <a href="#" class="list-group-item greyout"><strong>Google's Web Fundamentals</strong><br />https://developers.google.com/web/fundamentals/</a>
  
</div>

<h2>Web application layers</h2>

...

<hr />

<h2>Programming Patterns</h2>

...

<h4>Factories</h4>

...

<h4>MVC</h4>

...

<h4>Single Page Application (SPA) - is this a pattern?</h4>
<p>Initially load a shell page, the user navigates through views loaded into that shell - no reloading.</p>
                
<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>