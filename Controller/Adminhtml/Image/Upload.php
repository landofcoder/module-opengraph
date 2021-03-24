<?php

namespace Lof\Opengraph\Controller\Adminhtml\Image;

class Upload extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Lof\Opengraph\Service\Processor\UploadImageFactory
     */
    private $uploadImage;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Lof\Opengraph\Service\Processor\UploadImageFactory $uploadImage
    )
    {
        parent::__construct($context);
        $this->uploadImage = $uploadImage;
    }

    public function execute()
    {
        try {
            $result = $this->uploadImage->create()->processUpload('og_image', \Lof\Opengraph\Service\CmsImageUrlProvider::OPENGRAPH_CMS_IMAGE_PATH);
        } catch (\Exception $e)
        {
            $result = ['error' => $e->getMessage(), 'errorcode' => $e->getCode()];
        }
        return $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_JSON)->setData($result);
    }

    protected function _isAllowed()
    {
        return true;
    }
}