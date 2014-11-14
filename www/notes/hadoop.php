<?php $iainPageTitle = 'MapReduce and Hadoop'; $docDepth = 1;?>
<?php include '../partials/head.php'; ?>

<p>Would be a good idea if you are dealing with a High quantity (&gt;10tb) of data or complext statistical analysis (or both!)</p>

<hr />
<h2>MapReduce</h2>
<p>Allows you to take a large amount of data and some computation you want to do on it and spread that over several machiens to run in parallel.</p>
<p>An example explanation given by Sanjay Ghemawat, one of the coauthors of MapReduce:<br />
Say you have a large number of web pages in various languages, and you want to know to total count of pages in each language.  
You also have a function that identifies the language of the page.  MapReduce will take the function and deal with the complexity of running it accross every page,
aggregating the results, and returning the final values.  Some of the complexity it relieves a developer from are things like failures, load balancing</p>
<ul>
	<li>Map: turns input data into Key value pairs.  It is the application of a function onto every piece of data.</li>
	<li>Reduce: combines the pairs to produce the final results.  Takes the result of all the functinos and agregating them together.</li>
</ul>
<p><strong>Straggling nodes</strong> can slow the whole computation time so when one is noticed the process it is running can be split up and given to other machiens 
that have already finished their tasks.  A simmilar system can be used to resolve hardware failures.</p>
<hr />
<h2>Hadoop</h2>

<hr />
<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>