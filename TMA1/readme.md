ASSIGNMENT REPORT  
=======


# PART 1 
I found xml, xsd and xsl fairly primitive versions of html. Sort of interesting if you think about the history of how we got to HTML.

### TOOLS 
There were a number of tools online that I found useful for debugging and converting my files. The main one being the [XSL Transformer by FreeFormatter](https://www.freeformatter.com/xsl-transformer.html). 


# PART 2 
Because Part 2 was done before learning server-side scripting, I thought a lot of this part was very strange. Not being able to use the server during the AJAX requests limited me to have all my logic in JavaScript. 

### TOOLS 
The materializecss framework library came in handy here, allowing me to quickly and easily have a consistent and professional UI. In a real application, this design would be modified to suit the company of the site, but for projects like this one the defaults worked perfectly! 


# PART 3
I had a lot of difficulty integrating the materializecss framework elements for this part of the assignment. All of the buttons and controls were very finiky on the frontend. In hindsight I wish I looked up more alternative tools and libraries I could have used. 

### ALGORITHMS 
The canvas drawings depend heavily on HTML's setInterval and canvas elements to be able to loop through the pictures and draw them on the screen. 

### TOOLS 
After being required to use JSON to store information about the images, I found it kind of ridiculous that there's no good way to load a JSON from the client side. All the JavaScript methods I found for loading JSON's were all along the lines of AJAX requests for the JSON file, which of course does not help for this server-less application. 


# PART 4
For this part I chose to break down the HTML and rely more than necessary on AJAX for loading content, else this application could have been done mostly in one page. 

### ALGORITHMS 
The source code for the calculators can be found in assets/tools.js. Most of them consist of applying the formula from the respective webpages ([convertCalc](https://en.wikipedia.org/wiki/Conversion_of_units), [retireCalc](https://lifehacker.com/quickly-figure-out-your-retirement-number-with-this-equ-1463722765), [mortgageCalc](https://en.wikipedia.org/wiki/Mortgage_calculator#Monthly_payment_formula)) and then programming them in JavaScript. 

### TOOLS 
The Math JS library helped with building out the formula's for the 3 algorithms since that level of math isn't available in pure JavaScript. 
I used my part2 as a tool as well, using it's structure and navigation ability as a template, just changing the names and content. I feel like this allowed me to make the Application more consistent on the front end. 
