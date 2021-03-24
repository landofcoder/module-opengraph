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

class PageType extends \Magento\Framework\App\Helper\AbstractHelper
{
    const DEFAULT_PAGE_TYPE = 'default';

    private $allowedRouteNames = ['cms', 'catalog'];

    /**
     * @var \Magento\Framework\App\Request\Http
     */
    private $request;

    /**
     * @var \Magento\Framework\Registry
     */
    private $registry;


    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Framework\App\Request\Http $request,
        \Magento\Framework\Registry $registry
    ) {
        parent::__construct($context);

        $this->request = $request;
        $this->registry = $registry;
    }

    public function getPageType()
    {
        $routeName = $this->request->getRouteName();

        if(!in_array($routeName, $this->allowedRouteNames)){
            return self::DEFAULT_PAGE_TYPE;
        }

        $product = $this->registry->registry('product');

        if($product){
            return 'product';
        }

        $category = $this->registry->registry('current_category');

        if($category){
            return 'category';
        }

        return $routeName;
    }
}
