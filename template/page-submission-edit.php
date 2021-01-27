<?php
if (!function_exists('wp_handle_upload')) {
  require_once(ABSPATH . 'wp-admin/includes/image.php');
  require_once(ABSPATH . 'wp-admin/includes/file.php');
  require_once(ABSPATH . 'wp-admin/includes/media.php');
}
?>
<?php get_header(); ?>
<?php $id = $_GET['id']; ?>
<?php
wp_update_post(array(
  'ID'=> $id,
  'post_type' => 'case',
  'post_author' => $current_user->ID,
  'post_status' => 'draft',
  'post_title' => $_POST['patient_case_number']
));
$case = get_post($id);
if (!empty($_FILES)) {
  foreach ($_FILES as $field => $file) {
    if($file["name"]) {
      $photo = media_handle_upload($field, $id);
      update_field($field, $photo, $id);
    }
  }
}
foreach ($_POST as $key => $value) {
  if (strpos($key, 'term_') === 0) {
    wp_set_object_terms($id, $value, substr($key, 5));
  } else {
    update_field($key, $value, $id);
  }
}
?>
<main role="main" aria-label="Content" class="bg-back-grey pt-8">
  <!-- section -->
  <section>
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <?php if ($_POST['technical_condition']) {
          wp_set_object_terms(get_the_ID(), $_POST['techinical_condition'], 'technical_condition');
        } ?>
        <!-- article -->
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <div class="submission-edit bg-white my-12 max-w-6xl mx-auto py-12">
    <h1 class="text-pink"><?php echo $submitted; ?></h1>
    <h2 class="text-pink text-center mb-16">Submission Details</h2>
            <form enctype="multipart/form-data" action="/doctor-submitted" method="POST">
              <h3 class="w-full max-w-4xl mx-auto mb-2">Patient Information</h3>
              <div class="wp-block-columns max-w-4xl mx-auto">
                <div class="wp-block-column flex flex-col">
                  <label class="text-h5-grey uppercase text-xs font-bold">Patient Case Number</label>
                  <input type="text" name="patient_case_number" value="<?php echo get_field('patient_case_number', $case->ID); ?>" />
                </div>
                <div class="wp-block-column flex flex-col"">
                <label class=" text-h5-grey uppercase text-xs font-bold">Classification</label>
                  <div class="select">
                    <select name="term_classification">
                      <?php foreach (get_terms('classification', array('hide_empty' => false)) as $term) : ?>
                        <option><?php echo $term->name; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="wp-block-columns max-w-4xl mx-auto">
                <div class="wp-block-column flex flex-col">
                  <label class="text-h5-grey uppercase text-xs font-bold">Patient Gender</label>
                  <div class="select">
                    <select name="term_gender">
                      <?php foreach (get_terms('gender', array('hide_empty' => false)) as $term) : ?>
                        <option><?php echo $term->name; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>

                <div class="wp-block-column flex flex-col">
                  <label class=" text-h5-grey uppercase text-xs font-bold">Level of Difficulty</label>
                  <div class="select">
                    <select name="term_level_of_difficulty">
                      <?php foreach (get_terms('level_of_difficulty', array('hide_empty' => false)) as $term) : ?>
                        <option><?php echo $term->name; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="wp-block-columns max-w-4xl mx-auto">
                <div class="wp-block-column flex flex-col">
                  <label class="text-h5-grey uppercase text-xs font-bold">Patient Date of Birth</label>
                  <input type="date" name="patient_birth_date" value="<?php echo get_field('patient_birth_date', $case->ID); ?>" />
                </div>

                <div class="wp-block-column flex flex-col">
                  <label class=" text-h5-grey uppercase text-xs font-bold">Treatment Option</label>
                  <div class="select">
                    <select name="term_treatment_option">
                      <?php foreach (get_terms('treatment_option', array('hide_empty' => false)) as $term) : ?>
                        <option><?php echo $term->name; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="wp-block-columns max-w-4xl mx-auto">
                <div class="wp-block-column flex flex-col">
                  <label class="text-h5-grey uppercase text-xs font-bold">Number of Aligner Sets</label>
                  <div class="select">
                    <select name="term_number_of_aligner_sets">
                      <?php foreach (get_terms('number_of_aligner_sets', array('hide_empty' => false)) as $term) : ?>
                        <option><?php echo $term->name; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>

                <div class="wp-block-column flex flex-col">
                  <label class=" text-h5-grey uppercase text-xs font-bold">Wear Schedule</label>
                  <div class="select">
                    <select name="term_aligner_wear_schedule">
                      <?php foreach (get_terms('aligner_wear_schedule', array('hide_empty' => false)) as $term) : ?>
                        <option><?php echo $term->name; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="max-w-4xl mx-auto">
                <label class=" text-h5-grey uppercase text-xs font-bold">Primary Complaint</label>
                <textarea name="primary_complaint"></textarea>
              </div>
              <h3 class="w-full max-w-4xl mx-auto mt-6 mb-2">Treatment Summary</h3>
              <div class="wp-block-columns max-w-4xl mx-auto">
                <div class="wp-block-column flex flex-col">
                  <label class="text-h5-grey uppercase text-xs font-bold">Submission Materials</label>
                  <div class="select">
                    <select name="term_submission_materials">
                      <?php foreach (get_terms('submission_materials', array('hide_empty' => false)) as $term) : ?>
                        <option><?php echo $term->name; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>

                <div class="wp-block-column flex flex-col">
                  <label class=" text-h5-grey uppercase text-xs font-bold">Type of Retention</label>
                  <div class="select">
                    <select name="term_type_of_retention">
                      <?php foreach (get_terms('type_of_retention', array('hide_empty' => false)) as $term) : ?>
                        <option><?php echo $term->name; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="wp-block-columns max-w-4xl mx-auto">
                <div class="wp-block-column flex flex-col">
                  <label class="text-h5-grey uppercase text-xs font-bold">Aligner Material</label>
                  <div class="select">
                    <select name="term_aligner_material">
                      <?php foreach (get_terms('aligner_material', array('hide_empty' => false)) as $term) : ?>
                        <option><?php echo $term->name; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>

                <div class="wp-block-column flex flex-col">
                  <label class=" text-h5-grey uppercase text-xs font-bold">Other Products Used (Optional)</label>
                  <div class="select">
                    <select name="term_other_products_used">
                      <?php foreach (get_terms('other_products_used', array('hide_empty' => false)) as $term) : ?>
                        <option><?php echo $term->name; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="wp-block-columns max-w-4xl mx-auto">
                <div class="wp-block-column flex flex-col">
                  <label class="text-h5-grey uppercase text-xs font-bold">Number of Revisions</label>
                  <div class="select">
                    <select name="term_number_of_revisions">
                      <?php foreach (get_terms('number_of_revisions', array('hide_empty' => false)) as $term) : ?>
                        <option><?php echo $term->name; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>

                <div class="wp-block-column flex flex-col">
                  <label class=" text-h5-grey uppercase text-xs font-bold">Total Treatment Time</label>
                  <div class="select">
                    <select name="term_type_of_retention">
                      <?php foreach (get_terms('total_treatment_time', array('hide_empty' => false)) as $term) : ?>
                        <option><?php echo $term->name; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>

              <div class="max-w-4xl mx-auto">
                <label class=" text-h5-grey uppercase text-xs font-bold">Reason for Revision (Optional)</label>
                <textarea name="reason_for_revision"></textarea>
              </div>
              <div class="max-w-4xl mx-auto mt-8">
                <label class=" text-h5-grey uppercase text-xs font-bold">Clinical Conditions</label>
                <ul class="technical-condition">
                <?php foreach (get_terms('technical_condition', array('hide_empty' => false)) as $term) : ?>
                  <li class="flex items-center">
                    <input class="mr-2" type="checkbox" name="term_technical_condition[]" value="<?php echo $term->name; ?>" />
                    <p><?php echo $term->name; ?></p>
                  </li>
                <?php endforeach; ?>
                </ul>
              </div>
              <div class="max-w-4xl mx-auto mt-12">
                <label class=" text-h5-grey uppercase text-xs font-bold">Treatment Technique</label>
                <ul class="treatment-technique">
                <?php foreach (get_terms('treatment_technique', array('hide_empty' => false)) as $term) : ?>
                  <li class="flex items-center">
                    <input class="mr-2" type="checkbox" value="<?php echo $term->name; ?>" name="term_treatment_technique[]" />
                    <p><?php echo $term->name; ?></p>
                  </li>
                <?php endforeach; ?>
                </ul>

              </div>
              <div class="max-w-4xl mx-auto mt-8">
                <label class=" text-h5-grey uppercase text-xs font-bold">Results Achieved</label>
                <textarea name="results_achieved"></textarea>
              </div>
              <div class="max-w-4xl mx-auto mt-8">
                <label class=" text-h5-grey uppercase text-xs font-bold">Additional Comments (Optional)</label>
                <textarea name="additional_comments"></textarea>
              </div>
              <div class="max-w-4xl mx-auto mt-8">
                <h3>Before Photos</h3>
                <div class="wp-block-columns max-w-4xl mx-auto">
                  <div class="wp-block-column flex flex-col">
                    <div class="flex items-center max-w-4xl mx-auto avatar">
                      <?php
                      $photo = get_field('before_occluded_buccal_view_of_anterior', $case->ID);
                      if (empty($photo)) $photo = 'http://ec2-18-144-32-142.us-west-1.compute.amazonaws.com//wp-content/uploads/2021/01/no_photo.png';
                      ?>
                      <img src="<?php echo $photo; ?>" />
                      <div class="flex flex-col">
                        <label class="text-h5-grey uppercase text-xs font-bold">Occluded buccal view of anterior</label>
                        <input type="file" id="before_occluded_buccal_view_of_anterior" name="before_occluded_buccal_view_of_anterior" accept="image/png, image/jpeg">
                      </div>
                    </div>
                  </div>
                  <div class="wp-block-column flex flex-col">
                    <div class="flex items-center max-w-4xl mx-auto avatar">
                      <?php
                      $photo = get_field('before_occluded_buccal_view_of_right_lateral', $case->ID);
                      if (empty($photo)) $photo = 'http://ec2-18-144-32-142.us-west-1.compute.amazonaws.com//wp-content/uploads/2021/01/no_photo.png';
                      ?>
                      <img src="<?php echo $photo; ?>" />
                      <div class="flex flex-col">
                        <label class="text-h5-grey uppercase text-xs font-bold">Occluded buccal view of right lateral</label>
                        <input type="file" id="before_occluded_buccal_view_of_right_lateral" name="before_occluded_buccal_view_of_right_lateral" accept="image/png, image/jpeg">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="wp-block-columns max-w-4xl mx-auto">
                  <div class="wp-block-column flex flex-col">
                    <div class="flex items-center max-w-4xl mx-auto avatar">
                      <?php
                      $photo = get_field('before_occluded_buccal_view_of_left_lateral', $case->ID);
                      if (empty($photo)) $photo = 'http://ec2-18-144-32-142.us-west-1.compute.amazonaws.com//wp-content/uploads/2021/01/no_photo.png';
                      ?>
                      <img src="<?php echo $photo; ?>" />
                      <div class="flex flex-col">
                        <label class="text-h5-grey uppercase text-xs font-bold">Occluded buccal view of left lateral</label>
                        <input type="file" id="before_occluded_buccal_view_of_left_lateral" name="before_occluded_buccal_view_of_left_lateral" accept="image/png, image/jpeg">
                      </div>
                    </div>
                  </div>
                  <div class="wp-block-column flex flex-col">
                    <div class="flex items-center max-w-4xl mx-auto avatar">
                      <?php
                      $photo = get_field('before_occlusal_view_of_upper', $case->ID);
                      if (empty($photo)) $photo = 'http://ec2-18-144-32-142.us-west-1.compute.amazonaws.com//wp-content/uploads/2021/01/no_photo.png';
                      ?>
                      <img src="<?php echo $photo; ?>" />
                      <div class="flex flex-col">
                        <label class="text-h5-grey uppercase text-xs font-bold">Occlusal view of upper</label>
                        <input type="file" id="before_occlusal_view_of_upper" name="before_occlusal_view_of_upper" accept="image/png, image/jpeg">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="wp-block-columns max-w-4xl mx-auto">
                  <div class="wp-block-column flex flex-col">
                    <div class="flex items-center max-w-4xl mx-auto avatar">
                      <?php
                      $photo = get_field('before_occlusal_view_of_lower', $case->ID);
                      if (empty($photo)) $photo = 'http://ec2-18-144-32-142.us-west-1.compute.amazonaws.com//wp-content/uploads/2021/01/no_photo.png';
                      ?>
                      <img src="<?php echo $photo; ?>" />
                      <div class="flex flex-col">
                        <input type="file" id="before_occlusal_view_of_lower" name="before_occlusal_view_of_lower" accept="image/png, image/jpeg">
                        <label class="text-h5-grey uppercase text-xs font-bold">Occlusal view of lower</label>
                      </div>
                    </div>
                  </div>
                  <div class="wp-block-column flex flex-col">

                  </div>
                </div>

              </div>
              <div class="max-w-4xl mx-auto mt-8">
                <h3>After Photos</h3>
                <div class="wp-block-columns max-w-4xl mx-auto">
                  <div class="wp-block-column flex flex-col">
                    <div class="flex items-center max-w-4xl mx-auto avatar">
                      <?php
                      $photo = get_field('after_occluded_buccal_view_of_anterior', $case->ID);
                      if (empty($photo)) $photo = 'http://ec2-18-144-32-142.us-west-1.compute.amazonaws.com//wp-content/uploads/2021/01/no_photo.png';
                      ?>
                      <img src="<?php echo $photo; ?>" />
                      <div class="flex flex-col">
                        <label class="text-h5-grey uppercase text-xs font-bold">Occluded buccal view of anterior</label>
                        <input type="file" id="after_occluded_buccal_view_of_anterior" name="after_occluded_buccal_view_of_anterior" accept="image/png, image/jpeg">
                      </div>
                    </div>
                  </div>
                  <div class="wp-block-column flex flex-col">
                    <div class="flex items-center max-w-4xl mx-auto avatar">
                      <?php
                      $photo = get_field('after_occluded_buccal_view_of_right_lateral', $case->ID);
                      if (empty($photo)) $photo = 'http://ec2-18-144-32-142.us-west-1.compute.amazonaws.com//wp-content/uploads/2021/01/no_photo.png';
                      ?>
                      <img src="<?php echo $photo; ?>" />
                      <div class="flex flex-col">
                        <label class="text-h5-grey uppercase text-xs font-bold">Occluded buccal view of right lateral</label>
                        <input type="file" id="after_occluded_buccal_view_of_right_lateral" name="after_occluded_buccal_view_of_right_lateral" accept="image/png, image/jpeg">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="wp-block-columns max-w-4xl mx-auto">
                  <div class="wp-block-column flex flex-col">
                    <div class="flex items-center max-w-4xl mx-auto avatar">
                      <?php
                      $photo = get_field('after_occluded_buccal_view_of_left_lateral', $case->ID);
                      if (empty($photo)) $photo = 'http://ec2-18-144-32-142.us-west-1.compute.amazonaws.com//wp-content/uploads/2021/01/no_photo.png';
                      ?>
                      <img src="<?php echo $photo; ?>" />
                      <div class="flex flex-col">
                        <label class="text-h5-grey uppercase text-xs font-bold">Occluded buccal view of left lateral</label>
                        <input type="file" id="after_occluded_buccal_view_of_left_lateral" name="after_occluded_buccal_view_of_left_lateral" accept="image/png, image/jpeg">
                      </div>
                    </div>
                  </div>
                  <div class="wp-block-column flex flex-col">
                    <div class="flex items-center max-w-4xl mx-auto avatar">
                      <?php
                      $photo = get_field('after_occlusal_view_of_upper', $case->ID);
                      if (empty($photo)) $photo = 'http://ec2-18-144-32-142.us-west-1.compute.amazonaws.com//wp-content/uploads/2021/01/no_photo.png';
                      ?>
                      <img src="<?php echo $photo; ?>" />
                      <div class="flex flex-col">
                        <label class="text-h5-grey uppercase text-xs font-bold">Occlusal view of upper</label>
                        <input type="file" id="after_occlusal_view_of_upper" name="after_occlusal_view_of_upper" accept="image/png, image/jpeg">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="wp-block-columns max-w-4xl mx-auto">
                  <div class="wp-block-column flex flex-col">
                    <div class="flex items-center max-w-4xl mx-auto avatar">
                      <?php
                      $photo = get_field('after_occlusal_view_of_lower', $case->ID);
                      if (empty($photo)) $photo = 'http://ec2-18-144-32-142.us-west-1.compute.amazonaws.com//wp-content/uploads/2021/01/no_photo.png';
                      ?>
                      <img src="<?php echo $photo; ?>" />
                      <div class="flex flex-col">
                        <input type="file" id="after_occlusal_view_of_lower" name="after_occlusal_view_of_lower" accept="image/png, image/jpeg">
                        <label class="text-h5-grey uppercase text-xs font-bold">Occlusal view of lower</label>
                      </div>
                    </div>
                  </div>
                  <div class="wp-block-column flex flex-col">

                  </div>
                </div>

              </div>
              <div class="max-w-4xl mx-auto mt-8">
                <h3>Progress Photos</h3>
                <div class="wp-block-columns max-w-4xl mx-auto">
                  <div class="wp-block-column flex flex-col">
                    <div class="flex items-center max-w-4xl mx-auto avatar">
                      <?php
                      $photo = get_field('progress_occluded_buccal_view_of_anterior', $case->ID);
                      if (empty($photo)) $photo = 'http://ec2-18-144-32-142.us-west-1.compute.amazonaws.com//wp-content/uploads/2021/01/no_photo.png';
                      ?>
                      <img src="<?php echo $photo; ?>" />
                      <div class="flex flex-col">
                        <label class="text-h5-grey uppercase text-xs font-bold">Occluded buccal view of anterior</label>
                        <input type="file" id="progress_occluded_buccal_view_of_anterior" name="progress_occluded_buccal_view_of_anterior" accept="image/png, image/jpeg">
                      </div>
                    </div>
                  </div>
                  <div class="wp-block-column flex flex-col">
                    <div class="flex items-center max-w-4xl mx-auto avatar">
                      <?php
                      $photo = get_field('progress_occluded_buccal_view_of_right_lateral', $case->ID);
                      if (empty($photo)) $photo = 'http://ec2-18-144-32-142.us-west-1.compute.amazonaws.com//wp-content/uploads/2021/01/no_photo.png';
                      ?>
                      <img src="<?php echo $photo; ?>" />
                      <div class="flex flex-col">
                        <label class="text-h5-grey uppercase text-xs font-bold">Occluded buccal view of right lateral</label>
                        <input type="file" id="progress_occluded_buccal_view_of_right_lateral" name="progress_occluded_buccal_view_of_right_lateral" accept="image/png, image/jpeg">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="wp-block-columns max-w-4xl mx-auto">
                  <div class="wp-block-column flex flex-col">
                    <div class="flex items-center max-w-4xl mx-auto avatar">
                      <?php
                      $photo = get_field('progress_occluded_buccal_view_of_left_lateral', $case->ID);
                      if (empty($photo)) $photo = 'http://ec2-18-144-32-142.us-west-1.compute.amazonaws.com//wp-content/uploads/2021/01/no_photo.png';
                      ?>
                      <img src="<?php echo $photo; ?>" />
                      <div class="flex flex-col">
                        <label class="text-h5-grey uppercase text-xs font-bold">Occluded buccal view of left lateral</label>
                        <input type="file" id="progress_occluded_buccal_view_of_left_lateral" name="progress_occluded_buccal_view_of_left_lateral" accept="image/png, image/jpeg">
                      </div>
                    </div>
                  </div>
                  <div class="wp-block-column flex flex-col">
                    <div class="flex items-center max-w-4xl mx-auto avatar">
                      <?php
                      $photo = get_field('progress_occlusal_view_of_upper', $case->ID);
                      if (empty($photo)) $photo = 'http://ec2-18-144-32-142.us-west-1.compute.amazonaws.com//wp-content/uploads/2021/01/no_photo.png';
                      ?>
                      <img src="<?php echo $photo; ?>" />
                      <div class="flex flex-col">
                        <label class="text-h5-grey uppercase text-xs font-bold">Occlusal view of upper</label>
                        <input type="file" id="progress_occlusal_view_of_upper" name="progress_occlusal_view_of_upper" accept="image/png, image/jpeg">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="wp-block-columns max-w-4xl mx-auto">
                  <div class="wp-block-column flex flex-col">
                    <div class="flex items-center max-w-4xl mx-auto avatar">
                      <?php
                      $photo = get_field('progress_occlusal_view_of_lower', $case->ID);
                      if (empty($photo)) $photo = 'http://ec2-18-144-32-142.us-west-1.compute.amazonaws.com//wp-content/uploads/2021/01/no_photo.png';
                      ?>
                      <img src="<?php echo $photo; ?>" />
                      <div class="flex flex-col">
                        <input type="file" id="progress_occlusal_view_of_lower" name="progress_occlusal_view_of_lower" accept="image/png, image/jpeg">
                        <label class="text-h5-grey uppercase text-xs font-bold">Occlusal view of lower</label>
                      </div>
                    </div>
                  </div>
                  <div class="wp-block-column flex flex-col">

                  </div>
                </div>

              </div>
              <div class="max-w-4xl mx-auto mt-8">
                <h3>Radiographs</h3>
                <div class="wp-block-columns max-w-4xl mx-auto">
                  <div class="wp-block-column flex flex-col">
                    <div class="flex items-center max-w-4xl mx-auto avatar">
                      <?php
                      $photo = get_field('before_panoramic_x-ray', $case->ID);
                      if (empty($photo)) $photo = 'http://ec2-18-144-32-142.us-west-1.compute.amazonaws.com//wp-content/uploads/2021/01/no_photo.png';
                      ?>
                      <img src="<?php echo $photo; ?>" />
                      <div class="flex flex-col">
                        <label class="text-h5-grey uppercase text-xs font-bold">Occluded buccal view of anterior</label>
                        <input type="file" id="before_panoramic_x-ray" name="before_panoramic_x-ray" accept="image/png, image/jpeg">
                      </div>
                    </div>
                  </div>
                  <div class="wp-block-column flex flex-col">
                    <div class="flex items-center max-w-4xl mx-auto avatar">
                      <?php
                      $photo = get_field('before_cephalometric_x-ray', $case->ID);
                      if (empty($photo)) $photo = 'http://ec2-18-144-32-142.us-west-1.compute.amazonaws.com//wp-content/uploads/2021/01/no_photo.png';
                      ?>
                      <img src="<?php echo $photo; ?>" />
                      <div class="flex flex-col">
                        <label class="text-h5-grey uppercase text-xs font-bold">Occluded buccal view of right lateral</label>
                        <input type="file" id="before_cephalometric_x-ray" name="before_cephalometric_x-ray" accept="image/png, image/jpeg">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="wp-block-columns max-w-4xl mx-auto">
                  <div class="wp-block-column flex flex-col">
                    <div class="flex items-center max-w-4xl mx-auto avatar">
                      <?php
                      $photo = get_field('after_panoramic_x-ray', $case->ID);
                      if (empty($photo)) $photo = 'http://ec2-18-144-32-142.us-west-1.compute.amazonaws.com//wp-content/uploads/2021/01/no_photo.png';
                      ?>
                      <img src="<?php echo $photo; ?>" />
                      <div class="flex flex-col">
                        <label class="text-h5-grey uppercase text-xs font-bold">Occluded buccal view of left lateral</label>
                        <input type="file" id="after_panoramic_x-ray" name="after_panoramic_x-ray" accept="image/png, image/jpeg">
                      </div>
                    </div>
                  </div>
                  <div class="wp-block-column flex flex-col">
                    <div class="flex items-center max-w-4xl mx-auto avatar">
                      <?php
                      $photo = get_field('after_cephalometric_x-ray', $case->ID);
                      if (empty($photo)) $photo = 'http://ec2-18-144-32-142.us-west-1.compute.amazonaws.com//wp-content/uploads/2021/01/no_photo.png';
                      ?>
                      <img src="<?php echo $photo; ?>" />
                      <div class="flex flex-col">
                        <label class="text-h5-grey uppercase text-xs font-bold">Occlusal view of upper</label>
                        <input type="file" id="after_cephalometric_x-ray" name="after_cephalometric_x-ray" accept="image/png, image/jpeg">
                      </div>
                    </div>
                  </div>
                </div>


              </div>
              <div class=" max-w-4xl w-full mx-auto flex flex-col">

                <input type="submit" class="w-full max-w-xs bg-pink text-white text-sm uppercase mx-auto rounded my-12 py-4 font-bold" value="SUBMIT" />
              </div>

            </form>
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
<!-- /section -->
</main>
<?php get_footer(); ?>