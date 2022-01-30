<?php
session_start();
require_once('../db/config.php');
require_once('../const/web-info.php');
require_once('../const/check_session.php');
require_once('../const/temp_browse.php');

if (isset($_SESSION['select_plan_started'])) {
  require_once('../const/payments_api.php');
}else{
  header("location:./");
}
switch($res) {
	case '0':
	$logged = "0";
	break;

	case '1':
	$logged = "1";
	break;

	case '2':
	$logged = "0";
	break;

	case '3':
	$logged = "0";
	break;

}
$dir = "./";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="css/bootstrap-reboot.min.css">
	<link rel="stylesheet" href="css/bootstrap-grid.min.css">
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/slider-radio.css">
	<link rel="stylesheet" href="css/select2.min.css">
	<link rel="stylesheet" href="css/magnific-popup.css">
	<link rel="stylesheet" href="css/plyr.css">
	<link rel="stylesheet" href="css/main.css">
  <link type="text/css" rel="stylesheet" href="plugins/loader/waitMe.css">
	<link rel="icon" href="icon/<?php echo AppIcon; ?>" sizes="32x32">
	<meta name="description" content="<?php echo AppDesc; ?>">
	<meta name="keywords" content="<?php echo AppKeywords; ?>">
	<meta name="author" content="Kimiko">
	<title><?php echo AppName; ?> – Checkout</title>
  <?php
  if ($paypal_switch == "1") {
  require_once('../vendor/paypal/config.php');
  }
  if ($stripe_switch == "1") {
  ?>
  <script src="https://js.stripe.com/v3/"></script>
  <?php
  }
  ?>
  <?php require_once('../const/cms_scripts.php'); ?>
</head>

<body>
	<?php require_once('../const/draws/header_v2.php'); ?>

	<section class="section section--head section--head-fixed">

	</section>


	<div class="section section--pb0">
		<div class="container">
			<div class="row">
				<div class="col-12 col-sm-7 col-lg-6 col-xl-6 load_area" >
          <div class="col-12">
            <h1 class="section__title section__title--head">Checkout</h1>
          </div>

          <div class="plan" id="SELECTOR">
					<h3 class="plan__title"><?php echo $_SESSION['new_plan']; ?></h3>
          <?php
          if (isset($_SESSION['s_error'])) {
          ?><div class="alert alert-danger"><?php echo $_SESSION['s_error']; ?></div><?php
          unset($_SESSION['s_error']);
          }else{
          if (isset($_SESSION['s_success'])) {
          ?><div class="alert alert-success"><?php echo $_SESSION['s_success']; ?></div><?php
          unset($_SESSION['s_success']);
          }
          }


          ?>
					<ul class="plan__list">
            <li class="green"><svg width="19" height="14" viewBox="0 0 19 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1.43994 6.95981L6.77477 12.2924L17.4399 1.62723" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg> Unlimited Movies / TV Shows Download</li>
            <li class="green"><svg width="19" height="14" viewBox="0 0 19 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1.43994 6.95981L6.77477 12.2924L17.4399 1.62723" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg> Unlimited Streaming Library</li>
            <li class="green"><svg width="19" height="14" viewBox="0 0 19 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1.43994 6.95981L6.77477 12.2924L17.4399 1.62723" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg> Switch Plans Anytime</li>
            <?php
            if ($_SESSION['max_vid_size'] < 720) {
            ?>
            <li class="red"><svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17.596 1.59982L1.60938 17.5865" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M17.601 17.5961L1.60101 1.5928" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg> HD Movies / TV Shows</li>
            <?php
            }else{
            ?><li class="green"><svg width="19" height="14" viewBox="0 0 19 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1.43994 6.95981L6.77477 12.2924L17.4399 1.62723" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg> HD Movies / TV Shows</li><?php
            }
            ?>

            <?php
            if ($_SESSION['max_vid_size'] < 1080) {
            ?>
            <li class="red"><svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17.596 1.59982L1.60938 17.5865" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M17.601 17.5961L1.60101 1.5928" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg> Full HD Movies / TV Shows</li>
            <?php
            }else{
            ?><li class="green"><svg width="19" height="14" viewBox="0 0 19 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1.43994 6.95981L6.77477 12.2924L17.4399 1.62723" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg> Full HD Movies / TV Shows</li><?php
            }
            ?>
					</ul>
					<span class="plan__price"><?php if (AppCurrency == "") {}else{ print AppCurrency;} echo number_format($_SESSION['plan_cost'],2); if (AppCurrency == "") {print ' '.strtoupper(AppISO).'';}else{}?><span class="put_right"></span></span>
          <?php
          if ($paypal_switch == "1") {
          ?>
          <form method="post" action="core/paypal_process?paypal=checkout">
          <button id="paypal_btn" class="sign__btn">PAY WITH PAYPAL</button>
          </form>
          <?php
          }

          if ($stripe_switch == "1") {
          ?>
          <form action="core/pay_with_card" method="post" id="payment-form">

          <div id="card-element" class="sign__input form_control pay_area" ></div>
          <div id="card-errors" role="alert"></div>
          <button id="pay_btn" class="sign__btn">PAY WITH CARD</button>
          </form>


          <?php
          }

          if ($_SESSION['discounted'] == "0") {
          ?>
          <a href="#modal-discount" class="main__table-btn main__table-btn--banned open-modal">Enter Discount Code</a>

          <div id="modal-discount" class="zoom-anim-dialog modal mfp-hide">
              <form id="app_frm_dsc" action="core/apply_discount" method="post" autocomplete="OFF">
          <h6 class="modal__title">Enter Discount Code</h6>

          <div class="col-12 col-md-12 col-lg-12 col-xl-12">
					<div class="sign__group">
						<input required type="text" name="discount_code" class="sign__input form_control txt-up">
					</div>
          <div class="modal__btns discount_btn">
            <button name="submit" value="1" class="sign__btn" type="submit">Apply</button>
          </div>
				   </div>
            </form>
           </div>

           <?php
          }

          ?>

          </div>
				</div>
			</div>
		</div>
	</div>

  <?php require_once('../const/draws/footer.php'); ?>
	<script src="js/jquery-3.5.1.min.js"></script>
	<script src="js/bootstrap.bundle.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/slider-radio.js"></script>
	<script src="js/select2.min.js"></script>
	<script src="js/smooth-scrollbar.js"></script>
	<script src="js/jquery.magnific-popup.min.js"></script>
  <script src="plugins/loader/waitMe.js"></script>
	<script src="js/main.js"></script>
  <?php
  if ($paypal_switch == "1") {
  ?>
  <script src="js/co1.js"></script>
  <?php
  }
  if ($stripe_switch == "1") {
  ?>
  <script src="js/co2.js"></script>
  <?php
  }
  ?>
  <script src="js/forms.js"></script>
</body>

</html>
