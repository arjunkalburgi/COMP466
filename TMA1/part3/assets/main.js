var loaded = 0, numOfImages = 20;

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

        console.log(myCanvas.width)
        console.log(images[counter].width)
        ctx.clearRect(0, 0, myCanvas.width, myCanvas.height)
        ctx.drawImage(images[counter], 0, 0, images[counter].width, images[counter].height,     // source rectangle
                                       0, 0, myCanvas.width,        myCanvas.height); // destination rectangle
        counter++; 
        if (counter > maxNum) counter = 0;

        setTimeout(me._draw, 3000);
    }
    this._draw(); //START the loop
}

// code source: https://stackoverflow.com/questions/16931072/simplest-slideshow-in-html5-canvas-canvas-context-clearrect-not-working-with-se
