<?php
if (!function_exists('wp_handle_upload')) {
  require_once(ABSPATH . 'wp-admin/includes/image.php');
  require_once(ABSPATH . 'wp-admin/includes/file.php');
  require_once(ABSPATH . 'wp-admin/includes/media.php');
}
?>
<?php get_header(); ?>
<?php
$submitted = wp_insert_post(array(
  'post_type' => 'case',
  'post_author' => $current_user->ID,
  'post_status' => 'draft',
  'post_title' => $_POST['patient_case_number']
));
if (!empty($_FILES)) {
  foreach ($_FILES as $field => $file) {
    if($file["name"]) {
      $photo = media_handle_upload($field, $submitted);
      update_field($field, $photo, $submitted);
    }
  }
}
foreach ($_POST as $key => $value) {
  if (strpos($key, 'term_') === 0) {
    wp_set_object_terms($submitted, $value, substr($key, 5));
  } else {
    update_field($key, $value, $submitted);
  }
}
?>
<main role="main" aria-label="Content" class="bg-back-grey pt-8">
  <!-- section -->
  <section>
    <h1 class="text-pink"><?php echo $submitted; ?></h1>
  </section>
</main>
<?php get_footer(); ?>