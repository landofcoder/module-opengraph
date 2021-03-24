<?php

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
