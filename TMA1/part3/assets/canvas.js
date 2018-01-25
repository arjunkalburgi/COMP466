// SELECT FUNCTION
$(document).ready(function() {
    $('select').material_select();
});


// CONTROL FUNCTIONS
var loaded = 0, numOfImages = 20, next = sequence = forward = true;
var notransition = "0"; 

function startstop() {
	next = !next; 
	console.log("next " + next); 
}

function randomizersequencer() {
	sequence = !sequence; 
	if(sequence) document.getElementById('backwardforward').disabled = false;
    else document.getElementById('backwardforward').disabled = true;
	console.log("sequence " + sequence); 
	console.log("#backwardforward " + (sequence ? "enabled" : "disabled")); 
}

function backwardforward() {
	if (sequence) {
		forward = !forward; 
	}
	console.log("forward " + forward); 
}

$(function(){
    $('select').change(function(){
		notransition = $(this).val(); 
		console.log("transition: " + notransition);
    });
});


// CANVAS FUNCTIONS
var canvas, context;				
var image = new Image();
var nextImage = new Image();
var imageWidth = 500;
var imageHeight = 375;
var imageList = new Array(20);
var imageCount = 0;
var timing = 0;
var imageData, transitionInterval, showInterval, originX, originY, wipeDir, wipeOffset;
var choice;
canvas = document.getElementById("myCanvas");
context = canvas.getContext("2d");


for (var i = 0; i < imageList.length; ++i) {
	imageList[i] = imageobj[i].src; 

	// "assets/slideshow/slideshow(" + i + ").jpg";
}

image.src = imageList[0];

nextImage.src = imageList[0];


function startSlideShow() {
	context.translate(canvas.width/2, canvas.height/2);
	drawImage(image);
	showInterval = setInterval(startTransition, 2000);
}

function startTransition() {

	clearInterval(showInterval);
	//choice = 1;
	var choice; 
	if (notransition == "0") {
		choice = Math.floor((Math.random() * 3) + 1);
	} else {
		choice = parseInt(notransition); 
	}
	console.log("I choose: " + choice);
	switch (choice) {
		case 1:
			transitionInterval = setInterval(fadeOut, 10);
			break;
		case 2:
			wipeDir = "left";
			transitionInterval = setInterval(wipeOutHoriz, 10);
			break;
		case 3:
			wipeDir = "right";
			transitionInterval = setInterval(wipeOutHoriz, 10);
			break;
	}

	// set caption 
	console.log("middle +1" + imageobj[imageCount+1].caption)
	$(".caption").text(imageobj[imageCount+1].caption)

	// if slideshow is on
    if (next) {

    	// set img
		image.src = nextImage.src;

		if (sequence) { // if sequence is on 
    		if (forward) { // if sequence is forward
    		    if (++imageCount == imageList.length)
					imageCount = 0;
    		} else { // if sequence is backwards
    			if (--imageCount == -1)
					imageCount = imageList.length-1;
    		}
    	} else { // if sequence is off 
    		imageCount = Math.floor(Math.random() * (imageList.length - 1) + 1);
    	}

    	// set next image
		nextImage.src = imageList[imageCount];

    }


}

function showImage() {
	context.clearRect(canvas.width / -2, canvas.height / -2,
			canvas.width, canvas.height);

	drawImage(nextImage);
	showInterval = setInterval(startTransition, 2000);
}

function drawImage(toDraw) {
	// window.alert("drawing image");
	if (toDraw.naturalWidth > toDraw.naturalHeight)
		context.drawImage(toDraw, canvas.width / -2,
		 Math.floor(imageHeight / -2), canvas.width, imageHeight);
	else
		context.drawImage(toDraw, Math.floor(imageHeight / -2),
		 canvas.width / -2, imageHeight, canvas.width);
}

function rotateOut() {
	context.clearRect(canvas.width / -2, canvas.height / -2,
		canvas.width, canvas.height);
	
	context.rotate(10*(Math.PI / 360));
	context.scale(0.985, 0.985);

	drawImage(image);
	timing += 10*(Math.PI / 360);
	if (timing >= 5 * Math.PI) {
		clearInterval(transitionInterval);
		transitionInterval = setInterval(rotateIn, 10);
	}
}

function rotateIn() {
	context.clearRect(canvas.width / -2, canvas.height / -2,
		canvas.width, canvas.height);

	context.rotate(-10*(Math.PI / 360));
	context.scale(1.015, 1.015);

	
	timing -= 10*(Math.PI / 360);
	if (timing <= 0.01) {
		clearInterval(transitionInterval);
		timing = 0;
		context.setTransform(1, 0, 0, 1, 0, 0);
		context.translate(canvas.width/2, canvas.height/2);
		showImage();
	}
	else
	{
		drawImage(nextImage);
	}
}

function fadeOut() {
	if (timing == 0) {
		
		if (image.naturalWidth > image.naturalHeight)
			imageData = context.getImageData(canvas.width / 2 - imageWidth / 2,
				canvas.height / 2 - imageHeight / 2, imageWidth, imageHeight);
		else
			imageData = context.getImageData(canvas.width / 2 - imageHeight / 2,
				canvas.height / 2 - imageWidth / 2, imageHeight, imageWidth);
	}
	
	for (var i = 3; i < imageData.data.length; i += 4) {
		
		if (imageData.data[i] - 1.02 < 0)
			imageData.data[i] = 0;
		else
			imageData.data[i] -= 1.02;
	}
	
	if (image.naturalWidth > image.naturalHeight)
			context.putImageData(imageData, canvas.width / 2 - imageWidth / 2,
				canvas.height / 2 - imageHeight / 2);
	else
		context.putImageData(imageData, canvas.width / 2 - imageHeight / 2,
			canvas.height / 2 - imageWidth / 2);
	
	timing += 1.02;

	if (timing >= 255) {
		clearInterval(transitionInterval);
		timing = 0;
		context.clearRect(canvas.width / -2, canvas.height / -2,
			canvas.width, canvas.height);
		transitionInterval = setInterval(fadeIn, 10);
	}

}

function fadeIn() {
	if (timing == 0) {
		
		drawImage(nextImage);

		if (nextImage.naturalWidth > nextImage.naturalHeight)
			imageData = context.getImageData(canvas.width / 2 - imageWidth / 2,
				canvas.height / 2 - imageHeight / 2, imageWidth, imageHeight - 1);
		
		else
			imageData = context.getImageData(canvas.width / 2 - imageHeight / 2,
				canvas.height / 2 - imageWidth / 2, imageHeight - 1, imageWidth);
		
		context.clearRect(canvas.width / -2, canvas.height / -2,
		canvas.width, canvas.height);

		for (var i = 3; i < imageData.data.length; i += 4) {
			imageData.data[i] = 0;
		}
	}

	for (var i = 3; i < imageData.data.length; i += 4) {
		if (imageData.data[i] + 1.02 > 255)
			imageData.data[i] = 255;
		else
			imageData.data[i] += 1.02;
	}

	if (nextImage.naturalWidth > nextImage.naturalHeight)
			context.putImageData(imageData, canvas.width / 2 - imageWidth / 2,
				canvas.height / 2 - imageHeight / 2);
	else
		context.putImageData(imageData, canvas.width / 2 - imageHeight / 2,
			canvas.height / 2 - imageWidth / 2);

	timing += 1.02;

	if (timing >= 255) {
		clearInterval(transitionInterval);
		timing = 0;
		showImage();
	}
}

function wipeOutHoriz() {

	if (timing == 0) {

		if (image.naturalWidth > image.naturalHeight) {
			if (wipeDir == "left") {
				originX = -(imageWidth / 2);
				originY = -(imageHeight / 2) - 1;
			}
			else {
				originX = imageWidth / 2;
				originY = -(imageHeight / 2) - 1;
			}
			wipeOffset = imageHeight;
		}						
		else {
			if (wipeDir == "left") {
				originX = -(imageHeight / 2) - 1;
				originY = -(imageWidth / 2);
			}
			else {
				originX = imageHeight / 2 + 1;
				originY = -(imageWidth / 2);	
			}
			wipeOffset = imageWidth;
		}
	}

	if (wipeDir == "left") {
		context.clearRect(originX, originY,	2, wipeOffset);
		originX += 2;
	}
	else {
		context.clearRect(originX - 2, originY,	2, wipeOffset);
		originX -= 2;
	}

	++timing;
	
	if (wipeDir == "left") {
		if (originX > imageWidth / 2) {
			clearInterval(transitionInterval);
			timing = 0;
			transitionInterval = setInterval(wipeInHoriz, 10);
		}
	}
	else {
		if (originX < -(imageWidth / 2)) {
			clearInterval(transitionInterval);
			timing = 0;
			transitionInterval = setInterval(wipeInHoriz, 10);
		}
	}
}

function wipeInHoriz() {
	if (timing == 0) {
		
		drawImage(nextImage);

		if (nextImage.naturalWidth > nextImage.naturalHeight)
			imageData = context.getImageData(canvas.width / 2 - imageWidth / 2,
				canvas.height / 2 - imageHeight / 2, imageWidth, imageHeight - 1);
		
		else
			imageData = context.getImageData(canvas.width / 2 - imageHeight / 2,
				canvas.height / 2 - imageWidth / 2, imageHeight - 1, imageWidth);
		
		context.clearRect(canvas.width / -2, canvas.height / -2,
			canvas.width, canvas.height);

		for (var i = 3; i < imageData.data.length; i += 4) {
			imageData.data[i] = 0;
		}

		originX = 0;

		if (nextImage.naturalWidth > nextImage.naturalHeight)
			wipeOffset = imageWidth;
		else
			wipeOffset = imageHeight;
	}

	if (wipeDir == "left") {

		for (var i = originX * 4; i < imageData.data.length; i += (wipeOffset * 4)) {
			imageData.data[i + 3] = 255;
			if (originX > 0)
				imageData.data[i - 1] = 255;
		}
	}
	else {
		for (var i = imageData.data.length - originX * 4; i >= 0 ; i -= (wipeOffset * 4)) {
			imageData.data[i - 1] = 255;
			if (originX > 0)
				imageData.data[i + 3] = 255;
		}
	}
	originX += 2;
	
	if (nextImage.naturalWidth > nextImage.naturalHeight)
			context.putImageData(imageData, canvas.width / 2 - imageWidth / 2,
				canvas.height / 2 - imageHeight / 2);
	else
		context.putImageData(imageData, canvas.width / 2 - imageHeight / 2,
			canvas.height / 2 - imageWidth / 2);	

	++timing;

	if (originX > wipeOffset) {
		clearInterval(transitionInterval);
		timing = 0;
		showImage();
	}
}

function start() {
	startSlideShow();

}
window.addEventListener("load", start, false);
window.addEventListener("resize", start, false);
