<?php $iainPageTitle = '.htaccess'; $docDepth = 1;?>
<?php include '../partials/head.php'; ?>

<h2>The <code>.htaccess</code> file</h2>

<ul>
  <li>
    Affets the directory it's placed in and all sub-directories
  </li>
</ul>

Some configurations:
<ul>
  <li>
    <strong>ErrorDocument 401 /401.html</strong>: for Unauthorised errors, redirects to 401.html in the root <br />
    <strong>ErrorDocument 403 /403.html</strong>: forbidden<br />
    <strong>ErrorDocument 404 /404.html</strong>: file not found<br />
    <strong>ErrorDocument 500 /500.html</strong>: internal server error
  </li>
  <li>
    <strong>Redirect /old_dir/ http://www.yourdomain.com/new_dir/index.html</strong>: redirects for any requests in old_dir
  </li>
</ul>

<h4>Mod_Rewrite</h4>
<p>First, a little set up:</p>
<ul>
  <li>
    Check it's active: <code>sudo a2enmod rewrite</code>
  </li>
  <li>
    Check it's permitted: <code>sudo nano /etc/apache2/sites-available/default</code><br />
    in that file find the following and AllowOverride to All
<pre>&lt;Directory /var/www/&gt;
                Options Indexes FollowSymLinks MultiViews
                AllowOverride All
                Order allow,deny
                allow from all
&lt;/Directory&gt;</pre>
  </li>
  <li>
    Restart Apache: <code>sudo service apache2 restart</code>
  </li>
</ul>
<p>In the .htaccess file add <code>RewriteEngine on</code> for obvious reasons, now the rewriting can begin</p>
<p>rewrite's follow this pattern: <code>RewriteRule</code> <code>Pattern</code> <code>Substitution</code> <code>[OptionalFlags]</code></p>
<ul>
  <li>The <strong>RewriteRule</strong> is the name...
    <ul>
      <li>
        <code>^</code>: indicates the beginning of a string to match (begins after the URL)
      </li>
      <li>
        <code>$</code>: the end of a string to match
      </li>
      <li>
        <code>([A-Za-z0-9-]+)</code>: anything that might be typed into the address bar, <code>+</code> = 1 or more characters
      </li>
    </ul>
  </li>
  <li>The <strong>Pattern</strong> interpretas the URL using regular expressions:
    ...
  </li>
  <li>The <strong>Substitution</strong> is the URL to write / display
  </li>
  <li>Finally <strong>Optional Flags</strong>:
    <ul>
      <li>
        <code>[F]</code> makes the URL forbidden
      </li>
      <li>
        <code>[NC]</code> disregards Capitalization
      </li>
      <li>
        <code>[R=301]</code> perminant redirect
      </li>
      <li>
        <code>[R=302]</code> temporary redirect
      </li>
      <li>
        <code>[L]</code> this is the last rule in a series
      </li>
    </ul>
  </li>
</ul>
<p>So, for example:</p>
<ul>
  <li>
    <code>RewriteRule ^page1.html$ page2.html</code>: page1 will display the contents of page2
  </li>
  <li>
    <code>RewriteRule ^products/([A-Za-z0-9-]+)/?$ results.php?products=$1 [NC]</code><br />
    Will turn <code>http://example.com/results.php?products=apple</code><br />
    into <code>http://example.com/products/apple</code>
  </li>
</ul>

<p>Source: <a href="https://www.digitalocean.com/community/tutorials/how-to-set-up-mod_rewrite">a Digital Ocean tutorial</a></p>