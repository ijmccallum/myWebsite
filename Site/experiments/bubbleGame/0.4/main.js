//Gameplay variables
if (typeof(Storage)!=="undefined") {
      console.log("Local storage available, updating gameplay variables");
      score = Number(localStorage.getItem("score"));
      speedMin = Number(localStorage.getItem("speedMin"));
      speedMax = Number(localStorage.getItem("speedMax"));
      popScoreMin = Number(localStorage.getItem("popScoreMin"));
      popScoreMax = Number(localStorage.getItem("popScoreMax"));
      ambientPop = Number(localStorage.getItem("ambientPop"));
      bubbleRate = Number(localStorage.getItem("bubbleRate"));
    } else {
      console.log("No local storage available, setting gameplay variables to baseline");
      score = 0;
      speedMin = 2;
      speedMax = 4;
      popScoreMin = 1;
      popScoreMax = 1;
      ambientPop = 0;
      bubbleRate = 5;
    }

// for the animation stuff
var stage, circle, arm, target, returnLevel, circleY, score, topScore, bmpList, flySeq, flyY, fly, flyImg, bitmap, txt, play, gameTxt, saveTxt, pauseTxt, clicked, mouseTarget, mvTargets = [], state = [], startTxt;
var canvas = document.getElementById('demoCanvas');
var noTgts = 5;
var canvasHeight = canvas.height;
var tgtBlurFilter = [], flyBlurFilter, flyBounds;
var particleImage;
var puff = [], emitter = [], emitterAlive = [];
var speedMin = 2, speedMax = 4;


/* =====================================================
 * =====================================================
 * =====================  Easel.js  ====================
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
    if (typeof(Storage)!=="undefined") {
      score = Number(localStorage.getItem("bubbleScore"));
      console.log("Retrieving score: " + score);
      if (score == null) {
        console.log("Local storage available, no score saved")
        score = 0;
      }
    } else {
      score = 0;
    }

    startScreen();

    canvas.onmousedown = onMouseDown;
    canvas.onmouseup = onMouseUp;

}

/**
 * Create the upgrade bar
 */
function makeUpgradeBar() {
  var barBG = new createjs.Shape();
  barBG.graphics
    .beginFill("rgba(0,0,0,1)").rect(0, (canvas.height-40), canvas.width, canvas.height);
  stage.addChild(barBG);

}

/**
 * Create a number of targets
 */
function createTargets(event) {
    var image = event.target;
    var container = new createjs.Container();
    stage.addChild(container);

    bmpList = [];
    for (var i = 0; i < noTgts; i ++) {
        emitterAlive[i] = false;
        bitmap = container.addChild(new createjs.Shape());
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
    tgt.score = Math.floor((Math.random() * speedMax) + speedMin);
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

/**
 * The Ticker!
 * preforming hit test
 * moving the targets
 */
function tick(event) {

    //Check for clicking
    if (!clicked && stage.mouseX && stage.mouseY) {
      //Get the object under the mouse point
      mouseTarget = stage.getObjectUnderPoint(stage.mouseX, stage.mouseY);
    }

    if (clicked && mouseTarget) {
      var tempTxt = String(mouseTarget.name);
      tempTxt = tempTxt.substring(0,3);

    //If a bubble has been clicked
    if (tempTxt!=null && tempTxt=='tgt') {
      emitter[i] = new createjs.ParticleEmitter(particleImage);
      puff[i] = createParticlePuff(emitter[i], mouseTarget.rndWidth);
      emitter[i].position = new createjs.Point(mouseTarget.x, mouseTarget.y);
      emitterAlive[i] = "on";
      stage.addChild(emitter[i]);
      score += mouseTarget.score;
      clicked = false;
      speedMax += 0.1;
      speedMin += 0.01;
      resetTgt(mouseTarget);
      saveScore();
    }
  }


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


canvas.onclick = handleClick;
function handleClick() {

  canvas.onClick = null;

  if (state =="start") {
    stage.removeChild(startTxt);
    makeUpgradeBar();
    var movingTarget = new Image();
    movingTarget.src = "img/dot.png";
    movingTarget.onload = createTargets;
    play = true;
    state = "playing";
  } 
  // } else if (state =="playing") {
  //   console.log("%cPausing game", "color:blue;");
  //   play = false;
  //   pause();
  //   state = "pause";

  // } else if (state == "pause") {
  //   console.log("%cUnpausing game", "color:blue;");
  //   play = true;
  //   stage.removeChild(pauseTxt);
  //   state = "playing";

  // } 
}

function onMouseDown() {
  if (!e) {var e = window.event;}
  clicked = true;
  console.log("State = " + state);
}

function onMouseUp() {
  clicked = false;
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

function pause() {
  pauseTxt = new createjs.Text("Game Paused\n\n", "18px arial", "#fff");
  pauseTxt.text += "Click to start playing again";
  pauseTxt.textAlign = "center";
  pauseTxt.x = canvas.width / 2;
  pauseTxt.y = canvas.height / 3;
  stage.addChild(pauseTxt);
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
