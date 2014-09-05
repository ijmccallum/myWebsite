<?php $iainPageTitle = 'Notes on Web Development'; $docDepth = 0;?>
<?php include 'partials/head.php'; ?>

<?php $breadcrumbAddress = (ltrim($homePath,'"')) . 'partials/breadcrumbs.php'; ?>
<?php include $breadcrumbAddress; ?>
<!--
<p style="text-align:right;margin-bottom: 20px;font-size: 12px;"><a href="https://gist.github.com/ijmccallum/11146821">PHP Breadcrumb class in a gist >></a></p>
-->
<div class="row" style="text-align:center;">
    <h2 class="quirkyHeading">The most efficent way to learn something is to learn it with the intention of teaching it.</h2>
</div>

<div class="list-group">
  <a class="list-group-item greyout">Grey links like this mean there is no content yet, but there will be</a>
</div>
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

<h4>Extra bonus section!</h4>
<div class="list-group">
  <a href="guides/inspiration.php" class="list-group-item">Inspiration</a>
</div>
                
<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>