<div class="catalog">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="catalog__nav">
          <div class="catalog__select-wrap">
            <div class="slider-radio">
              <input type="radio" <?php if ($orderby == " views DESC "){print ' checked '; } ?> name="popular" id="popular"><label for="popular">Popular</label>
              <input type="radio" <?php if ($orderby == " c_id DESC "){print ' checked '; } ?> name="newest" id="newest"><label for="newest">Newest</label>
            </div>
          </div>


        </div>

        <div class="row row--grid" id="movie_grid">



        </div>
      </div>
    </div>

  </div>
</div>
