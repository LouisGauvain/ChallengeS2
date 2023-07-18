<?php

use App\Core\Utils;

?>
<form method="<?= $config["config"]["method"] ?? "GET" ?>" action="<?= $config["config"]["action"] ?>" enctype="<?= $config["config"]["enctype"] ?>">
    <?php if (is_array($config["inputs"])) : ?>
        <?php foreach ($config["inputs"] as $name => $input) : ?>
            <?php if ($input["type"] == "select") : ?>
                <select class="<?= $input["class"] ?? "" ?>" name="<?= $name; ?>">
                    <?php foreach ($input["options"] as $option) : ?>
                        <option><?= $option; ?></option>
                    <?php endforeach; ?>
                </select>
            <?php elseif ($input["type"] == "checkbox") : ?>
                <input class="<?= $input["class"] ?? "" ?>" name="<?= $name; ?>" type="<?= $input["type"] ?>" <?php if (isset($input["checked"]) && $input["checked"] == true) : ?> checked <?php endif; ?>>
                <label class="<?= $input["class"] ?? "" ?>" for="<?= $name; ?>"><?= $input["label"]; ?></label>
            <?php elseif ($input["type"] == "radio") : ?>
                <input id="<?= $input["name"] ?? ""; ?>" class="<?= $input["class"] ?? "" ?>" name="<?= $input["name"]; ?>" type="<?= $input["type"] ?>" <?php if (isset($input["checked"]) && $input["checked"] == true) : ?> checked <?php endif; ?>>
                <label class="<?= $input["class"] ?? "" ?>" for="<?= $input["for"] ?>"><?= $input["label"]; ?></label>
            <?php else : ?>
                <input class="<?= $input["class"] ?? "" ?>" name="<?= $name; ?>" type="<?= $input["type"] ?>" placeholder="<?= $input["placeholder"] ?? "" ?>" value="<?= $input["value"] ?? ""; ?>">
            <?php endif; ?>
        <?php endforeach; ?>
    <?php else : ?>
        <?= $config["inputs"]; ?>
    <?php endif; ?>
    <input type="submit" name="submit" value="<?= $config["config"]["submit"] ?>">
    <input type="reset" value="<?= $config["config"]["cancel"] ?>">
</form>