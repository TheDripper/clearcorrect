import $ from "jquery";
import "featherlight";
export default () => {
  $(".feather").on("click", function (e) {
    $.featherlight($(this));
  });
  $(".resources a").on("click", function (e) {
    e.preventDefault();
    $.featherlight($(".modal"));
  });
  $(".delete").on("click", function (e) {
    e.preventDefault();
    $.featherlight($(this).next());
  });
  $(".modal-link").on("click", function (e) {
    $.featherlight($(this).parent().next());
  });
};
