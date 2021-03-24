<?php

namespace Lof\Opengraph\Test\Integration\Service;

class TagsCollectorTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var \Magento\TestFramework\ObjectManager
     */
    private $objectManager;

    /**
     * @var \Lof\Opengraph\Service\TagsCollector
     */
    private $tagsCollector;

    public function setUp(): void
    {
        $this->objectManager = \Magento\TestFramework\ObjectManager::getInstance();

        $this->tagsCollector = $this->objectManager->get(\Lof\Opengraph\Service\TagsCollector::class);
    }


    public function testItReturnsTags()
    {
        $tags = $this->tagsCollector->getTags();

        $this->assertEquals('http://localhost/index.php/', $tags['og:url']);
        $this->assertEquals('en_US', $tags['og:locale']);
    }
}
