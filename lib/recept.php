<?php

class recept {

    private $connection;
    private $keuken;
    private $type;
    private $user;
    private $ingredient;
    private $receptinfo;
    private $calorien;
    private $rating;
    private $prijs;
    
    public function __construct($connection) {
        $this-> connection = $connection;
        $this-> keuken = new keukentype($connection);
        $this -> type = new keukentype($connection);
        $this -> user = new user($connection);
        $this -> ingredient = new ingredient($connection);
        $this -> receptinfo = new receptinfo($connection);
    }

    private function keukenOphalen($keuken_id){

        $keuken_data = $this->keuken->selecteerKeukenType($keuken_id);

        return($keuken_data);
    }

    private function typeOphalen($type_id){

        $type_data = $this->type->selecteerKeukenType($type_id);

        return($type_data);
    }

    private function userOphalen($user_id){

        $user_data = $this->user->selecteerUser($user_id);

        return($user_data);
    }

    private function ingredientOphalen($id){

        $ingredient_data = $this -> ingredient -> selecteerIngredient($id);

        return($ingredient_data);
    }

    private function receptinfoOphalen($id, $record_type){

        $receptinfo_data = $this -> receptinfo -> selecteerReceptinfo($id, $record_type);

        return($receptinfo_data);

    }

    private function somCalorien($ingredient_data){


        $som_calorien = 0;

        foreach($ingredient_data as $value){

            $som_calorien += ($value["calorien"]*($value["hoeveelheid"] /= $value["hoeveelheid per verpakking"]));
        }

        return($som_calorien);
    }

    private function averageRating($rating_data){
    
        if(count($rating_data)== 0) return(0);
        $som_rating = 0;

        foreach($rating_data as $value){

            $som_rating += $value["nummeriekveld"];
        }

        $average_rating = $som_rating / count($rating_data);
        return($average_rating);
    }




    private function totaalKosten($ingredient_data){

        $kosten = 0;
        foreach($ingredient_data as $ingredienten){
            $kosten += (ceil($ingredienten["hoeveelheid"] /= $ingredienten["hoeveelheid per verpakking"])
            *$ingredienten["prijs"]) / 100;         
        }
    

        $total = $kosten;

        return($total);
    }

    public function selecteerRecept($id = null) {

        $extrasql = is_null($id) ? "" : " where id = $id";
        $sql = "select * from recept $extrasql";
        
        $result = mysqli_query($this->connection, $sql);

        $recept = array();
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

            $keuken_data = $this->keukenOphalen($row['keuken_id']);
            $type_data = $this->typeOphalen($row['type_id']);
            $user_data = $this->userOphalen($row['user_id']);
            $ingredient_data = $this->ingredientOphalen($row['id']);

            $rating_data = $this -> receptinfoOphalen($row['id'],"R");
            $favorieten_data = $this -> receptinfoOphalen($row['id'],"F");
            $bereiding_data = $this -> receptinfoOphalen($row['id'],"B");
            $opmerkingen_data = $this -> receptinfoOphalen($row['id'],"O");
            
            $som_calorien  = $this -> somCalorien($ingredient_data);
            $gemRating = $this -> averageRating($rating_data);
            $prijs = $this -> totaalKosten($ingredient_data);


            $recept[] = array_merge($row, array($keuken_data, $type_data),$user_data,$ingredient_data, $rating_data, $favorieten_data, $bereiding_data, $opmerkingen_data, array($som_calorien), array($gemRating), array($prijs));

        }

                
        return ($recept);



        
    }
   

}









?>