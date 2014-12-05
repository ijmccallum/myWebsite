<?php $iainPageTitle = 'Security'; $docDepth = 1; ?>
<?php include '../partials/head.php'; ?>
<ul>
  <li><a href="http://www.cert.org/">cert</a> cyber security people<br /></li>
  <li><a href="http://en.wikipedia.org/wiki/Portal:Computer_security">Computer security portal on wikipedia</a></li>
  <li><a href="http://www.smashingmagazine.com/tag/security/">Smashing Mag security articles</a></li>
</ul>

<p>Types of vulnerability</p>
           
<ul>
  <li><strong>Backdoors</strong>: gaining access / control of a system while remaining undetected.</li>
  <li><strong>Denial-of-service attack</strong>: rendering a system unusuable through locking accounts with wrong password attempts 
    or flooding a network with large numbers of requests</li>
  <li><strong>Direct-access attacks</strong>: gaining physical access to a system, eg any free standing computer</li>
  <li><strong>Eavesdropping</strong>: listening in on private communication, typically over networks but can also be done on free standing machines.</li>
  <li><strong>Exploits</strong>: taking advantage of a flaw or quirk in existing software to produce unexpected results</li>
  <li><strong>Indirect attacks</strong>: Launching attacks from third party computers / anonymous networks (tor) to avoid identification</li>
  <li><strong>Human error</strong>: takign advantage of trust / misleading individuals / using the people in controll of a system in order to gain access</li>
</ul>
<p>There is also <i>path traversal</i>, not protecting folders form being listed in a way that you might see on localhost: effectivley allowng people to
explore the file system on your server at will, not good!  To get an idea: <a href="http://gray-world.net/etc/passwd/googletut1.txt">Google, a Dream come true</a> - 
note, this is old, many of the results are people trying to improve their own rankings.</p>

<p>Security measures</p>
<ul>
  <li>Turn off folder listing</li>
  <li>Turn off php globals (from URL's)...?</li>
  <li>Do not take values from the URL and print them to the page, this is just inviting XSS</li>
  <li>User account access controls</li>
  <li>cryptography</li>
  <li>Firewalls</li>
  <li>Intrusion Detection Systems</li>
  <li>Packet capture appliances</li>
</ul>

<p>Attacks</p>
<ul>
  <li>Vulnerability scanners</li>
  <li>computer worms</li>
</ul>

<hr />

<h2>Specific Examples</h2>

<hr />

<h3>Back Orifice</h3>
<a href="http://en.wikipedia.org/wiki/Back_Orifice">On wikipedia</a>

<hr />

<h3>Carnivore</h3>
<a href="http://en.wikipedia.org/wiki/Carnivore_(software)">on wikipedia</a>

<hr />

<h3>NarusInsight</h3>
<a href="http://en.wikipedia.org/wiki/Narus_(company)#NarusInsight">on wikipedia</a>

<hr />

<h3>TEMPEST</h3>
<a href="http://en.wikipedia.org/wiki/Tempest_(codename)">wiki</a>

<hr />

<h3>Robert Morris and the first computer worm</h3>

<hr />

<h3></h3>

<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>