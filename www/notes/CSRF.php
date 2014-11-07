<?php $iainPageTitle = 'XSS'; $docDepth = 1;?>
<?php include '../partials/head.php'; ?>



<p>
	When you open a website that you are logged into it may not ask for your credentials (eg a simple bank site).  So when you open another site that contains a CSRF it can open the simple bank site in the ackground and the bank site will let it in. 
	The CSRF will then be able to preform an action like change username / password / email / do something else.
	<br />
	Also known as: CSRF, XSRF, one-click attack, session riding, confused deputy, and sea surf.
</p>

<h3>How to do CSRF?</h3>

<p>
	On a site that you own (or in one that allows unfiltered messages - see XSS) you might add something like the following:
<pre><code>&lt;iframe src="http://examplebank.com/app/transferFunds?amount=1500&destinationAccount=..." &gt;</code></pre>
or
<pre><code>&lt;img src="http://examplebank.com/app/transferFunds?amount=1500&destinationAccount=..." height=”1” width=”1”/&gt;</code></pre>
This would be in the hope that the visitor to your site is also logged into <code>examplebank.com</code>.  One technique to increase the chance would be to insert the CSRF into a tutorial that covers using the specific site being targeted, that way it is likley that the visitor will be logged into the target site when they open up the CSRF.
</p>

<h3>Protecting against CSRF?</h3>

<hr>
Sources:
<ul>
	<li>
		An overview: <a href="https://www.veracode.com/security/csrf">by veracode</a>
	</li>
</ul>


<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>