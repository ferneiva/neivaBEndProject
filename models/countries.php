<?php
// models/countries.php
require_once("base.php");
class Countries extends Base
{
    public function get (){

        $query = $this->db->prepare("
            SELECT 
				code, name
			FROM
				countries
		");

		$query->execute();

		return $query->fetchAll();          

    }
    // public function getUserCountryName($id){
    //     $query = $this->db->prepare("
    //     SELECT 
    //     countries.name
    //     FROM
    //     countries
    //     INNER JOIN users
    //     WHERE countries.code = users.country AND users.user_id = ?
    //     ");

    // $query->execute([$id]);

    // return $query->fetchAll();  
        
    // }

    
}