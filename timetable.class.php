<?php
class TimeTable{

private $start_time;
private $end_time;
private $artist;
private $date;

public function __construct($start_time,$end_time,$artist,$date){
 $this->start_time = $start_time;
 $this->end_time = $end_time;
 $this->artist = $artist;
 $this->date = $date;
}

 public function printTimeTable(){
echo "<p class = 'timetablerow'>$this->start_time - $this->end_time $this->artist $this->date</p>";
}




}


 ?>
