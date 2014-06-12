<?php $iainPageTitle = 'Webservers'; $docDepth = 1;?>
<?php include '../partials/head.php'; ?>

<?php $breadcrumbAddress = (ltrim($homePath,'"')) . 'partials/breadcrumbs.php'; ?>
<?php include $breadcrumbAddress; ?>

<div class="row">
    <div class="col-md-6">
        <p>
            I'm focusing on the software here, not the hardware - that'll be a few years down the road!  With my development roots in WordPress I was using Apache but never really interacting with it.  The first server software I really worked with was NodeJS and it's been pretty great!  Nginx is on the horizon, I'll hopefully get into that once Node is solid. 
        </p>
    </div> <!-- END 6 column for text -->
</div> <!-- END intro row -->
<h4>Virtual private: cheap, moderate to scale</h4>
<h4>Dedicated: pricy, slow to scale</h4>
<h4>Cloud, v pricey, v quick to scale</h4>
<div class="list-group">
  <a href="#" class="list-group-item greyout">AWS (ec2)</a>
  <a href="#" class="list-group-item greyout">rackspace</a>
  <a href="#" class="list-group-item greyout">Azure</a>
</div>
<div class="list-group">
  <a href="webservers/node.php" class="list-group-item"><strong>NodeJS</strong><br />
  A c++ application that you controll with v8 Javascript, this means your front-end and AND your back-end are written in Javascript!</a>
  <a href="#" class="list-group-item greyout">Apache</a>
  <a href="#" class="list-group-item greyout">IIS</a>
  <a href="#" class="list-group-item greyout">Nginx: fast for static files</a>
  <!-- <a href="guides/webservers.php" class="list-group-item">NodeJS</a>
  <a href="guides/frameworks.php" class="list-group-item">Apache</a>
  <a href="guides/cms.php" class="list-group-item">Nginx</a> -->
</div>
<p>Node behind Nginx: Nginx deals with mass static, anything interactive it passes to node.</p>
                
<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>