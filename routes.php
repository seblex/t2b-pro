<?php

/* 
 * Роутинг
 */

$routes = array(
    array(
        'url' => '#^$|^\?#',
        'view' => 'app'),
    array(
        'url' => '#^category/(?P<id>\d+)?#i', 
        'view' => 'category'),
    array(
        'url' => '#^page/(?P<page_alias>[a-z0-9-]+)#i', 
        'view' => 'page'),
    array(
        'url' => '#^new_order#i', 
        'view' => 'order_responce'),
    array(
        'url' => '#^login#i', 
        'view' => 'login'),
    array(
        'url' => '#^logout#i', 
        'view' => 'logout'),
    array(
        'url' => '#^forgot#i', 
        'view' => 'forgot'),
    array(
        'url' => '#^reg#i', 
        'view' => 'reg'),
    array(
        'url' => '#^search#i', 
        'view' => 'search'),
);