<?php

class Edge_Testimonials_Block_Adminhtml_Testimonials_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
	public function __construct()
    {
        parent::__construct();
        $this->setId('testimonialsGrid');
        $this->setDefaultSort('id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('testimonials/testimonials')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('id', array(
            'header'    => Mage::helper('testimonials')->__('ID'),
            'width'     => '50',
            'index'     => 'id'
        ));

        $this->addColumn('name', array(
            'header'    => Mage::helper('testimonials')->__('Name'),
            'index'     => 'name'
        ));

        $this->addColumn('quote', array(
            'header'    => Mage::helper('testimonials')->__('Quote'),
            'index'     => 'quote'
        ));

        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
}