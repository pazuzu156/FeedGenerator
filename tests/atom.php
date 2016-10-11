<?php

require_once __DIR__.'/../vendor/autoload.php';

date_default_timezone_set('America/New_York');

use Pazuzu156\FeedGenerator\Generator;
use Pazuzu156\FeedGenerator\Utils;

function mklink($s)
{
  return strtolower(str_replace(" ", "-", $s));
}

$client = new MongoDB\Client;
$stories = $client->stories->stories;

$results = $stories->find([]);

$gen = new Generator("atom");
$gen->create("Test Feed", "My Atom Feed", "http://example.com", [
  'name' => 'John Doe',
  'email' => 'john.doe@example.com',
], time())
  ->add($gen->getType()->addAtomLink("http://example.com/atom.xml"));

foreach($results as $result)
{
  $gen->addItem([
    'title' => $result->title,
    'summary' => $result->title,
    'content' => $result->content,
    'link' => 'http://example.com/' . mklink($result->title),
    'updated' => time(),
  ]);
}

echo $gen->render(); // render XML
// echo $gen->toJson(); // render JSON
