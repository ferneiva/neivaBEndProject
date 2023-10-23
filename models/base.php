<?php

class Base
{
	public $db;
	
	public function __construct() {
		
		$this->db = new PDO("mysql:host=localhost;dbname=help;charset=utf8mb4", "root", "");
	}
}
