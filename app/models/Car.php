<?php

include_once('../app/core/db/Database.php');


class Car{
    private $ID;
    private $mark;
    private $model;
    private $milage;
    


    public function __construct()
    {
       
    }

    public function getID()
    {
        return $this->ID;
    }
    public function GetMark()
    {
        return $this->mark;
    }
    public function GetModel()
    {
        return $this->model;
    }

    public function GetMilage()
    {
        return $this->milage;
    }


    public function SetId($id)
    {
        $this->ID = $id;
    }

    public function setModel($mdl){
        $this->model=$mdl;
    }

    public function SetMark($mark)
    {
        $this->mark = $mark;
    }

    public function Setmilage($miles)
    {
        $this->milage = $miles;
    }
    
    public function create($mark,$model,$milage)
    {
       

        try {

            $query = " INSERT INTO  cars (mark,model,milage)  VALUES  (".$mark.",".$model.",".$milage."); ";

            $stmt = Database::getInstance()->getConnection()->prepare($query);
            $stmt->execute();
             echo "Data created successfully!";
        } catch (PDOException $e) {  
            echo "Error: " . $e->getMessage();
        }
    }





    public function delete( $id)
    {

        try {

            $query = " DELETE FROM  cars WHERE id = " . $id . ";";

            $stmt = Database::getInstance()->getConnection()->prepare($query);
            $stmt->execute();
             echo "Data deleted successfully!";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }



    public function update($tablename, $id, $params)
    {
        $columns = [];
        $values = [];
        $SET = [];
        $combined = [];

        foreach ($params as $key => $value) {
            if (gettype($value) == "integer" || gettype($value) == "double") {
                array_push($columns, $key);
                array_push($values, $value);
            } else {
                array_push($columns, $key);
                array_push($values, "'" . $value . "'");
            }
        }

        $combined = array_combine($columns, $values);
        //
        foreach ($combined as $key => $value) {
            array_push($SET, $key . "=" . $value); 
        }
        // var_dump($combined);
        // var_dump($SET);
        try {
            $query = "UPDATE cars SET  " . implode(",", $SET) . " WHERE id = " . $id . ";";
            // var_dump($query);
            $stmt = Database::getInstance()->getConnection()->prepare($query);
            $stmt->execute();
             echo ("data updated succefully");
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }



     public function getAll($tablename){
      
        try{
            $query="SELECT * FROM  cars ;";
            $stmt = Database::getInstance()->getConnection()->prepare($query);
            $stmt -> execute();
            // var_dump($query); 
            $result = $stmt->fetchall(PDO::FETCH_CLASS,substr($tablename,0,-1));
            // var_dump($result);
            // die();
            return $result ;
        }catch(PDOException $e){
            echo("Error:" . $e);
        }
     } 
    
}

    





?>