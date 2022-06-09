<?php 
//include_once("db_connect.php");
//Set variables for paypal form
$paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr'; 
//Test PayPal API URL
$paypal_email = 'sb-llv2c6762038@business.example.com';
?>
<title> Paypal Integration in PHP</title>
<div class="container">
	<div class="col-lg-12">
	<div class="row">
		<?php
		$sql = "SELECT * FROM products";
	//	$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
		?>
			
			<div class="thumbnail"> 
			<div class="caption">
			</div>					


			<form action="<?php echo $paypal_url; ?>" method="post">			
			<!-- Paypal business test account email id so that you can collect the payments. -->
			<input type="hidden" name="business" value="<?php echo $paypal_email; ?>">			
			<!-- Buy Now button. -->
			<input type="hidden" name="cmd" value="_xclick">			
			<!-- Details about the item that buyers will purchase. -->
			<input type="hidden" name="item_name" value="order <?php echo $order_id ?>">
			<input type="hidden" name="item_number" value="<?php echo $order_id  ?>">
			<input type="hidden" name="amount" value="<?php echo $_SESSION['checkout-total'] ?>">
				<input type="hidden" name="currency_code" value="GBP">			
			<!-- URLs -->
			<input type='hidden' name='cancel_return' value='http://localhost/Cleckshop/payment/paypal/cancel.php'>
			<input type='hidden' name='return' value='http://localhost/Cleckshop/payment/paypal/success.php'>						
			<!-- payment button. -->
			<input type="image" name="submit" id="paypal-submit" border="0"
			src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif" alt="PayPal - The safer, easier way to pay online">
			<img alt="" border="0" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >    
			</form>
			</div>
				
		</div>		
	</div>	
		
</div>