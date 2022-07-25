<?php

class Database{

    protected $server_name = 'localhost';
    protected $user_name = 'root';
    protected $password = '';
    protected $db_name = 'test';
    public $conn;
    public $conn_error;

    public function __construct() {

        // Create connection
        $this->conn = mysqli_connect($this->server_name, $this->user_name, $this->password, $this->db_name);
        // Check connection
        //echo 'connection works';
        if (!$this->conn) {
        die("Connection failed: " . mysqli_connect_error());
        }
    }

    function __destruct() {
      mysqli_close($this->conn);
    }

    public function execute_query($query){

        if (mysqli_query($this->conn, $query)) {

            return true;

          } else {

            $this->conn_error = mysqli_error($this->conn);
            return false;
            
          }
    }
  
    public function get_user_by_id($user_id){

      $query = "SELECT * FROM `users` where `id` = '".$this->clean($user_id)."'";

      $result = mysqli_query($this->conn,$query);

      $row = array();

      if($result){
        $row = mysqli_fetch_assoc($result);
        return $row;
      }else{
        return $row;
      }

    }

    public function fetch_record($sql){

      $result = mysqli_query($this->conn, $sql);
      
      $data = array();
      
      while($rows = $result->fetch_object()){
        $data[] = $rows;
      }
      
      $result->free_result();
      
      return $data;
    }



    function clean($data)
    {
        $data = htmlspecialchars($data);
        $data = stripslashes($data);
        $data = trim($data);
        return $data;
    }



}


?>