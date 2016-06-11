<h2><?= h($attribute->attribute_type->name) ?>: <?= h($attribute->value) ?></h2    >
<?php foreach ($data as $a): ?>
<label id="<?= h($a->id) ?>">
    <h4><input type="radio" onclick="myFunction(<?= h($a->id) ?>)" /><?= h($a->name) ?></h4>
</label>
<?php endforeach; ?>
<h4><input type="button" value="Next" onClick="window.location.reload()"></h4>

<script>
    function myFunction(id) {
        var correct = <?= h($correctData->id) ?>;
        var item = document.getElementById(id);
        if (id == correct) {
            item.style.backgroundColor = "#00FF00";
        } else {
            item.style.backgroundColor = "red";
        }
    }
</script>