const express = require('express');

const app = express();
const port = 3000;

// Endpoint pour l'appel d'API
app.get('/api', (req, res) => {
  res.send('Appel d\'API réussi !');
});

// Démarrer le serveur
app.listen(port, () => {
  console.log(`Le serveur est en cours d'exécution sur le port ${port}`);
});
