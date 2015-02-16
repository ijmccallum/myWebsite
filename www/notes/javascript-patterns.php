<?php $iainPageTitle = 'Javascript'; $docDepth = 1;?>
<?php include '../partials/head.php'; ?>


<table class="table table-bordered table-condensed">
	<tr>
		<td><h3>Creational Design Patterns <br /><small>Creating objects</small></h3></td>
		<td><h3>Structural Design Patterns <br /><small>object composition?</small></h3></td>
		<td><h3>Behavioral Design Patterns <br /><small>communication between objects</small></h3></td>
	</tr>
	<tr>
		<td><a href="#constructor">Constructor</a></td>
		<td>Decorator</td>
		<td>Iterator</td>
	</tr>
	<tr>
		<td>Factory</td>
		<td>Facade</td>
		<td>Mediator</td>
	</tr>
	<tr>
		<td>Abstract</td>
		<td>Flyweight</td>
		<td>Observer</td>
	</tr>
	<tr>
		<td>Prototype</td>
		<td>Adapter</td>
		<td>Visitor</td>
	</tr>
	<tr>
		<td><a href="#singleton">Singleton</a>: An object that can have only one instance (all objs in js are like this)</td>
		<td>Proxy</td>
		<td>-</td>
	</tr>
	<tr>
		<td>Builder</td>
		<td>-</td>
		<td>-</td>
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

<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>