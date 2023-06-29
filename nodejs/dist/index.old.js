"use strict";

function _createForOfIteratorHelper(o, allowArrayLike) { var it = typeof Symbol !== "undefined" && o[Symbol.iterator] || o["@@iterator"]; if (!it) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = it.call(o); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }
function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }
function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) arr2[i] = arr[i]; return arr2; }
function Page1() {
  var DATA_KEY = "data";
  var table = document.createElement("table");
  var tbody = document.createElement("tbody");
  var data = localStorage.getItem(DATA_KEY);
  if (!data) {
    data = {};
  } else {
    data = JSON.parse(data);
  }
  table.appendChild(tbody);
  for (var i = 0; i < 5; i++) {
    var tr = document.createElement("tr");
    tbody.appendChild(tr);
    for (var j = 0; j < 5; j++) {
      var _data$td$dataset$key;
      var td = document.createElement("td");
      tr.appendChild(td);
      td.dataset.key = "".concat(i, "-").concat(j);
      var text = document.createTextNode((_data$td$dataset$key = data[td.dataset.key]) !== null && _data$td$dataset$key !== void 0 ? _data$td$dataset$key : "text");
      td.appendChild(text);
      td.addEventListener("click", changeTextIntoInput);
    }
  }
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
  return table;
}
function Page2() {
  var h1 = document.createElement("h1");
  h1.appendChild(document.createTextNode("Coucou"));
  return h1;
}
var routes = {
  "/page1": function page1() {
    return generateStructure(Page1Structure());
  },
  "/page2": function page2() {
    return generateStructure(Page2Structure());
  }
};
var root = document.getElementById("root");
function HashRouter(routes, rootElement) {
  var pathname = location.hash.slice(1);
  rootElement.appendChild(routes[pathname]());
  window.onhashchange = function () {
    var pathname = location.hash.slice(1);
    rootElement.replaceChild(routes[pathname](), rootElement.childNodes[0]);
  };
}
function BrowserRouter(routes, rootElement) {
  var pathname = location.pathname;
  rootElement.appendChild(routes[pathname]());
  var oldPushState = history.pushState;
  history.pushState = function (data, unused, url) {
    oldPushState.call(history, data, unused, url);
    window.dispatchEvent(new Event("popstate"));
  };
  window.addEventListener("popstate", function () {
    var pathname = location.pathname;
    rootElement.replaceChild(routes[pathname](), rootElement.childNodes[0]);
  });
}
BrowserRouter(routes, root);
var page1 = {
  attributes: {},
  children: ["Coucou", {
    type: "",
    children: []
  }],
  type: "",
  events: {}
};
function generateStructure(structure) {
  var element = document.createElement(structure.type);
  if (structure.attributes) {
    for (var attrName in structure.attributes) {
      if (attrName.startsWith("data-")) {
        element.dataset[attrName.replace("data-", "")] = structure.attributes[attrName];
      } else element.setAttribute(attrName, structure.attributes[attrName]);
    }
  }
  if (structure.events) {
    for (var eventName in structure.events) {
      element.addEventListener(eventName, structure.events[eventName]);
    }
  }
  if (structure.children) {
    var _iterator = _createForOfIteratorHelper(structure.children),
      _step;
    try {
      for (_iterator.s(); !(_step = _iterator.n()).done;) {
        var child = _step.value;
        var subChild = void 0;
        if (typeof child === "string") {
          subChild = document.createTextNode(child);
        } else {
          subChild = generateStructure(child);
        }
        element.appendChild(subChild);
      }
    } catch (err) {
      _iterator.e(err);
    } finally {
      _iterator.f();
    }
  }
  return element;
}
function Page2Structure() {
  return {
    type: "div",
    children: [BrowserLink("Page 1", "/page1"), {
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
    }]
  };
}
function Page1Structure() {
  var DATA_KEY = "data";
  var data = localStorage.getItem(DATA_KEY);
  if (!data) {
    data = {};
  } else {
    data = JSON.parse(data);
  }
  return {
    type: "div",
    children: [BrowserLink("Page 2", "/page2"), {
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
function HashLink(title, link) {
  return {
    type: "a",
    attributes: {
      href: "#" + link
    },
    children: [title]
  };
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