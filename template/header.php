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
      <div class="w-1/3 flex justify-between items-center">
        <div class="search-wrap relative">
          <input placeholder="Search" type="text" />
        </div>
				<ul class="flex">
					<li class="mr-2 border-r pr-2">Login</li>
					<li>Register</li>
				</ul>
			</div>
		</nav>
	</header>