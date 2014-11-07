<?php $iainPageTitle = 'XSS'; $docDepth = 2;?>
<?php include '../../partials/head.php'; ?>

<?php $breadcrumbAddress = (ltrim($homePath,'"')) . 'partials/breadcrumbs.php'; ?>
<?php include $breadcrumbAddress; ?>
<h3>What is it?</h3>
<p>
	...
</p>


<h3>Protecting against XSS?</h3>
<p>Good flitering</p>

<hr />

<p>On a side note, using X-frame options to deny iframe rendering in another website can cause problems for the other site when 
	it is not attempting anything malicious.  For example, FGL is a game market which allows developers to submit their games for
	review by other developers or potential sponsors.  For those of us who produce HTML5 games, the site uses an iFrame to display 
	the games, so if our own sites deny them, that's a problem - admittedly one we should be awar of as it is our own content.
	Another example would be a news agregator site (senchainsights.com) that allows visitors to visit external sites for content within
	an iFrame so the original site may include navigation options in the page, have a look at the example to see what I mean.  They have no 
	malicious intent, just a desire to make the navigation experiance for users easier.
</p>
<p>In the event the you are in the same situation, using an iFrame to diaplay content that denies it's self, here is a way to help mitigate the
negative effects on your site:</p>

<hr />
Sources:
<ul>
	<li>
		A good run through: <a href="http://www.steve.org.uk/Security/XSS/Tutorial/index.html">Steve's tutorial</a>
	</li>
</ul>

<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>