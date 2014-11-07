<?php $iainPageTitle = 'Jade'; $docDepth = 1;?>
<?php include '../partials/head.php'; ?>

<?php $breadcrumbAddress = (ltrim($homePath,'"')) . 'partials/breadcrumbs.php'; ?>
<?php include $breadcrumbAddress; ?>

<h3>A simple NodeJS, ExpressJS app using Jade</h3>
<p>The main encapsulation of the process, app.js in the root of the project:</p>
<pre><code>
var mongoose = require('mongoose');
var express = require('express');
var routes = require('./routes'); //Node will look for a 'routes' directory and within that it will look for an index
	
mongoose.connect('mongodb://localhost', function (err) {
	if (err) throw err;

	var app = express();
	routes(app);

	app.listen(3000, function(){
		console.log('now listening on http://localhost:3000')
	});
});</code></pre>

<p>routes/index.js</p>
<pre><code>
module.exports = function(app) {

	app.get('/', function(req, res){
		res.render("home.jade"); //the first apperance of jade, node will look for a 'views' directory and within that 'home.jade'
	});	

};
</code></pre>

<p>views/home.jade</p>
<pre><code>
extends layout //this referres to another file: layout.jade in which there is a content block ready for the contents of this file

block content
	if !(posts && posts.length)
		p nothing to see here
	else
		ul.posts
			each post in posts
				li
					h2
						a(href="post/#{post.id}")= post.title
</code></pre>

<p>views/layout.jade</p>
<pre><code>
html5
html
	head
		title= pageTitle
	body
		header
			h1= pageTitle
		section.content
			block content
</code></pre>


<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>