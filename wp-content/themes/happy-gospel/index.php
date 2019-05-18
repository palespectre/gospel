<?php dh_get_header(); ?>



<section class="">

<?php
if (have_posts()) :
   while (have_posts()) :
      the_post();
        the_content();
   endwhile;
endif;
?>

</section>


<?php dh_get_footer(); ?>
