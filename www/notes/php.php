<?php $iainPageTitle = 'PHP'; $docDepth = 1;?>
<?php include '../partials/head.php'; ?>

<h3>Cookies</h3>
<p>
<strong>Check if cookkies are enabled</strong>
<pre><code>setcookie("test_cookie", "test", time() + 3600, '/');
if(count($_COOKIE) > 0) //Cookies are enabled</code></pre>

<code>setcookie(name, value, expire, path, domain, secure, httponly);</code>: saves a cookie on the user's computer.
<ul>
	<li><code>name</code></li>
	<li><code>value</code></li>
	<li><code>expire</code>: eg, 30 days: <code>time() + (86400 * 30)</code></li>
	<li><code>path</code></li>
	<li><code>domain</code></li>
	<li><code>secure</code></li>
	<li><code>httponly</code></li>
</ul>
To <strong>delete a cookie</strong> set it with it's expiration time in the past: <code>setcookie("user", "", time() - 3600);</code>
</p>

<hr />
<h3>Sessions</h3>
<p><i>Storing variables on the server to be used across multiple pages by a single user.</i><br />
	<ul>
		<li>Begin a session using <code>session_start()</code><br /> 
			<i>must be before any HTML tags and on every page that will use session variables</i><br />
			It will store a user key on the user's computer - usually in the cookies.
		</li>
		<li>Set session variables with <code>$_SESSION['nameOfVariable'];</code></li>
		<li><code>print_r($_SESSION);</code> prints all the session variables</li>
		<li>Remove all session variables: <code>session_unset();</code></li>
		<li>End session: <code>session_destroy();</code></li>
	</ul>
</p>

<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>