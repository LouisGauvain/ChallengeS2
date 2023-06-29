"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = Page1;
var _BrowserRouter = require("../components/BrowserRouter.js");
function Page1() {
  var DATA_KEY = "data";
  var data = localStorage.getItem(DATA_KEY);
  if (!data) {
    data = {};
  } else {
    data = JSON.parse(data);
  }
  return {
    type: "div",
    children: [(0, _BrowserRouter.BrowserLink)("Page 2", "/page2"), {
      type: "table",
      children: [{
        type: "tbody",
        children: Array.from({
          length: 5
        }, function (_, i) {
          return {
            type: "tr",
            children: Array.from({
              length: 5
            }, function (_, j) {
              var _data;
              return {
                type: "td",
                attributes: {
                  "data-key": "".concat(i, "-").concat(j)
                },
                children: [(_data = data["".concat(i, "-").concat(j)]) !== null && _data !== void 0 ? _data : "text"],
                events: {
                  click: changeTextIntoInput
                }
              };
            })
          };
        })
      }]
    }]
  };
  function changeTextIntoInput(event) {
    var td = event.currentTarget;
    var textNode = td.childNodes[0];
    var text = textNode.textContent;
    var input = document.createElement("input");
    input.value = text;
    td.removeChild(textNode);
    td.appendChild(input);
    input.focus();
    td.removeEventListener("click", changeTextIntoInput);
    input.addEventListener("blur", changeInputIntoText);
  }
  function changeInputIntoText(event) {
    var input = event.currentTarget;
    var textNode = document.createTextNode(input.value);
    data[input.parentNode.dataset.key] = input.value;
    localStorage.setItem(DATA_KEY, JSON.stringify(data));
    input.removeEventListener("blur", changeInputIntoText);
    input.parentNode.addEventListener("click", changeTextIntoInput);
    input.parentNode.replaceChild(textNode, input);
  }
}