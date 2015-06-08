<?php namespace MoCCPosters;

/** @var \Herbert\Framework\Shortcode $shortcode */

$shortcode->add(
    'MoCCPostersStats',
    'moccPosters::getStats',
    [
        'post_id' => 'id'
    ]
);

/*
// TODO ->
$shortcode->add(
    'MoCCPostersStats',
    'moccPosters::getUserLocation'
);

// TODO ->
$shortcode->add(
    'MoCCPostersStats',
    'moccPosters::getVisits'
);

// TODO ->
$shortcode->add(
    'MoCCPostersStats',
    'moccPosters::getVisitsWithLocation'
);

// TODO ->
$shortcode->add(
    'MoCCPostersStats',
    'moccPosters::getMaps'
);
 */
