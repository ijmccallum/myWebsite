<?php $iainPageTitle = 'Web Components'; $docDepth = 1;?>
<?php include '../partials/head.php'; ?>

<p>
	Take a widget / complex modular piece of HTML and abstract it to hide the messy details.  Encapsulation of HTML (without iframes!)
</p>

<h3>Step by step</h3>
<ol>
	<li>Identify a widget or modular feature you intend to create on a web page in HTML.  Eg, the bootstrap panel with title</li>

	<li>Pop a div onto your page with the simplest possible mark up for your widget,
		this will host the web component and, as a result, is knowen as the 'shadow host'.
		going with the example:
<pre><code>&lt;div id="shadowHost"&gt;
	&lt;h3&gt;Title&lt;/h3&gt;
	&lt;p&gt;paragraph&lt;/p&gt;
&lt;/div&gt;</code></pre>
	</li>

	<li>Crete the proper markup of your widget but place it inside a <code>&lt;template&gt;</code> tag and add in <code>&lt;content&gt;</code>
		tags with relevant selectors marking the places content will be injected (just look at the h3 and p tags above and below to see what I mean)
<pre><code>&lt;template id="bootstrapPanelTemplate"&gt;
	&lt;div class="panel panel-default"&gt;
		&lt;div class="panel-heading"&gt;
			&lt;h3 class="panel-title"&gt;
				&lt;content select="h3"&gt;&lt;/content&gt;
			&lt;/h3&gt;
		&lt;/div&gt;
		&lt;div class="panel-body"&gt;
			&lt;content select="p"&gt;&lt;/content&gt;
		&lt;/div&gt;
	&lt;/div&gt;
&lt;/template&gt;</code></pre></li>

	<li>Turn the simple markup into the shadow host: <code>var host = document.getElementById('shadowHost').createShadowRoot();</code></li>

	<li>Grab the template: <code>var template = document.getElementById('bootstrapPanelTemplate');</code><br />
	Clone it???: <code>var clone = document.importNode(template.content, true);</code><br />
	Append it to the shadow host: <code>host.appendChild(clone);</code></li>
</ol>

<hr />

<p>
	Here's a live example.  Note the rest of this site is built using bootstrap but the css does not apply to the component below - it's protected!
	So, it would be possible to add in the panel styling into it's template without worrying about clashing with other elements - the css selectors
	could be minimised, all the instances of 'panel' in the selectors could be removed.
</p>

<!-- The live example -->

<div id="shadowHost">
	<h3>Title</h3>
	<p>paragraph</p>
</div>

<template id="bootstrapPanelTemplate">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">
				<content select="h3"></content>
			</h3>
		</div>
		<div class="panel-body">
			<content select="p"></content>
		</div>
	</div>
</template>

<script charset="utf-8">
	var host = document.getElementById('shadowHost').createShadowRoot();
	var template = document.getElementById('bootstrapPanelTemplate');
	var clone = document.importNode(template.content, true);
	host.appendChild(clone);
</script>

<!-- End of example -->

<hr />

<h3>Delivering Web Components: HTML import</h3>
<p>
	The above example tempate can be saved within it's own file and imported as follows:
	<code>&lt;link rel="import" href="/path/to/imports/stuff.html"&gt;</code> <br />
	This gives us a few awesome advances:
	<ul>
		<li>This html file can include all the JS and CSS required for the component -
			one import link for all the goodies, no more juggling multiples with JS, CSS and pasting markup in.</li>
		<li>The CSS, JS and it's own import links are inert (not loaded) unless the component is actually used.</li>
	</ul>

</p>

<h3>One issue this creates: more TCP round trips, unless...</h3>
<p>
	Pre compile (grunt) the components you use into one / few html file(s).  Might be especially handy if the JS and CSS were all brought together
	into a few files, less round trips, more speed! 
</p>

<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>
