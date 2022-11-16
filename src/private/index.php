<?php
include 'session.php';
include 'constants.php';

$dictionary = $DICTIONARY[$_SESSION['language']];
?>

<html lang="en">
<head>
    <title><?php echo $dictionary->TITLE ?></title>
    <link rel="stylesheet" href="style.css" type="text/css"/>
    <?php
    if ($_SESSION['theme'] == THEME::$DARK) {
        echo '<link rel="stylesheet" href="style-dark.css">';
    }
    ?>

</head>
<body>
<h1><?php echo $dictionary->TITLE ?> <?php echo $_SESSION['nickname'] ?></h1>
<div>
    <a href="./exec.php"><?php echo $dictionary->EXEC_TITLE ?></a>
    <a href="./restaurant.php"><?php echo $dictionary->RESTAURANT_TITLE ?></a>
</div>
<h2><?php echo $dictionary->SETTINGS ?></h2>
<form action="setting.php" method="post">
    <div>
        <?php echo $dictionary->THEME ?>: <br>
        <label>
            <input type="radio" name="theme"
                <?php
                if ($_SESSION['theme'] == THEME::$LIGHT) {
                    echo "checked";
                }
                ?> value="light">
            <?php echo $dictionary->LIGHT ?>
        </label>
        <label>
            <input type="radio" name="theme"
                <?php
                if ($_SESSION['theme'] == THEME::$DARK) {
                    echo "checked";
                }
                ?> value="dark">
            <?php echo $dictionary->DARK ?>
        </label>
    </div>
    <div>
        <?php echo $dictionary->LANGUAGE ?>: <br>
        <label>
            <input type="radio" name="language"
                <?php
                if ($_SESSION['language'] == LANGUAGE::$RU) {
                    echo "checked";
                }
                ?>
                   value="ru"
            >
            Русский
        </label>
        <label>
            <input type="radio" name="language"
                <?php
                if ($_SESSION['language'] == LANGUAGE::$EN) {
                    echo "checked";
                }
                ?>
                   value="en"
            >
            English
        </label>
    </div>

    <div>
        <label>
            <?php echo $dictionary->NICKNAME ?>:
            <input type="text" name="nickname" value="<?php echo $_SESSION['nickname'] ?>">
        </label>
    </div>


    <button type="submit"><?php echo $dictionary->SAVE ?></button>
</form>

<h2>PDF</h2>
<form enctype="multipart/form-data" action="pdf.php" method="post">
    <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
    <div>
        <?php echo $dictionary->UPLOAD_FILE_TITLE ?>:
        <label for="uploadbtn" class="uploadButton" style="font-weight: bold">
            <?php echo $dictionary->CHOOSE ?>
        </label>
        <div></div>
        <input
                style="opacity: 0; z-index: -1;"
                type="file" name="userfile" id="uploadbtn"
                onchange='document.querySelector(".uploadButton + div").innerHTML = Array.from(this.files).map(f => f.name).join("<br />")'
        />
    </div>
    <input type="submit" value="<?php echo $dictionary->SUBMIT_FILE ?>" />
</form>

<h3><?php echo $dictionary->UPLOADED_FILES ?></h3>

<?php
$files = array_diff(scandir($uploaddir), array('.', '..'));

echo "<ul>";
foreach ($files as $file_name) {
    echo "<li><a href=\"/uploads/{$file_name}\">{$file_name}</a></li>";
}

echo "</ul>";
?>


</body>
</html>