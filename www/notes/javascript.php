<?php $iainPageTitle = 'Javascript'; $docDepth = 1;?>
<?php include '../partials/head.php'; ?>


<table class="table table-bordered table-condensed">
	<tr>
		<td>Basics</td>
		<td>New/Es6?</td>
		<td>3rd party/browsers?</td>
	</tr>
	<tr>
		<td>Objects</td>
		<td>Promises</td>
		<td>Requests with the XMLHttpRequest object.</td>
	</tr>
	<tr>
		<td>Functions</td>
		<td>Generators</td>
		<td>Form submittal with XMLHttpRequest</td>
	</tr>
	<tr>
		<td>Closures</td>
		<td>-</td>
		<td>form submit with jQuery</td>
	</tr>
	<tr>
		<td>Scope and Hoisting</td>
	</tr>
	<tr>
		<td>Callbacks</td>
	</tr>
	<tr>
		<td>this</td>
	</tr>
	<tr>
		<td>Bind()</td>
	</tr>
	<tr>
		<td>Call() and Apply()</td>
	</tr>
	<tr>
		
	</tr>
</table>

<hr />

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

<h3>Functions</h3>
<div class="row">

	<div class="col-md-3">
		<p><strong>Function Decleration:</strong> Only executed when called.</p>
<pre><code>function myFunction(a, b) {
    return a * b;
}</code></pre>
	</div>

	<div class="col-md-3">
		<p><strong>Function Expression:</strong> Stores the function in a variable, again not executed until called.</p>
<pre><code>var x = function (a, b) {return a * b};
var z = x(4, 3);</code></pre>
	</div>

	<div class="col-md-3">
		<p><strong>Self invoking anonymous function</strong> this will run immediatly</p>
<pre><code>(function () {
    //...
})();</code></pre>
	</div>

	<div class="col-md-3">
		<p><strong>Self invoking named function</strong> this will run immediatly and we will have a refrence to whtever it may return. (foo.returedObjName)</p>
<pre><code>(function foo() {
    //...
})();</code></pre>
	</div>
</div>
<br />
<div class="row">
	<div class="col-md-4">
		<p>When placing () after a function's name, it will run <br />
		- functionName(); will run<br />
		- functionName will not and can be used as a callback.<br /><br />

		Wrapping a functin in () is essentially the same as calling the function:<br />
		<code><strong>functionName</strong>();</code> = <code><strong>(</strong>function functionName(){}<strong>)</strong>();</code><br />
		Look carefully at what is bold here.</p>
	</div>
	<div class="col-md-4">
		<p>Extra note, placing a ; before a self invoking function prevents it from becoming an argument when files are concatanated/minified. (it shouldn't happen
anyway, this is just preventitive medicine for JS.)</p>
<pre><code>;(function foo() {
    //...
})();</code></pre>
	</div>
	<div class="col-md-4">
		<p>Adding arguments to self invoking functions:</p>
<pre><code>;(function foo(window) {
    //...
})(window);</code></pre>
		<p>args added to the last () will be passed to the function's args.</p>
	</div>
</div>


<hr />


<h3>Closures</h3>

<p>In Javascript, closures arn't actually closures.<br />
Instead function scope is used to simulate the closure.<br />
<code>function closure() { ... }</code> Everything in this function is within the function's scope.<br />
<br />
So <code>function closure() { var x = 0; }</code> 'x' is not available in the global scope.<br />
If we expand this example:
<pre><code>function closure() {
	var x = 0; 
	//'x' is still not available to the global scope

	function add1toX() {
		//but we can edit 'x' in here
		x ++;
	}
}</code></pre>
This is normal - nothing interesting yet.
<br />
<br />
Now we do something special
<pre><code>//1. We turn the <strong>normal function decleration</strong> 'function closure() {...' 
//   into an <strong>Anonymous function declaration</strong>  'var closure = (function () {...'
//   This gives us a refrence to it later on plus it gets executed immediatly
var closure = (function () {

	//Same as before, we still cannot access these from the global scope
	var x = 0;
	function add1toX() {
		x ++;
	}
	
	//2. We return an object that has a refrence to the 'add1toX' function
	//   This anonymous function we're in has now executed but 'add1toX' holds onto the scope (it still thinks it's here).
	return {
		publicRefToFunction: add1toX
	}
})();

// Now we're back in the global scope we cannot edit 'x' nor can we directly run 'add1toX'
// But! We do have 'closure.publicRefToFunction' which will run 'add1toX'
closure.publicRefToFunction;</code></pre>

How cool is that? 'x' is essentially a private variable while 'add1toX' has a public refrence.  We can make private functions
and public variables this way too.  As a bonus, this last example is also a programming pattern called the 
<a href="http://addyosmani.com/resources/essentialjsdesignpatterns/book/#revealingmodulepatternjavascript">Revealing Module Pattern</a>, double win!



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
<h3>Callbacks</h3>
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


<hr />


<p>Making requests asyncronously can be done using several mechanisums: <strong>XMLHttpRequest</strong> (<i>Client request, server responce</i>),
 <strong>Server-Sent Events</strong> (SSE) (<i>Server to client, text based real time</i>),
 and <strong>WebSockets</strong> (<i>erver to client and client to server, bio-directional realtime text and binary</i>).
For a lower level description of how each of these works look at the browser section of my notes.  This section is on how to use them!</p>


<hr />


<h3>Requests with the XMLHttpRequest object.</h3>
<p> 
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

xhr.onreadystatechange = function(){ //gives us the option to deal with various errors
	if (xhr.readyState == 4 && xhr.status == 200) {
		handleSuccessfulResponce();
	}
};

xhr.onload = function(){ //only fires on succesfull responce
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
	<li><code>xhr.readyState</code> Holds the status of the XMLHttpRequest. Changes from 0 to 4: <br />
			0: request not initialized<br />
			1: server connection established<br />
			2: request received<br />
			3: processing request<br />
			4: request finished and response is ready
	</li>
	<li><code>xhr.status</code> | 200: "OK" | 404: Page not found</li>
</ul>
</p>


<hr />


<h3>Form submittal with XMLHttpRequest</h3>
<pre><code>&lt;form id="form-id"&gt;
       &lt;input id="input-id" type="text" name="name" value="previousValue"/&gt;
       &lt;button type="submit" name="action" value="dosomething" onClick="demoRequest()"&gt;Update&lt;/button&gt;
&lt;/form&gt;</code></pre>
<pre><code>//Function called by the submit btn
function demoRequest() {

	//Get an XMLHttpRequest object
	var xhr;
	if (window.XMLHttpRequest) {
		xhr = new XMLHttpRequest();
	} else {
		xhr = new ActiveXObject("Microsoft.XMLHTTP");
	}

	//set up and send the POST request
	xhr.open("POST","post-handler.php",true);
	xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");

	/*encode the form data
	var formDetails;
	var input = document.getElementById("input-id");
	var inputData = encodeURIComponent(input.value);
	formDetails = "action=dosomething&" + input.name + "=" + inputData;
	*/

	//new awesome way to encode form data
	var formDetails;
	var formElement = document.getElementById("form-id");
	formDetails = new FormData(formElement);

	//send the request
	xhr.send(formDetails);

	//handle the responce
	xhr.onload = handleSuccessfulResponce();
	function handleSuccessfulResponce(){
		var responceInXML = xhr.responseXML;
		var responceAsString = xhr.responseText;
	}
}</code></pre>

<h1>TODO check over this</h1>
<p><strong>form submit with jQuery</strong></p>
<pre><code>&lt;form id="myForm" action="comment.php" method="post"&gt;
    Name: &lt;input type="text" name="name" /&gt;
    Comment: &lt;textarea name="comment"&gt;&lt;/textarea&gt; 
    &lt;input type="submit" value="Submit Comment" /&gt;
&lt;/form&gt;</code></pre>

<pre><code>$("#myForm").submit(function(e){
	var postData = $(this).serializeArray();
	var formURL = $(this).attr("action");
	$.ajax({
		url : formURL,
		type: "POST",
		data : postData,
		success:function(data, textStatus, jqXHR) {
		    //data: return data from server
		},
		error: function(jqXHR, textStatus, errorThrown) {
		    //if fails      
		}
	});
	e.preventDefault(); //STOP default action
	e.unbind(); //unbind. to stop multiple form submit.
});

$("#ajaxform").submit(); //Submit  the FORM</code></pre>


<hr />


<h1>TODO: server sent events</h1>


<hr />


<h1>TODO: WebSockets </h1>


<hr />


<h3>Promises</h3>
<p><strong>Vanilla Js promise</strong>

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

<strong>Chained Javascript Promises</strong>: a returned value from within a <code>.then</code> function is passed to the next <code>.then</code>.  Any errors will skip down the chain until the final function where they will be handeled.
<pre><code>$.get('profile.json').then(function(profile){
	return $.get('friend.json?id='+profile.id);
}).then(function(friend){
	//do something with friend
}), function(xhr, status, error) {
	//handle the errors
});
</code></pre>

<strong>Async Javascript Promises</strong>:
<pre><code>var getProfile = $.get('profile.json');
var getFriend = $.get('friend.json');

$.when(getProfile, getFriend).then(function(profile, friend){
	console.log(profile[0]);
	console.log(friend[0]);
}, function(xhr, status, error){
	//handle errors
});
</code></pre>
Source: <a href="https://www.youtube.com/watch?v=obaSQBBWZLk">LearnCode.academy on youtube</a>
</p>

<p><strong>Promise With jQuery.ajax()</strong>

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


<h3><code>this</code></h3>
<p>When <code>this</code> is used inside a function it referrs to the object that the function is bound to (the one that invoked the functino), 
	it also contains the value of that object.  If used in the <strong>global</strong> scope <code>this</code> refers to the global window object,
	unless you're in strick mode - then it's undefined.</p>
<p><strong>copying</strong> vs <strong>referring</strong>.  A function can be called by refrence, in which case <i>this</i> refers to the window object
	and we get errors.  Or a function can be copied.<br />
Copied examples, these will work:
<ul>
	<li><code>element.onclick = doSomething</code></li>
	<li><code>element.addEventListener('click',doSomething,false)</code></li>
	<li><code>element.onclick = function () {this.style.color = '#cc0000';}</code></li>
	<li><code>&lt;element onclick="this.style.color = '#cc0000';"&gt;</code></li>
	<li><code>&lt;element onclick="doSomething(this)"&gt;</code></li>
</ul>
Reffering examples, these will not work (<i>this will refer to the window</i>)
<ul>
	<li><code>element.onclick = function () {doSomething()}</code></li>
	<li><code>element.attachEvent('onclick',doSomething)</code></li>
	<li><code>&lt;element onclick="doSomething()"&gt;</code></li>
</ul>

</p>


<hr />


<h3>Bind()</h3>
<p><i>Not available in IE < 9</i></p>
<p><code>Bind()</code> allows us to specify which object will be bound to <code>this</code>.
<pre><code>​var user = {
	data : {
		name:"T. Woods",
		age:37
	},
	clickHandler:function (event) {​
		$ ("input").val(this.data.name + " " + this.data.age);
	}
}
$ ("button").click(user.clickHandler); //error as <i>this</i> is bound to the button object
$ ("button").click(user.clickHandler.bind(user)); //<i>user</i> is bound to <i>this</i>, so it works!</code></pre>
</p>

<a href="http://www.smashingmagazine.com/2014/01/23/understanding-javascript-function-prototype-bind/">Sashing Magazine</a> covers it well
and gives an example (pulled from MDN) when bind() isn't supported - IE &gt;:(

<hr />


<h3>Call() and Apply()</h3>
<p>Each does a very similar thing, quoting from the artice linked below: 
	"they execute a function in the context, or scope, of the first argument that you pass to them" eg:
<pre><code>var person1 = {name: 'Marvin', age: 42, size: '2xM'};
var person2 = {name: 'Zaphod', age: 42000000000, size: '1xS'};

var sayHello = function(){
    alert('Hello, ' + this.name);
};

var sayGoodbye = function(){
    alert('Goodbye, ' + this.name);
};

sayHello(); //error
sayGoodbye(); //error

sayHello.call(person1);
sayGoodbye.call(person2);

sayHello.apply(person1);
sayGoodbye.apply(person2);</code></pre>
The difference is that <code>call()</code> takes a list of arguments where as <code>apply()</code> takes an array as it's second 
argument.<br />
<strong>A call() example</strong>
<pre><code>var update = function(name, age, size){
    this.name = name;
    this.age = age;
    this.size = size;
};

update.call(person1, 'Slarty', 200, '1xM');</code></pre>
<strong>an Apply() example</strong>
<pre><code>var dispatch = function(person, method, args){
    method.apply(person, args);
};

dispatch(person1, say, ['Hello']);
dispatch(person2, update, ['Slarty', 200, '1xM']);</code></pre>
</p>



<a href="http://hangar.runway7.net/javascript/difference-call-apply">A good article on both</a>

<hr />


<h1>TODO review, learn properly</h1>
<h3>Javascript Generators</h3>

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

Finally, in Javascript 6 (es6 harmony), we have generators.js, it looks blocking, but it's not!
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

<p>Source: <a href="https://www.youtube.com/watch?v=QO07THdLWQo">LearnCode.academy on youtube</a></p>


<hr />


<h1>OOP with Javascript</h1>

<p>A few pieces of terminology to get straight in my head first:
<ul>
	<li>Classes == functions == objects</li>
	<li>Inheritance: objects inheriting features from other objects</li>
	<li>Polymorphism: objects have the same interfect but different methodologies</li>
	<li>Encapsulation: Each object is responsable for one clearly defined task, the details of which are hidden from the rest of the code.</li>
</ul>
</p>

<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>