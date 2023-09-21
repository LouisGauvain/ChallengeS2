<h2>Créer un nouveau modèle de page</h2>

<?php
if (isset($errors)) {
    echo "<div class='alert alert-danger' style='width: 80%;margin: auto;'>";
    foreach ($errors as $error) {
        echo "<p>" . $error . "</p>";
    }
    echo "</div>";
}
?>

<?php $this->modal("form", $form); ?>

<div id="preview-container"></div>