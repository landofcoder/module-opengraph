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
namespace Lof\Opengraph\Factory;

interface TagFactoryInterface
{

    /**
     * Returns Tag object
     *
     * @param string $name
     * @param string $value
     * @param bool $addEvenIfValueIsEmpty
     * @return \Lof\Opengraph\Model\Tag|null
     */
    public function getTag($name, $value, $addEvenIfValueIsEmpty = false);
}
