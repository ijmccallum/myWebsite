<?php $iainPageTitle = 'CSS'; $docDepth = 1;?>
<?php include '../partials/head.php'; ?>

<p>Not going over the basics here, just things I like to have clear in my own head!</p>
<hr />

<div class="row">
<div class="col-md-6">
<img src="cssBox.png" class="img-responsive" >
</div>
</div>

<h3>CSS Layout properties</h3>

<p><strong>Position</strong>
	<ul>
		<li><i>Static</i>: business as usual</li>
		<li><i>Fixed</i>: fixed relative to the window, won't scroll</li>
		<li><i>Relative</i>: placed relative to 'normal', it's space will be reserved</li>
		<li><i>Absolute</i>: relative to the first non-static parent, defaults to &lt;html&gt;</li>
	</ul>
</p>

<p><strong>float</strong>: created to allow text to flow around another element.
	<ul>
		<li><i>Right</i>: </li>
		<li><i>Left</i>: Both do exactly what they say on the tin</li>
	</ul>
	We also have <code>clear: left;</code> / <code>clear: right;</code> / <code>clear: all;</code> in order to 
	avoid an element moving up beside a floated element when it shouldn't.<br />
	<i>Weirdness with the parent: Collapsing containing divs</i> If the float is expanding past the height of it's parent div 
	unintentionally, or if the parent div is collapsing to nothing as it holds nothing but floats use &lt;div style="clear: both;"&gt;&lt;/div&gt;
	after the floats and before the parent's close.
</p>

<p><strong>Display</strong>
	<ul>
		<li><i>block</i>: streatches as wide as it can,<br />
			if we set the width then the rest of the width will be taken up by margins<br />
			if we set the side argins to <i>auto</i> the block-level element will be centered within it's parent
		</li>
		<li><i>inline</i>: like &lt;a&gt; or &lt;span&gt;</li>
		<li><i>none</i>: will ignore the element completly (visibility:hidden; will leave a gap)</li>
		<li><i>inline-block</i>: like inline plus the ability to set width and height!<br />
			These are affected by the <i>vertical-align</i> property.
		</li>
	</ul>
</p>

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

<p><strong>Flexbox</strong>: flexible layout module to help with responsive layouts.  It consitis of a 
	<i>Flex container</i> (<code>display: flex;</code>) and <i>flex items</i>.<br />
	The container:
	<ul>
		<li>We can set the direction: <code>flex-direction: row | row-reverse | column | column-reverse;</code></li>
		<li>the wrap: <code>flex-wrap: nowrap | wrap | wrap-reverse;</code></li>
		<li><i>short hand for the above: <code>flex-flow: &lt;‘flex-direction’&gt; || &lt;‘flex-wrap’&gt;</code></i></li>
		<li>the justification: <code>justify-content: flex-start | flex-end | center | space-between | space-around;</code><br />
			space-between will not leave any space between the container edge and the first item, ditto for the end<br />
			space-around will add space at the edges
		</li>
	</ul>
	The children:
	<ul>
		<li>We can manipulate the order: <code> order: &lt;integer&gt;;</code></li>
		<li>We can set the proportional size with arbratery numbers: <code>flex-grow: &lt;number&gt;;</code></li>
		<li></li>
	</ul>
	<a href="http://css-tricks.com/snippets/css/a-guide-to-flexbox/">a more visual guide to the flexbox elements</a>
</p>

<a href="http://css-tricks.com/almanac/">All the properties!</a> from CSS-Tricks.

<hr />

<h3>CSS Shapes</h3>

<hr />

<h3>CSS animations</h3>


<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>