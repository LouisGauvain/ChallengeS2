<h2>Créer votre page à partir du choix de votre template</h2>

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