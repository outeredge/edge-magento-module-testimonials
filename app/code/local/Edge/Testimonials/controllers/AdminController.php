<?php

class Edge_Testimonials_AdminController extends Mage_Adminhtml_Controller_Action
{
    protected $model;

    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('edge/testimonials');
    }
    
    protected function _initAction()
    {
        $this->loadLayout()
            ->_title($this->__('outer/edge'))
            ->_title($this->__('Testimonials'))
            ->_setActiveMenu('edge');

        return $this;
    }

    protected function _initModel()
    {
        $this->model = Mage::getModel('testimonials/testimonials');

        $id = $this->getRequest()->getParam('id', false);
        if ($id !== false){
            $this->model->load($id);
        }

        Mage::register('testimonials', $this->model);
        return $this->model;
    }

    public function indexAction()
    {
        $this->_initAction()
            ->_addContent($this->getLayout()->createBlock('testimonials/adminhtml_testimonials'))
            ->renderLayout();
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function editAction()
    {
        $this->_initModel();

        $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
        if (!empty($data)) {
            $this->model->setData($data);
        }

        $this->_initAction()
            ->_addContent($this->getLayout()->createBlock('testimonials/adminhtml_testimonials_edit'))
            ->renderLayout();
    }

    public function saveAction()
    {
        if ($data = $this->getRequest()->getPost()) {

            if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != ''){
                try {
                    $uploader = new Mage_Core_Model_File_Uploader('image');
                    $uploader->setAllowedExtensions(array('jpg','jpeg','gif','png'));
                    $uploader->setAllowRenameFiles(true);
                    $uploader->setFilesDispersion(false);
                    $result = $uploader->save(Mage::getBaseDir('media') . DS . 'testimonials' . DS, $_FILES['image']['name']);

                } catch (Exception $e){}

                $data['image'] = 'testimonials/' . $result['file'];
            }
            elseif (is_array($data['image'])) {
                $data['image'] = $data['image']['value'];
            }

            $model = Mage::getModel('testimonials/testimonials');
            $model->setData($data)
                  ->setId($this->getRequest()->getParam('id'));

            try {
                $model->save();

                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('testimonials')->__('Item was successfully saved.'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);

                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $model->getId()));
                    return;
                }

                $this->_redirect('*/*/');
                return;

            } catch (Exception $e) {

                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }

        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('testimonials')->__('Unable to find item to save'));
        $this->_redirect('*/*/');
	}

    public function deleteAction()
    {
        if ($this->getRequest()->getParam('id') > 0){
            try {
                $model = Mage::getModel('testimonials/testimonials');
                $model->setId($this->getRequest()->getParam('id'));
                $model->delete();

                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('testimonials')->__('Testimonials was successfully deleted.'));
                $this->_redirect('*/*/');

            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
    }
}