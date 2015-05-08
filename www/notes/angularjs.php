<?php $iainPageTitle = 'Angular JS'; $docDepth = 1;?>
<?php include '../partials/head.php'; ?>


<p>Keep your data in the services, use controllers to expose it to the views</p>
<p>Don't split into modues (yet, this may change in the future)</p>

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
	<li>
		<h4>ng-class</h4>
		Setting the class of an element based on an angular variable. It can be used a few different ways:<br />
		<ul>
			<li><code>ng-class="variable"</code> it will just add the variable as the class</li>
			<li><code>ng-class="[variable1, variable2]"</code> same as above but with multiple</li>
			<li><code>ng-class="{ 'class' : variable, 'class2' : variable2 }"</code> if variable is true, adds class</li>
			<li><code>ng-class="{variable ? 'class-if-true' : 'class-if-false' }"</code>short hand for either or</li>
		</ul>
		source: <a href="http://scotch.io/tutorials/javascript/the-many-ways-to-use-ngclass" target="_blank">scotch.io article</a>
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
<p>There are two routing modules that I currently know of.  <br />
	ngRoute: <code>$ bower install --save angular-route</code> <br />
	and angular-ui-router: <code>$ bower install --save angular-ui-router</code>. <br />
	I will be focusing on angular-ui-router, for the difference between them in detail check out <a href="http://stackoverflow.com/questions/21023763/difference-between-angular-route-and-angular-ui-router#answers">this conversation</a> on stackoverflow</p>
<p>To set up:
	<ul>
		<li>Run the bower (or other package manager) command, so we have the routing magic.</li>
		<li>Make sure the source files are included in index.html, so our app knows we have the routng magic - and where to find it.</li>
		<li>define in the app's main module (this is for angular-ui-router): <code>angular.module('appName',[<strong>'ui.router'</strong>]);</code>, so that finally the angular code knows about the routing magic!</li>
		<li>Add the directive to the index.html template: <code>&lt;div <strong>ui-view</strong>&gt;&lt;/div&gt;</code>.  This div will be filled with the apropriate view template when the time comes.</li>
		<li>Wire up the views:
<pre><code>var demoApp = angular.module('demoApp',[]);

appName.config(function ($stateProvider, $urlRouterProvider) {

	//any unmatched url goes here
	$urlRouterProvider.otherwise("/");

	//When the url is matched, the template @ templateUrl will be placed in the previously specified div (along with it's controller)
	$stateProvider
		.state('state1', {
			url: '/state1',
			templateUrl: 'state1.html',
			controller: 'state1Controller'
		})
		.state('state2', {
			url: '/state2',
			templateUrl: 'state2.html',
			controller: 'state2Controller'
		})

});
</code></pre>
		</li>
	</ul>
</p>
<p>One of the biggest advantages of the ui-router over the ngRouter is it's ability to have <strong>nested views</strong>.  To do this:</p>
<ul>
	<li>in state1.html, add another div with the <code>ui-view</code> directive.</li>
	<li>in the <code>.config()</code> function we define a child state:
<pre><code>.state('state1.childStateName', {
	url: '/state1.child',
	templateUrl: 'state1.child.html',
	controller: 'state1Controller'
})
</code></pre>
			I believe the router knows that by specifying parent.child as the state name we mean to add the template into the child <code>&lt;div ui-view&gt;</code>
	</li>
</ul>

<p>Another nice thing to have is the ability to have <strong>multiple nested views</strong> in a single template.  To do this:</p>
<ul>
	<li>In whichever template you are working in:
<pre><code>&lt;div ui-view="viewA"&gt;&lt;/div&gt;
&lt;div ui-view="viewB"&gt;&lt;/div&gt;</code></pre>
	</li>
	<li>In the <code>.config()</code> function, we can add multiple views to each state defenition:
<pre><code>.state('state1', {
	url: '/state1',
	views: {
		'view1': {template:'state1.view1.html'},
		'view2': {template:'state1.view2.html'}
	}
});
</code></pre>
	</li>
</ul>
<p>we can also <strong>pass paramaters through urls</strong> by:</p>
<ul>
	<li>
<pre><code>.state('state1.childStateName', {
	url: '/state1:paramName',
	templateUrl: 'state1.html',
	controller: function ($scope, $stateParams) {
		var passedData = $stateParams.paramName;
	}
})
</code></pre>
	</li>
</ul>

<p>angular-ui-router also comes with some handy directives of it's own, they are listed in the <a href="https://github.com/angular-ui/ui-router/wiki/Quick-Reference#statetransitiontoto-toparams--options">docs</a> but here's one very handy one:</p>
<ul>
	<li>plain link: <code>&lt;a <strong>ui-sref="stateName"</strong>&gt;&lt;/a&gt;</code> will navigate to the url associated with the specified state</li>
	<li>with params: <code>&lt;a <strong>ui-sref="stateName({param: value, param: value})"</strong>&gt;&lt;/a&gt;</code></li>
	<li>with <code>ui-sref-active</code> to add/remove class based if active
<pre><code>&lt;ul>
  &lt;li ui-sref-active='class1 class2 class3'&gt; //can live on the same element or parent. When active these classes will be added
    &lt;a ui-sref="app.user"&gt;link&lt;/a&gt;
  &lt;/li&gt;
&lt;/ul&gt;</code></pre>
	</li>
</ul>

<p>source: <a href="https://github.com/angular-ui/ui-router">the angular-ui-router docs</a> on github</p>

<hr />

<h3>Services</h3>

<p>They stick around until the application is closed (controllers are tidied when no longer needed).
This allows them to courier data between controllers.</p>

<h4>factory()</h4>
<p>Used to create a service.  Can be injected into controllers at run time.  Great to create simple functions and data.</p>
<pre><code>//Creating a service with factory()
angular.module('myApp.services').factory('serviceName', function(dependancies) {
	var service = {
		data: {},
		functionName: function(input){
			//do something fancy!
		}
	}
	return service;
});</code></pre>
<pre><code>//Injecting the service into our app
angular.module('myApp').controller('mainController', function($scope, serviceName){
	$scope.functionName = serviceName.functionName;
});</code></pre>
<p>_</p>
<h4>service()</h4>
<p>Similar to <code>factory()</code> </p>
<pre><code>//Creating a service with service()
angular.module('myApp.services').service('serviceName', function(dependancies) {
	var self = this;
	this.someData = {};
	this.setName = function(newName) {
		self.someData['name'] = newName;
	}
});
</code></pre>
<p>Injecting this service is the same as the <code>factory()</code> example above</p>
<p>Neigher the <code>factory()</code> nor the <code>service()</code> methods can be configured from the <code>.config()</code> function, where as the next one can!</p>
<p>_</p>

<h4>provide()</h4>
<p>Allows us to configure the service before the app runs - useful when distributing on a different env.</p>
<pre><code>//Creating a service with provide()
angular.module('myApp.services').provider('serviceName', function(){
	this.someData = {};
	this.$get = function(dependancies) { //injecting dependancies here rather than earlier
		var self = this;
		var service = {
			functionName: function(input) {
				//do fancy things here!
			}
		};
		return service;
	}
});</code></pre>
<p>And here's where we inject it into the <code>.config()</code> function:</p>
<pre><code>angular.module('myApp').config(function(serviceName) {
	//stuff
})</code></pre>
<p>Finally it can be used in the app like normal</p>
<pre><code>angular.module('myApp').controller('MainController', function($scope, User) {
	//things
});</code></pre>
<p>source: the <a href="http://www.ng-newsletter.com/">ng-newsletter</a> book</p>
<hr />

<h3><code>$resource</code></h3>
Allows us to interact with a RESTful service / the back end.<br />
Requires:
<ul>
	<li>Resource script source</li>
	<li><code>ng-resource</code> module ( <code>var app = new angular.module("app", ["ngResource"]);</code> )</li>
	<li>injected into the controller: <code>app.controller("name",["$scope","$resource", function($scope, $resource){ ... }]);</code></li>
</ul>
For example, creating the object with which you can interact:
<pre><code>var item = $resource("/route/:variable", {variable:value}, {});</code></pre>
The first value is the route you wish to use,<br />
the second is any path variables to be passed,<br />
the third is route something... don't need, express handles it!<br />
Then later on you can:
<pre><code>item.get({variable:value}, function(data){
	//This is the callback!
});</code></pre>

<hr />

<h3>Typeahead</h3>
<p>Kind of like the thing google does when you start typing</p>

<p>source: the <a href="http://angular-ui.github.io/bootstrap/">angular bootstrap</a> library</p>
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
