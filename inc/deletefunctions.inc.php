<?php
class Delete{

	public $db;

	public function __construct(){

		$this->db = new DB();

	}

	public $comment_id;
	public $session_id;

	public function DeleteComment($commentid,$sessionid){

		$this->db->connect();

		$this->comment_id = $this->db->secret($commentid);
		$this->session_id = $this->db->secret($sessionid);

		$fixrank = 2;


		$checkfirst = $this->db->prepare("SELECT * FROM users WHERE steam_id = ? AND rank >= ?");
		$checkfirst->bind_param("ss", $this->session_id, $fixrank);
		$checkfirst->execute();
		$checkfirst->store_result();

		if($checkfirst->num_rows == 1){

			$deletecomment = $this->db->prepare("DELETE FROM match_comments WHERE id = ?");
			$deletecomment->bind_param("i", $this->comment_id);

			if($deletecomment->execute()){
				
			}

		}
	}



}
?>