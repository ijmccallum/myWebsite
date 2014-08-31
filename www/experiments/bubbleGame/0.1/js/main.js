
/**
 * Getting the Web Audio API
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
    update();
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





function update() {
	  requestAnimationFrame(update);
	  //constantly getting feedback from data
	  analyzer.getByteFrequencyData(frequencyData);


	// Animation stuff--------------------------------
	var lights = document.getElementsByTagName('i');
	var totalLights = lights.length;

	for (var i=0; i<totalLights; i++) {
	  //set light colours
	  var lightColour = i*10;
	  lights[i].style.backgroundColor = 'hsla('+lightColour+',  80%, 50%, 0.8)';
	  lights[i].style.borderColor = 'hsla('+lightColour+',  80%, 50%, 1)';
	  //flash on frequency
	  var freqDataKey = i*2;
	  if (frequencyData[freqDataKey] > 160){
	    //start animation on element
	    lights[i].style.opacity = "1";
	  } else {
	    lights[i].style.opacity = "0.2";
	  }
	}


	//different animation stuff
	var appDot = document.getElementById('appDot');
	var lowLevel = document.getElementById('lowAvg');
	var highLevel = document.getElementById('highAvg');

	var dotControlValues = getAudioValues(frequencyData);
	var xPosition = getXvalue(dotControlValues[0],dotControlValues[1]);

	// X AXIS - PITCH
	appDot.style.marginLeft = xPosition + "px";
	lowLevel.style.height = dotControlValues[0] + "px";
	highLevel.style.height = dotControlValues[1] + "px";
	console.log("%cXposition: " + xPosition, "color:black;");


	// Y AXIS - VOLUME
	appDot.style.bottom = (dotControlValues[2]*2) + "px";
	console.log("%cYposition: " + dotControlValues[2], "color:black;");
};



/**
 * Getting the numbers to control the dot
 * This takes an average of the low half frequencies then the high half, then it uses them to get the total
 * Total is the volume (y-axis)
 * low and high averages are a speedy work around for the pitch (x-axis)
 */

 function getAudioValues(array) {
 	var values = 0;
    var totalAvg,
    	highAvg,
    	lowAvg;
    var halfLength = (array.length / 2);

    // get the first half of frequency amplitudes
    for (var i = 0; i < halfLength; i++) {
        values += array[i];
    }
    lowAvg = values / halfLength;

    values = 0;

    for (var i = halfLength; i < (halfLength*2); i++) {
        values += array[i];
    }
    highAvg = values / halfLength;

    totalAvg = ((lowAvg + highAvg) / 2);

    var freqResult = [lowAvg, highAvg, totalAvg];

    return freqResult;
 }

function getXvalue(lowAvg,highAvg) {
	//console.log("%cL:" + lowAvg + " H:" + highAvg, 'color:red;');
	xResult = 200 + (((highAvg*2) - lowAvg)*5);
	return xResult;
}


