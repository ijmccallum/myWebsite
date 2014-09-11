<?php $iainPageTitle = 'Angular JS'; $docDepth = 2;?>
<?php include '../../partials/head.php'; ?>

<?php $breadcrumbAddress = (ltrim($homePath,'"')) . 'partials/breadcrumbs.php'; ?>
<?php include $breadcrumbAddress; ?>
<p>It is primarily a front end framework for single page web apps. It is a data binding frameworrk.</p>
<ul>
	<li>Routing (for any changes in the URL after the #)</li>
	<li>Templating</li>
	<li>Data binding</li>
	<li>MVC</li>
	<li>Routing handled into the shell view.</li>
</ul>

It also includes small versions of other libraries: q for promises, jqlite for jquery, dependencie injection kind of inspired by AMD, and a templatng language similar to handlebars. 

<hr />

<h2>First thing's first, <strong>Set up</strong></h2>
<code>&lt;html ng-app&gt;</code>: This is a <em>directive</em> signalling that this is an Angular app.<br />
<code>&lt;script src="js/angular.js&gt;&lt;/script&gt;</code>

<hr />

<h2>The pieces</h2>

<h3>Directives</h3>


<p>Elements which can be added to HTML in order to extend it (teach it new tricks!).  
	A little like the functions you get in Jade but these are incorporated into the HTML tags and they are a lot more powerful.  
	Anything starting with <code>ng-</code> is a built in directive, you can also start with <code>data-ng-</code> if you like.</p>
<ul>
	<li>
		<h4>ng-app</h4>
		When the script runs, this directive initialises the whole app.<br />
		<code>&lt;html <strong>ng-app</strong> &gt;</code>
		<br />
		<br />
	</li>
	<li>
		<h4>ng-model</h4>
		Adds data into the <code>input</code>, <code>select</code>, and <code>textarea</code> elements.<br />
		<code>&lt;input type="text" <strong>ng-model="name"</strong> &gt; <strong>{{ name }}</strong></code>
		<br />
		<br />
	</li>
	<li>
		<h4>ng-repeat</h4>
		Like a for-each for the data that was initialised / attached to the $scope.<br />
		<code>&lt;li <strong>ng-repeat="name in names"</strong> &gt; <strong>{{ name }}</strong>&lt;/li&gt;</code><br />
		When iterating through a model array we can also use <code>$index</code> to get the element's position within the array.
		<br />
		<br />
	</li>
	<li>
		<h4>ng-submit</h4>
		This bindes an angular function to the submit action of a form.<br />
		In the HTML:
<pre><code>&lt;form ng-submit="functionName()"&gt; 
	... 
	&lt;input type="submit"&gt;
&lt;/form&gt;</code></pre>
		and in the relevant controller:
<pre><code>$scope.functionName = function() {
	...
};</code></pre>
		<br />
	</li>
	<li>
		<h4>ng-click</h4>
		The angular verison of onClick.<br />
		<code>ng-click="function()"</code>
		<br />
		<br />
	</li>
	<li>
		<h4>ng-init</h4>
		Initialising a piece of data, wouldn't normally hard code like this though.<br />
		<code>&lt;body <strong>ng-init="names=['name1','name2','name3']"</strong> &gt;</code>
		<br />
		<br />
	</li>
</ul>

All the info: <a href="https://docs.angularjs.org/api"> in the api docs</a>


<h3>Filters (and some data binding)</h3>

<p>Once you have the data, pipe (|) it through a filter, here's an example:
<pre><code>&lt;ul&gt;
	&lt;li ng-repeat="cust in customers <strong>| orderBy: 'name'</strong>&gt;
		{{ cust.name <strong>| uppercase</strong> }}
	&lt;/li&gt;
&lt;/ul&gt;
</code></pre>

And another very cool example, this one lists out elements from initialised data (<em>customers</em>), filters it by the user input (<em>search</em>) then orders the results by name.
<pre><code>&lt;input type="text" ng-model="search" /&gt;
&lt;ul&gt;
	&lt;li ng-repeat="cust in customers <strong>| filter:search | orderBy:'name'</strong>"&gt;
		{{ cust.name }} - {{ cust.city }}
	&lt;/li&gt;
&lt;/ul&gt;
</code></pre>
</p>

<h3>Views, Controllers & Scope</h3>

<p><strong>Controllers</strong>, as usual, handling the data getting passed to, or returned from, 
	the <strong>view</strong> via the <strong>$scope</strong> (which can be referred to as a <em>ViewModel</em>. 
	Neither the controller, nor the view know about each other - loose coupling!</p>

<p>An example controller:
<pre><code>&lt;script&gt;
	function <strong>SimpleController</strong>(<strong>$scope</strong>) {

		<strong>$scope.customers</strong> = [
			{ name: 'name1', city: 'city1' },
			{ name: 'name2', city: 'city1' },
			{ name: 'name3', city: 'city2' },
			{ name: 'name4', city: 'city4' },
		];

	}
&lt;/script&gt;
</code></pre>

And the view.  A cool thing to note: only the elements within the div work with the specified controller, 
we can specify different controllers in different divs so they're not bound to 1 controller per view.
<pre><code>&lt;div <strong>ng-controller="SimpleController"</strong>&gt; //Angular automatically binds $scope here
	&lt;ul&gt;
		&lt;li ng-repeat="cust in <strong>customers</strong>"&gt;
			{{ cust.name }} - {{ cust.city }}
		&lt;/li&gt;
	&lt;/ul&gt;
&lt;/div&gt;
</code></pre>
</p>

<h3>Modules</h3>

<ul>
	<li>
		Modules have a config file which defines the routes with two key elements: the views and the controllers.
	</li>
	<li>You can refrence a module by name in the <code>ng-app</code> directive: <code>ng-app="moduleName"</code>
	</li>
</ul>
To make a module (the array is for dependencie injection, any other modules that need to be made available to demoApp):
<pre><code>var demoApp = angular.module('demoApp',[]);</code></pre>
<p>Then, to make a controller within the Module we can do one of three things:
	<ol>
		<li>Anonomyous function
<pre><code>demoApp.controller('SimpleController', function($scope) {
	...
});
</code></pre>
		</li>
		<li>Passed in as a variable
<pre><code>function simpleController($scope) {
	...
}
demoApp.controller('simpleController', simpleController); //name it then pass in the function
</code></pre>
		</li>
		<li>Passed in as an object (or many objects)
<pre><code>var controllers = {};
controllers.simpleController = function($scope) {
	...
};
demoApp,controller(controllers)
</code></pre>
		</li>
	</ol>
</p>

<h3>Routes</h3>
<p>Defined in the app's config object as follows:
<pre><code>var demoApp = angular.module('demoApp',[]);

demoApp.config(function ($routeProvider) {

	$routeProvider
		.when('/', {
			controller: 'simpleController',
			templateUrl: 'view1.html' //the file address
		})
		.when('/partial2', {
			controller: 'simpleController',
			templateUrl: 'view2.html'
		})
		.otherwise({ 
			redirectTo: '/' 
		});

});
</code></pre>

Now that the controllers are handeled through the routes, in the HTML we can use a different directive:
<code>&lt;div ng-view&gt;</code>  This div is placed in the shell page and the view, with data from the controller, is injected dynamically.
</p>

<h3>Encapsulating data functionality</h3>
<p>Rather than hardcoding data manipulation in each controller we can extract it and reuse it between multiple controllers.</p>
<ul>
	<li>
		<strong>Factories</strong>: Create an object inside the facotry and return it.
	</li>
	<li>
		<strong>Service</strong>: Standard function using <code>this</code> to define functions.
	</li>
	<li>
		<strong>Provider</strong>: uses a $get object which can be used to get the data.
	</li>
</ul>

<p>For example, a Factory:</p>
<pre><code>var demoApp = angular.module('demoApp', [])
	.factory('simpleFactory', function() {
		var factory = {};
		var customers = [ ... ];
		factory.getCustomers = function() {
			return customers;
		};
		return factory;
	})
	.controller('simpleController', function($scope, simpleFactory) {
		$scope.customers = simpleFactory.getCustomers();
	});
</code></pre>

<hr />

<h3>Testing</h3>
<strong>Karma</strong><br />
<p>
	To begin make sure any bower components are listed within the files array of the karma.conf.js file 
	(their file paths).<br />
	The individual tests are set up in <strong>test/spec/controllers/___.js</strong>
</p>


<hr />

<p>Source: 
	<a href="https://docs.angularjs.org/guide/introduction">The Docs</a>, 
	<a href="https://www.youtube.com/watch?v=i9MHigUZKEM">Fundamentals tutorial</a></p>



<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>