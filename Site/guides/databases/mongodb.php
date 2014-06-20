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
<h3>The mongo shell</h3>
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
				<code>db.collection.find({ "key" : property}, {"key2" : true, "_id" : false})</code>: same as above but only returns the "key2" of matching documents ("_id" is automatically returned unless speciically asked not to).  This is called <strong>Projection</strong> and the easy way to implement it in node is described lower down.
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
				<code>.sort({ "key" : <strong>-1</strong> })</code>: returns with "key" in <strong>descending order</strong>.
			</li>
			<li>
				<code>.sort([ { "key" : -1 }, {"key2" : 1} ])</code>: documents are sorted by "key" then by "key2".  It is placed within an array as objects can be re-ordered before they reach the db (arrays stay cosistant)
			</li>
			<li>
				<code>.limit(5)</code>: shows the first 5 documents
			</li>
			<li>
				<code>.skip(5)</code>: skipps over the first 5 then return the rest
			</li>
		</ul>
		<p>These options can be written with a slightly different format if you prefer:</p>
<pre><code>
var options = { 'skip' : 1,
				'limit' : 1,
				'sort' : [ { "key" : -1 }, {"key2" : 1} ] };
var cursor = collection.find({}, {}, options); 
</code></pre>
<p>Also they should happen in this order: <code>Sort</code>, <code>Skip</code>, <code>Limit</code>: they are automatically ordered if you are using a driver (eg, in node.js)</p>
	</li>
	<li>
		<code>db.collection.findOne()</code>: shows only one, the first one it comes across in the db (essentially random), query in ()
	</li>
	<li>
		<code>db.collection.count()</code>: returns the number of documents found, query in ()
	</li>
</ul>
<p>Most, actually all of the above are about finding documents, now for updating:</p>
<p>The update option will only update the first document it finds matching the supplied query unless given the <strong>$multi</strong> option</p>
<code>.update({ }, { $set : { "Key" : property }}, { <strong>multi : true</strong> })</code>: also, "{ }" acts as a selector that gets every document in the collection
<ul>
	<li>
		<code>db.collection.update( { "queryKey" : property }, { "updatedKey" : property } )</code>: will remove everything in the document (except "_id") and add everything in the second update object.
		<ul>
			<li>
				<code>.update({ "key":property }, { $set : { "Key" : property }})</code>: only updates the "Key" in the $set obj, if the property doesn't exist, it is added, if the object doesn't exist - nothing happens.
			</li>
			<li>
				<code>.update({ "key":property }, { $inc : { "Key" : number }})</code>: increments a number field by 'number', if nonexist, adds a field with property 'number' 
			</li>
			<li>
				<code>.update({ "key":property }, { $unset : { "Key" : anyValue }})</code>: removes only the "Key" defined in the $unset obj, it ignores "anyValue"
			</li>
			<li>
				<code>.update({ "key":property }, { $set : { "Key" : property }, { $upsert : true }})</code>: If the object doesn not exist then it is created with the $set object added.  If the $set objects are underspecified (as in they do not have a concrete value, the document will be created but will not have any of the underspeciried objects)
			</li>
		</ul>
		<p>Updating values in an array:</p>
		<ul>
			<li>
				<code>{$set : {"a[2]" : 5 }}</code>: will set the third array element to 5
			</li>
			<li>
				<code>{$push : { a : 6 }}</code>: will add 6 to the right side of an array
			</li>
			<li>
				<code>{$pop : { a : 1 }}</code>: will remove the right most element <strong>(positive argument)</strong>
			</li>
			<li>
				<code>{$pop : { a : -1 }}</code>: will remove the left most element <strong>(negative argument)</strong>
			</li>
			<li>
				<code>{$pushAll : { a : [ 1, 2, 3 ]}}</code>: will add multiple elements to an array
			</li>
			<li>
				<code>{$pull : { a : 5 }}</code>: removes any element from the array with the value '5'
			</li>
			<li>
				<code>{$pullAll : { a : [ 5, 6, 7 ] }}</code>: removes any element from the array with matching values
			</li>
			<li>
				<code>{$addToSet : { a : 5 }}</code>: in arrays that do not contain multiple instances of one value this adds 5 when there is no other 5 but will do nothing if there already is 
			</li>
		</ul>
	</li>
</ul>
<p>Removing / deleting:</p>
<ul>
	<li>
		<code>db.collection.remove( { } )</code>: will remove every document in the collection, one by one
	</li>
	<li>
		<code>db.collection.drop()</code>: much faster deletion and removed metadata, which remove() doesn't delete
	</li>
</ul>

<h3>Running in node</h3>
<p>In essence everything runs the same way except now functions are added as callbacks so that we might do something with the data.</p>
<ul>
	<li>
		<code>db.collection('collection_name')</code>: gets the collection, more functions can be added to this, it's common to save it as a variable and build up the variable through logic.  MongoDB doesn't actually run any operations until asked to by one of sevoral functions that are given as callbacks
		<ul>
			<li><code>.toArray()</code>Returning the results of a query as an array:
<pre><code><strong>.toArray</strong>(function(err, docs) {
    if (err) throw err;
    console.dir(docs);
    db.close();
});</code></pre>
			</li>
			<li><code>.each()</code>Running though each document:
<pre><code><strong>.each</strong>(function(err, doc) { 
    if(err) throw err;
    if(doc == null) {//meaning we have reached the end of the collection
    	return db.close();
	}
	console.log(doc); prints each doc
});</code></pre>
			<p>The big advantage of this is that if effectivly allows you to stream large amounts of data from the database.  The curser will make sevoral round trips while the call back runs whereas with <code>.toArray</code> the curser will wait until the entire array has been built meaning you will have to wait until all the round trips have been completed.</p>
			</li>
			<li><code>.exec()</code> the function
<pre><code><strong>.exec</strong>(functoin(err, docs){
    if(err) throw err;
    console.log(docs);
});</code></pre>
			</li>
			<li><code>.insert()</code> function (<code>var docToInsert = {"Key":property};</code>)
<pre><code><strong>.insert</strong>(doc, function(err, inserted){
	if(err) console.log(err);
	console.log("Sucessfully inserted: " + inserted);
	return db.close();
});
</code></pre>
			</li>
			<li><code>.update()</code> function 
<pre><code>
var query = { }; //Selects all the documents
var operator = {$unset {"Key":property}}; //removes the key from any documents that have it
var options = {'multi':true} //more than one doc

db.collection('name')<strong>.update</strong>( query, operator, options, function(err,updated){
	if(err) console.log(err);
	console.log("successfully updated: " + updated);
	return db.close();
});
</code></pre>
			</li>
			<li><code>.upsert()</code> option
<pre><code>
var query = { "Key" : property }; //Selects all the documents
var operator = {$set {"Key":property}}; //removes the key from any documents that have it
var options = {'upsert':true} //more than one doc

db.collection('name')<strong>.update</strong>( query, operator, options, function(err,updated){
	if(err) console.log(err);
	console.log("successfully updated: " + updated);
	return db.close();
});
</code></pre>
<p>In this case if the query finds no doc then the query doc is added and then the operator applied, if it does exist then it is updated</p>
			</li>
			<li><code>.save()</code> function: inside a .findOne()/.each() callback, edit the returned doc and add it here:
<pre><code><strong>.save</strong>(doc, functoin(err, docs){
    if(err) throw err;
    console.log(docs);
});</code></pre>
			</li>
			<li><code>.findAndModify</code>: finds a document and updates it atomically, we can specify wither we want the new or old version
<pre><code>var sort = []; //findAndModify only affects 1 document, if the query isn't specific enough the sort gives us extra control
var operator = { '$inc' : { 'counter' : 1 }};
var options = { 'new' : true };

<strong>.findAndModify</strong>(query, sort, operator, options, function(err, doc){
	if(err) console.log(err);
	if(!doc){
        console.log("No doc found");
    } else {
        console.log("counter: " + doc.counter);
    }
    return db.clode();
});
</code></pre>
			</li>
			<li><code>.remove(query, function(err, noRemoved){ ... });</code>: will delete all docs that match the query
			</li>
		</ul>
		<p>Or a callback function call can be added instead of the inline function:</p>
		<ul>
			<li>
<pre><code>function callback(err, doc) {
	if(err) throw err;
	console.dir(doc);
	db.close();
}
db.collection('name').findOne({"key":property},callback);</code></pre>
			</li>
		</ul>
	</li>
</ul>
<p><strong>Projection</strong> allows us to specify which elements from each document we want to see or not see, again the "_id" field is special in that is it not automatically projected out.</p>
<pre><code>var query = {"key":property};
var projection = <strong>{"Key1":1,"_id":0}</strong>;
db.collection('name').find(query,<strong>projection</strong>)... </code></pre><br />
<p>Note, the second field of find can also be the callback, if you are looking to run a query, projection, and callback put them in this order.</p>

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
<h3>Database Design</h3>


<hr />
Sources:
<ul>
	<li>
		A collection of free cources: <a href="https://university.mongodb.com/">Mongo University</a>
	</li>
</ul>
<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>