<?php

//define('server',$_SERVER["PHP_SELF"]);

class JazzTicket{
  protected $artist;
  protected $price;
  protected $seats;
  protected $start_time;
  protected $end_time;
  protected $venue;
  protected $date;
  protected $id;


  public function __construct($artist, $price, $seats,$start_time,$end_time,$venue,$date,$id) {
    $this->artist = $artist;
    $this->price = $price;
    $this->seats = $seats;
    $this->start_time = $start_time;
    $this->end_time = $end_time;
    $this->venue = $venue;
    $this->date = $date;
    $this->id = $id;

  }
  public function PrintTicket(){
    if($this->venue == 'Grote Markt'){
      echo "<form class= 'ticketForm'>
          <table style='width:100%' bgcolor = '#C4C4C4'>
         <tr>
           <th></th>
           <th></th>
           <th></th>
         </tr>
         <tr>
           <td width = '50%' class='artist'>$this->artist</td>
         </tr>
         <tr>
           <td>Date: $this->date |  Time: $this->start_time - $this->end_time</td>
           <td class = 'seats_label'align ='center'>€ 0.00</td>
           <td>
           <section>

           </section>
           </td>
         </tr>
         <tr>
           <td>$this->venue</td>
           <td></td>
           <td></td>
         </tr>
         <tr>
           <td></td>
           <td></td>
         </tr>
        </table>
        </form>";
    }else{
      echo "<form class= 'ticketForm' action' = 'index.php' method = post>
      <table style='width:100%' bgcolor = '#C4C4C4'>
         <tr>
           <th></th>
           <th></th>
           <th></th>
         </tr>
         <tr>
           <td width = '50%' class='artist'>$this->artist</td>
           <td width = '28%'align ='right'>€ $this->price</td>
           <td width = '22%'>Available Seats: $this->seats</td>
         </tr>
         <tr>
           <td>Date: $this->date |  Time: $this->start_time - $this->end_time</td>
           <td class = 'seats_label'align ='right'>Quantity</td>
           <td>
           <section>
           <div class='value-button' id='decrease' onclick='decreaseValue()' value='Decrease Value'></div>
           <input type='number' name ='quantity' id='number' value='1' size='4' class ='quantity' />
           <div class='value-button' id='increase' onclick='increaseValue()' value='Increase Value'></div>
           </section>
           </td>
         </tr>
         <tr>
           <td>$this->venue</td>
           <td></td>
           <td></td>
         </tr>
         <tr>
           <td></td>
           <td></td>
           <td> <input class ='button1' type='submit' value='Add to cart' name = 'add_to_cart'></td>
         </tr>
        </table>
        <input type='hidden' name='artist' value='$this->artist'>
        <input type='hidden' name='venue' value='$this->venue'>
        <input type='hidden' name='start_time' value='$this->start_time'>
        <input type='hidden' name='end_time' value= '$this->end_time'>
        <input type='hidden' name='date' value='$this->date'>
        <input type='hidden' name='id' value='$this->id'>
        <input type='hidden' name='price' value=$this->price>
        </form>";
      }
  }
}


 ?>
