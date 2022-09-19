<html lang="en">
<head>
    <title>Hello page</title>
    <link rel="stylesheet" href="style.css" type="text/css"/>
</head>
<body>
    <h1>Drawer</h1>
    <?php
    include_once 'sort_engine.php';
    $parameter = $_GET[SortEngine::PARAMETER_NAME];
    try {
        new SortEngine($parameter);
    } catch (Exception $e){
        echo 'Wrong input';
    }
    ?>
</body>
</html>