
<?php
class controller{
private $DAL;

public function __construct($DAL){
	$this->DAL = $DAL;
}
//get all j
	public function GetAll_JazzTickets(){
		$result = $this->DAL->Get_All_Jazz_Tickets();
	return $result;
	}
}
