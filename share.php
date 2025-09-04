<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/soad/server/utils/safe.php';
$safe = new Safe();
if (isset($GLOBALS["postData"]["type"])){
    $type = $GLOBALS["postData"]["type"];
    $items = $safe->toJSON($safe->readFile("share/items.json"));
    //获取资源路径
    if ($type == "getItem"){
        $item = $items[$GLOBALS["postData"]["id"]];
        die($safe->back($item));
    }
    //获取资源列表
    else if ($type == "getItems"){
        $processedItems = [];
        foreach ($items as $key => $item) {
            $processedItems[$key] = $item;
            if (isset($processedItems[$key]['url'])) {
                unset($processedItems[$key]['url']);
            }
        }
        die($safe->back($processedItems));
    }
}