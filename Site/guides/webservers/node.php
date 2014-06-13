<?php $iainPageTitle = 'NodeJS'; $docDepth = 2;?>
<?php include '../../partials/head.php'; ?>

<?php $breadcrumbAddress = (ltrim($homePath,'"')) . 'partials/breadcrumbs.php'; ?>
<?php include $breadcrumbAddress; ?>

<p>Hello world in NodeJS</p>
<pre><code>var http = require('http');
var server = http.createServer(function(req, res){
	res.writeHead(200, {"content-type":"text/plain"});
	res.end("Hello world");
});

server.listen(8000);

console.log("Server listening at http://localhost:8000");
</code></pre>

<h4>Deployment</h4>
<p>Cloud hosting: Heroku, nodejitsu, VMware's cloud foundry, azure for node, cloud 9</p>
<p>github.com/substack/fleet, capistrano, nodejitsu's forever, <br />
	upstart.ubuntu.com, upstart.ubuntu.com/cookbook - for restarting after crashes and logging it</p>
	<p>Cluster API to use multiple cores rather than one</p>


<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>