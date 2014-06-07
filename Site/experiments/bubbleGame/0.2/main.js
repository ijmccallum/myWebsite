
// for the animation stuff
var stage, circle, arm, target, volume, yMin, yMax, adjRange, adjLevel, returnLevel, circleY, score, topScore, bmpList, flySeq, flyY, fly, flyImg, bitmap, txt, play, gameTxt, saveTxt, pauseTxt, clicked, mouseTarget, mvTargets = [], state = [], startTxt;
var canvas = document.getElementById('demoCanvas');
var noTgts = 5;
var canvasHeight = canvas.height;
var tgtBlurFilter = [], flyBlurFilter, flyBounds;
var particleImage;
var puff = [], emitter = [], emitterAlive = [];
var speedMin = 2, speedMax = 4;

/* =====================================================
 * =====================================================
 * ======================  AUDIO  ======================
 * =====================================================
 * =====================================================
 */
var contextClass = (window.AudioContext || window.webkitAudioContext);
if (contextClass) {
    // Web Audio API is available.
    var context = new contextClass();
    console.log('%cWeb audio API is here, we can play!', 'color:green;');
} else {
    // Web Audio API is not available. Ask the user to use a supported browser.
    alert("It appears your browser does not support the Web Audio API, please upgrade or use a different browser");
}

//for sound to be passed into
var audioBuffer;
//for analyser node
var analyzer;
//set empty array hald of fft size or equal to frequencybincount (you could put frequency bin count here if created)
var frequencyData = new Uint8Array(1024);



/**
 * Getting the line in (mic)
 */
navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia;
navigator.getUserMedia(
    {audio:true},
    gotStream,
    function(err) {
        alert("The mic didn't connect properly, try refreshing your browser.")
        console.log("The following error occured: " + err);
    } 
);

/**
 * Getting the mic stream in
 */
function gotStream(stream) {
    createAnalyser()
    // Create an AudioNode from the stream.
    var mediaStreamSource = context.createMediaStreamSource(stream);
    connectAnalyser(mediaStreamSource)
    //update();
}


/**
 * Creating the analyzer to work with the audio stream
 */ 
function createAnalyser() {
    //create analyser node
    analyzer = context.createAnalyser();

    analyzer.smoothingTimeConstant = 0.3;
    //set size of how many bits we analyse on
    analyzer.fftSize = 2048;
}

function connectAnalyser(source) {
    source.connect(analyzer);
}

function playSound() {
    //passing in file
    createAnalyser();
    //creating source node
    var source = context.createMediaElementSource(audioElement);
    connectAnalyser(source);
}



/**
 * Getting the numbers to control the dot
 * This takes an average of the low half frequencies then the high half, then it uses them to get the total
 * Total is the volume (y-axis)
 * low and high averages are a speedy work around for the pitch (x-axis)
*/

function getAudioValues(array) {
    var values = 0;
    var average;
    var length = array.length;

    for (var i = 0; i < length; i++) {
       values += array[i];
    }
    average = values / length;

    return average;
}



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
    score = 0;
    yMin = 0;
    yMax = 0;

    particleImage = new Image();
    //particleImage.onload = initCanvas;
    particleImage.src = "img/particle_base.png";

    flyImg = new Image();
    flyImg.onload = handleImageLoad();
    flyImg.src = "img/fly2.png";

    //todo: get top score from memory.
    if (typeof(Storage)!=="undefined") {
      topScore = localStorage.getItem("topscore");
      if (topScore == null) {
        console.log("Local storage available, no score saved")
        topScore = 0;
      }
    } else {
      topScore = 0;
    }

    /**
     * Create the random targets
     */
    //when play is clicked {
    startScreen();
    //}

    /**
     * Creating a red circle
     */
    //circle = new createjs.Shape();
    //circle.graphics.beginFill("red").drawCircle(0, 0, 10);

    canvas.onmousedown = onMouseDown;
    canvas.onmouseup = onMouseUp;

    //createjs.Ticker.on("tick", tick);
}

function handleImageLoad(e) {

  var flySprite = new createjs.SpriteSheet({
      images: ["img/fly2.png"],
      frames: { width:71, height:71 },
      animations: {fly: [0, 1, "fly"]}
  });

  fly = new createjs.Sprite(flySprite);
  fly.gotoAndPlay("fly");
  fly.x = 100;

  // fly.cache(0,0,20,10);

  // flyBlurFilter = new createjs.BlurFilter(0, 50, 1);
  // fly.filters = [flyBlurFilter];

  stage.addChild(fly);
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


    txt = new createjs.Text ("Score 0", "18px arial", "#fff");
    txt.textBaseline="top";
    txt.x = 600;
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
    tgt.y = canvas.height * Math.random()|0;

  //Apperance
    var rndWidth = Math.random() * (35 - 15) + 15;
    var rndColour = selectColour();
    tgt.graphics
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

    if (analyzer) {
        analyzer.getByteFrequencyData(frequencyData);
    }

    //target.alpha = 0.2;
    volume = getAudioValues(frequencyData);
    flyY = setAudioLevels(volume);
    fly.y = 580 - (flyY);
    //circle.y = 100;
    if (volume == 0) {
      console.log("Mic doesn't seem to be hooked up yet :(");
        //state = "pause";
        play = false;

    } else {

        //Not really sure - getting post transformations?
        //var pt = circle.localToLocal(10,0,target);

        //Check for clicking
        if (!clicked && stage.mouseX && stage.mouseY) {
          //Get the object under the mouse point
          mouseTarget = stage.getObjectUnderPoint(stage.mouseX, stage.mouseY);
        }

        // if (clicked && mouseTarget) {
        //   var tempTxt = String(mouseTarget.name);
        //   tempTxt = tempTxt.substring(0,3);
        //   if (tempTxt!=null && tempTxt=='tgt') {
        //     resetTgt(mouseTarget);
        //     score += 50;
        //     clicked = false;
        //   }
        // }

        //if (target.hitTest(pt.x, pt.y)) { target.alpha = 1; }

        //Check each target to see if it is under the dot
        //console.log("Fly Y = " + fly.y);
        noTgts = 5;
        for (var i = 0; i < noTgts; i++) {
          var pt = fly.localToLocal(50,0,mvTargets[i]);
          if (mvTargets[i].hitTest(pt.x, pt.y)) {

            //console.log("Making puff: " + i);
            emitter[i] = new createjs.ParticleEmitter(particleImage);
            puff[i] = createParticlePuff(emitter[i], mvTargets[i].rndWidth);
            emitter[i].position = new createjs.Point(mvTargets[i].x, mvTargets[i].y);
            emitterAlive[i] = "on";
            stage.addChild(emitter[i]);
            //waitAndKill();
            resetTgt(mvTargets[i]);
            score += mvTargets[i].score;
            speedMax += 0.1;
            speedMin += 0.01;
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
              gameOver();
              console.log("%cGame over!", "color:red;");
            }
          }
        }

        txt.text = "Top score: " + topScore + "  |  Current score: " + score;
        //txt.text += "\n\nYour top score: " + topScore;

        stage.update(event);
    }
}

function waitAndKill() {
  setTimeout(function(){
    noTgts = 5;
    for (var i = 0; i < noTgts; i++) {
      if (emitterAlive[i] == "on") {
        //console.log("Killing puff: " + i);
        emitter[i].reset();emissionRate = 0;
        emitterAlive[i] = "stopped";


        setTimeout(function(){
          for (var i = 0; i < noTgts; i++) {
            if (emitterAlive[i] == "stopped") {
              stage.removeChild(emitter[i]);
            }
          }
        }, 500);


      }//END if
      
    }//END for loop

  }, 100);

}//END waitAndKill

/**
 * Setting the max and min values for the mic volume input
 * this ensures that the whole game play area height is accessible to the dot
 * regardless of the players tyoe of mic.
 */

function setAudioLevels(level) {
  /*
   * level is the volume currently input from the mic
   *
   * yMax is the highest volume that the current mic can hit - we figure this out by the highest volume recieved so far
   *    Slowly decrease yMax until it gets pushed back up.
   * yMin is the rough baseline of background noise the the mic is picking up.
   *    Slowly raise yMin until it gets pushed back down.
   */
  yMin = yMin + 0.05;
  yMax = yMax - 0.01;

  if (level > yMax) {
    yMax = level;
    //console.log("yMax = " + yMax);
  }
  if (level < yMin) {
    yMin = level;
    //console.log("yMin = " + yMin);
  }

  /* 
   * yMin and yMax create a range within which the mic ccontrol can move 'level'.
   * adjRange is that range.
   * adjLevel is the point adjusted to match adjRange for the background noise
   * 
   * returnLevel is the position for the control point to be placed on the canvas.
   * it's position is the same fraction in the canvas as the level is within the mic range.
   *
   *   Level         returnLevel
   * ----------  =  --------------
   *  adjValue       canvasHeight
   */
  adjRange = (yMax - yMin);
  adjLevel = (level - yMin);
  returnLevel = (canvasHeight * (adjLevel/adjRange))+50;
  

  return returnLevel;
}

canvas.onclick = handleClick;
function handleClick() {

  canvas.onClick = null;

  if (state == "over") {
    console.log("%cStarting game again", "color:green;");
    play = true;
    score = 0;
    stage.removeChild(gameTxt);
    state = "playing";

  } else if (state =="ready"){
    stage.removeChild(introTxt);
    play = true;
    state = "playing";

  } else if (state == "start") {
    console.log("%cStarting game", "color:green;");
    score = 0;
    stage.removeChild(startTxt);
    var movingTarget = new Image();
    movingTarget.src = "img/dot.png";
    movingTarget.onload = createTargets;
    introScreen();
    play = false;
    state = "ready";
    console.log("Ok, finished the intro screen");

  } else if (state =="playing") {
    console.log("%cPausing game", "color:blue;");
    play = false;
    pause();
    state = "pause";

  } else if (state == "pause") {
    console.log("%cUnpausing game", "color:blue;");
    play = true;
    stage.removeChild(pauseTxt);
    state = "playing";

  } 
}

function onMouseDown() {
  if (!e) {var e = window.event;}
  clicked = true;
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
  startTxt.text += "Allow your mic\n\n";
  startTxt.text += "Click to play";
  startTxt.textAlign = "center";
  startTxt.x = canvas.width / 2;
  startTxt.y = canvas.height / 3;
  stage.addChild(startTxt);
  stage.update();
  //canvas.onclick = handleClick("gameStart");
}

function introScreen() {
  introTxt = new createjs.Text("The game needs to calibrate with your mic.\n\nMake a buzzing noise then click to begin!", "18px arial", "#fff");
  introTxt.textAlign = "center";
  introTxt.x = canvas.width / 2;
  introTxt.y = canvas.height / 3;
  stage.addChild(introTxt);
  stage.update();
}

function pause() {
  pauseTxt = new createjs.Text("Game Paused\n\n", "18px arial", "#fff");
  pauseTxt.text += "Click to start playing again";
  pauseTxt.textAlign = "center";
  pauseTxt.x = canvas.width / 2;
  pauseTxt.y = canvas.height / 3;
  stage.addChild(pauseTxt);
}

function gameOver() {
  state = "over";
  if (score > topScore) { 
    setTopScore(); 
  }

  gameTxt = new createjs.Text("Game over!\n\nClick to Play again", "18px arial", "#fff");
  gameTxt.textAlign = "center";
  gameTxt.x = canvas.width / 2;
  gameTxt.y = canvas.height / 3;
  stage.addChild(gameTxt);




  play = false;
  var l = bmpList.length;
  for (var i = 0; i < l; i++) {
    var bmp = bmpList[i];
    resetTgt(bmp);
  }
  //canvas.onclick = handleClick("gameOver");
}

function setTopScore() {
  topScore = score;
  alert("Yeay!\nNew top score!");

  if(typeof(Storage)!=="undefined") {
    // Code for localStorage/sessionStorage.
    console.log("Saving top score to local storage");
    localStorage.setItem("topscore", topScore);
  } else {
    console.log("No local storage available, can't save top score :(");
  }

}
