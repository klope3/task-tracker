<?php
define("DB_HOST", "localhost");
define("DB_USER", "josh");
define("DB_PASS", "password123");
define("DB_NAME", "task_tracker");

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
  die("Couldn't connect to the database.");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $taskName = $_POST["taskName"];
  $date = date("y-m-d");

  $sql = "INSERT INTO Tasks (name, createDate) VALUES ('$taskName', '$date')";
  $result = mysqli_query($conn, $sql);
  if (!$result) {
    echo "Couldn't add $taskName";
  }
}

$sql = "SELECT * FROM tasks";
$result = mysqli_query($conn, $sql);
$tasks = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="navbar.css" />
  <link rel="stylesheet" type="text/css" href="tasks.css" />
  <title>Document</title>
</head>

<body>
  <?php include "navbar.php" ?>
  <div>This is the tasks page</div>
  <table>
    <tr>
      <th></th>
      <th>Task</th>
      <th>Date Added</th>
    </tr>
    <?php if (empty($tasks)) : ?>
      <div>No tasks in the database.</div>
    <?php endif ?>
    <?php foreach ($tasks as $task) : ?>
      <tr>
        <td><button>x</button></td>
        <td><?php echo $task["name"] ?></td>
        <td><?php echo $task["createDate"] ?></td>
      </tr>
    <?php endforeach ?>
  </table>
  <form action="" method="POST">
    Add task: <input type="text" name="taskName"> <input type="submit" value="Add">
  </form>
</body>

</html>