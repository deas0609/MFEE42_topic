<?php
//排序
$type = $_GET["type"] ?? 1;
switch ($type) {
    case 1:
        $where = "id ASC";
        break;
    case 2:
        $where = "id DESC";
        break;
    case 3:
        $where = "discount ASC";
        break;
    case 4:
        $where = "discount DESC";
        break;
    case 5:
        $where = "startDate ASC";
        break;
    case 6:
        $where = "startDate DESC";
        break;
    case 7:
        $where = "enable DESC";
        break;
    case 8:
        $where = "enable ASC" ;   
        break;
}

