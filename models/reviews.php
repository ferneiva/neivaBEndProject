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
			ON T2.user_id = reviews.user_id
		");
		
		$query->execute();
		
		return $query->fetchAll();
	}
	public function getReviewsByUserReviewd($user_id) {
		
		$query = $this->db->prepare("
		SELECT 
			reviews.review_id,reviews.user_id AS reviewerID,
			t2.name AS userReviewerName,
			reviews.review_text, reviews.rating,
			reviews.review_date,
			t1.name AS userReviewedName
		FROM reviews
		INNER JOIN reviews_users WHERE reviews_users.user_id = ?
		INNER JOIN users AS t1
		ON reviews_users.user_id = t1.user_id
		INNER JOIN users AS t2
			ON t2.user_id = reviews.user_id
		");
		
		$query->execute();
		
		return $query->fetchAll();
	}
}