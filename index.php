<?php
require 'config.php';

$lista = [];
$sql = $pdo->query("SELECT * FROM tasks");

if($sql->rowCount() > 0) {
    $lista = $sql->fetchAll(PDO::FETCH_ASSOC);
}

<!-- MYSQL operation -->

if(isset($_POST['text'])) {
    $text = filter_input(INPUT_POST, 'text');
    $query = "INSERT INTO tasks (task) VALUES (:task)";
    $stm = $pdo->prepare($query);
    $stm->bindParam('task', $text);
    $stm->execute();

    header('Location: ./index.php');
}

if(isset($_GET['delete'])) {
  $id = filter_input(INPUT_GET, 'delete', FILTER_SANITIZE_NUMBER_INT);
  $query = "DELETE FROM tasks WHERE id=:id";
  $stm = $pdo->prepare($query);
  $stm->bindParam('id', $id);
  $stm->execute();

  header('Location: ./index.php');
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>To-do List</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
      integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="/css/todolist.css" />
  </head>

  <body>
    <div class="todo-list__app">
      <div class="todo-add-item__container">
        <h1 class="heading">Todo List</h1>
        <form method="post" class="todo-add-item" id="todo-add">
          <input
            class="inputItem"
            id="item-input"
            type="text"
            name="text"
            placeholder="Novo item"
          />
          <input id="add-item" type="submit" value="Adicionar" />
        </form>
      </div>

      <div class="todo-list__container">
        <ul id="todo-list">
        <?php foreach($lista as $task): ?>
          <li class="todo-item">
            <p class="task-name"><?=$task['task'];?></p>
            <a href="./update.php?id=<?= $task['id']?>"><i class="fas fa-edit"></i></a>
            <a href="?delete=<?= $task['id']?>">
              <i class="fas fa-trash-alt"></i>
            </a>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </body>
</html>
