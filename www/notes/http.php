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

<p><strong>Keepalive</strong> (/persistant) connections:<br />
Every HTTP connection begins with a three way TCP handshake with the resource request chasing the third handshake packet, 
then server processing time before the data can begin making it's way to the client.  So, using the same connection to get 2 resources
rather than two connections saves at least a full round trip of latency.  Fortunatly, this is generally done automatically by the browser but does require
your server to play ball - if it's using HTTP 1.1 it will.
</p>

<p><strong>Pipelining</strong><br />
This improves keepalive connections in which a client will have to wait on a resource completing it's journey before requesting the next.
So we request a series of resources in the first packet which the server will fetch and queue to be sent one after another without waiting 
for the subsiquent requests elimenating yet more round trips!
</p>

<p><strong>Head of line blocking</strong>: unfortunatly the various requests cannot be fetched in parallel ready to be sent by the server,
with HTTP 1.x one resource must be sent in full before the first bytes of the next resource can go.  We are also prevented from multiplexing several
resources and run into further problems with the intricacies of intermediaries, so HTTP pipelining isn't big.  But, in cases where you controll both the
client and the server it can have huge preformance gains (think: iTunes)</p>

<p><strong>Multiple TCP Connections</strong>, currently 6 per host<br />
	It's not perfect but we must to workaround HTTP 1.x limitations, low TCP congestion window sizes, clients unable to use TCP window scaling.  
	To implement upgrades to TCP connecitons just upgrade to the latest OS kernel on your server.
<div class="row">
	<div class="col-md-6">
		Pros:
		<ul>
			<li>Number of parallel requests == number of TCP connections</li>
			<li>TCP congestion window *= TCP connecitons (circumnavigating slow-start)</li>
		</ul>
	</div>
	<div class="col-md-6">
		cons:
		<ul>
			<li>more CPU overhead</li>
			<li>Competition for bandwidth between parallel connecions</li>
			<li>Higher implementation complexity</li>
			<li>Limited application parallelism ... ?</li>
		</ul>
	</div>
</div>
</p>

<p><strong>Domain Sharding</strong>: a work around to the 6 connection limit imposed on a single domain<br />
	sending requests to  {shard1, shardn}.example.com allows us to increase the number of TCP connections beyond 6.  
	This will require an extra DNS lookup and impose organisational annoyances on the site author.  One idea: common (propriatory) libraries
	Held on their own shard?  - caution, too many connections can hurt your preformance, especially for mobile clients.	 
</p>

<p><strong>Protocal overhead</strong> headers sent with every http request are uncompressed plain text, commonly can be larger than the actual 
	data being sent wich is often compact JSON.<br />
Cookies are often a preformance bottleneck as they are added to the header as uncompressed plain text.</p>
<hr />
<h2>HTTP 2 (built from Google's SPDY)</h2>
<p>Aiming for higher transport preformance, lower latency and higher throughput.  
	Upgrading this layer should be transparent to our applications - they'll just work better! Hopefully!</p>
<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>