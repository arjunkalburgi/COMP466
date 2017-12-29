
1. fill the course/lesson/quiz/unit dbs with something???? 

2. make the quiz templates 	

3. code cleanup as much as possible.


1. EML (google), one for each db - learning about The Taxonomy Project yay 
2. dbs, unit+lesson+quiz -- course,unit
	break eml into dbs, make quizes 
	
	the table each row contains information for a lesson or quiz, including the
	actual content written in your EML. To make the learning contents retrievable and manageable,
	you will need fields to identify the course and the unit the lesson or quiz belongs to. 

	    $createcoursestable = "CREATE TABLE courses (
	        id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	        courseTitle varchar (30) NOT NULL
	        )";

	    $unitstable = "CREATE TABLE units (
	        id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	        title varchar (30) NOT NULL,
	        contributors varchar (3000) NOT NULL,
	        abstract varchar (3000) NOT NULL,
	        courseID_Ref int NOT NULL REFERENCES course(id)
	        )";

	    $createlessontable = "CREATE TABLE lessons (
	        id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	        title varchar (30) NOT NULL,
	        content varchar (3000) NOT NULL,
	        quizID_Ref int NOT NULL REFERENCES quiz(id),
	        unitID_Ref int NOT NULL REFERENCES unit(id),
	        courseID_Ref int NOT NULL REFERENCES course(id)
	        )";

	    $createquiztable = "CREATE TABLE quizzes (
	        id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	        question  varchar (50) NOT NULL,
	        answer varchar (50) NOT NULL
	        )";


3. parser, eml->php
