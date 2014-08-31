<ol class="breadcrumb">
    <?php 
    	/*
    	 * This requires a couple of things ot be set:
    	 * 		$homePath = relative path of the site
    	 *		$crumbCut = number of links to ignore in the trail
    	 */

    	/*
    	 * This get's the location of the config file to include,
    	 * no matter the location of the working directory.
    	 * $homePath comes from head.php
    	 */
        $configLocation = (ltrim($homePath,'"')) . 'config.php';
    	include $configLocation;

    	/*
    	 * This gets the path to the current working directory 
    	 * the string is split into an array where '/' occurs
    	 */
        $crumbs = explode("/",$_SERVER["REQUEST_URI"]);

        /*
         * I have used $homePath again, this time as the initial 
         * building block for the href from which each breadcrumb
         * link will be built.  Every step into a directory structure
         * will be added.
         */
        $linkPath = $homePath;

        /*
         * Maybe a slightly verbose for loop but it keeps it clear in my head.
         * Also note the foreach is a slow function but in this case the 
         * loop is small enough to be of no worries!
         * I loop through each string in the exploded URI array.
         * The first few (as defined by $crumbCut in config.php) are ignored.
         * This is to account for the varying positions the breadcrumbs may begin from 
         * within varying directories.  For me, I only want to start the trail from 'Guides'
         */
        $crumbCounter = 0;
        foreach($crumbs as $crumb){
        	if ($crumbCounter <= $crumbCut) {
        		//do nothing, skip over the extended file root so the crumbs only show from 'Guides'
        	} else {
        		/*
        		 * This bit is fairly self explanitory, tidy up the string of '.php'
        		 * echo out the relative url, echo out the name of the breadcrumb
        		 * add the name + '/' to the $linkPath in preperation for the next loop in 
        		 * which the next link will require this directory level within it's address.
        		 */
	            $word = str_replace(".php","",$crumb);
	            echo '<li><a href=' . $linkPath . $word . '.php" >' . $word . '</a></li>';
	            $linkPath = $linkPath . $word . '/';
            } 
            //Increment the crumbCounter,
            $crumbCounter++;
        }
    /* Finally add in my litte flourish and bob's your uncle! A dynamic breadcrumb trail!
     * Actually, one final thought: this is done server side, it would be cool to work up a client side JS version
     * Then, somehow have a variable set in config that would indicate whether the server is under load
     * if it is - tell the client machien to do all the wee things like this, if it's not, then do it on the
     * server as it's probably quicker.  Food for thought!  Ideas for when there's time!
     */
    ?>
  <li class="guidemap"><a href=<?php echo $homePath . 'guides/map.php"' ?>>map</a></li>
</ol>