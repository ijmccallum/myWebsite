<?php $iainPageTitle = 'Umbraco overview'; $docDepth = 1;?>
<?php include '../partials/head.php'; ?>

<h4>Overview</h4>
<ul>
  <li><strong>Items:</strong> This is what the users work with in the backend (each page is essentially an item), it is defined by the fields held in it's template</li >  
  <li><strong>Templates:</strong> Holds the html and contains fields (fields are .net tags?), these fields determin the item's inputs in the backend</li>
  <li><strong>Fields:</strong> fields, fields everywhere!</li>
  <li><strong>Masters:</strong> types of items, when a new item is created from a master, the master is basically copied </li>
  <br />
  <li><strong>Layouts:</strong> each page has a layout file (.NET / .aspx)<br />
  <i>Layout files can have sub layouts (.ascx) and renderings (.xslt). So use a layout for the page outline</i></li>
  <li><strong>Rendering:</strong> Should be used for presenting content only</li>
  <li><strong>Sublayout:</strong> is a .Net web user control, free to do what you want</li>
</ul>

<p>The Databases</p>
<ul>
  <li><strong>Web</strong> The live website</li>
  <li><strong>Core</strong> The sitecore backend</li>
  <li><strong>Master</strong> The website in development: contains all versions of all items</li>
  <li>And some more: 'Archive', 'Extranet', 'RecycleBin', & 'Security'</li>
</ul>
<p>When you edit an item in the backend and save it - your changes are saved to the 'Master' db<br />
To push it live, publish it and it will be copied into the 'web' db.</p>

<p>
  Sources:
  <ul>
    <li><a href="http://learnsitecore.cmsuniverse.net/Architects/Articles/2009/11/Sitecore-architecture-simple.aspx">Learn sitecore article series</a> </li>
    <li><a href="http://blog.eldblom.dk/2009/05/27/agile-sitecore-design/">Component architecture post</a> </li>
  </ul>
</p>

<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>
