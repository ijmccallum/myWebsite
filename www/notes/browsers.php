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
<h3>Cookies</h3>
<p>In effect: <i>small plain text files stored on the users machien.</i> The page/server instructs the browser to send the cookies back with every 
	request.  Often used for keeping users logged in or holding info for shopping carts.</p>
<p><strong>Cookies are set</strong> by sending a setcookie header: <code>Set-Cookie: name=name; expires=date; domain=domain; path=path; </code>
<ul>
	<li><code>name</code></li>
	<li><code>value</code></li>
	<li><code>expires</code>: <code>Wdy, DD-Mon-YYYY HH:MM:SS GMT</code> | <code>Sat, 02 May 2009 23:38:25 GMT</code><br />
		If no expires option set then cookie lasts the lenght of a session and is deleted when the browser is shut down.</li>
	<li><code>path</code> if set to <code>/blog</code> then cookie would be sent to /blog or /blogroll or anything beginnning with /blog</li>
	<li><code>domain</code> automatically set to www.domain.com, so wouldn't work on me.domain.com, but can be fixed by setting to <code>domain.com</code><br />
		Cannot set domain to <code>domain2.com</code></li>
	<li><code>secure</code> if added (it's only a flag, no value) then cookies will only be sent over SSL and HTTPS.<br />
		<i>note: cookies are inherently not secure and should never be used to send sensitive data</i></li>
	<li><code>httponly</code> stops javascript from accessing the cookie in order to help prevent some XSS attacks</li>
</ul>
Cookie options can be set in any order:
<pre><code>Set-Cookie: name=Nicholas; domain=nczonline.net; path=/blog
Set-Cookie: name=Greg; domain=nczonline.net; path=/blog
Set-Cookie: name=Nicholas; domain=nczonline.net; path=/
//after setting these two cookies and request to  www.nczonline.net/blog will also send:
Cookie: name=Greg; name=Nicholas
</code></pre>
</p>
<p>They are <strong>returned to the server</strong> in a simple HTTP header called <i>Cookie</i> as follows: <code>Cookie: value</code>, for pages with
multipl cookies the cookie header is more like <code>Cookie: value1; value2; name1=value1</code></p>
<p>When the max number of cookies in the browser is reached the oldest are removed to make way for the newest.  
<ul>
	<li>Firefox and IE limit to 50 cookies per domain</li>
	<li>Opera limits to 30</li>
	<li>Safari and Chrome have no limit</li>
	<li>The max size for all cookies sent is 4KB</li>
</ul></p>
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

<h3>XMLHttpRequest - Client request, server responce</h3>
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
	<p><strong>Data types:</strong> ArrayBuffer  |  Blob  |  Document  |  JSON  |  Text<br />
	The browser can figure out the correct data or te application can set it with the XHR request <code>xhr.responseType = 'blob';</code></p>
	<p>it is also possible to send DOMString, Document, FormData, Blob, File, or ArrayBuffer via the <code>xhr.send()</code> method 
		although XHR does not support streaming (unless you're up for a headache).</p>
	<p><strong>Real time with XHR</strong>, ish, the effect can be achieve by using <strong>XHR polling</strong> - checking the server for updates intermitantly, 
		but this can become expensive with a large number of clients.  To offset this there is <strong>XHR long polling</strong> in which a connection is held open,
		so if an update comes through it can be 'pushed' immidiatly to the client.  It's still not the best strategy but is widley supported and therefor a good fallback.</p>

<h3>Server-Sent Events (SSE): Server to client, text based real time</h3>
	<p><i>not supported in Internet Explorer or stock android browser.  Intermidiaries can negativly affect/break SSE unless delivered over a TLS connection</i></p>
	<p>Uses a single long-lived connection, creats DOM notificatoins for the client, is effecitivly a cross-browser solution using XHR but keeps the complexity hidden.
		It deals with re-establishing connections.</p>
	<p><strong>EventSource API</strong>, it can also use CORS permission for cross-browser requests.
<pre><code>var source = new EventSource("/path/to/stream-url"); 1

source.onopen = function () { ... }; 2
source.onerror = function () { ... }; 3

source.addEventListener("foo", function (event) { 4
  processFoo(event.data);
});

source.onmessage = function (event) {  5
  log_message(event.id, event.data);

  if (event.id == "CLOSE") {
    source.close(); 6
  }
}</code></pre>
	<a href="http://chimera.labs.oreilly.com/books/1230000000545/ch16.html#EVENTSOURCE_API">code link</a>
	For use on mobile this can have a negative effect on battery life, possibly batch messages to minimise radio use.
	</p>

<h3>WebSockets: Server to client and client to server, bio-directional realtime text and binary</h3>
<p><i>SockJS / Socket.IO provides emulation of WebSockets if required, also works cross-origin with CORS.  Some networks will block WebSockets 
so we need a fallback (TLS can extend timeouts and get through many problems but does still fail on occasion)</i></p>
<pre><code>var ws = new WebSocket('wss://example.com/socket');

ws.onerror = function (error) { ... }
ws.onclose = function () { ... }

ws.onopen = function () {
  ws.send("Connection established. Hello server!");
}

//onmessage will only be available when the whole message is available to the client
ws.onmessage = function(msg) {
  if(msg.data instanceof Blob) {
  	//binary data is converted to a blob object, or an ArrayBuffer if hinted (only good if you need to do more processing on the data)
    processBlob(msg.data);
  } else {
  	//text data is converted to DOMString
    processText(msg.data);
  }
}</code></pre>
<p><code>ws</code> for normal, <code>wss</code> for secure.  It has a custom URL scheme as it can be used outside HTTP exchanges, 
	although this isn't common.</p>
	<p>the <code>send()</code> method is asyncronous, to determin it's status we can query the <code>bufferedAmount</code> on the object.  If sending 
		large amounts of data WebSockets will suffer from head of line blocking, it's good to check the <code>bufferedAmount</code> has reached 0 
		before piling more data through the connection.  Using this we can even implement our own traffic control with priority levels at the application level.
	</p>
	<p>WebSocket packets do not contain headers (save for a single bit signalling binary or text data) so there is no way of cliet/server informing the other
		as to any changes or requests for protocals, except when opening the connection:
<pre><code>var ws = new WebSocket('wss://example.com/socket',
                       ['appProtocol', 'appProtocol-v2']);

//check which is chosen by the server
ws.onopen = function () {
  if (ws.protocol == 'appProtocol-v2') { 
    ...
  } else {
    ...
  }
}</code></pre>
<a href="http://chimera.labs.oreilly.com/books/1230000000545/ch17.html#_subprotocol_negotiation">source</a>

	</p>




<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>