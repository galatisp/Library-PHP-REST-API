<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');

header('Access-Control-Allow-Headers: X-Requested-With,Authorization,Content-Type');
header("Content-Type: application/json");
include 'connect_db.php';

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);

switch ($method) {
    case 'GET':
        handleGet($pdo);
        break;
    case 'POST':
        handlePost($pdo, $input);
        break;
    case 'PUT':
        handlePut($pdo, $input);
        break;
    case 'DELETE':
        handleDelete($pdo, $input);
        break;
    default:
        echo json_encode(['message' => 'Invalid request method']);
        break;
}

$pdo = null;

function handleGet($pdo)
{
   try{
    
    $sql = "SELECT * FROM categories order by name";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($result);
   }catch(PDOException $e) {
    $message = "Error: " . $e->getMessage();
    echo  json_encode(['error' => $message]);
  } 
    
   
}

function handlePost($pdo, $input)
{
    
}

function handlePut($pdo, $input)
{
    
}

function handleDelete($pdo, $input)
{
    
}
