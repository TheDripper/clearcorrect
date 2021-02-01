import 'jquery';
import 'jquery-ui';
import './style.scss';

import Router from './util/Router';
import common from './routes/common';
import home from './routes/home';
import stories from './routes/stories';
import featherlight from './util/featherlight';
import visible from './util/visible';

const masonry = require("masonry-layout");


/**
 * Populate Router instance with DOM routes
 * @type {Router} routes - An instance of our router
 */
const routes = new Router({
  /** All pages */
  featherlight,
  visible,
  common,
  /** Home page */
  home,
  stories
  /** About Us page, note the change from about-us to aboutUs. */
});

/** Load Events */
jQuery(document).ready(() => {
  featherlight();
  routes.loadEvents();
  masonry;
});
