<?php

/*********************************************************************
* Author: Roudy Courser
* Assignment: WE4.0 PHP Web App Assignment, Digital Skills Academy
* Student ID: D15128554
* Date : 2016/05/22
* Ref: 	Assistance from fellow students Brian Conlon & Callum McLeman
		Video Tutorial https://www.youtube.com/watch?v=PLay55FdhR8
**********************************************************************/

//this is the link to open the door for the instaniated $obj below accessing the User class file
include('User.class.php');
  
// name of new class which is included in the file name
class LogIn 
{
			
	// VARIABLE attributes
	// is this the correct place to hard code db user and pass?
	private $dbUsname;
	private $dbPassword;
	private $usname;
	private $paswd;

	// CONSTRUCTOR
	// take the input from the html page via the $_POST where the instantiated object class accesses these inputs through two methods (functions) listed in the methods section of the class
    public function __construct()
    {
        // set the VARIABLES
        // this is the hard coded data being referenced by the new Obj (via $this) and cross referenced with the user input ($Obj->setUserNameInput($_POST['username']);) and validated in the GETTER method getMyData ($this->usname == $this->dbUsname)
        $this->dbUsname = "Peter";
		$this->dbPassword = "test1";
    }

    // SETTERS methods
    // functions inside a class are methods
    // setters only have a scope of local
	public function setUserNameInput ($feedDog) // end of the tunnel
	{
	// the user input in a new Obj via $_POST (method call at the bottom of the class) "feedDog" and in turn is defined to the new Obj $usname
	$this->usname = strip_tags($feedDog);
	}
	
	public function setUserPassInput ($feedCat) // end of the tunnel
	{
	// ditto from setUserNameInput
	$this->paswd = strip_tags($feedCat);
	}

	// GETTERS
	public function getMyData()
	{
			// instantiate an object set to User.class.php
			$obj = new User();				   
			// validate Obj setters data to Obj variables in the constructor	
			if ($this->usname == $this->dbUsname && $this->paswd == $this->dbPassword)
			{			
			// the two echoes come from the User.class.php functions getPassed and getFailed
			$obj->getPassed();				
			} else { 			
					$obj->getFailed();			
					}
	}
}
			
//////////////////////////////////////////////////
// call the method from the class via a new object
// and call them in order that follows logical processing e.g. need input before validation
$Obj = new LogIn();
// the $_POST is in the html form method="post" and this is the users input data
// start of the tunnel
$Obj->setUserNameInput($_POST['username']);
// start of the tunnel
$Obj->setUserPassInput($_POST['password']);
// cross check input data to hard coded data
$Obj->getMyData();
//////////////////////////////////////////////////

?>			


