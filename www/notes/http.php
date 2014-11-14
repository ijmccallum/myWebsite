<?php $iainPageTitle = 'HTTP'; $docDepth = 1;?>
<?php include '../partials/head.php'; ?>

<p>The original goals (with simplicity in mind) :
<ul>
	<li>File Transfer</li>
	<li>Index search request</li>
	<li>format negotiation</li>
	<li>Refer the client to another server</li>
</ul>
As the web has grown we have gone through 3 fairly well defined stages in the development of it's content:
<ol>
	<li>Hypertext documents: plain text with hyperlinks,<br />
		HTTP 0.9, a single document request, <i>document load time</i> is important</li>
	<li>Web pages: more Layout options and media,<br />
		HTTP 1.0, introduces metadata(headers), HTTP 1.1 preformance improvments, <i>page load time</i> is important</li>
	<li>Web applications: rich interactivity, AJAX ...,<br />
		Page load time is no longer sufficent, welcome to the world of analytics!</li>
</ol>
</p>
<div class="row">
<div class="col-md-6">
<img src="browserPipeline.png" class="img-responsive" >
<a href="http://chimera.labs.oreilly.com/books/1230000000545/ch10.html#_hypertext_web_pages_and_web_applications">The Source</a>
</div>
</div>
<h2>HTTP 1.1</h2>


left off<a href="http://chimera.labs.oreilly.com/books/1230000000545/ch10.html#ANATOMY_OF_WEB_APPLICATION">here</a>

<hr />
<h2>HTTP 2</h2>
<p>Aiming for higher transport preformance, lower latency and higher throughput.  
	Upgrading this layer should be transparent to our applications - they'll just work better! Hopefully!</p>
<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>