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


<h3>scope and hoisting</h3>
<p>The scope of a variable is defined by the location in which it is declared (or not) by <code>var</code>.  They may be <strong>global</strong>
if defined in the global space or <strong>local</strong> if defined (<i>var</i>) in a function - JS has a function-level scope as opposed to a block-level
</p>
<p>Variables can have either a <i>local</i> or <i>global</i> scope.  Local variables can only be accessed in the same function or in it's child functions.</p>
<p>Local variables have <strong>priority</strong> over globals.</p>
<pre><code>var thisIsAglobal = 1;
anotherGlobal = 1;
function() {
	thisIsStillGlobal = 1;
	var thisIsLocal = 1;
}
</code></pre>
<p><strong>setTimeout</strong> executes everything inside in the global scope.</p>
<p>Avoid putting variables in the global scope! Mainly to avoid clashes.  If you have to, it's a good idea to follow the WP way and prefix them 
with something unique.</p>
<p><strong>Hoisting</strong> happens when a variable is declared further down in a function or in the global scope.
<ul>
	<li><code>var x;</code> decleration</li>
	<li><code>x = 0;</code> assignment</li>
	<li><code>var x = 0;</code> decleration & assignment</li>
	<li><code><strong>var x</strong> = 0;</code> <strong>decleration hoisted</strong>, not assignment</li>
</ul>
<pre><code>//what you write
function example(){
	console.log(randomVar); //undefined
	var randomVar = 'hi';
}</code></pre>
<pre><code>//what gets processed
function example() {
	var randomVar;
	console.log(randomVar); //undefined
	randomVar = 'hi';
}
</code></pre>
</p>
<p><strong>Hoisting functions</strong>
<ul>
	<li>function expression (anonymous): <code>var functionExpression = function() { ... };</code></li>
	<li>function expression (named): <code>var functionExpression = function myFunctionExpression() { ... };</code><br />
		<i>Function expression declerations are hoisted but not their assignment, they will be undefined if called too early.</i></li>
	<li>function declaration (alwayse named): <code>function functionDeclaration() { ... }</code><br />
		<i>The full function is hoisted so it can be run even before it has been declared.</i></li>
</ul>
in other words
<ul>
	<li><code><strong><i>var functionExpression = function()</i></strong> { ... };</code>: <strong><i>hoisted</i></strong> not hoisted</li>
	<li><code><strong><i>var functionExpression = function myFunctionExpression()</i></strong> { ... }</code>: <strong><i>hoisted</i></strong> not hoisted</li>
	<li><code><strong><i>function functionDeclaration() { ... }</i></strong></code>: <strong><i>All hoisted</i></strong></li>
</ul>
</p>

<a href="http://javascriptissexy.com/javascript-variable-scope-and-hoisting-explained/">The source article!</a>

<hr />


<h3>Closures</h3>
<p>Created when you use <i>function()</i> inside another function().  An example:</p>
<pre><code>function sayHello2(name) {
  var text = 'Hello ' + name; // local variable
  var sayAlert = function() { alert(text); }
  return sayAlert;
}
var say2 = sayHello2('jane')</code></pre>

<p><code>sayHello2</code> returns a function, the one that was declaired inside it (<code>sayAlert()</code>) so the variable <code>say2</code> now holds a refrence to that returned function (which is the closure). 
	<code>console.log(say2.toString()); // "function() { alert(text); }" </code>.<br/ >
You will notice that the returned function, which is <i>refrenced</i> by <code>say2</code>, has within it a refrence to the variable 'text' which 
you might expect to have been destroyed after the original sayHello2() function was returned... not so!  The returned function (<code>sayAlert</code>) 
keeps a refrence to it's creator in secret - this is a closure.</p>
<a href="http://www.javascriptkit.com/javatutors/closures.shtml">the description of closures</a>

<hr />

<h3>Asynchronous Javascript, talking to the server (and possibly other things)</h3>

<h1>TODO: sort everything below into one well done section</h1>

<h4>Don't block the stack!</h4>
<p>As your code executes, every function that is stepped into pushes it's parent onto the stack to be returned to.  The stack is the system
	used to keep track of what is curretly being executed.  The <strong>Event Loop</strong> watches the stack and handles the allocation of 
	other tasks to the stack.  Eg, the page render: it will only allow the page to render when the stack is clear, so if you have a function
running every time the scroll event fires the event loop is going to get clogged up with possibly hundreds of calls to your funtion, it gets worse -
your function is given a higher priority than the page render so the event loop will throw on every call of your function (even though they may now be
redundant) before allowing the page to render.</p>
<p><code>setTimeout(function,0)</code> is a neat trick to take a function an pop it into the queue for the event loop to pop onto the stack one it's free to stop 
	longer functions from blocking the stack.</p>

<h4>Simple Call backs</h4>
<p>Vanilla anonymous event handler</p>
<pre><code>var clickity = document.getElementById("clickity");
clickity.addEventListener("click", function (e) {
    //console log, since it's like ALL real world scenarios, amirite?
    console.log("Alas, someone is pressing my buttons…");
});</code></pre>
<p>Vanilla named event handler</p>
<pre><code>var sortOptions = document.getElementsByClassName('sort-options')[0];
sortOptions.addEventListener("click", handleClick, false);
functino handleClick(){
	...
};</code></pre>
<p>Jquery anonymous event handler</p>
<pre><code>$("#clickity").on("click", function (e) {
    console.log("Alas, someone is pressing my buttons…");
});</code></pre>

<h4>Multiple callbacks</h4>

<h4>Making requests</h4>
<p>Making requests asyncronously can be done using several mechanisums: <strong>XMLHttpRequest</strong> (<i>Client request, server responce</i>),
 <strong>Server-Sent Events</strong> (SSE) (<i>Server to client, text based real time</i>),
 and <strong>WebSockets</strong> (<i>erver to client and client to server, bio-directional realtime text and binary</i>).
For a lower level description of how each of these works look at the browser section of my notes.  This section is on how to use them!</p>

<p><strong>Requests with the XMLHttpRequest object.</strong> 
<pre><code>/* Set up the request object */
var xhr;
if (window.XMLHttpRequest) {
	xhr = new XMLHttpRequest();
} else {
	xhr = new ActiveXObject("Microsoft.XMLHTTP");
}

/* GET Request */
var urlString = '/resource.js'; //opportunity to add in extra params
xhr.open('GET', urlString, true);
xhr.send();

/* POST Request */
xhr.open("POST","ajax_test.asp",true);
xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xhr.send("fname=Henry&lname=Ford");

/* Server responce */
xhr.onload = handleSuccessfulResponce(); //only fires on succesfull responce
xhr.onreadystatechange = checkXhrProgress(); //gives us the option to deal with various errors

function checkXhrProgress(){ 
	if (xhr.readyStat == 4 && xhr.status == 200) {
		handleSuccessfulResponce();
	}
};

function handleSuccessfulResponce(){
	var responceInXML = xhr.responseXML;
	var responceAsString = xhr.responseText;
}

</code></pre>
GET is faster than POST<br />
Use POST for: Large data, user input, updating data on the server.<br />
The functions:
<ul>
	<li><code>xhr.open(method,url,async)</code> defines the type of request | <i>method</i>: GET or POST | <i>url</i>: file address, can also hold paramaters | <i>async</i>: true or false</li>
	<li><code>xhr.send(string)</code> if POST then string is added to ...</li>
	<li><code>xhr.setRequestHeader(header,value)</code> defines a key value pair to send | <i>header</i> name | <i>value</i> ... </li>
	<li><code>xhr.onreadystatechange</code> = a function to be called every time the <i>readyState</i> changes</li>
	<li><code>xhr.readyState</code> Holds the status of the XMLHttpRequest. Changes from 0 to 4: 
			0: request not initialized
			1: server connection established
			2: request received
			3: processing request
			4: request finished and response is ready
	</li>
	<li><code>xhr.status</code> | 200: "OK" | 404: Page not found</li>
</ul>
</p>
<p><strong>XMLHttpRequest with a form</strong></p>



<a href="http://tech.pro/blog/1402/five-patterns-to-help-you-tame-asynchronous-javascript" target="_blank">Async tut in detail</a>

<h3>jQuery.ajax()</h3>
<p>promise

<pre><code>var promise = $.ajax({
  url: "/ServerResource.txt"
});
  
promise.done(successFunction);
promise.fail(errorFunction);
promise.always(alwaysFunction);</code></pre>

<pre><code>$("#div1").load("demo_test.txt"); //loads the content of "demo_test.txt" into "#div1"
$("#div1").load("demo_test.txt #p1"); //in "demo_test.txt" there is an element #p1, it's content gets loaded into the div
</code></pre>
</p>

<hr />


<h3>Async & Callbacks </h3>

<p>Sometimes functions need to wait until another has completed, so we use <i>callback functions</i>. A jQuery example:
<pre><code> $("p").hide("slow",function(){
    alert("The paragraph is now hidden");
  });</code></pre>
</p>
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