<?php

require_once("base.php");

class Providers extends Base
{
	public function getAll() {
		
		$query = $this->db->prepare("
			SELECT 
				provider_id, name , country, city, urban_zone, skills, religion, ethnicity, resume
            FROM
				providers
			
		");
		
		$query->execute();
		
		return $query->fetchAll();
	}
	
}

class Provider extends Base
{
	
	public function getDetail($id) {

		$query = $this->db->prepare("
			SELECT
				*
			FROM
				providers
			WHERE
				provider_id = ?
		");

		$query->execute([
			$id
		]);

		return $query->fetch();
	}
}

	