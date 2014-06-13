<?php $iainPageTitle = 'Mongo DB'; $docDepth = 2;?>
<?php include '../../partials/head.php'; ?>

<?php $breadcrumbAddress = (ltrim($homePath,'"')) . 'partials/breadcrumbs.php'; ?>
<?php include $breadcrumbAddress; ?>

<p>This is a database that aims to scale well horizontally without loosing out on any functionality. </p>
<p>Does not support joins or transactions across multiple collections.</p>
<strong>Schemaless</strong>: Say you have your database set up but one of those documents (or records) needs an extra piece of data stored.  In a relational db the table structure would have ot be altered.  With Mongodb, because each document can have a different schema, the data can be added to that single document without affecting any others. 
<hr />
<p>Hello world (<code>mongod</code> must be running)</p>
<pre><code>var mongoClient = require("mongodb").MongoClient;

mongoClient.connect("mongodb://localhost:27017/test", function(err, db) {
	if (err) throw err;

	db.collection("coll").findOne({}, function(err, doc) {
		if (err) throw err;

		console.dir(doc);

		db.close();
	});

	console.log("Called findOne!")
});
</code></pre>


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
		<code>.insert({ "key" : property, "key2" : property, "key3" : [{ "key3.1" : property }] })</code>: nesting
	</li>
	<li>
		<code>db.collection.find()</code>: shows all the documents in the collection
		<ul>
			<li>
				<code>db.collection.find().pretty()</code>: does exactly what it says on the tin!
			</li>
			<li>
				<code>db.collection.find({ "key" : property })</code>: shows all the documents with a "key" == 'property'
			</li>
			<li>
				<code>db.collection.find({ "key" : property}, {"key2" : true, "_id" : false})</code>: same as above but only returns the "key2" of matching documents ("_id" is automatically returned unless speciically asked not to).
			</li>
			<li>
				<code>db.collection.find( "key" : { $gt : 50 } })</code>: find operator, returns documents with a "key" greater than 50
			</li>
			<li>
				<code>db.collection.find( "key" : { $gt : 50, $lte : 100 } })</code>: multiple constraints
			</li>
			<ul>
				<p>Operators:</p>
				<li><code>$gt</code>: greater than (numbers / strings)</li>
				<li><code>$gte</code>: greater than or equal</li>
				<li><code>$lt</code>: less than</li>
				<li><code>$lte</code>: less than or equal</li>
				<li><code>$exists</code>: if the document has this key (boolean)</li>
				<li><code>$type</code>1 = double 
							| 2 = string 
							| 3 = object 
							| 4 = array 
							| 5 = binary data 
							| 6 = undefined (depreciated) 
							| 7 = object id 
							| 8 = Boolean
							| 9 = date
							| 10 = null
							| <a href="http://docs.mongodb.org/manual/reference/operator/query/type/">...</a>
				</li>
				<li><code>$regex : "a"</code>: query for "a" somewhere in a string</li>
				<li><code>$regex : "e$"</code>: query for strings ending in "e"</li>
				<li><code>$regex : "^A"</code>:query for strings beginning in "A"</li>
			</ul>
			<li>
				<code>db.collection.find({$or : [ {"Key": property}, {"Key":property} ] })</code>:documents matching one or the other, $or is placed before, the options are an array
			</li>
			<li>
				<code>db.collection.find({$and : [ {"Key": property}, {"Key":property} ] })</code>: same as above but rare - most cases can just have multiple queries applied to the same field
			</li>
			<li>
				<code>db.collection.find({ "Key" : {$in : [property1, property2]} })</code>: documents that have either property
			</li>
			<li>
				<code>db.collection.find({ "Key" : {$all : [property1, property2]} })</code>: documents that have both properties (in an array)
			</li>
			<li>
				<code>db.collection.find({ "Key.embeddedKey" : property})</code>: querying inside nested documents
			</li>
		</ul>
	</li>
	<li>
		<code>var cur = db.collection.find()</code>: holds a curser which can be manipulated either by modifying the query by tacking on methods:
		<ul>
			<li>
				<code>.hasNext()</code>: boolean indicating if there is another matching document
			</li>
			<li>
				<code>.next()</code>: returns the next matching document
			</li>
			<li>
				<code>.sort({ "key" : -1 })</code>: returns with "key" in reverse order
			</li>
			<li>
				<code>.limit(5)</code>: shows the first 5 documents
			</li>
			<li>
				<code>.skip(5)</code>: skipps over the first 5 then return the rest
			</li>
		</ul>
	</li>

	<li>
		<code>db.collection.findOne()</code>: shows only one, the first one it comes across in the db (essentially random)
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
	"dictionary" : {
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