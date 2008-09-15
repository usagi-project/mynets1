function hiddenHelp(evt) {
	
	if(document.all) {
		document.all[evt].style.visibility = "hidden";
		document.all[evt].style.display = "none";	
	} else {
		document.getElementById(evt).style.visibility = "hidden";
		document.getElementById(evt).style.display = "none";
	}

}
function popHelp(evt,x,y) {
	if(document.all) {
		X = event.x + document.documentElement.scrollLeft;
		Y = event.y + document.documentElement.scrollTop;
		document.all[evt].style.visibility = "visible";
		document.all[evt].style.display = "block";		
		document.all[evt].style.left = X + -40 + "px";
		document.all[evt].style.top = Y + -80 + "px";
	} else {
		document.getElementById(evt).style.left = x + -40 + "px";
		document.getElementById(evt).style.top = y + -80 + "px";
		document.getElementById(evt).style.visibility = "visible";
		document.getElementById(evt).style.display = "block";
	}
}