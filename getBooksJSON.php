<?php
header('Access-Control-Allow-Origin: *');

$dbhost = "localhost:3306";
$dbuser = "root";
$dbpasswd = "";
$dbname = "new_sek_library";

$conn = mysqli_connect($dbhost, $dbuser, $dbpasswd, $dbname);
if (!$conn) {
    die("Η Σύνδεση με τη Βάση Δεδομένων απέτυχε: " . mysqli_connect_error());
}
$sql_names = "set names utf8";
$result_names = mysqli_query($conn, $sql_names);

$sql = "SELECT id, abekt, position, box, title, actualCopies  FROM books order by id DESC";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $books = array();
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($books, $row);
    }
    echo json_encode($books,  JSON_UNESCAPED_UNICODE);
} else {
    echo 'Δε βρέθηκαν στοιχεία στον Πίνακα Βιβλίων';
}

mysqli_close($conn);
