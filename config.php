
<?php
class config{
private $servername;
private $username;
private $password;
private $dbhname;

public function Connect(){
		$this->servername = "localhost";
		$this->username = "root";
		$this->password = "";
		$this->dbhname = "haarlem_f";

		$conn = new mysqli($this->servername,$this->username,$this->password,$this->dbhname);

		if (!$conn) {
			die ("connection failed ".mysqli_connect_error());
		}
		return $conn;
	}
}
?>
