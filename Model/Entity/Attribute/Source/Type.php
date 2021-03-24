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
namespace Lof\Opengraph\Model\Entity\Attribute\Source;

class Type extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
    /**
     * @var \Lof\Opengraph\Model\Source\Type
     */
    protected $typeSource;

    public function __construct(\Lof\Opengraph\Model\Source\Type $typeSource)
    {
        $this->typeSource = $typeSource;
    }

    public function getAllOptions()
    {
        return $this->typeSource->toOptionArray();
    }
}
