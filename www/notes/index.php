<?php $iainPageTitle = 'Notes on Web Development'; $docDepth = 1;?>
<?php include '../partials/head.php'; ?>


<!--
<p style="text-align:right;margin-bottom: 20px;font-size: 12px;"><a href="https://gist.github.com/ijmccallum/11146821">PHP Breadcrumb class in a gist >></a></p>
-->
<h2 class="quirkyHeading">The most efficient way to learn something is to learn it with the intention of teaching it.</h2>
<div class="row">
  <div class="col-md-6">
    <p>The Web Development Industry is filled with rapidly changing technologies - it's important not to get lost in all of it!  <br />
      So, this is my personal repository of notes on the various things I work with and learn.  The gray ones are things I am hoping to
      read into more / experience, but time will tell.</p>
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
      <a href="#Optimisation">Optimization</a>,
      <a href="#libraries">Cool libraries</a>,
      <a href="#CMS">Content Management Systems</a>,
      <a href="#Mobile">Mobile things</a>,
      <a href="#Other">Other notes</a>

  </div>
</div>

<hr />

<div class="row">
  <div class="col-md-12">
    My todo list:
    <ul>
      <li>High: Finish the paatterns book</li>
      <li>High: Figure out namespacing</li>
      <li>High: WL logicBot</li>
      <br />
      <li>Med: WL mobile friendly</li>
      <li>Med: WL pamphlet</li>
      <li>Med; WL organise styles</li>
      <br />
      <li>Low: ReactJS</li>
      <li>Low: Velocity.js: need an example project (my home page!): http://julian.com/research/velocity/#vmd</li>
      <li>Low: D3 / Plottable.js: Wikilogic stats</li>
      <li>Low: Sitecore notes</li>
      <li>Low: Accessibility notes</li>
    </ul>
  </div>
</div>

<hr />

<div class="row">

  <div class="col-md-4">
        <h4 id="Internet">The ground rules</h4>
        <div class="list-group">
          <a href="html.php" class="list-group-item">HTML</a>
          <a href="CSS.php" class="list-group-item">CSS</a>
          <a href="javascript.php" class="list-group-item">Javascript</a>
          <a href="javascript-patterns.php" class="list-group-item">Javascript:patterns</a>
          <a href="javascript-closures.php" class="list-group-item">Javascript:closures</a>
          <a href="ECMAScript6.php" class="list-group-item greyout">ECMAScript 6</a>
        </div>
        <h4 id="Internet">The Internet!</h4>
        <div class="list-group">
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
  </div>

  <div class="col-md-4">
        <h4 id="CMS">WordPress</h4>
        <div class="list-group">
          <a href="wordpress.php" class="list-group-item">Overview</a>
        </div>
        <h4 id="CMS">Umbraco</h4>
        <div class="list-group">
          <a href="umbraco.php" class="list-group-item greyout">Overview</a>
          <a href="#" class="list-group-item greyout">Packages</a>
          <a href="#" class="list-group-item greyout">Macros</a>
          <a href="#" class="list-group-item greyout">Microsoft's Razor syntax</a>
        </div>
        <h4 id="CMS">Sitecore</h4>
        <div class="list-group">
          <a href="sitecore.php" class="list-group-item greyout">Overview</a>
        </div>
        <h4 id="CMS">Other CMS systems</h4>
        <div class="list-group">
          <a href="mediawiki.php" class="list-group-item greyout">Media Wiki</a>
          <a href="drupal.php" class="list-group-item greyout">Drupal</a>
          <a href="joomla.php" class="list-group-item greyout">Joomla</a>
        </div>

        <div class="list-group">
          <a href="visualstudio.php" class="list-group-item greyout">Visual Studio</a>
        </div>

  </div>

  <div class="col-md-4">

        <h4 id="Front">Front End Development</h4>
        <div class="list-group">
          <a href="webcomponents.php" class="list-group-item greyout">Parallax</a>
          <a href="webcomponents.php" class="list-group-item">Web Components</a>
          <a href="polymer.php" class="list-group-item">Polymer</a>
          <a href="forms.php" class="list-group-item greyout">Forms</a>
          <a href="support.php" class="list-group-item greyout">Support</a>
          <a href="emails.php" class="list-group-item greyout">Emails</a>
          <a href="css-preprocessors.php" class="list-group-item greyout">css-preprocessors</a>
        </div>
        <h4 id="Angular">AngularJS</h4>
        <div class="list-group">
          <a href="angularjs.php" class="list-group-item">AngularJS</a>
          <a href="angular-events.php" class="list-group-item">Angular: Events</a>
        </div>
        <h4 id="Node">Node.js things</h4>
        <div class="list-group">
          <a href="node.php" class="list-group-item">Node</a>
          <a href="express.php" class="list-group-item">ExpressJS</a>
          <a href="keystone.php" class="list-group-item">KeystoneJS</a>
          <a href="mean.php" class="list-group-item">MEAN.JS</a>
          <a href="kirby.php" class="list-group-item">Kirby</a>
        </div>
  </div>

</div> <!-- END of the first row -->


<div class="row">

  <div class="col-md-4">
        <h4 id="Optimisation">Optimisation</h4>
        <div class="list-group">
          <a href="speed.php" class="list-group-item">Speed</a>
          <a href="speed.php" class="list-group-item greyout">Load Balancers</a>
          <a href="seo.php" class="list-group-item">SEO</a>
          <a href="smo.php" class="list-group-item">SMO</a>
        </div>
        <h4 id="Databases">Databases</h4>
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

  <div class="col-md-4">
        <h4 id="Security">Security</h4>
        <div class="list-group">
          <a href="security.php" class="list-group-item">Overview</a>
          <a href="authentication.php" class="list-group-item">Authentication</a>
          <a href="clickjacking.php" class="list-group-item">Click Jacking</a>
          <a href="CSRF.php" class="list-group-item">CSRF (Cross-Site Request Forgery)</a>
          <a href="mobileAppInjection.php" class="list-group-item">mobileAppInjection</a>
          <a href="XSS.php" class="list-group-item">XSS</a>
          <a href="" class="list-group-item greyout">Remote File Inclusion</a>
          <a href="" class="list-group-item greyout">SQL Injection</a>
          <a href="" class="list-group-item greyout">Mutation XSS</a>
          <a href="" class="list-group-item greyout">CRIME - Compression Ratio Info-leak Made Easy</a>
          <a href="" class="list-group-item greyout">cache poisoning attack (WebSockets)</a>
          <a href="" class="list-group-item greyout">Kleptographic attack</a>
        </div>
  </div>

  <div class="col-md-4">
        <h4 id="Languages">Notes on Languages</h4>
        <div class="list-group">
          <a href="programmingFundamentals.php" class="list-group-item">Fundamentals</a>
          <a href="php.php" class="list-group-item">PHP</a>
          <a href="jade.php" class="list-group-item">Jade</a>
          <a href="" class="list-group-item greyout">Coffeescript</a>
        </div>
        <h4 id="Testing">Testing</h4>
        <div class="list-group">
          <a href="angularTesting.php" class="list-group-item">Angular (Karma & Jasmine)</a>
          <a href="" class="list-group-item greyout">QUnit</a>
          <a href="" class="list-group-item greyout">Mocha</a>
          <a href="" class="list-group-item greyout">errorception (not a unit test, it tracks errors the real users in the field are hitting.)</a>
        </div>
        <h4 id="Analysis">Analysis tools</h4>
        <div class="list-group">
          <a href="" class="list-group-item greyout">Google Page speed</a>
          <a href="" class="list-group-item greyout">Google Tag Manager</a>
          <a href="" class="list-group-item greyout">Google Analytics</a>
        </div>
  </div>

</div> <!-- END of second row -->

<div class="row">

  <div class="col-md-4">
        <h4 id="DevelopmentTools">Development tools</h4>
        <div class="list-group">
          <a href="yeoman.php" class="list-group-item">yeoman</a>
          <a href="grunt.php" class="list-group-item">Grunt</a>
          <a href="" class="list-group-item"><strong>npm, The Node package manager</strong><br />
            Keep it up to date: <code>npm update -g npm</code></a>
          <a href="bower.php" class="list-group-item">Bower</a>
          <a href="" class="list-group-item greyout">Gulp</a>
          <a href="" class="list-group-item greyout">Browserify</a>
          <a href="" class="list-group-item greyout">RequireJS</a>
          <a href="" class="list-group-item greyout">Chrmoe Dev Tools</a>
          <a href="" class="list-group-item greyout">Google's Web Fundamentals</a>
        </div>
        <h4 id="OtherTools">Other tools</h4>
        <div class="list-group">
          <a href="emmet.php" class="list-group-item">Emmet</a>
          <a href="editors.php" class="list-group-item">Text editors</a>
          <a href="" class="list-group-item greyout">Z</a>
          <a href="" class="list-group-item greyout">Linting</a>
          <a href="" class="list-group-item greyout">Live Reload</a>
          <a href="" class="list-group-item greyout">SourceURL</a>
          <a href="" class="list-group-item greyout">SourceMaps</a>
          <a href="" class="list-group-item greyout">prettyify minified code browser extension</a>
          <a href="" class="list-group-item greyout">Postman</a>
        </div>
  </div>

  <div class="col-md-4">
        <h4 id="libraries">Cool libraries (and some polyfills for them)</h4>
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

  <div class="col-md-4">
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
        <h4 id="Reading">Books / reading materials to go through:</h4>
        <div class="list-group">
          <p class="list-group-item"><i>HTTP: The Definitive Guide</i> by David Gourley</p>
          <p class="list-group-item"><i>High Performance Web Sites</i> by Steve Souders</p>
          <p class="list-group-item"><i>The Tangled Web: A Guide to Securing Modern Web Applications</i> by Michal Zalewski</p>
        </div>
  </div>

</div><!-- END of third row -->









<!--

<h4>Some other areas of interest</h4>
<div class="list-group">
  <a href="guides/other/inspiration.php" class="list-group-item">Inspiration</a>
  <a href="guides/other/trading.php" class="list-group-item">Trading</a>
</div>

-->

<a href="http://en.wikipedia.org/wiki/Portal:Information_technology">Tech portal, WikiPedia</a>

<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>
