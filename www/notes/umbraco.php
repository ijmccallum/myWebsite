<?php $iainPageTitle = 'Umbraco overview'; $docDepth = 1;?>
<?php include '../partials/head.php'; ?>

<p>
	Some of the key terms / concepts:
	<ul>
		<li>
			Templates: The layout of pages
			<ul>
				<li>MVC:</li>
				<li>WebForms:</li>
			</ul>
		</li>
		<li>Macros: Dynamic components</li>
	</ul>
</p>

<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>
