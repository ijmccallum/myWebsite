<?php $iainPageTitle = 'Wireless Networking'; $docDepth = 1;?>
<?php include '../partials/head.php'; ?>

<ul>
  <li>PAN <i>Personal Area Network, </i></li>
  <li>LAN <i>Local, IEEE 802.11 (WiFi)</i></li>
  <li>MAN <i>Metropolitan, city wide, IEEE 802.15 (WiMAX)</i></li>
  <li>WAN <i>Wide, Cellular</i></li>
</ul>
<p><strong>Low frequency</strong> signals - travel far but can't carry as much data & there are more people trying to use it</p>
<p><strong>High frequency</strong> signals - short distance but much more data</p>

<p>All methods have a max channel capacity, preformance depends on distance from the source, power of the signal, amount of noise and
 modulation alphabet (translating 1's and 0's into analogue).  It can be compared to talking with someone, think of the difference between an empty hall and a crowded room.</p>
<p><strong>Collision avoidance</strong></p>
<ul>
  <li>
    <p>For networks with 10% load or less</p>
    <p>With the Ethernet there is no central controll for communication.  Each part listens before speaking: if someone is talking then wait until they've finished then transmit.  
    In the event of a collision, both parties stop and wait for a random interval, first to start continues.</p>
    <p>WiFi also waits before talking, when it talks it sends the entire packet then waits for a conformation before proceeding.  Radio hardware cannot detect collisions while sending.</p>
  </li>
  <li>
    <p>For networks with load over 10%</p>
  </li>
</ul>
<hr />
<p>Good thing to note when looking at wifi routers!  Check their standards against this table (from <a href="http://chimera.labs.oreilly.com/books/1230000000545/ch06.html#_wifi_standards_and_features">here</a>)</p>
<table>
<thead><tr>
<td>802.11 protocol</td>
<td>Release</td>
<td>Freq (GHz)</td>
<td>Bandwidth (MHz)</td>
<td>Data rate per stream (Mbit/s)</td>
</tr></thead>
<tbody>
<tr>
<td><p>b</p></td>
<td><p>Sep 1999</p></td>
<td><p>2.4</p></td>
<td><p>20</p></td>
<td><p>1, 2, 5.5, 11</p></td>
</tr>
<tr>
<td><p>g</p></td>
<td><p>Jun 2003</p></td>
<td><p>2.4</p></td>
<td><p>20</p></td>
<td><p>6, 9, 12, 18, 24, 36, 48, 54</p></td>
</tr>
<tr>
<td><p>n</p></td>
<td><p>Oct 2009</p></td>
<td><p>2.4</p></td>
<td><p>20</p></td>
<td><p>7.2, 14.4, 21.7, 28.9, 43.3, 57.8, 65, 72.2</p></td>
</tr>
<tr>
<td><p>n</p></td>
<td><p>Oct 2009</p></td>
<td><p>5</p></td>
<td><p>40</p></td>
<td><p>15, 30, 45, 60, 90, 120, 135, 150</p></td>
</tr>
<tr>
<td><p>ac</p></td>
<td><p>~2014</p></td>
<td><p>5</p></td>
<td><p>20, 40, 80, 160</p></td>
<td><p>up to 866.7</p></td>
</tr>
</tbody>
</table>
<hr />

<p>I use the wifi analyzer from the google store to monitor the 'radio weather' and switch up to the less busy channels on occasion</p>
<p>For mobile apps - it's a good idea to prompt users o use wifi for large data transfers, or wait until wifi is available to complete large background operations</p>

<hr />

<p><strong>Adaptive Bitrate Streaming</strong> for large video/audio streams, split the media into 5-10 second chunks and 
  monitor the download speed.  If it's slow send the next chunk as a lower resolution (and therefor lower bitrate) chunk and continue monitoring.  
  TED Talks / YouTube and Netflicks all do this which you may have noticed!</p>

<hr />
<h3>Mobile networks</h3>
<p>This system is huge and it's growing! Chances are many of your users will use this tech to access your site/service, and far more will do in the future.</p>
<ul>
  <li>GSM</li>
  <li>CDMA</li>
  <li>HSPA</li>
  <li>LTE</li>
</ul>
<ul>
  <li>1G: no data, analogue</li>
  <li>2G: 1-400 Kbit/s, 300-1000ms latency, digital overlay / parallel to analogue</li>
  <li>3G: 0.5 - 5 Mbit/s, 100-500ms latency, dedicated digital in parallel to analogue</li>
  <li>4G: 1 - 50 Gbit/s, &lt;100ms latency, Fully digital</li>
  <li>It's safer to assume preformance will be at the lower end of the given ranges.</li>
</ul>

<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>