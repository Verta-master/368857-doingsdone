<?php
// показывать или нет выполненные задачи
$show_complete_tasks = rand(0, 1);

// устанавливаем часовой пояс в Московское время
date_default_timezone_set('Europe/Moscow');

$days = rand(-3, 3);
$task_deadline_ts = strtotime("+" . $days . " day midnight"); // метка времени даты выполнения задачи
$current_ts = strtotime('now midnight'); // текущая метка времени

// запишите сюда дату выполнения задачи в формате дд.мм.гггг
$date_deadline = date("d.m.Y", $task_deadline_ts);

// в эту переменную запишите кол-во дней до даты задачи
$days_until_deadline = floor(($task_deadline_ts - $current_ts) / 86400);

//simple array
$busyness = ["Все", "Входящие", "Учеба", "Работа", "Домашние дела", "Авто"];

//associative arrays
$task_1 = [
    "task" => "Собеседование в IT компании",
    "date" => "01.06.2018",
    "category" => "Работа",
    "done" => "Нет"
];
$task_2 = [
    "task" => "Выполнить тестовое задание",
    "date" => "25.05.2018",
    "category" => "Работа",
    "done" => "Нет"
];
$task_3 = [
    "task" => "Сделать задание первого раздела",
    "date" => "21.04.2018",
    "category" => "Учеба",
    "done" => "Да"
];
$task_4 = [
    "task" => "Встреча с другом",
    "date" => "22.04.2018",
    "category" => "Входящие",
    "done" => "Нет"
];
$task_5 = [
    "task" => "Купить корм для кота",
    "date" => "Нет",
    "category" => "Домашние дела",
    "done" => "Нет"
];
$task_6 = [
    "task" => "Заказать пиццу",
    "date" => "Нет",
    "category" => "Домашние дела",
    "done" => "Нет"
];

//Number of tasks
$total = 6;

//2D array
$task_list = [$task_1, $task_2, $task_3, $task_4, $task_5, $task_6];

//user name

$name = "Yelena";

//function
function taskCount($list, $project) {
    $number = 0;    //task group
    $sum = 0;       //task total

    foreach ($list as $key => $val):
        $sum++;

        if ($val['category'] == $project) {
            $number++;
        }
    endforeach;

    if ($project == "Все") {
        $number = $sum;
    }

    return $number;
}

//Проверка категории
if (isset($_GET['category'])) {
    if ($_GET['category'] < $total) {
        $cat = $busyness[$_GET['category']];
    } else {
        $cat = 'error';
//        http_response_code(404);
    }
} else {
    $cat = $busyness[0];
}

//Подключение функции шаблонизации
require_once "functions.php";

//контент главной страницы
if ($cat == 'error') {
    http_response_code(404);
} else {
    $page_content = renderTemplate('templates/index.php',
        [
            'task' => $task_list,
            'category' => $cat
        ]);
}

//окончательный HTML код
$layout_content = renderTemplate('templates/layout.php',
    [
        'content' => $page_content,
        'name' => $name,
        'title' => 'Дела в порядке - Главная',
        'busyness' => $busyness,
        'task' => $task_list,
        'total' => $total
    ]);

print($layout_content);

?>

