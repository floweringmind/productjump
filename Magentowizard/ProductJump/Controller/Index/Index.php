<?php
namespace  Magentowizard\ProductJump\Controller\Index;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\RequestInterface;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $request;
    protected $productRepository;
    protected $HelperBackend;
    protected $messageManager;

    public function __construct(
        \Magento\Framework\Message\ManagerInterface $messageManager, 
        \Magento\Backend\Helper\Data $HelperBackend,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository, 
        Context $context, 
        RequestInterface $request)
    {
        $this->_productRepository = $productRepository;
        $this->_request = $request;
        $this->_helperBackend = $HelperBackend;
        $this->_messageManager = $messageManager;
        return parent::__construct($context);
    }
    public function execute()
    {        
        $adminUrl = explode("/", $this->_helperBackend->getHomePageUrl());
        $data =  $this->_request->getParams();
        $skuid =  $data["skuid"];

        // product id or sku to id
        if (substr($skuid, 0, 1) == "*"){
            $productId = trim($skuid, '*');
            $product = $this->productCheck($productId, "id");
        }else{
            $product = $this->productCheck($skuid, "sku");
            $productId = $product->getEntityId();
        }

        $newProductURL = "/".$adminUrl[3]."/catalog/product/edit/id/".$productId."/";
        
        header('Location: '.$newProductURL);

        die();
    }

    public function productCheck($productId, $type)
    {
        try {
            if ($type == "sku"){
                $product = $this->_productRepository->get($productId);
            }else{
                $product = $this->_productRepository->getById($productId);    
            }
        }catch (\Magento\Framework\Exception\NoSuchEntityException $e){
            $this->_messageManager->addError(__("Error: Could not find the product."));
            if(isset($_SERVER['HTTP_REFERER'])) {
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }else{
                header('Location: '. $this->_helperBackend->getHomePageUrl());
            }
            die();
        }
        return $product;        
    }
  
}