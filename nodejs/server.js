const express = require('express');
const cors = require('cors');
const { JSDOM } = require('jsdom');

const dom = new JSDOM('<!DOCTYPE html><html><body><div id="root"></div></body></html>');
const document = dom.window.document;
global.document = document;

const app = express();
const port = 3000;

const generateStructure = require('./dist/core/DomRenderer.js').default;
const root = document.getElementById("root");

app.use(cors());
app.use(express.json());

app.post('/', (req, res) => {
  const structure = req.body;
  const element = generateStructure(structure);
  root.innerHTML = "";
  root.appendChild(element);
  res.send(document.body.innerHTML);
});


app.listen(port, () => {
  console.log(`Le serveur Express écoute sur le port ${port}`);
});