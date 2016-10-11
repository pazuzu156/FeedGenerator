<?php

namespace Pazuzu156\FeedGenerator;

/**
 * Generates an Atom feed. (Relies on \Generator!)
 *
 * @package Pazuzu156\FeedGenerator
 */
class Atom
{
  /**
   * Holds the author's info
   *
   * @var array
   */
  private $_author;

  /**
   * Creates the heading for the feed
   *
   * @param string $title
   * @param string $desc
   * @param string $link
   * @param array $author
   * @param int $updated
   * @return string
   */
  public function create($title, $desc, $link, array $author, $updated)
  {
    $xml = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
    $head = "<feed xmlns=\"http://www.w3.org/2005/Atom\">\n";
    $channel = "  <title>$title</title>\n"
      . "  <subtitle>$desc</subtitle>\n"
      . "  <id>urn:uuid:" . Utils::uuid($title) . "</id>\n"
      . "  <link href=\"$link\" />\n"
      . "  <updated>" . Utils::atomDate($updated) . "</updated>\n";

    $content = $xml . $head . $channel;

    $this->_author = $author;

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
    $required = array('title', 'summary', 'content', 'link', 'updated');
    foreach($required as $r)
    {
      if(!array_key_exists($r, $options))
        throw new \Exception($r . " is a required field!");
    }

    $item = "  <entry>\n"
      . "    <title>" . $options['title'] . "</title>\n"
      . "    <summary>" . $options['summary'] . "</summary>\n"
      . "    <link href=\"" . $options['link'] . "\" />\n"
      . "    <id>urn:uuid:" . Utils::uuid($options['title']) . "</id>\n"
      . "    <updated>" . Utils::atomDate($options['updated']) . "</updated>\n"
      . "    <content type=\"xhtml\">\n"
      . "      <div xmlns=\"http://www.w3.org/1999/xhtml\">\n"
      . "        <p>\n"
      . "          " . $options['content'] . "\n"
      . "        </p>\n"
      . "      </div>\n"
      . "    </content>\n"
      . "    <author>\n"
      . "      <name>" . $this->_author['name'] . "</name>\n"
      . "      <email>" . $this->_author['email'] . "</email>\n"
      . "    </author>\n"
      . "  </entry>\n";

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
    return "  <link href=\"$link\" rel=\"self\" type=\"application/rss+xml\" />\n";
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
