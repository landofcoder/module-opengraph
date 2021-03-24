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

class Mime extends \Magento\Framework\App\Helper\AbstractHelper
{
    protected $mimeTypes = [
        'png'  => 'image/png',
        'jpeg' => 'image/jpeg',
        'jpg'  => 'image/jpeg',
        'gif'  => 'image/gif',
        'svg'  => 'image/svg+xml',
    ];

    public function getMimeType($file)
    {
        $extension = $this->getFileExtension($file);

        $mimeType = $this->mimeTypes[$extension] ?? null;

        return $mimeType;
    }

    protected function getFileExtension($file)
    {
        if(strpos($file, '/') !== false){
            $fileParts = explode('/', $file);
            $file = end($fileParts);
        }

        return strtolower(pathinfo($file, PATHINFO_EXTENSION));
    }
}
