            </div> <!-- END page-content -->
            <div id="footerBar">
                <p>Say hello! I'm on <a href="https://github.com/ijmccallum">Github</a>, <a href="https://twitter.com/IJMcCallum">Twitter</a>, <a href="https://www.youtube.com/user/iamwhoiambutnotyou">YouTube</a>, <a href="https://www.threadless.com/profile/2038652/ijmccallum/designs">Threadless</a>, <a href="http://grooveshark.com/#!/ijmccallum">Grooveshark</a>, <a href="http://8tracks.com/ijmccallum">8Tracks</a>, <a href="https://www.khanacademy.org/profile/ijmccallum/">Khan Academy</a>, <a href="https://www.threadless.com/profile/2038652/ijmccallum/designs">Wikilogic</a>, and a whole lot more...</p>
                <p>IJMcCallum {at} hotmail {dot} co {dot} uk</p>
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


    <!-- The contact me form -->
    <div class="modal fade" id="contactModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" id="contactBoxClose" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="myModalLabel">Contact Me</h4>
          </div>
          <div id="contactModalBody" class="modal-body">
            <form id="contact-form" data-parsley-validate >
                <label for="email">Email</label><br />
                <input id="contact-form-email" type="email" name="email" data-parsley-trigger="change" required />
                <label for="message">Message</label><br />
                <textarea id="contact-form-message" name="message" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-validation-threshold="20" data-parsley-minlength-message = "That's all?"></textarea>
                <div class="g-recaptcha" data-sitekey="6LcsE_8SAAAAAPbat4qiwoi_lID0ui7i4GvrshcC"></div>
                <button type="submit" class="btn btn-primary" style="margin-top: 10px;">Send</button>
                <button type="button" class="btn btn-default pull-right" style="margin-top: 10px;" data-dismiss="modal">Close</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- JavaScript -->
    <script src=<?php echo $homePath . "bootstrap/js/jquery-1.10.2.js" . '"' ?>></script>
    <script src=<?php echo $homePath . "bootstrap/js/bootstrap.js" . '"' ?>></script>
    <script src=<?php echo $homePath . "js/parsley.js" . '"' ?>></script>
    <script src=<?php echo $homePath . "highlight/highlight.js" . '"' ?>></script>
    <script>hljs.initHighlightingOnLoad();</script>

    <!-- Contact form -->
    <script type="text/javascript">
        $('#contact-form').submit(function(e) { 
            e.preventDefault();
            if ( $(this).parsley().isValid() ) {
                /* Submitting the form data with Ajax */ 

                /* Set up the post data */ 
                var contactFormEmail = document.getElementById('contact-form-email').value;
                var contactFormMessage = document.getElementById('contact-form-message').value;
                var gRecaptchaResponse = grecaptcha.getResponse();
                var ajaxPostString = "email=" + contactFormEmail + "&message=" + contactFormMessage + "&g-recaptcha-response=" + gRecaptchaResponse;

                /* Set up the request object */
                var xhr;
                if (window.XMLHttpRequest) {
                    xhr = new XMLHttpRequest();
                } else {
                    xhr = new ActiveXObject("Microsoft.XMLHTTP");
                }

                /* POST Request */
                xhr.open("POST", "/submit.php", true);
                xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                xhr.send(ajaxPostString);

                /* Server responce */
                xhr.onreadystatechange = function(){ //gives us the option to deal with various errors
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        handleSuccessfulResponce();
                    }
                };

                function handleSuccessfulResponce(){
                    console.log('SUCCESS! responseText: ' + xhr.responseText);
                    var successHTML,
                        responceResult = xhr.responseText;


                    switch(responceResult) {
                        case "Human":
                        document.getElementById('myModalLabel').innerHTML = "Message sent!";
                            successHTML = "<p><i><strong>Email</strong><br />" + contactFormEmail + "</i></p>";
                            successHTML += "<p><i><strong>Message</strong><br />" + contactFormMessage + "</i></p>";
                            setTimeout(function(){ document.getElementById('contactBoxClose').click(); }, 3000);
                            break;
                        case "reCAPTCHAbot":
                            successHTML = "<h3>Hmm, google thinks you're a bot.</h3>";
                            break;
                        case "brokenJS":
                            successHTML = "<h3>Something's broken, it didn't work.</h3>";
                            break;
                        default:
                            successHTML = "<h3>There might be a server problem, it didn't work.</h3>";
                    }


                    document.getElementById('contactModalBody').innerHTML = successHTML;

                }
            }
        });
    </script>

    <!-- Slide sidebar -->
    <script>
        $("#menu-toggle").click(function() {
            $("#wrapper").toggleClass("active");
        });
    </script>

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
