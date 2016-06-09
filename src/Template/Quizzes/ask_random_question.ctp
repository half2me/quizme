Name: <?= h($data->name) ?> <br />
Question: <?= h($correctAttribute->attribute_type->name) ?> <br />
Possible Answers:
<form action="">
    <?php foreach ($attributes as $a): ?>
        <input type="radio"><?= h($a->value) ?> <br />
    <?php endforeach; ?>
</form>
</table>
Correct Answer: <?= h($correctAttribute->value) ?>