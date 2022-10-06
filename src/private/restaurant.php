<html lang="en">
<head>
    <title>Hello page</title>
    <link rel="stylesheet" href="style.css" type="text/css"/>
</head>
<body>
<h1>Restaurant</h1>
<h2>Add order</h2>
<form method="post">
    <div>
      <input class='input' placeholder='Client name' type='text' name="client_name" required>
    </div>
    <div>
      <input class='input' placeholder='First dish' type='text' name="first_dish">
    </div>
    <div>
      <input class='input' placeholder='Second name' type='text' name="second_dish">
    </div>
    <div>
      <input class='input' placeholder='Drink' type='text' name="drink">
    </div>
    <div>
      <input class='input' placeholder='Cost' type='text' name="cost" required>
    </div>
    <input class='submit' type='submit' value='Add'>
</form>
<h2>Delete order</h2>
<form method="post">
    <div>
      <input class='input' placeholder='ID' type='text' name="id" required>
    </div>
    <input class='submit' type='submit' value='Delete'>
</form>
<table>
    <tr>
        <th>Id</th>
        <th>Client name</th>
        <th>First dish</th>
        <th>Second dish</th>
        <th>Drink</th>
        <th>Cost</th>
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