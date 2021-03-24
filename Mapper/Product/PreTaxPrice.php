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

class PreTaxPrice extends AbstractItem
{
    public function getTagValue($product)
    {
        $return = [
            'currency' => $this->getCurrency(),
            'amount' =>  $product->getPriceInfo()->getPrice(\Magento\Catalog\Pricing\Price\FinalPrice::PRICE_CODE)->getAmount()->getBaseAmount()
        ];

        $productType = $product->getTypeId();

        if($productType != \Magento\ConfigurableProduct\Model\Product\Type\Configurable::TYPE_CODE or $productType != \Magento\Bundle\Model\Product\Type::TYPE_CODE){
            return $this->formatPrice($return);
        }

        $simpleProducts = $product->getTypeInstance()->getUsedProducts($product, 'price');
        foreach ($simpleProducts as $simpleProduct) {
            $price = $simpleProduct->getPriceInfo()->getPrice(\Magento\Catalog\Pricing\Price\FinalPrice::PRICE_CODE)->getAmount()->getBaseAmount();
            $return['amount'] = max($return['amount'], $price);
        }

        return $this->formatPrice($return);
    }
}
