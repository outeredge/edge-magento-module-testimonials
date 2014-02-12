<?php

class Edge_Testimonials_Block_Adminhtml_Testimonials_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
		parent::__construct();

        $this->_objectId = 'id';
		$this->_blockGroup = 'testimonials';
        $this->_controller = 'adminhtml_testimonials';

		$this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('testimonials')->__('Save and Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

		$this->_formScripts[] = "
            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
		return Mage::helper('testimonials')->__('Edit Testimonials');
    }
}
