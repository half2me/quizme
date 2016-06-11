<h1><?= h($data->name) ?></h1>
<h2><?= h($correctAttribute->attribute_type->name) ?>:</h2>
<?php foreach ($attributes as $a): ?>
<label id="<?= h($a->id) ?>">
    <h4><input type="radio" onclick="myFunction(<?= h($a->id) ?>)" /><?= h($a->value) ?></h4>
</label>
<?php endforeach; ?>
<h4><input type="button" value="Next" onClick="window.location.reload()"></h4>

<script>
    function myFunction(id) {
        var correct = <?= h($correctAttribute->id) ?>;
        var item = document.getElementById(id);
        if (id == correct) {
            item.style.backgroundColor = "#00FF00";
        } else {
            item.style.backgroundColor = "red";
        }
    }
</script>