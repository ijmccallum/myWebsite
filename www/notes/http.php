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
	Held on their own shard?  - caution, too many connections can hur
	t your preformance, especially for mobile clients.	 
</p>

<p><strong>Protocal overhead</strong> headers sent with every http request are uncompressed plain text, commonly can be larger than the actual 
	data being sent wich is often compact JSON.<br />
Cookies are often a preformance bottleneck as they are added to the header as uncompressed plain text.</p>
<hr />
<h2>HTTP 2</h2>
<p>
	a few aims:
	<ul>
		<li>Request & responce multiplexing (multiple files through one stream, reduces protocal overhead (less headers) and network latecy (less requests) </li>
		<li>Compressed HTTP headers, agai lower protoval overhead</li>
		<li>Request prioratization</li>
		<li>Server push</li>
		<li>Keep the semantics of HTTP 1.1</li>
		<li>and more...</li>
	</ul>
</p>
<p>
	Began with Google's SPDY protocal, in 2012 the effort began to use and build upon those ideas with the official standard.  
	It adds another layer: the <i>'binary framing layer'</i>
</p>
<p>
	<strong>SPDY</strong> is still evolving - used as a testing ground for ideas that may go into HTTP 2.0
</p>
<p>
	HTTP 2.0 terms:
	<ul>
		<li>Stream: 2 way flow of bytes in a connection</li>
		<li>Message: A complete set of frames that form a logical collection of data</li>
		<li>Frame: the smallest unit of data, at minimum the frame header identifis the stream to which it belongs</li>
	</ul>
	A single TCP connection has many streams, each identified by a unique integer.  Communication is through messages made up from one or more frames (request/responce).
	Multiple streams can communicate over the same TCP connection in parallel.  Therefor, we can multiplex multiple resources removing the head of line blocking problem.
</p>
<p>
	This allows us to be free from various work-arounds like:
	<ul>
		<li>No more need to concatenate files</li>
		<li>No more need to sprite images</li>
		<li>No more need to shard domains</li>
	</ul>
</p>
<p><strong>Binary Framing Layer</strong>: Splits the HTTP packet into a Headers frame and a Data frame which are encoded in binary.<br />
Individual frames all have an 8 byte header containgin the following:
<ul>
	<li>Length of the frame, can carry ~64KB</li>
	<li>Type of frame
		<ul>
			<li>DATA</li>
			<li>HEADERS: additional headers</li>
			<li>PRIORITY</li>
			<li>RST_STREAM: abnorma termination of stream</li>
			<li>SETTINGS: the first frame of a stream</li>
			<li>PUSH_PROMISE</li>
			<li>PING: preformance check</li>
			<li>GOAWAY: stop creating streams</li>
			<li>WINDOW_UPDATE: controls flow per stream / per conection</li>
			<li>CONTINUATION: continues header fragments</li>
		</ul>
	</li>
	<li>flags</li>
	<li>31-bit stream identifier</li>
</ul>
<div class="row">
	<div class="col-md-6">
		<a href="http://chimera.labs.oreilly.com/books/1230000000545/ch12.html#HTTP2_FRAMING">Source</a>
		<img src="HTTP2frame.png" class="img-responsive">
	</div>
</div>
</p>
<p><strong>Settings frame</strong>: each connection begins with the exchange of setting frames, these can define various properties of the connection.</p>
<p><strong>Request Prioritization</strong>: streams can be given a 31-bit priority value (0 being the highest)</p>
<p><strong>Flow Control</strong>: individual streams can be manipulated as well as the entire connection size, control is on a hop-by-hop level.
It is similar to TCP flow control except it can also differentiate between streams.</p>

<p><strong>Server Push</strong>: Exactly what it says on the tin! Servers can start sending required resources ahead of time as the server already knows 
what the client will be needing.  Same origin policy still applies - servers cannot push third party content.<br />
<strong>PUSH_PROMISE</strong>: sent by the server to the client before pushing a resource.<br />
To implement the server can automatically detect resources that will need to be pushed by parsing or monitoring previous requests.  Or, we can let the server know
at the application level.</p>
<p><strong>Header tables</strong>: instead of sending identical headers with every packet he server and client hold 'header tables' which persist through the duration
of every request.  Every new header key-value pair will be appended to the table.</p>
<p>Some more resluting improvments:
<ul>
	<li>less network congestion due to smaller number of connections</li>
	<li>Less CPU overhead in dealing with smaller number of overheads</li>
	<li>Less latency as only one TCP handshake in initiated</li>
	<li>more efficent use of TCP, less time in slow-start</li>
</ul>
There are also some downsides:
<ul>
	<li>packet loss drops the congestion window size for the whole connection</li>
	<li>Head of line blocking in TCP is still there</li>
	<li>Upgrading servers and clients is going to take a while - HTTP 1.1 will probably be around for another decade or so</li>
</ul>
With HTTP 2.0 in place, the next preformance bottle neck appears to be TCP.
</p>
<p>Upgrading this layer should be transparent to our applications - they'll just work better! Hopefully!</p>
<p><strong>Initiating an HTTP 2.0 stream</strong><br />
Both the client and the server can initiate new streams with the following meta-data, 
<ul>
	<li>Client: can initiate a request with a HEADERS frame (new stream ID, ... , & some key-value pairs) <i>Client stream ID's are odd numbers</i></li>
	<li>Server: can initiate a push with a PUSH_PROMISE frame (same as above plus 'promised stream ID') <i>Server stream ID's are even numbers</i></li>
</ul>
With a stream initiated application data can be sent in DATA frames, the final one with END_STREAM flag.  Compression is left up to the application / server.
</p>
<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>