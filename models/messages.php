<?php

require_once("base.php");

class Messages extends Base
{
	public function createMessage($data){
        
        $query = $this->db->prepare("
			INSERT INTO messages
			(text)
			VALUES(?)
		");
		$query->execute([
			$data
			
		]);
		
		
		return $data;
	}
}