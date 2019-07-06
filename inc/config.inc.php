<?php


class DB{

	public $sql;
	public $datab;
	public $connected;

	public function connect(){

		$this->datab = parse_ini_file('database.ini.php');

		$this->sql = new mysqli($this->datab['host'], $this->datab['username'], $this->datab['password'], $this->datab['database']);
		
	    $this->sql->set_charset('utf8');
	    
	}

	public function query($quete){

		$this->connect();

		return $this->sql->query($quete);

	}

	public function prepare($quete1){

		$this->connect();

		return $this->sql->prepare($quete1);

	}
	public function secret($queten){

		$this->connect();

		return $this->sql->real_escape_string(htmlspecialchars($queten));

	}

}

?>