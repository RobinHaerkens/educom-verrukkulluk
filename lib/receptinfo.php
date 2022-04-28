<?php

class receptinfo {

    private $connection;
    private $user;


    public function __construct($connection) {
        $this-> connection = $connection;
        $this-> user = new user($connection);
    }

    private function userOphalen($user_id){
        $user_data = $this->user->selecteerUser($user_id);

        return($user_data);
    }
    public function selecteerReceptinfo($recept_id, $record_type) {

        $sql = "select * from receptinfo where recept_id= $recept_id and record_type = '$record_type'";
        
        $result = mysqli_query($this->connection, $sql);

        $receptinfo = array();
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
        {

            if($record_type == "O" || $record_type == "F"){
            
                $user_data = $this->userOphalen($row['user_id']);
                

                $receptinfo[] = ["recept_user_info" => $row, 
                                "user_info" => $user_data];
            }else{
                $receptinfo[] = $row; 
            }
                
            
        }

        

        return ($receptinfo);



        
    }
   

}









?>