
//Gameplay variables
var score = 0,
    speedMin = 2,
    speedMax = 4,
    popScoreMin = 1,
    popScoreMax = 1,      //<< this cab be increased, needs a panel
    ambientPop = 0.1,   //<< this cab be increased, needs a panel
    bubbleRate = 10;       //<< this cab be increased, needs a panel
var ambientTimer; //the setInterval function for ambient popping!
var clickRippleContainer, //The container for each click ripple to be added.
    totalClickRipples, //The number of current click ripples
    rippleWidth = 10, //the width of the clickRipples
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
var particleImage;
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
    //particleImage.onload = initCanvas;
    particleImage.src = "img/particle_base.png";

//Might have to move this into the handle click for the start screen, 
//otherwise there's a tiny chance it'll load in time to be put on the canvas with the update :O
    iconSheet.onload = handleiconSheetLoad;
    iconSheet.src = "img/bubbleIcons.png";
    

    //todo: get top score from memory.
    // if (typeof(Storage)!=="undefined") {
    //   score = Number(localStorage.getItem("score"));
    //   speedMin = Number(localStorage.getItem("speedMin"));
    //   speedMax = Number(localStorage.getItem("speedMax"));
    //   popScoreMin = Number(localStorage.getItem("popScoreMin"));
    //   popScoreMax = Number(localStorage.getItem("popScoreMax"));
    //   ambientPop = Number(localStorage.getItem("ambientPop"));
    //   bubbleRate = Number(localStorage.getItem("bubbleRate"));
    //   console.log("Local storage available, updating gameplay variables");
    // } else {
    //   console.log("No saved values found, gameplay variables set to baseline");
    // }

    console.log("score " + score);
    console.log("speed Min: " + speedMin + " | Max: " + speedMax);
    console.log("Value Min: " + popScoreMin + " | Max: " + popScoreMax);
    console.log("ambientPop " + ambientPop);
    console.log("bubbleRate " + bubbleRate);
    setTimeout(startScreen, 500);

    //canvas.onmousedown = handleClick;
    //canvas.addEventListener('touchstart', handleClick, false);
    //canvas.addEventListener('touchmove', handleClick, false);
    canvas.addEventListener('click', handleClick, false);
    //canvas.addEventListener('onmousedown', handleClick, false);

}

function handleiconSheetLoad() {
    console.log("Hello - icon sprite is loaded :)");
    // define sprite sheet data describing the available icons:
    // we can use the form {frameName:frameNumber} in animations because each "sequence" is only a single frame:
    var data = {
        images:[iconSheet],
        frames:{width:40, height:40},
        animations: {numberIcon:0, valueIcon:1, ambientIcon:2, lightningIcon:3}
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
    var numBubblesPanelTitle = new createjs.Text ("Number of bubbles: " + bubbleRate, "20px Patrick Hand", "#fff");
    numBubblesPanelTitle.name = "numBubblesPanelTitle";
    var numBubblesplayBtn = new createjs.Container();

    genericBits(numBubblesPanel, numBubblesPanelBG, numBubblesPanelTitle, numBubblesplayBtn);

        /*
         * Adding the upgrade options for the NUMBER of bubbles
         */
         var numUp = [];

         makeNumberUpgrades(0, 1, 10, 50);
         makeNumberUpgrades(1, 5, 100, 10);
         makeNumberUpgrades(2, 10, 1000, 5);
         makeNumberUpgrades(3, 50, 10000, 5);
         makeNumberUpgrades(4, 500, 100000, 5);
         makeNumberUpgrades(5, 1000, 1000000, 1);
         function makeNumberUpgrades(i, value, cost, maxCount) {

             numUp[i] = new createjs.Container();
             var yIncriment = theTop + (i * 55);

             numUp[i].name = "number";
             numUp[i].upgradeValue = value;
             numUp[i].upgradeCost = cost;
             numUp[i].upgradeCount = 0;
             numUp[i].maxUpgradeCount = maxCount;
             makeUpgrade(numUp[i], ("add " + value), yIncriment);

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
    var bubbleValuePanelTitle = new createjs.Text ("Value of bubbles: " + popScoreMin + " ~ " + popScoreMax, "20px Patrick Hand", "#fff");
    bubbleValuePanelTitle.name = "bubbleValuePanelTitle";
    var bubbleValueplayBtn = new createjs.Container();

    genericBits(bubbleValuePanel, bubbleValuePanelBG, bubbleValuePanelTitle, bubbleValueplayBtn);

        /*
         * Adding the upgrade options for the VALUE of bubbles
         */
         var valueUp = [];

         makeValueUpgrades(0, 1, 10, 5);
         makeValueUpgrades(1, 2, 100, 5);
         makeValueUpgrades(2, 5, 100, 5);
         makeValueUpgrades(3, 10, 500, 5);
         makeValueUpgrades(4, 20, 5000, 5);
         makeValueUpgrades(5, 50, 100000, 1);
         function makeValueUpgrades(i, value, cost, maxCount) {
             valueUp[i] = new createjs.Container();
             var yIncriment = theTop + (i * 55);

             valueUp[i].name = "value";
             valueUp[i].upgradeValue = value;
             valueUp[i].upgradeCost = cost;
             valueUp[i].upgradeCount = 0;
             valueUp[i].maxUpgradeCount = maxCount;
             makeUpgrade(valueUp[i], ("+~" + value + "/bubble"), yIncriment);

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
    var ambientPopPanelTitle = new createjs.Text ("Ambient pop rate: " + ambientPop + "/sec", "20px Patrick Hand", "#fff");
    ambientPopPanelTitle.name = "ambientPopPanelTitle";
    var ambientPopplayBtn = new createjs.Container();

    genericBits(ambientPopPanel, ambientPopPanelBG, ambientPopPanelTitle, ambientPopplayBtn);

        /*
         * Adding the upgrade options for the AMBIENT of bubbles
         */
         var ambientUp = [];

         makeAmbientUpgrades(0, 0.1, 10, 50);
         makeAmbientUpgrades(1, 0.2, 100, 10);
         makeAmbientUpgrades(2, 0.5, 50, 10);
         makeAmbientUpgrades(3, 1, 100, 10);
         makeAmbientUpgrades(4, 5, 500, 5);
         makeAmbientUpgrades(5, 100, 10000, 1);
         function makeAmbientUpgrades(i, value, cost, maxCount) {
             ambientUp[i] = new createjs.Container();
             var yIncriment = theTop + (i * 55);

             ambientUp[i].name = "ambient";
             ambientUp[i].upgradeValue = value;
             ambientUp[i].upgradeCost = cost;
             ambientUp[i].upgradeCount = 0;
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
         pauseOptions[3] = new createjs.Container();
         var yIncriment = theTop + (3 * 55);

         pauseOptions[3].name = "share";
         pauseOptions[3].upgradeValue = 4;
         pauseOptions[3].upgradeCost = 0;
         pauseOptions[3].upgradeCount = 0;
         pauseOptions[3].maxUpgradeCount = 100;
         makePauseOpt(pauseOptions[3], ("Share to quadrupal your points!"), yIncriment);

         pausePanel.addChild(pauseOptions[3]);


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

    BGpanel.graphics.beginFill("rgba(0,0,0,0.8)").drawRoundRect(pPos1, pPos2, pPos3, pPos4, cRadius);

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
    upgradeBG.graphics.beginFill("rgba(255,255,255,0.8)").drawRoundRect(topLeftX, topLeftY, bgWidth, bgHeight, cRadius);
      container.addChild(upgradeBG);

    //How many bought?
    var upgradeCountTxt = new createjs.Text("(" + container.upgradeCount + "/" + container.maxUpgradeCount + ")", "20px Patrick Hand", "#fff");
    upgradeCountTxt.textAlign = "center";
    upgradeCountTxt.x = (canvas.width / 2);
    upgradeCountTxt.y = textHeight;
    upgradeCountTxt.name = "upgradeCountTxt";
      container.addChild(upgradeCountTxt);

    //Make the title
    var upgradeTitle = new createjs.Text(title, "20px Patrick Hand", "#fff");
    upgradeTitle.textAlign = "left";
    upgradeTitle.x = leftEdge;
    upgradeTitle.y = textHeight;
      container.addChild(upgradeTitle);

    //show the cost
    var upgradeCost = new createjs.Text(container.upgradeCost, "20px Patrick Hand", "#fff");
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
    upgradeBG.graphics.beginFill("rgba(255,255,255,0.8)").drawRoundRect(topLeftX, topLeftY, bgWidth, bgHeight, cRadius);
      container.addChild(upgradeBG);

    // //How many bought?
    // var upgradeCountTxt = new createjs.Text("(" + container.upgradeCount + "/" + container.maxUpgradeCount + ")", "20px Patrick Hand", "#fff");
    // upgradeCountTxt.textAlign = "center";
    // upgradeCountTxt.x = (canvas.width / 2);
    // upgradeCountTxt.y = textHeight;
    // upgradeCountTxt.name = "upgradeCountTxt";
    //   container.addChild(upgradeCountTxt);

    //Make the title
    var upgradeTitle = new createjs.Text(title, "20px Patrick Hand", "#fff");
    upgradeTitle.textAlign = "left";
    upgradeTitle.x = leftEdge;
    upgradeTitle.y = textHeight;
      container.addChild(upgradeTitle);

    //show the cost
    if (title == "Share to quadrupal your points!") {

    } else {
        var upgradeCost = new createjs.Text(container.upgradeCost, "20px Patrick Hand", "#fff");
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
        emitterAlive[i] = false;
        bitmap = bubbleContainer.addChild(new createjs.Shape());
        bitmap.name = "tgt" + i;
        resetTgt(bitmap, i);
        bmpList.push(bitmap);
    }

    txt = new createjs.Text ("Score", "20px Patrick Hand", "#fff");
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

    //Slowly decrease the speed
    setSpeed("time");

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
                //console.log("%cOne escaped!", "color:green;");
            }
        }
    }

    //Make the click ripples smaller
    for ( i = 0; i <clickRippleArray.length; i++) {
        var opacity = clickRippleArray[i].opacityState;
        clickRippleArray[i].alpha = opacity;
        opacity = (opacity - 0.02);
        if (opacity < 0) {
            clickRippleContainer.removeChild(clickRippleArray[i]);
            clickRippleArray.splice(i,1);
            //console.log("Array length: " + clickRippleArray.length);
            //remove from array
        } else {
            clickRippleArray[i].opacityState = opacity;
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
        emitterAlive[i] = false;
        bitmap = bubbleContainer.addChild(new createjs.Shape());
        bitmap.name = "tgt" + i;
        resetTgt(bitmap, i);
        bmpList.push(bitmap);
    }
}

/**
 * Drawing the targets (bubbles!)
 * Every time a target is reset (hit) it is redrawn with an extra circle, so they get more and more cpmplex!
 */
function resetTgt(tgt, i) {
  //Position
    tgt.y = canvas.height + Math.random()*500;
    tgt.x = canvas.width * Math.random()|0;

  //Apperance
    var rndWidth = Math.random() * (35 - 15) + 15;
    var rndColour = selectColour();
    tgt.graphics
      .clear()
      //.beginFill("rgba(0,0,0,0.1)").drawCircle((rndWidth/10),(rndWidth/8),(rndWidth*1.01)) //3 dark circles to create a shadow
      //.beginFill("rgba(0,0,0,0.1)").drawCircle((rndWidth/10),(rndWidth/8),(rndWidth*1.1))
      //.beginFill("rgba(0,0,0,0.1)").drawCircle((rndWidth/10),(rndWidth/8),(rndWidth*1.2))
      //.beginFill("white").drawCircle(0,0,rndWidth)//outline
      .beginFill(rndColour).drawCircle(0,0,(rndWidth))//body
      .beginFill("rgba(255,255,255,0.2)").drawCircle((-rndWidth/20),(-rndWidth/20),(rndWidth-(rndWidth/10)))//body light
      .beginFill("rgba(255,255,255,0.8)").drawCircle((-rndWidth/3),(-rndWidth/2),(rndWidth/8))//spec highlight
      

  //Behaviour
    tgt.rndWidth = rndWidth;
    tgt.speed = (Math.random()*speedMax)+speedMin;
    tgt.score = Math.floor((Math.random() * popScoreMax) + popScoreMin);
    //tgtBlurFilter[i] = new createjs.BlurFilter((tgt.speed/2), 0, 1);
    //tgtBlurFilter[i+1] = new createjs.BlurFilter(1, 1, 1);
    tgt.alpha = 0.7;

  //Funky filters
    //tgt.filters = [tgtBlurFilter[i], tgtBlurFilter[i+1]];
    //var bounds = tgtBlurFilter[i].getBounds();
    //tgt.cache(-50+bounds.x, -50+bounds.y, 100+bounds.width, 100+bounds.height);
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
                    //console.log("now?");

                    //Checking if the bubble is within the canvas
                    if ((bubbleToPop.y > 0) && (bubbleToPop.y < (canvas.height-40))) {
                        bubblex = bubbleToPop.x;//saving these values to pass incase the bubble disappears in the mean time
                        bubbley = bubbleToPop.y;
                        popSent = true;
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
    if (vibration) navigator.vibrate(10);
    emitter[emitterCount] = new createjs.ParticleEmitter(particleImage);
    puff[emitterCount] = createParticlePuff(emitter[emitterCount], bubble.rndWidth);
    emitter[emitterCount].position = new createjs.Point(x, y);
    emitterAlive[emitterCount] = "on";
    stage.addChild(emitter[emitterCount]);
    score += bubble.score;
    clicked = false;

    resetTgt(bubble);
    //console.log("Pop!");
    saveScore();
    emitterCount ++;
}

/**
 * The particle emitter
 *
 * This defines the many settings for an emitter that gets passed.  At the moment it doesn't create it's own emitter 
 * in an attempt to try and get more than one instance running simultaniously,
 * haven't been having much luck with that but this seems to be working well enough .
 */

function createParticlePuff(emitter, rwidth) {
  //emitter.emitterType = createjs.ParticleEmitterType.OneShot;
  //var emitter = new createjs.ParticleEmitter(REPLACE_WITH_IMAGE_VARIABLE);
  emitter.emitterType = createjs.ParticleEmitterType.OneShot;
  emitter.emissionRate = rwidth/4;
  emitter.maxParticles = rwidth/4;
  emitter.life = 300;
  emitter.lifeVar = 100;
  emitter.speed = 150;
  emitter.speedVar = 50;
  emitter.positionVarX = rwidth;
  emitter.positionVarY = rwidth;
  emitter.accelerationX = 0;
  emitter.accelerationY = 2000;
  emitter.radialAcceleration = 0;
  emitter.radialAccelerationVar = 0;
  emitter.tangentalAcceleration = 0;
  emitter.tangentalAccelerationVar = 0;
  emitter.angle = 0;
  emitter.angleVar = 360;
  emitter.startSpin = 0;
  emitter.startSpinVar = 0;
  emitter.endSpin = null;
  emitter.endSpinVar = null;
  emitter.startColor = [255, 255, 255];
  emitter.startColorVar = [0, 0, 0];
  emitter.startOpacity = 1;
  emitter.endColor = null;
  emitter.endColorVar = null;
  emitter.endOpacity = null;
  emitter.startSize = 5;
  emitter.startSizeVar = 2;
  emitter.endSize = 0;
  emitter.endSizeVar = null;
  //return emitter;
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
        speedMax += 0.1;
        speedMin += 0.01;
        catchUp(); // in case a long time has elapsed, if not this function won't do much

        if (speedMax > activeSpeedMax) {activeSpeedMax = speedMax; console.log("Setting active max")}
        if (speedMin > activeSpeedMin) {activeSpeedMin = speedMin;}
        //console.log("Speed: " + speedMax);

        //console.log("tgt speed: " + speedMax);
    }

    if (setEvent == "time") {
        //console.log("reducing speed over time");
        //general slowing over time
        if (speedMax <= 0 ) {
            //speed hs hit rock bottom
            speedMax = 0;
            speedMin = 0;

            //move the existing bubbles up?
        } else {
            speedMax -= 0.002;
            speedMin -= 0.0002;
        }
        
        //console.log("Speed: " + speedMax + " | " + speedMin);
    }

    if (setEvent == "blank") {
        if (speedMax > activeSpeedMax) {activeSpeedMax = speedMax;}
        if (speedMin > activeSpeedMin) {activeSpeedMin = speedMin;}
        catchUp();
        //console.log("Blank speed: " + speedMax);
    }

    /*
     * To catch up we find the difference in current speed and the old max then move half the difference
     * This will likley get called every time but will cause minimal madness unless the game ha been left alone for a long time
     */
    function catchUp() {
        console.log("Catch up!" + speedMax + " | " + activeSpeedMax);
        //if the bubbles are all slow we need to iterare through them all and give them speed values again.
        if (speedMax == 0){
            //This means we have hit bottom, all the bubbles are likley to be stopped and so will not enter the screen when speed increaces, stalemate
            //So we set the speeds then iterate through all the existing bubbles and reset their speed!
            speedMax = activeSpeedMax * 0.75;
            speedMin = activeSpeedMin * 0.75;
            for (var i = 0; i < bmpList.length; i++) {
                bmpList[i].speed = (Math.random()*speedMax)+speedMin;
            }
        }
        if (speedMax < activeSpeedMax) {
            speedMax += (activeSpeedMax - speedMax)/2;
            speedMin += (activeSpeedMin - speedMin)/2;
        }
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
    }

    /*
     * Dealing with the object that was clicked
     */

    if (stage.mouseX && stage.mouseY) {

        //the click was on the canvas, time to investigate

        mouseTarget = stage.getObjectUnderPoint(stage.mouseX, stage.mouseY);
        if (!mouseTarget) { mouseTarget = stage.getObjectUnderPoint(stage.mouseX, stage.mouseY - 40); } //compensate for fast bubbles going up
        if (!mouseTarget) { mouseTarget = stage.getObjectUnderPoint(stage.mouseX + 20, stage.mouseY); }
        if (!mouseTarget) { mouseTarget = stage.getObjectUnderPoint(stage.mouseX - 20, stage.mouseY); }
        if (!mouseTarget) { mouseTarget = stage.getObjectUnderPoint(stage.mouseX, stage.mouseY + 20); }



        if (mouseTarget) {
            //Something in the canvas was indeed clicked!  Lets see what it was
            //console.log("Clicked: " + mouseTarget);

            var tempTxt = String(mouseTarget.name);
            tgtCheck = tempTxt.substring(0,3);

            if (tgtCheck!=null && tgtCheck=='tgt' && state=='playing') {
                // The game is playing & the object clicked was a bubble, time to pop it!
                setSpeed('tgt');
                
                popBubble(mouseTarget);

            } else if (mouseTarget.parent) {
                //So it's not a bubble, everything else that's clickable has a named parent, lets see who was clicked

                var clickedName = mouseTarget.parent.name;

                if (clickedName == 'Number of bubbles' && numBubblesPanel.active == false) {
                    // The player wants to find out about increasing the number of bubbles!
                    removePanels();
                    stage.addChild(numBubblesPanel);
                    numBubblesPanel.active = true;
                    pause();

                } else if (clickedName == 'Number of bubbles' && numBubblesPanel.active == true) {
                    //This panel is already open, play the game!
                    removePanels();
                    playGame();

                } else if (clickedName == 'Value of bubbles' && bubbleValuePanel.active == false) {
                    // The player wants to find out about increasing the value of the bubbles!
                    removePanels();
                    stage.addChild(bubbleValuePanel);
                    bubbleValuePanel.active = true;
                    pause();

                } else if (clickedName == 'Value of bubbles' && bubbleValuePanel.active == true) {
                    //This panel is already open, play the game!
                    removePanels();
                    playGame();

                } else if (clickedName == 'Ambient pop rate' && ambientPopPanel.active == false) {
                    // The player wants to find out about increacing the ambient pop rate!
                    removePanels();
                    stage.addChild(ambientPopPanel);
                    ambientPopPanel.active = true;
                    pause();

                } else if (clickedName == 'Ambient pop rate' && ambientPopPanel.active == true) {
                    // The player wants to find out about increacing the ambient pop rate!
                    removePanels();
                    playGame();




                } else if (clickedName == 'Speed' && pausePanel.active == false) {
                    // The player wants to find out about increacing the ambient pop rate!
                    removePanels();
                    stage.addChild(pausePanel);
                    pausePanel.active = true;
                    pause();

                } else if (clickedName == 'Speed' && pausePanel.active == true) {
                    // The player wants to find out about increacing the ambient pop rate!
                    removePanels();
                    playGame();




                } else if (clickedName == "number" || clickedName == "value" || clickedName == "ambient" || clickedName == "speed" || clickedName == "share"){
                    //The player has decided they actually want an upgrade!!
                    handleUpgrade(mouseTarget.parent);

                } else if (mouseTarget.parent.name == "play") {
                    //Yep, so they want to play the game now. Fine.
                    removePanels();
                    playGame();

                } else if (tgtCheck!=null && tgtCheck=='tgt' && state=='pause') {
                    //I think they clicked a bubble when the game was paused... yikes! Better start the game again!
                    removePanels();
                    playGame();

                } else {
                    //They clicked something but it doesn't have a name... hmm, probably a gap between buttons
                    console.log("Not sure why you clicked there partner!  Maybe click something else?");
                    setSpeed('blank');
                }
            }
        } else {
          //It appears nothing was clicked - I think that means the blank canvas was clicked.  Lets play!
          removePanels();
          playGame();
          setSpeed('blank');
        }

        //Where ever may have been clicked - lets make a ripple!
        clickRipple(stage.mouseX, stage.mouseY);
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
    } else {
        //they have enough points, now is the upgrade maxed out?

        if (upgrade.name == "number") {

            if (upgrade.upgradeCount >= upgrade.maxUpgradeCount) {
                console.log("Hello google wallet again!")
            } else {
                /*
                 * The bubble rate upgrade
                 * Difficult one - it adds the specified number of bubbles but the computer can only handle so many
                 * This needs to be an expensive one or the bubbles need to be made simpler when the numbers increace.
                 */
                createNewBubbles(upgrade.upgradeValue);
                bubbleRate = bubbleRate + upgrade.upgradeValue;
                upgrade.upgradeCount ++;
                upgrade.getChildByName("upgradeCountTxt").text = "(" + upgrade.upgradeCount + "/" + upgrade.maxUpgradeCount + ")";
                numBubblesPanel.getChildByName("numBubblesPanelTitle").text = "Number of bubbles: " + bubbleRate;
                score = score - upgrade.upgradeCost;
                console.log("Bubble rate: " + bubbleRate);
            }

        } else if (upgrade.name == "value") {

            if (upgrade.upgradeCount >= upgrade.maxUpgradeCount) {
                console.log("Hello google wallet again!")
            } else {
                /*
                 * The value upgrade
                 * Increases the mamximum possible value by the amount specified
                 * also increases the minimum amount possible by 1/2 the amount specified
                 */
                popScoreMin = Math.round(popScoreMax + (upgrade.upgradeValue/2));
                popScoreMax = popScoreMax + upgrade.upgradeValue;
                upgrade.upgradeCount ++;
                upgrade.getChildByName("upgradeCountTxt").text = "(" + upgrade.upgradeCount + "/" + upgrade.maxUpgradeCount + ")";
                bubbleValuePanel.getChildByName("bubbleValuePanelTitle").text = "Value of bubbles: " + popScoreMin + " ~ " + popScoreMax;
                score = score - upgrade.upgradeCost;
                console.log("Upgraded value, max: " + popScoreMax + " | min : " + popScoreMin);
            }

        } else if (upgrade.name == "ambient") {

            if (upgrade.upgradeCount >= upgrade.maxUpgradeCount) {
                console.log("Hello google wallet again!")
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
  startTxt = new createjs.Text("App name!\n\n", "20px Patrick Hand", "#fff");
  startTxt.text += "Click to play";
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
  } else {
    console.log("No local storage available, can't save score :(");
  }
}
