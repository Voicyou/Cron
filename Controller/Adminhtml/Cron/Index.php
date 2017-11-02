<?php
/**
 * Copyright © 2016 Voicyou Softwares . All rights reserved.
 */
namespace Voicyou\Cron\Controller\Adminhtml\Cron;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
class Index extends \Magento\Backend\App\Action
{

    /**
     *
     * @var Magento\Framework\View\Result\PageFactory 
     */	
    protected $resultPageFactory;

    /**
     * 
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * 
     * @return type
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->addBreadcrumb(__('Voicyou Cron Listing'), __('Voicyou Cron Listing'));
        $resultPage->getConfig()->getTitle()->prepend(__('Voicyou Cron Listing'));
        return $resultPage;
    }
}
