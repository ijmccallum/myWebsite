<?php $iainPageTitle = 'Webservers'; $docDepth = 1;?>
<?php include '../partials/head.php'; ?>

<?php $breadcrumbAddress = (ltrim($homePath,'"')) . 'partials/breadcrumbs.php'; ?>
<?php include $breadcrumbAddress; ?>

<div class="row">
    <div class="col-md-6">
        <p>
            I'm focusing on the software here, not the hardware - that'll be a few years down the road!  With my development roots in WordPress I was using Apache but never really interacting with it.  The first server software I really worked with was NodeJS and it's been pretty great!  Nginx is on the horizon, I'll hopefully get into that once Node is solid. 
        </p>
    </div> <!-- END 6 column for text -->
</div> <!-- END intro row -->
<h4>Virtual private: cheap, moderate to scale</h4>
<h4>Dedicated: pricy, slow to scale</h4>
<h4>Cloud, v pricey, v quick to scale</h4>
<div class="list-group">
  <a href="#" class="list-group-item greyout">AWS (ec2)</a>
  <a href="#" class="list-group-item greyout">rackspace</a>
  <a href="#" class="list-group-item greyout">Azure</a>
</div>
<div class="list-group">
  <a href="webservers/node.php" class="list-group-item"><strong>NodeJS</strong><br />
  A c++ application that you controll with v8 Javascript, this means your front-end and AND your back-end are written in Javascript!</a>
  <a href="#" class="list-group-item greyout">Apache</a>
  <a href="#" class="list-group-item greyout">IIS</a>
  <a href="#" class="list-group-item greyout">Nginx: fast for static files</a>
  <!-- <a href="guides/webservers.php" class="list-group-item">NodeJS</a>
  <a href="guides/frameworks.php" class="list-group-item">Apache</a>
  <a href="guides/cms.php" class="list-group-item">Nginx</a> -->
</div>
<p>Node behind Nginx: Nginx deals with mass static, anything interactive it passes to node.</p>




<hr />




<h2>On DNS (Domain Name System), navigating the internet!</h2>
<br />

<strong>DNS</strong> is a network of servers that hold something akin to a phonebook for the internet (the whois database)
<br />

<br />

<strong>Domain name</strong>: the memorabke address of a website, segmented into 3 levels:
<ul>
  <li>
    <strong>TLD (Top Level Domain)</strong>: <code>.com</code>, <code>.org</code>, <code>.net</code> and so on<br />
    or <strong>ccTLD (country code TLD)</strong>: <code>.co.uk</code>, <code>.co.in</code> and so on.
  </li>
  <li>
    The <strong>Domain Name</strong>: the memorable bit, between 2 and 64 characters, this is the second level
  </li>
  <li>
    The <strong>Third Level</strong>: usually <code>www.</code> but is also commonly changed to indicate a server with slightly different intention, eg:<code>member.</code>, <code>support.</code> or <code>ftp.</code>
  </li>
</ul>
<br />

<strong>IP adress</strong>: the 'real' address of a website, when a user types in the domain name the computer will use this to find the IP address which can then be used to access the website.
<br />

<br />

<strong>Domain Name Registrar</strong>: the people you buy your domain from
<ul>
  <li>
    will list your chosen Domain Name with the ICANN (Internet Corporation for Assigned Names and Numbers).
  </li>
  <li>
    You'll have to foot the registration fee every year.
  </li>
  <li>
    When setting up you'll have to update the nameservers in this account.
  </li>
</ul>
<br />

<strong>Name server</strong>: usually held by your hosting company, it is a server with DNS software installed, often referred to as DNS servers.
<ul>
  <li>
    Holds a database of domain names and IP addresses, usually those within the same network.
  </li>
  <li>
    Recieves the request for your doman name and returns it's IP.
  </li>
  <li>
    Delegates to other name servers if it does not have a matching record.
  </li>
  <li>
    Every domain has a domain name server handeling it's requests, that name server is the Start of Authority on that site (SOA)
  </li>
  <li>
    The DNS settings for a site in it's name server are stored in a Zone file.
  </li>
</ul>
<br />

<strong>Zone File</strong>: stores configurations (records) for DNS lookups
<ul>
  <li>
    <strong>Host (A)</strong>: The mapping between IP and Domain Name
  </li>
  <li>
    <strong>Canonical Name (CNAME)</strong>: a Domain Aliase, must alwayse be pointed to another domain name, not IP.
  </li>
  <li>
    <strong>Mail Exchanger (MX)</strong>: mapping email traffic
  </li>
  <li>
    <strong>Name Server (NS)</strong>: Name server information for the zone - informs other name servers that this one is the SOA for a domain
  </li>
  <li>
    <strong>Start of Authority (SOA)</strong>: At the beginning of every zone file this lists the primary name server and some other info.
  </li>
</ul>

<br />

<br />

<strong>Internet Root Servers</strong>: A collection of hundreds of servers grouped into 13 named authorities.
<ul>
  <li>
    They return a list of Authorative Name Servers for a TLD.
  </li>
  <li>
    A DNS lookup may not hit a root server, it may be resolved from the cache of an intermediary name server.
  </li>
</ul>
<br />

<strong>Authorative Name Servers</strong>:
<ul>
  <li>
    Provieds the IP address for a domain in the specified TLD.
  </li>
</ul>
<br />

<h3>DNS lookup</h3>
<ul>
  <li>
    Before beginning the client wil likley check it's cache to see if a recent record exists for the requested domain, this stage also happens within each of the following DNS servers.
  </li>
  <li>
    To begin, the client computer will have the IP of one preferred DNS server to which it will send the initial request:<br />
    The <strong>DNS request</strong> comprises of three pieces of information
    <ul>
      <li>Domain name</li>
      <li>Query type</li>
      <li>Domain name class</li>
    </ul>
  </li>
  <li>
    If the prefferred DNS server does not know, it will forward on the request to other DNS servers
  </li>
  <li>
    Eventually the query will reach a root name server that covers the specific TLD.  If this comes up blank an error will be returned.
  </li>
</ul>

         






<hr />




<h2>The <code>.htaccess</code> file</h2>




<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>