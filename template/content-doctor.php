<?php $doctor = get_field('doctor'); ?>
<?php
global $post;
// var_dump($doctor);
$post = $doctor;
?>
<div class="flex p-6">
  <div class="doctor-photo flex flex-col justify-start items-center">

    <?php the_post_thumbnail(); ?>
  </div>
  <div class="doctor-contact ml-6 w-full">
    <h3 class="text-green text-md font-head">Dr. Jim Smith</h3>
    <div class="wp-block-columns">
      <div class="wp-block-column" style="flex:50%;">
        <label class="text-h5-grey uppercase text-xs font-bold">Location</label>
        <address>
          <?php the_field('location'); ?>
        </address>
      </div>
      <div class="wp-block-column" style="flex:50%;">
        <label class="text-h5-grey uppercase text-xs font-bold">Contact</label>
        <?php the_field('contact'); ?>
      </div>
    </div>
  </div>
</div>
<?php wp_reset_postdata(); ?>