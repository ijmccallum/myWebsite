<?php $iainPageTitle = 'Inspiration'; $docDepth = 1; ?>
<?php include '../partials/head.php'; ?>
            
<?php $breadcrumbAddress = (ltrim($homePath,'"')) . 'partials/breadcrumbs.php'; ?>
<?php include $breadcrumbAddress; ?>

<div class="row">
    <div class="col-md-6">
        <p class="lead">
        	A series of talks that contain, in my opinion, some of the most valuable ideas for life.
        </p>
    </div> <!-- END 6 column for text -->
</div> <!-- END intro row -->
<div class="row">
    <div class="col-md-6 text-center">
        <iframe src="http://embed.ted.com/talks/alain_de_botton_a_kinder_gentler_philosophy_of_success.html" width="640" height="360" frameborder="0" scrolling="no" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
    </div> <!-- END column -->
</div>
<div class="row">
	<div class="col-md-6 text-center">
    	<iframe src="http://embed.ted.com/talks/ken_robinson_says_schools_kill_creativity.html" width="640" height="360" frameborder="0" scrolling="no" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
    </div> <!-- END column -->
</div>
<?php include '../partials/footer.php'; ?>