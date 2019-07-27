<?php
class AdminAdd extends DB{

	public $team1;
	public $team2;
	public $status;
	public $map;
	public $starttime;
	public $startdate;
	public $league;
	public $year;

	public function addMatches($team1,$team2,$status,$map,$starttime,$startdate,$league){

		$DB = new DB();
		$DB->connect();

		$this->team1 = $DB->secret($team1);
		$this->team2 = $DB->secret($team2);
		$this->status = $DB->secret($status);
		$this->map = $DB->secret($map);
		$this->starttime = $DB->secret($starttime);
		$this->startdate = $DB->secret($startdate);
		$this->league = $DB->secret($league);
		$this->year = date("Y");
		$matchid = rand(10000,999999);
		$score = "not started";
		$mvp = "";
		$id = null;

		$addMatch = $DB->prepare("INSERT INTO matches (id,matchid,starttime,starttdate,startyear,team1,team2,match_status,map,score,league,mvp) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");
		$addMatch->bind_param("ssssssssssss", $id,$matchid,$this->starttime,$this->startdate,$this->year,$this->team1,$this->team2,$this->status,$this->map,$score,$this->league,$mvp);

		if($addMatch->execute()){

			echo "Matchen är nu tillagd!";

		}else{
			printf("Error: %s.\n", $addMatch->error);
		}

	}

}
?>