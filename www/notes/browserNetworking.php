<?php $iainPageTitle = 'Networking'; $docDepth = 1; ?>
<?php include '../partials/head.php'; ?>


<ul class="list-group">
  <li class="list-group-item">Application (HTTP, ...)</li>
  <li class="list-group-item">Session (TLS)</li>
  <li class="list-group-item">Transport (TCP / UDP)</li>
  <li class="list-group-item">Network (IP)</li>
  <li class="list-group-item">Data Link</li>
  <li class="list-group-item">Physical Link</li>
</ul>

<i>Lanetcy</i>: travel time of a packet:
<ul>
  <li>Propegation - the time it takes to travel the distance - you're going to be hard pushed to get this faster</li>
  <li>Transmission - how long a messgae takes to send (message length and data rate of a link)</li>
  <li>Processing - as in time taken by a router to process the packet</li>
  <li>Queue - if the router is falling behind, incoming data will be queued</li>
  <li>Bandwidth - size of a path</li>
  <li>Datagram - a self contained packet, as in it does not rely on the order of delivery and has not been fragmented from a larger piece of data</li>
  <li>Bufferbloat - huge buffers in routers with the aim of dropping little to no data</li>
</ul>
<p>A packet travelling from A to B will be delayed in a similar manner to you or I driving somewhere, 
  time will also be affected by the number of routers and how busy they are.  Try running <code>tracert google.com</code> from 
the command line to see how many routers your packet will travel through to get to google.</p>

<ul>
  <li>100-200ms: perceptible lag</li>
  <li>300ms: sluggish</li>
  <li>1000ms: attention loss</li>
</ul>
<p>Out of interest, on <a href="http://chimera.labs.oreilly.com/books/1230000000545/ch01.html#PROPAGATION_LATENCY">this page</a> is a table showing the time it takes for a signal to travel between several locations on earth.</p>
<!-- Just in case the link dies, we've still got the table!
<table class="table table-striped">
<thead><tr>
<td>Route</td>
<td>Distance</td>
<td>Time, light in vacuum</td>
<td>Time, light in fiber</td>
<td>Round-trip time (RTT) in fiber</td>
</tr></thead>
<tbody>
<tr>
<td><p>New York to San Francisco</p></td>
<td><p>4,148 km</p></td>
<td><p>14 ms</p></td>
<td><p><strong>21 ms</strong></p></td>
<td><p>42 ms</p></td>
</tr>
<tr>
<td><p>New York to London</p></td>
<td><p>5,585 km</p></td>
<td><p>19 ms</p></td>
<td><p><strong>28 ms</strong></p></td>
<td><p>56 ms</p></td>
</tr>
<tr>
<td><p>New York to Sydney</p></td>
<td><p>15,993 km</p></td>
<td><p>53 ms</p></td>
<td><p><strong>80 ms</strong></p></td>
<td><p>160 ms</p></td>
</tr>
<tr>
<td><p>Equatorial circumference</p></td>
<td><p>40,075 km</p></td>
<td><p>133.7 ms</p></td>
<td><p><strong>200 ms</strong></p></td>
<td><p>200 ms</p></td>
</tr>
</tbody>
</table>
-->
<p><strong>Making your software faster</strong> we need to reduce the number of round trips, move the data closer, and trick the user into percieving greater speed.</p>

<hr />

<p>CDN, Content Deliver Networks - providing cached data in a closer physical location to requests</p>
<ul>
  <li>MaxCDN</li>
  <li>CloudFlare (offers basic free plan)</li>
  <li>Rackspace Cloud Files</li>
  <li>CacheFly (expensive but possibly worth it for big players)</li>
  <li>Incapsula (free plan)</li>
  <li>jsdelivr (free)</li>
</ul>

<hr />
<h2><strong>IP</strong> - The Internet Protocal</h2>
<p>This sits below TCP and UDP.  It delivers datagrams wrapped in IP packets to their destination, the packet holds the address and a number of other routing paramaters.
Bad preformance of the network will be exposed to the layers above IP, and so things like TCP and UDP must deal with it in their own ways.</p>
<div class="row">
  <div class="col-md-6">
    <p><i>IP packet, from <a href="http://chimera.labs.oreilly.com/books/1230000000545/ch03.html#NULL_PROTOCOL">here</a></i></p>
   <img src="IPpacket.png" class="img-responsive">
  </div>
</div>

<h3>Running out of IP addresses, the NAT box solution (<i>Network Address Translation</i>)</h3>
<p>A temporary solution that's here to stay!  A public router has the public IP, all the devices behind that router have their own private IP, thus reducing the number of 
public IP addresses required.</p>

<hr />
<h2><strong>TCP</strong> - The protocal of choice for Web, Email, FTP ...</h2>
<p><i>Hides the complexity of network communication, TCP Guarentees that sent data will arrive accuratly as opposed to quickley</i></p>
<p><strong>3 way handshake</strong> To start: 1. Client sends SYN packet with rnd number (x)  2. Server replies with y = (x+1), SYN ACK  3. Client replies with y+1 & x+1 ACK<br />
For recieveing data, this requires one full round trip.
</p>
<p><strong>Flow control</strong> During the life of a TCP connection Server and Client advertise how much data they are willing to recieve, the 
  <i>recieve window</i> or rwnd.  Each can then regulate how much data is sent to avoid overwhelming either party</p>
<p><strong>Slow Start</strong> Flow control only caters to client and server, not the intermidiaries.  The sender keeps a variable cwnd 
  (<i>congestion window size</i>), it controls how much data to send in between each ACK.  With every sucessfull trip, it grows exponentially until data loss, 
  then it drops back one level and grows exponentially from there.  After a connection idles the cwnd limit will be reset to a safe level.  
  This only impacts new TCP connections so to improve the proeformance of normal websites (not those streaming large amounts of data) you should check the cwnd initial value on your server.</p>
<p><strong>Head of Line Blocking</strong>, or <i>jitter</i>: if one packet is dropped on the way, then the reciever will hold all subsequet packets in buffer until the dropped
packet is resent.  This is in the TCP layer so our application will only percieve a delay then a jump.</p>
<p><i>If the order of packets is not a requirment, if each packet holds a stand alone message, then in-order delivery isn't important and an alternative connection like <strong>UDP</strong> should be used.</i></p>
<p>To get the best preformance for TCP from your server there are a few things to do:
<ul>
  <li>Get the latest kernal - it'll have the various TCP variables tuned to the latset standards</li>
  <li>Increase the initial congestion window size</li>
  <li>Disable Slow-start restart (will improve preformance for long-lived connections that transfer data in bursts)</li>
  <li>Enable Window Scaling (RFC 1323) - increases the maximum window size (as indicated by the limited number of bits)</li>
  <li>TCP Fast open - needs support on both client and server</li>
</ul>
</p>

<p><strong>NAT problems</strong> they sometimes time out TCP connections in the same way they do with UDP (explained below).  So TCP packets may also have to be sent through to keep a long term connection alive.</p>

<hr />
<h2><strong>UDP</strong> - Packets of data that don't rely on order of delivery, or even successfull delivery</h2>
<div class="row">
  <div class="col-md-6">
    <p><i>UDP packet, from <a href="http://chimera.labs.oreilly.com/books/1230000000545/ch03.html#NULL_PROTOCOL">here</a></i></p>
   <img src="UDPpacket.png" class="img-responsive">
  </div>
</div>

<p><strong>NAT problems</strong> UDP containes no state, nor does it have a defined way to close a connection.  NAT boxes keep a dynamic record of translation tables (pubic to private IP), 
  for incoming traffic it needs to know which private IP to send to - but when a UDP connection closes the NAT box has no way of knowing, so it clears UDP entries after a perios of idle time.
To keep a connection alive we must send temporary packets through to reset the timer.</p>

<p><strong>NAT problems for p2p applications</strong> in which machines may have to act as both client and server.  In sending data that may contain their IP for the other peer they may be sending a private IP
instead of the NAT' public IP, so the connection fails.  To resolve this various NAT traversal techniques will have to be used
<ul>
  <li>STUN <i>Session Traversal Utilities for NAT</i>: Uses a 3rd party STUN server to discover our pubilc IP and port tuple so that return packets know where to go and we can keep-alive the connection</li>
  <li>TURN <i>Traversal Using Relays around NAT</i>: Both parties use the same relay server to communicate with each other, can be used when STUN fails, can also switch to TCP if all else fails.
    Unfortunatly, we are no longer p2p, this is an option for when direct connetions fail.
  </li>
  <li>ICE <i>Interactive Connectivity Establishment</i>: a protocal that seeks the most efficent combination of STUN and TURN.</li>
</ul></p>
<p><strong>It's going to be difficult to write your own, use a framework!</strong> Oh and guess what: WebRTC :D</p>

<hr />
<h2><strong>TLS, <i>Transport Layer Security</i></strong>, port 443, used in HTTPS sessions</h2>

<p><strong>SSL</strong> Before it was standardised, this protocal was called SSL and was proprietary to Netscape, now it's TLS</p>
<ul>
  <li>TLS 1.0: January 1999</li>
  <li>TLS 1.1: April 2006</li>
  <li>TLS 1.2: August 2008</li>
</ul>
<p>TLS provides 3 services to the application layer:
<ul>
  <li>Encryption <i></i></li>
  <li>Authentication <i>Verify the validity of ID</i></li>
  <li>Integrity <i>To detect tampering and forgery</i></li>
</ul>
</p>
<p>To initiate a TLS connection a few steps are added after the TCP 3 way handshake: <br />
  1. Client sends SYN packet with rnd number (x)  <br />  2. Server replies with y = (x+1), SYN ACK  <br />  3. Client replies with y+1 & x+1 ACK <br />
  <strong>4. Client sends it's version of TLS and supported ciphersuites  <br />
    5. Serber picks a ciphersuite and sends it's certificate, (can also ask for client certificate)  <br />
    6. client initiates either the RSA or the Diffie-Hellman key exchange  <br />
    7. Server checks integrity by verifying the MAC & returns an encrypted "Finished" message  <br />
    8. Client decrypts & verifies the MAC</strong>
</p>
<p><strong>TLS Session Resumption</strong>, when reopening a connection a shorter handshake can be used without some of the steps above.  
  Client saves a session identifier which is sent in the 'client hello', the server does the same and sends it in the 'Server hello'.  If both remember, the same keys are used.
<i>Applications fetahing resources through parallel connections will really appreciate this ability, so many browsers wait until the first TLS handshake
 is completed in order to reuse the same keys.  Unfortunatly, that can be a lot of sessions for a server to remember.</i></p>
 <p><strong>Session ticket</strong> solves the problem of servers remembering every session.  At the end of a connection, the server packs up the connection details, encrypts it
  and sends it to the client to save.  In the next connection the client sends this encrypted data as part of the 'client hello' to the server and vuala!</p>
<p><strong>TLS False Start</strong>, to reduce round trip overhead encrypted data can be sent before the handshake is complete so it may be processed whie, in parallel, the check for tampering is going on.
Modern browsers will do this but only if the server meets certain conditions (usually forward secrecy and the NPN/ALPN protocals)</p>
<p><strong>symmetric key</strong> </p>
<p><strong>Forward secrecy</strong> </p>
<p><strong>RSA handshake</strong> 
  <ol>
    <li>The client generates a symmetric key and encrypts it with the the server’s public key.</li>
    <li>The client sends the encrypted key to the server.</li>
    <li>The server uses it's private key to decrypt it.</li>
  </ol>
  The server's public and private keys are also used to authenticate the server.  
  If the private key is recovered then a third party can listen in and can also decrypt previous conversations.  As a result, RSA has no Forward Security.
</p>
<p><img src="Diffie-Hellman_Key_Exchange.png" style="max-width:250px; float:right;">
  <strong>Diffie-Hellman</strong> 
  This can use a new key for every session, so recorded sessions cannot be decrypted if a key is found by a third party.  This is Forward Security.
</p>
<p><strong>HTTP Upgrade</strong> </p>
<p><strong>Application Layer Protocol Negotiation (ALPN)</strong> When using a custom protocal over TLS this avoids an extra round trip for HTTP Upgrade.  
  Client sends protocal list as part of the 'Client hello' message, server picks one and sends that in it's 'server hello' message.</p>
<p><strong>NPN <i>Next Protocol Negotiation</i></strong> Is like ALPN but reversed (server advetises accepted protocals client chooses), ALPN is the more recent standardised version.</p>
<p><strong>Chain of Trust and Certificate Authorities</strong> Certification authorities are responsable for mainting a list of trusted sites, so to verify that who 
we are talking to over a secure connection is a friend/trustworthy we can check their certificate (issued by a certificate authority).  Each certificate containes embbedded instructins on how
to check it's validity.</p>
<div class="row">
  <div class="col-md-6">
    <p><i>TLS packet, from <a href="http://chimera.labs.oreilly.com/books/1230000000545/ch03.html#NULL_PROTOCOL">here</a></i></p>
   <img src="TLSpacket.png" class="img-responsive">
  </div>
</div>
<p>Each packet is made up from records, each record takes 16KB of data</p>
<p>Optimising servers</p>
<ul>
  <li>Check session support is actually turned on</li>
  <li>share the cache between workers/proccesses and tune it's size to your traffic</li>
  <li>A shared cache between multiple servers can be good but needs to be secure</li>
  <li>monitor the TLS statistics</li>
</ul> 
<p>To check up on SSL preformance you can use <a href="https://www.ssllabs.com/ssltest/">this online ssl test</a></p>

<hr />
<h2><strong>Wireless Networks</strong>, ...</h2>

<hr />
<p>Source: <a href="http://chimera.labs.oreilly.com/books/1230000000545/ch01.html#SPEED_FEATURE">High preformance browser networking</a></p>

<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>