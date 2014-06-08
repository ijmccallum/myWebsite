//Gameplay variables
var score = 0,
    speedMin = 2,
    speedMax = 4,
    popScoreMin = 1,
    popScoreMax = 1,      //<< this cab be increased, needs a panel
    ambientPop = 10000,   //<< this cab be increased, needs a panel
    bubbleRate = 10;       //<< this cab be increased, needs a panel

//The UI
var numBubblesPanel = new createjs.Container(),
    bubbleValuePanel = new createjs.Container(),
    ambientPopPanel = new createjs.Container();

// for the animation stuff
var stage, circle, target, circleY, score, bitmap, txt, play, pauseTxt, clicked, mouseTarget, mvTargets = [], state = [], startTxt;
var canvas = document.getElementById('demoCanvas');
var noTgts = 5;
var tgtBlurFilter = [];
var particleImage;
var puff = [], emitter = [], emitterAlive = [];
var emitterCount = 0;
var bubbleContainer = new createjs.Container();
var upgradeBarContainer = new createjs.Container();
var bmpList = [];

/* =====================================================
 * =====================================================
 * ======================  SET UP  =====================
 * =====================================================
 * =====================================================
 */

//When the page loads, this function is called from the body, this is where all the fun will happen!
function init() {
    //Creating a stage and pointing it at the canvas element
    stage = new createjs.Stage("demoCanvas");

    particleImage = new Image();
    //particleImage.onload = initCanvas;
    particleImage.src = "img/particle_base.png";
    

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
    console.log("speedMin " + speedMin);
    console.log("speedMax " + speedMax);
    console.log("popScoreMin " + popScoreMin);
    console.log("popScoreMax " + popScoreMax);
    console.log("ambientPop " + ambientPop);
    console.log("bubbleRate " + bubbleRate);

    startScreen();

    //canvas.onmousedown = onMouseDown;
    //canvas.onmouseup = onMouseUp;
    canvas.onclick = handleClick;

}

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
    .beginFill("rgba(0,0,0,1)").rect(0, (canvas.height-40), canvas.width, canvas.height);

  upgradeBarContainer.addChild(barBG);

  /*
   * The upgrade buttons
   */

  var numBubblesBtn = new createjs.Text ("Number of bubbles", "18px arial", "#fff");
  numBubblesBtn.textAlign = "center";
  numBubblesBtn.x = canvas.width * 0.25;
  numBubblesBtn.y = canvas.height - 30;
  numBubblesBtn.name = "upgradeNumBtn";

  var bubbleValueBtn = new createjs.Text ("Value of bubbles", "18px arial", "#fff");
  bubbleValueBtn.textAlign = "center";
  bubbleValueBtn.x = canvas.width * 0.5;
  bubbleValueBtn.y = canvas.height - 30;
  bubbleValueBtn.name = "upgradeValueBtn";

  var ambientPopBtn = new createjs.Text ("Ambient pop rate", "18px arial", "#fff");
  ambientPopBtn.textAlign = "center";
  ambientPopBtn.x = canvas.width * 0.75;
  ambientPopBtn.y = canvas.height - 30;
  ambientPopBtn.name = "upgradeAmbientBtn"

  upgradeBarContainer.addChild(numBubblesBtn);
  upgradeBarContainer.addChild(bubbleValueBtn);
  upgradeBarContainer.addChild(ambientPopBtn);

   /*
    * The upgrade panels
    */

    /*
     * Building the upgrade panel for the NUMBER of bubbles
     */
    var numBubblesPanelBG = new createjs.Shape();
    var numBubblesPanelTitle = new createjs.Text ("Number of bubbles", "18px arial", "#fff");
    var numBubblesplayBtn = new createjs.Text ("Play", "18px arial", "#fff");

    genericBits(numBubblesPanel, numBubblesPanelBG, numBubblesPanelTitle, numBubblesplayBtn);
 
    /*
     * Building the upgrade panel for the VALUE of the bubbles
     */
    var bubbleValuePanelBG = new createjs.Shape();
    var bubbleValuePanelTitle = new createjs.Text ("Value of bubbles", "18px arial", "#fff");
    var bubbleValueplayBtn = new createjs.Text ("Play", "18px arial", "#fff");

    genericBits(bubbleValuePanel, bubbleValuePanelBG, bubbleValuePanelTitle, bubbleValueplayBtn);
 
    /*
     * Building the upgrade panel for the AMBIENT popping rate
     */
    var ambientPopPanelBG = new createjs.Shape();
    var ambientPopPanelTitle = new createjs.Text ("Ambient popping rate", "18px arial", "#fff");
    var ambientPopplayBtn = new createjs.Text ("Play", "18px arial", "#fff");

    genericBits(ambientPopPanel, ambientPopPanelBG, ambientPopPanelTitle, ambientPopplayBtn);


}

function genericBits(container, BGpanel, upTitle, playBtn) {
    //300 by 450
    var pPos1 = (canvas.width / 2) - 150; //top left x
    var pPos2 = 50; //top left y
    var pPos3 = 300; //width
    var pPos4 = canvas.height-120; //height 

    BGpanel.graphics.beginFill("rgba(0,0,0,0.8)").rect(pPos1, pPos2, pPos3, pPos4);

    upTitle.textAlign = "center";
    upTitle.x = canvas.width * 0.5;
    upTitle.y = 70;

    playBtn.textAlign = "center";
    playBtn.x = canvas.width * 0.5;
    playBtn.y = canvas.height - 100;
    playBtn.name = "play";

    container.addChild(BGpanel);
    container.addChild(upTitle);
    container.addChild(playBtn);
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

    txt = new createjs.Text ("Score", "18px arial", "#fff");
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

  //Move the targets
  if (play == true) {
      var noTgts = bmpList.length;
      for (var i = 0; i < noTgts; i++) {
          var bmp = bmpList[i];
          if (bmp.x > -100) {
              bmp.x -= bmp.speed;

          } else {
              resetTgt(bmp);
              console.log("%cOne escaped!", "color:red;");
          }
      }
  }

  txt.text = score;

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
    tgt.x = canvas.width + Math.random()*500;
    tgt.y = (canvas.height-40) * Math.random()|0;

  //Apperance
    var rndWidth = Math.random() * (35 - 15) + 15;
    var rndColour = selectColour();
    tgt.graphics
      .clear()
      .beginFill("rgba(0,0,0,0.1)").drawCircle((rndWidth/10),(rndWidth/8),(rndWidth*1.01)) //3 dark circles to create a shadow
      .beginFill("rgba(0,0,0,0.1)").drawCircle((rndWidth/10),(rndWidth/8),(rndWidth*1.1))
      .beginFill("rgba(0,0,0,0.1)").drawCircle((rndWidth/10),(rndWidth/8),(rndWidth*1.2))
      .beginFill("white").drawCircle(0,0,rndWidth)//outline
      .beginFill(rndColour).drawCircle(0,0,(rndWidth - 1))//body
      .beginFill("rgba(255,255,255,0.2)").drawCircle((-rndWidth/9),(-rndWidth/9),(rndWidth-(rndWidth/10)))//body light
      .beginFill("rgba(255,255,255,0.8)").drawCircle((-rndWidth/3),(-rndWidth/2),(rndWidth/8))//spec highlight
      

  //Behaviour
    tgt.rndWidth = rndWidth;
    tgt.speed = (Math.random()*speedMax)+speedMin;
    tgt.score = Math.floor((Math.random() * popScoreMax) + popScoreMin);
    console.log("Tgt score = " + tgt.score);
    tgtBlurFilter[i] = new createjs.BlurFilter((tgt.speed/2), 0, 1);
    tgtBlurFilter[i+1] = new createjs.BlurFilter(1, 1, 1);
    tgt.alpha = 0.7;

  //Funky filters
    tgt.filters = [tgtBlurFilter[i], tgtBlurFilter[i+1]];
    var bounds = tgtBlurFilter[i].getBounds();
    tgt.cache(-50+bounds.x, -50+bounds.y, 100+bounds.width, 100+bounds.height);
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
    setInterval(function(){
        if (state == "playing") {
            var bPos = -1;
            var rndBubble, bubbleToPop;
            var checkCount = 0;

            while (bPos < 0 || bPos > canvas.width) {
                checkCount ++;
                if (checkCount > bubbleRate) {
                  break;
                }
                console.log("Check count " + checkCount);
                rndBubble = Math.floor((Math.random() * bubbleRate) + 1);
                bubbleToPop = bmpList[rndBubble];

                if (bubbleToPop) {
                    bPos = bubbleToPop.x;
                }
            }
            if (bubbleToPop) {
                popBubble(bubbleToPop);
            }
        }
    },ambientPop);
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
function popBubble(bubble) {
    emitter[emitterCount] = new createjs.ParticleEmitter(particleImage);
    puff[emitterCount] = createParticlePuff(emitter[emitterCount], bubble.rndWidth);
    emitter[emitterCount].position = new createjs.Point(bubble.x, bubble.y);
    emitterAlive[emitterCount] = "on";
    stage.addChild(emitter[emitterCount]);
    score += bubble.score;
    clicked = false;
    speedMax += 0.1;
    speedMin += 0.01;
    resetTgt(bubble);
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

/* =====================================================
 * =====================================================
 * ==============  CLICKING MY BUTTONS!  ===============
 * =====================================================
 * =====================================================
 */


function handleClick() {
    canvas.onClick = null;
    console.log("State = " + state);

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
    }

    /*
     * Dealing with the object that was clicked
     */

    if (stage.mouseX && stage.mouseY) {
        mouseTarget = stage.getObjectUnderPoint(stage.mouseX, stage.mouseY);
        console.log("Mouse target: " + mouseTarget);

        if (mouseTarget) {
            var tempTxt = String(mouseTarget.name);
            tgtCheck = tempTxt.substring(0,3);

            if (tgtCheck!=null && tgtCheck=='tgt' && state=='playing') {
                // The game is playing & the object clicked was a bubble, time to pop it!
                console.log("It's a bubble!");
                popBubble(mouseTarget);

            } else if (tempTxt!=null && tempTxt=='play') {
                // The player wants to increace the ambient pop rate!
                removePanels();
                playGame();
            } else if (tempTxt!=null && tempTxt=='upgradeNumBtn') {
                // The player wants to increase the number of bubbles!
                removePanels();
                stage.addChild(numBubblesPanel);
                pause();

            } else if (tempTxt!=null && tempTxt=='upgradeValueBtn') {
                // The player wants to increase the value of the bubbles!
                removePanels();
                stage.addChild(bubbleValuePanel);
                pause();

            } else if (tempTxt!=null && tempTxt=='upgradeAmbientBtn') {
                // The player wants to increace the ambient pop rate!
                removePanels();
                stage.addChild(ambientPopPanel);
                pause();
            }
                // The player wants to start playing again!
                //removePanels();
                //play();
        }
    }
}

/* =====================================================
 * =====================================================
 * ===================  THE SCREENS  ===================
 * =====================================================
 * =====================================================
 */

function startScreen() {
  state = "start";
  startTxt = new createjs.Text("App name!\n\n", "18px arial", "#fff");
  startTxt.text += "Click to play";
  startTxt.textAlign = "center";
  startTxt.x = canvas.width / 2;
  startTxt.y = canvas.height / 3;
  stage.addChild(startTxt);
  stage.update();
  //canvas.onclick = handleClick("gameStart");
}

function removePanels() {
  console.log("removing panels");
  if (stage.contains(numBubblesPanel)) {
      stage.removeChild(numBubblesPanel);
  }
  if (stage.contains(bubbleValuePanel)) {
      stage.removeChild(bubbleValuePanel);
  }
  if (stage.contains(ambientPopPanel)) {
      stage.removeChild(ambientPopPanel);
  }
}

function pause() {
  play = false;
  state = "pause";
}

function playGame() {
  play = true;
  state = "playing";
}


function saveScore() {
  if(typeof(Storage)!=="undefined") {
    console.log("Score saved to local storage: " + score);
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
