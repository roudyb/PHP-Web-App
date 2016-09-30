<?php


//start class

class FoodArray {



//create a private variable

//that can't be accessed outside

//of this class

private $foodValue;



//add a 'setter' method to allow you to turn

// the private function into a public function

//that can be accessed outside of the class.

//This allows you to set the value outside of

//the class replacing ($x).

public function setFoodValue($x){

    $this->foodValue=$x;

}



//create a 'getter' method allow you

//to return the the $foodValue variable

public function getFoodValue(){

    return $this->foodValue;

}


    }//end of class


///////////////////////////////////////


//tell PHP to get the input from

//the html file using $_GET

//keep this out of the class

$foodNumber = $_GET['foodNumber'];



//create your food array

$foodArray = array ("Salad", "Vegetables", "Pasta", "Pizza", "Burgers");


//create your drink array

$drinkArray = array ("Water","Coke", "Spirte", "Wine", "Beer");


///////SETTING FOOD ARRAY///////


//create an object from the

//class FoodArray

$foodObject = new FoodArray;


//SET $foodObject values pull from $foodArray

$foodObject->setFoodValue($foodArray);


//set $foodObjectArray to getFoodValue

//which is from the class FoodArray

$foodObjectArray= $foodObject->getFoodValue();


///////SETTING DRINK ARRAY///////


//create an object from the

//class FoodArray

$drinkObject = new FoodArray;


//SET $drinkObject values to  pull from $drinkArray

$drinkObject->setFoodValue($drinkArray);


//set $drinkObjectArray to getFoodValue

//which is from the class FoodArray

$drinkObjectArray= $drinkObject->getFoodValue();


///////ECHO OUT VALUE BASED ON INPUT

///////FROM HTML FORM


//echo array of inputted position to screen

    echo "The number you chose is ". $foodNumber."<br>";

    echo "The food item you choose is ".$foodObjectArray[$foodNumber]."<br>";

    echo "The drink item you choose is ".$drinkObjectArray[$foodNumber];


?>
