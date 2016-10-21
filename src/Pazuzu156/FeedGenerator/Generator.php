<?php

namespace Pazuzu156\FeedGenerator;

/**
 * Generates an RSS or Atom feed.
 */
class Generator
{
    /**
     * Defines the type of feed to render.
     *
     * @var mixed
     */
    private $_type;

    /**
     * Holds the feed content.
     *
     * @var string
     */
    private $_feed;

    /**
     * Class constructor.
     *
     * @param string $type
     *
     * @return void
     */
    public function __construct($type = '')
    {
        if (!empty($type)) {
            $this->setType($type);
        }
    }

    /**
     * Sets the type of feed to render.
     *
     * @param string $type
     *
     * @return \Pazuzu156\FeedGenerator\Generator
     */
    public function setType($type)
    {
        $class = 'Pazuzu156\\FeedGenerator\\'.ucwords($type);
        $this->_type = new $class();

        return $this;
    }

    /**
     * Creates the heading for the feed.
     *
     * @param string $title
     * @param string $desc
     * @param string $link
     * @param array  $author
     * @param int    $updated
     *
     * @return \Pazuzu156\FeedGenerator\Generator
     */
    public function create($title, $desc, $link, array $author = [], $updated = '')
    {
        $ex = explode('\\', $this->_type->getType());
        $type = strtolower($ex[count($ex) - 1]);

        switch ($type) {
        case 'rss':
            $this->_feed = $this->_type->create($title, $desc, $link);
            break;
        case 'atom':
            $this->_feed = $this->_type->create($title, $desc, $link, $author, $updated);
            break;
        }

        return $this;
    }

    /**
     * Adds an item to the feed.
     *
     * @param array $options
     *
     * @return \Pazuzu156\FeedGenerator\Generator
     */
    public function addItem(array $options)
    {
        $this->_feed .= $this->_type->addItem($options);

        return $this;
    }

    /**
     * Adds a given custom value to the feed.
     *
     * @param string $item
     *
     * @return \Pazuzu156\FeedGenerator\Generator
     */
    public function add($item)
    {
        $this->_feed .= $item;

        return $this;
    }

    /**
     * Renders the entire feed in XML format.
     *
     * @return string
     */
    public function render()
    {
        $this->complete();

        return $this->_feed;
    }

    /**
     * Renders the entire feed in JSON format.
     *
     * @return string
     */
    public function toJson()
    {
        $type = $this->complete();
        $data = simeplxml_load_string($this->_feed);
        header('Content-type: application/json');

        if ($type == 'rss') {
            return json_encode($data->channel);
        } elseif ($type == 'atom') {
            return json_encode($data);
        }
    }

    /**
     * Gets the current selected feed type.
     *
     * @return mixed
     */
    public function getType()
    {
        return $this->_type;
    }

    /**
     * Closes out feed endings.
     *
     * @return string
     */
    private function complete()
    {
        $ex = explode('\\', $this->_type->getType());
        $type = strtolower($ex[count($ex) - 1]);
        header('Content-type: application/'.$type.'+xml');

        switch ($type) {
        case 'rss':
            $this->_feed .= "  </channel>\n"
            ."</rss>\n";
            break;
        case 'atom':
            $this->_feed = "</feed>\n";
            break;
        }

        return $type;
    }
}
