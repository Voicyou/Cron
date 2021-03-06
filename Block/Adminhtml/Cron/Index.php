<?php
/**
 * Copyright © 2016 Voicyou Softwares . All rights reserved.
 */
namespace Voicyou\Cron\Block\Adminhtml\Cron;
class Index extends \Magento\Backend\Block\Widget\Grid\Extended
{
    /**
     * @var \Magento\Framework\Module\Manager
     */
    protected $moduleManager;

    /**
     * @var \Magento\Catalog\Model\ResourceModel\Product\Attribute\Collection
     */
    protected $_collection;

    /**
     * @var \Magento\Backend\Helper\Data
     */
    protected $backendHelper;
    /**
     *
     * @var \Voicyou\Cron\Block\Adminhtml\Cron\CronData
     */
    protected $cronData;
    /**
     *
     * @var \Magento\Framework\Data\Collection
     */
    protected $dataCollection;
    /**
     *
     * @var \Magento\Framework\DataObjectFactory 
     */
    protected $dataObjectFactory;
    /**
     * 
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Backend\Helper\Data $backendHelper
     * @param \Magento\Framework\Data\Collection $dataCollection
     * @param \Magento\Framework\DataObjectFactory $dataObjectFactory
     * @param \Voicyou\Cron\Block\Adminhtml\Cron\CronData $cronData
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,    
        \Magento\Framework\Data\Collection $dataCollection,
        \Magento\Framework\DataObjectFactory $dataObjectFactory,
        \Voicyou\Cron\Block\Adminhtml\Cron\CronData $cronData,
        array $data = []
    )
    {
        $this->backendHelper = $backendHelper;
        $this->cronData  = $cronData;
        $this->dataCollection = $dataCollection;
        $this->dataObjectFactory = $dataObjectFactory;
        parent::__construct($context, $backendHelper, $data);
    }

    /**
     * @return void
    */
   protected function _construct()
   {
        parent::_construct();
        $this->setPagerVisibility(false); // remove the pagination option from the page
        $this->setFilterVisibility(false); // remove the filter row from the grid
   }
 
   /**
    * 
    * @return collection
    */
   protected function _prepareCollection()
   {
        $count = 1;
        $rows = $this->cronData->getCronData();
        $collection = $this->dataCollection;
        foreach($rows as $row){
            foreach($row as $key=>$datahere)
            {
                $datahere['rowid'] = $count; 
                $rowObj = $this->dataObjectFactory->create();// use this create method to prevent getting only the last data in the grid.
                $rowObj->setData($datahere)->toJson();
                $collection->addItem($rowObj);
                $collection->loadData();
                $count++;
            }
        } 
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    /**
     * 
     * @return array
     */
    protected function _prepareColumns()
    {
      $this->addColumn("name", array(
            "header" => __("Job Name"),
            "align" => "left",
            'width' => '25',
            "index" => "name",
            "filter"  => false
        ));

      
     $this->addColumn("method", array(
            "header" => __("Method"),
            "align" => "center",
            "index" => "method",
            'width' => '150',
            "filter"  => false

        ));

        $this->addColumn("schedule", array(
            "header" =>__("Schedule"),
            "align"  => "left",
            "index"  => "schedule",
            'width'  => '150',
            "filter"   => false

        ));
       
        return parent::_prepareColumns();
    }
    
    /**
     * 
     * @param type $item
     */
    public function getRowUrl($item) {
        parent::getRowUrl($item);
    }
    /**
     * 
     * @return string
     */
    public function getMainButtonsHtml()
    {
        return '';
    }
}
