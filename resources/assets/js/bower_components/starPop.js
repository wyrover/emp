/********************************
 提示框
 ********************************/
var StarPop = (function() {
    "use strict";
    var elem,
        hideHandler,
        that = {};

    that.init = function(options) {
        elem = $(options.selector);
    };

    that.show = function(text) {
        clearTimeout(hideHandler);

        elem.find("span").html(text);
        elem.delay(100).slideDown().delay(4000).slideUp();
    };

    return that;
}());