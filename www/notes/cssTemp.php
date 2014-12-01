<?php $iainPageTitle = 'CSS temp'; $docDepth = 1;?>
<?php include '../partials/head.php'; ?>


<div class="row">
<div class="col-md-6">
<img src="cssBox.png" class="img-responsive" >
</div>
</div>

<hr />


<h3>The Properties</h3>

<p>Element sizing
<ul>
	<li>
		<strong>Margins</strong>: the spacing around an element, used to position it or others around.<br />
		<i>IE Bug: if floated and margins in the same direction, IE will double the margin to that side.</i><br />
		<i>IE Bug: Bottom margins are ignored - so best to use padding for the bottom.</i>
	</li>
	<li>
		<strong>Padding</strong>: again, the space around the element. Adding padding will increace the size of an element
		unless...
	</li>
	<li>
		<strong>box-sizing</strong>: the cure to the box model weirdness! Now padding and border cut into the element size rather than expanding it, 
		for all elements on the page!  There's loads out there on it, <a href="http://www.paulirish.com/2012/box-sizing-border-box-ftw/">Paul Irish</a>, 
		<a href="http://css-tricks.com/inheriting-box-sizing-probably-slightly-better-best-practice/">Chris Coyier</a>, <a href="http://css-tricks.com/international-box-sizing-awareness-day/">International box-sizing Awareness Day</a>
<pre><code>html {
	-webkit-box-sizing: border-box; /* Safari/Chrome, other WebKit */
	-moz-box-sizing: border-box;    /* Firefox, other Gecko */
	box-sizing: border-box;         /* Opera/IE 8+ */
}
*, *:before, *:after {
	box-sizing: inherit;
}</code></pre>
	</li>
	<li>
		<strong>Border</strong>: Used to add to the width, but now with box-sizing it's a lovely internal element border!
	</li>
</ul>
</p>

<p>Element position<br />
... copy into here the stuff I did before?</p>


<p>Other properties
<ul>
	<li>
		<code>align-content</code> 
	</li>
</ul>
</p>

<a href="http://css-tricks.com/almanac/">All the properties!</a> from CSS-Tricks.
<hr />


<h3>The Selectors</h3>



<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>