<?php $iainPageTitle = 'Polymer'; $docDepth = 1;?>
<?php include '../partials/head.php'; ?>

<p>
	Here's a wee polymer experiment in an iframe, <a href="../experiments/polymer">open the actual webpage here</a>
</p>

<div class="iframe-wrapper">
	<iframe src="../experiments/polymer" width="100%" height="400"></iframe>
</div>

<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>
