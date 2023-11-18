<?php
// models/emails
class Emails extends Base{

    public function create($data){
        
        $query = $this->db->prepare("
			INSERT INTO emails
			(user_id, to_id, subject, message, sender_email, receiver_email)
			VALUES(?, ?, ?, ?, ?, ?)
		");
		$query->execute([
			$data["user_id"],
			$data["to_id"],
			$data["subject"],
			$data["message"],
			$data["sender_email"],
			$data["receiver_email"]
		]);
		$data["user_id"]= $this->db->lastInsertId();
		
		return $data;

	}
}