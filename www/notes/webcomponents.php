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

<h3>Delivering Web Components: <strong>HTML import</strong></h3>
<p>Basically the same as including a JS or CSS file.  You define a &lt;link&gt; tag and point it to a .html file. Easy!</p>

<p>
	<strong>Firefox</strong> <a href="https://hacks.mozilla.org/2014/12/mozilla-and-web-components/">will not support HTML imports</a>,
	but there are polyfills that will solve this problem: eg, Polymer's polyfill.
</p>

<p>To check <a href="http://caniuse.com/#feat=imports">support</a>:</p>
<pre><code>function supportsImports() {
  return 'import' in document.createElement('link');
}

if (supportsImports()) {
  // Good to go!
} else {
  // Use other libraries/require systems to load files.
}</code></pre>

<p>
	So HTML imports give us a few awesome advances:
	<ul>
		<li>This html file can include all the JS and CSS required for the component -
			one import link for all the goodies, no more juggling multiples with JS, CSS and pasting markup in.</li>
		<li>The CSS, JS and it's own import links are inert (not loaded) unless the component is actually used.</li>
	</ul>

	They also give us a few things to think about:
	<ul>
		<li>More requests = more round trips between client and server = more time. Unless you precompile?</li>
	</ul>

</p>



<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>
