<?php $iainPageTitle = 'Cross-Site Request Forgery'; $docDepth = 1;?>
<?php include '../partials/head.php'; ?>

<p>A simple example to explain, imagin on example.com there is a script that takes input from a form and stores it to it's database without checking the input was sent from it's own server,
 on my site I post this
<pre><code>&lt;img src="http://example.com/add_to_db.php?name=cheap%20rolex&email=susan@hotchicks.com&comment=mortgage%20help" width="1" height="1"&gt;</code></pre>
When you load my site, <i>name=cheap%20rolex&email=susan@hotchicks.com&comment=mortgage%20help</i> is passed to the form and added to the database.
</p>
<p><strong>Worse,</strong> if example.com holds private info and you're logged into it on another tab, the CSRF attack can access or even edit that data</p>
<p>That example was via a GET request, if the vulnerable script was changed to work with POST requests then the evil site can still trick the user with a form:
<pre><code>&lt;form method="post" action="add_to_db.php"&gt;
  &lt;div&gt;
    &lt;input type="hidden" name="name" value="bob"&gt;
    &lt;input type="hidden" name="email" value="bob@experts.com"&gt;
    &lt;input type="hidden" name="comment" 
           value="awesome article, buy cialis now!"&gt;
  &lt;input type="submit" value="see beautiful kittens now!"&gt;
  &lt;/div&gt;
&lt;/form&gt;</code></pre>
</p>

<hr />
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