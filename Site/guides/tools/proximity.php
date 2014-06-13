<?php $iainPageTitle = 'Proximity API'; $docDepth = 2;?>
<?php include '../../partials/head.php'; ?>

<?php $breadcrumbAddress = (ltrim($homePath,'"')) . 'partials/breadcrumbs.php'; ?>
<?php include $breadcrumbAddress; ?>

<ul>
	<li>
		<code>deviceproximity</code> event, it passes <code>value<code>, <code>min</code>, and <code>max</code>
<pre><code>
window.addEventListener('deviceproximity', function(event) {
   console.log('An object is ' + event.value + ' centimeters far away');
});
</code></pre>
	</li>
	<li>
		<code>userproximity</code> passes <code>near</code> - boolean if there is an object in detectable range.
	</li>
</ul>

<p>Not very well supported (only firefox as of writing)</p>
<pre><code>
if ('ondeviceproximity' in window) {
   // API supported. Don't get too close, I can feel you
} else {
   // API not supported
}
</code></pre>


<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>