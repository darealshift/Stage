<?php

class Database
{
	private $server;
	private $database;
	private $username;
	private $password;

	function __construct($server, $database, $username, $password, $key)
	{
		$this->server = $server;
		$this->database = $database;
		$this->username = $this->encrypt($username,$key);
		$this->password = $this->encrypt($password,$key);

		//$this->conn($key);
	}

	public function CreateQuery($sql, $key){
		$conn = $this->conn($key);
		if($conn != ""){
			$result = $conn->prepare($sql);
			$result->execute();
			unset($conn);
			return $result;
		}
	}

	public function conn($key){
		$host = "mysql:host=$this->server;dbname=$this->database;charset=utf8";
		$options = [
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			PDO::ATTR_EMULATE_PREPARES => false
		];

		try{
			$pdo = new PDO($host, $this->decrypt($this->username, $key), $this->decrypt($this->password, $key), $options);
			$_SESSION['Alerts'] = ("succes"."Connected"."to: `<b>`".$this->database."`</b>`");

			// $_SESSION['Alerts']->NewAlert("succes", "Connected", "to: `<b>`".$this->database."`</b>`");
			return $pdo;
		}
		catch(PDOException $e){
			$_SESSION['Alerts'] = ("danger"."Could not connect"."SOMETHING WONG: `<span>".$e->getMessage()."</span>`");

			// $_SESSION['Alerts']->NewAlert("danger", "Could not connect", "SOMTHING WONG: `<span>".$e->getMessage()."</span>`");
			return "";
		}
	}

	protected function encrypt($data, $key) {
    	$encryption_key = base64_decode($key);
	    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
	    $encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);
	    return base64_encode($encrypted . '::' . $iv);
	}

  protected function decrypt($data, $key) {
    	$encryption_key = base64_decode($key);
    	list($encrypted_data, $iv) = explode('::', base64_decode($data), 2);
    	return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
  	}
}

//session_start();
//$_SESSION['Alerts'] = "";
//session_destroy();

?>
