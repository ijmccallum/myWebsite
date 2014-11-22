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
<p><strong>Setup and Teardown:</strong> a few handy functions to prepare the context (variables defined on the <i>describe</i> scope),
<ul>
	<li><code>beforeEach(function(){ ... };)</code></li>
	<li><code>afterEach</code></li>
	<li><code>beforeAll</code></li>
	<li><code>afterAll</code></li>
</ul>
</p>
<p><strong>this</strong> is an empty object on the <i>describe</i> scope, it is set to empty for each block of tests, 
	we can use it to share objects between <i>it</i>'s, <code>this.value = "sharedThing";</code>
</p>
<p><strong>Nested Describe</strong> are possible! And work with <i>beforeEach</i> and whatnot</p>
<p><strong>Disabling suites</strong> so as to skip them: <code>xdescribe</code> and <code>xit</code></p>
<p><strong>Pending</strong> functions will show up as pending if:
<ul>
	<li><code>xit</code></li>
	<li><code>pending();</code> is called within <code>it()</code></li>
	<li><code>it('doesn't have a function')</code></li>
</ul>
</p>

<p><strong>Spies</strong>: checking up on calls, their arguments, return values, exceptions thrown...<br />
In these examples, 
<pre><code>obj = {
	functionName: function(value) {
		bar = value;
	}
}</code></pre>
<ul>
	<li><code>spyOn(obj, 'functionName')</code> allows us to spy on the function</li>
	<li><code>expect(obj.functionName).toHaveBeenCalled()</code> true if <i>obj.functionName</i> was called</li>
	<li><code>expect(obj.method).toHaveBeenCalledWith('foo', 'bar')</code> can be called at seperate times with each arg</li>
	<li><code>obj.method.callCount</code> number of times it was called</li>
	<li><code>obj.method.mostRecentCall.args</code> args to the most recent call</li>
	<li><code>obj.method.reset()</code> resets calles made to the spy</li>
	<li><code>spyOn(obj, 'functionName').and.callThrough();</code> The spy method also calls through the real method? not sure what this is</li>
	<li><code>spyOn(obj, 'functionName').and.returnValue(745);</code> every call the <i>functionName</i> will return 745</li>
	<li>
<pre><code>spyOn(obj, "functionName").and.callFake(function() {
      return 1001;
    });</code></pre>
    like <i>returnValue</i> but allows us to write a function in place
	</li>
	<li><code>spyOn(obj, 'functionName').and.throwError("errorName");</code></li>
	<li><code>obj.method.and.stub();</code> //not sure</li>
	<li><code></code></li>
</ul>
Calls to functions that we ae spying on are tracked by the <code>calls</code> property, it's an array:
<ul>
	<li><code>.calls.any()</code> returns true if the function has been called at least once</li>
	<li><code>.calls.count()</code> what it says on the tin!</li>
	<li><code>.calls.argsFor(index)</code> index number of the call you're interested in, returns the args it was passed</li>
	<li><code>.calls.allArgs()</code> all the args sent to your function ever (in this suite)</li>
	<li><code>.calls.all()</code> //not too sure</li>
	<li><code>.calls.first()</code> returns the first call and it's details</li>
	<li><code>.calls.reset()</code> resets the tracking!</li>
	<li><code>jasmine.any</code> matches the class, eg <code>expect(foo).toHaveBeenCalledWith(jasmine.any(Number), jasmine.any(Function));</code></li>
	<li><code>jasmine.objectContaining({ bar: "baz" })</code> returns true if the object containes this pair</li>
</ul>
</p>

<p><strong>Manipulating time</strong>: <br />
To set up we must have <code>jasmine.clock().install;</code>, usually in <code>beforeEach()</code>, followed by <code>jasmine.clock().uninstall();</code>
in <code>afterEach()</code>.  Good example from the docs:
<pre><code>it("causes a timeout to be called synchronously", function() {
	setTimeout(function() {
		timerCallback();
	}, 100);

	expect(timerCallback).not.toHaveBeenCalled();

	jasmine.clock().tick(101);

	expect(timerCallback).toHaveBeenCalled();
});</code></pre>
Mock the date:
<pre><code>var baseTime = new Date(2013, 9, 23);
jasmine.clock().mockDate(baseTime);
</code></pre>
<strong>It does asyncronous!</strong> but I don't understand the docs at the moment
</p>


                
<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>