"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = Compteur;
var _Button = _interopRequireDefault(require("./Button.js"));
function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { "default": obj }; }
function Compteur(_ref) {
  var _ref$initialValue = _ref.initialValue,
    initialValue = _ref$initialValue === void 0 ? 0 : _ref$initialValue;
  var compteur = initialValue;
  console.log("Compteur", compteur);
  return {
    type: "div",
    children: [(0, _Button["default"])({
      title: "-",
      style: {
        backgroundColor: "red"
      },
      onClick: function onClick() {
        return compteur--;
      }
    }), "Current compteur: {{compteur}}", (0, _Button["default"])({
      title: "+",
      style: {
        backgroundColor: "green"
      },
      onClick: function onClick() {
        return compteur++;
      }
    })]
  };
}