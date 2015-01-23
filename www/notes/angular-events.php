<?php $iainPageTitle = 'Angular: Events'; $docDepth = 1;?>
<?php include '../partials/head.php'; ?>

<ul>
  <li>
    <code>$scope.$emit("event name", args);</code> Fires an event <strong>up</strong> the scopes to $root</li>
  <li>
    <code>$rootScope.$broadcast("event name", args);</code> Fires event <strong>down</strong> the scope</li>
  <li>
    <code>$on</code> attached to a scope, defines a listener
<pre><code>$rootScope.$on(event, function (eventName, args) {
  fn(data);
  event.stopPropagation(); //cancels an $emit but not a $brodacast
});</code></pre>
  </li>
</ul>

<code>$$listeners</code>: the property of $scope / $rootScope that holds the listeners.

<h4>A note on $rootScope</h4>
<ul>
  <li><code>$emit</code>: notifies all listners on $rootScope</li>
  <li><code>$broadcast</code>: notifies all lisnters on $rootScope as well as decending through it's children.</li>
</ul>

<p>Each controller is given it's own scope:</p>
<pre><code>&lt;div ng-controller="ParentCtrl as parent" class="ng-scope"&gt;
  &lt;div ng-controller="SiblingOneCtrl as sib1" class="ng-scope"&gt;&lt;/div&gt;
  &lt;div ng-controller="SiblingTwoCtrl as sib2" class="ng-scope"&gt;&lt;/div&gt;
  &lt;/div&gt;
</code></pre>

<h4>Is it possible to select a specific scope?</h4>

<hr />

<ul>
  <li><code>$scope.$watch(watchExpression, listener, [objectEquality]);</code> </li>
  <li><code>$scope.$watchCollection</code></li>
</ul>
<code>$$watchers</code>

<p>
  Each ng-bind creates a watcher:
</p>
<pre><code>&lt;li ng-bind='prop'&gt;&lt;/li&gt;</code></pre>



<hr />
<p>Sources</p>
<ul>
  <li><a target="_blank" href="http://www.smashingmagazine.com/2015/01/22/angularjs-internals-in-depth/">Smashing Mag</a></li>
  <li><a target="_blank" href="http://toddmotto.com/all-about-angulars-emit-broadcast-on-publish-subscribing/">Todd Motto</a></li>
</ul>
<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>
