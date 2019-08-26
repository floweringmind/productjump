<?php 
namespace Magentowizard\ProductJump\Block\Adminhtml\Product\Edit\Button;

use Magento\Catalog\Block\Adminhtml\Product\Edit\Button\Generic;

class JumpButton extends Generic
{
    public function getButtonData()
    {
        return [
            'label' => __('Jump To Product'),
            'on_click' => '',
            'sort_order' => 100
        ];
    }
}