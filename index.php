<?php

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

//user functions
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

function searchUserByEmail($email, $users) {
    $result = null;
    foreach ($users as $user) {
        if ($user['email'] == $email) {
            $result = $user;
            break;
        }
    }
    return $result;
}

session_start();

//Проверка категории
$cat = 0;
$show = false;
$show_login = false;

if (isset($_GET['category'])) {
    //Показ формы входа
    if ($_GET['category'] == 'login') {
        $show_login = true;
    }
    //Показ формы добавления задачи
    if ($_GET['category'] == 'add') {
        require_once "templates/form.php";
        $show = true;
    }
    //Выбор категории в сайдбаре
    $cat = $busyness[0];
    if ($_GET['category'] < $total) {
        $cat = $busyness[$_GET['category']];
        } else {
            header("HTTP/1.0 404 Not Found");
            exit(http_response_code(404));
        }
    //Log out
    if ($_GET['category'] == 'logout') {
        require_once "logout.php";
    }
}

//Cookie
if (isset($_GET['show_completed'])) {
    $cookie_name = "complete";
    $cookie_value = $_GET['show_completed'];
    $expire = strtotime("+7 days");
    $path = "/";
    setcookie($cookie_name, $cookie_value, $expire, $path);
    header("Location: /index.php");
}

if (isset($_COOKIE['complete'])) {
    $show_complete_tasks = $_COOKIE['complete'];
} else {
    $show_complete_tasks = 0;
}

//Обработка формы логина
if (isset($_POST['password'])) {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    //Проверка на пустые поля
    if ($_POST['email'] == '' || $_POST['password'] == '') {
        $show_login = true;
    } else {
        require_once "userdata.php";
        if ($user = searchUserByEmail($email, $users)) {
            if (password_verify($password, $user['password'])) {
                $_SESSION['user'] = $user;
                $username = $user['name'];
                $pass = true;
            } else {
                $show_login = true;
                $pass = false;
            }
        }
   }
}

$username = $_SESSION['user']['name'];

//    Форма добавления задачи
if (isset($_POST['name'])) {
    $project = $_POST['name'] ?? '';
    $folder = $_POST['project'] ?? '';
    $date = $_POST['date'] ?? '';

    if ($_POST['name'] == '' || $_POST['project'] == '' || $_POST['date'] == '') {
        require_once "templates/form.php";
        $show = true;
    } else {
        //Сохранение файла если загружен
        if (isset($_FILES['preview'])) {
            $file_name = $_FILES['preview']['name'];
            $file_path = __DIR__ . '/';
            move_uploaded_file($_FILES['preview']['tmp_name'], $file_path . $file_name);
        }

        //Добавление задачи в массив задач
        $task_new = [
            "task" => $project,
            "date" => $date,
            "category" => $folder,
            "done" => "Нет"
        ];
        array_unshift($task_list, $task_new);
    }
}

//Подключение функции шаблонизации
require_once "functions.php";

//Подключение базы данных
require_once "init.php";

//user autentification
if ($_SESSION != []) {
    //залогиненный пользователь
    //контент главной страницы
    $page_content = renderTemplate('templates/index.php',
        [
            'task' => $task_list,
            'category' => $cat,
            'show_complete_tasks' => $show_complete_tasks
        ]);
    //окончательный HTML код
    $layout_content = renderTemplate('templates/layout.php',
        [
        'content' => $page_content,
        'name' => $username,
        'title' => 'Дела в порядке - Главная',
        'busyness' => $busyness,
        'task' => $task_list,
        'total' => $total,
        'form' => $show
    ]);
} else {
    //незалогиненный пользователь
    $layout_content = renderTemplate('templates/guest.php',
        [
            'title' => 'Дела в порядке - Главная',
            'form' => $show_login,
            'email' => $email,
            'password' => $password,
            'pass' => $pass
        ]);
}

print($layout_content);

?>

