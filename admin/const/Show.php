<main class="main">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="main__title">
          <h2><?php echo $title; ?></h2>
          <a href="add-item" class="main__title-link">add item</a>
        </div>
      </div>
      <div class="col-12 col-xl-12">
        <div class="dashbox">
          <div class="dashbox__title">
            <h3>Episodes</h3>

            <div class="dashbox__wrap">
              <a href="#modal-add" class="main__table-btn main__table-btn--banned open-modal">
                <i class="feather icon-plus"></i>
              </a>
            </div>
          </div>


          <div class="dashbox__table-wrap dashbox__table-wrap--1">
            <?php require_once('../const/check_reply.php'); ?>
            <table id="datatbl" class="main__table main__table--dash">
              <thead>
                <tr>
                  <th>LINK</th>
                  <th>SIZE</th>
                  <th>STREAMING</th>
                  <th>EPISODE #</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php
                try {
                $conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $stmt = $conn->prepare("SELECT * FROM tbl_episodes WHERE item = ? ORDER BY episode_no");
                $stmt->execute([$ext_link]);
                $result = $stmt->fetchAll();

                foreach($result as $row) {
                ?>
                <tr>
                  <td><div class="main__table-text"><a target="_blank" href="<?php echo $row[2]; ?>"><?php echo $row[2]; ?></a></div></td>
                  <td><div class="main__table-text"><?php echo $row[3]; ?></div></td>
                    <td><div class="main__table-text"><?php if ($row[4] == "1") { print '<c class="on">ON</c>';}else{print '<c class="off">OFF</c>';}?></div></td>
                    <td><div class="main__table-text">Episode <?php echo $row[5]; ?></div></td>
                  <td width="100">
                    <div class="main__table-text">
                  <a onclick="return confirm('Are you sure you want to delete?');" href="core/delete_episode?node=<?php echo $row[0]; ?>&movie=<?php echo $row[1]; ?>" class="delete_link">
                    Delete
                  </a></div>
                </td>
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


      <div class="col-12 col-xl-12">
        <div class="dashbox">
          <div class="dashbox__title">
            <h3>Subtitles</h3>

            <div class="dashbox__wrap">
              <a href="#modal-add-2" class="main__table-btn main__table-btn--banned open-modal">
                <i class="feather icon-plus"></i>
              </a>
            </div>
          </div>


          <div class="dashbox__table-wrap dashbox__table-wrap--1">
            <?php require_once('../const/check_reply.php'); ?>
            <table id="datatbl2" class="main__table main__table--dash">
              <thead>
                <tr>
                  <th>LINK</th>
                  <th>LANGUAGE</th>
                  <th>LABEL</th>
                  <th>EPISODE #</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php
                try {
                $conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $stmt = $conn->prepare("SELECT * FROM tbl_episode_subs WHERE item = ? ORDER BY episode");
                $stmt->execute([$ext_link]);
                $result = $stmt->fetchAll();

                foreach($result as $row) {
                ?>
                <tr>
                  <td width="100"><div class="main__table-text"><a target="_blank" href="<?php echo $row[2]; ?>"><?php echo $row[2]; ?></a></div></td>
                  <td><div class="main__table-text"><?php echo $row[3]; ?></div></td>
                    <td><div class="main__table-text"><?php echo $row[4]; ?></div></td>
                  <td><div class="main__table-text">Episode <?php echo $row[5]; ?></div></td>
                  <td width="100">
                    <div class="main__table-text">
                  <a onclick="return confirm('Are you sure you want to delete?');" href="core/delete_episode_sub?node=<?php echo $row[0]; ?>&movie=<?php echo $row[1]; ?>" class="delete_link">
                    Delete
                  </a></div>
                </td>
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
  </div>
</main>

<div id="modal-add" class="zoom-anim-dialog mfp-hide modal">
  <h6 class="modal__title">Add Episode</h6>
  <form action="core/new_episode" method="POST" autocomplete="OFF" id="ifrm">
  <div class="row">
    <div class="col-12">
      <div class="form__group">
        <input name="link" required type="text" class="form__input form_control" placeholder="Enter Link">
      </div>
    </div>

    <div class="col-12">
      <div class="form__group">
        <input name="number" required type="number" class="form__input form_control" placeholder="Episode Number">
      </div>
    </div>

    <div class="col-12">
      <div class="form__group">
        <select class="form__input form_control" required name="size">
          <option value="480">480p</option>
          <option value="720">720p</option>
          <option value="1080">1080p</option>
        </select>
      </div>
    </div>

    <input type="hidden" name="movie" value="<?php echo $ext_link; ?>">

    <div class="col-12">
      <div class="form__group">
        <select class="form__input form_control" required name="streaming">
          <option value="1">Supports streaming</option>
          <option value="0">Does not support streaming</option>
        </select>
      </div>
    </div>


  </div>

  <div class="modal__btns">
    <button name="submit" value="1" class="modal__btn modal__btn--apply" type="submit">Save Changes</button>
  </div>
</form>
</div>


<div id="modal-add-2" class="zoom-anim-dialog mfp-hide modal">
  <h6 class="modal__title">Add Subtitles</h6>
  <form action="core/new_episode_sub" method="POST" autocomplete="OFF" id="ifrm3">
  <div class="row">
    <div class="col-12">
      <div class="form__group">
        <input name="link" required type="text" class="form__input form_control" placeholder="Enter Link">
      </div>
    </div>

    <div class="col-12">
      <div class="form__group">
        <input name="language" required type="text" class="form__input form_control" placeholder="Language Eg: English">
      </div>
    </div>

    <div class="col-12">
      <div class="form__group">
        <input name="src" required type="text" class="form__input form_control" placeholder="Lable Eg: En">
      </div>
    </div>

    <div class="col-12">
      <div class="form__group">
        <input name="number" required type="number" class="form__input form_control" placeholder="Episode Number">
      </div>
    </div>

    <input type="hidden" name="movie" value="<?php echo $ext_link; ?>">

  </div>

  <div class="modal__btns">
    <button name="submit" value="1" class="modal__btn modal__btn--apply" type="submit">Save Changes</button>
  </div>
</form>
</div>
