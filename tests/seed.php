<?php

require_once __DIR__.'/../vendor/autoload.php';

$client = new MongoDB\Client;
$stories = $client->stories;

// create collection

// seed many stories ;)
$storiesArr = array(
  array(
    'title' => 'Hskdjh d\'Lsjkdl',
    'content' => 'Haslkdj asasdlkj hsudahiu a;lskd. S alskdjskjdahsk nikalsd. S hsidoaisdjalskdjj.',
    'author' => 'Hock Mock',
  ),
  array(
    'title' => 'Hskdjh d\'Lsjkdl',
    'content' => 'Haslkdj asasdlkj hsudahiu a;lskd. S alskdjskjdahsk nikalsd. S hsidoaisdjalskdjj.',
    'author' => 'Hock Mock',
  ),
  array(
    'title' => 'Hskdjh d\'Lsjkdl',
    'content' => 'Haslkdj asasdlkj hsudahiu a;lskd. S alskdjskjdahsk nikalsd. S hsidoaisdjalskdjj.',
    'author' => 'Hock Mock',
  ),
  array(
    'title' => 'Hskdjh d\'Lsjkdl',
    'content' => 'Haslkdj asasdlkj hsudahiu a;lskd. S alskdjskjdahsk nikalsd. S hsidoaisdjalskdjj.',
    'author' => 'Hock Mock',
  ),
  array(
    'title' => 'Hskdjh d\'Lsjkdl',
    'content' => 'Haslkdj asasdlkj hsudahiu a;lskd. S alskdjskjdahsk nikalsd. S hsidoaisdjalskdjj.',
    'author' => 'Hock Mock',
  ),
);

// assign ID to new stories
for($i = 0; $i < count($storiesArr); $i++)
{
  $storiesArr[$i]['_id'] = $i;
}

// insert stories
$result = $stories->stories->insertMany($storiesArr);

printf("Inserted %d stories into collection", $result->getInsertedCount());
