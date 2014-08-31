<?php $iainPageTitle = 'Website speed guide'; $docDepth = 2;?>
<?php include '../../partials/head.php'; ?>

<?php $breadcrumbAddress = (ltrim($homePath,'"')) . 'partials/breadcrumbs.php'; ?>
<?php include $breadcrumbAddress; ?>

<h2>Summary of this summary</h2>

<ul>
<li>use Gzip</li>
<li>use a CDN</li>
<li>combine files to minimise requests (JS, CSS, Sprites)</li>
<li>Split files between frequent and infrequent for fingerprint caching</li>
<li>extract resources crucial for above-the-fold rendering, defer the rest <em>(code snippet to do this included here in Loading resources > deferring)</em></li>
<li>Load CSS before JS</li>
<li>Images: small = GIF, Photo = JPG, else = PNG</li>
<li>Images: specify sizes, eliminates reflow</li>
<li>CSS: specific selectors are better</li>
<li>design UX for <a href="https://www.youtube.com/watch?v=7ubJzEi3HuA">perception performance</a></li>
</ul>

<hr />

<h3>Caching</h3>

<h5>Fingerprint resource URL's</h5>

<p>So when a resource is updated the fingerprint changes and the browser is forced to fetch the new resource.  This lets us set expiry dates long into the future.  </p>

<ul>
<li><a href="http://clock.co.uk/tech-blogs/versionator---static-content-versioning-in-nodejs-using-express">versionator</a> Looks like it might be a good tool for the job <a href="https://github.com/serby/versionator">on git</a></li>
</ul>

<h5>Dynamic content</h5>

<p>set cache time to 1 hour, this will stop frequently repeated requests from a visitor navigation round the site.</p>

<h5>How to set up</h5>

<p>Check if Chris / Andrew / Stuart know how to do this <br />
Expires: 1 year <br />
Cache-Control: max-age 3153600 <br />
Set last modified</p>

<hr />

<h3>Round Trips</h3>

<h5>DNS lookups</h5>

<ul>
<li>Where possible use www.blah.com/thing rather than thing.blah.com, this avoids any additional DNS lookups.</li>
<li>JS &amp; other resources used in the initial view should be loaded from the same host. <em>Unless they are sharded between pages and it's important to increase the cache hit rate, but this might be solved in the caching section</em></li>
<li>only use redirects when absolutely necessary (I think node.js does this internally, which is awesome)</li>
<li>find and remove all bad requests (404's)</li>
</ul>

<h5>External JS files</h5>

<p>Combine files to reduce the number of lookups, but not into one big file.  Split your external code with the following considerations:</p>

<ul>
<li>Initial load: minimal code for above-the-fold content, defer the rest so it doesn't block other resources.</li>
<li>Versioning: long term code in one file to be cached, frequently updated code into another to be cached with fingerprinting.</li>
</ul>

<h5>External CSS files</h5>

<p>Combine for the same reasons as above.  3 files max, 2 preferred.</p>

<ul>
<li>1.CSS the minimum required to render the initial view</li>
<li>2.CSS all the rest</li>
</ul>

<h5>Images into Sprites</h5>

<ul>
<li>Combine grouped images into CSS sprites, dynamic pics like profile photos may not be so good.  </li>
<li>Sprite small images first, cache them.</li>
<li>Consider reducing the resulting sprites into the same 256 colour palette to avoid the PNG truecolor type</li>
</ul>

<h5>Order in the head</h5>

<p>Load JS after CSS so they download in parallel (if the JS went first the CSS would be delayed until the JS had completed downloading, parsing and executing)</p>

<h5>Avoid</h5>

<ul>
<li>document.write to declare resources</li>
<li>CSS @import </li>
</ul>

<p>They both prevent resources to be downloaded in parallel.</p>

<hr />

<h3>Loading resources</h3>

<p>It looks like asynchronous and deferring are alternatives of each other, deferring is the most popular.</p>

<h5>asynchronously</h5>

<p><code>&lt;script&gt;</code> <br />
<code>var node = document.createElement('script');</code> <br />
<code>node.type = 'text/javascript';</code> <br />
<code>node.async = true;</code> <br />
<code>node.src = 'example.js';</code> <br />
<code>// Now insert the node into the DOM, perhaps using insertBefore()</code> <br />
<code>&lt;/script&gt;</code></p>

<h5>In parallel across multiple hosts</h5>

<p><a href="https://developers.google.com/speed/docs/best-practices/rtt#ParallelizeDownloads">needs more research</a></p>

<h5>Deferring</h5>

<p>Only effective for pages in which more than 25 functions are uncalled before the onload event. <br />
Here's an example listener to be added into the head of a page, it will call the remaining functions at an appropriate time.</p>

<p><code>&lt;script type="text/javascript"&gt;</code>  </p>

<p><code>// Add a script element as a child of the body</code> <br />
<code>function downloadJSAtOnload() {</code> <br />
<code>var element = document.createElement("script");</code> <br />
<code>element.src = "deferredfunctions.js";</code> <br />
<code>document.body.appendChild(element);</code> <br />
<code>}</code>  </p>

<p><code>// Check for browser support of event handling capability</code> <br />
<code>if (window.addEventListener)</code> <br />
<code>window.addEventListener("load", downloadJSAtOnload, false);</code> <br />
<code>else if (window.attachEvent)</code> <br />
<code>window.attachEvent("onload", downloadJSAtOnload);</code> <br />
<code>else window.onload = downloadJSAtOnload;</code>  </p>

<p><code>&lt;/script&gt;</code>  </p>

<h5>Optimising images</h5>

<p>Serve scaled images.  They should be scaled to match the largest version of the image on each page, if there are two copies on one page use markup to scale down the smaller one rather than loading another.</p>

<ul>
<li>Use GIFs for small images, less than 10x10 or 3 colours</li>
<li>Use JPGs for photographic images</li>
<li>PNGs for all the rest</li>
<li>Lower the colour palette to the lowest acceptable limits.</li>
<li>serve them from a consistent URL across the site</li>
</ul>

<hr />

<h3>Requests</h3>

<h5>Minimise request size</h5>

<ul>
<li>Try to keep them to one packet, send keys which can be indentified on the server</li>
<li>serve resources from a cookieless domain (except the files for the initial load, above-the-fold content - this should be served from the same domain as the main body to avoid additional DNS lookups) <em>cookies are small enough to not be a huge issue, unless building a site with many components in which case it might be worth the effort</em></li>
</ul>

<hr />

<h3>Payload</h3>

<h5>Gzip</h5>

<ul>
<li>It should be possible to pre-compress files and cache them for future download to take load off the server.  </li>
<li>Only Gzip file above 500bytes (min range from 150 - 1000)</li>
<li>CSS key-value-pairs, put them in the same order (ie, alphabetize) <a href="http://csscomb.com/">CSS combe looks good</a></li>
<li>HTML attributes, order them (ie, alphabetize but with href first)</li>
<li>HTML quoting, keep it consistent (ie "" and not '')</li>
<li>Don't Gzip images - it'll actually make them larger</li>
</ul>

<p>Remove unused CSS &amp; defer rules not used on the current page</p>

<h5>Minify everything!</h5>

<p>Performance boost will only really be seen when minifying files above 4096 Kb</p>

<hr />

<h3>Rendering</h3>

<h5>CSS</h5>

<p>Neat little trick here: <br />
Inline the CSS which applies to above-the-fold content into a style block in the head, defer the rest.  This will let the critical styling load in the first few packets. Need to check up on the impacts and techniques of deferring the rest of the CSS.</p>

<ul>
<li>Don't use tags as selectors (too general, results in a ton of redundant definitions)</li>
<li>Be specific</li>
<li>Use class selectors over descendants (ul li bad, .unordered-list-item good)</li>
<li>CSS expressions are bad (only old ie's support them anyway) </li>
</ul>

<h5>Images</h5>

<p>Specify their heights and widths eliminates unnecessary reflow. (in HTML or CSS, your choice)</p>

<h5>JS</h5>

<p>Bottom of the page</p>

<hr />

<h3>CDN's</h3>

<p>Many will pipe an HTTPS request as an HTTP, might have to ask them to redirect to an HTTPS origin URL</p>

<h3>Tools</h3>

<p><a href="http://www.webpagetest.org/"> webpagetest.org </a> <br />
<a href="https://developers.google.com/speed/pagespeed/">Google pagespeed</a></p>

<h3>SPDY</h3>

<p>Networking protocol that augments HTTP</p>



<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>