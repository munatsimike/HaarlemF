<?php
class TableData{

    private $day;
    private $id = 0;
    private $tickets;
    private $venue;
    private $btn;

  public function __construct($day, $tickets){
    $this->day = $day;
    $this->tickets =$tickets;

  }

  public function PrintTableData(){

    echo "<td class='column'>";
        // check for day
         if($this->day == 29){
           $this->venue = 'Grote Markt';
           $this->btn= 'Free for all';
         }else{
           $this ->venue = 'Patronaat Hall';
           $this->btn = 'Buy ticket(s)';
         }
         // print table data heading;
  			echo "<h2 class = 'indentvenue'>$this->venue</h2>";
  			foreach ($this->tickets as $ticket) {
  			//get date and time from the database;
  			$endDate= $ticket["end"];
  			$startDate=$ticket["start"];
  			//get endtime
  			$end_time= date("H:i",strtotime($endDate));
  			//get date from date &  time from datetinme variable
  			$date = strtotime($startDate);
        // get day from date
  			$day =  date("d", $date);
        // get concert start time
  			$start_time =date("H:i",$date);
        // get perfoming band;
  			$artist= $ticket['artist'];
        // check for day
  			if($day == $this->day){
  				echo "<p class ='artist'>$start_time-$end_time  $artist</p>";
  		   }


  }
  if($this->day == 26){
    $this->id = 1;
  }elseif($this->day == 27){
    $this->id = 2;
  }elseif($this->day == 28){
    $this->id = 3;
  }else{
    $this->id =4;
  }

  // display buy button;
  echo" <a href='buyTickets.php?day=$this->id'><input type='button'  class='buyticketbtn' value='$this->btn'> </a>
  </td>";
}
}
 ?>
