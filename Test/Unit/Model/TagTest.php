<?php

namespace Lof\Opengraph\Test\Unit\Model;

class TagTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var \Magento\TestFramework\ObjectManager
     */
    private $objectManager;

    /**
     * @var \Lof\Opengraph\Model\Tag
     */
    private $tag;

    public function setUp(): void
    {
        $this->objectManager = \Magento\TestFramework\ObjectManager::getInstance();

        $this->tag = $this->objectManager->get(\Lof\Opengraph\Model\Tag::class);
    }


    public function testItConvertTag()
    {
        $tag = $this->tag;

        $tag->setName('name');

        $this->assertEquals('og:name', $tag->getOpengraphName());
    }
}
