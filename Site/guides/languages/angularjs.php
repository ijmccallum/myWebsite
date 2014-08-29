<?php $iainPageTitle = 'Angular JS'; $docDepth = 2;?>
<?php include '../../partials/head.php'; ?>

<?php $breadcrumbAddress = (ltrim($homePath,'"')) . 'partials/breadcrumbs.php'; ?>
<?php include $breadcrumbAddress; ?>

<p><em>"a structural framework for dynamic web apps."</em></p>

<hr />

<h2>First thing's first, <strong>Set up</strong></h2>
<code>&lt;html ng-app&gt;</code>: This is a <em>directive</em> signalling that this is an Angular app.<br />
<code>&lt;script src="js/angular.js&gt;&lt;/script&gt;</code>

<hr />

<p>Source: <a href="https://docs.angularjs.org/guide/introduction">The Docs</a></p>



<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>