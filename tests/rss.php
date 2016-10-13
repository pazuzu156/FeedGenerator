<?php

require_once __DIR__.'/../vendor/autoload.php';

date_default_timezone_set('America/New_York');

use Pazuzu156\FeedGenerator\Generator;

function mklink($s)
{
    return strtolower(str_replace(' ', '-', $s));
}

$client = new MongoDB\Client();
$stories = $client->stories->stories;

$results = $stories->find([]);

$gen = new Generator('rss');
$gen->create('Test Feed', 'My RSS Feed', 'http://example.com')
  ->add($gen->getType()->addAtomLink('http://example.com/rss.xml'));

foreach ($results as $result) {
    $gen->addItem([
    'title'       => $result->title,
    'description' => $result->content,
    'link'        => 'http://example.com/'.mklink($result->title),
    'pubDate'     => time(),
  ]);
}

echo $gen->render(); // render XML
// echo $gen->toJson(); // render JSON
