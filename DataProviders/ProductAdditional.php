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
namespace Lof\Opengraph\DataProviders;

class ProductAdditional extends TagProvider implements TagProviderInterface
{
    /**
     * @var \Magento\Framework\Registry
     */
    protected $registry;

    /**
     * @var \Lof\Opengraph\Factory\TagFactoryInterface
     */
    protected $tagFactory;

    /**
     * @var \Lof\Opengraph\Mapper\Product
     */
    protected $productMapper;

    protected $tags = [];

    public function __construct(
        \Magento\Framework\Registry $registry,
        \Lof\Opengraph\Factory\TagFactoryInterface $tagFactory,
        \Lof\Opengraph\Mapper\Product $productMapper
    )
    {
        $this->registry = $registry;
        $this->tagFactory = $tagFactory;
        $this->productMapper = $productMapper;
    }

    public function getTags()
    {
        $product = $this->registry->registry('product');

        if (!$product or !$product->getId()) {
            return [];
        }

        $items = $this->productMapper->getItems($product);

        foreach($items as $name => $value){
            $tag = $this->tagFactory->getTag($name, $value);
            $this->addProductTag($tag);
        }

        return $this->tags;
    }
}