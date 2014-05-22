            </div> <!-- END page-content -->
            <div id="footerBar">
                <p>Hello</p>
            </div>
        </div> <!-- END page-content-wrapper -->

    </div> <!-- END wrapper -->
    <div id="secretContainer">
        <div id="secretSection" onClick="hideSecrets()">
            <h2>Ah, you found the secret area. Nice one!</h2>
            <p>
                I'm torn about this bit being in, I love a good ego boost as much as the next man, but, 
                bragging isn't really the most attractive of traits.<br /><br />  Well, in this world of tough competition, it's got to go in so here 
                it is, and anyway - it's not like I've fixed world hunger, it's just a bunch of random things!<br /><br />
                Through the small number of years I've been wandering round I've chased a whole bunch of different goals, 
                and out of them, one has remained constant: to be (at minimum) better than average at everything I do.<br /><br />  
                If you think about it, it's probably not really that uncommon, in fact it's probably one of the most common 
                aims throughout humanity!  So, here are a few of the things in which I feel I've been most successfull:
            </p>
            <ul>
                <li>TARGET RIFLE: (basically being a sniper), I've shot for the UK on three international tours, captained one and coached for all 3. In the end I peaked at around number 40 in the world!</li>
                <li>ROWING: I became the Scottish Junior doubls champion with a guy called Daniel, we'd only trained together once!</li>
                <li>SNOWBOARDING: I became a level 3 NZ instructor and even considered it as a career path before my shoulder decided it didn't like being in it's socet too much, that was an end to that!</li>
                <li>VISA: Bit of a random one, this wasn't really my aim but at the time our marrige petition went through my wife and I had the fastest approval on record for the USA!</li>
                <li>ANIMATION: While at university I started submitting to the 11 Second club and managed to get to 51st place (considering this is against the guys who work at Pixar and Dreamworks, I felt pretty good!) Oh yeah, out of about 200, so, better than average!</li>
                <li>ILLUSTRATION: I have submitted quite a few designs to Threadless.com and peaked at 3.5 out of 5, I know that doesn't sound too high but trust me, that's good!  The communty average was 1.92, and for professionals: 2.27</li>
                <li>GUITAR: I've alwayse enjoyed playing, acoustic / electric / 12 string / anything, usually in privet. But once, I ended up on stage leading a professional jazz band with an improvised solo in what was probablly the most firghtning experiance of my life, you see, I was tricked into it!</li>
            </ul>
            <P>I'm now working on adding Chess and Golf to that list, wish me luck!</p>
        </div>
    </div>

    <!-- JavaScript -->
    <script src=<?php echo $homePath . "bootstrap/js/jquery-1.10.2.js" . '"' ?>></script>
    <script src=<?php echo $homePath . "bootstrap/js/bootstrap.js" . '"' ?>></script>

    <!-- Masonry JS init -->
    <script>
        
        //Init Masonry for tools page
        <?php if ($iainPageTitle == "Tools") { ?>
            var container = document.querySelector('#toollist');
            var msnry = new Masonry( container, {
                // options
                columnWidth: 164,
                itemSelector: '.toolBox'
            });

        //Init Masonry for Misc. page
        <?php } else if ($iainPageTitle == "Misc.") { ?>
            var container = document.querySelector('#misclist');
            var msnry = new Masonry( container, {
                // options
                columnWidth: 400,
                itemSelector: '.miscBox'
            });
            
        <?php } ?>
        
    </script>
    <script>
        function secretSlide(){
            $( "#secretSection" ).animate({right: "10px"}, 500);
            setTimeout(function(){
                $( "#secretContainer" ).animate({height: "1800px"}, 1000);
            }, 100);
        }
        function hideSecrets() {
            $( "#secretContainer" ).animate({height: "0px"}, 500);
            $( "#secretSection" ).animate({right: "-250px"}, 500);
        }
    </script>
    <script src=<?php echo $homePath . "js/console.js" . '"' ?>></script>
</body>

</html>
