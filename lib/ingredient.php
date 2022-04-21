<?php

class ingredient {

    private $connection;
    private $artikel;


    public function __construct($connection) {
        $this-> connection = $connection;
        $this-> artikel = new artikel($connection);
    }

    private function artikelOphalen($artikel_id){
        $artikel_data = $this->artikel->selecteerartikel($artikel_id);

        return($artikel_data);
    }
    public function selecteerIngredient($recept_id) {

        $sql = "select * from ingredient where recept_id= $recept_id";
        
        $result = mysqli_query($this->connection, $sql);

        $ingredient = array();
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
        {   
            $artikel_data = $this->artikelOphalen($row['artikel_id']);
                
            $ingredient[] = array_merge($row, $artikel_data);

        }
                
        return ($ingredient);



        
    }
   

}









?>