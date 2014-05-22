#The Sencha Insights Website

After working at Swarm for a few months this was my first big (solo) project and a huge milestone in my professional development.  The sites I had built up until this point had all been WordPress themes using a fairly simple production process: edit the php / front end code, run the server.  Easy.  The Sencha site was slightly more complex.

It runs on NodeJS using KeystoneJS as the back end, a very young CMS which is still in development.  The theme was translated from HTML to Jade and threaded into Keystone with a fair amount of manipulation to get the site working as we desired.  Some of the things I had to develop were:  

* Pagination
* Search
* 

The data also proved quite interesting as I had to combine the content from SQL dbs on two seporate sites into the new MongoDB.  For the various articles that had been written I exported them as JSON and used the fantastic capabilities of Sublime Text to reorganise and reformat the data for mongo.  I also had to set up the original Swarm blog to run locally in order to export the existing WP comments in a format that would allow me to import them into the Disqus system that I am using on Sencha Insights.

Working in the office, the development progress was easy to demo within our network.  But, I then emigrated to America!  The solution I went for was to set up the project on Cloud9 and use MongoHQ to host the db.  This allowed me to switch from my aging machien onto a shiney new chromebook as well as providing an easy way to demo the site to the guys no matter which continent anyone happened to be on!  What's more, by using Cloud9 I had to learn to use git from the command line as opposed to through sourcetree.

The final challenge was deploying the live site onto the big new Swarm server, ...
as a result the site is now live and kicking!  You can check it out at senchainsights.com