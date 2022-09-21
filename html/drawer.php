<html lang="en">
<head>
    <title>Hello page</title>
    <link rel="stylesheet" href="style.css" type="text/css"/>
</head>
<body>
    <h1>Drawer</h1>
    <?php
    include_once 'drawer_engine.php';
    if(!empty($_GET)){
        $parameter = $_GET[DrawerEngine::PARAMETER_NAME];
        
        if (!is_numeric($parameter) || $parameter > 255 || $parameter < 0)
            echo 'num parameter must be a string containing a 8 bit unsigned integer';
        else new DrawerEngine($parameter);
    }
    else
        echo 'Empty input';
    ?>
</body>
</html>