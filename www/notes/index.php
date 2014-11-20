<?php $iainPageTitle = 'Notes on Web Development'; $docDepth = 1;?>
<?php include '../partials/head.php'; ?>


<!--
<p style="text-align:right;margin-bottom: 20px;font-size: 12px;"><a href="https://gist.github.com/ijmccallum/11146821">PHP Breadcrumb class in a gist >></a></p>
-->
<h2 class="quirkyHeading">The most efficent way to learn something is to learn it with the intention of teaching it.</h2>
<div class="row">
  <div class="col-md-6">
    <p>The Web Development Industry is filled with rapidly changing technologies - it's important not to get lost in all of it!  <br />
      So, this is my personal repository of notes on the various things I work with and learn.  The grey ones are things I am hoping to 
      read into more / experiance, but time will tell.</p>
  </div>
  <div class="col-md-6">

      <a href="#Node">Node</a>,
      <a href="#Databases">Databases</a>,
      <a href="#DevelopmentTools">Development tools</a>,
      <a href="#OtherTools">Other tools</a>,
      <a href="#Testing">Testing</a>,
      <a href="#Analysis">Analysis tools</a>,
      <a href="#Languages">Languages</a>,
      <a href="#Security">Security</a>,
      <a href="#Internet">The Internet!</a>,
      <a href="#Optimisation">Optimisation</a>,
      <a href="#libraries">Cool libraries</a>,
      <a href="#CMS">Content Managment Systems</a>,
      <a href="#Mobile">Mobile things</a>,
      <a href="#Other">Other notes</a>

  </div>
</div>

<hr />

<div class="row">
  <div id="Node" class="col-md-6">
    <h4>Notes on things in the Node ecosystem</h4>
    <div class="list-group">
      <a href="node.php" class="list-group-item">Node</a>
      <a href="angularjs.php" class="list-group-item">AngularJS</a>
      <a href="express.php" class="list-group-item">ExpressJS</a>
      <a href="keystone.php" class="list-group-item">KeystoneJS</a>
      <a href="mean.php" class="list-group-item">MEAN.JS</a>
      <a href="kirby.php" class="list-group-item">Kirby</a>
    </div>
  </div>
  <div id="CMS" class="col-md-6">
    <h4>WordPress & Other CMS systems</h4>
    <div class="list-group">
      <a href="wordpress.php" class="list-group-item">WordPress</a>
      <a href="mediawiki.php" class="list-group-item greyout">Media Wiki</a>
      <a href="drupal.php" class="list-group-item greyout">Drupal</a>
      <a href="joomla.php" class="list-group-item greyout">Joomla</a>
    </div>
  </div>
</div>

<div class="row">
  <div id="Databases" class="col-md-6">
    <h4>Databases</h4>
    <div class="list-group">
      <a href="" class="list-group-item greyout">Fundamentals</a>
      <a href="hadoop.php" class="list-group-item greyout">Hadoop & Map Reduce</a>
      <a href="mongodb.php" class="list-group-item">MongoDB</a>
      <a href="" class="list-group-item greyout">Redis</a>
      <a href="" class="list-group-item greyout">mySQL</a>
      <a href="" class="list-group-item greyout">PostgreSQL</a>
      <a href="" class="list-group-item greyout">CouchDB</a>
      <a href="" class="list-group-item greyout">Memcached</a>
      <a href="" class="list-group-item greyout">Flat file</a>
    </div>
  </div>
  <div id="Internet" class="col-md-6">
    <h4>The Internet!</h4>
    <div class="list-group">
      <a href="html.php" class="list-group-item">HTML / CSS</a>
      <a href="DNS.php" class="list-group-item">DNS</a>
      <a href="htaccess.php" class="list-group-item">.htaccess</a>
      <a href="browsers.php" class="list-group-item">Browsers</a>
      <a href="http.php" class="list-group-item">HTTP (1.1 - 2.0)</a>
      <a href="wirelessNetworking.php" class="list-group-item">Wireless Networking</a>
      <a href="networking.php" class="list-group-item">Networking (IP, TCP, UDP, TLS)</a>
    </div>
    <div class="list-group">
      <a href="serviceWorker.php" class="list-group-item">ServiceWorkers</a>
      <a href="webrtc.php" class="list-group-item"><strong>WebRTC</strong><br />
        Real time communication (out of interest, it uses UDP instead of TCP)</a>
    </div>
    <h4 id="Optimisation">Optimisation</h4>
    <div class="list-group">
      <a href="speed.php" class="list-group-item">Speed</a>
      <a href="speed.php" class="list-group-item greyout">Load Balancers</a>
      <a href="seo.php" class="list-group-item">SEO</a>
      <a href="smo.php" class="list-group-item">SMO</a>
    </div>
  </div>
</div>

<div class="row">
   <div id="DevelopmentTools" class="col-md-6">
    <h4>Development tools</h4>
    <div class="list-group">
      <a href="yeoman.php" class="list-group-item">yeoman</a>
      <a href="grunt.php" class="list-group-item">Grunt</a>
      <a href="" class="list-group-item"><strong>npm, The Node package manager</strong><br />
        Keep it up to date: <code>npm update -g npm</code></a>
      <a href="bower.php" class="list-group-item">Bower</a>
      <a href="" class="list-group-item">Gulp</a>
      <a href="" class="list-group-item">Browserify</a>
      <a href="" class="list-group-item">RequireJS</a>
      <a href="" class="list-group-item">Chrmoe Dev Tools</a>
      <a href="" class="list-group-item">Google's Web Fundamentals</a>
    </div>
  </div>
  <div  id="OtherTools" class="col-md-6">
    <h4>Other tools</h4>
    <div class="list-group">
      <a href="" class="list-group-item">Z</a>
      <a href="" class="list-group-item">Linting</a>
      <a href="" class="list-group-item">Live Reload</a>
      <a href="" class="list-group-item">SourceURL</a>
      <a href="" class="list-group-item">SourceMaps</a>
      <a href="" class="list-group-item">prettyify minified code browser extension</a>
      <a href="" class="list-group-item">Postman</a>
    </div>
  </div>
</div>

<div class="row">
  
  <div id="Testing" class="col-md-6">
    <h4>Testing</h4>
    <div class="list-group">
      <a href="" class="list-group-item greyout">Jasmine</a>
      <a href="" class="list-group-item greyout">QUnit</a>
      <a href="" class="list-group-item greyout">Mocha</a>
      <a href="" class="list-group-item greyout">Karma</a>
      <a href="" class="list-group-item greyout">errorception (not a unit test, it tracks errors the real users in the field are hitting.)</a>
    </div>
    <h4>Analysis tools</h4>
    <div class="list-group">
      <a href="" class="list-group-item greyout">Google Page speed</a>
      <a href="" class="list-group-item greyout">Google Tag Manager</a>
      <a href="" class="list-group-item greyout">Google Analytics</a>
    </div>
  </div>
   <div id="Security" class="col-md-6">
    <h4>Security</h4>
    <div class="list-group">
      <a href="clickjacking.php" class="list-group-item">Click Jacking</a>
      <a href="CSRF.php" class="list-group-item">CSRF</a>
      <a href="mobileAppInjection.php" class="list-group-item">mobileAppInjection</a>
      <a href="XSS.php" class="list-group-item">XSS</a>
      <a href="" class="list-group-item greyout">SQL Injection</a>
      <a href="" class="list-group-item greyout">Mutation XSS</a>
      <a href="" class="list-group-item greyout">CRIME - Compression Ratio Info-leak Made Easy</a>
      <a href="" class="list-group-item greyout">cache poisoning attack (WebSockets)</a>
    </div>
  </div>
</div>


<div class="row">
  <div id="libraries" class="col-md-6">
    <h4>Cool libraries (and some polyfills for them)</h4>
    <div class="list-group"> 
      <a href="famous.php" class="list-group-item">Famo.us</a>
      <a href="proximity.php" class="list-group-item">Proximity</a>
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

      <a href="#" class="list-group-item greyout">Socket.IO</a>
      <a href="#" class="list-group-item greyout">Math Jax (http://www.mathjax.org/)<br />
        For showing equasions without the layout headache</a>
      <a href="#" class="list-group-item greyout">Web Audio API</a>
      <a href="#" class="list-group-item greyout">Proximity API</a>
      <a href="#" class="list-group-item greyout">Web Notifications API</a>
      <a href="#" class="list-group-item greyout">Web Speech API</a>
      <a href="#" class="list-group-item greyout"><strong>Webrtc</strong><br />Real time communication: http://www.webrtc.org/</a>
    </div>
  </div>
   <div id="Languages" class="col-md-6">
    <h4>Notes on Programming Languages</h4>
    <div class="list-group">
      <a href="programmingFundamentals.php" class="list-group-item">Fundamentals</a>
      <a href="javascript.php" class="list-group-item">Javascript</a>
      <a href="php.php" class="list-group-item">PHP</a>
      <a href="jade.php" class="list-group-item">Jade</a>
      <a href="" class="list-group-item">SASS / LESS</a>
      <a href="" class="list-group-item">Coffeescript</a>
    </div>
    <h4 id="Mobile">Mobile things</h4>
    <div class="list-group">
      <a href="" class="list-group-item">Cordova / PhoneGap</a>
      <a href="" class="list-group-item">Rho Mobile</a>
      <a href="" class="list-group-item">Appcelerator</a>
    </div>
    <h4 id="Other">Other notes</h4>
    <div class="list-group">
      <a href="designtheory.php" class="list-group-item">Design Theory</a>
      <a href="inspiration.php" class="list-group-item">Inspiration / life theory</a>
      <a href="investing.php" class="list-group-item">Investing</a>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6">
    <h4>Books / reading materials to go through:</h4>
    <div class="list-group">
      <p class="list-group-item"><i>HTTP: The Definitive Guide</i> by David Gourley</p>
      <p class="list-group-item"><i>High Performance Web Sites</i> by Steve Souders</p>
      <p class="list-group-item"><i>The Tangled Web: A Guide to Securing Modern Web Applications</i> by Michal Zalewski</p>
    </div>
  </div>
</div>
<!--
<h4>Guides for web development</h4>
<div class="list-group">
  <a href="guides/languages.php" class="list-group-item"><strong>Development Stacks</strong><br />
    Languages, Frameworks for the front & Back ends...</a>
  <a href="guides/tools.php" class="list-group-item"><strong>Development Tools</strong><br />
    Shell, build tools, ...</a>
  <a href="guides/designtheory.php" class="list-group-item"><strong>Design Theory</strong><br />
    Typography, ...</a>
  <a href="guides/cms.php" class="list-group-item"><strong>Content Managment Systems</strong><br />
    Handing control over to the client</a>
  <a href="guides/databases.php" class="list-group-item"><strong>Database Systems</strong><br />
    Designs & Interactions</a>
  <a href="guides/webservers.php" class="list-group-item"><strong>Web servers</strong><br />
    And a bit about how the web works</a>
  <a href="guides/security.php" class="list-group-item"><strong>Security</strong><br />
    Types of attacks and how to defend against them</a>
  <a href="guides/optimisation.php" class="list-group-item"><strong>Optimisation</strong><br />
    Speed, Search ...</a>
  <a href="guides/cross-platform.php" class="list-group-item greyout"><strong>Cross Platform</strong><br />
    Wrappers and things for Mobile Apps</a>
  
</div>

<h5>Google's refrence:</h5>
<a href="https://developers.google.com/web/fundamentals/" target="_blank" class="list-group-item greyout"><strong>Google's Web Fundamentals</strong><br />
  https://developers.google.com/web/fundamentals/</a>

<h4>Some other areas of interest</h4>
<div class="list-group">
  <a href="guides/other/inspiration.php" class="list-group-item">Inspiration</a>
  <a href="guides/other/trading.php" class="list-group-item">Trading</a>
</div>

-->
                
<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>