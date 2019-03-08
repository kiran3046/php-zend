<?php
namespace Appointment\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

 class Appointment
 {
     public $id;
     public $username;
     public $reason_of_visit;
     public $start_time;
     public $end_time;
     protected $inputFilter;
     
     //Method  needed by hydrator
     public function exchangeArray($data)
     {
         $this->id = (!empty($data['id'])) ? $data['id'] : null;
         $this->username = (!empty($data['username'])) ? $data['username'] : null;
         $this->reason_of_visit  = (!empty($data['reason_of_visit'])) ? $data['reason_of_visit'] : null;
         $this->start_time  = (!empty($data['start_time'])) ? $data['start_time'] : null;
         $this->end_time  = (!empty($data['end_time'])) ? $data['end_time'] : null;
         
     }
     
     // return copy of object as array
     public function getArrayCopy()
     {
         return get_object_vars($this);
     }
      
     
     public function setInputFilter(InputFilterInterface $inputFilter)
     {
         throw new \Exception("Not used");
     }

     // set input filters for all the inputs on the form
     public function getInputFilter()
     {
         if (!$this->inputFilter) {
             
             $inputFilter = new InputFilter();
             $inputFilter->add(array(
                 'name'     => 'id',
                 'required' => false,
                 'filters'  => array(
                     array('name' => 'Int'),
                 ),
             ));

             $inputFilter->add(array(
                 'name'     => 'username',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),
                 ),
                 'validators' => array(
                     array(
                      'name' =>'NotEmpty', 
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'Please enter User Name!' 
                            ),
                        ),
                    ),
                     array(
                         'name'    => 'StringLength',
                         'options' => array(
                             'encoding' => 'UTF-8',
                             'min'      => 5,
                             'max'      => 40,
                         ),
                     ),
                 ),
             ));

             $inputFilter->add(array(
                 'name'     => 'reason_of_visit',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),
                 ),
                 'validators' => array(
                      array(
                      'name' =>'NotEmpty', 
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'Please specify reason of visit!' 
                            ),
                        ),
                    ),
                     array(
                         'name'    => 'StringLength',
                         'options' => array(
                             'encoding' => 'UTF-8',
                             'min'      => 5,
                             'max'      => 100,
                         ),
                     ),
                 ),
             ));
             
               $inputFilter->add(array(
                 'name'     => 'start_time',
                 'required' => true,
                 'filters'  => array(
					array('name' => 'StripTags'),
				),
                 'validators' => array(
                     array(
                         'name'    => 'NotEmpty',
                         'break_chain_on_failure' => true,
                         'options' => array(
                             'messages' => array(
                             \Zend\Validator\NotEmpty::IS_EMPTY => "Start Time cannot be empty!"
     
                         ),
                     ),
                ),
            )));
             
              $inputFilter->add(array(
                 'name'     => 'end_time',
                 'required' => true,
                 'filters'  => array(
					array('name' => 'StripTags'),
				),
                 'validators' => array( 
                     array(
                         'name'    => 'NotEmpty',
                        'break_chain_on_failure' => true,
                         'options' => array(
                             'messages' => array(
                             \Zend\Validator\NotEmpty::IS_EMPTY => "End Time cannot be empty!"
     
                         ),
                     ),
                ),    
            )));
             
             $this->inputFilter = $inputFilter;
         }

         return $this->inputFilter;
     }
 }