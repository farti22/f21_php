<?php

use Models\Doctor;

if (isset($query[2])) {
    $id = $query[2];

    $doctor = Doctor::find($id, $pdo);
    if (!isset($doctor)) {
        echo "Doctor not found (id: $id)";
    } else
        $name = $doctor->getName();
}

?>
<?php if (isset($doctor) || $query[1] == "add") : ?>
    <form method="post" action="index?doctor">

        <input type="hidden" name="id" value=<?= $id ?? 0 ?> />
        <?php if ($query[1] != "delete") : ?>
            <p>Enter name: <input type="text" name="name" value=<?= $name ?? " " ?>></p>
        <?php else : ?>
            <p>Your sure? Will be removed Doctor ( <?= $doctor->getId() . ": " . $doctor->getName() ?> )</p>
            <a href=<?= 'index?' . $query[0] ?>>Cancel</a>
        <?php endif; ?>

        <input type="submit" name="submit" value=<?= $query[1] ?>>
    </form>
<?php endif; ?>