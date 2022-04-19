<?php

class keukentype {

    private $connection;

    public function __construct($connection) {
        $this->connection = $connection;
    }
  
    public function selecteerKeukenType($record_type) {

        $sql = "select * from keukentype where id = $record_type";
        
        $result = mysqli_query($this->connection, $sql);
        $keukentype = mysqli_fetch_array($result, MYSQLI_ASSOC);

        return($keukentype);

        
    }






}
?>