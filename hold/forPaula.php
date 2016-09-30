<?php

/**********************************************************
* Author: Roudy Courser
* Assignment: WE4.0 PHP Web App Assignment, Digital Skills Academy
* Student ID: D15128554
* Date : 2016/05/22
* Ref: website link to code referenced or the book, authors name and page number
***********************************************************/

//this is the link to open the door for the instaniated $obj below accessing the User class file
include('.class.php');
  
// name of new class which is included in the file name
class LogIn 
{
			
	// VARIABLE attributes
	// is this the correct place to hard code db user and pass?
	private $#####;
	private $#####;
	private $#####;
	private $#####;

	// CONSTRUCTOR
	// take the input from the html page via the $_POST where the instantiated object class accesses these inputs through two methods (functions) listed in the methods section of the class
    public function __construct()
    {
        // set the VARIABLES
        // the new obj is pointing to usname/paswd that both are defined to the class methods via the new obj pointing to each method
        $##### = "";
		$##### = "";
        $this->##### = $this->#####();
        $this->##### = $this->#####();
    }

    // METHODS
    // functions inside a class are methods
    // the $_POST is in the html form method="post"
	public function userNameInput ()
	{
	$##### = strip_tags($_POST['username']);
	}
	
	public function userPassInput ()
	{
	$##### = strip_tags($_POST['password']);
	}	
	
    // SETTERS ?

	// GETTERS
	public function getMyData()
	{
		// change to reference a variable from above
		if ($this->##### && $this->#####)
		{
			$obj = new User();				   
			// y$this-> in front of variables  e.g. $this->usname	
			if ($this->$##### == $d##### && $this->$##### == $#####)
			{			
			$obj->getPassed();				
			} 	else { 			
					 $obj->getFailed();			
					 }										
		}
	}
}
			
///////////////////////////////////////
// call the method from the class via a new object
$Obj = new LogIn();
$Obj->getMyData();

///////////////////////////////////////
?>			


