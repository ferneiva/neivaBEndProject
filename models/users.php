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

}
	