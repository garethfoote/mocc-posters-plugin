<?php namespace MoCCPosters;

/** @var \Herbert\Framework\Shortcode $shortcode */

$shortcode->add(
    'MoCCPostersStats',
    'moccPosters::renderAllStats',
    [
        'post_id' => 'id'
    ]
);

$shortcode->add(
    'MoCCPostersVisits',
    'moccPosters::getVisits',
    [
        'post_id' => 'id'
    ]
);

$shortcode->add(
    'MoCCPostersVisitsWithLocation',
    'moccPosters::getVisitsWithLocation',
    [
        'post_id' => 'id'
    ]
);

$shortcode->add(
    'MoCCPostersVisitorLocation',
    'moccPosters::renderVisitorLocation'
);

$shortcode->add(
    'MoCCPostersAllVisitorLocations',
    'moccPosters::renderAllVisitorLocations',
    [
        'post_id' => 'id'
    ]
);

/*
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
