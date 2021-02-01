<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
  <link href="//cdn.jsdelivr.net/npm/featherlight@1.7.14/release/featherlight.min.css" type="text/css" rel="stylesheet" />
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <header>
    <div class="bg-grey logo-cont m-0 w-full relative z-10 w-full">
      <div class="max-w-6xl w-full mx-auto flex justify-end items-end">
        <a href="/"><img class="logo mt-6 mb-4" src="<?php echo get_template_directory_uri() . '/build/images/logo.png'; ?>" /></a>
      </div>
    </div>
    <nav class="flex justify-between items-center py-2 m-0 w-full max-w-6xl relative z-10 w-full max-w-6xl mx-auto">
      <a href="/stories">Case Gallery</a>
      <div class="w-1/3 flex justify-between items-start self-start">
        <div class="search-wrap relative">
          <?php if (is_page('search')) : ?>
            <?php echo facetwp_display('facet', 'search_bar'); ?>
          <?php else : ?>
            <input id="search" placeholder="Search" type="text" />
            <img src="/wp-content/themes/template/build/images/Search.svg" />
          <?php endif; ?>
        </div>
        <?php if (current_user_can('author')) : ?>
          <ul class="logged-in-dropdown">
            <li><a href="/doctor-dashboard"><?php echo wp_get_current_user()->user_login; ?></a></li>
            <li><a href="/doctor-dashboard">Dashboard</a></li>
            <li><a href="/doctor-messages">Messages</a></li>
            <li><a href="/logout">Sign Out</a></li>
          </ul>
        <?php elseif (current_user_can('contributor')) : ?>
          <ul class="logged-in-dropdown">
            <li><a href="/patient-dashboard"><?php echo wp_get_current_user()->user_login; ?></a></li>
            <li><a href="/patient-dashboard">Dashboard</a></li>
            <li><a href="/patient-messages">Messages</a></li>
            <li><a href="/logout">Sign Out</a></li>
          </ul>
        <?php else : ?>
          <ul class="flex">
            <li class="mr-2 border-r pr-2"><a href="/login">Login</a></li>
            <li><a href="/register">Register</a></li>
          </ul>
        <?php endif; ?>
      </div>
    </nav>
  </header>