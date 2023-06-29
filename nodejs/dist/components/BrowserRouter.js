"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.BrowserLink = BrowserLink;
exports["default"] = BrowserRouter;
var _DomRenderer = _interopRequireDefault(require("../core/DomRenderer.js"));
function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { "default": obj }; }
function BrowserRouter(routes, rootElement, pathname) {
  rootElement.appendChild((0, _DomRenderer["default"])(routes[pathname]()));

  /*const oldPushState = history.pushState;
  history.pushState = function (data, unused, url) {
    oldPushState.call(history, data, unused, url);
    window.dispatchEvent(new Event("popstate"));
  };
   window.addEventListener("popstate", function () {
    const pathname = location.pathname;
     rootElement.replaceChild(
      DomRenderer(routes[pathname]()),  
      rootElement.childNodes[0]
    );
  });*/
}

function BrowserLink(title, link) {
  return {
    type: "a",
    attributes: {
      href: link
    },
    children: [title],
    events: {
      click: function click(event) {
        event.preventDefault();
        history.pushState({}, undefined, link);
      }
    }
  };
}