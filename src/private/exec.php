<?php
include 'session.php';
include 'constants.php';

$dictionary = $DICTIONARY[$_SESSION['language']];
?>

<html lang="en">
<head>
    <title><?php echo $dictionary->EXEC_TITLE ?></title>
    <link rel="stylesheet" href="style.css" type="text/css"/>
    <?php
    if ($_SESSION['theme'] == USERTHEME::$DARK) {
        echo '<link rel="stylesheet" href="style-dark.css">';
    }
    ?>

</head>
<body>
    <h1><?php echo $dictionary->EXEC_TITLE ?></h1>
    <form method="post">
        <?php echo $dictionary->COMMAND ?>: <input type="text" name="command"> <input type="submit" name="submit" value="<?php echo $dictionary->EXECUTE ?>">
    </form>
    <?php
    include_once 'exec_engine.php';
    if(isset($_POST["command"])){
        new ExecEngine($_POST["command"], $dictionary->ERROR);
    }
    ?>
</body>
</html>