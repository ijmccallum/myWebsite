<?php $iainPageTitle = 'Delphic JS club week 6: Function expressions'; $docDepth = 1;?>
<?php include '../partials/head.php';  ?>



<h3>function declaration (classic functions)</h3>
<pre><code>
function myFunctionName(){
	//...
}
</code></pre>

<h3>function expressions</h3>

<p>when functions are declared as variables</p>
<pre><code>
//anonymus or lambda function
var commonOne = function(){
	//...
}
</code></pre>

<pre><code>
//is this like a factory pattern?...
function createAsomething(){
	return function(){
		console.log('an anonymous function');
	}
}

var aSomething = createAsomething();
aSomething();
</code></pre>

<p><strong>closures</strong> - note, when a function is no longer refrenced, it gets destroyed.  
Because closures hold onto a refrence to their originl environment (function) it can't be destroyed.
when saving a closure to a var, set the var to null so that memory can be reclaimed once you've finished with it - only really neccesary in big / long running apps or an an environment 
where you might have a large number of instances of your app running (like a public server serving a very popular app.)</p>

<p><strong>this</strong> is funky! containes a refrence to the parent object, unless in a closure - it might refrence the window and appear to skip over a parent.</p>

<p><strong>circular refrences to the dom</strong></p>



<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>
