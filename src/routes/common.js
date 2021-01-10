import Masonry from "masonry-layout";

export default {
  init() {
    // JavaScript to be fired on all pages
    console.log("common");
    var grid = document.querySelector(
      ".masonry .wp-block-group__inner-container"
    );
    console.log(grid.length);
    if (grid) {
      console.log("test");
      var msnry = new Masonry(grid, {
        // options...
        itemSelector: ".wp-block-image",
        columnWidth: 280,
      });
    }
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
