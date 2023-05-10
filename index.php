<!DOCTYPE html>
<html>
<head>
  <title>Хештеги</title>
  <link rel="stylesheet" href="../style.css">
</head>
<body>
<header style="background-color: #1E1E1E; color: #FFFFFF; padding: 20px; text-align: center;">
  <h1>#hashtag</h1>
  <p>Самохвалов Никита Юрьевич 221-321</p>
</header>
  <div class="container">
    <h1>Хештеги</h1>

    <!-- Форма добавления хештега -->
    <form action="add_hashtag.php" method="post">
      <label for="tag_name">Хештег:</label>
      <input type="text" id="tag_name" name="tag_name" required>

      <label for="tag_description">Описание:</label>
      <textarea id="tag_description" name="tag_description" required></textarea>

      <label for="author_name">Автор:</label>
      <input type="text" id="author_name" name="author_name" required>

      <button type="submit">Добавить</button>
    </form>

    <!-- Форма удаления хештега -->
    <form action="delete_hashtag.php" method="post">
      <label for="tag_id">Удалить хештег по ID:</label>
      <input type="text" id="tag_id" name="tag_id" required>

      <button type="submit">Удалить</button>
    </form>

    <!-- Форма сортировки хештегов -->
    <form action="index.php" method="post">
      <label for="category">Категория:</label>
      <select id="category" name="category">
        <option value="">Все категории</option>
        <option value="Еда">Еда</option>
        <option value="Электроника">Электроника</option>
        <option value="Мебель">Мебель</option>
      </select>

      <button type="submit">Сортировать</button>
    </form>

    <!-- Таблица со списком хештегов -->
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Хештег</th>
          <th>Описание</th>
          <th>Автор</th>
          <th>Дата создания</th>
        </tr>
      </thead>
      <tbody>
        <?php
          // Подключаемся к базе данных
          $servername = "localhost";
          $username = "root";
          $password = "";
          $dbname = "hashtag_curs";
          $conn = new mysqli($servername, $username, $password, $dbname);
          if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
          }

          // Получаем список хештегов из базы данных
          $sql = "SELECT * FROM hashtags";

          if (isset($_POST['category'])) {
            // Если выбрана категория, добавляем условие WHERE в SQL-запрос
            $category = $_POST['category'];
            if ($category != "") {
            $sql .= " WHERE category='$category'";
            }
            } $result = $conn->query($sql);

            if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["tag_name"] . "</td>";
                echo "<td>" . $row["tag_description"] . "</td>";
                echo "<td>" . $row["author_name"] . "</td>";
                echo "<td>" . $row["created_at"] . "</td>";
                echo "</tr>";
              }
            } else {
              echo "0 results";
            }
      
            $conn->close();
          ?>
        </tbody>
      </table>
        </div>
    </body>
    <footer style="background-color: #1E1E1E; color: #FFFFFF; padding: 20px; text-align: center;">
  <h3>Самохвалов Никита Юрьевич 221-321</h3>
  <p>#hashtag</p>
</footer>
</html>