<?php $iainPageTitle = 'Experiments'; $docDepth = 1;?>
<?php include '../partials/head.php'; ?>

<div class="row text-center">
	<div class="col-md-4"><a href="bubbleGame">Bubble game</a></div>
	<div class="col-md-4"><a href="fly-pop-bubble">Fly pop bubble</a></div>
	<div class="col-md-4"><a href="login">login</a></div>
</div>

<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>