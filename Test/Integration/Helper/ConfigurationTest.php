<?php

namespace Lof\Opengraph\Test\Integration\Helper;

class ConfigurationTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var \Magento\TestFramework\ObjectManager
     */
    private $objectManager;

    /**
     * @var \Lof\Opengraph\Helper\Configuration
     */
    private $configuration;

    public function setUp(): void
    {
        $this->objectManager = \Magento\TestFramework\ObjectManager::getInstance();

        $this->configuration = $this->objectManager->get(\Lof\Opengraph\Helper\Configuration::class);
    }

    /**
     * @magentoDbIsolation enabled
     * @magentoConfigFixture current_store seo/opengraph/fb_app_id fb_test
     */
    public function testItReturnCorrectFbAppId()
    {
        $fbApp = $this->configuration->getFbAppId();

        $this->assertEquals('fb_test', $fbApp);
    }
}
