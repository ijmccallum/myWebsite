<?php $iainPageTitle = 'Delphic JS club week 2: Statements, Functions, Primitives & References'; $docDepth = 1;?>
<?php include '../partials/head.php';  ?>


Objects: {} & new Object(); the same? yes! Awesome.

<h4>Statements</h4>

<ul>
	<li>if</li>
	<li>for: <code>for (var i = 0; i < 9; i++) { ... }</code></li>
	<li>for-in: <code>for (variable in object) { ... }</code></li>
	<li>while: less precice version of the for loop</li>
	<li>do <i>statement</i> while <i>condition</i>: alwayse runs at least once</li>
	<li>with: it exists, but don't use it.</li>
	<li>switch</li>
</ul>
<ul>
	<li>break: in a loop, exit completly</li>
	<li>continue: in a loop. exit this loop and carry on looping</li>
</ul>

<p>Statement labels.</p>
<pre><code>var i, j;

loop1:
for (i = 0; i < 3; i++) {      //The first for statement is labeled "loop1"
   loop2:
   for (j = 0; j < 3; j++) {   //The second for statement is labeled "loop2"
      if (i == 1 && j == 1) {
         continue loop1;
      }
      console.log("i = " + i + ", j = " + j);
   }
}</code></pre>

<hr />

<h4>Primitives / refrences</h4>

<p>primitive values (number, string, array) are passed by value.  Objects are passed by refrence.<br />
When calling <code>typeof</code> on variables both 'object' and 'null' will return 'object'.  To determin the difference we can use <code>instanceof</code>
:<br /> 
<code>objectVariable instanceof Object</code> = true<br />
<code>null instanceof Object</code> = false</p>

<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>
