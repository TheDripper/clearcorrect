<div class="case border border-border-grey m-4 p-4 rounded mb-6 relative">
  <div class="wp-block-columns">
    <div class="wp-block-column" style="flex:33%;">
      <?php the_post_thumbnail(); ?>
    </div>
    <div class="wp-block-column" style="flex:66%;">
      <div class="flex justify-between my-2 pb-2 border-b border-border-grey">
        <?php $id = get_the_ID(); ?>
        <h5 class="text-sm font-bold">SUB ID: <?php echo $id; ?></h5>
        <h5 class="text-sm font-bold">LIKED: 126</h5>
      </div>
      <div class="wp-block-columns">
        <div class="wp-block-column">
          <label class="text-h5-grey uppercase text-xs font-bold">Classification</label>
          <h5 class="text-sm text-white bg-pink uppercase font-bold text-center py-1 rounded w-1/2 mb-4"><?php echo wp_get_post_terms($id, 'classification')[0]->name; ?></h5>
          <label class="text-h5-grey uppercase text-xs font-bold">Conditions</label>
          <ul class="list">
            <?php foreach (wp_get_post_terms($id, 'technical_condition') as $condition) : ?>
              <li><?php echo $condition->name; ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
        <div class="wp-block-column">
          <label class="text-h5-grey uppercase text-xs font-bold">Patient</label>
          <h5 class="mb-4"><?php the_field('gender', "user_" . wp_get_current_user()->ID); ?>, <?php the_field('age', "user_" . wp_get_current_user()->ID); ?></h5>
            <label class="text-h5-grey uppercase text-xs font-bold">Level of Difficulty</label>
            <h5><?php echo wp_get_post_terms($id, 'level_of_difficulty')[0]->name; ?></h5>
        </div>
      </div>
    </div>
  </div>
  <a href="<?php the_permalink(); ?>" class="brick"></a>
</div>