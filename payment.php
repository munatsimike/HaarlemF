<?php
session_start();
require_once 'payment_validation.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>payment</title>
		<style media="screen">

		body{
		  margin-right: auto;
		  margin-left: auto;
		  max-width: 960px;
		}
			.paymentTh{
				text-align: left;
				background-color: #ECECEC;
			}
			.pyamentTable,td, th{
				border: 0px solid black;
				border-collapse: collapse;
				padding: 5px;



			}
			.label{
				  display: inline-block;
				  text-align: right;
				  width: 140px;
				  font-size: 18px;
					padding:0px;
			}
			.logo{
				margin-top: 4px;
				padding-top: 0px;
			}
			.headingh2{
				width: 100%;
				font-size: 22px;
				text-align: center;
			}
			.hrwidth{
				width: 100%;
				margin-left: 0px;
			}

			.cancelbtn  {
			  background-color: #dddd;
				border-color:  #ddd;
			  color: black;
			  padding: 11px 20px;
			  cursor: pointer;
			  font-size: 18px;
			  width: 200px;
			  height: 40px;
			  border-radius: 5px;
				margin-right: 80px;
			  display: inline-block;
			}
			.paymentbtn  {
			  background-color: #45a049;
				border-color: #45a049;
			  color: white;
			  padding: 11px 20px;
			  cursor: pointer;
			  font-size: 18px;
			  width: 200px;
			  height: 40px;
				margin-left: 80px;
			  border-radius: 5px;
			  display: inline-block;
}
.content{
	width: 67%;
	margin: auto;
	background-color: #ECECEC;
	padding: 30px;
}
.paymentbuttons{
	text-align: center;

}
.logo{
	display: block;
	margin: auto;
	  margin-top: -70px;
	  width: 30%;
}

.customerdetails{
	width:74%;
	margin: auto;
}
.required,.error{
    color:#FF0000;
}
hr{
	color:#BD6500;
}
		</style>

	</head>
	<body >
		<header>
		</header>
		<main class="paymentContent">
			<div class="content">
				<img class=logo src="/img/logo.png" alt="">
			<h2 class = 'headingh2'>Payment Form</h2>
		<table class='pyamentTable'  width = '100%'>
			<tr>
				<th class ='paymentTh' width = '10%'>
					Qty
				</th>
				<th class='paymentTh' width = '50%'>
					Description
				</th>
				<th class = 'paymentTh'width ='15%'>
					Unit price
				</th>
				<th class = 'paymentTh' width ='15%'>
					Total Price
				</th>
			</tr>
			<?php
			if(isset($_COOKIE['cart'])){
				$total_price = 0;
				$cookie_items = stripslashes($_COOKIE['cart']);
				$cookie_data = json_decode($cookie_items,true);
				foreach ($cookie_data as $key => $value) {
					$id = $value['id'];
					$artist = $value['artist'];
					$venue = $value['venue'];
					$date =  $value['date'];
					$start_time =  $value['start_time'];
					$end_time = $value['end_time'];
					$quantity = $value['quantity'];
					$price = $value['price'];
					$total_price += $quantity * $price;
					echo"
					<tr>
						<td class= 'items'>$quantity	</td><td class ='items'>$artist $date | $start_time $end_time</td><td class = 'items'>€ $price</td><td class = 'items'>€ $total_price</td>
					</tr>";
				}
				$tax = 0.15 * $total_price;
				$Total = $total_price + $tax;
			echo"
					<tr>
					<td></td><td></td><td><b></b></td><td></b></td>
					</tr>
					<tr>
					<td></td><td></td><td><b>SubTotal</b></td><td><b>€ $total_price</b></td>
					</tr>
					<tr><td></td><td></td><td>Tax 15%</td><td>€ $tax</td>
					</tr>
					<tr>
						<td></td><td></td><td><b>Total</b></td><td><b><hr>€ $Total <hr></b></td>
					</tr>";
			}else{
				echo 'cart empty';
			}
			 ?>
		</table>
<hr class ='hrwidth'>
<form class = 'customerdetailsform' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
	<section class = 'customerdetails'>
		<h3 class = "mandatory">Fields marked (<span class="required">*</span>) are mandatory</h3>
<h3 class="center">Customer Details</h3>
<p>	<label class = label for="">Name</label><span class="required">*</span>
	<input class=details type="text" name="name" value="" placeholder="John">
	<span class= 'error'><?php echo $name_err; ?></span></P>

<p>	<label class = label for="">Surname</label><span class="required">*</span>
	<input class=details type="text" name="surname" value="" placeholder="Smith">
	<span class= 'error'><?php echo $surname_err; ?></span></P>

	 <p><label class = label for="">Email</label><span class="required">*</span>
	<input class=details type="text" name="email" value="" placeholder="smith@gmail.com">
	<span class= 'error'><?php echo $email_err; ?></span></P>

	<p><label class = label for="">Verify email</label><span class="required">*</span>
	<input class=details type="text" name="confirm_email" value="" placeholder="smith@gmail.com">
	<span class= 'error'><?php echo $confirm_email_err; ?></span></P>

<hr class ='hrwidth'>
<h3 class = center>Select a payment method</h3>
<p class = radio>	<label for="pin">Pin</label>
<input  type="radio" name="card" value="" checked="checked">

<label for="visa">Visa</label>
<input  type="radio" name="card" value="">

<label for="amex">Amex</label>
<input type="radio" name="card" value=""></p>
<p>	<label class = label  for="">Card Number</label><span class="required">*</span>
	<input class = details type="text" name="cardNum" value="" placeholder="233 2332 4324 54">
</P>
<p>	<label class = label for="">Exiry Date</label><span class="required">*</span>
	<input class=details type="text" name="exdate" value="" placeholder="25/09/2021">
</P>
	 <p><label class = label for="">Security Code</label><span class="required">*</span>
	<input class = details type="text" name="" value=""placeholder="654">
</P>
	</section>
	<hr class = hrwidth>

	<P class = paymentbuttons><button class = "cancelbtn" type="submit" name="cancel_btn">CANCEL</button> 	<button class = paymentbtn type="submit" name="paymentbtn">MAKE PAYMENT</button></P>

</form>
</div>
</main>
	</body>
</html>
