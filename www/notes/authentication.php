<?php $iainPageTitle = 'Authentication'; $docDepth = 1;?>
<?php include '../partials/head.php'; ?>

<p>

<ul>
	<li>HTTP Authorization Header</li>
	<li>Authorization token in the URL</li>
</ul>
</p>

<hr />

<p>Some useful libraries</p>
<div class="row">
	<div class="col-md-3">
		<div class="panel panel-default panel-body">
			<a href="https://github.com/dropbox/zxcvbn">zxcvbn</a>
			<p>For checking password strength, also <a href="http://jsfiddle.net/fh9FP/12/">a more geeky way</a></p>
		</div>
	</div>
	<div class="col-md-3">
		<div class="panel panel-default panel-body">
			<a href="http://www.php-login.net/">The PHP-Login project</a>
			<p>Need to test out, looks really handy though!</p>
		</div>
	</div>
	<div class="col-md-3">
		<div class="panel panel-default panel-body">
			<p>Idea: make an unsecure login form and count / graph how many times people / bots attempt to log in and the data they write</p>
		</div>
	</div>
	<div class="col-md-3"></div>
</div>

<hr />

<h3>Logging in</h3>
<p><strong>CAPTCHA is not good</strong>, if one must be used use <a href="http://en.wikipedia.org/wiki/ReCAPTCHA">ReCAPTCHA</a></p>
<p><strong>Prevent quick fire attempts</strong>, add a 1 second time delay (on the server) until the next log in attempt is allowed.<br />
	For more security brownie points, add a sliding scale: 2 failed attempts = 2 second delay, 3 failed attempts = 3 sec delay and so on<br />
	For usability brownie points - maybe add an indication such as a wee note that informs the user of the count down.</p>
<p><strong>Prevent Distributed Brute Force Attacks</strong> (trying one password across many accounts), monitor the average bad password attempts 
across your whole site's user-base, if the number accelerates sharply then throttle everyone's attempts for a short time (a few seconds).  Maybe also
add a note to the login page informing users of the attempted attack and the lock-down the site is going into for a few seconds to prevent it.</p>
<p><strong>Enforce strong password choice</strong>, if not enforced - users will ignore it.</p>
<p><strong>Use emails as login names</strong> unless you have good reason not to - also provide a way to change the email and do not show it publicly</p>
<p>Make emails <strong>case insensitive</strong></p>
<p><strong>Don't confirm if user-name was authentic</strong> only say the log in didn't work</p>
<p>When storing passwords <strong>hash them with salt!</strong></p>
<p></p>

<hr />
<h3>Remaining Logged in</h3>
<p><strong>Persistent log ins <i>remember me!</i> can be a massive danger given that many users won't use them safely.</strong><br />
That said:
</p>


<a href="https://stackoverflow.com/questions/549/the-definitive-guide-to-form-based-website-authentication/477578#477578?newreg=ceed7f1bbf964947962568135762f06b">the-definitive-guide-to-form-based-website-authentication</a> from stack overflow

<hr />

<h3>OAuth 2.0</h3>
<p><i>OAuth allows us to push the handling of logging in to third parties.</i><br />
	<i>It also allows you to approve one application to interact with another without giving away your password</i><br />
For example: Bitly posting on "Joe's" twitter feed:
<ol>
	<li>Joe asks Bitly to post on his feed</li>
	<li>Bitly requests a "request token" from Twitter regarding Joe</li>
	<li>Joe is redirected to Twitter by Bitly to approve the "request token"</li>
	<li>Bitly swaps the "request token" for an "access token and secret"</li>
	<li>Bitly can now post on Joe's twitter feed using the access token and secret</li>
</ol>
	<ul>
		<li><i>Client</i>: <strong>the consumer</strong> the application attempting access, it needs the users permission.</li>
		<li><i>Resource Server</i>: <strong>the service provider</strong> the API server used to access the user's information.</li>
		<li><i>Resource Owner</i>: <strong>the user</strong>.</li>
	</ul>
</p>

<a href="http://oauth.net/2/">OAuth implementations in various languages</a>

<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>