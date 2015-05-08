<?php $iainPageTitle = 'Jargon'; $docDepth = 1;?>
<?php include '../partials/head.php'; ?>

<p>Sometimes, when people speak, I get confused (and I'd bet you do too).  So I'm trying to track down 
 all the confusing things people say, get it down and figure it out!
<ul>
	<li>Bootstrap: </li>
	<li>Constructor: </li>
	<li>Checksum: </li>
	<li>Declared: you have declared a variable you are going to use (but not given it a value yet - that's initialization)</li>
	<li>Duck Punching: taking a native function from language 'a' and implementing it manually in language 'b'</li>
	<li>Dynamically typed: You don't - the system figures out what the type is by itself.</li>
	<li>fully integrated E2E / end to end testing: </li>
	<li>Initialized: when you give a variable a value</li>
	<li>Instantiate:</li>
	<li>Lazy loading: only loading an asset required (good if your app has many bits that arn't always used).  The opposite is 'eager loading'</li>
	<li>Loosley typed: a variable can hold any type of data</li>
	<li>Monkey patch: (see duck punch)</li>
	<li>Opinionated: software that guides you into doing something a certain way.</li>
	<li>Spin up: </li>
	<li>Staticly typed: you must specify the type of variable. Allows more error checking</li>
	<li>tight coupling: </li>
	<li>Unit testing: </li>
</ul>
</p>



<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>
