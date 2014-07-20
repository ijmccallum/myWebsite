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
<h3>MongoDB JSON documents</h3>
<p>note: <code>_id</code> keys have to be unique, they are usually a scaler value but can also be complex documents</p>
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
				<li><code>$in</code>: <code>{ field: { $in: [value1, value2, ... valueN ] } }</code></li>
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
	<li>
		<code>.explain()</code>: appended to the end of a query, it will return information on the operation preformed and not the actual documents.
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
<p><strong>Foreign Key constraints:</strong> Mongo DB Doesn't (currently) support these, </p>
<p><strong>Transactions:</strong> Again Mongo doesn't support transactions but it does have <strong>Atomic operations</strong>.  
	That means that any operation is guarenteed not to find a single document that is half way updated but may find a collection 
	which is half way through a series of document updates.  No errors but possible inconsistancy.  Generally speaking, in most 
	systems this is not a critical issues and so we tollerate it.  In those systems in which is is critical, we will have to 
	implement extra software to deal with the challenge in a relevant way.</p>

<hr />
<h3>Database preformance</h3>
To check how your db is preforming you can set the log output to show slow queries:<br />
When starting in the shell: <code>mongod --profile 1 --slowms 2</code> this will log any querie that takes more than 2ms.<br />
<code>--profile 0</code>: doesn't log any queries<br />
<code>--profile 1</code>: loggs slow queries<br />
<code>--profile 2</code>: loggs all queries.<br />
<br />
<code>db.getProfilingLevel()</code>: returns the level to which the db is set<br />
<code>db.getProfilingStatus()</code>: More details on the profiling set up<br />
<code>db.setProfilingLevel(1,4)</code>: sets the profiling status (--profile 1 --slowms 4)<br />
<br />
Searching the log: <code>db.system.profile.find().pretty()</code> will output some useful info.  This is a capped collection.<br />
<code>db.system.profile.find({"millis":{$gt:1000}}).sort(ts:-1)</code><br />
<br />
<code>mongotop</code>: a good profiling tool - shows how much time the database spends reading/writing by collection.  runs in intervals/<br />
<code>mongostat</code>: gives a more system level read on how your db is preforming 
<br />
<ul>
	<li>
		Index: <code>db.collection.ensureIndex({"key":1})</code>, creates and ascending index on "key"
	</li>
	<li>
		Compound Indexs: <code>db.collection.ensureIndex({"key":1, "Key2":-1})</code>, creates and ascending index on "key" and descending on "key2"
	</li>
	<li>
		Indexs on arrays: yep, but only one - mongoDB does not support compound indexes on prarllel arrays.  As in, one object with two arrays in two elements that are compound indexes
	</li>
	<li>
		Finding indexes: <code>db.system.indexes.find()</code>
	</li>
	<li>
		Finding indexes in a collection: <code>db.students.getIndexes()</code>
	</li>
	<li>
		Delete an index: <code>db.collection.dropIndex({"key":1})</code>
	</li>
	<li>
		<strong>Ascending vs decending</strong>: doesn't really make a difference when searching but does when sorting.
	</li>
	<li>
		<strong>Unique indexes</strong>: <code>db.collection.ensureIndex({"key":1},{"unique":true})</code>
	</li>
	<li>
		<strong>Drop duplicate indexes</strong>: <code>db.collection.ensureIndex({"key":1},{"unique":true, "dropDups":true})</code>: no way to control which records it removes but you will end up without any duplicates!
	</li>
	<li>
		<strong>Sparse indexes</strong>: when not all documents have a certain key they are considered to have that key value as <code>null</code>, therefor <code>duplicate index</code>.  Sparse indexes only create entries on documents with the specified key value.<br />
		<code>db.collection.ensureIndex({"key":1},{"unique":true, "sparse":true})</code><br />
		For sorting it will not use the index.  If we specify the index it will only return docs that have the index:<br />
		<code>db.collection.find().sort({"key":1}).hint({"key":1})</code>: forces mongo to use the index, non indexed documents not returned
	</li>
	<li>
		<code>db.collection.find().sort({"key":1}).hint({$natural:1})</code>: if there is an index that would normally be used this will set it back to use the basic curser<br />
		Running in node: <code>db.collection('name').find({"key":value},{},{$hint:{"key":1}})</code>
	</li>
	<li>
		Running in the <strong>Foreground</strong> or the <strong>Background</strong>: Making indexes in the foreground, blocks other writers, fast.  Opposit for the opposite! (background).  It ir recommended that databases are run in replica sets for a production env so when creating an index one can be pulled and index creation run in the foreground.
	</li>
	<li>
		<strong>How big is an index:</strong> <code>db.collection.totalIndexSize()</code>: gives you the size in bites.
	</li>
</ul>
<hr />
<h3>Geospatial indexes, (2d)</h3>
<code>"location":[x,y]</code>: a key with an array of 2 numbers (location on a cartesian plane)<br />
<code>ensureIndex({"location":"2d"})</code>: creates a geospatial index<br />
<code>find({"location":{$near:[x,y]}}).limit(20)</code>: will return other objects in order of increasing distance <br />
<code>db.stores.find({"loc":{$near:{$geometry:{"type":"Point", "coordinates":[-130,39]}, $maxDistance:1000000}}})</code>: finding from a geosphere!
<hr />
<h3>Full text search</h3>
<code>db.collection.ensureIndex({"key":"text"})</code>: creates an index of type 'text'.<br />
<code>db.collection.find({$text:{$search:"word"}})</code>: searches the indexed text<br />
<br />
<code>db.collection.find({$text:{$search:"word"}}, {score:{$meta:'textScore'}}).sort({score:{$meta:'textScore'}})</code>: for interest, will create a meta field based on the relevance of the document's text to the search term then orders them by that score
<hr />
<h3>The aggregation framework</h3>
<p>Aggregate expressions: (working on specific keys)</p>
<ul>
	<li>
		<code>$sum</code><br />
		<p>eg: <code>... { _id:{"maker":"$manufacturer"}, sum_prices:{<strong>$sum:"$price"</strong>} }...</code><br />
		will create <code>{_id:"maker","sum_prices":<strong>Total value</strong>}</code></p>
	</li>
	<li>
		<code>$avg</code><br />
		Same format as <code>$sum</code>
	</li>
	<li>
		<code>$min</code><br />
		Same format as <code>$sum</code>
	</li>
	<li>
		<code>$max</code><br />
		Same format as <code>$sum</code>
	</li>
	<li>
		<code>$push</code>: builds an array<br />
		Same format as <code>$sum</code>
	</li>
	<li>
		<code>$addToSet</code>: builds an array uniquley<br />
		Same format as <code>$sum</code>
	</li>
	<li><code>$first</code> & <code>$last</code>: requires a sort, returns the first / last value in a $group operation</li>
</ul>
<p>An example counting the number of products that every company has in a db:</p>
<pre><code>
//creates a results set of all the documents with a "manufacturer" field, that field becomes the _id, if another original doc is found with the same manufacturer, 1 is added to the "num_products" field in the results set document.
db.products.aggregate([{
	$group:{
		_id:"$manufacturer",
		num_products:{$sum:1}
    }
}])
</code></pre>
<p>An example using <strong>compound grouping</strong>:</p>
<pre><code>
//every document with a different combination of the listed keys will create a new document in the result set
db.products.aggregate([{
	$group:{
		_id:{
			"key1":"$key1",
			"key2":"$key2"
	    },
	    num_products:{$sum:1}
    }
}])
</code></pre>	
<p>The commands happen in a pipeline, each stage can be used more than once and in various orders:<br />
	<ul>
		<li>
			<strong>$project</strong> (Reshaping the documents that move through, one in one out)<br />
			<code>$toUpper</code> <code>$toLower</code> <code>$add</code> <code>$multiply</code></li>
<pre><code>db.collection.aggregate([{
	$project:{
	    "_id":0, //do not include this field
	    "newKey": {$toLower:"$originalKey"}, //originalKey to lower case and named as newKey
	    "newKey2": {
	    	"newKey3": "$oldKey",
	    	"newKey4": {$multiply:["$oldKey2", 10]} //multiplys the oldKey2 value by 10 and adds under newKey4
	    },
	    "newKey5":"$oldKey3"
    }
}])
</code></pre>
		</li>
		<li>
			<strong>$match</strong> (flitering for matches)<br />
			<code>$gte</code> <code>$gt</code> <code>$lt</code> <code>$lte</code> <code>$ne</code> <code>$in</code>
<pre><code>db.collection.aggregate([{
	$match:{
		"pop":{ $gte : 25000 },
		$or:[{"_id.state":"CA"},{"_id.state":"NY"}]
	} 
}])
</code></pre>
		</li>
		<li>
			<strong>$group</strong> groups the results by the given keys as per the examples above.</br >
			<code>$sum</code> <code>$avg</code> <code>$min</code> <code>$max</code> <code>$push</code> <code>$addToSet</code> <code>$first</code> <code>$last</code>
<pre><code>db.collection.aggregate([{
	$group:{
	    _id: ... , //Can be just a "$field" or {"name":"$field"} or {"name":"$field","name2":"$field2"...}
	    key: ... //Some kind of operation or just a value
    }
}])
</code></pre>
		</li>
		<li>
			<strong>$sort</strong>
		</li>
		<li>
			<strong>$skip</strong>
		</li>
		<li>
			<strong>$limit</strong>
		</li>
		<li>
			<strong>$unwind </strong>(normalises the data, flattens arrays held within keys), eg:<br />
<code>{"key":"a","array":[1,2,3]}</code> Would become:<br />
<pre><code>"key":"a","array":"1",
"key":"a","array":"2",
"key":"a","array":"3",
</code></pre>
		</li>
		<li>
			<strong>$out</strong> (specifies another collection to take the data if that's where it's going)
		</li>
		<li>
			<strong>$redact</strong>
		</li>
		<li>
			<strong>$geonear</strong>
		</li>
	</ul>
<p>You can use each stage in the pipeline more than once, the second stage will act on the result set of the first stage.</p>
<p>The stages of the aggregation pipeline are limited to 100mb by default, if a query requires more than that then it will not return.  To get around this we much <code>allowDiskUse</code>.  Also, for <strong>Sharded</strong> set ups, <code>$group</code> and <code>$sort</code> are sent to the primary shard to be processes as all the data needs to be in one place so preformance might not be what was expected.  An alternative to use might be Hadoop.</p>
<hr />


<h3>Replica sets</h3>
<p>For each replica set: 1 primary and 2 or more secondaries.<br />
	The app communicates with the primary<br />
	if a primary goes down, the secondaries elect a new primary.<br />
	A node can have more than 1 vote but that's unusual.<br />
	Writes cannot happen during an election (usually lasts about 3 seconds)<br />
	<br />
	Writes have to go to the primary, reads don't.  But, if you read from a secondary you may get stale data.<br />

</p>
<p>Types of secondary nodes in a replica set:<br />
<ul>
	<li>
		<strong>Regular node</strong>: normal, can be a primary or a secondary
	</li>
	<li>
		<strong>Arbiter node</strong>: just there for voting, makes sure there is a strict majority if you have an even number of nodes, has no data.
	</li>
	<li>
		<strong>Delayed regular node</strong>: can be set to be an hour or two behind the others, in case of disaster.  Can vote but can't become <br />
		<code>p=0</code>: priority = 0 (you can set any node priority to 0)
	</li>
	<li>
		<strong>Hidden node</strong>: Can't be primary, can vote, <code>p=0</code>
	</li>
</ul>
</p>

<p>Creating a replica set (in a javascript file)
<pre><code>config = { _id: "rs1", members: [
    { _id: 0, host: "computer.local:27017", priority: 0, slaveDelay: 5 },
    { _id: 1, host: "computer.local:27017"},
    { _id: 2, host: "computer.local:27017"}
]}

rs.initiate(config)
rs.status()
</code></pre>
Then in the shell: <code>mongo --port 27018 &gt; javascriptFile.js</code> (you cannot initialise a replica set on the port of one that cannot become primary as in this example with 27017)
<br />
Now we can connect <code>mongo --port 21018</code> and we may get a secondary or a primary!<br />
From here (while conected to the primary) we can run operations as normal.<br />
To query secondary nodes: <code>rs.slaveOk()</code> Without slaveOk() we will get an error which looks like this: <code>error: { "$err" : "not master and slaveOk=false", code : "13435" }</code>
</p>
<ul>
	<li>
		<code>rs.status()</code>: gives us the status of the replica set
	</li>
	<li>
		<code>rs.slaveOk()</code>: lets us write to a secondary node when we are connected to one
	</li>
	<li>
		<code>re.isMaster</code>: lets us know if we are on the primary
	</li>
	<li>
		<code>db.shutdownServer()</code>: shuts down the server
	</li>
</ul>
To start up a node within a replica set:<br />
<code>mongod port-- 30001 --replSet replica_set_name --dbpath /data/db/rs1</code><br />
<code>mongod port-- 30002 --replSet replica_set_name --dbpath /data/db/rs2</code> and so on<br />
<code>mongo localhost:30001</code> to connect<br />
<code> &gt; rs.initiate()</code> to start the replica set, will give a value in "me" which you use in the next command<br />
<code> &gt; rs.add("name.local:30001")</code><br />
<code> &gt; rs.add("name.local:30002")</code> and so on<br />
Now to <strong>Connect NodeJS to a replica set</strong>:<br />
<pre><code>var MongoClient = require('mongodb').MongoClient;
MongoClient.connect=("mongodb://localhost:30001,localhost:30001, and so on, localhost:3000n/dbname", function(err, db) {
	//continue as usual
	db.collection( ...

	//<strong>Note: you only actually have to give one member of the set above, if it is up the driver will find the rest</strong>
});
</code></pre>


<br />
Things to know about replica sets from an app development perspective
<ul>
	<li>
		<strong>Seed lists</strong>: the drivers must know about at least 1 node within the seed list in order to connect to a new primary after failover
	</li>
	<li>
		<strong>Write concern</strong>: wait for a number of  nodes to acnowladge your writes through the <code>w</code> paramater.<br />
		the <code>j</code> paramater lets you wait or not wait for the primary node to acnowladge a write<br />
		<code>w1</code> / <code>wt</code>? w timeout paramater
	</li>
	<li>
		<strong>Read prefrences</strong>: whither you want to read from your primary (normal) or your secondaries
	</li>
	<li>
		<strong>Errors happen</strong>, be ready!
	</li>
</ul>
<p>Replica sets are updated through the opLog: <code>db.oplog.rs.find().pretty()</code> will give you the records of what data has been replicated.</p>
<p><strong>Rollback</strong>: data is written to the primary which then fails before being able to replicate to the secondaries.  
	A new primary is elected.  The original primary comes back with data that hasn't been written to the new primary, 
	it rollsback and logs the data to a seporate file that is not part of the data set.<br />
	If a node goes down for long enough for the <code>oplog</code> to loop, it will copy the primary's entire data set (slow but it works)<br />
<strong>To avoid rollback</strong> set the <code>w</code> (write concern) to a majority and it will make it very unlikley.<br />
<br />
When NodeJS is connected via the mongo driver and the primary node of the replica set fails, the driver will buffer reads & writes until the election has happened.</p>
<p><strong>Write concern</strong>
<ul>
	<li>
		<code>w:0</code>: the driver will call the callback immidiatly without waiting for a response (for very high throughout things of low value)
	</li>
	<li>
		<code>w:1</code>: waits for only the primary to respond with success
	</li>
	<li>
		<code>w:2</code>: waits for the primary and 1 secondary
	</li>
	<li>
		<code>w:...</code>: you can specify as many as you like (if you specify more than you have, the driver will wait forever)
	</li>
	<li>
		<code>w:j</code>: write to the primary's journal, this makes sure the write has persisted to disk before returning
	</li>
	<li>
		<code>w:majority</code>: waits until the majority of nodes have been written to
	</li>
</ul>
<strong>Using write concern in NodeJS with the mongo driver</strong>:
<pre><code>var MongoClient = require('mongodb').MongoClient;
MongoClient.connect=("mongodb://localhost:30001,localhost:30001, and so on, localhost:3000n/dbname<strong>?w=1</strong>", function(err, db) {

	if (err) { throw err; }
	//defaults to a write concern of 1, the primary (as specified above in the connection)
	db.collection("name").insert({ 'x' : 1 }, function(err,doc){
		if (err) { throw err; }
		console.log(doc);

		//setting the write concern to 2
		db.collection("name").insert({ 'x' : 2 }, <strong>{ 'w' : 2 }</strong>, function(err,doc){
			if (err) { throw err; }
			console.log(doc);
			db.close();
		});
	});

});
</code></pre>
</p>
<p><strong>Setting read prefrence</strong>: which node you would like to read from if not the primary<br />
	You can set a preffered type of node which the driver will try to read from unless it is not available in which case it will move onto the next node
<ul>
	<li>
		<strong>Primary</strong>
	</li>
	<li>
		<strong>Secondary</strong>
	</li>
	<li>
		<strong>nearest</strong>
	</li>
	<li>
		<strong>Tagged</strong>
	</li>
</ul>
<pre><code>var MongoClient = require('mongodb').MongoClient,
	<strong>ReadPrefrence = require('mongodb').ReadPrefrence;</strong>

MongoClient.connect=("mongodb://localhost:30001,localhost:30001, and so on, localhost:3000n/dbname<strong>?readPrefrence=secondary</strong>", function(err, db) {

	if (err) { throw err; }
	//defaults to reading from a secondary
	db.collection("name").find({ 'x' : 1 }, function(err,doc){
		if (err) { throw err; }
		console.log(doc);

		//setting the readPrefrence to primary
		db.collection("name").find({ 'x' : 2 }, <strong>{ 'readPrefrence' : ReadPrefrence.PRIMARY }</strong>, function(err,doc){
			if (err) { throw err; }
			console.log(doc);
			db.close();
		});
	});

});
</code></pre>
</p>
<p><strong>Network errors</strong>: occasionally your system may preform a write but the response is lost in some kind of network problem. This gives you an error but the write was actually completed.</p>


<hr />
<h3>Sharding</h3>
The database gets split by a <strong>shard key</strong> (can be compound).  So, choose a key like student_id and different ranges of those 
documents will get placed on different <code>mongod</code>'s.  Your application will talk to a <code>mongos</code> which 
routes requests to the correct <code>mongod</code>.  To do this it needs the full shard key. Also, each <code>mongod</code> is 
recommended to be a <strong>replica set</strong> of 3 so if one or two in that set go down, your data is still accessable and (more importantly)
not lost.<br />
<p><strong>The shard key</strong>: an element of each object used to split the collection into chunks.<br />
It is required in order to preform an insert<br />
It is not required to do a find but without it the request will be scattered to all the servers.<br />
Once set it cannot be changed - think carefully about what you are going to use as a key.<br />
The shard key must be indexed, and it will not take a multi key index<br />
You <strong>cannot have a unique index unless it is the shard key</strong>, this is because there is no way for the shard to know whither the index is actually in fact unique</p>
<p>Currently collections that are not sharded will live on shard 0, this may change in the future.</p>
<p><strong>Sharding config servers</strong> must also be up and running - they are in charge of figureing out the chunking</p>
<p>There can be more than 1 mongoS!  If there is then they are treated like a replica set - if one goes down the application driver will connect to another.</p>
<p>When connected to a sharded environment:<code>sh.help()</code></p>

<hr />
<h3>Mongoose</h3>
<p>Built on the NodeJS MongoDriver, this makes life a little easier: <code>npm install mongoose --save</code> (save adds it to our package.json file)</p>
<p>To begin (in Node): 
<pre><code>var mongoose = require('mongoose');
	
mongoose.connect('mongodb://localhost', function (err) {
	...
	mongoose.disconnect();
});</code></pre></p>
<p>To build on that, using express:
<pre><code>var mongoose = require('mongoose');
<strong>var express = require('express');</strong>
	
mongoose.connect('mongodb://localhost', function (err) {
	if (err) throw err;

	<strong>var app = express();
	app.get('/', function(req, res){
		res.send(200, "hello");
	});
	app.listen(3000, function(){
		console.log('now listening on http://localhost:3000')
	});</strong>
});</code></pre></p>
<hr />
Sources:
<ul>
	<li>
		A collection of free cources: <a href="https://university.mongodb.com/">Mongo University</a>
	</li>
</ul>
<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>