<?php namespace MoCCPosters;

/** @var \Herbert\Framework\Router $router */

$router->post([
    'as'   => 'moccSaveLocation',
    'uri'  => '/mocc-save-location',
    'uses' => __NAMESPACE__ . '\Controllers\AjaxController@saveLocation'
]);

$router->get([
    'as'   => 'moccClearSession',
    'uri'  => '/mocc-clear-session',
    'uses' => function() {
        session_unset();
        return 'cleared';
    }
]);

$router->get([
    'as'   => 'moccClearData',
    'uri'  => '/mocc-clear-data/{id}',
    'uses' => __NAMESPACE__ . '\Controllers\StatsController@clearStats'
]);
