<?php

class boodschappen {

    private $connection;
    private $ingredient;

    public function __construct($connection) {

        $this -> connection = $connection;
        $this -> ingredient = new ingredient($connection);

    }
  

    private function ingredientOphalen($id){

        $ingredient_data = $this -> ingredient -> selecteerIngredient($id);

        return($ingredient_data);
    }

    private function totaalArtikelen($ingredient_data){

        foreach($ingredient_data as $ingredienten){
            $aantal_artikelen[] = (ceil($ingredienten["ingredient_data"]["hoeveelheid"] /= $ingredienten["artikel_data"]["hoeveelheid per verpakking"]));         
        }

        
        return($aantal_artikelen);
    }

    public function selecteerBoodschappen($id){

        $sql = "select * from recept where id = $id";

        $result = mysqli_query($this->connection, $sql);

        $boodschappen = array();
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

            $ingredient_data = $this->ingredientOphalen($row['id']);
            $boodschappen_lijst = $this -> totaalArtikelen($ingredient_data);
            $ingredient_naam = array_column($ingredient_data, "artikel_data") ;

            
        }
        $boodschappen[] = ["ingredient_namen" => $ingredient_naam, 
                           "hoeveelheid_boodschappen" => $boodschappen_lijst];

        return($boodschappen);
 

    }

}
?>