import 'jquery';
import './style.scss';

import Router from './util/Router';
import common from './routes/common';
import home from './routes/home';
import featherlight from './util/featherlight';

const masonry = require("masonry-layout");


/**
 * Populate Router instance with DOM routes
 * @type {Router} routes - An instance of our router
 */
const routes = new Router({
  /** All pages */
  featherlight,
  common,
  /** Home page */
  home,
  /** About Us page, note the change from about-us to aboutUs. */
});

/** Load Events */
jQuery(document).ready(() => {
  featherlight();
  routes.loadEvents();
  masonry;
});
