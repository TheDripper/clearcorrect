<?php get_header(); ?>
<?php $password = md5($_POST['password']); ?>
<?php $display_name = $_POST['first_name'] . $_POST['last_name']; ?>
<?php $args = array(
  'user_login'=>$_POST['email'],
  'user_email'=>$_POST['email'],
  'user_pass'=>$password,
  // 'user_number'=>$_POST['user-number'],
  'first_name'=>$_POST['first_name'],
  'last_name'=>$_POST['last_name'],
  'role'=>'contributor',
  'display_name'=>$display_name
); ?>
<?php 
  $new_doc = wp_insert_user($args);
  echo $display_name;
  $args = array (
    'post_type'=>'doctor',
    'post_author'=>$new_doc,
    'post_title'=>$display_name
  );
  var_dump(wp_insert_post($args));
?>
<main role="main" aria-label="Content" class="bg-back-grey pt-8">
  <!-- section -->
  <section>
  </section>
</main>
<?php get_footer(); ?>