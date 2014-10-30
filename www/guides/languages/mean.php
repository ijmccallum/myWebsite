<?php $iainPageTitle = 'MEAN.js development'; $docDepth = 2;?>
<?php include '../../partials/head.php'; ?>

<?php $breadcrumbAddress = (ltrim($homePath,'"')) . 'partials/breadcrumbs.php'; ?>
<?php include $breadcrumbAddress; ?>

<h2>Directory structure</h2>
<h3>/Root</h3>
<ul>
	<li><h4>/app</h4>
		<p>The server files (Express.js)</p>
		<ul>
			<li><strong>/controllers</strong>: 	the business logic</li>
			<li><strong>/models</strong>: 		Mongoose models</li>
			<li><strong>/routes</strong>: 		Server routing</li>
			<li><strong>/tests</strong>: 		Mocha tests</li>
			<li><strong>/views</strong>:		Pretty much taken over by the angular system, but still usefull for: index, emails, error pages
				<ul>
					<li><strong>layout.server.view.html</strong>: Sets the main layout used for all other templates.</li>
					<li><strong>index.server.view.html</strong>: The main application page</li>
				</ul>
			</li>
		</ul>
	</li>
	<li><h4>/config</h4>
		<p>configuration files</p>
		<ul>
			<li><strong>/env</strong>:			configuration files, loaded depending on environment
				<ul>
					<li><strong>all.js</strong>:			loaded no matter the environment</li>
					<li><strong>&lt;envName&gt;</strong>: 	environment specific values will override those in all.js</li>
					<li>Some of the properties that can be set in these files:
						<ul>
							<li><code>db: 'mongo connection string'</code></li>
							<li><code>port: process.env.PORT || 3000,</code></li>
							<li><code>...</code> and so on</li>
							<li><strong>assets</strong>: allows us to configre which libraries and files to include per env</li>
							<li><strong>Social Config</strong> the set up for Oath with different social platforms (ID, Secret, & callback URL)</li>
							<li><strong>Nodemailer</strong> for email notifications</li>
						</ul>
					</li>
					<li>To run different envs: <code>NODE_ENV={envName} grunt</code></li>
				</ul>
			</li>
			<li><strong>/strategies</strong>:	passport.js authentication strategies (social platforms / local)</li>
			<li><strong>config.js</strong>:		loads the right configuration from <strong>/env</strong></li>
			<li><strong>init.js</strong>: 		Checks if ENV and does other set up things</li>
			<li><strong>passport.js</strong>: 	init and configuring from <strong>/strategies</strong></li>
		</ul>
	</li>
	<li><h4>/node_modules</h4>
		<p>Any modules required in npm's package.json that arn't already installed globaly</p>
	</li>
	<li><h4>/public</h4>
		<p>Any and all static files for the front end</p>
		<ul>
			<li><strong>/dist</strong>: 		the final build target when compressing the various bits that make up the app</li>
			<li><strong>/modules</strong>:		The Angular.js modules.  Originaly orgainsed horizontally (all the controllers in one folder, the views in another...) this was found to be difficult to scale well in big projects, so was switched to a vertical distrobution.  Each module has it's own folder containing it's own views, controllers, and so on.  Some example modules:
				<ul>
					<li><strong>/Core</strong>: main app configuration, controllers, tests, views</li>
					<li><strong>/Users</strong>: authentication, controllers, services, views...</li>
				</ul>
			</li>
			<li><strong>config.js</strong>: 2 global properties and 1 method:
				<ul>
					<li><code>applicationModuleName</code> This is the main module name used to bootstrap</li>
					<li><code>applicationModuleVendorDependencies</code> a list of the dependencies required to run the app (third party modules)</li>
					<li><code>registerModule</code> the method used to register new modules as described in the <a href="#modules">modules</a> section below</li>
				</ul>
			</li>
			<li><strong>application.js</strong> the main AngularJS file - takes care of bootstrapping and the right modules</li>
		</ul>
	</li>
	<li><h4>Application files (/root)</h4>
		<ul>
			<li><strong>server.js</strong> Starts up node</li>
			<li><strong>bower.json</strong> Front end package manager dependencies list</li>
			<li><strong>Dockerfile</strong> commands to build a docker image</li>
			<li><strong>fig.yml</strong> docker dev env <code><em><strong>WHAT IS DOCKER?</strong></em></code></li>
			<li><strong>gruntfile.js</strong> grunt configuration.  This lists which tasks are to be preformed by specific commands:
				<ul>
					<li><code>grunt</code> (default): JSHint, CSSLint, Watch, Nodemon</li>
					<li><code>grunt debug</code>: JSHint, CSSLint, Watch, Nodemon, Node-Inspector</li>
					<li><code>grunt lint</code>: JSHint, CSSLint</li>
					<li><code>grunt build</code>: JSHint, CSSLint, LoadConfig, NGMin, Uglify, CSSMin</li>
					<li><code>grunt test</code>: Env:test (change the environment), MochaTest (server tests), Karma:unit (angular tests)</li>
				</ul>
			</li>
			<li><strong>karma.conf.js</strong> configuring karma tests</li>
			<li><strong>package.json</strong> npm configuration</li>
			<li><strong>procfile</strong> Heroku process file</li>
		</ul>
	</li>
	<li><h4>hidden application files (/root)</h4>
		<ul>
			<li><strong>.bowerrc</strong> tells bower where to install components</li>
			<li><strong>.csslintrc</strong> configuring CSSLint properties</li>
			<li><strong>.editconfig</strong> defining code styles between whatever editors/IDEs you/your team uses</li>
			<li><strong>.gitignore</strong> exactly what it says on the tin</li>
			<li><strong>.jshintrc</strong> JSHint configuration</li>
			<li><strong>.slugignore</strong> for Heroku</li>
			<li><strong>.travis.yml</strong> travis configuraton for builds</li>
		</ul>
	</li>
</ul>

<hr />

<h2>$resource</h2>
<blockquote>"A factory which creates a resource object that lets you interact with RESTful server-side data sources." 
	- from <a href="https://docs.angularjs.org/api/ngResource/service/$resource">the docs</a></blockquote>


<hr id="modules" />

<h2>Modules</h2>

<p>WHAT ARE YOU?</p>

<p>To add a new module:</p>
<ul>
	<li>in <code>root/public/modules</code> add a new folder with this structure:<br />
<pre><code>module
|-config
|-controllers
|-css
|-directives
|-filters
|-img
|-services
|-tests
|-views
|-module.js
</code></pre>
		<p>That final <strong>module.js</strong> shoudl look something like this:
<pre><code>'use strict';

// register the module (this creates the module and pushes it to the the dependencies list of the AngularJS main module)
ApplicationConfiguration.registerModule('moduleName');
</code></pre>
</p>
	</li>
</ul>

<hr />

<h2>CRUD Modules</h2>

To create a new module (view/screen...) we can start with the Yeoman generator:<br />
<code>yo meanjs:crud-module &lt;name&gt;</code>
This will add the following:<br />
<strong>Server side (in the /app folder)</strong>
<ul>
	<li>create /controllers/&lt;controller-File-Name&gt;.js</li>
	<li>create /models/&lt;model-File-Name&gt;.js</li>
	<li>create /routes/&lt;route-File-Name&gt;.js</li>
	<li>create /tests/&lt;test-File-Name&gt;.js</li>
</ul>
<strong>Client side (in the /public/modules/&lt;module-name&gt; folder)</strong>
<ul>
	<li>create /config/&lt;module-name.routes&gt;.js</li>
	<li>create /config/&lt;module-name.config&gt;.js</li>
	<li>create /controllers/&lt;module-name.controller&gt;.js</li>
	<li>create /services/&lt;module-name.service&gt;.js</li>
	<li>create /tests/&lt;module-name.test&gt;.js</li>
	<li>In the /views folder:
		<ul>
			<li>create &lt;create-module-name&gt;.js</li>
			<li>create &lt;edit-module-name&gt;.js</li>
			<li>create &lt;list-module-name&gt;.js</li>
			<li>create &lt;view-module-name&gt;.js</li>
		</ul>
	</li>
	<li>create &lt;module-name.module&gt;.js</li>

</ul>

<hr />

<h2>Routing between AngularJS and ExpressJS</h2>

<p>ah the mysteries!</p>

<hr />

<h2>Tests</h2>

<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>