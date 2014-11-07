<?php $iainPageTitle = 'Proximity API'; $docDepth = 1;?>
<?php include '../partials/head.php'; ?>




<p>Hello world</p>
<pre><code>var express = require("express"),
	app = express();

app.get ("/", function(req, res) {
	res.send("Hello world");
});
app.get ("*", function(req, res) {
	res.send("Page not found", 404);
});

app.listen(8080);
console.log("Server listening on localhost://8080");
</code></pre>

<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>