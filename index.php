<?php

require 'vendor/autoload.php';

use App\SQLiteConnection;

/* ==========================================================================
  basic connection
  ========================================================================== */

// $pdo = (new SQLiteConnection())->connect();

// if ($pdo != null)
//   echo 'Connected to the SQLite database successfully!';
// else
//   echo 'Whoops, could not connect to the SQLite database!';


/* ==========================================================================
  join query
  ========================================================================== */

try {

  // Connect to SQLite database using PDO
  // $db = new PDO('sqlite:Chinook_Sqlite.sqlite');
  $db = (new SQLiteConnection())->connect();

  // Set the PDO error mode to exception
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // SQL query with a JOIN
  $query = "
        SELECT Track.Name AS Name, Album.Title AS AlbumTitle, Artist.Name AS ArtistName
        FROM Track
        JOIN Album ON Track.AlbumId = Album.AlbumId
        JOIN Artist ON Album.ArtistId = Artist.ArtistId
        LIMIT 10";  // Limiting the result to the first 10 rows for simplicity

  // Prepare and execute the query
  $stmt = $db->prepare($query);
  $stmt->execute();

  // Fetch and display the results
  echo "<table border='1'>
            <tr>
                <th>Track Name</th>
                <th>Album Title</th>
                <th>Artist Name</th>
            </tr>";

  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr>
                <td>{$row['Name']}</td>
                <td>{$row['AlbumTitle']}</td>
                <td>{$row['Name']}</td>
              </tr>";
  }

  echo "</table>";
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

?>

<br />
<hr />
<br />

<?php

// echo '<pre>';
// var_dump($_SERVER['DOCUMENT_ROOT']);
// var_dump($_SERVER['PHP_SELF']);
// var_dump(__DIR__);
// echo '</pre>';

?>

<form action="app/FormHandler.php" method="post">
  <label for="firstName">First Name:</label>
  <input type="text" id="firstName" name="firstName" value="Mike" required>

  <label for="lastName">Last Name:</label>
  <input type="text" id="lastName" name="lastName" value="Turner" required>

  <label for="email">Email:</label>
  <input type="email" id="email" name="email" value="turner.mike@gmail.com" required>

  <input type="submit" value="Submit">
</form>