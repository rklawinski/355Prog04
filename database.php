<?php
class Database 
{
	

	// 000webhost variables
	private static $dbName = 'id7405003_jrklawin355wi19'; 
	private static $dbHost = 'localhost' ;
	private static $dbUsername = 'id7405003_jrklawin355wi19';
	private static $dbUserPassword = 'roman123';

	private static $dbConnection  = null;
	
	public function __construct() {
		exit('Init function is not allowed');
	}
	
	// Returns instance of PDO class
	public static function connect()
	{
	   // One connection through whole application
       if ( null == self::$dbConnection )
       {      
        try 
        {
          self::$dbConnection =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword);  
        }
        catch(PDOException $e) 
        {
          die($e->getMessage());  
        }
       } 
       return self::$dbConnection;
	}
	
	public static function disconnect()
	{
		self::$dbConnection = null;
	}
}
?>