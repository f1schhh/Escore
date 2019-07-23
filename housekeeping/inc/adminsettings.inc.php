<?php
class AdminSettings extends DB{

	public function AdminMeny(){
		return '

		        <li><a href="home.php">Hem</a></li><br />
                <li><a href="controllmatches.php?page=1">Hantera matcher</a></li><br />
                <li><a href="stats/">Hantera spelare</a></li><br />
                <li><a href="stats/">Hantera lag</a></li><br />

		';
	}
}