"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.HashLink = HashLink;
exports["default"] = HashRouter;
var _DomRenderer = _interopRequireDefault(require("../core/DomRenderer.js"));
function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { "default": obj }; }
function HashLink(title, link) {
  return {
    type: "a",
    attributes: {
      href: "#" + link
    },
    children: [title]
  };
}
function HashRouter(routes, rootElement) {
  var pathname = location.hash.slice(1);
  rootElement.appendChild((0, _DomRenderer["default"])(routes[pathname]()));
  window.onhashchange = function () {
    var pathname = location.hash.slice(1);
    rootElement.replaceChild((0, _DomRenderer["default"])(routes[pathname]()), rootElement.childNodes[0]);
  };
}