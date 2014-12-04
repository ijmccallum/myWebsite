<?php session_start();

require_once 'classes/membership.php';
$membership = new membership();

$membership->confirm_member();

?>
<?php $iainPageTitle = 'Login tut - the secret page!'; $docDepth = 2;?>
<?php include '../../partials/head.php'; ?>


<div class="row text-center">
	<p>Hi!</p>
	<a href="login.php?status=loggedout">Logout!</a>
</div>

<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>