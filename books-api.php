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
    // $offset = $_GET["offset"];
    // $sql = "SELECT * FROM books order by categoryId, id LIMIT 10 OFFSET ".$offset;
    $sql = "SELECT * FROM books order by categoryId, title";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($result);
   }catch(PDOException $e) {
    $message = "Error: " . $e->getMessage();
    echo  json_encode(['error' => $message]);
  } 
    
    //var_dump($result);
}

function handlePost($pdo, $input)
{
    try {
        $sql = "INSERT INTO books (title, author, categoryId) VALUES (:title, :author, :category)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['title' => $input['title'], 'author' => $input['author'], 'category' => $input['category']]);
        $last_id = $pdo->lastInsertId();
        $message =  'Book created successfully with ID: ' . $last_id;
        echo json_encode(['message' => $message]);
    } catch (PDOException $e) {
        $message = "Error: " . $e->getMessage();
        echo  json_encode(['error' => $message]);
    }
}

function handlePut($pdo, $input)
{
    $sql = "UPDATE books SET title = :title, author = :author WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['title' => $input['title'], 'author' => $input['author'], 'id' => $input['id']]);
    echo json_encode(['message' => 'Book updated successfully']);
}

function handleDelete($pdo, $input)
{
    $sql = "DELETE FROM books WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $input['id']]);
    echo json_encode(['message' => 'Book deleted successfully']);
}
