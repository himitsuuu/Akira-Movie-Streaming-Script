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

require_once('const/comment_query.php');
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
	<title><?php echo AppName; ?> – Comments</title>

</head>
<body>

	<header class="header">
		<div class="header__content">

			<a href="../" class="header__logo">
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
				<a href="comments" class="sidebar__nav-link  sidebar__nav-link--active"><i class="side_icon feather icon-message-square"></i> <span>Comments</span></a>
			</li>

			<li class="sidebar__nav-item">
				<a href="reviews" class="sidebar__nav-link"><i class="side_icon feather icon-star"></i> <span>Reviews</span></a>
			</li>

			<li class="sidebar__nav-item">
				<a href="smtp" class="sidebar__nav-link "><i class="side_icon feather icon-mail"></i> <span>SMTP Settings</span></a>
			</li>

			<li class="sidebar__nav-item">
				<a href="account" class="sidebar__nav-link "><i class="side_icon feather icon-user"></i> <span>Account Settings</span></a>
			</li>

			<li class="sidebar__nav-item">
				<a href="payment_gateways" class="sidebar__nav-link "><i class="side_icon feather icon-credit-card"></i> <span>Payment Gateways</span></a>
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
						<h2>Comments</h2>


						<span class="main__title-stat" id="totals">0 Total</span>


						<div class="main__title-wrap">
							<div class="filter" id="filter__sort">
								<span class="filter__item-label">Sort by:</span>

								<div class="filter__item-btn dropdown-toggle" role="navigation" id="filter-sort" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<input type="button" value="<?php echo $srt_txt; ?>">
									<span></span>
								</div>

								<ul class="filter__item-menu dropdown-menu scrollbar-dropdown" aria-labelledby="filter-sort">
                  <li id="comments" onclick="window.location.href=this.id">Last Created</li>
									<li id="comments?&srt=1" onclick="window.location.href=this.id">First Created</li>
								</ul>
							</div>

							<form action="comments" class="main__title-form">
								<input value="<?php echo $keytext; ?>" name="keywords" required type="text" placeholder="Keyword..">
								<button type="submit">
									<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="8.25998" cy="8.25995" r="7.48191" stroke="#2F80ED" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></circle><path d="M13.4637 13.8523L16.3971 16.778" stroke="#2F80ED" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
								</button>
							</form>

						</div>
					</div>
				</div>

				<div class="col-12">

					<div class="main__table-wrap">
              <?php require_once('../const/check_reply.php'); ?>
						<table id="datatbl" class="main__table">
							<thead>
								<tr>
									<th>ITEM</th>
                  <th>USER</th>
                  <th>COMMENT</th>
									<th>CREATED DATE</th>
									<th>ACTIONS</th>
								</tr>
							</thead>

							<tbody>

                <?php
                function number_abbr($number)
                {
                $abbrevs = [12 => 'T', 9 => 'B', 6 => 'M', 3 => 'K', 0 => ''];

                foreach ($abbrevs as $exponent => $abbrev) {
                  if (abs($number) >= pow(10, $exponent)) {
                    $display = $number / pow(10, $exponent);
                    $decimals = ($exponent >= 3 && round($display) < 100) ? 1 : 0;
                    $number = number_format($display, $decimals).$abbrev;
                    break;
                  }
                }

                return $number;
                }

                function truncate_string ($string, $maxlength, $extension) {

                  $cutmarker = "**cut_here**";

                  if (strlen($string) > $maxlength) {
                    $string = wordwrap($string, $maxlength, $cutmarker);

                    $string = explode($cutmarker, $string);

                    $string = $string[0] . $extension;
                  }

                  return $string;

                  }

                try {
                $conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
								$tot = 0;

                $stmt = $conn->prepare($final_query);
                if (!empty($_GET['keywords'])) {
                $stmt->execute([$keyword]);
                }else{
                $stmt->execute();
                }

                $result = $stmt->fetchAll();
								$tot = count($result);
								?><script>document.getElementById('totals').innerHTML = "<?php echo number_format($tot); ?> Total";</script><?php

                foreach($result as $row) {
                  $st1 = preg_replace("/[^a-zA-Z]/", " ", $row[8]);
                  $st2 =  preg_replace('/\s+/', ' ', $st1);
                  $item_title = strtolower(str_replace(' ', '-', $st2));

                  if ($row[5] < 10) {
                    $review = ''.$row[5].'.0';
                  }else{
                    $review = ''.$row[5].'';
                  }

                ?>
								<tr>

									<td>
										<div class="main__table-text"><a target="_blank" href="../item/<?php echo $row[1]; ?>/<?php echo $item_title; ?>"><?php echo $row[8]; ?></a></div>
									</td>
                  <td>
                    <div class="main__table-text"><?php echo $row[28]; ?> <?php if ($row[34] == "1") {print '<img title="Verified Account" id="verified" class="verification_inside" src="../img/check.svg">';} ?></div>
                  </td>

                  <td >
                    <div class="main__table-text" ><?php echo truncate_string ($row[4], 50, " ..."); ?></div>
                  </td>
									<td>
										<div class="main__table-text"><?php echo $row[3]; ?></div>
									</td>

									<td>
										<div class="main__table-btns">

											<a href="#modal-view<?php echo $row[0];?>" class="main__table-btn main__table-btn--view open-modal">
												<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M21.92,11.6C19.9,6.91,16.1,4,12,4S4.1,6.91,2.08,11.6a1,1,0,0,0,0,.8C4.1,17.09,7.9,20,12,20s7.9-2.91,9.92-7.6A1,1,0,0,0,21.92,11.6ZM12,18c-3.17,0-6.17-2.29-7.9-6C5.83,8.29,8.83,6,12,6s6.17,2.29,7.9,6C18.17,15.71,15.17,18,12,18ZM12,8a4,4,0,1,0,4,4A4,4,0,0,0,12,8Zm0,6a2,2,0,1,1,2-2A2,2,0,0,1,12,14Z"/></svg>
											</a>
											<a onclick="return confirm('Are yuo sure you want to delete?');" href="core/drop_comment.php?node=<?php echo $row[0];?>&href=comments" class="main__table-btn main__table-btn--delete">
												<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M10,18a1,1,0,0,0,1-1V11a1,1,0,0,0-2,0v6A1,1,0,0,0,10,18ZM20,6H16V5a3,3,0,0,0-3-3H11A3,3,0,0,0,8,5V6H4A1,1,0,0,0,4,8H5V19a3,3,0,0,0,3,3h8a3,3,0,0,0,3-3V8h1a1,1,0,0,0,0-2ZM10,5a1,1,0,0,1,1-1h2a1,1,0,0,1,1,1V6H10Zm7,14a1,1,0,0,1-1,1H8a1,1,0,0,1-1-1V8H17Zm-3-1a1,1,0,0,0,1-1V11a1,1,0,0,0-2,0v6A1,1,0,0,0,14,18Z"/></svg>
											</a>
										</div>
									</td>

                  <div id="modal-view<?php echo $row[0];?>" class="zoom-anim-dialog mfp-hide modal modal--view">
                    <div class="reviews__autor">
                      <img class="reviews__avatar" src="../img/users/<?php echo $row[32]; ?>" alt="">
                      <span class="comments__name"><?php echo $row[25]; ?> <?php echo $row[26]; ?> <?php if ($row[34] == "1") {print '<img title="Verified Account" id="verified" class="verification_inside" src="../img/check.svg">';} ?></span>
                      <span class="comments__time"><?php echo $row[3]; ?></span>
                    </div>
                    <p class="comments__text"><?php echo $row[4]; ?></p>
                  </div>

								</tr>
                <?php
                }

                }catch(PDOException $e)
                {
                echo "Connection failed: " . $e->getMessage();
                }
                ?>



							</tbody>
						</table>
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
  <script src="js/genre.js"></script>
  <script>
  $(document).ready( function () {
    $('#datatbl').DataTable({
      searching: false,
    "bLengthChange": false,
    "ordering": false
});
} );
</script>
</body>

</html>
