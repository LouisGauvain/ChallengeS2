"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = Page2;
var _BrowserRouter = require("../components/BrowserRouter.js");
var _Button = _interopRequireDefault(require("../components/Button.js"));
var _Compteur = _interopRequireDefault(require("../components/Compteur.js"));
function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { "default": obj }; }
function Page2() {
  return {
    type: "div",
    children: [(0, _BrowserRouter.BrowserLink)("Page 1", "/page1"), {
      type: "h1",
      children: ["Coucou"]
    }, {
      type: "h2",
      children: ["Bonsoir"]
    }, {
      type: "h3",
      children: ["Tout le monde"]
    }, {
      type: "p",
      children: ["Ici le javascript"]
    },
    // Version alternative : plus facile pour l'update
    // {
    //   type: Button,
    //   attributes: {
    //     title: "Coucou button",
    //     style: {
    //       backgroundColor: "blue",
    //       color: "white",
    //     },
    //     onClick: () => alert("coucou"),
    //   },
    // },
    (0, _Button["default"])({
      title: "Coucou button",
      style: {
        backgroundColor: "blue",
        color: "white"
      },
      onClick: function onClick() {
        return alert("coucou");
      }
    }),
    // Version alternative : plus facile pour l'update
    //{
    //  type: Compteur,
    //  attributes: {
    //    initialValue: 10
    //  }
    //},
    (0, _Compteur["default"])({
      initialValue: 10
    })]
  };
}