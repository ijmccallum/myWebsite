<?php $iainPageTitle = 'CSS'; $docDepth = 1;?>
<?php include '../partials/head.php'; ?>

<p>Not going over the basics here, just things I like to have clear in my own head!</p>
<hr />

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

<p><strong>Box-sizing</strong>: setting this will allow manipulation of anythin in the box-model below margins without having to worry about changing
the actual width of the element
<pre><code>* {
  -webkit-box-sizing: border-box;
     -moz-box-sizing: border-box;
          box-sizing: border-box;
}</code></pre>
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


<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>