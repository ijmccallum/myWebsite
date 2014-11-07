<?php $iainPageTitle = 'Databases'; $docDepth = 1;?>
<?php include '../partials/head.php'; ?>



<div class="row">
    <div class="col-md-6">
        <p>
            MySQL has always been there through my WordPress involvement but I've been getting deeper into the land of Mongo through Node development projects.  As the WikiLogic project progresses databases are going to come increasingly into my focus so this will be an interesting space to watch!  Also, I like the look of a Flat File system but haven't yet had the chance to work with one.
        </p>
        <p>
        	Normal and Session
        </p>
    </div> <!-- END 6 column for text -->
</div> <!-- END intro row -->
<h4>NoSQL Databases</h4>
<p>Dealing with large amounts of data, so much that it can't comfortably fit on one server? Then NoSQL over a cluster.  Or for easier development depending on the data models.</p>
<div class="list-group">
  <a href="databases/mongodb.php" class="list-group-item"><strong>MongoDB</strong><br />
    For horizontal scaling with good functionality</a>
  <a href="#" class="list-group-item greyout">CouchDB</a>
  <a href="#" class="list-group-item greyout">Memcached</a>
  <a href="#" class="list-group-item greyout">Redis - for user sessions</a>
</div>
<h4>Relational Databases</h4>
<div class="list-group">
  <a href="#" class="list-group-item greyout">MySQL</a>
  <a href="#" class="list-group-item greyout">PostgreSQL</a>
</div>
<h4>Others</h4>
<div class="list-group">
  <a href="#" class="list-group-item greyout">Flat File</a>
</div>
<hr />
<p><strong>Foreign Key constraints</strong>: </p>
<p><strong>Transactions:</strong> </p>
                
<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>