<?php

require_once ('./config.php');
require_once ('./src/functions.php');
require_once ('./src/db_connect.php');
require_once ('./src/db_queries.php');
require_once ('./src/db_data.php');


$new_task['name'] = '';
$errors = [];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $new_task = $_POST;

    if (empty($new_task['name'])) {
        $errors['name'] = 'Укажите название задачи';
    }

    if (empty($new_task['project'])) {
          $new_task['project'] = NULL;
       } elseif (!in_array($new_task['project'], array_column($projects, 'id'))) {
        $errors['project'] = 'Такого проекта не существует';
    }

    $file = false;

    if (!empty($_FILES['preview']['name'])) {
        $file_name = $_FILES['preview']['name'];
        $file_path = __DIR__ . '/uploads/';
        $file_url = $file_name;
        $file = true;
    }


    if (empty($errors)) {
        $new_task_name = $new_task['name'];
        if ($file) {
            $new_task_file = $file_url;
        } else {
            $new_task_file = '';
        }


        $new_task_date = $new_task['date'];

        if (empty($new_task_date)) {
            $new_task_date = NULL;
        } elseif (!check_date($new_task_date)) {
            $errors['date'] = 'Введите дату в формате дд.мм.гггг';
        }

        $insert_result = add_task($new_task, $connect, $new_task_date, $new_task_file, $user_id);


        if ($insert_result) {
            if ($file) {
                move_uploaded_file($_FILES['preview']['tmp_name'], $file_path . $file_name);
            }
            header('Location: /index.php');
        }
    }
 }


$content_side = include_template(
    'content-side',
    [
        'projects' => $projects,
        'tasks' => $tasks,
        'active_tasks' => $active_tasks,
    ]
);

$page_content = include_template(
    'form-task',
    [
        'projects' => $projects,
        'tasks' => $tasks,
        'new_task' => $new_task,
        'errors' => $errors
    ]
);

$layout_content = include_template (
    'layout',
    [
        'body_background' => '',
        'container_with_sidebar' => $container_with_sidebar,
        'content_side' => $content_side,
        'page_content' => $page_content,
        'projects' => $projects,
        'tasks' => $tasks,
        'active_tasks' => $active_tasks,
        'title' => 'Дела в порядке'
    ]
);

 print ($layout_content);

