<?php
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
?>