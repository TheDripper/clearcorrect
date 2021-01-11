export default (el) => {
    // Special bonus for those using jQuery
    el = el[0];
    // if (typeof jQuery === "function" && el instanceof jQuery) {
    // }

    var rect = el.getBoundingClientRect();

    return (
        rect.top >= 0 &&
        rect.left >= 0 &&
        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) && /* or $(window).height() */
        rect.right <= (window.innerWidth || document.documentElement.clientWidth) /* or $(window).width() */
    );
}