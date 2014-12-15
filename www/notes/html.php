<?php $iainPageTitle = 'HTML'; $docDepth = 1;?>
<?php include '../partials/head.php'; ?>



<hr />
<h2>HTML Accessibility</h2>
<h3>For the blind:</h3>
<p>Screen reading software covers the whole operating system, not just the browser 
	(not being blind myself I hadn't appreciated this now admitadly very obvious fact).

	<strong>Some problems we may not consider:</strong>
<ul>
	<li><strong>Links & junk proceeding an article</strong>Do you have a huge number of links that a screen reader will read through befor actually alowing the user to the reach the article?</li>
	<li><strong>Tables are bad for a reason:</strong> the screen reader will read through them from left to right, if you're laying out content colums that are ment to be read
		from top to bottom you are immidiatly destroying your site's accesibility.</li>
	<li>AJAX updates - got to notify the screen reader using some ARIA tags</li>
	<li>Don't autofocus, it's disorientating!</li>
</ul>

</p>

<hr />

<h2>ARIA (Accessible Rich Internet Applications)</h2>
<p><i>Modern Web pages are beginning to act more like desktop applications, but the underlying HTML does not alwayse reflect this.  HTML5 does give us more
semantic tags but they don't alwayse cover the bases for aceability when you consider how things like screen readers work.  This is where 
<a href="https://developer.mozilla.org/en/ARIA">ARIA</a> comes in allowing us to further define and describe elements within the markup and cover those missed bases.</i></p>

<p>ARIA tags come in three types: roles, states, and properties
<ul>
	<li>Roles: sliders, menu bars, tabs, and dialogs</li>
	<li>States: busy, disabled, selected, or hidden.</li>
	<li>Properties: draggable, have a required element, or have a popup associated with them...</li>
</ul>
</p>


<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>