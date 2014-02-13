<?php

class Edge_Testimonials_Block_Adminhtml_Testimonials_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
	protected function _prepareForm()
    {
        $model = Mage::registry('testimonials');

        $form = new Varien_Data_Form(array(
            'id'        => 'edit_form',
            'action'    => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'))),
            'method'    => 'post',
            'enctype'	=> 'multipart/form-data'
        ));

        $fieldset = $form->addFieldset('base_fieldset', array(
            'legend'=>Mage::helper('testimonials')->__('General Information'),
            'class' => 'fieldset-wide'
        ));

        if ($model->getId()) {
            $fieldset->addField('id', 'hidden', array('name' => 'id'));
        }
        
        foreach (array('name', 'company', 'position') as $attribute){
            $fieldset->addField($attribute, 'text', array(
                'label' => Mage::helper('testimonials')->__(ucfirst($attribute)),
                'name'  => $attribute
            ));
        }
        
        $fieldset->addField('quote', 'textarea', array(
            'label' => Mage::helper('testimonials')->__('Quote'),
            'name'  => 'quote'
        ));
        
        $fieldset->addField('image', 'image', array(
            'label' => Mage::helper('testimonials')->__('Image'),
            'name'  => 'image'
        ));
        
        $fieldset->addField('sort_order', 'text', array(
            'label' => Mage::helper('testimonials')->__('Sort Order'),
            'name'  => 'sort_order'
        ));

        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);
        return parent::_prepareForm();
    }
}