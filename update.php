<?php
require 'config.php';

$usuario = [];
$id = filter_input(INPUT_GET, 'id');

if($id) {
    $sql = $pdo->prepare("SELECT * FROM tasks WHERE id = :id");
    $sql->bindValue(':id', $id); 
    $sql->execute(); if($sql->rowCount() > 0) {
    $usuario = $sql->fetch(PDO::FETCH_ASSOC); } else { header('Location:
    index.php'); } } else { header('Location: ./index.php'); } ?>

<!DOCTYPE html>
<html lang="pt-BT">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="/css/todolist.css" />

    <title>Update task</title>
  </head>

  <body>
    <div class="container">
      <h2>Editar tarefa</h2>
      <br />
      <div class="editContainer">
        <form method="POST" action="./update-action.php">
          <input type="hidden" name="id" value="<?=$usuario['id'];?>">
          <input
            class="editInput"
            type="text"
            name="task"
            value="<?=$usuario['task'];?>"
          />
          <input class="editButton" type="submit" value="Editar" />
        </form>
      </div>
    </div>
  </body>
</html>
