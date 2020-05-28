<?php

//define('server',$_SERVER["PHP_SELF"]);

  class MultipleEventTicket{
  protected $tittle;
  protected $description;
  protected $price;
  protected $seats;

  public function __construct($price, $seats,$tittle,$description) {
    $this->tittle = $tittle;
    $this->description = $description;
    $this->price = $price;
    $this->seats = $seats;
  }
  public function PrintMultipleEventTicket(){

      echo "<form class= 'ticketForm' action = 'index.php' method = post>
      <table  style='width:100%' bgcolor = '#C4C4C4'>
         <tr>
           <th width = '55%'></th>
           <th width = '45%'></th>
         </tr>
         <tr>
           <td  class = 'centerTitle' colspan = '2'  class='tittle'>$this->tittle</td>
         </tr>
          <tr>
           <td  class = 'centerDespription' colspan = '2'>$this->description</td>
         </tr>
         <tr>
           <td class = 'centerPrice'>€ $this->price</td>
           <td> Avaliable seats: $this->seats</td>
        </tr>
        <tr>
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
           <td></td>
           <td> <input class ='button1' type='submit' value='Add to cart' name = 'multiple_event_btn'></td>
         </tr>
        </table>
        <input type='hidden' name='price' value= $this->price >
        </form>";

  }
}
