<?php
class Classname
 {
   public $message = "The big brown fox... jumped....";

   function showMessage()
    {
      echo $this->message; // Will output whatever value 
                           // the object's message variable was set to
    }
  }

$my_object = new Classname();  // this is a valid object
$my_object->message = "Hello World!";
$my_object->showMessage();  // Will output "Hello world"
?>
