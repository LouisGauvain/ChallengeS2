<div class="div_input">
    <h2>Modifier user: <?php echo $fullname ?></h2>

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
</div>