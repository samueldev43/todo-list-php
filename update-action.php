<?php
require 'config.php';

$id = filter_input(INPUT_POST, 'id');
$task = filter_input(INPUT_POST, 'task');


if(isset($_POST['id'])) {
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    $query = "UPDATE tasks SET task = :task WHERE id=:id";
    $stm = $pdo->prepare($query);
    $stm->bindParam('id', $id);
    $stm->bindParam('task', $task);
    $stm->execute();
  
    header('Location: ./index.php');
  }