<?php

use Pazuzu156\FeedGenerator\Generator;

class RssTestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Creates a new generator instance.
     *
     * @return \Pazuzu156\FeedGenerator\Generator
     */
    private function create()
    {
        $gen = (new Generator())->setType('rss')->create('Test Feed', 'My RSS Feed', 'http://example.com');

        return $gen;
    }

    /**
     * Adds atom link to feed.
     *
     * @return \Pazuzu156\FeedGenerator\Generator
     */
    private function add($gen)
    {
        return $gen->add($gen->getType()->addAtomLink('http://example.com/rss.xml'));
    }

    /**
     * Adds item to feed.
     *
     * @return \Pazuzu156\FeedGenerator\Generator
     */
    private function addItem($gen)
    {
        return $gen->addItem([
            'title' => 'Test Title',
            'description' => 'Test Content',
            'link' => 'http://example.com/test-title',
            'pubDate' => time(),
        ]);
    }

    public function testCreation()
    {
        $gen = $this->create();

        $this->assertSame('Pazuzu156\FeedGenerator\Generator', get_class($gen));
        $this->assertNotNull($gen);
    }

    public function testAdd()
    {
        $gen = $this->add($this->create());

        $this->assertNotNull($gen);
    }

    public function testAddItem()
    {
        $gen = $this->addItem($this->add($this->create()));

        $this->assertNotNull($gen);
    }
}
