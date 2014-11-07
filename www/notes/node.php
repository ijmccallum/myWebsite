<?php $iainPageTitle = 'NodeJS'; $docDepth = 1;?>
<?php include '../partials/head.php'; ?>


<hr />
<h3>Setting up a new NodeJS project</h3>
<p><code>npm init</code>: in the command line will take you through the creationg of a 
	package.json file.  You can hit enter to run through with the defaults (easy to come 
	back and change later).  Also, in the sceond line (after name) it's a good idea to a
	dd <code>"private" : true,</code> as this will stop us from publishing back to npm.  Finally, when installing npm packages, like express: <code>npm install express --save</code> (the save adds exoress to your package.json file)</p>

<h3>A simple NodeJS app using ExpressJS and Jade</h3>
<pre>app.js
|
|_routes
| |_index.js
|
|_views
  |_layout.jade
  |_home.jade
</pre>
<p>The main encapsulation of the process in the root of the project:</p>
<pre><code><strong>[app.js]</strong>
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
<pre><code><strong>[routes/index.js]</strong>
module.exports = function(app) {

	app.get('/', function(req, res){
		res.render("home.jade"); //the first apperance of jade, node will look for a 'views' directory and within that 'home.jade'
	});	

};
</code></pre>

<p>views/home.jade</p>
<pre><code><strong>[views/home.jade]</strong>
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
<pre><code><strong>[views/layout.jade]</strong>
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

<hr />
<h3>Error handeling</h3>
<p>In app.js include the errors.js file: <code>var errors = require('./errors');</code> 
	Then after the routes are defined add this line: <code>errors(app);</code></p>
<p>In errors.js:
<pre><code>module.exports = function(app) {

	//for 404's when express can't match any of the routes it gets to here
	app.use(function(req, res, next){
		res.status(404);
		if (req.accepts('html'){
			return res.send('<h2>404: no page</h2>');
		});
		if (req.accepts('json'){
			return res.json({ error : 'Not found' });
		});
		res.type('txt');
		res.send('no page');
	});

	//for errors (500) express expects specific syntax(4 inputs meaning this is an error handler):
	app.use(function(err,req,res,next){
		console.error('error at %s/n', req.url, err);
		res.send(500, "oops");
	});

};</code></pre></p>

<hr />
<h3>Middleware</h3>
<p>this is logic that is preformed before the routes are handled, a great place for logic which will 
	be used by many different routes.  Usually placed in a <strong>/middleware</strong> directory and 
	within that, a <code>index.js</code> file:
<pre><code>var express = require('express');

module.exports = function(app){
	app.use(express.logger('dev')); //this is how you define middleware (app.use(...))

	app.use(express.bodyParser());  //bodyParser (has to be required individually now) parses incoming form data into objects

	app.use(function(req,res,next){
		...
		res.locals = ... //.locals is an object that can be accessed from the views
		next();
	});
};
</code></pre>
</p>

<hr />
<h3>Some great modules:</h3>
<strong>Request</strong>: for making requests to other websites


<h4>Deployment</h4>
<p>Cloud hosting: Heroku, nodejitsu, VMware's cloud foundry, azure for node, cloud 9</p>
<p>github.com/substack/fleet, capistrano, nodejitsu's forever, <br />
	upstart.ubuntu.com, upstart.ubuntu.com/cookbook - for restarting after crashes and logging it</p>
	<p>Cluster API to use multiple cores rather than one</p>


<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>