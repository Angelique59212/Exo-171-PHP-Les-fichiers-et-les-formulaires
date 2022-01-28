<?php
require __DIR__ . '/function.php';
$errors = [];
$typeMime = ['image/jpeg', 'image/jpg', 'image/gif', 'image/png'];



if (isset($_FILES['fileUser'])) {
    if ($_FILES['fileUser']['error'] === 0) {
        if (in_array($_FILES['fileUser']['type'], $typeMime)) {

            $sizeMaxFile = 3 * 1024 * 1024;
            if ((int)$_FILES['fileUser']['size'] <= $sizeMaxFile) {
                $tmp_name = $_FILES['fileUser']['tmp_name'];
                $name = getRandomFile($_FILES['fileUser']['name']);
                if (!is_dir('uploads')) {
                    mkdir('uploads', '0755');
                }
                move_uploaded_file($tmp_name, 'uploads/' .$name);
            }
            else {
                $errors[] = "La taille du fichier est limité à 3Mo ";
            }
        }
        else {
            $errors[] = "Vous devez fournir un fichier image";
        }
    }
    else {
       $errors[] = "Une erreur s'est produite en uplodant votre fichier";
    }
}
if (count($errors) > 0) {
    header('Location: index.php?fe=' . base64_encode(json_encode($errors)));
}
