<?php

class Inchoo_Gsfeed_Block_Adminhtml_Config_Edit_Tab_Form extends
    Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);

        if (Mage::getSingleton('adminhtml/session')->getFormData()) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData();
            Mage::getSingleton('adminhtml/session')->setFormData(null);
        } else if (Mage::registry('feed_data')) {
            $data = Mage::registry('feed_data')->getData();
        }

        $fieldset = $form->addFieldset('gsfeed_form', array(
            'legend' => Mage::helper('inchoo_gsfeed')->__('General Feed Information')
        ));

        $fieldset->addField('name', 'text', array(
            'label' => Mage::helper('inchoo_gsfeed')->__('Feed name'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'name'
        ));

        $fieldset->addField('enabled', 'select', array(
            'label' => Mage::helper('inchoo_gsfeed')->__('Enable feed'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'enabled',
            'values' => array(
                0 => 'Disabled',
                1 => 'Enabled',
            )
        ));

        $stores = Mage::app()->getStores();
        $selectData = array();
        foreach ($stores as $store) {
            $name = $store->getName();
            if ($name != 'Default') {
                $selectData[$store->getId()] = $store->getName();
            }
        }
        $fieldset->addField('store', 'select', array(
            'label' => Mage::helper('inchoo_gsfeed')->__('Feed store'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'store',
            'values' => $selectData,
        ));

        $fieldset->addField('link', 'text', array(
            'label' => Mage::helper('inchoo_gsfeed')->__('Feed link'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'link'
        ));

        $fieldset->addField('title', 'text', array(
            'label' => Mage::helper('inchoo_gsfeed')->__('Feed title'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'title'
        ));

        $fieldset->addField('description', 'textarea', array(
            'label' => Mage::helper('inchoo_gsfeed')->__('Feed decription'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'description'
        ));

        $form->setValues($data);
        return parent::_prepareForm();
    }
}