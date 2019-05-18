<?php dh_get_header(); ?>

<section class="videos">
  <div class="container">
    <h2>En vidéo</h2>
    <div class="slider" data-slick='{"slidesToShow": 1, "slidesToScroll": 1, "draggable": true}'>
      <div class="slide">
        <img src="<?php echo get_stylesheet_directory_uri()?>/assets/img/home-image.jpg" alt="">
      </div>
      <div class="slide">
        <img src="<?php echo get_stylesheet_directory_uri()?>/assets/img/home-image.jpg" alt="">
      </div>
      <div class="slide">
        <img src="<?php echo get_stylesheet_directory_uri()?>/assets/img/home-image.jpg" alt="">
      </div>
    </div>
  </div>
</section>

<section id="concerts">
  <div class="container">
    <h2>Les concerts à venir</h2>
    <div class="liste-concerts">
      <div class="concert">
        <img src="<?php echo get_stylesheet_directory_uri()?>/assets/img/home-image.jpg" alt="">
        <p>Chapelle des Templiers, Clisson</p>
        <p>16 mars 2020</p>
        <p>20h</p>
      </div>
      <div class="concert">
        <img src="<?php echo get_stylesheet_directory_uri()?>/assets/img/home-image.jpg" alt="">
        <p>Chapelle des Templiers, Clisson</p>
        <p>16 mars 2020</p>
        <p>20h</p>
      </div>
      <div class="concert">
        <img src="<?php echo get_stylesheet_directory_uri()?>/assets/img/home-image.jpg" alt="">
        <p>Chapelle des Templiers, Clisson</p>
        <p>16 mars 2020</p>
        <p>20h</p>
      </div>
    </div>
  </div>
</section>

<?php dh_get_footer(); ?>
