<!DOCTYPE html>
<html lang="en"></html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Show DB</title>
    <style>
      table, th, td {
        border: 2px solid black;
      }
      table {
        width: 100%;
      }
    </style>
  </head>
  <body>

    <table>
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Likes Hip Hop</th>
        <th>Likes Rock</th>
        <th>Likes Pop</th>
        <th>Occupation</th>
      </tr>
      
      <?php
          $servername = "localhost";
          $username = "root";
          $password = "";

          try {
              $conn = new PDO("mysql:host=$servername", $username, $password);
              $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $conn->query("use myDB");


              $sql = 'SELECT * FROM Data';

              $data = $conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);


              if ($data) {
                foreach ($data as $entry) {
                  echo "<tr>";
                  echo "<td>".$entry['name']."</td>";
                  echo "<td>".$entry['email']."</td>";
                  echo "<td>".$entry['likesHipHop']."</td>";
                  echo "<td>".$entry['likesRock']."</td>";
                  echo "<td>".$entry['likesPop']."</td>";
                  echo "<td>".$entry['occupation']."</td>";
                  echo "<tr>";
                }
              }

          } catch(PDOException $e) {
          echo "Connection failed: " . $e->getMessage();
          }
      ?>

    </table>

  </body>
</html>