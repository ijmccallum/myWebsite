<?php $iainPageTitle = 'Browsers'; $docDepth = 1;?>
<?php include '../partials/head.php'; ?>

<h2>Smarter Everyday!</h2>
<p>Browsers are developing preformance improvemnts in two main areas:
<ul>
	<li><strong>Document-aware optimization</strong>: prioratising and fetching the JS/CSS requirments to get the page interactive as soon as possible</li>
	<li><strong>Speculative optimization</strong>: Learning the users behaviour, pre-resolving DNS, pre-connecting to likley hostnames...</li>
</ul>
As applicatino developers we can help out the browser by 
<ul>
	<li>placing CSS as early as possible in the document to unblock rendering and JS execution</li>
	<li>Deferring non-critcal JS</li>
	<li>Give the browser hints as to what may happen next:
		<ul>
			<li><code>&lt;link rel="dns-prefetch" href="//hostname_to_resolve.com"&gt;</code></li>
			<li><code>&lt;link rel="subresource"  href="/javascript/myapp.js"&gt;</code></li>
			<li><code>&lt;link rel="prefetch"     href="/images/big.jpeg"&gt;</code></li>
			<li><code>&lt;link rel="prerender"    href="//example.org/next_page.html"&gt;</code></li>
		</ul>
	</li>
</ul>
</p>

<p>In depth browser networking with chrome, <a href="https://www.igvita.com/posa/high-performance-networking-in-google-chrome/">link!</a></p>
<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>