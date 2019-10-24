<?php
$hostname =  'localhost:3306';
$username = 'admin';
$password = '1234';
$dbname = 'Camagru';
$dsn = "mysql:host=" . $hostname . ";dbname=" . $dbname;
try {
  // Create a PDO instance
  $pdo = new PDO($dsn, $username, $password);
  // $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo "Connection to database failed: " . $e->getMessage();
}
# PRDO QUERY
$stmt = $pdo->query('SELECT * FROM users');
while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
  echo $row->FirstName . '<br>';
}
?>