<?php get_header(); ?>

<main class="bg-back-grey pt-12" role="main" aria-label="Content">
  <!-- section -->
  <section>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <?php $id = get_the_ID(); ?>
        <?php $classification = get_the_terms($id, 'classification')[0]->name; ?>
        <?php $aligner_wear_schedule = get_the_terms($id, 'aligner_wear_schedule')[0]->name; ?>
        <?php $level_of_difficulty = get_the_terms($id, 'level_of_difficulty')[0]->name; ?>
        <?php $treatment_technique = get_the_terms($id, 'treatment_technique')[0]->name; ?>
        <?php $conditions = get_the_terms($id, 'technical_condition'); ?>
        <!-- article -->
        <article id="post-<?php the_ID(); ?>" <?php post_class('pt-12'); ?>>
          <div class="wp-block-columns bg-white rounded p-4 max-w-case-single mx-auto">
            <div class="wp-block-column" style="flex:33.333%">
              <div class="case-images flex flex-col">
                <div class="hidden active flex items-center justify-center">
                  <img src="<?php the_post_thumbnail_url(); ?>" />
                </div>
                <div class="active flex items-center justify-start">
                  <div class="wp-block-group before-after-slider">
                    <div class="wp-block-group__inner-container">
                      <figure class="wp-block-image size-full is-resized"><img loading="lazy" src="http://localhost:9009/wp-content/uploads/2021/01/before_single-1.png" alt="" class="wp-image-60" width="592" height="392"></figure>
                      <figure class="wp-block-image size-full is-resized"><img loading="lazy" src="http://localhost:9009/wp-content/uploads/2021/01/after_single.png" alt="" class="wp-image-60" width="592" height="392" style="max-width: none; width: 492px; height: 325.781px;"></figure>
                    </div>
                  </div>
                </div>
                <div class="thumbs flex justify-start items-center ml-2" style="flex: 16.66666%">
                  <?php foreach (get_field('case_images') as $case_image) : ?>
                    <div class="case-image flex items-center mx-1 rounded">
                      <img src="<?php echo $case_image['url']; ?>" />
                    </div>
                  <?php endforeach; ?>
                </div>
              </div>
            </div>
            <div class="wp-block-column" style="flex:66.666%">
              <h2 class="text-pink mb-4 mt-6">Case Information</h2>
              <?php $id = get_the_ID(); ?>
              <?php $author = get_the_author_meta('id'); ?>
              <?php $age = get_field("age", "user_$author"); ?>
              <?php $gender = get_field("gender", "user_$author"); ?>
              <div class="case-details">
                <div class="case-detail">
                  <label class="text-h5-grey uppercase text-xs font-bold">Patient</label>
                  <p><?php echo $age . ', ' . $gender; ?></p>
                </div>
                <div class="case-detail">

                  <label class="text-h5-grey uppercase text-xs font-bold"># of Aligner Sets</label>
                  <p>5 sets</p>
                </div>

                <div class="case-detail">

                  <label class="text-h5-grey uppercase text-xs font-bold">Submission ID</label>
                  <p><?php the_ID(); ?></p>
                </div>

                <div class="case-detail">
                  <label class="text-h5-grey uppercase text-xs font-bold">Wear Schedule</label>
                  <p><?php echo $aligner_wear_schedule; ?></p>
                </div>
                <div class="case-detail">
                  <label class="text-h5-grey uppercase text-xs font-bold">Total Treatment Time</label>
                  <p>6.5 months</p>
                </div>
                <div class="case-detail">

                  <label class="text-h5-grey uppercase text-xs font-bold">Classification</label>
                  <p><?php echo $classification; ?></p>
                </div>

                <div class="case-detail">

                  <label class="text-h5-grey uppercase text-xs font-bold">Submitted</label>
                  <p><?php echo get_the_date(); ?></p>
                </div>

                <div class="case-detail">

                  <label class="text-h5-grey uppercase text-xs font-bold">Level of Difficulty</label>
                  <p><?php echo $level_of_difficulty; ?></p>
                </div>

                <div class="case-detail">
                  <label class="text-h5-grey uppercase text-xs font-bold">Treatment Option</label>
                  <p><?php echo $treatment_technique; ?>
                </div>

              </div>
              <label class="text-h5-grey uppercase text-xs font-bold">Clinical Conditions</label>
              <ul class="list">
                <?php foreach ($conditions as $condition) : ?>
                  <li><?php echo $condition->name; ?>
                  <?php endforeach; ?>
              </ul>
              <?php if (get_field('doctor')) : ?>
                <div class="doctor-card border border-grey rounded mt-6">
                  <?php get_template_part('content', 'doctor'); ?>
                </div>
              <?php endif;  ?>

            </div>
          </div>
          <?php
          $banner_ad = get_post(324);
          $content = $banner_ad->post_content;
          $content = apply_filters('the_content', $content);
          $content = str_replace(']]>', ']]>', $content);
          ?>
          <section class="banner-ad max-w-case-single mx-auto my-6">
            <?php echo $content; ?>
          </section>
        </article>
        <!-- /article -->

      <?php endwhile; ?>

    <?php else : ?>

      <!-- article -->
      <article>

        <h2><?php _e('Sorry, nothing to display.', 'html5blank'); ?></h2>

      </article>
      <!-- /article -->

    <?php endif; ?>

  </section>
  <!-- /section -->
</main>
<?php get_footer(); ?>