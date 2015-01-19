<?php $iainPageTitle = 'WordPress'; $docDepth = 1;?>
<?php include '../partials/head.php'; ?>

<h2>Proper plugins</h2>

<h3>Advanced Custom Fields</h3>
<p>
	If there is anything to be done through specific input fields, this is the one to use.
</p>

<hr />

<h2>Funky Functions</h2>

<hr />

<h3>paginate_links( $args )</h3>
<p>
<pre><code>$args = array(
	'base'               => '%_%', //After URL, this is added
	'format'             => '?page=%#%', //Overrides 'base' for URL structure
	'total'              => 1, //Total number of pages
	'current'            => 0, //Current page number
	'show_all'           => False, //Show all pages, as opposed to 1 … 3 4 5 6 7 … 9
	'end_size'           => 1, //Number of page numbers to show next to the « Prev and Next »
	'mid_size'           => 2, //Number of page numbers to show either side of the current page
	'prev_next'          => True, //Whether to include « Prev and Next »
	'prev_text'          => __('« Previous'),
	'next_text'          => __('Next »'),
	'type'               => 'plain', //return type: plain (text with &lt;a href=""), array, or list (&lt;li&gt;)
	'add_args'           => False, //an array for query args?
	'add_fragment'       => '', //a string at add to the links?
	'before_page_number' => '',
	'after_page_number'  => ''
);</code></pre>
Returns: « Prev 1 … 3 4 5 6 7 … 9 Next » as HTML:
<pre><code></code></pre>
</p>

<pre><code>$args = array(
	'base'               => '%_%',
	'format'             => '?page=%#%', //These won't matter.  Build in functions.php, add array to return details
	'total'              => 1, //possibly relace this with query page count?
	'current'            => 0, //definetly replace this with query count
	'show_all'           => False,
	'end_size'           => 1,
	'mid_size'           => 2,
	'prev_next'          => True,
	'prev_text'          => __('« Previous'),
	'next_text'          => __('Next »'),
	'type'               => 'array'
);</code></pre>

<hr />

<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>
