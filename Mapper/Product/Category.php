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
namespace Lof\Opengraph\Mapper\Product;

class Category
{
    /**
     * @var \Magento\Framework\Registry $registry
     */
    protected $registry;

    /**
     * @var \Magento\Catalog\Api\CategoryRepositoryInterface
     */
    private $categoryRepository;

    public function __construct(
        \Magento\Framework\Registry $registry,
        \Magento\Catalog\Api\CategoryRepositoryInterface $categoryRepository
    )
    {
        $this->registry = $registry;
        $this->categoryRepository = $categoryRepository;
    }

    public function getTagValue($product)
    {
        $currentCategory = $this->registry->registry('current_category');

        if($currentCategory and $currentCategory->getId()){
            return $currentCategory->getName();
        }

        $productCategories = $product->getAvailableInCategories();

        if(empty($productCategories) or !is_array($productCategories)) {
            return null;
        }

        $categoryId = $productCategories[0];

        $category = $this->categoryRepository->get($categoryId);

        return $category->getName();
    }
}
