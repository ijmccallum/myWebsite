<?php 
session_start();
require_once 'classes/membership.php';
$membership = new membership();

if(isset($_GET['status']) && $_GET['status'] == 'loggedout') {
	$membership->log_user_out();
}

//Check there is posted info and the fields are filled in
if($_POST && !empty($_POST['username']) && !empty($_POST['pwd'])) {

	//increment the login attempt counter


	$response = $membership->validateUser($_POST['username'], $_POST['pwd']);
}

?>


<?php $iainPageTitle = 'Login tut'; $docDepth = 2;?>
<?php include '../../partials/head.php'; ?>

<p>A simple login form, counting the number of times a login is attempted - it doesn't lead to anywhere, just a bit of fun!</p>

<div class="row text-center">
	<form method="post" action="">
		<input type="text" name="username" placeholder="username"/>
		<input type="password" name="pwd" placeholder="password"/>
		<input type="submit" value="login" name="submit"/>
	</form>
	<?php if(isset($response)) echo '<h4>' . $response . '</h4>'; ?>
</div>

<div class="row">
	<strong>Stats</strong>
</div>

<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>