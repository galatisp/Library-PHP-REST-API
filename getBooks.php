<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Βιβλία </title>
</head>

<body>

    <?php
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

    $sql = "SELECT * FROM books";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {

        echo '<h3>Βιβλία</h3>';
        echo '<table cellpadding="5" cellspacing="0" border=1 width="60%">';
        echo '<tr>';
        echo '<th>Κωδικός</th><th>ΑΒΕΚΤ</th><th>Τίτλος</th><th>Θέση</th><th>Αντίγραφα</th>';
        echo '</tr>';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $row["id"] . '</td>';
            echo '<td>' . $row["abekt"] . '</td>';
            echo '<td>' . $row["title"] . '</td>';
            echo '<td>' . $row["position"] . '</td>';
            echo '<td>' . $row["actualCopies"] . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo 'Δε βρέθηκαν στοιχεία στον Πίνακα Βιβλίων';
    }

    mysqli_close($conn);
    ?>

</body>