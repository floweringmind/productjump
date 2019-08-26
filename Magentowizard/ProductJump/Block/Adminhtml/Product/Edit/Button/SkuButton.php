<?php 
namespace Magentowizard\ProductJump\Block\Adminhtml\Product\Edit\Button;

use Magento\Catalog\Block\Adminhtml\Product\Edit\Button\Generic;

class SkuButton extends Generic
{
    public function getButtonData()
    {
        return [
            'label' => __('SKU'),
            'on_click' => '',
            'sort_order' => 100
        ];
    }
}