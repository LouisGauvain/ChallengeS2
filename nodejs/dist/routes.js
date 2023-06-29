"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = void 0;
var _Page = _interopRequireDefault(require("./views/Page1.js"));
var _Page2 = _interopRequireDefault(require("./views/Page2.js"));
function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { "default": obj }; }
var _default = {
  "/page1": _Page["default"],
  "/page2": _Page2["default"]
};
exports["default"] = _default;