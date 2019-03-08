<?php
namespace Appointment\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Appointment\Model\Appointment;   
use Appointment\Model\AppointmentTable; 
use Appointment\Form\AppointmentForm; 

 class AppointmentController extends AbstractActionController
 {
     protected $appointmentTable;
 
     // this action function is called on home page to list all appointments
     public function indexAction()
     {
          return new ViewModel(array(
              'title' => 'Appointments list',
             'appointments' => $this->getAppointmentTable()->fetchAll(),
         ));
     }

     // this action function is called to add new appointment using AppointmentForm
     public function addAction()
     {
        // Instantiate AppointmentForm and set the label on submit button to "Add"
        $form = new AppointmentForm();
        $form->get('submit')->setValue('Add');
        // get the request and fetch data from the form
        $request = $this->getRequest();
         // if request->ispost() is true ,it indicates form is submitted successfully
         if ($request->isPost()) {
             $appointment = new Appointment();
            //  set the form's input filter from appointment instance
             $form->setInputFilter($appointment->getInputFilter());
             $form->setData($request->getPost());

             // if form form data is valid ,get data from form and call saveAppointment() to save the data into database
             if ($form->isValid()) {
                 $appointment->exchangeArray($form->getData());
                 $this->getAppointmentTable()->saveAppointment($appointment);

                 // Redirect to list of appointments
                 return $this->redirect()->toRoute('appointment');
             }
         }
         // return variables to assign to view i.e. form object
         return array('form' => $form);
         
     }

   //  this action function is called to edit an appointment using id
     public function editAction()
     {
         $id = (int) $this->params()->fromRoute('id', 0);
         if (!$id) {
             return $this->redirect()->toRoute('appointment', array(
                 'action' => 'add'
             ));
         }

         // Get the Appointment with the specified id.  An exception is thrown
         // if it cannot be found, in which case go to the index page.
         try {
             $appointment = $this->getAppointmentTable()->getappointment($id);
         }
         catch (\Exception $ex) {
             return $this->redirect()->toRoute('appointment', array(
                 'action' => 'index'
             ));
         }
         
         $form  = new AppointmentForm();
         //attach model to the form
         $form->bind($appointment);
         
         // Display appointment start and end time on form as Y-m-d\TH:i because seconds should be 00 for a valid input of //datetimelocal
         $form->setData([
             'start_time' => date_create_from_format('Y-m-d H:i:s', $appointment->start_time)->format('Y-m-d\TH:i'), 
             'end_time' => date_create_from_format('Y-m-d H:i:s', $appointment->end_time)->format('Y-m-d\TH:i'),
         ]);
         
         
         $form->get('submit')->setAttribute('value', 'Edit');

         // perform similar steps as Add action
         $request = $this->getRequest();
         if ($request->isPost()) {
             $form->setInputFilter($appointment->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {
                 $this->getAppointmentTable()->saveAppointment($appointment);

                 // Redirect to list of appointments
                 return $this->redirect()->toRoute('appointment');
             } else {
               // $validator = new Zend_Validate_Date();
               // $validator->setMessage( 'Please input 00 in seonds !',Zend_Validate_Date::INVALID_DATE);
                 $messages = $form->getMessages();
                }
         }

        
         return array(
             'id' => $id,
             'form' => $form,
         );
     }

     public function deleteAction()
     {
         $id = (int) $this->params()->fromRoute('id', 0);
         if (!$id) {
             return $this->redirect()->toRoute('appointment');
         }

         $request = $this->getRequest();
         if ($request->isPost()) {
             $del = $request->getPost('del', 'No');

             if ($del == 'Yes') {
                 $id = (int) $request->getPost('id');
                 $this->getAppointmentTable()->deleteAppointment($id);
             }

             // Redirect to list of Appointments
             return $this->redirect()->toRoute('appointment');
         }

         return array(
             'id'    => $id,
             'appointment' => $this->getAppointmentTable()->getAppointment($id)
         );
     }
     
      public function getAppointmentTable()
     {
         if (!$this->appointmentTable) {
             $sm = $this->getServiceLocator();
             $this->appointmentTable = $sm->get('Appointment\Model\AppointmentTable');
         }
         return $this->appointmentTable;
     }
 }