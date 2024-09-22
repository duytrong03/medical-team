<?php
define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__ . '/connect.php');

// Fetch data from the database
$sql = "SELECT * FROM crud_hopital_location";
$result = $conn->query($sql);

$features = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $feature = [
            "type" => "Feature",
            "properties" => [
                "name" => $row['name'],
                "introduction" => $row['introduction'],
                "address" => $row['address'],
                "phone" => $row['phone'],
                "image" => $row['image']
            ],
            "geometry" => [
                "coordinates" => array_map('floatval', explode(',', $row['coordinates'])),
                "type" => "Point"
            ],
            "id" => $row['id_hopital']
        ];
        $features[] = $feature;
    }
}

$yteJson = [
    "type" => "FeatureCollection",
    "features" => $features
];

header('Content-Type: application/javascript');
echo 'var yteJson = ' . json_encode($yteJson) . ';';
?>
