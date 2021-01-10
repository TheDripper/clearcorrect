import $ from "jquery";
import "featherlight";
export default () => {
  $(".cases-masonry .wp-block-image").on('click', function(e){
      $.featherlight($(this));
  });
};
