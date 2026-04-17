<?php

if (true == isset($_POST['edit'])) {
    // print'修正ボタンが押された。<br>';
    $id = $_POST['id'];
    header('Location:todo_edit.php?id=' . $id);
    exit;
}

if (true == isset($_POST['delete'])) {
    // print'削除ボタンが押された。<br>';
    $id = $_POST['id'];
    header('Location:todo_delete.php?id=' . $id);
    exit;
}
