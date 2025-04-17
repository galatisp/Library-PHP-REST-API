    <?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');

    header('Access-Control-Allow-Headers: X-Requested-With,Authorization,Content-Type');
    header("Content-Type: application/json");
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpasswd = "";
    $dbname = "library";

    $conn = mysqli_connect($dbhost, $dbuser, $dbpasswd, $dbname);
    if (!$conn) {
        die("Η Σύνδεση με τη Βάση Δεδομένων απέτυχε: " . mysqli_connect_error());
    }


    $sql = "SELECT * FROM books";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {

        echo  json_encode(['count' => mysqli_num_rows($result)]);
    } else {
        echo  json_encode(['error' => 'Δε βρέθηκαν στοιχεία στον Πίνακα Βιβλίων']);
    }

    mysqli_close($conn);
    ?>
