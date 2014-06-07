
/**
 * Getting the Web Audio API
 */
var contextClass = (window.AudioContext 
    || window.webkitAudioContext 
    || window.mozAudioContext 
    || window.oAudioContext 
    || window.msAudioContext);
if (contextClass) {
    // Web Audio API is available.
    var context = new contextClass();
    console.log('%cWeb audio API is here, we can play!', 'color:green;');
} else {
    // Web Audio API is not available. Ask the user to use a supported browser.
    alert("It appears your browser does not support the Web Audio API, please upgrade or use a different browser");
}

/**
 * Setting up the variables
 */ 

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




/**
 * The Easel.JS canvas code
 */

var stage, circle, arm, target, volume;
//When the page loads, this function is called from the body, this is where all the fun will happen!
function init() {
    //Creating a stage and pointing it at the canvas element
    stage = new createjs.Stage("demoCanvas");

    /**
     * Creating a red circle
     */
    circle = new createjs.Shape();
    circle.graphics.beginFill("red").drawCircle(0, 0, 10);
    circle.x = 150;
    circle.y = 100;
    stage.addChild(circle);

    /**
     * Creating a target
     */
    target = stage.addChild(new createjs.Shape());
    target.graphics.beginFill("red").drawCircle(0,0,45)
        .beginFill("white").drawCircle(0,0,30)
        .beginFill("red").drawCircle(0,0,15);
    target.x = 150;
    target.y = 180;

    createjs.Ticker.on("tick", tick);
}

/**
 * The hit test function
 */
function tick(event) {
    if (analyzer) {
        analyzer.getByteFrequencyData(frequencyData);
    }
    target.alpha = 0.2;
    volume = getAudioValues(frequencyData);
    circle.y = 300 - (volume*1.5);

    //Not really sure - getting post transformations?
    var pt = circle.localToLocal(10,0,target);

    if (target.hitTest(pt.x, pt.y)) { target.alpha = 1; }

    stage.update(event);
}








/**
 * Alternate mic amp method
 *
 * Record a tiny bit,
 * Check max amplitude
 * Repeat
 */


//MediaRecorder
var recorder = new MediaRecorder();
    recorder.setAudioSource(MediaRecorder.AudioSource.MIC);
    recorder.setOutputFormat(MediaRecorder.OutputFormat.THREE_GPP);
    recorder.setAudioEncoder(MediaRecorder.OutputFormat.AMR_NB);
    //recorder.setOutputFile(outputFile);

alert(recorder);





