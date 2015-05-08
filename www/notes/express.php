<?php $iainPageTitle = 'Proximity API'; $docDepth = 1;?>
<?php include '../partials/head.php'; ?>

<p>When a request occurs, it starts at 'var app = express();' and runs through every module listed in the app.js file.  
Each method passes it on and may/may not use it.  This continues until we pass something back to the user.</p>


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

C:\ProgramData\chocolatey\bin;c:\Users\IJ\AppData\Local\atom\bin;C:\Users\IJ\AppData\Local\atom\bin;C:\Users\IJ\AppData\Roaming\npm;C:\Python34