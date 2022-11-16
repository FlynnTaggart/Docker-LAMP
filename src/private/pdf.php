<?php
include 'session.php';
include 'constants.php';

$dictionary = $DICTIONARY[$_SESSION['language']];

$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
    header('Location: /private/index.php');
} else {
    if ($_FILES['userfile']['size'] == 0){
        header('Location: /private/index.php');
    }
    echo '<pre>';
    echo $dictionary->FILE_ERROR . "\n";
}

print_r($_FILES);

print "</pre>";
?>
