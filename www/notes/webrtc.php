<?php $iainPageTitle = 'WebRTC'; $docDepth = 1;?>
<?php include '../partials/head.php'; ?>
<a href="http://www.webrtc.org/">WebRTC homepage</a>
<p><i>enables peer-to-peer audio, video, and data sharing between browsers (peers).</i> This brings real-time communication to the browser
as well as possibly bringing the capabilities of the web to the telecommunications industry.  It deals with bringin video and audio engines to 
the browser and handling the impact of network weather on the stream.  It uses UDP as a packet loss will not block any following packets - latency 
is far more important in getting a good experiance than dropped data / gaps.</p>
<p>The browser abstracts much of the complexity with three api's:
<ul>
	<li>MediaStream: acquisition of audio and video streams</li>
	<li>RTCPeerConnection: communication of audio and video data</li>
	<li>RTCDataChannel: communication of arbitrary application data</li>
</ul>
</p>
<p>
	<code>getUserMedia()</code> for aquiring media:
<pre><code>&lt;video autoplay&gt;&lt;/video&gt;

&lt;script&gt;
  var constraints = {
    audio: true, 2
    video: { 3
      mandatory: {  4
        width: { min: 320 },
        height: { min: 180 }
      },
      optional: [  5
        { width: { max: 1280 }},
        { frameRate: 30 },
        { facingMode: "user" }
      ]
    }
  }

  navigator.getUserMedia(constraints, gotStream, logError);  6

  function gotStream(stream) { 7
    var video = document.querySelector('video');
    video.src = window.URL.createObjectURL(stream);
  }

  function logError(error) { ... }
&lt;/script&gt;</code></pre>
</p>

<p><strong>RTCPeerConnection</strong> ...</p>

<h3>Signalling servers</h3>
<ul>
	<li>Asterisk</li>
</ul>

<p>setting up a peer to peer connection:
<pre><code>var signalingChannel = new SignalingChannel(); 1
var pc = new RTCPeerConnection({}); 2

navigator.getUserMedia({ "audio": true }, gotStream, logError);  3

function gotStream(stream) {
  pc.addStream(stream); 4

  pc.createOffer(function(offer) { 5
    pc.setLocalDescription(offer); 6
    signalingChannel.send(offer.sdp); 7
  });
}

function logError() { ... }</code></pre>
<a href="http://chimera.labs.oreilly.com/books/1230000000545/ch18.html#_session_description_protocol_sdp">source</a>
</p>




<?php $footerAddress = (ltrim($homePath,'"')) . 'partials/footer.php'; ?>
<?php include $footerAddress; ?>