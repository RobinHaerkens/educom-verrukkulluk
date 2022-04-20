<?php

class receptinfo {

    private $connection;
    private $user;


    public function __construct($connection) {
        $this-> connection = $connection;
        
    }

  
    public function selecteerReceptinfo($recept_id, $record_type) {

        $sql = "select * from receptinfo where recept_id= $recept_id and record_type = '$record_type'";
        
        $result = mysqli_query($this->connection, $sql);

       
        $receptinfo = array();


        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
        {
            $receptinfo[] = $row;
        }
    

        return($receptinfo);



        
    }
   

}









?>