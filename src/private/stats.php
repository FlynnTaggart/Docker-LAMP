<?php
include 'session.php';
include 'constants.php';

$dictionary = $DICTIONARY[$_SESSION['language']];

require_once '/var/www/html/vendor/autoload.php';
require_once '/var/www/html/jpgraph/src/jpgraph.php';
require_once '/var/www/html/jpgraph/src/jpgraph_pie.php';
require_once '/var/www/html/jpgraph/src/jpgraph_pie3d.php';
require_once '/var/www/html/jpgraph/src/jpgraph_bar.php';
require_once '/var/www/html/jpgraph/src/jpgraph_scatter.php';

$faker = Faker\Factory::create();
$faker->seed(1234);
$faker->addProvider(new Faker\Provider\en_US\Person($faker));
$faker->addProvider(new Faker\Provider\Lorem($faker));


$db =  new mysqli("mysql", "user", "sayhi", "appDB");

$query = ("DELETE from orders");
$stmt = $db->prepare($query);
$stmt->execute();

$costArr = array();
$caloriesArr = array();
$drinkArr = array();

for ($i = 0; $i < 50; $i++) {
    $costArr[] = $faker->randomDigit();
    $caloriesArr[] = $faker->randomDigit();
    $drinkArr[] = $faker->optional($weight = 0.3, $default = 'Cola')->word();
    $drink = end($drinkArr);
    $cost = end($costArr);
    $calories = end($caloriesArr);
    $query = "INSERT INTO orders (client_name, first_dish, second_dish, drink, cost, calories) VALUES (
                                                                                         '$faker->firstName',
                                                                                         '$faker->word',
                                                                                         '$faker->word',
                                                                                         '$drink',
                                                                                         $cost,
                                                                                         $calories)";
    $db->query($query);
}
?>
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
$result = $db->query("SELECT * FROM orders");
foreach ($result as $row) {
    echo <<<A
            <tr><td>{$row['id']}</td>
            <td>{$row['client_name']}</td>
            <td>{$row['first_dish']}</td>
            <td>{$row['second_dish']}</td>
            <td>{$row['drink']}</td>
            <td>{$row['cost']}</td>
            <td>{$row['calories']}</td>
            </tr>
            A;
}
?>
</table>

<?php


$graph = new Graph(900, 300);
$graph->SetScale('textlin');
$array_keys = array_count_values($caloriesArr);
ksort($array_keys);
$graph->xaxis->SetTickLabels(array_keys($array_keys));
$b1 = new BarPlot(array_count_values($caloriesArr));
$graph->Add($b1);
$graph->title->Set('Calories deviation');
$graph->yaxis->title->Set('Number of occurrences');
$graph->xaxis->title->Set('Calories');
$graph->Stroke('charts/bar.png');

$graph = new PieGraph(500, 400);
$p1 = new PiePlot(array_values(array_count_values($drinkArr)));
$graph->title->Set('Drinks');
$p1->SetLegends(array_keys(array_count_values($drinkArr)));
$p1->SetLabelType(PIE_VALUE_ABS);
$p1->value->SetFormat('%d');
$p1->value->Show();
$graph->Add($p1);
$graph->Stroke('charts/pie.png');


$graph = new Graph(700, 800);
$graph->SetScale("linlin");
$graph->img->SetMargin(40, 40, 40, 40);
$graph->SetShadow();
$graph->title->Set('Cost deviation');
$sp1 = new ScatterPlot(array_count_values($costArr));
$graph->Add($sp1);
$graph->Stroke('charts/scatter.png');

water('charts/bar.png');
water('charts/pie.png');
water('charts/scatter.png');

echo '<img src="charts/bar.png"><br>';
echo '<img src="charts/pie.png"><br>';
echo '<img src="charts/scatter.png"><br>';


function water($path) {
    $stamp = imagecreatefrompng('mark.png');
    $im = imagecreatefrompng($path);
    $marge_right = 300;
    $marge_bottom = 150;
    $sx = imagesx($stamp);
    $sy = imagesy($stamp);
    imagecopymerge($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp), 50);
    imagepng($im, $path);
    imagedestroy($im);
}