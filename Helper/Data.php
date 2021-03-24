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

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    const CMS_HOMEPAGE_PATH = 'web/default/cms_home_page';

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var \Magento\Cms\Api\Data\PageInterface
     */
    protected $page;

    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Cms\Api\Data\PageInterface $page
    ) {
        parent::__construct($context);

        $this->scopeConfig = $scopeConfig;
        $this->page = $page;
    }

    public function isHomePage()
    {
        $homepageIdentifier = $this->scopeConfig->getValue(self::CMS_HOMEPAGE_PATH, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);

        if(!$homepageIdentifier){
            return false;
        }

        $currentPageIdentifier = $this->page->getIdentifier();

        if(!$currentPageIdentifier){
            return false;
        }

        return $homepageIdentifier == $currentPageIdentifier;
    }
}
