<?php

require_once ('./root/functions.php');


if (isset($_GET["task_id"])) {
    $task_id = intval($_GET["task_id"]) ?? "";
     if ($task_id) {
        $result = change_status($connect, $task_id, $user_id);
        header("Location: index.php");
    }
}

if (isset($_GET["show_completed"])) {
    $show_complete_tasks = intval($_GET["show_completed"]) ?? "";
}
