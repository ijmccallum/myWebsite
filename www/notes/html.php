<?php $iainPageTitle = 'HTML'; $docDepth = 1;?>
<?php include '../partials/head.php'; ?>



<hr />
<h2>HTML Accessibility</h2>

<p><strong>The Alt tag</strong>: provides the information contained in the image to those who browse using a screen reader, search engines and also those
who may have turned off images to lower bandwidth usage.</p>

<p><strong>Keyboard input</strong>: it's required as many people cannot actually use a mouse be it for visual or fine motor control reasons. </p>

<p><strong>Audio transcripts</strong>: some can't see images, others can't hear audio (search engines have nither): </p>

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
<h3>Assistive technologies</h3>

<h3>Keyboard navigation</h3>

<hr />

<h3>ARIA (Accessible Rich Internet Applications)</h3>
<p><i>The acesability standard for making modern web applications acesible to those with disabilities who use supportive technologies (like screen readers...).
</i></p>

<p>ARIA fills the gaps left in current HTML impleentations by defiing tags to be added to elements in order to allow assistive tech to understand them.  As HTML
and it;s support in browsers is constantly being developed the gaps filled by ARIA do get filled, so with this in mind there are a few 'ARIA rules' to watch for:
<ol>
	<li>
		If you can use an HTML element that has your required behaviour already built in 
		(<a href="http://www.html5accessibility.com/">including acessibility support</a>), use it.
	</li>
	<li>
		Don't change the function of native elements, eg:<br />
<pre><code>&lt;h1 role=button&gt;heading button&lt;/h1&gt; BAD!<br />
&lt;h1&gt;&lt;button>heading button&lt;/button&gt;&lt;/h1&gt; GOOD!<br />
&lt;span role=button&gt;heading button&lt;/span&gt; ALSO GOOD!
</code></pre>
	</li>
	<li>All interactive ARIA controlls must also be usable with a <strong>keyboard</strong></li>
	<li>Do not use <code>role="presentation"</code> or <code>aria-hidden="true"</code> on a focusable element <i>(need to expand on this)</i></li>
	<li>All interactive elements must have an .<a href="http://www.w3.org/TR/wai-aria/terms#def_accessible_name">accessible name</a></li>
</ol>
</p>

<p>These tags fall into three categories:
	<ul>
	<li>Roles: sliders, menu bars, tabs, and dialogs</li>
	<li>States: busy, disabled, selected, or hidden.</li>
	<li>Properties: draggable, have a required element, or have a popup associated with them...</li>
</ul>
These should be applied to HTML elements and, to make life simpler, CSS selectors should use the ARIA tags (where apropriate) to select elements to style.
</p>


<p><i>It's used to navigate desktop applications with speed, commonly using the tab, space, enter and arrow keys.  On the web, this is usually restricted to only the tab key.</i></p>
<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>