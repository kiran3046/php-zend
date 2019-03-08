<?php
namespace Appointment\Model;

use Zend\Db\TableGateway\TableGateway;

class AppointmentTable
{
     protected $tableGateway;

     public function __construct(TableGateway $tableGateway)
     {
         $this->tableGateway = $tableGateway;
     }

     public function fetchAll()
     {
         $resultSet = $this->tableGateway->select();
         return $resultSet;
     }

     public function getAppointment($id)
     {
         $id  = (int) $id;
         $rowset = $this->tableGateway->select(array('id' => $id));
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("Could not find row $id");
         }
         return $row;
     }

     public function saveAppointment(Appointment $appointment)
     {
         $data = array(
             'username' => $appointment->username,
             'reason_of_visit'  => $appointment->reason_of_visit,
             'start_time'  => $appointment->start_time,
             'end_time'  => $appointment->end_time,
             
         );

         $id = (int) $appointment->id;
         if ($id == 0) {
             $this->tableGateway->insert($data);
         } else {
             if ($this->getAppointment($id)) {
                 $this->tableGateway->update($data, array('id' => $id));
             } else {
                 throw new \Exception('Appointment id does not exist');
             }
         }
         return $id;
     }

     public function deleteAppointment($id)
     {
         $this->tableGateway->delete(array('id' => (int) $id));
     }
}