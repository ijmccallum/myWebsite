<?php $iainPageTitle = 'Bower'; $docDepth = 1; ?>
<?php include '../partials/head.php'; ?>

A package manager for client side js (like npm). <br /><br />
        Some examples (in the shell):<br />
        <code>bower init</code> creates a configuration file in your project directory 
        so on a new machine you can <code>bower install</code> to get all the dependancies<br />
        <code>bower install angular</code><br />
        <code>bower install jQuery</code><br />
        <code>bower install bootstrap</code><br />
        <code>bower install underscore</code>.<br />
        To make your own front end library available through bower:
        <ol>
          <li>Make sure there is a bower config file. (bower init)</li>
          <li>Commit project to github.</li>
          <li><code>bower register &lt;name&gt; &lt;githubLink&gt;</code></li>
        </ol>
        <code>bower search &lt;search term&gt;</code>

<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>