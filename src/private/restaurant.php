<?php
include 'session.php';
include 'constants.php';

$dictionary = $DICTIONARY[$_SESSION['language']];
?>

<html lang="en">
<head>
    <title><?php echo $dictionary->RESTAURANT_TITLE ?></title>
    <link rel="stylesheet" href="style.css" type="text/css"/>
    <?php
    if ($_SESSION['theme'] == THEME::$DARK) {
        echo '<link rel="stylesheet" href="style-dark.css">';
    }
    ?>

</head>
<body>
<h1><?php echo $dictionary->RESTAURANT_TITLE ?></h1>
<h2><?php echo $dictionary->ADD_ORDER_TITLE ?></h2>
<form method="post">
    <div>
      <input class='input' placeholder='<?php echo $dictionary->CLIENT_NAME ?>' type='text' name="client_name" required>
    </div>
    <div>
      <input class='input' placeholder='<?php echo $dictionary->FIRST ?>' type='text' name="first_dish">
    </div>
    <div>
      <input class='input' placeholder='<?php echo $dictionary->SECOND ?>' type='text' name="second_dish">
    </div>
    <div>
      <input class='input' placeholder='<?php echo $dictionary->DRINK ?>' type='text' name="drink">
    </div>
    <div>
      <input class='input' placeholder='<?php echo $dictionary->COST ?>' type='text' name="cost" required>
    </div>
    <input class='submit' type='submit' value='<?php echo $dictionary->ADD ?>'>
</form>
<h2><?php echo $dictionary->DELETE_ORDER_TITLE ?></h2>
<form method="post">
    <div>
      <input class='input' placeholder='<?php echo $dictionary->ID ?>' type='text' name="id" required>
    </div>
    <input class='submit' type='submit' value='<?php echo $dictionary->DELETE ?>'>
</form>
<table>
    <tr>
        <th><?php echo $dictionary->ID ?></th>
        <th><?php echo $dictionary->CLIENT_NAME ?></th>
        <th><?php echo $dictionary->FIRST ?></th>
        <th><?php echo $dictionary->SECOND ?></th>
        <th><?php echo $dictionary->DRINK ?></th>
        <th><?php echo $dictionary->COST ?></th>
    </tr>
    <?php
    function display(){
        $mysqli = new mysqli("mysql", "user", "sayhi", "appDB");
        $result = $mysqli->query("SELECT * FROM orders");
        foreach ($result as $row) {
            echo <<<A
            <tr><td>{$row['id']}</td>
            <td>{$row['client_name']}</td>
            <td>{$row['first_dish']}</td>
            <td>{$row['second_dish']}</td>
            <td>{$row['drink']}</td>
            <td>{$row['cost']}</td></tr>
            A;
        }
    }
    display();
    function add(string $client_name, string $first_dish, string $second_dish, string $drink, int $cost){
        $mysqli = new mysqli("mysql", "user", "sayhi", "appDB");
        $sql = "INSERT INTO orders (client_name, first_dish, second_dish, drink, cost) 
        VALUES ('$client_name', '$first_dish', '$second_dish', '$drink', $cost);";
        $mysqli->query($sql);
        echo("<meta http-equiv='refresh' content='1'>"); 
    }
    function delete(string $id){
        $mysqli = new mysqli("mysql", "user", "sayhi", "appDB");
        $sql = "DELETE FROM orders WHERE id=$id";
        $mysqli->query($sql);
        echo("<meta http-equiv='refresh' content='1'>"); 
    }
    if(isset($_POST["client_name"]) && isset($_POST["cost"])){
        add(
            $_POST["client_name"],
            $_POST["first_dish"],
            $_POST["second_dish"],
            $_POST["drink"],
            intval($_POST["cost"])
        );
    }
    if(isset($_POST["id"])){
        delete(intval($_POST["id"]));
    }
    ?>
</table>
</body>
</html>