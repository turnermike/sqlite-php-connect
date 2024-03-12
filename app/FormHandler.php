
<?php

require '../vendor/autoload.php';

use App\SQLiteConnection;

try {

  // SQLite database connection
  // $db = new SQLite3('user_data.db');
  $db = (new SQLiteConnection())->connect();

  // Check if the form is submitted
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];

    $query = $db->prepare('INSERT INTO Users (FirstName, LastName, Email) VALUES (:firstName, :lastName, :email)');
    $query->bindValue(':firstName', $firstName, SQLITE3_TEXT);
    $query->bindValue(':lastName', $lastName, SQLITE3_TEXT);
    $query->bindValue(':email', $email, SQLITE3_TEXT);

    $result = $query->execute();

    if ($result) {
      echo 'Data inserted successfully!';
      // header("Location: ../index.php");
    } else {
      echo 'Error inserting data.';
    }
  }
} catch (PDOException $e) {

  echo "Connection failed: " . $e->getMessage();
}

// Close the database connection
$db = null;

?>