<?php get_header(); ?>
<main role="main" aria-label="Content" class="bg-back-grey pt-8">
  <!-- section -->
  <section>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <!-- article -->
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <div class="doctor-login bg-white my-12 max-w-6xl mx-auto py-12">
            <h2 class="text-pink text-center mb-16">Patient Login</h2>
            <?php wp_login_form(array(
              'redirect'=>'http://localhost:4000/patient-dashboard'
            )); ?>
          </div>
        </article>

      <?php endwhile; ?>

    <?php else : ?>

      <!-- article -->
      <article>

        <h2><?php _e('Sorry, nothing to display.', 'html5blank'); ?></h2>

      </article>
      <!-- /article -->

    <?php endif; ?>
  </section>
</main>
<?php get_footer(); ?>