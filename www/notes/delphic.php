<?php $iainPageTitle = 'Cross-Site Request Forgery'; $docDepth = 1;?>
<?php include '../partials/head.php'; ?>

<h2>WordPress</h2>

<h3>Defining the URL in the config file so we don't have to jigger with permalinks and such</h3>
 <code>define('WP_HOME','http://choosingwisely.local:8080');</code>
 <code>define('WP_SITEURL','http://choosingwisely.local:8080');</code>
 <i>Once complete go to permalinks page and just click save</i>
 
 
 <hr />
 
 
<h2>XAMPP</h2>
 <h3>Importing database <small>when it fails due to size</small></h3>
 <p>Open XAMPP, in the Apache Config -> PHP.ini. <br />
 Find the variable <code>upload_max_filesize=</code>, it may be set to 2, change it to 100M<br />
 <i>You may have memory issues when uploading, will fill in if I ever come accross and figure out.</i>
 </p>
 
 <h3>Setting up a virtual host</h3>
 <p>In XAMPP control panel, go to Apache Config -> <Browse> [Apache] -> conf -> extra -> httpd-vhosts.conf <code>C:\xampp\apache\conf\extra</code> <br />
 At the bottom of the file add in:
 <pre><code>&lt;VirtualHost *&gt;
DocumentRoot "C:/Users/imccallum/projects/ChoosingWisely/www" //custom to whereveer your local web server is running
ServerName choosingwisely.local //pop it into the url and do a little dance!  Remember the port number if you're on 8080 or something lik me
&lt;/VirtualHost&gt;</code></pre>
<i>if you are using a port number other than 80 then just above the bottom you'll find <code>NameVirtualHost *:8080</code>, set the port the the relevant number</i>
 </p>

<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>
