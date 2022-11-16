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
</body>
</html>