<?php

require_once("base.php");

class Users extends Base
{
	public function getAll() {
		
		$query = $this->db->prepare("
			SELECT 
				users.user_id, users.user_type, users.name ,
				countries.name AS countryName, users.city, users.urban_zone, users.skills, users.resume
            FROM
				users
			INNER JOIN countries
			ON countries.code = users.country
		
		
			
		");
		
		$query->execute();
		
		return $query->fetchAll();
	}
	

	
	public function getDetail($id) {

		$query = $this->db->prepare("
			SELECT
				*
			FROM
				users
			WHERE
				user_id = ?
		");

		$query->execute([
			$id
		]);

		return $query->fetch();
	}
	public function getByEmail($email){
        $query = $this->db->prepare("
        SELECT user_id, password
        FROM users
        WHERE email= ?            
		");
		$query->execute([$email]);
		return $query->fetch();
    }

	public function create($data){
        $api_key= bin2hex(random_bytes(16));
        $query = $this->db->prepare("
			INSERT INTO users
			(user_type, name, address, postal_code, city, urban_zone, country, phone, email, password, skills, resume, photo, api_key)
			VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
		");
		$query->execute([
			$data["user_type"],
			$data["name"],
			$data["address"],
			$data["postal_code"],
			$data["city"],
			$data["urban_zone"],
			$data["country"],
			$data["phone"],
			$data["email"],
			password_hash($data["password"], PASSWORD_DEFAULT),
			$data["skills"],
			$data["resume"],
			//$_FILES["photo"], // writes array on mysql gives error 302 
			$data["filename"], // writes nothing in mysql field gives error code 400 array and 302 
			$api_key
		]);
		$data["user_id"]= $this->db->lastInsertId();
		$data["api_key"]= $api_key;
		return $data;

	}

	
	public function delete ($id){
		$query =$this->db->prepare("
		DELETE FROM users
		WHERE user_id = ?
		");
		return $query->execute([$id]);
	}

	public function searchUsers (){
		$query =$this->db->prepare("
		SELECT city, urban_zone
		FROM users
		WHERE urban_zone = '%$search%' OR urban_zone = '%$search%'
		");
		return $query->execute();
	}






}
	