<?php namespace MoCCPosters;

/** @var \Herbert\Framework\Router $router */

$router->post([
    'as'   => 'moccSaveLocation',
    'uri'  => '/mocc-save-location',
    'uses' => __NAMESPACE__ . '\Controllers\AjaxController@saveLocation'
]);
