<?php $iainPageTitle = 'XSS'; $docDepth = 2;?>
<?php include '../../partials/head.php'; ?>

<?php $breadcrumbAddress = (ltrim($homePath,'"')) . 'partials/breadcrumbs.php'; ?>
<?php include $breadcrumbAddress; ?>

<h3>XSS</h3>

<p>
	A good run through: <a href="http://www.steve.org.uk/Security/XSS/Tutorial/index.html">Steve's tutorial</a>
<ul>
	<li>
		Ususally focused on cookies that store username and password.
	</li>
</ul>

</p>


<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>