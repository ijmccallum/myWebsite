<?php $iainPageTitle = 'Browsers'; $docDepth = 1;?>
<?php include '../partials/head.php'; ?>

<h2><h2>Browser Networking</h2></h2>
<p><strong>Sockets</strong> are grouped into pools by origin (domain + Protocal + Port) usually a max of 6, each pool managing it's own security and restraints.  These pools are shared amoungst the various browser processes.</p>

<p>Browsers are developing preformance improvemnts in two main areas:
<ul>
	<li><strong>Document-aware optimization</strong>: prioratising and fetching the JS/CSS requirments to get the page interactive as soon as possible</li>
	<li><strong>Speculative optimization</strong>: Learning the users behaviour, pre-resolving DNS, pre-connecting to likley hostnames...</li>
</ul>
As application developers we can help out the browser by 
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

<hr />
<h3>Security and Sandboxing</h3>
<p>Applications do not have access to individual ports so they cannot initiate arbitrary connections.</p>
<p>Browsers enforce a <strong>Same-origin policy</strong> controlling which requests an application can make and to where.</p>

<hr />
<h3>Caching</h3>
<p>The browser automatically manages the cach size, resource eviction, and access.  It also checks the cache before dispatching any network request.</p>

<hr />
<h3>cookie management</h3>
<p>The browser uses 'cookie jars' for each origin.</p>
<hr />
<h3>session managment</h3>

<hr />
<h3>authentication</h3>

<hr />
<h2>API's & protocals</h2>
<table >
<thead><tr>
<td >&nbsp;</td>
<td >XMLHttpRequest</td>
<td >Server-Sent Events</td>
<td >WebSocket</td>
</tr>
<tbody>
<tr>
<td ><p>Request streaming</p></td>
<td ><p>no</p></td>
<td ><p>no</p></td>
<td ><p>yes</p></td>
</tr>
<tr>
<td ><p>Response streaming</p></td>
<td ><p>limited</p></td>
<td ><p>yes</p></td>
<td ><p>yes</p></td>
</tr>
<tr>
<td ><p>Framing mechanism</p></td>
<td ><p>HTTP</p></td>
<td ><p>event stream</p></td>
<td ><p>binary framing</p></td>
</tr>
<tr>
<td ><p>Binary data transfers</p></td>
<td ><p>yes</p></td>
<td ><p>no (base64)</p></td>
<td ><p>yes</p></td>
</tr>
<tr>
<td ><p>Compression</p></td>
<td ><p>yes</p></td>
<td ><p>yes</p></td>
<td ><p>limited</p></td>
</tr>
<tr>
<td ><p>Application transport protocol</p></td>
<td ><p>HTTP</p></td>
<td ><p>HTTP</p></td>
<td ><p>WebSocket</p></td>
</tr>
<tr>
<td><p>Network transport protocol</p></td>
<td><p>TCP</p></td>
<td><p>TCP</p></td>
<td><p>TCP</p></td>
</tr>
</tbody>
</table>
<a href="http://chimera.labs.oreilly.com/books/1230000000545/ch14.html#APPLICATION_APIS_AND_PROTOCOLS">Table source</a>

<h3>XMLHttpRequest</h3>
<p>Began life with Ie5 thanks to development efforts from the Outlook Web Access team, it is now a key building block of AJAX in modern browsers.
In using it the browser takes care of low level work: managing connections, protocals, security, redirects...  </p>	
<p>It has support in many <strong>older browsers</strong> and is therefor a common fallback from the more modern methods.</p>

<p><strong>Custom request headers</strong> are possible to set using <code>setRequestHeader()</code> although some are off limits to the application.</p>
<p><strong>Cross-Origin Resource Sharing (CORS)</strong>: provides a secure opt-in mechanism for initiating XHR requests to a third party domain.
	XHR requests are limited to the same origin as the XHR script origin for security (site A cannot access log in details for site B).<br />
	A comparison of normal XHR and Cross-origin XHR:
<pre><code>// script origin: (http, example.com, 80)
var xhr = new XMLHttpRequest();
xhr.open('GET', '/resource.js');
xhr.onload = function() { ... };
xhr.send();

var cors_xhr = new XMLHttpRequest();
cors_xhr.open('GET', 'http://thirdparty.com/resource.js');
cors_xhr.onload = function() { ... };
cors_xhr.send();</code></pre>
	<a href="http://chimera.labs.oreilly.com/books/1230000000545/ch15.html#CORS">example source</a></p>
	<p>A cross-origin XHR is sent to the third party server with a note of the request origin, the server can check the origin and allow the request by
	adding an <code>Access-Control-Allow-Origin: http://example.com</code> header to the responce.</p>
	<p>Cookies and HTTP authentication are removed from CORS requests but can be included when the <code>withCredentials</code> 
	object is set on the XHR object and the server returns a <code>Access-Control-Allow-Credentials</code> header.</p>
	<p>Only simple requests are allowed unnless the client askes and gets permission from the third party server, called a <i>preflight request</i></p>
<p><strong>Data types:</strong> ArrayBuffer  |  Blob  |  Document  |  JSON  |  Text</p>


<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>