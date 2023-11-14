<?php

require_once("base.php");

class Reviews extends Base
{
	public function getReviews() {
		
		$query = $this->db->prepare("
		SELECT 
			reviews.review_id,reviews.user_id AS reviewerID,
			t2.name AS userReviewerName,
			reviews.review_text, reviews.rating,
			reviews.review_date,
			t1.name AS userReviewedName
		FROM reviews
		INNER JOIN reviews_users USING (review_id)
		INNER JOIN users AS t1
			ON reviews_users.user_id = t1.user_id
		INNER JOIN users AS t2
			ON t2.user_id = reviews.user_id
		");
		
		$query->execute();
		
		return $query->fetchAll();
	}
	public function getReviewsByUserReviewed($user_id) {
		
		$query = $this->db->prepare("
		SELECT 
			reviews.review_id,reviews.user_id AS reviewerID,
			t2.name AS userReviewerName, t2.user_type AS reviewerType,
			reviews.review_text, reviews.rating,
			reviews.review_date,
			t1.name AS userReviewedName,
			t1.user_type,
			reviews_users.user_id AS ReviewedID
		FROM reviews
		INNER JOIN reviews_users USING(review_id)
		INNER JOIN users AS t1
			ON reviews_users.user_id = t1.user_id
		INNER JOIN users AS t2
			ON t2.user_id = reviews.user_id
		WHERE reviews_users.user_id = ?
		");
		
		$query->execute(
			[$user_id]
		);
		
		return $query->fetchAll();
	}
	public function postReviewByReviewer($data){
		$query = $this->db->prepare("
        INSERT INTO reviews
        (user_id, review_text, rating)
        VALUES(?,?,?)
		");
		$query -> execute([
			$data["user_session_id"],
			$data["reviewContent"],
			$data["rating"]
		]);	
		return $this->db->lastInsertId();						
	}
	public function reviewLink($data){
		$query = $this->db->prepare("
        INSERT INTO reviews_users
        (review_id, user_id)
        VALUES(?,?)

		");
		$query -> execute([
			$data["review_id"],
			$data["user_reviewed_id"],
		]);								
	}
	public function getAvgRatingsByUser($user_id) {
		$query = $this->db->prepare("
		SELECT
			AVG(rating) AS userAverageRating,
			reviews_users.user_id as ReviewedUser
		FROM reviews
		INNER JOIN reviews_users USING (review_id)
		WHERE reviews_users.user_id=?
		
		");
		$query -> execute([
			$user_id
		]);	

		return $query->fetch();
	}
	public function deleteReview ($id, $user_id){
        $query =$this->db->prepare("
        DELETE FROM reviews
        WHERE review_id = ?
		AND user_id = ?
        ");
        return $query->execute([
			$id,
			$user_id

		]);
    }
	

}