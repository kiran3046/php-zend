<?php
namespace AppointmentRest\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Appointment\Model\Appointment;          
use Appointment\Form\AppointmentForm;      
use Zend\View\Model\JsonModel;

class AppointmentRestController extends AbstractRestfulController
{
    protected $appointmentTable;

   // To list the appointments,retrieve them from the model and return a JsonModel
    public function getList()
    {
        $results = $this->getAppointmentTable()->fetchAll();
        $data = array();
        foreach($results as $result) {
            $data[] = $result;
        }
        return new JsonModel(array(
            'data' => $data,
        ));
         
    }

    public function get($id)
    {
        $appointment = $this->getAppointmentTable()->getAppointment($id);

        return new JsonModel(array(
            'data' => $appointment,
        ));
    }

    public function create($data)
    { 
        $form = new AppointmentForm();
        $request = $this->getRequest();
        $appointment = new Appointment();
        $form->setInputFilter($appointment->getInputFilter());
        $form->setData($request->getPost()); 
        $dataArr=[];
        if ($form->isValid()) {
            $appointment->exchangeArray($form->getData());
            $this->getAppointmentTable()->saveAppointment($appointment);
            $dataArr['status'] ='success';
            $dataArr['message'] = 'Appointment added successfully!';
            return new JsonModel($dataArr);
        }
        $dataArr['status'] ='error';
        $dataArr['message'] = 'invalid data';
        return new JsonModel($dataArr);
    }

    public function update($id, $data)
    {
         if(empty($id) || !is_numeric($id)){
            return new JsonModel(array(
                    'data' => array(),
                    'error' => 'ID is a mandatory paramenter!'
            ));
        }
        $data['id'] = $id;
        $appointment = $this->getAppointmentTable()->getAppointment($id);
        $form  = new AppointmentForm();
        $form->bind($appointment);
        $form->setInputFilter($appointment->getInputFilter());
        $form->setData($data);
        if ($form->isValid()) {
            $id = $this->getAppointmentTable()->saveAppointment($form->getData());
        }else{
            return new JsonModel(array(
                'data' => array(),
                'error' => $form->getInputFilter()->getMessages(),
            ));
        }
        return $this->get($id);
    }

    public function delete($id)
    {
        $this->getAppointmentTable()->deleteAppointment($id);

        return new JsonModel(array(
            'data' => 'deleted',
        ));
    }

    public function getappointmentTable()
    {
        if (!$this->appointmentTable) {
            $sm = $this->getServiceLocator();
            $this->appointmentTable = $sm->get('Appointment\Model\AppointmentTable');
        }
        return $this->appointmentTable;
    }
}
