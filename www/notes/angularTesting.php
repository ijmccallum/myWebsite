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

<h3>In more detail</h3>

                
<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>