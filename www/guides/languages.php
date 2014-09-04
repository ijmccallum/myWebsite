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
  <a href="#" class="list-group-item greyout">HTML / HTML5</a>
  <a href="#" class="list-group-item greyout">CSS / CSS3</a>
  <a href="languages/javascript.php" class="list-group-item">Javascript</a>
  <a href="languages/jade.php" class="list-group-item">Jade</a>
  <a class="list-group-item greyout"><strong>Handlebars</strong><br />
    A templating language, came after and improved upon Moustache.</a>
  <a href="#" class="list-group-item greyout">PHP</a>
</div>

<hr />

<h4>Client side</h4>
Front end frameworks
<div class="list-group">
  <a href="languages/angularjs.php" class="list-group-item"><strong>AngularJS</strong><br />
    Data binding, single page web app framework.</a>
  <a class="list-group-item greyout"><strong>Backbone</strong><br />
    One of the first MVC frameworks in Javascript, a lot of boiler plate for a new web app.</a>
  <a class="list-group-item greyout"><strong>Knockout</strong><br />
    ...</a>
    <a class="list-group-item greyout"><strong>ember</strong><br />
    ...</a>
</div>

Front end libraries
<div class="list-group">
  <a href="#" class="list-group-item greyout"><strong>Twitter Bootstrap</strong><br />
    CSS framework.  A lot of very useful HTML, CSS and Javascript elements. (used on this site)</a>
  <a class="list-group-item greyout"><strong>jQuery</strong><br />
    Industry standard DOM manipulation library</a>
  <a class="list-group-item greyout"><strong>underscore</strong><br />
    Being replaced by Lo-Dash?</a>
  <a class="list-group-item greyout"><strong>Modernizer</strong><br />
    ...</a>
  <a class="list-group-item greyout"><strong>Promises (Q)</strong><br />
    The current (2014) industry standard for dealing with async callbacks</a>
  <a class="list-group-item greyout"><strong>AMD</strong><br />
    Lets you split javascript accross multiple files by requiring and listing dependencies</a>
  <a class="list-group-item greyout"><strong>Require JS</strong><br />
    Deals with loading required js libraries and files in the proper order</a>
</div>

<hr />

<h4>Server side</h4>
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

<hr />

<h2>Stacks</h2>
<h3>MEAN.js</h3>
MongoDB, Express, Angular, NodeJS.

<h3>LAMP</h3>
Linux, Apache, MySQL, PHP.
<hr />

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