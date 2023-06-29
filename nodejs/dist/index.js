"use strict";

var _BrowserRouter = _interopRequireDefault(require("./components/BrowserRouter.js"));
var _routes = _interopRequireDefault(require("./routes.js"));
function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { "default": obj }; }
var root = document.getElementById("root");
(0, _BrowserRouter["default"])(_routes["default"], root);