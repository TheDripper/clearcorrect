import $ from "jquery";
import "featherlight";
export default () => {
  $(".feather").on('click', function(e){
      $.featherlight($(this));
  });
  $('.resources a').on('click', function(e){
      e.preventDefault();
      $.featherlight($('.modal'));
  });
};
