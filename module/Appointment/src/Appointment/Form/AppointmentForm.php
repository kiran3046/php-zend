<?php
namespace Appointment\Form;

use Zend\Form\Form;

class AppointmentForm extends Form
{
    public function __construct($name = null)
    {
        // we want to ignore the name passed
        $this->setPreferFormInputFilter(true);
        parent::__construct('appointment');
        $this->setAttribute('method', 'post');
        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type'  => 'hidden',
            ),
        ));
        $this->add(array(
            'name' => 'username',
            'type'  => 'text',
            'options' => array(
                'label' => 'Username',
            ),
        ));
        $this->add(array(
            'name' => 'reason_of_visit',
            'type'  => 'text',
            'options' => array(
                'label' => 'Reason of visit',
            ),
        ));
        $this->add(array(
            'type' => 'Zend\Form\Element\DateTimeLocal',
            'name' => 'start_time',
             'options' => array(
             'label'  => 'Appointment Start Time',
             'format' => 'Y-m-d\TH:i',
           ),
            'attributes' => array(
             'step' => '1', // minutes; default step interval is 1 min
        )
        ));
        $this->add(array(
            'type' => 'Zend\Form\Element\DateTimeLocal',
            'name' => 'end_time',
             'options' => array(
             'label'  => 'Appointment End Time',
             'format' => 'Y-m-d\TH:i'
        ),
            'attributes' => array(
            //'min' => '2010-01-01,00:00',
            // 'max' => '2020-01-01T00:00:00',
             'step' => '1', // minutes; default step interval is 1 min
        )
        ));
        $this->add(array(
             'name' => 'submit',
             'type' => 'Submit',
             'attributes' => array(
                 'value' => 'Go',
                 'id' => 'submitbutton',
             ),
         ));
    }
}