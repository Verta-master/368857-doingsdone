<?php
require_once "mysql_helper.php";

//Функция загрузки шаблона
function renderTemplate($path, $array) {

    if (file_exists($path)) {
        ob_start('ob_gzhandler');
        extract($array, EXTR_SKIP);
        require_once $path;
        $html = ob_get_clean();
        return $html;
    } else {
        return "";
    }
}

//Функция для получения данных
function select_data($con, $sql, $array = []) {
    $stmt = db_get_prepare_stmt($con, $sql, $array);
    $exec = mysqli_stmt_execute($stmt);
    if ($exec) {
        $result = mysqli_fetch_all($stmt, MYSQLI_ASSOC);
    } else {
        $result = [];
    }
    return $result;
}

//Функция для вставки данных
function insert_data($con, $table, $array) {
    foreach ($array as $key => $val) {
        $line .= $key."='".$val."', ";
    }
    $sql = "INSERT INTO" . $table . "SET " . $line;
    $stmt = db_get_prepare_stmt($con, $sql, $array);
    $exec = mysqli_stmt_execute($stmt);
    if ($exec) {
        $result = mysqli_insert_id($con);
    } else {
        $result = false;
    }
    return $result;
}

//Функция для произвольного запроса
function exec_query($con, $sql, $array = []) {
    $stmt = db_get_prepare_stmt($con, $sql, $array);
    $exec = mysqli_stmt_execute($stmt);
    return $exec;
}

?>