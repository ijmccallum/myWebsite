<?php $iainPageTitle = 'Javascript'; $docDepth = 1;?>
<?php include '../partials/head.php'; ?>

<h3>JavaScript Objects</h3>
<p>The Object data type is JavaScript's only complex one, it can contain 5 simple data types: Number, String, Boolean, Undefined, & Null.</p>
<p><strong>Saving refrences vs primitives</strong>, simple data saved directly onto a variable is passed as raw data, objects saved onto a variable 
are saved as refrences so two variables may each hold a refrence to the same object:
<pre><code>​var primitive = "Kobe";  
​var anotherPrimitive = person;
primitive = "Bryant";

console.log(anotherPrimitive); // Kobe​
console.log(primitive); // Bryant

var object = {name: "Kobe"};
​var anotherObject = person; //this saves as a refrence to the object unlike the primitives which are saved as a new copy
object.name = "Bryant";

console.log(anotherPerson.name); // Bryant​
console.log(person.name); // Bryant
</code></pre>
</p>
<p><strong>Creating objects</strong> in a few ways:
<ul>
	<li><code>var object = {objectName:"John"}</code>: literal</li>
	<li><code>var object = new Object();</code></li>
	<li><code>function objConstructer(name){this.name = name};</code> we have just created a new prototype, now: <code> var object = new objConstructer('bubba');</code></li>
</ul>
There are also a few built in constructers (prototypes): <code>new Object();</code>, <code>String();</code>, <code>Number();</code>,
<code>Boolean();</code>, <code>Array();</code>, <code>RegExp();</code>, <code>Function();</code>, and <code>Date();</code>
</p>
<p><strong>Object prototypes</strong> are non-existing objects created by these constructor functions. (crazy thought!).  To add a new 
property to the constructor function you will have to write it into the function code.  But to add an inherent property to the prototype
we can use the <strong>prototype</strong> keyword: <code>object.prototype.nationality = "Scottish";</code>, now every object created by the 
objConstructer() function above will have {nationality:"Scottish"}</p>

<p><strong>Functions in objects</strong> are easy - they're done in exactly the same way as primitives.  You can use the <code>this</code> keyword 
to refrence data in the object itself</p>

<p><strong>The <code>in</code> operator</strong> allows us to check whither an object contains a property. eg:
<pre><code>​var school = {schoolName:"MIT"};
console.log("schoolName" in school);  // true​
console.log("schoolType" in school);  // false​
console.log("toString" in school);  // true (inherited from the in-build object prototype which all objects inherit from)</code></pre>
<strong>The <code>hasOwnProperty</code></strong> allows us to check whiter an object has a property which has not been inherited from it's prototype
<pre><code>
console.log(school.hasOwnProperty ("schoolName"));  // true​
console.log(school.hasOwnProperty ("toString"));  // false </code></pre>
</p>
<p><strong>The for/in loop</strong> is used to iterate through an object's properties (inherited & own):
<pre><code>​var school = {schoolName:"MIT", schoolAccredited: true, schoolLocation:"Massachusetts"};
​for (var eachItem in school) {
	console.log(eachItem); // Prints schoolName, schoolAccredited, schoolLocation​
​}</code></pre>
</p>
<p><strong>Deleting properties</strong> can be done with <code>delete object.propertyName;</code>, we cannot delete properties inherited from 
a constructor, properties set to  configurable, or those set in a global variable.</p>
<p>Each property of an object (key-value pair) also has 3 <strong>object attributes</strong>:
<ul>
	<li> Configurable Attribute: if true property cannot be deleted</li>
	<li>Enumerable: whither the property can be returned in a <code>for/in</code> loop</li>
	<li>Writable: whither the property can be changed</li>
</ul>
</p>
<p><code>JSON.stringify(object)</code> turns an object into a string.</p>
<p><code>JSON.parse(string)</code> turns an appropriate string into an object.</p>

<a href="http://javascriptissexy.com/javascript-objects-in-detail/">A good going over of javascript objects</a>

<hr />
<p>blob interface for efficent transmission of data</p>
<p>Polyfill libraries</p>

<h2>Ajax</h2>
Data is sent with an <strong>XMLHttpRequest object</strong> (an ActiveXObjact for IE5 & 6):
<pre><code>var xmlhttp;
if (window.XMLHttpRequest) {
  xmlhttp=new XMLHttpRequest();
} else {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}
</code></pre>

<strong>Prepare</strong> the object with .open( (GET or POST), url, async(Boolean))<br />
<strong>Send</strong> with .send(String(only with POST))<br />
<ul>
	<li>A GET:
<pre><code>xmlhttp.open("GET","ajax_info.txt",true);
xmlhttp.send();
</code></pre>
	</li>
	<li>A POST:
<pre><code>xmlhttp.open("POST","ajax_info.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send();
</code></pre>
	</li>
</ul>

The <strong>Responce</strong>:<br />
For non-XML: <code>document.getElementById("myDiv").innerHTML=xmlhttp.responseText;</code><br />
For XML: <code>xmlDoc=xmlhttp.responseXML;</code>



<p>Source: <a href="http://www.w3schools.com/ajax/ajax_xmlhttprequest_create.asp">W3 Schools tutorial on Ajax</a></p>
<hr />
<h2>Async & Callbacks </h2>
<ul>
	<li>First off - the bad way, callbacks within an Ajax request's success function - leads to the <strong>pyramid of doom / callback hell</strong> (technical term).
<pre><code>Ajax request {
	success function{
		2nd Ajax request{
			success function{
				3rd Ajax request {
					success function{

					}
					3rd error handler{

					}
				}
			}
			2nd error handler {

			}
		}
	}
	1st error handler{

	}
}
</code></pre>
	</li>
	<li>Second - <strong>clean callbacks</strong>: 
<pre><code>Ajax request {
	success: successfunction
	error: errorHandler
}
successFunction{
	2nd Ajax request {
		success: 2nd successFunction
		error: errorHandler
	}
}
2nd successFunction {
	3rd Ajax request {
		success: 3rd successFunction
		error: errorHandler
	}
}
3rd successFunction{
	
}
errorHandler {
	
}
</code></pre>
	</li>
	<li>3rd - <strong>Javascript Promises</strong>
<pre><code>var getPromise = $.ajax({type:'GET', url:'profile.json'}); //this variable is the promise:
//getPromise.then(sucess, error);
getPromise.then(
	function(data){
		console.log(data);
	}, function (xhr, state, error) {
		console.log(arguments);
	}
);	
</code></pre>
	You can preform these individually but this doesn't turn out much different to clean callbacks, what you can also do is...
	</li>
	<li><strong>Chained Javascript Promises</strong>: a returned value from within a <code>.then</code> function is passed to the next <code>.then</code>.  Any errors will skip down the chain until the final function where they will be handeled.
<pre><code>$.get('profile.json').then(function(profile){
	return $.get('friend.json?id='+profile.id);
}).then(function(friend){
	//do something with friend
}), function(xhr, status, error) {
	//handle the errors
});
</code></pre>
	And alternativley there is also...
	</li>
	<li><strong>Async Javascript Promises</strong>:
<pre><code>var getProfile = $.get('profile.json');
var getFriend = $.get('friend.json');

$.when(getProfile, getFriend).then(function(profile, friend){
	console.log(profile[0]);
	console.log(friend[0]);
}, function(xhr, status, error){
	//handle errors
});
</code></pre>
	</li>
	<li>Finally, in Javascript 6 (es6 harmony), we have generators.js, it looks blocking, but it's not!
<pre><code>Promise.coroutine(function* (){

	var profile = yield $.get('profile.json');
	$('#profile').html(JSON.stringify(profile));

	var tweets = yield $.get('tweets.json');
	$('#tweets').html(JSON.stringify(tweets));

	var friend = yield $.get('friend.json');
	$('#friend').html(JSON.stringify(friend));

})().catch(function(errs){
	//handle errors
});
</code></pre>
	</li>
</ul>
<p>Source: <a href="https://www.youtube.com/watch?v=obaSQBBWZLk">LearnCode.academy on youtube</a></p>

<hr />

<h2>Javascript Generators</h2>

<p>A simple generator:</p>
<pre><code>var myGenerator = function*(){
	var one = yield 1; //pauses here (without blocking) and waits for .next to be called on this function
	var two = yield 2;
}

var gen = myGenerator();

//When .next is first called, the first yielded value is returned
console.log(gen.next()); //{value:1, done:false}

//The second time .next is called the second yield is returned.
//We are also passing in a value which will be applied to the variable 'two'
console.log(gen.next(4)); //{value:2, done:false}

console.log(gen.next()); //{value:undefined, done:true}
console.log(gen.next()); //errors
</code></pre>

<p>Source: <a href="https://www.youtube.com/watch?v=QO07THdLWQo">LearnCode.academy on youtube</a></p>



<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>