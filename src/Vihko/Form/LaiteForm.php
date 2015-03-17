<?php
namespace Vihko\Form;

 use Zend\Form\Form;

 class LaiteForm extends Form
 {
     public function __construct($laiteArray,$name = null)
     {
         // we want to ignore the name passed
         parent::__construct('laitteet');
         $this->add(array(
             'type' => 'Zend\Form\Element\Select',
            'name' => 'laitteet',
            'attributes' => array('onChange' => 'haeLaite(this, "", "index")'),
            'options' => array(
                'label' => 'Laitteet',
                'empty_option' => '-',
                'value_options' => $laiteArray,
            )
         ));
     }
 }