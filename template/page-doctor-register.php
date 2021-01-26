<?php get_header(); ?>

<main role="main" aria-label="Content" class="bg-form-grey">
  <!-- section -->
  <section>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <!-- article -->
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <h2 class="text-pink text-center mb-24 mt-12">Doctor Registration</h2>
          <form action="/register-user.php" class="doctor-registration bg-white my-12 max-w-6xl mx-auto py-12">
            <div class="wp-block-columns max-w-4xl mx-auto">
              <div class="wp-block-column flex flex-col">
                <label class="text-h5-grey uppercase text-xs font-bold">Email</label>
                <input type="email" name="email" />
                <label class="text-h5-grey uppercase text-xs font-bold">Password</label>
                <input type="password" name="password" />
                <label class="text-h5-grey uppercase text-xs font-bold">Repeat Password</label>

                <input type="password" name="repeat-password" />
                <label class="text-h5-grey uppercase text-xs font-bold">ClearCorrect User Number</label>

                <input type="text" name="user-number" />
                <label class="text-h5-grey uppercase text-xs font-bold"></label>

                <div class="select">
                  <select name="practice-country">
                    <option>Make Selection</option>
                    <option>One</option>
                    <option>Two</option>
                  </select>
                </div>

              </div>

              <div class="wp-block-column flex flex-col">
                <input type="text" name="first-name" />
                <input type="text" name="last-name" />
                <div class="select">

                  <select name="degree">
                    <option>Make Selection</option>
                    <option>One</option>
                    <option>Two</option>
                  </select>
                </div>

                <div class="select">

                  <select name="specialty">
                    <option>Make Selection</option>
                    <option>One</option>
                    <option>Two</option>
                  </select>
                </div>

                <div class="select">

                  <select name="practice-state">
                    <option>Make Selection</option>
                    <option>One</option>
                    <option>Two</option>
                  </select>
                </div>

              </div>
            </div>
            <div class="max-w-4xl w-full mx-auto flex flex-col">
              <div class="flex items-center mb-4">
                <div class="check-style-wrap">

                  <input class="checkbox" type="checkbox" name="terms-conditions" />
                </div>

                <div class="flex">
                  <div class="checkbox"></div>
                  <div class="flex flex-col">
                    <p>I confirm that I have read and agree to the ClearCorrect Case Gallery <a class="block" href="/terms-conditions">Terms & Conditions</a></p>
                  </div>
                </div>
              </div>
              <div class="flex items-center">
                <div class="check-style-wrap">
                  <input class="checkbox" type="checkbox" name="terms-conditions" />
                </div>
                <div class="flex">
                  <div class="checkbox"></div>
                  <div class="flex flex-col">
                    <p>I confirm that I have read and agree to the ClearCorrect Case Gallery <a class="block" href="/doctor-consent-agreement">Doctor Consent Agreement</a></p>
                  </div>
                </div>
              </div>
              <input type="submit" class="w-full max-w-xs bg-pink text-white text-sm uppercase mx-auto rounded my-12 py-4 font-bold" value="SUBMIT" />
              <a class="text-center mb-4" href="/login">I already have an account.</a>
              <a class="text-center href=" /patient-register">I already have an account.</a>
            </div>

          </form>


          <?php edit_post_link(); ?>

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