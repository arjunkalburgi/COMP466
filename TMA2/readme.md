ASSIGNMENT REPORT  
=======

(Note: I found the required documentation formatting a little redundant so I formated it in my own way between this file and the tma2.htm file. Sorry!)


# PART 1 
I'm personally really proud of this application. I refactored the code to make it really clean and the project structure is also really nice. 

### APPLICATION INTERFACE 
On the front end, I kept the materializecss library from TMA1. Including the lightnight bolt in the navbar as the logo. I didn't worry too much about how the app looks thanks to it. It's consistent and professional without the work. What I did do was make sure that the app strucutre worked with materializecss well. index.php shows that the app is consistent with every page, I just swap out the content when users click links instead of changing the page (see main_content.php and bookmark.php). 

I chose to go with a single page style for the main bookmarking application instead of multiple pages. I felt this was cleaner and more uniform for the user. The user does not care about forms being in their own page, being able to see everything in one view gives a much better experience. Doing this introduced a challenge that some parts of the page wouldn't get updated, but by simply reloading the page from php (see this in create_bookmarks.php and update_bookmarks.php) this was fixed.

### WALKTHROUGH
The app codebase is quiet easy to read thanks to it's structure. First start with the index.php which will lead you to the main_content.php file. Here it shows the logic for what content the user will see. 

The user will see authentication flow first, which is all contained in the authentication/ folder. In the login file there's a link to the register file incase the user does not have an account. 

Once signed in, the user will be shown bookmarks (again from main_content.php file) where the user can do a number of actions in a very simple layout thanks to the use of buttons and icons on the listview. 

### DOCUMENTATION
Most files are structured the same way, with PHP logic at the top and the HTML/form content at the bottom. The PHP logic mostly follows the same structure of: 1. Was there a post request? 2. Do _blocka_ if so, or _blockb_ if not. Each form is made to submit it's request to the same page, this consistency helps us as developers understand the logic of each page separately and thus make more use of the file name for our conceptual model of the app. 

Often times the logic portion of the page interfaces with the database, which gets it's own folder since it's implemented like it's own package. This folder contains a lot of callable functions for those pages as well as the initialize and connect functionality for startup of the app. 

Just like in the previous assignment, the materializecss library does a lot to help the HTML/form content portion of the page. The form is automatically validated thanks to materializecss! 

### SET UP
Need to set up SQL. Go to database/connect.php and make sure line 7 has all the information for your sql server (leave the db name as mysql). Then just load the app and it should make all the tables for you. 


# PART 2 
Part 2 was done a lot more hastily after extending my course for the final time. I found it really difficult to understand why we were required to create our own EML. It took a lot of extra time and effort and didn't really learn much. 

### SYSTEM DESIGN AND ANALYSIS
The structure and design of Part 2 was copied and modified from Part 1. authentication/ was removed and bookmarks/ was modified to app/. 

Unlike Part 1, the layout of Part 2 is not nearly as appealing, though is totally functional. Unfortunately materializecss didn't have built in elements for the design I wanted, and I chose to not build them myself under my time constraints. 

There are a lot more things that can be improved about the app apart from this. I read a study on the usefulness of online tutorials and why users use them and I wish I had the time to include what was learned there in this app. It talked about how important pictures and a comments section is. 

### EDUCATIONAL MARKUP LANGUAGE 
I built my EML by working backwards. I found a textbook in XML (see assets/orig.xml), The NCBI Handbook, then condensed and modified it into my EML (see assets/courses.xml) by turning "book-part"s into courses, the nested "book-part"s into units and sections into lessons. It quickly resulted in 140 lessons over 18 units over 4 courses. Doing this only left for the creation of 140 quizzes to go along with each lesson. As far as the EML goes, this was the most time consuming and unfortunate part. 

### DATABASE DESIGN
So because the EML was created the way it was and was sanitized so purfusely, creating the database for it was quite straightforward. The best way to see how this was done is from the helper.php file, specifically the xml2db functions. The id of the parents are passed into the tables of the child, so that each can be categorized. When it came to the quiz, it was chosen that the quiz db will contain the lessonid. This made it easier to implement on the front end. It actually used to be the opposite way, but I flipped it when making the front end.

### PARSER
The original xml file I used had a lot more detail than was neccesary for our app (breaking down sections into further sections and text into p tags, etc). Leaving it this way would actually completely break the xml2db function, since the simplexml functions used to parse the file would try to break them down as well. To avoid this, I modified all the open brackets for every tag in the lesson to '{{{', this way the simplexml would not be able to read it as a tag. Before displaying the content, I pass the content string through a string replace function to convert it back to the open bracket. Thus successfully parsing the content to a readable format. This works great because it preserves a lot of the original xml's formatting! 

### IMPLEMENTATION / SET UP
Like Part 1, SQL needs to be set up. Go to database/connect.php and make sure line 7 has all the information for your sql server. 

Upon initial run of the application, make sure resetdbs() in database/init.php takes in a true. This will trash, create and fill up all the database tables for the app. After the initial run, it can be modified to false so that the databases remain for use. Currently the function is called when there is no table for courses, since creation and deletion is done at the same time (when done programatically) checking if one of the tables exists effectively checks them all. 



