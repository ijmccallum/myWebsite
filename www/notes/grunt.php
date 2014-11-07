<?php $iainPageTitle = 'Grunt'; $docDepth = 1; ?>
<?php include '../partials/head.php'; ?>

<p>Automation of build processes (like compiling SASS or reloading the browser on saves)</p>
        <h4>Set up</h4>
        <ul>
          <li><code>npm install -g grunt-cli</code> the global grunt command line</li>
          <li><code>npm install grunt --save-dev</code> saves grunt itself to the <strong>package.json</strong> and sets up a basic <strong>gruntfile.js</strong></li>
          <li><code>install grunt plugins</code> Adds the grunt pluginName and updates the <strong>gruntfile.js</strong></li>
        </ul>
        <h4>The gruntfile.js</h4>
        <ul>
          <li>Everything is contained in the wrapper function
<pre><code>module.exports = function(grunt) {
  //grunt things here
};
</code></pre>
          </li>
          <li><code>grunt.initConfig()</code> setting up the grunt configuration
<pre><code>grunt.initConfig({
  pkg: grunt.file.readJSON('package.json'),
  plugin/taskName: {
    pluginOption: ...
  }
});</code></pre>
            <p>some common tasks set up within <strong>initConfig()</strong>:</p>
            <ul>
              <li>
                <strong>meta</strong> and using underscore templating for the date feature
<pre><code>meta: { 
  banner: '/* comment to be added to some file, built <%= grunt.template.today() %>'
}</code></pre>
              </li>
              <li>
                <strong>Minify</strong> also pulling in data from <strong>meta</strong> above.
<pre><code>min: {
  typeOfBuild: {
    src: ['&lt;banner&gt;', 'directory/*.js'],
    dest: 'minified.min.js'
  },
  anotherTypeOfBuild {
    src: ['directory/file1.js', 'directory/file2.js'],
    dest: 'minified12.min.js'
  }
}</code></pre>
              </li>
              <li>
                <strong>Watch</strong> for live reloads.  When thre is a change to the listed files, preform the listed tasks (happens to be the minify task 'typeOfBuild' example above)
<pre><code>watch: {
  files: ['directory/*.js'],
  tasks: ['min:typeOfBuild']
}</code></pre>
              </li>
            </ul>
          </li>
          <li><code>grunt.registerTask()</code> functionally the same as above where you could type 
            <code>grunt typeOfBuild</code> except the code below will allow us to run just <code>grunt</code> 
            and <strong>typeOfBuild</strong> will be run as the default.  Also allows us to list different 
            combinations of tasks depending on the type of build as defined here, check out the grunt file 
            within any mean.js projects.
<pre><code>grunt.registerTask('default', ['typeOfBuild', 'someOtherTask']);
grunt.registerTask('test', ['testTask1', 'testTask2']); //defenition for running <strong>grunt test</strong>
</code></pre>
          </li>
        </ul>
        <p>source: <a href="http://gruntjs.com/getting-started">the docs</a></p>

<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>