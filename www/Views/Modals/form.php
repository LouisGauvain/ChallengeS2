<form method="<?= $config["config"]["method"] ?? "GET" ?>" action="<?= $config["config"]["action"] ?>" enctype="<?= $config["config"]["enctype"] ?>">
    <?php foreach ($config["inputs"] as $name => $input) : ?>
        <?php if ($input["type"] == "select") : ?>
            <label>
                <?= $input["label"] ?>
                <select name="<?= $name; ?>">
                    <?php foreach ($input["options"] as $option) : ?>
                        <option><?= $option; ?></option>
                    <?php endforeach; ?>
                </select>
            </label>
        <?php else : ?>
            <label>
                <?= $input["label"] ?>
                <input name="<?= $name; ?>" type="<?= $input["type"] ?>" placeholder="<?= $input["placeholder"] ?>" class="<?= $input["class"] ?? "" ?>">
            </label>
        <?php endif; ?>
    <?php endforeach; ?>
    <input type="submit" name="submit" value="<?= $config["config"]["submit"] ?>">
    <input type="reset" value="<?= $config["config"]["cancel"] ?>">
</form>