<?php
session_start();
require_once('../db/config.php');
require_once('../const/web-info.php');
require_once('../const/check_session.php');
switch($res) {
	case '0':
	$_SESSION['reply'] = "006";
	header("location:../login");
	break;

	case '2':
	$_SESSION['reply'] = "005";
	header("location:../login");
	break;

	case '3':
	$_SESSION['reply'] = "007";
	header("location:../login");
	break;
}

if ($role == "admin") {
}else{
$_SESSION['reply'] = "008";
header("location:../login");
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
}

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
}

}catch(PDOException $e)
{

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="css/bootstrap-reboot.min.css">
	<link rel="stylesheet" href="css/bootstrap-grid.min.css">
	<link rel="stylesheet" href="css/magnific-popup.css">
	<link rel="stylesheet" href="css/select2.min.css">
	<link rel="stylesheet" href="css/admin.css">
  <link rel="stylesheet" href="../plugins/datatable/css/jquery.dataTables.min.css">
    <link type="text/css" rel="stylesheet" href="../plugins/loader/waitMe.css">
	<link rel="icon" href="../icon/<?php echo AppIcon; ?>" sizes="32x32">
	<meta name="description" content="<?php echo AppDesc; ?>">
	<meta name="author" content="Bwire Mashauri">
	<title><?php echo AppName; ?> – Payment Gateways</title>

</head>
<body>

	<header class="header">
		<div class="header__content">

			<a href="../" class="sidebar__logo">
				<img class="inner_logo" src="../img/<?php echo AppLogo; ?>" alt="">
			</a>

			<button class="header__btn" type="button">
				<span></span>
				<span></span>
				<span></span>
			</button>

		</div>
	</header>

	<div class="sidebar">
		<a href="../" class="sidebar__logo">
			<img class="inner_logo" src="../img/<?php echo AppLogo; ?>" alt="">
		</a>

		<div class="sidebar__user">
			<div class="sidebar__user-img">
				<img class="profile_in" src="../img/users/<?php echo $image; ?>" alt="">
			</div>

			<div class="sidebar__user-title">
				<span>Website Admin</span>
				<p><?php echo $rusername; ?></p>
			</div>

			<a class="sidebar__user-btn" href="../logout">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M4,12a1,1,0,0,0,1,1h7.59l-2.3,2.29a1,1,0,0,0,0,1.42,1,1,0,0,0,1.42,0l4-4a1,1,0,0,0,.21-.33,1,1,0,0,0,0-.76,1,1,0,0,0-.21-.33l-4-4a1,1,0,1,0-1.42,1.42L12.59,11H5A1,1,0,0,0,4,12ZM17,2H7A3,3,0,0,0,4,5V8A1,1,0,0,0,6,8V5A1,1,0,0,1,7,4H17a1,1,0,0,1,1,1V19a1,1,0,0,1-1,1H7a1,1,0,0,1-1-1V16a1,1,0,0,0-2,0v3a3,3,0,0,0,3,3H17a3,3,0,0,0,3-3V5A3,3,0,0,0,17,2Z"/></svg>
			</a>
		</div>

		<ul class="sidebar__nav">
			<li class="sidebar__nav-item">
				<a href="./" class="sidebar__nav-link"><i class="side_icon feather icon-home"></i> <span>Dashboard</span></a>
			</li>

			<li class="sidebar__nav-item">
				<a href="catalog" class="sidebar__nav-link"><i class="side_icon feather icon-grid"></i> <span>Catalog</span></a>
			</li>

			<li class="sidebar__nav-item">
				<a href="genre" class="sidebar__nav-link"><i class="side_icon feather icon-layers"></i> <span>Genres</span></a>
			</li>

			<li class="sidebar__nav-item">
				<a href="plans" class="sidebar__nav-link "><i class="side_icon feather icon-box"></i> <span>Pricing Plans</span></a>
			</li>

			<li class="sidebar__nav-item">
				<a href="coupons" class="sidebar__nav-link "><i class="side_icon feather icon-gift"></i> <span>Coupons</span></a>
			</li>

			<li class="sidebar__nav-item">
				<a href="users" class="sidebar__nav-link "><i class="side_icon feather icon-users"></i> <span>Users</span></a>
			</li>

			<li class="sidebar__nav-item">
				<a href="comments" class="sidebar__nav-link "><i class="side_icon feather icon-message-square"></i> <span>Comments</span></a>
			</li>

			<li class="sidebar__nav-item">
				<a href="reviews" class="sidebar__nav-link "><i class="side_icon feather icon-star"></i> <span>Reviews</span></a>
			</li>

			<li class="sidebar__nav-item">
				<a href="smtp" class="sidebar__nav-link "><i class="side_icon feather icon-mail"></i> <span>SMTP Settings</span></a>
			</li>

			<li class="sidebar__nav-item">
				<a href="account" class="sidebar__nav-link "><i class="side_icon feather icon-user"></i> <span>Account Settings</span></a>
			</li>

			<li class="sidebar__nav-item">
				<a href="payment_gateways" class="sidebar__nav-link sidebar__nav-link--active"><i class="side_icon feather icon-credit-card"></i> <span>Payment Gateways</span></a>
			</li>

			<li class="sidebar__nav-item">
				<a href="settings" class="sidebar__nav-link "><i class="side_icon feather icon-settings"></i> <span>General Settings</span></a>
			</li>
			<li class="sidebar__nav-item">
				<a href="more_settings" class="sidebar__nav-link"><i class="side_icon feather icon-life-buoy"></i> <span>Additional Settings</span></a>
			</li>

			<li class="sidebar__nav-item">
				<a href="../" class="sidebar__nav-link "><i class="side_icon feather icon-arrow-left-circle"></i> <span>Back to <?php echo AppName; ?></span></a>
			</li>
		</ul>

		<div class="sidebar__copyright">© <?php echo AppName; ?>, <?php echo date('Y'); ?>. <br>Developed by <a href="" target="_blank">Kimiko</a></div>

	</div>

  <main class="main">
  		<div class="container-fluid">
  			<div class="row">

  				<div class="col-12">
  					<div class="main__title">
  						<h2>Payment Gateways</h2>
							<a href="add-item" class="main__title-link">add item</a>
  					</div>
  				</div>

          <div class="col-12">

            <div class="sign__wrap">
              <div class="row">
                  <div class="col-12"><?php require_once('../const/check_reply.php'); ?></div>
                <div class="col-12 col-lg-6">
                  <form id="app_frm" action="core/update_paypal" method="POST" autocomplete="OFF" class="sign__form sign__form--profile sign__form--first">
                    <div class="row">
                      <div class="col-12">
                        <h4 class="sign__title">PayPal Intergration</h4>
                      </div>

                      <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                        <div class="sign__group">
                          <label class="sign__label label_white">API Username</label>

														<input type="text" class="form__input"  value="<?php echo $pp_api_user; ?>" name="apiusername_live" required>
                        </div>
                      </div>

                      <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                        <div class="sign__group">
                          <label class="sign__label label_white">API Password</label>
  												<input type="text" class="form__input"  value="<?php echo $pp_api_pass; ?>" name="apipassword_live" required>
                        </div>
                      </div>

											<div class="col-12 col-md-12 col-lg-12 col-xl-12">
												<div class="sign__group">
													<label class="sign__label label_white">API Signature</label>
													<input type="text" class="form__input"  value="<?php echo $pp_api_sign; ?>" name="apisig_live" required>
												</div>
											</div>


											<div class="col-12 col-md-6 col-lg-12 col-xl-6">
												<div class="sign__group">
													<label class="sign__label label_white">API Username Sandbox</label>

														<input type="text" class="form__input"  value="<?php echo $pp_api_user_test; ?>" name="apiusername_sb" required>
												</div>
											</div>

											<div class="col-12 col-md-6 col-lg-12 col-xl-6">
												<div class="sign__group">
													<label class="sign__label label_white">API Password Sandbox</label>
													<input type="text" class="form__input"  value="<?php echo $pp_api_pass_test; ?>" name="apipassword_sb" required>
												</div>
											</div>

											<div class="col-12 col-md-12 col-lg-12 col-xl-12">
												<div class="sign__group">
													<label class="sign__label label_white">API Signature Sandbox</label>
													<input type="text" class="form__input"  value="<?php echo $pp_api_sign_test; ?>" name="apisig_sb" required>
												</div>
											</div>

                      <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                        <div class="sign__group">
                          <label class="sign__label" >Mode</label>
                          <select name="mode" required class="js-example-basic-single" id="paypal_box">
                            <option <?php if ($paypal_status == "1") { print ' selected '; } ?> value="1">Live Mode</option>
                            <option <?php if ($paypal_status == "0") { print ' selected '; } ?> value="0">Sandbox</option>
                          </select>
                        </div>
                      </div>

                      <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                        <div class="sign__group">
                          <label class="sign__label">Status</label>
                          <select name="status" required class="js-example-basic-single" id="ppbox">
                            <option <?php if ($paypal_switch == "1") { print ' selected '; } ?> value="1">Enabled</option>
                            <option <?php if ($paypal_switch == "0") { print ' selected '; } ?> value="0">Disabled</option>
                          </select>
                        </div>
                      </div>

                      <div class="col-12">
                        <button name="submit" value="1" class="sign__btn" type="submit">Save Changes</button>
                      </div>
                    </div>
                  </form>
                </div>

                <div class="col-12 col-lg-6">
                      <form id="app_frmb" action="core/update_stripe" method="POST" autocomplete="OFF" class="sign__form sign__form--profile sign__form--first">
                    <div class="row">
                      <div class="col-12">
                        <h4 class="sign__title">Stripe Intergration</h4>
                      </div>

                      <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                        <div class="sign__group">
                          <label class="sign__label label_white">Published Key (SandBox)</label>
                          	<textarea name="publishedkeysandbox" required class="form__textarea"><?php echo $public_key_test; ?></textarea>
                        </div>
                      </div>

                      <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                        <div class="sign__group">
                          <label class="sign__label label_white">Secret Key (SandBox)</label>
                          	<textarea name="secretkeysandbox" required class="form__textarea"><?php echo $secret_key_test; ?></textarea>
                        </div>
                      </div>

                      <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                        <div class="sign__group">
                          <label class="sign__label label_white">Published Key (Live)</label>
                            <textarea name="publishedkeylive" required class="form__textarea"><?php echo $public_key_live; ?></textarea>
                        </div>
                      </div>

                      <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                        <div class="sign__group">
                          <label class="sign__label label_white">Secret Key (Live)</label>
                            <textarea name="secretkeylive" required class="form__textarea"><?php echo $secret_key_live; ?></textarea>
                        </div>
                      </div>

                      <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                        <div class="sign__group">
                          <label class="sign__label" >Mode</label>
                          <select name="mode" required class="js-example-basic-single" id="stripe_box">
                            <option <?php if ($stripe_status == "1") { print ' selected '; } ?> value="1">Live Mode</option>
                            <option <?php if ($stripe_status == "0") { print ' selected '; } ?> value="0">Sandbox</option>
                          </select>
                        </div>
                      </div>

                      <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                        <div class="sign__group">
                          <label class="sign__label">Status</label>
                          <select name="status" required class="js-example-basic-single" id="stbox">
                            <option <?php if ($stripe_switch == "1") { print ' selected '; } ?> value="1">Enabled</option>
                            <option <?php if ($stripe_switch == "0") { print ' selected '; } ?> value="0">Disabled</option>
                          </select>
                        </div>
                      </div>

                      <div class="col-12">
                        <button name="submit" value="1" class="sign__btn" type="submit">Save Changes</button>
                      </div>
                    </div>
                  </form>
                </div>

              </div>
            </div>
          </div>



  			</div>
  		</div>
  	</main>


	<script src="js/jquery-3.5.1.min.js"></script>
	<script src="js/bootstrap.bundle.min.js"></script>
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/smooth-scrollbar.js"></script>
	<script src="js/select2.min.js"></script>
	<script src="js/admin.js"></script>
  <script src="../plugins/datatable/js/jquery.dataTables.min.js"></script>
  <script src="../plugins/loader/waitMe.js"></script>
  <script src="../js/forms.js"></script>

</body>

</html>
