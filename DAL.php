
<?php
include_once 'config.php';
$dbconn = new config();
$conn = $dbconn->Connect();
class DAL{

// get all jazz tickets using a prepated statement;
	public function Get_All_Jazz_Tickets(){
		$sql = "SELECT *
						FROM ticket
						JOIN venue ON venue.venue=ticket.venue
						JOIN artist ON artist.name=ticket.artist";

		global $conn;
		$results = $conn->query($sql);
		$numRows = $results->num_rows;
		if($numRows > 0){
			while($row = $results->fetch_assoc()){
			$data[] = $row;
			}
			return $data;
		}
	}
}
