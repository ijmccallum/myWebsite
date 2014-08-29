<?php $iainPageTitle = 'Guides - a work in progress'; $docDepth = 0;?>
<?php include 'partials/head.php'; ?>

<?php $breadcrumbAddress = (ltrim($homePath,'"')) . 'partials/breadcrumbs.php'; ?>
<?php include $breadcrumbAddress; ?>
<p style="text-align:right;margin-bottom: 20px;font-size: 12px;"><a href="https://gist.github.com/ijmccallum/11146821">PHP Breadcrumb class in a gist >></a></p>
<div class="row">
    <div class="col-md-6">
        <p>
            The consolidation and refinement of my learning, I find that explaining a subject in easily understandable language really helps a thorough understanding.
            This is not an official resource, it's just a byproduct of my development which I thought might be quite useful for others, and for my future self brushing up
            on old topics.  If you find anything in here that you disagree with or know to be out of date or wrong, please get in contact with me!  I'm keen to keep this as correct as possible!
        </p>
    </div> <!-- END 6 column for text -->
</div> <!-- END intro row -->
<h4>Key:</h4>
<div class="list-group">
  <a href="#" class="list-group-item">Live link: I have filled out content for these pages, click to explore!</a>
  <a href="#" class="list-group-item greyout">To do: no content yet but it's coming.</a>
</div>
<h4>Guides for web development</h4>
<div class="list-group">
  <a href="guides/cms.php" class="list-group-item"><strong>Content Managment Systems</strong><br />
    Handing control over to the client</a>
  <a href="guides/languages.php" class="list-group-item"><strong>Development Stacks</strong><br />
    Languages, Frameworks for the front & Back ends...</a>
  <a href="guides/databases.php" class="list-group-item"><strong>Database Systems</strong><br />
    Designs & Interactions</a>
  <a href="guides/webservers.php" class="list-group-item"><strong>Web servers</strong><br />
    And a bit about how the web works</a>
  <a href="guides/security.php" class="list-group-item"><strong>Security</strong><br />
    Types of attacks and how to defend against them</a>
  <a href="guides/optimisation.php" class="list-group-item"><strong>Optimisation</strong><br />
    Speed, Search ...</a>
  <a href="guides/tools.php" class="list-group-item greyout"><strong>Web Development helpers</strong><br />
    Google page speed, ..., ...</a>
  <a href="guides/cross-platform.php" class="list-group-item greyout"><strong>Cross Platform</strong><br />
    Wrappers, ...</a>
  <a href="guides/designtheory.php" class="list-group-item"><strong>Design Theory</strong><br />
    Typography, ...</a>
  
</div>
<h4>A few extra ones (guides for life?)</h4>
<div class="list-group">
  <a href="guides/inspiration.php" class="list-group-item">Inspiration</a>
</div>
                
<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>