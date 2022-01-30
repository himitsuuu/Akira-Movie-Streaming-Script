<?php
session_start();
include_once("../vendor/paypal/config.php");
include_once("../vendor/paypal/functions.php");
include_once("../vendor/paypal/paypal.class.php");


$paypal= new MyPayPal();

if(_GET('paypal')=='checkout'){

  $products = [];

  $products[0]['ItemName'] = $_SESSION['trans_name'];
  $products[0]['ItemPrice'] = ($_SESSION['unit_amount']/100);
  $products[0]['ItemNumber'] = $_SESSION['tran_no'];
  $products[0]['ItemDesc'] = "Plan upgrade";
  $products[0]['ItemQty']	= "1";


  $charges = [];

  $charges['TotalTaxAmount'] = 0;
  $charges['HandalingCost'] = 0;
  $charges['InsuranceCost'] = 0;
  $charges['ShippinDiscount'] = 0;
  $charges['ShippinCost'] = 0;
  $paypal->SetExpressCheckOut($products, $charges);
}
elseif(_GET('token')!=''&&_GET('PayerID')!=''){

  $paypal->DoExpressCheckoutPayment();
}
else{

}

?>
