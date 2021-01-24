<?php get_header(); ?>
<?php $doctor = get_the_ID(); ?>
<?php
// global $post;
// var_dump($doctor);
// $post = $doctor;
?>
<?php 

$args = array(
  'post_type' => 'case',
  'posts_per_page'=>-1,
  'post_status'=>'publish',
  'meta_key'=>'doctor',
  'meta_value' => $doctor
);
global $post;
$q = new WP_Query($args);
?>
  <!-- section -->
  <div class="wp-block-columns max-w-6xl mx-auto">
    <div class="wp-block-column bg-white rounded" style="flex:25%;">
      <aside class="facets">
        <h2 class="border-b border-border-grey p-4  ">filters</h2>
        <div class="px-4">
          <p class="facet-arrow my-2">
            Classification
          </p>
          <?php echo facetwp_display('facet', 'classification'); ?>
          <p class="facet-arrow my-2">
            Clinical Conditions
          </p>
          <?php echo facetwp_display('facet', 'technical_condition'); ?>
          <p class="facet-arrow my-2">
            Treatment Technique
          </p>
          <?php echo facetwp_display('facet', 'treatment_technique'); ?>
          <p class="facet-arrow my-2">
            Aligner Wear Schedule
          </p>
          <?php echo facetwp_display('facet', 'aligner_wear_schedule'); ?>
          <p class="facet-arrow my-2">
            Level of Difficulty
          </p>
          <?php echo facetwp_display('facet', 'level_of_difficulty'); ?>
        </div>
      </aside>
    </div>
    <div class="wp-block-column bg-white rounded" style="flex:75;">
      <h2 class="px-4 mt-8"><?php echo wp_count_posts('case')->publish; ?> cases</h2>
      <?php echo facetwp_display('template', 'cases'); ?>
    </div>
  </div>
  <?php wp_reset_postdata();?>