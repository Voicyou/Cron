<?php
/**
 * Copyright © 2016 Voicyou Softwares . All rights reserved.
 */
namespace Voicyou\Cron\Block\Adminhtml\Cron;
class CronData extends \Magento\Framework\View\Element\Template
{
    /**
     *
     * @var type 
     */
    protected $_config;

    /**
     * 
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Cron\Model\ConfigInterface $config
     * @param type $data
     */
    public function __construct(\Magento\Framework\View\Element\Template\Context $context,
                                \Magento\Cron\Model\ConfigInterface $config,
                                 array $data = [])
    {
        parent::__construct($context, $data);
        $this->_config = $config;
        $jobGroupsRoot = $this->_config->getJobs();
        $data = $this->_request->getParam('group');
    }
    
    /**
     * 
     * @return type
     */
    function getCronData()
    {
        return $this->_config->getJobs();
    }
}
