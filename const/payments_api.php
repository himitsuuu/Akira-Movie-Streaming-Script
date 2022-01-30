<?php
try {
$conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $conn->prepare("SELECT * FROM tbl_stripe");
$stmt->execute();
$resultb = $stmt->fetchAll();
foreach($resultb as $rowb) {
  $public_key_test = $rowb[2];
  $secret_key_test = $rowb[3];
  $public_key_live = $rowb[0];
  $secret_key_live = $rowb[1];
  $stripe_status = $rowb[4];
  $stripe_switch = $rowb[5];
  if ($stripe_status == "0") {
    $_SESSION['stripe_pk'] = $public_key_test;
    $_SESSION['stripe_sk'] = $secret_key_test;
    $_SESSION['stripe_trans'] = "Test";
  }else{
    $_SESSION['stripe_pk'] = $public_key_live;
    $_SESSION['stripe_sk'] = $secret_key_live;
    $_SESSION['stripe_trans'] = "Live";
  }
}

}catch(PDOException $e)
{

}

try {
$conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $conn->prepare("SELECT * FROM tbl_paypal");
$stmt->execute();
$resultc = $stmt->fetchAll();
foreach($resultc as $rowc) {
  $pp_api_user = $rowc[1];
  $pp_api_pass = $rowc[2];
  $pp_api_sign = $rowc[3];

  $pp_api_user_test = $rowc[4];
  $pp_api_pass_test = $rowc[5];
  $pp_api_sign_test = $rowc[6];

  $paypal_status = $rowc[7];
  $paypal_switch = $rowc[8];

  if ($paypal_status == "0") {
    $_SESSION['paypal_api_user'] = $pp_api_user_test;
    $_SESSION['paypal_api_pass'] = $pp_api_pass_test;
    $_SESSION['paypal_api_sign'] = $pp_api_sign_test;
    $_SESSION['paypal_trans'] = "Test";
  }else{
    $_SESSION['paypal_api_user'] = $pp_api_user;
    $_SESSION['paypal_api_pass'] = $pp_api_pass;
    $_SESSION['paypal_api_sign'] = $pp_api_sign;
    $_SESSION['paypal_trans'] = "Live";
  }
}

}catch(PDOException $e)
{

}
?>
