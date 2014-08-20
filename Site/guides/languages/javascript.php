<?php $iainPageTitle = 'Javascript'; $docDepth = 2;?>
<?php include '../../partials/head.php'; ?>

<?php $breadcrumbAddress = (ltrim($homePath,'"')) . 'partials/breadcrumbs.php'; ?>
<?php include $breadcrumbAddress; ?>


<h2>Async & Callbacks </h2>
<ul>
	<li>First off - the bad way, callbacks within an Ajax request's success function - leads to the <strong>pyramid of doom / callback hell</strong> (technical term).
<pre><code>Ajax request {
	success function{
		2nd Ajax request{
			success function{
				3rd Ajax request {
					success function{

					}
					3rd error handler{

					}
				}
			}
			2nd error handler {

			}
		}
	}
	1st error handler{

	}
}
</code></pre>
	</li>
	<li>Second - <strong>clean callbacks</strong>: 
<pre><code>Ajax request {
	success: successfunction
	error: errorHandler
}
successFunction{
	2nd Ajax request {
		success: 2nd successFunction
		error: errorHandler
	}
}
2nd successFunction {
	3rd Ajax request {
		success: 3rd successFunction
		error: errorHandler
	}
}
3rd successFunction{
	
}
errorHandler {
	
}
</code></pre>
	</li>
	<li>3rd - <strong>Javascript Promises</strong>
<pre><code>var getPromise = $.ajax({type:'GET', url:'profile.json'}); //this variable is the promise:
//getPromise.then(sucess, error);
getPromise.then(
	function(data){
		console.log(data);
	}, function (xhr, state, error) {
		console.log(arguments);
	}
);	
</code></pre>
	You can preform these individually but this doesn't turn out much different to clean callbacks, what you can also do is...
	</li>
	<li><strong>Chained Javascript Promises</strong>: a returned value from within a <code>.then</code> function is passed to the next <code>.then</code>.  Any errors will skip down the chain until the final function where they will be handeled.
<pre><code>$.get('profile.json').then(function(profile){
	return $.get('friend.json?id='+profile.id);
}).then(function(friend){
	//do something with friend
}), function(xhr, status, error) {
	//handle the errors
});
</code></pre>
	And alternativley there is also...
	</li>
	<li><strong>Async Javascript Promises</strong>:
<pre><code>var getProfile = $.get('profile.json');
var getFriend = $.get('friend.json');

$.when(getProfile, getFriend).then(function(profile, friend){
	console.log(profile[0]);
	console.log(friend[0]);
}, function(xhr, status, error){
	//handle errors
});
</code></pre>
	</li>
	<li>Finally, in Javascript 6 (es6 harmony), we have generators.js, it looks blocking, but it's not!
<pre><code>Promise.coroutine(function* (){

	var profile = yield $.get('profile.json');
	$('#profile').html(JSON.stringify(profile));

	var tweets = yield $.get('tweets.json');
	$('#tweets').html(JSON.stringify(tweets));

	var friend = yield $.get('friend.json');
	$('#friend').html(JSON.stringify(friend));

})().catch(function(errs){
	//handle errors
});
</code></pre>
	</li>
</ul>

<p>Source: <a href="https://www.youtube.com/watch?v=obaSQBBWZLk">LearnCode.academy on youtube</a></p>



<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>