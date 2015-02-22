<?php $iainPageTitle = 'Javascript'; $docDepth = 1;?>
<?php include '../partials/head.php'; ?>


<table class="table table-bordered table-condensed">
	<tr>
		<td><h3>Creational Design Patterns <br /><small>Creating objects</small></h3></td>
		<td><h3>Structural Design Patterns <br /><small>object composition?</small></h3></td>
		<td><h3>Behavioral Design Patterns <br /><small>communication between objects</small></h3></td>
	</tr>
	<tr>
		<td><a href="#constructor">Constructor</a> creating many similar objects</td>
		<td>Decorator</td>
		<td>Iterator</td>
	</tr>
	<tr>
		<td><a href="#module">Module</a> creating objects with public and private properties</td>
		<td>Facade</td>
		<td>Mediator</td>
	</tr>
	<tr>
		<td><a href="#singleton">Singleton</a>: many refrences to a single object(or Module) (there can only be one!)</td>
		<td>Flyweight</td>
		<td><a href="#observer">Observer</a></td>
	</tr>
	<tr>
		<td>Factory</td>
		<td>Adapter</td>
		<td>Visitor</td>
	</tr>
	<tr>
		<td>Abstract</td>
		<td>Proxy</td>
		<td>-</td>
	</tr>
	<tr>
		<td>Prototype</td>
		<td>-</td>
		<td>-</td>
	</tr>
	<tr>
		<td>Builder</td>
	</tr>
</table>

<hr id="constructor" />

<h2>Constructor <small>A simple pattern to create objects of a similar nature (or class)</small></h2>

<div class="row">
	<div class="col-md-4">
		<p>common ways to create a new object:</p>
		<ul>
			<li><code>var newObject = {};</code></li>
			<li><code>var newObject = Object.create( Object.prototype );</code></li>
			<li><code>var newObject = new Object();</code></li>
		</ul>
	</div>
	<div class="col-md-8">
		<p>and ways to add properties to said object:</p>
		<ul>
			<li><code>newObject.someKey = "Hello World";</code></li>
			<li><code>newObject["someKey"] = "Hello World";</code></li>
			<li><code>Object.defineProperty( newObject, "someKey", {value: "for more control of the property's behavior"});</code>
			</li>
		</ul>
	</div>
</div>

<pre><code>//JS objects all contain a 'prototype' object.
function Car( model, year, miles ) {
  this.model = model;
  this.year = year;
  this.miles = miles;
}

//Here we assign a function to the constructors prototype.
Car.prototype.toString = function () {
  return this.model + " has done " + this.miles + " miles";
};
 
//Any object created by the constructor will also have access to this function
var civic = new Car( "Honda Civic", 2009, 20000 );
console.log( civic.toString() );</code></pre>	


<hr id="module" />

<h2>(Revealing) Module <small>in JS - allows us public & private methods and variabls in an object</small></h2>
<p>It creates privacey using closures.</p>
<p>The outside world cannot touch a function's private parts, however - it's own public parts can touch it's own privates.</p>	
<pre><code>//Only the returned objects are public
var testModule = (function () {

	//Private var - this is only accessible to the functions within this function
	var privatevariable = 0;

	//Private function
	function doSomethingPrivate() { ... }

	//Private function that will be revealed
	function publicDoSomething() { ... }

	//Only objects in the returned object will be visible publicly
	return {
		//Revealing the functions we want to be public
		doSomething: publicDoSomething
	};
 
})();
 
//We have to refrence the module to use it's functions - they are now namespaced!
testModule.publicFunction();</code></pre>

<hr id="singleton" />

<h2>Singleton <small>a single object of a give type, globally acessible, to be used accross the system.</small></h2>
<p>Generally speaking, not usually a good idea - especially with JavaScript.  There are those who would consider it an anti-pattern.</p>
<p>It is essentially a Module pattern with an extra bit: if it has already been instantiated, the singleton will return a refrence to that instance.</p>
<pre><code>var mySingleton = (function () {

	// 1. We keep note of whither this singleton has been created
	var instance;

	function init() {

		// 4. The Singleton is created, much like a Module

		// Private methods and variables
		function privateMethod(){ ... }
		var privateVariable = "Im also private";

		return {

		// Public methods and variables
		publicMethod: function () { ... },
		publicProperty: "I am also public",

		};

	};

	// 2. the Anonymous function declaration executes and returns getInstance
	return {

		getInstance: function () {
			// 3. init() is only every called once
			if ( !instance ) { instance = init(); }
			return instance;
		}

	};
 
})();

// 3. we get a refrence to the singleton 
var singletonRef = mySingleton.getInstance();</code></pre>

<hr id="observer" />

<h2>The Observer Pattern <small>One 'Subject' many 'Observers'</small></h2>

<p>The 'Subject' keeps a list of 'Observers' to notify when things happen.</p>
<div class="row">
	<div class="col-md-6">
		<p>Check out this wee demo I worked out to showcase this pattern.  Click on one of the 'observers' to subscribe them to the 'subject', 
			then click on the 'subject' to publish a random number.</p>
<pre><code>// 1. I use the constructor pattern to create the subject and it's functions
function subject(){
	//All those who subscribe submit a function to be added into this array
	this.observerlist = [];
};

subject.prototype = {

	subscribe: function(fn) {
		this.observerlist.push(fn);
	},
	unsubscribe: function(fn) {
		this.observerlist = this.observerlist.filter(
			function(item) {
				if (item !== fn) {
					return item;
				}
			}
		);
	},
	publish: function(notification) {
		for(var i=0; i < this.observerlist.length; i++) { 
			/*on publish, every function in the 'observerlist' 
			  is passed 'notification' and executes */
			this.observerlist[i](notification);
		}
	}
};

/* Creating an instance of the subject object
   it didn't need to be a constructor, I'm just 
   in the spirit of patterns right now! */
var demoEvent = new subject();

//called on click, dirty but quick!
function fire(){
	var notification = Math.random();
	demoEvent.publish(notification);
};
</code></pre>	
	</div>

	<div class="col-md-6">
		<p>A little demo: (also in a <a href="http://codepen.io/ijmccallum/pen/GgdJBr">codepen</a>)</p>
		<div id="subjectDemo" class="subject btn btn-primary" onClick="fire()">I am the subject</div>
		<div id="observer1" class="observer btn btn-primary" onClick="subscribeMe(observer1)">I am an observer</div>
		<div id="observer2" class="observer btn btn-primary" onClick="subscribeMe(observer2)">I am an observer</div>
		<div id="observer3" class="observer btn btn-primary" onClick="subscribeMe(observer3)">I am an observer</div>
		<hr />
		<p>The code below is the rest of what makes this demo run</p>
<pre><code>function observer(element_ID){
	//Used to toggle the subscription
	var subscribed = false;
	//Getting the DOM element to chenge the innerHTML
	this.domElement = document.getElementById(element_ID);
};

var observer1 = new observer('observer1');
var observer2 = new observer('observer2');
var observer3 = new observer('observer3');

/*The recieve functions of each observer are not added to the 
  prototype for a couple of reasons:
  1: the unsubscribe function will remove any duplicates 
  2: I tried to use 'this' to define the DOM element, but 'this' 
      (when called by the subject) refers to the receieve function,
      not the observer object. */
observer1.recieve = function(notification){
	observer1.domElement.innerHTML = notification;
}
observer2.recieve = function(notification){
	observer2.domElement.innerHTML = notification;
}
observer3.recieve = function(notification){
	observer3.domElement.innerHTML = notification;
}

//The subscription toggle
function subscribeMe(elementObserver) {
	if (!elementObserver.subscribed) {
		demoEvent.subscribe(elementObserver.recieve);
		elementObserver.subscribed = true;
	} else {
		demoEvent.unsubscribe(elementObserver.recieve);
		elementObserver.subscribed = false;
	}		
}</code></pre>
	</div>
	<script>
		//========================================================The Subject
		function subject(){
			this.observerlist = [];
		};

		subject.prototype = {

			subscribe: function(fn) {
				this.observerlist.push(fn);
				console.log('subscribe: ');
				console.log(this.observerlist);
			},

			unsubscribe: function(fn) {
				this.observerlist = this.observerlist.filter(
					function(item) {
						if (item !== fn) {
							return item;
						}
					}
				);
				console.log('unsubscribe: ');
				console.log(this.observerlist);
			},
			publish: function(notification) {
				for(var i=0; i < this.observerlist.length; i++) { 
					this.observerlist[i](notification);
				}
			}
		};

		var demoEvent = new subject();

		//called on click, dirty but quick!
		function fire(){
			var notification = Math.random();
			demoEvent.publish(notification);
		};

		//========================================================The Observers
		function observer(element_ID){
			var subscribed = false;
			this.domElement = document.getElementById(element_ID);
			//this.domElement.addEventListener("click", subscribeMe(element_ID));
		};

		observer.prototype.recieve = function(notification){
			console.log(notification);
		}


		var observer1 = new observer('observer1');
		var observer2 = new observer('observer2');
		var observer3 = new observer('observer3');

		observer1.recieve = function(notification){
			observer1.domElement.innerHTML = notification;
		}
		observer2.recieve = function(notification){
			observer2.domElement.innerHTML = notification;
		}
		observer3.recieve = function(notification){
			observer3.domElement.innerHTML = notification;
		}

		function subscribeMe(elementObserver) {
			if (!elementObserver.subscribed) {
				demoEvent.subscribe(elementObserver.recieve);//subscribe the function we want
				elementObserver.subscribed = true;
			} else {
				demoEvent.unsubscribe(elementObserver.recieve);
				elementObserver.subscribed = false;
			}		
		}


	</script>
</div>


<hr />

<h2>Publish/Subscribe</h2>

<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>