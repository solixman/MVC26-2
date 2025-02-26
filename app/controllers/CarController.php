<?php 


class CarController{

private  $car;

public function  __construct()
{
$this-> car = new Car;    
}

public function create($mark,$model,$milage){
    $this->car->create($mark,$model,$milage);
    include('../views/Showcars.php');
}




}


?>