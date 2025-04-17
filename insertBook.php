<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');

header('Access-Control-Allow-Headers: X-Requested-With,Authorization,Content-Type');


    $dbhost = "localhost";
    $dbuser = "root";
    $dbpasswd = "";
    $dbname = "new_sek_library";

    $conn = mysqli_connect($dbhost, $dbuser, $dbpasswd, $dbname);
    if (!$conn) {
        die("Η Σύνδεση με τη Βάση Δεδομένων απέτυχε: " . mysqli_connect_error());
    }
    $sql_names = "set names utf8";
    $result_names = mysqli_query($conn, $sql_names);

    

/*$data = json_decode(file_get_contents('php://input'), true);
$title = $data['title'];
$author = $data['author'];
*/
$title = $_POST['title'];
$author = $_POST['author'];


$sql = "INSERT INTO books (title, author) VALUES ('$title', '$author')";

$result = mysqli_query($conn, $sql);


if (mysqli_affected_rows($conn) > 0 ) {
   $message = 'Επιτυχής Εισαγωγή Βιβλίου'; 
}
else {
 $message=  'Ανεπιτυχής εισαγωγή στοιχείων στον Πίνακα Πελατών. ' ;
}


echo json_encode($message);
mysqli_close($conn);


?>
