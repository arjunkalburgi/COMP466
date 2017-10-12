var loaded = 0, numOfImages = 20, next = sequence = forward = true;

var imagearray = new Array(numOfImages); 
for (var i = 0; i < numOfImages; i++) {
    imagearray[i] = document.createElement('img');
    imagearray[i].onload = function(e) {
        loaded++;
        if (loaded === numOfImages)
            draw();   // <-- second part of chain, invoke loop
    }
    imagearray[i].onerror = function(e) { alert(e.toString()); }; 
    imagearray[i].src = "assets/slideshow/slideshow(" + i + ").jpg";
}

function draw() {

    var images = imagearray
        counter = 0,
        maxNum = images.length - 1,

        myCanvas = document.getElementById('myCanvas'),
        ctx = myCanvas.getContext('2d'),

        me = this; 

    this._draw = function() {

        ctx.clearRect(0, 0, myCanvas.width, myCanvas.height)
        ctx.drawImage(images[counter], 0, 0, images[counter].width, images[counter].height,     // source rectangle
                                       0, 0, myCanvas.width,        myCanvas.height); // destination rectangle
        
        if (next) {
        	if (sequence) {
        		if (forward) {
	    		    counter++; 
        		} else {
        			counter--; 
        		}
	    	} else {
	    		counter = Math.floor(Math.random() * (maxNum - 0) + 0);
	    		console.log("counter: " + counter); 
	    	}
        }
        if (counter > maxNum) counter = 0;

        setTimeout(me._draw, 3000);
    }

	this._draw(); //START the loop
}

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

// code source: https://stackoverflow.com/questions/16931072/simplest-slideshow-in-html5-canvas-canvas-context-clearrect-not-working-with-se
