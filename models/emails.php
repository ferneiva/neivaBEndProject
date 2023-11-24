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

	public function emailsByUser($idSender){
        
        $query = $this->db->prepare("
		SELECT
			emails.email_id, emails.user_id AS senderId,
			emails.to_id AS receiverId, emails.subject AS emailSubject,
			emails.message, emails.sender_email,emails.receiver_email,
			emails.date,
			t1.name AS senderName, t2.name AS receiverName,
			t2.user_type AS userType
		FROM  emails 
		INNER JOIN users t1 ON emails.user_id = t1.user_id
		INNER JOIN users t2 ON emails.to_id = t2.user_id
		WHERE emails.user_id=?
		ORDER BY date DESC		
		");
		$query->execute([
			$idSender
		]);
		
		return $query->fetchAll();
		 


	}


}