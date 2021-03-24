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
    const FACEBOOK_OPENGRAPH_PATH = 'facebook/opengraph';
    const STORE_NAME_PATH = 'general/store_information/name';

    private $config;

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
}
