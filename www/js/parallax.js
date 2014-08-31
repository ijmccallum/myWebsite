var synergyBG = document.getElementById("page-content-wrapper");
var speed = 1.5;

window.onscroll = function() {
	var yOffset = window.pageYOffset;
	synergyBG.style.backgroundPosition = "0px "+ (yOffset / speed) + "px";
}