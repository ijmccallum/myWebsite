<?php $iainPageTitle = '@ijmccallum'; $docDepth = 0;?>
<?php include 'partials/head.php'; ?>
	<div class="row" style="text-align:center;">
		<h2 class="quirkyHeading">The things I do</h2>
	</div>
	<div class="row" style="text-align:center;">
		<div class="col-md-6">

			<h2><a href="webdev.php">Web App Development</a></h2>
			<p><em>An interactive service accessible through any browser from any device.<br />
				Intended as a tool as opposed to a resource.<br />
				e.g., <a href="http://trello.com">Trello</a>, 
				<a href="http://prezi.com/" target="_blank">Prezi</a>, 
				<a href="http://c9.io/">Cloud9</a>, 
				<a href="http://grooveshark.com/">Grooveshark</a></em></p>
			<br />
			<div class="iconBox">
				<img src="pics/mongo-logo.png" width="50" height="50">
				<p>MongoDB</p>
			</div>
			<div class="iconBox">
				<img src="pics/express-logo.png" width="50" height="50">
				<p>ExpressJS</p>
			</div>
			<div class="iconBox">
				<img src="pics/angular-logo.png" width="50" height="50">
				<p>AngularJS</p>
			</div>
			<div class="iconBox">
				<img src="pics/nodejs-logo.png" width="50" height="50">
				<p>NodeJS</p>
			</div>
			<!--
			<div class="iconBox">
				<img src="pics/cordova-logo.png" width="50" height="50">
				<p>Cordova</p>
			</div>
			<div class="iconBox">
				<img src="pics/sencha-logo.png" width="50" height="50">
				<p>Sencha</p>
			</div>
			-->

		</div>
		<div class="col-md-6">

			<h2><a href="webdev.php">Web Site Development</a></h2>
			<p><em>An online display or resource<br />
				whose primary function is to serve information.<br />
				May contain a Web App.</em></p>
			<br />
			<div class="iconBox">
				<img src="pics/wordpress-logo.png" width="50" height="50">
				<p>WordPress</p>
			</div>
			<!--
			<div class="iconBox">
				<img src="pics/keystone-logo.png" width="50" height="50">
				<p>KeystoneJS</p>
			</div>
			-->
			
		</div>
	</div>

	<hr />
	<div class="row" style="text-align:center;">
		<h2 class="quirkyHeading">Some things I've done</h2>
	</div>

	<div class="row">
	    <div class="col-md-6">
	        <img src="pics/webDev/wikilogic02.jpg" class="webDevScreenshot">
	    </div>
	    <div class="col-md-6">
	        <p><strong>Wikilogic</strong> is an open source project currently being developed and looked after by myself and a few others.  
	            The idea is to create a system that will allow us to map out all logic, or as much of it as we can fit into a sharded database.  
	            This might seem a little wild but at a holistic level, it's actually quite simple.<br /><br />  We have a live demo running which I can supply a link to on request,
	            or you can get it running locally by visiting the <a href="https://github.com/WikiLogic/WikiLogic">Github</a> page.  We'll be writing about more general progress
	            on the <a href="http://www.wikilogicfoundation.org/" target="_blank">main site</a> and the in depth theory is being laid out in our <a href="http://www.wikilogicfoundation.org/wiki">meta wiki</a>.
	        </p>
	    </div>
	</div>

	<div class="row">
	    <div class="col-md-6">
	        <img src="pics/bubbles-shot.png" class="webDevScreenshot">
	    </div>
	    <div class="col-md-6">
	        <p><strong>Bubbles!</strong> was an experiment in app development for Android.  It was only meant to be a test to run through the process of creating and publishing
	            but it turned into a full game written with <code>Create.js</code> and wrapped with <code>Cordova</code>.  As a result of this being a small test that just kept growing, 
	            it's all written in one gigantic javascript file!  Taught me a thing or two about what not to do.  Still, got it working, pretty proud of that!<br />  
	            <br />
	            You can now download it onto any android device or just play it in the browser.
	        </p>
	        <code><a target="_blank" href="bubbles">Play</a></code>
	    </div>
	</div>

	<div class="row">
	    <div class="col-md-6">
	        <img src="pics/synergyShot.png" class="webDevScreenshot">
	    </div>
	    <div class="col-md-6">
	        <p><strong>Synergy</strong> a browser based puzzle platformer, built in Unity3D, infused with a message about life.  At the start of this project I was purely
	        a designer, by the end I had caught the code bug.</p>
	        <code><a target="_blank" href="http://sophiesgames.com/Synergy.html">Play</a></code>
	        <p><em>Note: this requires the unity web player to run, it will prompt you to download but don't worry - it doesn't take long!</em></p>
	    </div>
	</div>

<!--
    <div class="row" style="text-align:center;">
    	<div class="col-md-3">
    		<h3><a href="appdev.php#synergy">Synergy</a></h3>
    		<img src="pics/synergyShot.png" class="indexProjectPic">
    		<ul class="list-group">
    			<li class="list-group-item">A browser based puzzle platformer infused with a message about life.</li>
				<li class="list-group-item">C++, Unity</li>
				<li class="list-group-item"><a href="http://sophiesgames.com/Synergy.html" target="_blank">Play</a><br />(requires Unity Web Player)</li>
			</ul>
    	</div>
    	<div class="col-md-3">
    		<h3><a href="appdev.php#bubbles">Bubbles!</a></h3>
    		<img src="pics/bubbles-shot.png" class="indexProjectPic">
    		<ul class="list-group">
    			<li class="list-group-item">A small, and somewhat silly, game about popping bubbles.</li>
				<li class="list-group-item">Javascript, EaselJS, Cordova</li>
				<li class="list-group-item">Play on <a href="https://play.google.com/store/apps/details?id=com.iainjmccallum.bubbles" target="_blank">Android</a> or in the <a href="bubbles">Browser</a></li>
			</ul>
    	</div>
    	<div class="col-md-3">
    		<h3><a href="webdev.php#wikilogic">Wikilogic</a></h3>
    		<img src="pics/wikilogic-shot.png" class="indexProjectPic">
    		<ul class="list-group">
				<li class="list-group-item">A logic mapping project with an almost incomprehensibly large goal.  This is still in the earliest stages of development.</li>
				<li class="list-group-item"><a href="http://wikilogicfoundation.org/" target="_blank">Get involved</a></li>
			</ul>
    	</div>
    	<div class="col-md-3">
    		<h3><a href="webdev.php#wedding-shows">Wedding Shows</a></h3>
    		<img src="pics/nws-shot.png" class="indexProjectPic">
    		<ul class="list-group">
    			<li class="list-group-item">The most recent websites in my portfolio, built by a small but very global team.</li>
				<li class="list-group-item">WordPress, Visual Composer, HTML5, CSS3, Javascript, PHP</li>
				<li class="list-group-item">Visit the <a href="http://www.nationalweddingshow.co.uk/" target="_blank">National site</a><br />or the <a href="http://www.theukweddingshows.co.uk/" target="_blank">UK site</a></li>
			</ul>
    	</div>
<<<<<<< HEAD
    </div>        
    <hr id="aboutMe" />
=======
    </div>    
    -->    
    <hr />
>>>>>>> f535c30ee590fc7f6c40ef1d286a508084961256
	<div class="row" style="text-align:center;">
		<h2 class="quirkyHeading">A bit about me</h2>
	</div>
	<div class="row">
		<div class="col-md-2"></div>
	    <div class="col-md-8">
	    	<p class="lead">How I got here is a bit of a story.  A series of discoveries that lead 
	    		through more than a few creative industries.  The first happened while I was training 
	    		to be an Architect in Edinburgh, Scotland.  I discovered just how much more amazing 
	    		drafting and 3D software is in comparison to hand drawing.  It felt like discovering 
	    		the wheel!  <br /><br />

	    		I'd had a taste of the digital world and wanted more, so I finished up my 
	    		training and moved to one of Scotland's technology hubs, the University of Abertay in Dundee.
	    		I learnt modeling, texturing, rigging and animtaion in 3D, special effects with particle systems, 
	    		lighting, stereoscopics, editing, screen writing, sound effects, and, to top it all off, 
	    		I discovered that all this was being applied procedurally in game development.  <br /><br />

	    		This blew my mind and I loved all of it, but you can't run down 10 different career paths and find success.
	    		So to find my way, I began taking on freelance projects in a few of the different industries.  
	    		I did some 3D modeling and animation for a couple of indi movies, some VFX filled motion graphics
	    		for an advertising agency, some Graphic Design and some Illustration.  <br /><br />

	    		I have always been described as a creative person so it was a little surprising that none of these options clicked, 
	    		in the end it was while working on the game art for <a href="http://sophiesgames.com/">Synergy</a> with a group of indi developers when I 
	    		figured out what did - programming!  Looking back across all the things I've gone through it suddenly
	    		seems clear that this was the thing linking it all.  Underneath everything it was the software itself
	    		that I was finding enthralling.  From there I've had a pretty focused drive into the world of Web Development
	    		which brings us to now!<br /><br />  

	    		If you've read this far, thank you, it's amazing you lasted!  We must have some pretty similar
	    		interests - I want to hear from you so send me a hello: <code style="font-size:70%;">IJMcCallum {at} hotmail {dot} co {dot} uk </code>,
	    		honestly, just say "Hi, we've got similar interests. All the best, &lt;your name&gt;".<br /><br />
<!--
	    		Stanford's online course in programming methodology got me started with the fundamentals. W3 Schools have done 
	    		a great job in laying out the details of HTML(5) and CSS(3).  The WordPress documentation is vast but persistance
	    		allowed me to pick apart and start building themes.  I won a few freelance contracts then got hired in house to maintain
	    		a collection of aging websites for a company that had switched to building apps with Sencha and NodeJS - while there I
	    		picked up the fundamentals of ExpressJS, MongoDB, and some more in depth Javascript.  From there I immgrated accross the
	    		Atlantic, discovered AngularJS and fell in love with it!  
-->
	    	
	        <!--
	        <p class="lead">Hello and welcome to my site!  As you may have guessed, I’m Iain.  I’ve developed a love of learning (everything) and am fascinated with The Internet.  I have built websites, developed video games, and created media for almost every form of digital design there is.  I also believe in simplicity.  Not just in it being the ultimate sophistication, but in it being a necessity for a happy life – which is my biggest aim!  And I have a sneaking suspicion we may have that aim in common.  So drop me a line, I’d love to chat: <code style="font-size:70%;">IJMcCallum {at} hotmail {dot} co {dot} uk </code></p>
	    	-->
	    </div> <!-- END 6 column for text -->
	</div> <!-- END intro row -->

	 <hr />
	<div class="row" style="text-align:center;">
		<h2 class="quirkyHeading">Some other tools I use</h2>
	</div>
	<div class="row" style="text-align:center;">
	    <div class="col-md-12">
	    	<div class="iconBox">
				<img src="pics/photoshop-logo.jpg" width="50" height="50">
				<p>Photoshop</p>
			</div>
			<div class="iconBox">
				<img src="pics/illustrator-logo.jpg" width="50" height="50">
				<p>Illustrator</p>
			</div>
			<div class="iconBox">
				<img src="pics/indesign-logo.jpg" width="50" height="50">
				<p>InDesign</p>
			</div>
			<div class="iconBox">
				<img src="pics/after-effects-logo.jpg" width="50" height="50">
				<p>After Effects</p>
			</div>
	    </div> <!-- END 6 column for text -->
	</div> <!-- END intro row -->

	 <hr />

	 <div class="row" style="text-align:center;">
		<h2 class="quirkyHeading"><a href="webdev.php">Want to see some more of my work? >></a></h2>
	</div>
<!--
	<hr />
	<div class="row" style="text-align:center;">
		<h2 class="quirkyHeading">A look in my past</h2>
	</div>
	<div class="row" style="text-align:center;">
	    <div class="col-md-4">
	        <h3>Architecture<br /> & 3D Modelling</h3>
	    </div>
	    <div class="col-md-4">
	        <h3>Animation<br /> & Motion Graphics</h3>
	    </div>
	    <div class="col-md-4">
	        <h3>Graphic Design<br />& Advertising</h3>
	    </div>
	</div> 
-->




                
<?php include 'partials/footer.php'; ?>