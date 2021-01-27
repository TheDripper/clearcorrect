<?php get_header(); ?>
<?php $current_user = wp_get_current_user(); ?>
<?php
$args = array(
  'author'        =>  $current_user->ID,
  'orderby' => 'post_date',
  'order'         =>  'ASC',
  'posts_per_page' => -1,
  'post_type' => 'case',
  'post_status' => 'any'
);
$cases = get_posts($args);
?>
<main role="main" aria-label="Content" class="bg-back-grey py-8">
  <!-- section -->
  <section>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div class="bg-white border border-border-grey max-w-6xl mx-auto p-6">
          <h2 class="text-pink mb-6">Dashboard</h2>
          <table class="datatable w-full">
            <thead>
              <tr>
                <th class="text-h5-grey uppercase text-xs font-bold cursor-pointer">Submission ID</th>
                <th class="text-h5-grey uppercase text-xs font-bold cursor-pointer">Date Submitted</th>
                <th class="text-h5-grey uppercase text-xs font-bold cursor-pointer">Patient</th>
                <th class="text-h5-grey uppercase text-xs font-bold cursor-pointer">Classification</th>
                <th class="text-h5-grey uppercase text-xs font-bold cursor-pointer">Status</th>
                <th class="text-h5-grey uppercase text-xs font-bold cursor-pointer">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($cases as $case) : ?>
                <?php $id = $case->ID; ?>
                <?php $patient = wp_get_post_terms($id, 'gender')[0]->name . get_field('age', $id); ?>
                <tr class="border-b border-border-grey">
                  <td class="p-4 text-center"><?php echo $id; ?></td>
                  <td class="p-4 text-center"><?php echo $case->post_date; ?></td>
                  <td class="p-4 text-center"><?php echo $patient; ?></td>
                  <td class="p-4 text-center"><?php echo wp_get_post_terms($id, 'classification')[0]->name; ?></td>
                  <td class="p-4 text-center"><?php echo $case->post_status; ?></td>
                  <td class="p-4 text-center"><a class="text-sm mx-2" href="/submission-edit">EDIT</a>|<a class="text-sm mx-2" href="/submission-delete">DELETE</td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
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