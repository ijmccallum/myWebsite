
//Gameplay variables
var score = 0,
    speedMin = 2,
    speedMax = 4,
    popScoreMin = 1,
    popScoreMax = 1,      //<< this cab be increased, needs a panel
    ambientPop = 0.1,   //<< this cab be increased, needs a panel
    bubbleRate = 10;       //<< this cab be increased, needs a panel
var upgradeCountNumBubbles = [0, 0, 0, 0, 0, 0],
    upgradeCountValBubbles = [0, 0, 0, 0, 0, 0],
    upgradeCountAmbtPop = [0, 0, 0, 0, 0, 0];
var ambientTimer; //the setInterval function for ambient popping!
var clickRippleContainer, //The container for each click ripple to be added.
    totalClickRipples, //The number of current click ripples
    rippleWidth = 20, //the width of the clickRipples
    clickRippleArray = [];
//The UI
var numBubblesPanel = new createjs.Container(),
    bubbleValuePanel = new createjs.Container(),
    ambientPopPanel = new createjs.Container(),
    pausePanel = new createjs.Container();
    numBubblesPanel.active = false;
    bubbleValuePanel.active = false;
    ambientPopPanel.active = false;
var theTop = 100; //Distance from the top before upgrade panels begin
var cRadius = 5;
var iconSheet = new Image(), //The various icons!
    iconSpriteSheet,
    icon1, icon2, icon3, icon4;

// for the animation stuff
var stage, circle, target, circleY, score, bitmap, txt, play, pauseTxt, clicked, mouseTarget, mvTargets = [], state = [], startTxt;
var canvas = document.getElementById('demoCanvas');
FastClick.attach(canvas);
var noTgts = 5;
var tgtBlurFilter = [];
var particleImage, particleBmp;
var puff = [], emitter = [], emitterAlive = [];
var emitterCount = 0;
var bubbleContainer = new createjs.Container();
var upgradeBarContainer = new createjs.Container();
var bmpList = [];

//Special effects
navigator.vibrate = navigator.vibrate || navigator.webkitVibrate || navigator.moz || navigator.notification.vibrate || window.navigator.vibrate;
var vibration = false;
if (navigator.vibrate) {
    vibration = true;
}




/* =====================================================
 * =====================================================
 * ======================  SET UP  =====================
 * =====================================================
 * =====================================================
 */

document.addEventListener("deviceready", onDeviceReady, false);
 
function onDeviceReady() {
    navigator.splashscreen.hide();
    //document.addEventListener("backbutton", pause, false);
    //document.addEventListener("menubutton", exitFromApp, false);
    document.addEventListener("pause", pause, false);
    init();
    //document.addEventListener("volumedownbutton", pause, false);
}
function exitFromApp()
    {
        if (navigator.app) {
           navigator.app.exitApp();
        }
        else if (navigator.device) {
            navigator.device.exitApp();
        }
    }

document.getElementById('demoCanvas').width = window.innerWidth;
document.getElementById('demoCanvas').height = window.innerHeight;

//When the page loads, this function is called from the body, this is where all the fun will happen!
function init() {



    function onConfirmQuit(button){
       if(button == "1"){
        navigator.app.exitApp(); 
    }
    }

    //Creating a stage and pointing it at the canvas element
    stage = new createjs.Stage("demoCanvas");

    clickRippleContainer = new createjs.Container();

    particleImage = new Image();
    particleImage.src = "img/particle_base.png";

//Might have to move this into the handle click for the start screen, 
//otherwise there's a tiny chance it'll load in time to be put on the canvas with the update :O
    iconSheet.onload = handleiconSheetLoad;
    iconSheet.src = "img/bubbleIcons.png";
    

    //todo: get top score from memory.
    if (typeof(Storage)!=="undefined") {

      score = Number(localStorage.getItem("score"));
      if (score == null || isNaN(score) || score == 0) { score = 0; }

      speedMin = Number(localStorage.getItem("speedMin"));
      if (speedMin == null || isNaN(speedMin || speedMin == 0)) { speedMin = 2; }

      speedMax = Number(localStorage.getItem("speedMax"));
      if (speedMax == null || isNaN(speedMax) || speedMax == 0) { speedMax = 4; }

      popScoreMin = Number(localStorage.getItem("popScoreMin"));
      if (popScoreMin == null || isNaN(popScoreMin) || popScoreMin == 0) { popScoreMin = 1; }

      popScoreMax = Number(localStorage.getItem("popScoreMax"));
      if (popScoreMax == null || isNaN(popScoreMax) || popScoreMax == 0) { popScoreMax = 1; }

      ambientPop = Number(localStorage.getItem("ambientPop"));
      if (ambientPop == null || isNaN(ambientPop) || ambientPop == 0) { ambientPop = 0.1; }

      bubbleRate = Number(localStorage.getItem("bubbleRate"));
      if (bubbleRate == null || isNaN(bubbleRate) || bubbleRate == 0) { bubbleRate = 10; }

      upgradeCountNumBubbles = localStorage.getItem("upgradeCountNumBubbles");
      if (upgradeCountNumBubbles == null) {
        upgradeCountNumBubbles = [0,0,0,0,0,0]
      } else {
        upgradeCountNumBubbles = upgradeCountNumBubbles.split(",");
      }

      upgradeCountValBubbles = localStorage.getItem("upgradeCountValBubbles");
      if (upgradeCountValBubbles == null) {
        upgradeCountValBubbles = [0,0,0,0,0,0]
      } else {
        upgradeCountValBubbles = upgradeCountValBubbles.split(",");
      }

      upgradeCountAmbtPop = localStorage.getItem("upgradeCountAmbtPop");
      if (upgradeCountAmbtPop == null) {
        upgradeCountAmbtPop = [0,0,0,0,0,0]
      } else {
        upgradeCountAmbtPop = upgradeCountAmbtPop.split(",");
      }

      console.log("Local storage available, updating gameplay variables");
    } else {
      console.log("No saved values found, gameplay variables set to baseline");
    }

    console.log("score " + score);
    console.log("speed Min: " + speedMin + " | Max: " + speedMax);
    console.log("Value Min: " + popScoreMin + " | Max: " + popScoreMax);
    console.log("ambientPop " + ambientPop);
    console.log("bubbleRate " + bubbleRate);

    console.log("upgradeCountNumBubbles: " + upgradeCountNumBubbles);
    console.log("upgradeCountValBubbles: " + upgradeCountValBubbles);
    console.log("upgradeCountAmbtPop: " + upgradeCountAmbtPop);

    //canvas.onmousedown = handleClick;
    //canvas.addEventListener('touchstart', handleClick, false);
    //canvas.addEventListener('touchmove', handleClick, false);
    canvas.addEventListener('click', handleClick, false);
    //canvas.addEventListener('onmousedown', handleClick, false);
    setTimeout(startScreen, 2000);
}


var popAnimation;
function handleiconSheetLoad() {
    // define sprite sheet data describing the available icons:
    // we can use the form {frameName:frameNumber} in animations because each "sequence" is only a single frame:
    var data = {
        images:[iconSheet],
        frames:{width:40, height:40},
        animations: {numberIcon:0, valueIcon:1, ambientIcon:2, lightningIcon:3, "pop": [4, 7]}
    }
    iconSpriteSheet = new createjs.SpriteSheet(data);

    // create a Sprite to display frames from the sprite sheet:
    icon1 = new createjs.Sprite(iconSpriteSheet);
    icon1.gotoAndStop("numberIcon");

    icon2 = icon1.clone();
    icon2.gotoAndStop("valueIcon");

    icon3 = icon2.clone();
    icon3.gotoAndStop("ambientIcon");

    icon4 = icon3.clone();
    icon4.gotoAndStop("lightningIcon");

    popAnimation = icon4.clone();

    makeLightBeams();
}

var lightBeamList = [];
var lightContainer = new createjs.Container();
var noLightBeams = 10;

function makeLightBeams() {

    //Adds a bunch of light beams
    for (i=0; i<noLightBeams; i++) {
        //Making the lightbeam pic
        var lightBeamImg = new Image();
        lightBeamImg.src = "img/lightBeam.png";
        var lightBeamBmp = new createjs.Bitmap(lightBeamImg);
        lightBeam = lightContainer.addChild(lightBeamBmp); 

        lightBeam.x = (Math.random() * (canvas.width / (noLightBeams * 2) )) + (i * (canvas.width / (noLightBeams) )) - 200;
        lightBeam.y = -100;
        lightBeam.alpha = Math.random();
        lightBeam.speed = (Math.random() * 1.5) + 0.5;
        lightBeam.name = "lightbeam";

        lightBeam.rotation = figureRotation(lightBeam.x);

        //Setting up it's variables
        lightBeam.direction = i%2; // +/- will make the image move right / left, reset when it leaves the screen
        lightBeamList.push(lightBeam); //so we have a list of the light beams!
    }

    stage.addChild(lightContainer); //everything in the container is now on the stage!
}

function moveLightBeams() {
    for (i=0; i<noLightBeams; i++) {
        var currentBeam = lightBeamList[i];

        //Move the light horizontally
        currentBeam.x += currentBeam.direction * currentBeam.speed;
        if (currentBeam.x < -400 || currentBeam.x > (canvas.width + 100)) {
            currentBeam.direction = currentBeam.direction * -1;
        }

        //Figure out the beams rotation
        lightBeam.rotation = figureRotation(lightBeam.x);
    }
}

function figureRotation(x) {
    var rotValue = (x + (canvas.width / 2));
    returnValue = ((x * (rotValue)) / 20000) * -1;
    return returnValue - 20;
}

/* =====================================================
 * =====================================================
 * ====================  INTERFACE  ====================
 * =====================================================
 * =====================================================
 */
/**
 * Create the upgrade bar
 */
function makeUpgradeBar() {
  /*
   * The background
   */
  stage.addChild(upgradeBarContainer);

  var barBG = new createjs.Shape();
  barBG.graphics
    .beginFill("rgba(0,0,0,0.1)").rect(0, (canvas.height-50), canvas.width, canvas.height);

  upgradeBarContainer.addChild(barBG);

  /*
   * The upgrade buttons
   */

  var numBubblesBtn = new createjs.Container();
  makeBarBtn(numBubblesBtn, (canvas.width * 0.2), "Number of bubbles", icon1);
 
  var bubbleValueBtn = new createjs.Container();
  makeBarBtn(bubbleValueBtn, (canvas.width * 0.4), "Value of bubbles", icon2);

  var ambientPopBtn = new createjs.Container();
  makeBarBtn(ambientPopBtn, (canvas.width * 0.6), "Ambient pop rate", icon3);

  var slowBubblesBtn = new createjs.Container();
  makeBarBtn(slowBubblesBtn, (canvas.width * 0.8), "Speed", icon4);

  function makeBarBtn(container, xPos, name, barIcon) {

      container.name = name;

      //var bgWidth = canvas.width / 6; //width
      var bgHeight = 40; //height 
      var circleHeight = 46;
      var topLeftX = xPos; //top left x
      var topLeftY = (canvas.height - (bgHeight+5)); //top left y
      var panelBtnBG = new createjs.Shape();
      panelBtnBG.graphics.beginFill("rgba(0,0,0,0.5)").drawCircle(topLeftX, topLeftY+(bgHeight/2), (circleHeight/2))
        container.addChild(panelBtnBG);

      // var panelBtnTxt = new createjs.Text (name, "20px Patrick Hand", "#fff");
      // panelBtnTxt.textAlign = "center";
      // panelBtnTxt.x = xPos;
      // panelBtnTxt.y = topLeftY;
      // panelBtnTxt.name = "play";
        
      barIcon.x = xPos - 20;
      barIcon.y = topLeftY;
      container.addChild(barIcon);

  }

  upgradeBarContainer.addChild(numBubblesBtn);
  upgradeBarContainer.addChild(bubbleValueBtn);
  upgradeBarContainer.addChild(ambientPopBtn);
  upgradeBarContainer.addChild(slowBubblesBtn);

   /*
    * The upgrade panels
    */

    /*
     * Building the upgrade panel for the NUMBER of bubbles
     *
     *    ,gPPRg,   ,gPPRg,   ,gPPRg,                    
     *   dP'   `Yb dP'   `Yb dP'   `Yb
     *   8)     (8 8)     (8 8)     (8
     *   Yb     dP Yb     dP Yb     dP
     *    "8ggg8"   "8ggg8"   "8ggg8" 
     */
    var numBubblesPanelBG = new createjs.Shape();
    numBubblesPanelBG.name = "panelBG";
    var numBubblesPanelTitle = new createjs.Text ("Number of bubbles: " + bubbleRate, "20px Patrick Hand", "#fff");
    numBubblesPanelTitle.name = "numBubblesPanelTitle";
    var numBubblesplayBtn = new createjs.Container();

    genericBits(numBubblesPanel, numBubblesPanelBG, numBubblesPanelTitle, numBubblesplayBtn);

        /*
         * Adding the upgrade options for the NUMBER of bubbles
         */
         var numUp = [];

         makeNumberUpgrades(0, -10, 4000, 5); //5
         makeNumberUpgrades(1, -5, 200, 10); //10
         makeNumberUpgrades(2, -1, 25, 20); //20
         makeNumberUpgrades(3, 1, 25, 20); //20
         makeNumberUpgrades(4, 5, 200, 10); //10
         makeNumberUpgrades(5, 10, 4000, 5); //5
         function makeNumberUpgrades(i, value, cost, maxCount) {

             numUp[i] = new createjs.Container();
             var yIncriment = theTop + (i * 55);

             numUp[i].name = "number";
             numUp[i].inc = i;
             numUp[i].upgradeValue = value;
             numUp[i].upgradeCost = cost;
             numUp[i].upgradeCount = upgradeCountNumBubbles[i];
             numUp[i].maxUpgradeCount = maxCount;
             makeUpgrade(numUp[i], (value + " bubbles"), yIncriment);

             numBubblesPanel.addChild(numUp[i]);
         }
    /*
     * Building the upgrade panel for the VALUE of the bubbles
     *       $           $           $    
     *    ,$$$$$,     ,$$$$$,     ,$$$$$, 
     *  ,$$$'$`$$$  ,$$$'$`$$$  ,$$$'$`$$$
     *  $$$  $   `  $$$  $   `  $$$  $   `
     *  '$$$,$      '$$$,$      '$$$,$     
     *    '$$$$,      '$$$$,      '$$$$,   
     *      '$$$$,      '$$$$,      '$$$$, 
     *       $ $$$,      $ $$$,      $ $$$,
     *   ,   $  $$$  ,   $  $$$  ,   $  $$$
     *   $$$,$.$$$'  $$$,$.$$$'  $$$,$.$$$'
     *    '$$$$$'     '$$$$$'     '$$$$$'  
     *       $           $           $
     */
    var bubbleValuePanelBG = new createjs.Shape();
    bubbleValuePanelBG.name = "panelBG";
    var bubbleValuePanelTitle = new createjs.Text ("Value of bubbles ( around: $" + (popScoreMin+popScoreMax)/2 + " )", "20px Patrick Hand", "#fff");
    bubbleValuePanelTitle.name = "bubbleValuePanelTitle";
    var bubbleValueplayBtn = new createjs.Container();

    genericBits(bubbleValuePanel, bubbleValuePanelBG, bubbleValuePanelTitle, bubbleValueplayBtn);

        /*
         * Adding the upgrade options for the VALUE of bubbles
         */
         var valueUp = [];

         makeValueUpgrades(0, 2, 100, 5);
         makeValueUpgrades(1, 10, 3000, 5);
         makeValueUpgrades(2, 100, 68000, 5);
         makeValueUpgrades(3, 1000, 1300000, 5);
         makeValueUpgrades(4, 10000, 20000000, 5);
         makeValueUpgrades(5, 100000, 273000000, 5);
         function makeValueUpgrades(i, value, cost, maxCount) {
             valueUp[i] = new createjs.Container();
             var yIncriment = theTop + (i * 55);

             valueUp[i].name = "value";
             valueUp[i].inc = i;
             valueUp[i].upgradeValue = value;
             valueUp[i].upgradeCost = cost;
             valueUp[i].upgradeCount = upgradeCountValBubbles[i];
             valueUp[i].maxUpgradeCount = maxCount;
             makeUpgrade(valueUp[i], ("+$" + value), yIncriment);

             bubbleValuePanel.addChild(valueUp[i]);
         }

    /*
     * Building the upgrade panel for the AMBIENT popping rate
     *
     *                             |      
     *                         \        /
     *                                  
     *                     '    ,gPPRg,   '                  
     *                         dP'   `Yb 
     *                   --    8)     (8   -- 
     *                         Yb     dP 
     *                     .    "8ggg8"   .
     *                                  
     *                        /         \
     *                             |      
     *
     */
    var ambientPopPanelBG = new createjs.Shape();
    ambientPopPanelBG.name = "panelBG";
    var ambientPopPanelTitle = new createjs.Text ("Ambient pop rate: " + (Math.round( ambientPop * 10) / 10) + "/sec", "20px Patrick Hand", "#fff");
    ambientPopPanelTitle.name = "ambientPopPanelTitle";
    var ambientPopplayBtn = new createjs.Container();

    genericBits(ambientPopPanel, ambientPopPanelBG, ambientPopPanelTitle, ambientPopplayBtn);

        /*
         * Adding the upgrade options for the AMBIENT of bubbles
         */
         var ambientUp = [];

         makeAmbientUpgrades(0, 0.1, 40, 50);
         makeAmbientUpgrades(1, 0.2, 400, 10);
         makeAmbientUpgrades(2, 0.5, 1600, 10);
         makeAmbientUpgrades(3, 2.5, 8000, 10);
         makeAmbientUpgrades(4, 8, 39000, 10);
         makeAmbientUpgrades(5, 16, 156000, 1);
         function makeAmbientUpgrades(i, value, cost, maxCount) {
             ambientUp[i] = new createjs.Container();
             var yIncriment = theTop + (i * 55);

             ambientUp[i].name = "ambient";
             ambientUp[i].inc = i;
             ambientUp[i].upgradeValue = value;
             ambientUp[i].upgradeCost = cost;
             ambientUp[i].upgradeCount = upgradeCountAmbtPop[i];
             ambientUp[i].maxUpgradeCount = maxCount;
             makeUpgrade(ambientUp[i], ("+" + value + "/sec"), yIncriment);

             ambientPopPanel.addChild(ambientUp[i]);
         }

    /*
     * Building the Pause panel
     *
     *        |||         |||   \         >\.
     *        |||         |||    \        >>>>>\.
     *        |||         |||     \       >>>>>>>>>\.
     *        |||         |||      \      >>>>>>>>>>>>>\.
     *        |||         |||       \     >>>>>>>>>>>>>/'
     *        |||         |||        \    >>>>>>>>>/'
     *        |||         |||         \   >>>>>/'
     *        |||         |||          \  >/'
     */

    var pausePanelBG = new createjs.Shape();
    pausePanelBG.name = "panelBG";
    var pausePanelTitle = new createjs.Text ("Take a breather!", "20px Patrick Hand", "#fff");
    pausePanelTitle.name = "pausePanelTitle";
    var pauseplayBtn = new createjs.Container();

    genericBits(pausePanel, pausePanelBG, pausePanelTitle, pauseplayBtn);

        /*
         * Adding the options for the PAUSE panel
         */
         var pauseOptions = [];

         //OPTION 1
         pauseOptions[0] = new createjs.Container();
         var yIncriment = theTop + (0 * 55);

         pauseOptions[0].name = "speed";
         pauseOptions[0].upgradeValue = 0.5;
         pauseOptions[0].upgradeCost = 40;
         pauseOptions[0].upgradeCount = 0;
         pauseOptions[0].maxUpgradeCount = 1000;
         makePauseOpt(pauseOptions[0], ("Half bubble speed"), yIncriment);

         pausePanel.addChild(pauseOptions[0]);

         //OPTION 2
         pauseOptions[1] = new createjs.Container();
         var yIncriment = theTop + (1 * 55);

         pauseOptions[1].name = "speed";
         pauseOptions[1].upgradeValue = 0.25;
         pauseOptions[1].upgradeCost = 100;
         pauseOptions[1].upgradeCount = 0;
         pauseOptions[1].maxUpgradeCount = 1000;
         makePauseOpt(pauseOptions[1], ("Quarter bubble speed"), yIncriment);

         pausePanel.addChild(pauseOptions[1]);

         //OPTION 3
         pauseOptions[2] = new createjs.Container();
         var yIncriment = theTop + (2 * 55);

         pauseOptions[2].name = "speed";
         pauseOptions[2].upgradeValue = 0.1;
         pauseOptions[2].upgradeCost = 1000;
         pauseOptions[2].upgradeCount = 0;
         pauseOptions[2].maxUpgradeCount = 1000;
         makePauseOpt(pauseOptions[2], ("1/10th bubble speed"), yIncriment);

         pausePanel.addChild(pauseOptions[2]);

         //OPTION 4
         /*
         pauseOptions[3] = new createjs.Container();
         var yIncriment = theTop + (3 * 55);

         pauseOptions[3].name = "share";
         pauseOptions[3].upgradeValue = 4;
         pauseOptions[3].upgradeCost = 0;
         pauseOptions[3].upgradeCount = 0;
         pauseOptions[3].maxUpgradeCount = 100;
         makePauseOpt(pauseOptions[3], ("Share to quadrupal your points!"), yIncriment);

         pausePanel.addChild(pauseOptions[3]);
         */

         //Pause panel extras
         var creditTextBG = new createjs.Shape;
         creditTextBG.graphics.beginFill("rgba(0,0,0,0.2)").drawRoundRect( ((canvas.width / 2) - 145), (canvas.height-220), 290, 75, cRadius);
         creditTextBG.name = "ijmccallum"
         pausePanel.addChild(creditTextBG);

         var creditText = new createjs.Text ("By\n\n Iain J McCallum", "20px Patrick Hand", "#fff");
         creditText.textAlign = "center";
         creditText.x = canvas.width / 2;
         creditText.y = canvas.height - 220;
         creditText.name = "ijmccallum";
         pausePanel.addChild(creditText);

         var resetTextBG = new createjs.Shape;
         resetTextBG.graphics.beginFill("rgba(255,0,0,0.2)").drawRoundRect( ((canvas.width / 2) - 145), (canvas.height-300), 290, 50, cRadius);
         resetTextBG.name = "reset"
         pausePanel.addChild(resetTextBG);

         var resetText = new createjs.Text ("RESET", "20px Patrick Hand", "#fff");
         resetText.textAlign = "center";
         resetText.x = canvas.width / 2;
         resetText.y = canvas.height - 290;
         resetText.name = "reset";
         pausePanel.addChild(resetText);

}

/*
 * Making the generic upgrade panels
 */
function genericBits(container, BGpanel, upTitle, playBtn) {
    //300 by 450
    var pPos1 = (canvas.width / 2) - 150; //top left x
    var pPos2 = 50; //top left y
    var pPos3 = 300; //width
    var pPos4 = canvas.height-120; //height 

    BGpanel.graphics.beginFill("rgba(0,0,0,0.5)").drawRoundRect(pPos1, pPos2, pPos3, pPos4, cRadius);

    upTitle.textAlign = "center";
    upTitle.x = canvas.width * 0.5;
    upTitle.y = 60;




    //The panel play button
    playBtn.name = "play";

    var topLeftX = (canvas.width / 2) - 145; //top left x
    var topLeftY = canvas.height-125; //top left y
    var bgWidth = 290; //width
    var bgHeight = 50; //height 
    var playBtnBG = new createjs.Shape();
    playBtnBG.graphics.beginFill("rgba(0,255,0,0.8)").drawRoundRect(topLeftX, topLeftY, bgWidth, bgHeight, cRadius);
      playBtn.addChild(playBtnBG);

    var playBtnTxt = new createjs.Text ("Play", "20px Patrick Hand", "#fff");
    playBtnTxt.textAlign = "center";
    playBtnTxt.x = canvas.width * 0.5;
    playBtnTxt.y = topLeftY + 10;
    playBtnTxt.name = "play";
      playBtn.addChild(playBtnTxt);

    container.addChild(BGpanel);
    container.addChild(upTitle);
    container.addChild(playBtn);
}

/*
 * Setting the generic upgrade options
 */
function makeUpgrade(container, title, containerY) {

    var topLeftX = (canvas.width / 2) - 145; //top left x
    var topLeftY = containerY; //top left y
    var bgWidth = 290; //width
    var bgHeight = 50; //height 
    var leftEdge = topLeftX + 10;
    var rightEdge = (canvas.width / 2) + 135;
    var textHeight = containerY + 10;

    var upgradeBG = new createjs.Shape();
    upgradeBG.graphics.beginFill("rgba(216,255,255,0.9)").drawRoundRect(topLeftX, topLeftY, bgWidth, bgHeight, cRadius);
      container.addChild(upgradeBG);

    //How many bought?
    var upgradeCountTxt = new createjs.Text("(" + container.upgradeCount + "/" + container.maxUpgradeCount + ")", "20px Patrick Hand", "#006600");
    upgradeCountTxt.textAlign = "center";
    upgradeCountTxt.x = (canvas.width / 2);
    upgradeCountTxt.y = textHeight;
    upgradeCountTxt.name = "upgradeCountTxt";
      container.addChild(upgradeCountTxt);

    //Make the title
    var upgradeTitle = new createjs.Text(title, "20px Patrick Hand", "#006600");
    upgradeTitle.textAlign = "left";
    upgradeTitle.x = leftEdge;
    upgradeTitle.y = textHeight;
      container.addChild(upgradeTitle);

    //show the cost
    var upgradeCost = new createjs.Text(("$" + container.upgradeCost), "20px Patrick Hand", "#006600");
    upgradeCost.textAlign = "right";
    upgradeCost.x = rightEdge
    upgradeCost.y = textHeight;
      container.addChild(upgradeCost);
}

function makePauseOpt(container, title, containerY){

    var topLeftX = (canvas.width / 2) - 145; //top left x
    var topLeftY = containerY; //top left y
    var bgWidth = 290; //width
    var bgHeight = 50; //height 
    var leftEdge = topLeftX + 10;
    var rightEdge = (canvas.width / 2) + 135;
    var textHeight = containerY + 10;

    var upgradeBG = new createjs.Shape();
    upgradeBG.graphics.beginFill("rgba(216,255,255,0.9)").drawRoundRect(topLeftX, topLeftY, bgWidth, bgHeight, cRadius);
      container.addChild(upgradeBG);

    // //How many bought?
    // var upgradeCountTxt = new createjs.Text("(" + container.upgradeCount + "/" + container.maxUpgradeCount + ")", "20px Patrick Hand", "#fff");
    // upgradeCountTxt.textAlign = "center";
    // upgradeCountTxt.x = (canvas.width / 2);
    // upgradeCountTxt.y = textHeight;
    // upgradeCountTxt.name = "upgradeCountTxt";
    //   container.addChild(upgradeCountTxt);

    //Make the title
    var upgradeTitle = new createjs.Text(title, "20px Patrick Hand", "#006600");
    upgradeTitle.textAlign = "left";
    upgradeTitle.x = leftEdge;
    upgradeTitle.y = textHeight;
      container.addChild(upgradeTitle);

    //show the cost
    if (title == "Share to quadrupal your points!") {

    } else {
        var upgradeCost = new createjs.Text(("$" + container.upgradeCost), "20px Patrick Hand", "#006600");
        upgradeCost.textAlign = "right";
        upgradeCost.x = rightEdge
        upgradeCost.y = textHeight;
          container.addChild(upgradeCost);
    }
}

/**
 * Create a number of targets
 */
function startGamePlay() {
    stage.addChild(bubbleContainer);

    for (var i = 0; i < bubbleRate; i ++) {
        //emitterAlive[i] = false;
        bitmap = bubbleContainer.addChild(new createjs.Shape());
        bitmap.name = "tgt" + i;
        resetTgt(bitmap, i);
        bmpList.push(bitmap);
    }

    txt = new createjs.Text ("Score", "20px Patrick Hand", "#baffac");
    txt.textBaseline="top";
    txt.text = score;
    txt.textAlign = "center";
    txt.x = canvas.width/2;
    txt.y = 20;
    stage.addChild(txt);

    createjs.Ticker.on("tick", tick);
}

/* =====================================================
 * =====================================================
 * ================  RUNNING THE GAME!  ================
 * =====================================================
 * =====================================================
 */

/**
 * The Ticker! The heart and soul of this game
 * moving the targets
 */
function tick(event) {
    if (!lonleyMessageonCanvas) { //reduces overhead when player leaves the game alone for a while

        //Slowly decrease the speed
        setSpeed("time");
        moveLightBeams();

        //Move the targets
        if (play == true) {
            var noTgts = bmpList.length;
            for (var i = 0; i < noTgts; i++) {
                var bmp = bmpList[i];
                if (bmp.y > (bmp.rndWidth * -1)) {
                    bmp.y -= bmp.speed;  
                } else {
                    score = score - Math.round(bmp.score/2);
                    resetTgt(bmp);
                }
            }
        }

        //Make the click ripples smaller
        for ( i = 0; i <clickRippleArray.length; i++) {
            var opacity = clickRippleArray[i].opacityState;
            clickRippleArray[i].alpha = opacity;
            opacity = (opacity - 0.2);
            if (opacity < 0) {
                clickRippleContainer.removeChild(clickRippleArray[i]);
                clickRippleArray.splice(i,1);
                //remove from array
            } else {
                clickRippleArray[i].opacityState = opacity;
            }
        }

        //hide the score text
        for ( i=0; i<scoreTextList.length; i++) {
            var opacity = scoreTextList[i].opacityState;
            scoreTextList[i].alpha = opacity;
            opacity = (opacity - 0.1);
            if (opacity < 0) {
                stage.removeChild(scoreTextList[i]);
                scoreTextList.splice(i,1);
            } else {
                scoreTextList[i].opacityState = opacity;
            }
        }

        if (score >= 0) {
            txt.text = "$" + score;
        } else {
            var tmpScore = (score * -1);
            txt.text = "-$" + tmpScore;
        }

        stage.update(event);

    }
}

/**
 * Creating new bubbles while the game is running
 * every time the bubble rate is increased, we must add more bubbles!
 */
function createNewBubbles(numBubblesToAdd) {
    totalBubbles = bubbleRate + numBubblesToAdd;

    /*
     * the counter is set to the bubble rate as it is used to create the bubble's name, so it can't clash with any existing bubbles
     * by counting from there to the total number of bubbles, we add the required amount of bubbles!
     */
    for (var i = bubbleRate; i < totalBubbles; i ++) {
        //emitterAlive[i] = false;
        bitmap = bubbleContainer.addChild(new createjs.Shape());
        bitmap.name = "tgt" + i;
        resetTgt(bitmap, i);
        bmpList.push(bitmap);
    }
}

/**
 * Drawing the targets (bubbles!)
 */
function resetTgt(tgt, i) {

    //If this is a bubble that escaped, show the loss of points, moa ha ha!
    if (tgt.y < (tgt.rndWidth * -1)) {
        console.log("Escapee!");
        var tempscore = Math.round(tgt.score/2);
        var scoreText = new createjs.Text(("-$" + tempscore), "40px Patrick Hand", "#cc0000");
        scoreText.x = tgt.x;
        scoreText.y = 20;
        scoreText.textAlign = "center";
        scoreText.opacityState = 1;
        stage.addChild(scoreText);
        scoreTextList.push(scoreText)
    }

  //Position
    tgt.y = canvas.height + Math.random()*500;
    tgt.x = canvas.width * Math.random()|0;

  //Apperance
    var rndWidth = Math.random() * (35 - 15) + 15;
    var rndColour = selectColour();
    tgt.graphics
      .clear()
      .beginFill(rndColour).drawCircle(0,0,(rndWidth))//body
      .beginFill("rgba(255,255,255,0.2)").drawCircle((-rndWidth/20),(-rndWidth/20),(rndWidth-(rndWidth/10)))//body light
      .beginFill("rgba(255,255,255,0.8)").drawCircle((-rndWidth/3),(-rndWidth/2),(rndWidth/8))//spec highlight
      

  //Behaviour
    tgt.rndWidth = rndWidth;
    tgt.speed = (Math.random()*speedMax)+speedMin;
    tgt.score = Math.floor((Math.random() * popScoreMax) + popScoreMin);
    tgt.alpha = 0.7;

    mvTargets[i] = tgt;
}

/**
 * A bit of fun for the aesthetics
 * some random colours to choose from :)
 */
function selectColour() {
  randomSelection = Math.floor((Math.random() * 10) + 1);
  switch (randomSelection){
    case 1 :
      return "#fefce9"; //light yellow
      break;
    case 2 :
      return "#b1737e"; //faded red
      break;
    case 3 :
      return "#ccc9d9"; //faded baby blue
      break;
    case 4 :
      return "#887769"; //green/orange fade
      break;
    case 5 :
      return "#f26460"; //peach
      break;
    case 6 :
      return "#9883a9"; //light violate
      break;
    case 7 :
      return "#7b7cb0"; //faded blue
      break;
    case 8 :
      return "#a9dcd5"; //light torquoise
      break;
    case 9 :
      return "#68566a"; //faded purple
      break;
    case 10 :
      return "#942758"; //deep pink
      break;
  }
}

/**
 * ambient pop
 *
 * Runs every [ambientPop] milliseconds
 * finds a number between 1 and [bubbleRate] (to pick a bubble)
 * checks if the selected bubble is visible (inside the canvas)
 * if it is - pop it! if not, select another one.
 *
 * Occasionally this gets a bubble that doesn't exist, probably some kind  of clash with the ticker's thread
 * to avoid any errors popping up I've sprinkled a few checks in, if the bubble it found has dissappeared it just 
 * won't even try to pop it.  A bit of random luck is alwayse a good thing when trying to hook people!
 */
function ambientPopInit(){
    ambientTimer = setInterval(ambientPoppings,(1000/ambientPop)); //  1sec / pop rate = number of millisecs between pops!
}
function ambientPoppings() {
    if (state == "playing") {
        var bubbleVisible = false;
        var rndBubbleNo, bubbleToPop;
        var bubblex, bubbley;
        var popSent = false;

        //Check all the bubbles
        for (i=0; i < bmpList.length; i++) {

            if (popSent) {
                //break;
            } else {

                //Select at random
                rndBubbleNo = Math.floor((Math.random() * bubbleRate));
                bubbleToPop = bmpList[rndBubbleNo];

                if (bubbleToPop) {

                    //Checking if the bubble is within the canvas
                    if ((bubbleToPop.y > 0) && (bubbleToPop.y < (canvas.height-40))) {
                        bubblex = bubbleToPop.x;//saving these values to pass incase the bubble disappears in the mean time
                        bubbley = bubbleToPop.y;
                        popSent = true;
                        speedMax += (0.005/ambientPop); //increase the speed very slightly for ambient poppings
                        speedMin += (0.002/ambientPop); //as the ambient pop increases, it's ability to increase speed slows (tp stop it getting out of hand)
                        popBubble(bubbleToPop, bubblex, bubbley);
                    }
                } 
            }
        }
    }
}

/**
 * Pop the bubble
 *
 * Passed a bubble to pop
 * creates an emitter (for the pop particles) the same dimensions and position as the passed bubble
 * increases the score (according the the bubble's value)
 * increaces the speed variables
 * resets the bubble
 * saves the score
 *
 * The emitter count is to try and create a different instance of the emitter so that it might play multiple simultaniously,
 * haven't had a chance to test it yet, probably won't work given the hassel this particle system has been giving me!
 */
function popBubble(bubble, x, y) {
    
    createParticlePuff(x, y, bubble.rndWidth, bubble.score);
    
    score += bubble.score;
    clicked = false;

    resetTgt(bubble);
    saveScore();
}

/**
 * The particle emitter
 *
 * 
 */

 (6.5 * 42000) / 365

var scoreTextList = [];

function createParticlePuff(x, y, rwidth, bubbleScore) {
    //Sprite sheet here
    var popClone = popAnimation.clone();

    var popRadius = (rwidth/2);
    popClone.x = x-popRadius;
    popClone.y = y-popRadius;
    popClone.regX = popRadius;
    popClone.regY = popRadius;
    popClone.rotation = -50;

    var popScale = rwidth / 20;
    popClone.scaleX = popScale;
    popClone.scaleY = popScale;

    popClone.on("animationend", function(){
        this.stop();
        stage.removeChild(this);
    });
    stage.addChild(popClone);

    var scoreText = new createjs.Text(("+$" + bubbleScore), "40px Patrick Hand", "#baffac");
    scoreText.x = x;
    scoreText.y = (y-rwidth)-20;
    scoreText.textAlign = "center";
    scoreText.opacityState = 1;
    stage.addChild(scoreText);
    scoreTextList.push(scoreText)
    //create function to remove score
    popClone.gotoAndPlay("pop");
}






var activeSpeedMax = speedMax,
    activeSpeedMin = speedMin;  //these record the speeds reached while the player was playing

/*
 *  While the player is engaged the speed increaces every time they pop a bubble
 *  if they leave the game for a while the speed decreaces slowly.
 *  when they return the speed will rapidly increase to it's original state
 */
function setSpeed(setEvent) {
    if (setEvent == "tgt") {
        
        //a bubble was clicked!
        speedMax += 0.09;
        speedMin += 0.045;
        catchUp(); // in case a long time has elapsed, if not this function won't do much

        if (speedMax > activeSpeedMax) {activeSpeedMax = speedMax;}
        if (speedMin > activeSpeedMin) {activeSpeedMin = speedMin;}
    }

    if (setEvent == "time") {
        //general slowing over time
        if (speedMax <= 0 ) {
            //speed hs hit rock bottom
            speedMax = 0;
            speedMin = 0;
            feelingLonleyMessage("add");

            //move the existing bubbles up?
        } else if (speedMin <= 0){
            //incase the minimum speed goes too low, cap it off at 0
            speedMin = 0;
            speedMax -= 0.004;
        } else {
            speedMax -= 0.004;
            speedMin -= 0.002;
        }
        
    }

    if (setEvent == "blank") {
        if (speedMax > activeSpeedMax) {activeSpeedMax = speedMax;}
        if (speedMin > activeSpeedMin) {activeSpeedMin = speedMin;}
        catchUp();
        clickRipple(stage.mouseX, stage.mouseY);
        if (vibration) navigator.vibrate(10);
    }

    /*
     * To catch up we find the difference in current speed and the old max then move half the difference
     * This will likley get called every time but will cause minimal madness unless the game ha been left alone for a long time
     */
    function catchUp() {
        feelingLonleyMessage("remove");
        //if the bubbles are all slow we need to iterare through them all and give them speed values again.

        if (speedMax == 0){
            //This means we have hit bottom, all the bubbles are likley to be stopped and so will not enter the screen when speed increaces, stalemate
            //So we set the speeds then iterate through all the existing bubbles and reset their speed!
            noLower();
        }
        if (activeSpeedMax < 2 || activeSpeedMin < 1) {
            noLower();
        }
        if (speedMax < activeSpeedMax) {
            speedMax += (activeSpeedMax - speedMax)/2;
            speedMin += (activeSpeedMin - speedMin)/2;
        }
        function noLower() {
            activeSpeedMax = 2;
            activeSpeedMin = 1;
            speedMax = activeSpeedMax * 0.75;
            speedMin = activeSpeedMin * 0.75;
            for (var i = 0; i < bmpList.length; i++) {
                bmpList[i].speed = (Math.random()*speedMax)+speedMin;
            }
        }
    }
}

var lonleyMessage;
lonleyMessageonCanvas = false;
function feelingLonleyMessage(action) {
    if (action == "add" && !lonleyMessageonCanvas) {
        lonleyMessage = new createjs.Text("Feeling lonley :(\n\n", "20px Patrick Hand", "#fff");
        lonleyMessage.text += "Tap me to wake up the bubbles";
        lonleyMessage.textAlign = "center";
        lonleyMessage.x = canvas.width / 2;
        lonleyMessage.y = canvas.height / 3;
        lonleyMessageonCanvas = true;
        removePanels();
        stage.addChild(lonleyMessage);
        stage.update();
        
    } else if (action == "remove" && lonleyMessageonCanvas) {
        stage.removeChild(lonleyMessage);
        lonleyMessageonCanvas = false;
        stage.update();
    }
}

/* =====================================================
 * =====================================================
 * ==============  CLICKING MY BUTTONS!  ===============
 * =====================================================
 * =====================================================
 */


function handleClick() {
    canvas.onClick = null;
    mouseTarget = null;
    isClickHandeled = false;
    /*
     * For dev, when state is start then we're on the start screen, time to begin the game!
     */

    if (state =="start") {
      stage.removeChild(startTxt);
      makeUpgradeBar();
      startGamePlay();
      play = true;
      state = "playing";
      ambientPopInit();
      stage.addChild(clickRippleContainer);
      isClickHandeled = true;
    }

    /*
     * Dealing with the object that was clicked
     */

    if (stage.mouseX && stage.mouseY) {

        //the click was on the canvas, time to investigate

        if (stage.mouseY > (canvas.height - 40)) {
            //Click was on the menu bar!  Now, which button:
            var fifthWidth = canvas.width / 5; //the spacing of the buttons
            if ( (stage.mouseX>(fifthWidth - 20)) && (stage.mouseX<(fifthWidth + 20)) ) {
                //number of bubbles
                handlePanelBtn(numBubblesPanel);
                isClickHandeled = true;

            } else if ( (stage.mouseX>((fifthWidth*2) - 20)) && (stage.mouseX<((fifthWidth*2) + 20)) ){
                //value of bubbles
                handlePanelBtn(bubbleValuePanel);
                isClickHandeled = true;

            } else if ( (stage.mouseX>((fifthWidth*3) - 20)) && (stage.mouseX<((fifthWidth*3) + 20)) ){
                //pop rate
                handlePanelBtn(ambientPopPanel);
                isClickHandeled = true;

            } else if ( (stage.mouseX>((fifthWidth*4) - 20)) && (stage.mouseX<((fifthWidth*4) + 20)) ){
                //bubble speed
                handlePanelBtn(pausePanel);
                isClickHandeled = true;

            } 
         } else {
            //wasn't anything on the menu bar, give mouse target a thing so the rest of the check can happen
            mouseTarget = stage.getObjectUnderPoint(stage.mouseX, stage.mouseY);
            if (!mouseTarget) { mouseTarget = stage.getObjectUnderPoint(stage.mouseX, stage.mouseY - 40); } //compensate for fast bubbles going up
            if (!mouseTarget) { mouseTarget = stage.getObjectUnderPoint(stage.mouseX + 20, stage.mouseY); }
            if (!mouseTarget) { mouseTarget = stage.getObjectUnderPoint(stage.mouseX - 20, stage.mouseY); }
            if (!mouseTarget) { mouseTarget = stage.getObjectUnderPoint(stage.mouseX, stage.mouseY + 20); }
        }

        if (mouseTarget) {

            var tempTxt = String(mouseTarget.name);
            tgtCheck = tempTxt.substring(0,3);

            if (tgtCheck!=null && tgtCheck=='tgt' && state=='playing') {
                // The game is playing & the object clicked was a bubble, time to pop it!
                setSpeed('tgt');
                isClickHandeled = true;
                popBubble(mouseTarget, mouseTarget.x, mouseTarget.y);

            } else if (mouseTarget.name == "lightbeam"){
                setSpeed("blank");
                removePanels();
                playGame();
            } else if (mouseTarget.name == "ijmccallum") {
                window.open("http://iainjmccallum.com/",'_system');
            } else if (mouseTarget.name == "reset") {
                var resetQ = confirm("Really, start again?");
                if (resetQ == true) {
                    console.log("reset scores and stuff");
                    upgradeCountNumBubbles = [0, 0, 0, 0, 0, 0],
                    upgradeCountValBubbles = [0, 0, 0, 0, 0, 0],
                    upgradeCountAmbtPop = [0, 0, 0, 0, 0, 0];
                    score = 0,
                    speedMin = 2,
                    speedMax = 4,
                    popScoreMin = 1,
                    popScoreMax = 1,
                    ambientPop = 0.1,
                    bubbleRate = 10;
                    saveScore();
                    location.reload();
                }
            } else if (mouseTarget.parent) {
                //So it's not a bubble, the panel or a light beam everything else that's clickable has a named parent, lets see who was clicked

                var clickedName = mouseTarget.parent.name;

                if (clickedName == "number" || clickedName == "value" || clickedName == "ambient" || clickedName == "speed" || clickedName == "share"){
                    //The player has decided they actually want an upgrade!!
                    handleUpgrade(mouseTarget.parent);

                } else if (mouseTarget.parent.name == "play") {
                    //Yep, so they want to play the game now. Fine.
                    removePanels();
                    playGame();

                } else if (tgtCheck!=null && tgtCheck=='tgt' && state=='pause') {
                    //I think they clicked a bubble when the game was paused... yikes! Better start the game again!
                    setSpeed('blank');
                    removePanels();
                    playGame();

                } else {
                    //They clicked something but it doesn't have a name... hmm, probably a gap between buttons
                    setSpeed('blank');
                }
            }
        } else if(!isClickHandeled) {
          //It appears nothing was clicked - I think that means the blank canvas was clicked.  Lets play!
          removePanels();
          playGame();
          setSpeed('blank');
        }

        
    }
}

function handlePanelBtn(panel) {
    if (panel.active) {
        removePanels();
        playGame();
    } else {
        removePanels();
        stage.addChild(panel);
        panel.active = true;
        pause();
    }
}


function clickRipple(x,y) {
    var clickRipple = new createjs.Shape();
    clickRipple.graphics.beginFill("rgba(255,255,255,0.2)").drawCircle(x,y,rippleWidth);
    clickRipple.name = "clickRipple";
    clickRipple.opacityState = 0.75;
    clickRippleContainer.addChild(clickRipple);
    clickRippleArray.push(clickRipple); //Keeping a list of all the cilckRipples
}

/* =====================================================
 * =====================================================
 * ==============  UPGRADING MY BUBBLES!  ==============
 * =====================================================
 * =====================================================
 */
function handleUpgrade(upgrade) {

    if (score < upgrade.upgradeCost) {
        console.log("Google wallet, here we go!");
        alert("Hello google wallet!");
    } else {
        //they have enough points, now is the upgrade maxed out?

        if (upgrade.name == "number") {

            if (upgrade.upgradeCount >= upgrade.maxUpgradeCount) {
                console.log("Hello google wallet again!")
                alert("Hello google wallet!");
            } else {
                /*
                 * The bubble rate upgrade
                 * Difficult one - it adds the specified number of bubbles but the computer can only handle so many
                 * This needs to be an expensive one or the bubbles need to be made simpler when the numbers increace.
                 */
                createNewBubbles(upgrade.upgradeValue);
                bubbleRate = bubbleRate + upgrade.upgradeValue;
                upgrade.upgradeCount ++;
                upgradeCountNumBubbles[upgrade.inc] = upgrade.upgradeCount; //applying the upgrade count to the array to be saved
                upgrade.getChildByName("upgradeCountTxt").text = "(" + upgrade.upgradeCount + "/" + upgrade.maxUpgradeCount + ")";
                numBubblesPanel.getChildByName("numBubblesPanelTitle").text = "Number of bubbles: " + bubbleRate;
                score = score - upgrade.upgradeCost;
                console.log("Bubble rate: " + bubbleRate);
            }

        } else if (upgrade.name == "value") {

            if (upgrade.upgradeCount >= upgrade.maxUpgradeCount) {
                console.log("Hello google wallet again!")
                alert("Hello google wallet!");
            } else {
                /*
                 * The value upgrade
                 * Increases the mamximum possible value by the amount specified
                 * also increases the minimum amount possible by 1/2 the amount specified
                 */
                popScoreMin = Math.round(popScoreMax + (upgrade.upgradeValue/2));
                popScoreMax = popScoreMax + upgrade.upgradeValue;
                upgrade.upgradeCount ++;
                upgradeCountValBubbles[upgrade.inc] = upgrade.upgradeCount; //applying the upgrade count to the array to be saved
                upgrade.getChildByName("upgradeCountTxt").text = "(" + upgrade.upgradeCount + "/" + upgrade.maxUpgradeCount + ")";
                bubbleValuePanel.getChildByName("bubbleValuePanelTitle").text = "Value of bubbles: " + popScoreMin + " ~ " + popScoreMax;
                score = score - upgrade.upgradeCost;
                console.log("Upgraded value, max: " + popScoreMax + " | min : " + popScoreMin);
            }

        } else if (upgrade.name == "ambient") {

            if (upgrade.upgradeCount >= upgrade.maxUpgradeCount) {
                console.log("Hello google wallet again!")
                alert("Hello google wallet!");
            } else {
                /*
                 * The ambient upgrade
                 * at the moment it only increases the pop rate by 1/10th
                 * values passed: 
                 *    0.1 - to increace by 0.1/sec (-100) * 1000
                 *    0.2 - to increace by 0.2/sec
                 *    0.5/sec
                 *    1/sec
                 *    
                 *  rate = 0.1/sec  sec/value = popTime
                 *  rate = 1/sec 
                 *  rate = 2/sec
                 */
                ambientPop = ambientPop + upgrade.upgradeValue;
                upgrade.upgradeCount ++;
                upgradeCountAmbtPop[upgrade.inc] = upgrade.upgradeCount; //applying the upgrade count to the array to be saved
                upgrade.getChildByName("upgradeCountTxt").text = "(" + upgrade.upgradeCount + "/" + upgrade.maxUpgradeCount + ")";
                ambientPopPanel.getChildByName("ambientPopPanelTitle").text = "Ambient pop rate: " + (Math.round( ambientPop * 10) / 10) + "/sec";
                score = score - upgrade.upgradeCost;
                clearInterval(ambientTimer);
                ambientTimer = setInterval(ambientPoppings, 1000/ambientPop);
                console.log("Ambient pop rate: " + ambientPop);
            }
        } else if (upgrade.name == "speed") {
            /*
             * The Speed upgrade
             * Decreaces the speed of the bubbles
             *    speedMin
             *    speedMax
             */
            speedMin = Math.round(speedMin * upgrade.upgradeValue);
            speedMax = Math.round(speedMax * upgrade.upgradeValue);
            activeSpeedMax = speedMax;
            activeSpeedMin = speedMin;
            upgrade.upgradeCount ++;

            //Decrease existing bubbles
            for (var i = 0; i < noTgts; i++) {
                var bmp = bmpList[i];
                bmp.speed = Math.round(bmp.speed * upgrade.upgradeValue);
            }

            //upgrade.getChildByName("upgradeCountTxt").text = "(" + upgrade.upgradeCount + "/" + upgrade.maxUpgradeCount + ")";
            //bubbleValuePanel.getChildByName("bubbleValuePanelTitle").text = "Value of bubbles: " + popScoreMin + " ~ " + popScoreMax;
            score = score - upgrade.upgradeCost;
            console.log("Upgraded speed, max: " + speedMax + " | min : " + speedMin);

        } else if (upgrade.name == "share") {
            /*
             * If they tweet / or otherwise post about it they will quadrupal their points
             */
             console.log("Share code");

             score = score * 4;
        }
    }
    saveScore();
    stage.update();
}

/* =====================================================
 * =====================================================
 * ===================  THE SCREENS  ===================
 * =====================================================
 * =====================================================
 */

function startScreen() {

  state = "start";
  startTxt = new createjs.Text("BUBBLES!\n\n", "18px Patrick Hand", "#fff");

  var welcomeMsg = Math.floor((Math.random() * 10) + 1);
  switch(welcomeMsg) {
    case 1:
        startTxt.text += "To overcome the bubbles\n\n";
        startTxt.text += "You must become the bubbles\n\n";
        break;
    case 2:
        startTxt.text += "These are not the bubbles \n\nyou need, to deserve... to need\n\n";
        startTxt.text += "These are the deservers that\n\n bubbles need...to bubble.\n\n";
        break;
    case 3:
        startTxt.text += "Bubble by bubble,\n\n";
        startTxt.text += "pop goes the weasel.\n\n";
        break;
    case 4:
        startTxt.text += "Better to have popped a bubble,\n\n";
        startTxt.text += "than to never have popped at all.\n\n";
        break;
    case 5:
        startTxt.text += "Popping bubbles is human,\n\n";
        startTxt.text += "Popping all the bubbles... divine.\n\n";
        break;
    case 6:
        startTxt.text += "A bubble under the thumb,\n\n";
        startTxt.text += "Is worth two on the run.\n\n";
        break;
    case 7:
        startTxt.text += "Whether you think\n\n you can pop,\n\n";
        startTxt.text += "or think you can not\n\n – you are right.\n\n";
        break;
    case 8:
        startTxt.text += "A bubble popped,\n\n";
        startTxt.text += "is a bubble earned.\n\n";
        break;
    case 9:
        startTxt.text += "Insanity:\n\n doing the same thing\n\n over and over again\n\n";
        startTxt.text += "and expecting\n\n different results.\n\n";
        break;
    case 10:
        startTxt.text += "Ask not\n\n what your bubbles\n\n can do for you;\n\n";
        startTxt.text += "ask what you can do\n\n for your bubbles.\n\n";
        break;
    default:
        break;
}
  startTxt.text += "Click to play!";
  startTxt.textAlign = "center";
  startTxt.x = canvas.width / 2;
  startTxt.y = canvas.height / 3;
  stage.addChild(startTxt);
  stage.update();
  //canvas.onclick = handleClick("gameStart");
}

function removePanels() {
  numBubblesPanel.active = false;
  bubbleValuePanel.active = false;
  ambientPopPanel.active = false;
  pausePanel.active = false;
  if (stage.contains(numBubblesPanel)) {
      stage.removeChild(numBubblesPanel);
  }
  if (stage.contains(bubbleValuePanel)) {
      stage.removeChild(bubbleValuePanel);
  }
  if (stage.contains(ambientPopPanel)) {
      stage.removeChild(ambientPopPanel);
  }
  if (stage.contains(pausePanel)) {
      stage.removeChild(pausePanel);
  }
}

function pause() {
  play = false;
  state = "pause";
  clearInterval(ambientTimer);
}

function playGame() {
  play = true;
  state = "playing";
  clearInterval(ambientTimer);
  ambientTimer = setInterval(ambientPoppings, 1000/ambientPop);
}


function saveScore() {
  if(typeof(Storage)!=="undefined") {
    localStorage.setItem("score", score);
    localStorage.setItem("speedMin", speedMin);
    localStorage.setItem("speedMax", speedMax);
    localStorage.setItem("popScoreMin", popScoreMin);
    localStorage.setItem("popScoreMax", popScoreMax);
    localStorage.setItem("ambientPop", ambientPop);
    localStorage.setItem("bubbleRate", bubbleRate);

    localStorage.setItem("upgradeCountNumBubbles", upgradeCountNumBubbles);
    localStorage.setItem("upgradeCountValBubbles", upgradeCountValBubbles);
    localStorage.setItem("upgradeCountAmbtPop", upgradeCountAmbtPop);

    upgradeCountAmbtPop
  } else {
    console.log("No local storage available, can't save score :(");
        //alert("No storage available :(");
  }
}
