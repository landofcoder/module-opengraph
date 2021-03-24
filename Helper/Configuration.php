<?php
/**
 * Landofcoder
 * 
 * NOTICE OF LICENSE
 * 
 * This source file is subject to the Landofcoder.com license that is
 * available through the world-wide-web at this URL:
 * https://landofcoder.com/license
 * 
 * DISCLAIMER
 * 
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 * 
 * @category   Landofcoder
 * @package    Lof_Opengraph
 * @copyright  Copyright (c) 2021 Landofcoder (https://landofcoder.com/)
 * @license    https://landofcoder.com/LICENSE-1.0.html
 */
namespace Lof\Opengraph\Helper;

class Configuration extends \Magento\Framework\App\Helper\AbstractHelper
{
    const PACKAGE_OPENGRAPH_PATH = 'seo/package';
    const FACEBOOK_OPENGRAPH_PATH = 'seo/opengraph';
    const STORE_NAME_PATH = 'general/store_information/name';

    private $config;

    private $package_config;

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;

    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    ) {
        parent::__construct($context);

        $this->scopeConfig = $scopeConfig;
    }

    public function isEnabled()
    {
        $config = $this->getConfig();

        return (boolean) $config['is_enabled'];
    }

    public function isEnabledForProduct()
    {
        $config = $this->getPackageConfig();
        if(!$config){
            return true;
        }
        return (isset($config['product']) && isset($config['product']['og_enabled']))?(boolean) $config['product']['og_enabled']:false;
    }

    public function isEnabledForCategory()
    {
        $config = $this->getPackageConfig();
        if(!$config){
            return true;
        }
        return (isset($config['category']) && isset($config['category']['og_enabled']))?(boolean) $config['category']['og_enabled']:false;
    }

    public function isEnabledForPage()
    {
        $config = $this->getPackageConfig();
        if(!$config){
            return true;
        }
        return (isset($config['page']) && isset($config['page']['og_enabled']))?(boolean) $config['page']['og_enabled']:false;
    }

    public function isEnabledForWebsite()
    {
        $config = $this->getPackageConfig();
        if(!$config){
            return true;
        }
        return (isset($config['website']) && isset($config['website']['og_enabled']))?(boolean) $config['website']['og_enabled']:false;
    }

    public function getFbAppId()
    {
        $config = $this->getConfig();

        if(!isset($config['fb_app_id'])){
            return null;
        }

        return $config['fb_app_id'];
    }

    public function geDefaultImage()
    {
        $config = $this->getConfig();

        if(!isset($config['default_image'])){
            return null;
        }

        return $config['default_image'];
    }

    public function getStoreName()
    {
        return $this->scopeConfig->getValue(self::STORE_NAME_PATH, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    private function getConfig()
    {
        if(!$this->config){
            $this->config = $this->scopeConfig->getValue(self::FACEBOOK_OPENGRAPH_PATH, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        }

        return $this->config;
    }

    private function getPackageConfig()
    {
        if(!$this->package_config){
            $this->package_config = $this->scopeConfig->getValue(self::PACKAGE_OPENGRAPH_PATH, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        }

        return $this->package_config;
    }
}
