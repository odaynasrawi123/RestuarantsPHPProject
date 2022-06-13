<?php
  class dbClass
  {
    private $host;
    private $db;
    private $charset;
    private $user;
    private $pass;
    private $opt = array(
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
    protected $connection;

    //Main constructor with default parameter values
    public function __construct(string $host= "localhost", string $db = "restuarantsDb",
      string $charset = "utf8", string $user = "IssaMish", string $pass = "pass")
    {
      $this->host = $host;
      $this->db = $db;
      $this->charset = $charset;
      $this->user = $user;
      $this->pass = $pass;
    }

    //connect to the DataBase
    protected function connect()
    {
      //Connection dns
      $dns = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
      //Create connection
      $this->connection = new PDO($dns, $this->user, $this->pass, $this->opt);
    }

    //disconnect from the DataBase
    protected function disconnect()
    {
      $this->connection = null;
    }
  }
?>