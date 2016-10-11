<?php

namespace Pazuzu156\FeedGenerator;

/**
 * Generates an RSS feed. (Relies on \Generator!)
 *
 * @package Pazuzu156\FeedGenerator
 */
class Rss
{
  /**
   * Creates the heading for the feed
   *
   * @param string $title
   * @param string $desc
   * @param string $link
   * @return string
   */
  public function create($title, $desc, $link)
  {
    $xml = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
    $head = "<rss version=\"2.0\" xmlns:atom=\"http://www.w3.org/2005/Atom\">\n";
    $channel = "  <channel>\n"
      . "    <title>$title</title>\n"
      . "    <description>$desc</description>\n"
      . "    <link>$link</link>\n";

    $content = $xml . $head . $channel;

    return $content;
  }

  /**
   * Adds an item to the feed
   *
   * @param array $options
   * @return string
   */
  public function addItem(array $options)
  {
    $required = array('title', 'description', 'link', 'pubDate');
    foreach($required as $r)
    {
      if(!array_key_exists($r, $options))
        throw new \Exception($r . " is a required field!");
    }

    $item = "    <item>\n"
      . "      <title>" . $options['title'] . "</title>\n"
      . "      <description>" . $options['description'] . "</description>\n"
      . "      <link>" . $options['link'] . "</link>\n"
      . "      <guid isPermaLink=\"false\">" . Utils::uuid($options['title']) . "</guid>\n"
      . "      <pubDate>" . Utils::rssDate($options['pubDate']) . "</pubDate>\n"
      . "    </item>\n";

    return $item;
  }

  /**
   * Adds an atom link to the feed
   *
   * @param string $link
   * @return string
   */
  public function addAtomLink($link)
  {
    return "  <atom:link href=\"$link\" rel=\"self\" type=\"application/rss+xml\" />\n";
  }

  /**
   * Gets the class type
   *
   * @return string
   */
  public function getType()
  {
    return static::class;
  }
}
