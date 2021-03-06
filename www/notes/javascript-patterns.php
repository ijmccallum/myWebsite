<?php $iainPageTitle = 'Javascript Patterns'; $docDepth = 1;?>
<?php include '../partials/head.php'; ?>


<table class="table table-bordered table-condensed">
	<tr>
		<td><h3>Creational Design Patterns <br /><small>Creating objects</small></h3></td>
		<td><h3>Structural Design Patterns <br /><small>object composition?</small></h3></td>
		<td><h3>Behavioral Design Patterns <br /><small>communication between objects</small></h3></td>
	</tr>
	<tr>
		<td><a href="#constructor">Constructor</a>: creating many similar objects</td>
		<td><a href="#facade">Facade</a>: a simple interface for complex actions</td>
		<td><a href="#observer">Observer</a>: One 'Subject' many 'Observers'</td>
	</tr>
	<tr>
		<td><a href="#module">Module</a>: creating objects with public and private properties</td>
		<td><a href="#mixin">Mixin</a>: code additives, one jar many dishes</td>
		<td><a href="#pubsub">Pubsub</a>: Publisher > channel < subscriber</td>
	</tr>
	<tr>
		<td><a href="#singleton">Singleton</a>: many refrences to a single object(or Module) (there can only be one!)</td>
		<td><a href="#decorator">Decorator</a>: upgrading specific objects</td>
		<td><a href="#mediator">Mediator</a>: A central point of control</td>
	</tr>
	<tr>
		<td><a href="#factory">Factory</a>: Make me a sandwich (of the pb&j variety)</td>
		<td><a href="#flyweight">Flyweight</a>: share the common objects, like carshare!</td>
		<td>Iterator</td>
	</tr>
	<tr>
		<td><a href="protoype">Prototype</a>: less repetition through cloning</td>
		<td>Adapter</td>
		<td>Visitor</td>
	</tr>
	<tr>
		<td>Builder</td>
		<td>Proxy</td>
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

<p>these objects also have a property that points back to their constructor:
<pre><code>civic.constructor == Car; //true
</code></pre>
</p>


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


<hr id="pubsub"/>

<h2>Publish/Subscribe (pubsub / Event Aggregator) <small>Publisher > channel < subscriber</small></h2>
<p>A channel agregates events of a certain type (from many publishers) so that a subscriber doesn't need to know where the events originate.  
Good if you have a 'subject' that is interested in many 'publishers'.</p>
<div class="row">
	<div class="col-md-6">
	<p>
		<ul>
			<li>We create an object (pubsub) that will hold a list of topics</li>
			<li>Within that topic (pubsub.topic[]) we will list the subscribers (or the functions provided by the subscribers. (pubsub.topic[i].func)</li>
			<li>To help with tracking everything, each subscription get's a unique id: pubsub.topic[i].token </li>
			<li>Our pubsub schema now looks like this:
			<pre>
pubsub {
	topic:[
		{
			func: function(){ ... },
			token: id
		}
	]
}</pre>
			</li>
			<li>pubsub must also have a subscription function</li>
			<li>and a publish function to be called by whoever</li>
			<li>finall an unsubscribe function</li>
		</ul>
	</p>
	</div>
	<div class="col-md-6">
		<pre><code>//The object that sits between publishers and subscribers:
var pubsub = {};

//We now pass it to an anonymous, self invoking function:
(function(){

	//This will hold topics with their subscribed functions and an id for each
	var topics = {};

	//This is our counter to produce unique id's
	var subUid = -1;

	//Subscribers must provide their topic and a function to fire on publish
	myObject.subscribe = function( topic, func ) {

		//If the subscriber signs up for an unknown topic, just make it!
		if (!topics[topic]) {
			topics[topic] = [];
		}

		//increment the subUid for a unique id number
		var token = ( ++subUid ).toString();

		//access the requested topic, add in the id and the function
		topics[topic].push({
			token: token,
			func: func
		});

		//give the subscriber it's token (id)
		return token;	
	};

	//Publishers call this with topic and data
	myObject.publish = function( topic, args ){

		//if the topic doesn't exist, tell the publisher (no one is listening!)
		if ( !topics[topic] ) {
			return false;
		}

		//Get the list of subscribers for this topic
		var subscribers = topics[topic];

		//Find out how many subscribers there are for this topic
		var length = subscribers ? subscribers.length : 0;

		//for each subscriber
		while (length--) { 
			//fire the function they provided
			subscribers[length].func( topic, args );
		}

		//Honestly, does the publisher care? I guess it might
		return this;
	};

	//To unsubscribe, a subscriber must pass in it's token(id) 
	myObject.unsubscribe = function( token ) {

		//run through every topic
		for ( var topic in topics ) {

			//kind of unnecisary maybe?
			if ( topics[topic] ) {

				//Loop through the subscribors for this topic
				for (var i=0, j=topics[topic].length; i&lt;j; i++) {
                    
					//if we find a matching token
					if ( topics[topic][i].token === token ) {

						//Remove the subscribed function
						topics[topic].splice( i, 1 );

						//Do we need to do this too?
						return token;
					}
				}
			}
		}
		return this;
	}
})(pubsub);</code></pre>	
	</div>
</div>

<hr id="mediator" />

<h2>The Mediator Pattern <small>A central point of control</small></h2> 
<p>An object that coordinates the execution of others, eg in a 'wizard' taking you step by step.  The Mediator initiats the first step and on 
completion the first step refers back to the Mediator who then initiates the second step (of which there may be sevoral variations).</p>

<pre><code>//Need to create a good example here</code></pre>

<hr id="prototype"/>

<h2>Prototype <small>less repetition through cloning</small></h2>
<p>Each object has a .prototype that we can use as a base for creating new ones, all about inheritnce here!  We've actually already used it in
the constructor pattern at the very top of this page!</p>

<pre><code>var objectConstructor = function() {
	this.variable = "this will be copied with every new";
}

objectConstructor.prototype.fancyFunction = function(){
	console.log('this log function will only be refrenced by every new, saves memory!');
}
</code></pre>

<hr id="command" />

<h2>The Command Pattern</h2>
<p>The idea with this pattern is to abstract an action from an object.<br />
So you can have a page full of objects and a couple of buttons that preform actions.</p>
<p>All command objects have one method in common: execute
They also all have 4 parts:</p>
<ul>
	<li>The command object</li>
	<li>The client: Creates the command object and passes to the invoker</li>
	<li>The invoker: uses the command object and calls it's args</li>
	<li>The reciever: the object the command object is making calls on</li>
</ul>

<p>Example from <a href="http://www.joezimjs.com/javascript/javascript-design-patterns-command/">joezimjs</a>:<br />
</p>

<pre><code>var alarmList = [];

/* Here we create the enableAlarm and disableAlarm command objects,
 * they don't actually care what kind object gets passed to them as
 * long as those objects 
 */
	
var enableAlarm = function(alarm) {
    this.alarm = alarm;
}
enableAlarm.prototype.execute = function () {
    this.alarm.enable();
}


var DisableAlarm = function(alarm) {
    this.alarm = alarm;
}
DisableAlarm.prototype.execute = function () {
    this.alarm.disable();
}


//loop through all the alarms 
for (i=0; i&lt;alarmList.length; i++) {
	
	//Pass the alarm object, we get enable_alarm.alarm.execute
	var enable_alarm = new enableAlarm( alarmList[i] );
	var disable_alarm = new DisableAlarm(alarms[i]);

	/* the button object also doesn't care how the command class is implemented, 
	 * as long as it has an execute method 
	 */
	new Button('enable', enable_alarm);
	new Button('disable', disable_alarm);
}

</code></pre>

<p>Often used for undo/redo functionality</p>

<hr id="facade" />

<h2>Facade <small>a simple interface for complex actions</small></h2>
<p>All the complexity of an operation taken care of within the funciton.</p>

<pre><code>
function addEvent( element, event, callback ) {
  
  if( window.addEventListener ) {
    element.addEventListener( event, callback, false );
  } else if( document.attachEvent ) {
    element.attachEvent( 'on' + event, callback );
  } else {
    element[ 'on' + event ] = callback;
  }
  
}</code></pre>
<p>source: <a href="https://carldanley.com/js-facade-pattern/">Carl Danly's example</a></p>

<hr id="factory" />

<h2>Factory Pattern <small>Make me a sandwich (of the pb&j variety)</small></h2>
<p>Another way of instantiating objects, <br />
If there are many types of objects to be created (in this example, types of spaceships)
it lets us decouple the creation calls from the indiviual constructors.  Instead we just
call the factory and ask it for a type of object, the factory deals with calling the 
individual constructors.</p>

<pre><code>//Basic constructors for various different types of objects, each with their own defaults
function spaceShip( options ) {
	this.lifeSupport = options.lifeSupport || "1 person";
	this.color = options.color || "silver";
	this.speed = options.speed || "warp 1";
}
 
function fireflyShip(options){
	this.lifeSupport = options.lifeSupport || "5 people";
	this.cargoHold = options.cargoHold || "Really big";
	this.color = options.color || "brown";
}

function theEnterprise(options){
	this.lifeSupport = options.lifeSupport || "200 people";
	this.speed = options.speed || "warp 9";
}

function xWing(options){
	this.speed = options.speed || "warp 5";
	this.wings = options.wings || 4;
}


//The factory gives us a single place to call when creating a new object of whatever type
function spaceShipFactory() {};
spaceshipFactory.prototype.createShip = function (options) {

	//Determin the type of object to be created
	switch (options.shipType) {
		case "firefly":
			this.shipType = fireflyShip;
			break;
		case "enterprise":
			this.shipType = theEnterprise;
			break;
		case "xwing":
			this.shipType = xWing;
			break;
		default:
			this.shipType = spaceShip;
	}

	//now we know the type of object, return a new one
	return new this.shipType(options);
}


//Now we create a new factory and use it without having to call the objects individual functionx
var mySpaceShipFactory = new spaceShipFactory();
var myNewShip = spaceShipFactory.createShip({
	shipType:"firefly",
	speed:"warp 99"
});
</code></pre>

<hr id="mixin" />

<h2>Mixin <small>code additives, one jar many dishes</small></h2>

<p>Storing comon functionality in a mixin function to be mixed into other object prototypes as required.</p>
<div class="row">
	<div class="col-md-6">
		<p>This example adds in all the objects within a mixin to the plain object that is recieveing the mixin.
		For these I'd think it's a good idea to define many mixins each with a small number of functions.</p>
<pre><code>//a simple object constructor
var thing = function(){
	this.name = "the thingy";
} 

//mixin
var mixin = function() {};
mixin.prototype = {
	functionToInherit: function(){
		console.log('mixed in!');
	};
}

//mixingInFunction, note we're working with prototypes
function mix(plain, additive){

	//runs through every object in the additives (mixins) prototype
	for ( var methodName in additive.prototype ) {

		//Don't overwrite existing functions if there is a clash
		if (!plain.prototype[methodName]) {
			plain.prototype[methodName] = additive.prototype[methodName];
		}

	}
}
</code></pre>
	</div>
	<div class="col-md-6">
		<p>The alternative is to have one massive mixin and give your mixer function the ability to define which 
		functions from within the mixin to include.  But, I'm not going to do that example as it seems the first example,
		to me at least, is a better way of working.</p>
	</div>
</div>

<hr id="decorator" />

<h2>Decorator <small>upgrading specific objects</small></h2>

<p>Adding extra functions to objects (not their prototypes as in the mixin above)</p>

<pre><code>//The basic object
function basicLaptop() {
	this.speed = 1;
	this.memory = 60;
	this.cost = 200;
}

//augmenting an existing object within laptop
function memoryUpgrade(laptop) {
	var memory = laptop.memory;
	laptop.memory = (memory * 2);
}

//adding an extra object to laptop
function dualMonitors(laptop) {
	laptop.screenPorts = 2;
}

var myLaptop = new basicLaptop;

//decorate 'myLaptop' with the decorators - note, though they are only values here remember a function is just an object so can be added in the same way
memoryUpgrade(myLaptop);
dualMonitors(myLaptop);
	
</code></pre>


<hr id="flyweight" />

<h2>Flyweight <small>share the common objects, like carshare!</small></h2>

<p>Used to share common code/variables accross objects.  For example, people and cars (as objects)</p>
<div class="row">
	<div class="col-md-6">
		<p>The bad example (like real life)</p>
<pre><code>//car object
var car = function(){
	this.color = red;
	this.make = volvo;
}

//every person we create has their own car
var person = function(){
	this.name = "bob";
	this.car = new car();
}
	
</code></pre>
	</div>
	<div class="col-md-6">
		<p>The good example (what real life should be like)</p>
<pre><code>//todo tidy this example up!
var car = function(type){
	this.type = type || 'volvo';
}

function carSupplyer(){

	this.carList = {
		'volvo':car
	};

	this.getCar =  function(type){
		//if the car defined in the options exists in the carList, return that car instead of making a new one!
		if (this.carList.type) {
			return this.carList.type;
		} else {
			//only make a new one if needed
			this.carList.type = new car(type);
		}
	}

}

</code></pre>
	</div>
</div>


<hr />

<h2></h2>

<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>