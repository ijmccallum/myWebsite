<?php $iainPageTitle = 'Javascript Closures'; $docDepth = 1;?>
<?php include '../partials/head.php'; ?>

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


<!--  Old notes on closures
Objects declared within a function are only accesible to that function and those within it.</p>

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
-->


<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>