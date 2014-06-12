<?php $iainPageTitle = 'Mongo DB'; $docDepth = 2;?>
<?php include '../../partials/head.php'; ?>

<?php $breadcrumbAddress = (ltrim($homePath,'"')) . 'partials/breadcrumbs.php'; ?>
<?php include $breadcrumbAddress; ?>

<p>This is a database that aims to scale well horizontally without loosing out on any functionality. </p>
<p>Does not support joins or transactions across multiple collections.</p>

<hr />
<h4>The mongo shell</h4>
<p>Like NodeJS, this is just a c++ application that you controll using V8 Javascript.</p>
<p>Some of the most common commands I've been using:</p>
<ul>
	<li>
		<code>mongo</code>: starts the shell
	</li>
	<li>
		<code>show dbs</code>: Shows the databases
	</li>
	<li>
		<code>use (db name)</code>: switches to one of the databases, note: the database doesn't actually have to exist for you to switch to it.
	</li>
	<li>
		<code>show collections</code>: shows the collections in the current db
	</li>
	<li>
		<code>db.(collection name).insert({ "key" : property })</code><br />
		Inserts documents into the named collection.  If you are in a db that doesn't exist yet or specify a colleciton that doens't exist yet either - no problem, they will be automatically created with this command! 
	</li>
	<li>
		<code>db.collection.find()</code>: shows all the documents in the collection
	</li>
	<li>
		<code>db.collection.find().pretty()</code>: does exactly what it says on the tin!
	</li>
	<li>
		<code>db.collection.find({ "key" : property })</code>: shows all the documents with a "key" == 'property'
	</li>
	<li>
		<code>db.collection.find().limit(5)</code>: shows the first 5 documents
	</li>
	<li>
		<code>db.collection.fincOne()</code>: shows only one, the first one it comes across in the db
	</li>
	<li>
		<code>.insert({ "key" : property, "key2" : property, "key3" : [{ "key3.1" : property }] })</code>: nesting
	</li>
</ul>

<p>Value types: 
<pre><code>{
	"string" : "hello",
	"boolean" : true,
	"numeric" : 1,
	"array" : [
		"value",
		"value",
		"value"
	],
	"nested-object" : {
		"key" : property,
		"key" : property,
		"key" : property
	}
}
</pre></code></p>

<hr />
Sources:
<ul>
	<li>
		A collection of free cources: <a href="https://university.mongodb.com/">Mongo University</a>
	</li>
</ul>
<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>