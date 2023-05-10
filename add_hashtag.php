<?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "hashtag_curs";
  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Получаем данные из формы добавления хештега
  $tag_name = $_POST["tag_name"];
  $tag_description = $_POST["tag_description"];
  $author_name = $_POST["author_name"];

  // Подготавливаем запрос на добавление хештега в базу данных
  $stmt = $conn->prepare("INSERT INTO hashtags (tag_name, tag_description, author_name) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $tag_name, $tag_description, $author_name);
  $stmt->execute();
  $stmt->close();

  $conn->close();
  header("Location: index.php");
?>
