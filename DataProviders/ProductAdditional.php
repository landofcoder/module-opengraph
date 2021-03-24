<?php

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