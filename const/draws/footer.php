<footer class="footer">
  <div class="container">
    <div class="row">
      <div class="col-12 col-sm-8 col-md-6 col-lg-4 col-xl-3 order-4 order-md-1 order-lg-4 order-xl-1">
        <div class="footer__flixtv">
          <img class="footer_logo" src="<?php echo $dir;?>img/<?php echo AppLogo; ?>" alt="">
        </div>
        <p class="footer__tagline"><?php echo AppTopTxt; ?><br><a href="tel:<?php echo AppPhone; ?>"><?php echo AppPhone; ?></a> <a href="mailto:<?php echo AppEmail; ?>"><?php echo AppEmail; ?></a></p>

      </div>

      <div class="col-6 col-md-4 col-lg-3 col-xl-2 order-1 order-md-2 order-lg-1 order-xl-2 offset-md-2 offset-lg-0 offset-xl-1">
        <h6 class="footer__title"><?php echo AppName; ?></h6>
        <div class="footer__nav">
          <a href="<?php echo $dir;?>about">About us</a>
          <a href="<?php echo $dir;?>contact">Contact Us</a>
        </div>
      </div>

      <div class="col-6 col-md-4 col-lg-3 col-xl-2 order-2 order-lg-3 order-md-4 order-xl-4">
        <div class="row">
          <div class="col-12">
            <h6 class="footer__title">Browse</h6>
          </div>

          <div class="col-6">
            <div class="footer__nav">

              <a href="<?php echo $dir;?>category/tv-shows">TV Shows</a>
              <a href="<?php echo $dir;?>category/movies">Movies</a>
            </div>
          </div>

        </div>
      </div>

      <div class="col-6 col-md-4 col-lg-3 col-xl-2 order-2 order-lg-3 order-md-4 order-xl-4">
        <h6 class="footer__title">Account</h6>
        <div class="footer__nav">
          <?php
          if ($logged == "1") {
          ?>
          <a href="<?php echo $dir;?><?php echo $role; ?>">My Account</a>
          <a href="<?php echo $dir;?>logout">Logout</a>
          <?php
          }else{
            ?>
            <a href="<?php echo $dir;?>login">Login</a>
            <a href="<?php echo $dir;?>register">Register</a>
            <?php
          }
          ?>
        </div>
      </div>

      <div class="col-6 col-md-4 col-lg-3 col-xl-2 order-2 order-lg-3 order-md-4 order-xl-4">
        <h6 class="footer__title">Help</h6>
        <div class="footer__nav">
          <a href="<?php echo $dir;?>pricing">Plans & Pricing</a>
          <a href="<?php echo $dir;?>privacy">Privacy policy</a>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <div class="footer__content">
          <div class="footer__links">
            <small class="footer__copyright">Developed by <a href="" target="_blank">Kimiko</a>.</small>

          </div>
          <small class="footer__copyright">© <?php echo AppName; ?>, <?php echo date('Y'); ?> : All Rights Reserved</small>
        </div>
      </div>
    </div>
  </div>
</footer>
