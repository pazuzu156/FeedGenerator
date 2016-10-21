<?php

use Pazuzu156\FeedGenerator\Generator;

class AtomTestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Creates a new generator instance.
     *
     * @return \Pazuzu156\FeedGenerator\Generator
     */
    private function create()
    {
        $gen = (new Generator('atom'))->create('Test Feed', 'My Atom Feed', 'http://example.com', [
            'name'  => 'John Doe',
            'email' => 'john.doe@example.com',
        ], time());

        return $gen;
    }

    /**
     * Adds atom link to feed.
     *
     * @return \Pazuzu156\FeedGenerator\Generator
     */
    private function add($gen)
    {
        return $gen->add($gen->getType()->addAtomLink('http://example.com/atom.xml'));
    }

    /**
     * Adds item to feed.
     *
     * @return \Pazuzu156\FeedGenerator\Generator
     */
    private function addItem($gen)
    {
        return $gen->addItem([
            'title'   => 'Test Title',
            'summary' => 'Test Summary',
            'content' => 'Test Content',
            'link'    => 'http://example.com/test-title',
            'updated' => time(),
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
