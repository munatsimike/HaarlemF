<?php
ob_start();
include_once 'DAL.php';
include_once 'controller.php';
require_once 'JazzTicket.php';
require_once 'timetable.class.php';
require_once 'MultipleEventTicket.class.php';
$Jazz_landing_Page = 'index.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>home</title>
		<style>
table {
  margin-bottom: 7px;
}
th, td {
  padding: 4px;
}
.centerTitle,.centerPrice,.centerDespription{
	text-align: center;
	font-size: 17px;

}
.centerTitle{
	font-weight: bold;
	font-size: 19px;

}

.button1,.multiple_event_btn {
	padding: 5px 22px;
	background-color: #4CAF50;
  color: white;
	font-size: 14px;
	border-radius: 7px;
	font-weight: bold;
	border-color: #4CAF50;
}
.multiple_event_btn{
	width: 180px;
	font-size: 20px
}
.quantity{
	font-size: 14px;
	text-align: center;
}
.artist{
	font-size: 21px;
	font-weight: bold;
		line-height: 50%;
}
.seats_label{
	font-weight: bold;
	font-size: 16px;
}
.aside {
		float:  right;
		border: 2px solid;
		margin: 5px;
		width: 27%;
		border-color: #B45F0A;
}
.timetablerow{
	text-indent: 15%;
	line-height: 50%;
}
main{
	width: 80%;

}
.section{
	border: 1px solid;
	border-color: #B45F0A;
	width: 71.5%;
	border-radius: 12px;
	background-image: url(img/jazz1.jpg);
	background-repeat: no-repeat; repeat;
	background-size: 100% 100%;
	background-position: center;

}
.ticketForm{
	margin: 6px;
	margin-top: 0px;

}
.eventHeading,.otherEventsHeading{
	background-color: #B45F0A;
	padding: 20px;
	margin-left: 5px;
	margin-right: 5px;
	margin-bottom: 0px;
	text-align: center;
	color: #fff;
	opacity: 0.8;
}
.artist{
	line-height: 50%;
}
.indentvenue{
	text-indent: 10%;
		line-height: 50%;
			margin-top: 0%;
			padding-top: 0px;
}
.date{
	line-height: 50%;
	margin-bottom: 3%;
	margin-left: 25px;
}
.ttable{
	text-align: center;
	font-size: 29px;
}
.cheapTicketsh2{
	background-color: #5D1C5C;
	padding: 20px;
	margin-left: 5px;
	margin-right: 5px;
	margin-top: 5px;
	margin-bottom: 0px;
	text-align: center;
color: white;
}
.otherEvents{
	width: 71.5%;
	margin-top: 15px;
	height: 476px;


}
.column{
	border: 1px solid;
	border-color: #B45F0A;
	height: 250px;
	width: 250px;
	position: relative;
 text-align: center;
}
.otherEventstable{
	border-spacing: 30px 0px;
 margin: auto;
 margin-bottom: 50px;
}
.otherEventsCaption{
	font-size: 30px;
	font-weight: bold;
	padding: 20px;
}
.otherEventsHeading{
	background-color: #B45F0A;
	font-size: 20px;
	padding: 10px;

}
.findoutmore{
	position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
	width: 150px;
	color: #FFFF;
	background-color: #B0691F;
	font-size: 20px;
	padding: 6px;
	border-radius: 6px;
	border-color: #B45F0A;


}
</style>
</head>
<body>
<h1>HAARLEM FESTIVAL JAZZ PROGRAM </h1>
            <ul>
                <li><a href="?day=1" name="thursady">Thursday</a></li>
                <li><a href="?day=2" name="friday">Friday</a></li>
                <li><a href="?day=3" name="saturday">Saturday</a></li>
                <li><a href="?day=4" name="sunday">Sunday</a></li>
								<li><a href="index.php" name="Home">Home</a></li>

            </ul>

						<form>
								<p>
								<label for="">Sort by</label>
						    <input type="radio"name="sort" checked>
						    <label for="date"> Date </label>
						    <input type="radio"name="sort">
						    <label for="artist">Artist</label>
							</p>
						</form>
						 <a href="payment.php">Make payment</a>

						 <main class= 'body'>
						 <aside class="aside">
							 <h2 class ='cheapTicketsh2'>DISCOUNTED TICKETS</h2>

							 <?php
							 $model = new DAL();
							 $controller = new controller($model);
							 $tickets= $controller->GetAll_JazzTickets(); //tickets array
							 sort($tickets);
							 $venue = "";
							$ticket3 = new MultipleEventTicket(85, 200,'3 Day Pass','Access to all shows');
							$ticket3->PrintMultipleEventTicket();
							$ticket1 = new MultipleEventTicket(35, 150,'One Day Pass','Access to all shows for a single day');
							$ticket1->PrintMultipleEventTicket();
							 echo"<h2 class='ttable'>Time Table</h2>";
							 foreach ($tickets as $ticket) {
							 //get date and time from the database;
							 $endDate= $ticket["end"];
							 $startDate=$ticket["start"];
							 //get endtime
							 $end_time= date("H:i",strtotime($endDate));
							 //get date from date &  time from datetinme variable
							 $date = strtotime($startDate);
							 // get concert start time
							 $start_time =date("H:i",$date);
							 // get perfoming band;
							 $artist= $ticket['artist'];
							 $date = date('d M yy',$date);

							 $timeTable = new TimeTable($start_time,$end_time,$artist,"");
							 if($venue != $ticket['venue'] ){
								 $venue = $ticket['venue'];
								echo"<h2 class ='date'>$date</h2>";
								echo"<h3 class = 'indentvenue'>$venue</h3>";

							 }
							 $timeTable->PrintTimeTable();
						 }
						echo "</aside>";
						$id=0;
						$eventDate = $dateHeading="";
						 if(isset($_GET['day']) || isset($_GET['success'])){
							 if($_GET['day'] == '1'){
							 $eventDate = '26 Jul 2020';
							 $dateHeading = "Thursday".' '.$eventDate;
							 $id =1;
						 }elseif($_GET['day'] == '2'){
							 $eventDate = '27 Jul 2020';
							 $dateHeading = "Friday".' '.$eventDate;
							 $id =2;
						 }elseif($_GET['day'] == '3'){
							 $eventDate = '28 Jul 2020';
							 $dateHeading = "Saturday".' '.$eventDate;
							 $id =3;
						 }else{
							 $eventDate = '29 Jul 2020';
							 $dateHeading = "Sunday".' '.$eventDate.' - '. 'All Shows Free';
							 $id =4;
						 }
						 }
							if(isset($_POST['add_to_cart'])){
								$message = 'Item added to cart';
								$items = array(
									'id'			 => $_POST['id'],
									'artist'	 => $_POST['artist'],
									'venue' 	 => $_POST['venue'],
									'date' 		 => $_POST['date'],
								'start_time' => $_POST['start_time'],
									'end_time' => $_POST['end_time'],
									'quantity' => $_POST['quantity'],
									'price' 	 => $_POST['price']
								);
								$cart_items[] = $items;
								$items_data = json_encode($cart_items);
								setcookie('cart',$items_data,time()+3600);
								header('Location:buyTickets.php?day='.$id);


						}

				echo "<section class ='section'>";
				echo "<h2 class ='eventHeading'>$dateHeading</h2>";
				foreach ($tickets as $ticket) {
			    //get date and time from the database;
					$endDate= $ticket["end"];
			    $startDate=$ticket["start"];
			    //get endtime
					$end_time= date("H:i",strtotime($endDate));
			    //get date from date &  time from datetinme variable
			    $date = strtotime($startDate);
			    $start_time =date("H:i",$date);
			    $date = date('d M yy',$date);
					$jazz_ticket = new JazzTicket($ticket['name'],$ticket['Price'],$ticket['seats'],$start_time, $end_time, $ticket['venue'],$date,$ticket["ID"]);
					if($date == $eventDate){
					$jazz_ticket->PrintTicket();
				}
				}

				echo "</section>";
				ob_flush();
				?>
				<div class ='otherEvents'>
			    <table class = 'otherEventstable'>
			    	<caption class ='otherEventsCaption'>You may also like</caption>
			    	<tr>
			    		<th class ='otherEventsHeading'>
			          Historic Tour
			    		</th>
			    		<th class ='otherEventsHeading'>
			          Food
			    		</th>
			    		<th class ='otherEventsHeading'>
			    			Dance
			    		</th>
			    	</tr>
			    <tr>
			    	<td class="column">
			        <img  class="column" src="img/historic.jpg" alt="">
			    		<input type="submit" class="findoutmore" value="Find out more">
			    </td>
			    <td class="column">
			      <img class="column" src="img/food.jpg" alt="">
			    	<input type="submit" class="findoutmore" value="Find out more">
			    </td>
			    <td class="column">
			      <img class="column" src="img/dance.jpg" alt="">
			    	<input type="submit" class="findoutmore" value="Find out more">
			    </td>
			    </table>
				</div>
			</main>


</body>
</html>
