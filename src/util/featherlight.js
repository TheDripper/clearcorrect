import $ from "jquery";
import "featherlight";
export default () => {
  $(".feather").on('click', function(e){
      $.featherlight($(this));
  });
};
