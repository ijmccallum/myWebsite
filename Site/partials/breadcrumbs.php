<ol class="breadcrumb">
    <?php 

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
         * This is to accont for the varying positions the breadcrumbs may begin from 
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
    //Finally add in my litte flourish and bob's your uncle! A dynamic breadcrumb trail!
    ?>
  <li class="guidemap"><a href=<?php echo $homePath . 'guides/map.php"' ?>>map</a></li>
</ol>