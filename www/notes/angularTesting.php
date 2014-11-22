<?php $iainPageTitle = 'Angular Testing'; $docDepth = 1;?>
<?php include '../partials/head.php'; ?>

<h3>Testing overview</h3>

<p>Each test is contained in a Test block:</p>
<pre><code>describe('Unit: MainController', function() {
  // Our tests will go here
})</code></pre>

<p>Within the block we need to give the test a few things:
<ul>
	<li>The module, <code>beforeEach(module('myApp'));</code>, which contains the controller we're looking for</li>
	<li>A manually instantiated controller and scope object
<pre><code>var ctrl, scope;
  // inject the $controller and $rootScope services
  // in the beforeEach block
  beforeEach(inject(function($controller, $rootScope) {
    // Create a new scope that's a child of the $rootScope
    scope = $rootScope.$new();
    // Create the controller
    ctrl = $controller('MainController', {
      $scope: scope
    });
  }));</code></pre>
	</li>
	<li>A test!</li>
</ul>

<pre><code>it('describe what the function you are testing should do', 
    function() {
      expect(something).toBeUndefined(); //or whatever!
      scope.doTheFunction();
      expect(something).toEqual("perfection"); //or whatever!
  });</code></pre>

</p>

<p>Thanks to <a href="http://www.ng-newsletter.com/advent2013/#!/day/19">ng-newsletter</a> for a more in depth tutorial on testing Angular with Karma!</p>

<hr />

<h3>In more detail: Jasmine</h3>

<p>Every test suite begins with <code>describe()</code> taking a descriptive string and a function containing the tests.</p>
<p>Every test is wrapped with <code>it()</code> which again takes a descriptive string and a funciton which is the test.</p>
<p><i><a href="http://en.wikipedia.org/wiki/Behavior-driven_development">BDD</a> style would have the strings of <code>describe()</code> 
	followed by <code>it()</code> form a full sentence, for example:</i>
<pre><code>describe("A spec using beforeEach and afterEach", function() {
	...
	it("is just a function, so it can contain any code", function() {
		...
	});

	it("can have more than one expectation", function() {
		...
	});	
}</code></pre>
	</p>
<p>Tests are made up of <code>expect(input)</code> followed by a <i>matcher</i> function which informs Jasmine what the input should be. Any failing expectation fails the whole test.</p>
<p><strong>matcher functions:</strong>The full list for each version of Jasmine are, as you might expect, included in the <a href="http://jasmine.github.io/">Docs</a>.  But here are some anyway:
<ul>
	<li><code>expect(a).toBe(b)</code> compares with ===</li>
	<li><code>.not.toBe(null);</code></li>
	<li><code>.toEqual(12);</code> simple literals and variables</li>
	<li><code>.toMatch(/bar/);</code> regular expressions</li>
	<li><code>.not.toMatch("bars");</code></li>
	<li><code>.toBeDefined();</code> checks against 'undefined'</li>
	<li><code>.not.toBeDefined();</code></li>
	<li><code>.not.toBeUndefined();</code></li>
	<li><code>.toBeUndefined();</code></li>
	<li><code>.toBeNull();</code></li>
	<li><code>.not.toBeNull();</code></li>
	<li><code>.toBeTruthy();</code> for boolean casting</li>
	<li><code>.toContain("bar");</code> finds an item in an array</li>
	<li><code>.not.toContain("quux");</code></li>
	<li><code>.toBeLessThan(pi);</code></li>
	<li><code>.not.toBeLessThan(e);</code></li>
	<li><code>.toBeGreaterThan(e);</code></li>
	<li><code>.not.toBeGreaterThan(pi);</code></li>
	<li><code>.toThrow();</code> to test if a function throws an exception</li>
	<li><code>.not.toThrow();</code></li>
</ul>
</p>
                
<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>