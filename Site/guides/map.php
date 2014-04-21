<?php $iainPageTitle = 'Guide Map'; $docDepth = 1;?>
<?php include '../partials/head.php'; ?>

<?php $breadcrumbAddress = (ltrim($homePath,'"')) . 'partials/breadcrumbs.php'; ?>
<?php include $breadcrumbAddress; ?>

<pre>
<a href=<?php echo $homePath . 'guides.php"' ?>>Guides</a>
|
|_ <a href=<?php echo $homePath . 'guides/webservers.php"' ?>>Web servers</a>
|  |_ Node JS
|  |_ Apache
|  |_ Nginx
|
|_ <a href=<?php echo $homePath . 'guides/optimisation.php"' ?>>Optimisation</a>
|  |_<a href=<?php echo $homePath . 'guides/optimisation/seo.php"' ?>>SEO</a>
|  |_<a href=<?php echo $homePath . 'guides/optimisation/speed.php"' ?>>Speed</a>
|  |_<a href=<?php echo $homePath . 'guides/optimisation/smo.php"' ?>>SMO</a>
|
|_ <a href=<?php echo $homePath . 'guides/frameworks.php"' ?>>Frameworks</a>
|  |_ ExpressJS
|  |_ SailsJS
|  |_ Sencha
|  |_ ExtJS
|  |_ Django
|  |_ Rails
|
|_ <a href=<?php echo $homePath . 'guides/cms.php"' ?>>Content Managment Systems</a>
|  |_ <a href=<?php echo $homePath . 'guides/cms/wordpress.php"' ?>>WordPress</a>
|  |_ <a href=<?php echo $homePath . 'guides/cms/joomla.php"' ?>>Joomla</a>
|  |_ <a href=<?php echo $homePath . 'guides/cms/drupal.php"' ?>>Drupal</a>
|  |_ <a href=<?php echo $homePath . 'guides/cms/keystone.php"' ?>>KeystoneJS</a>
|  |_ <a href=<?php echo $homePath . 'guides/cms/mediawiki.php"' ?>>MediaWiki</a>
|  |_ <a href=<?php echo $homePath . 'guides/cms/kirby.php"' ?>>Kirby</a>
|
|_ <a href=<?php echo $homePath . 'guides/databases.php"' ?>>Database Systems</a>
|  |_ MySQL
|  |_ MongoDB
|
|_ <a href=<?php echo $homePath . 'guides/designtheory.php"' ?>>Design Theory</a>
|
|_ <a href=<?php echo $homePath . 'guides/inspiration.php"' ?>>Inspiration</a>
</pre>
                
<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>