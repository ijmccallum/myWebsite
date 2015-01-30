<?php $iainPageTitle = 'Umbraco overview'; $docDepth = 1;?>
<?php include '../partials/head.php'; ?>

<h4>Overview</h4>
<ul>
  <li><strong>Layouts:</strong> each page has a layout file (.NET / .aspx)<br />
  <i>Layout files can have sub layouts (.ascx) and renderings (.xslt). So use a layout for the page outline</i></li>
  <li><strong>Templates:</strong> two types? Presentation / data </li>
  <li><strong>Item:</strong> </li>
  <li><strong>Rendering:</strong> Should be used for presenting content only</li>
  <li><strong>Sublayout:</strong> is a .Net web user control, free to do what you want</li>
</ul>

<p>
  Sources:
  <ul>
    <li><a href="http://learnsitecore.cmsuniverse.net/Architects/Articles/2009/11/Sitecore-architecture-simple.aspx">Learn sitecore article series</a> </li>
    <li><a href="http://blog.eldblom.dk/2009/05/27/agile-sitecore-design/">Component architecture post</a> </li>
  </ul>
</p>

<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>
