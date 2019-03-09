# Zend CRUD using REST API 

## Introduction
This is a skeleton application using the Zend Framework MVC layer and module systems. It's a simple doctor appointment booking application that allows a user to do CRUD operations via REST API.

## DB Schema file
data\appointment.sql

Set Database name and host in config/autoload/global.php

Set Database username and password in config/autoload/local.php 


## Appointment module

Appointment module is set up as below:
php-zend/
     /module
         /Appointment 
             /config
             /src
                 /Appointment 
                     /Controller
                     /Form
                     /Model
             /view
                 /appointment 
                     /appointment 


## Application overview

| Page | Description |
| --- | --- |
| `Home Page` | This page displays the list of appointments and provide links to edit and delete them. Also, a link to enable adding new appointments is provided. |
| `Add new Appointment` | This page provides a form for adding a new appointment. |
| `Edit Appointment ` | This page provides a form for editing an appointment. |
| `Delete Appointment` | This page confirms that we want to delete an appointment and then delete it.. |

## Basic URLs (without REST calls)

| URL| Page| Action | Method called
| --- | --- | --- | --- |
| /appointment | Home - List of all apoointments | index | AppointmentController::indexAction
| /appointment /add | Add new appointment | add | AppointmentController::addAction
| /appointment /edit/1 | Edit an appointment with id=2 | edit |AppointmentController::editAction
| /appointment /delete/2| Delete an appointment | delete | AppointmentController::deleteAction


## REST Example

First create a database in your local db and import data/appointment.sql file.

Update username,password in local.php and update db name and host in global.php

We publish the following URLs using curl:

### GET /appointment-rest

Request : 
```http
curl -i -H "Accept: application/json" http://localhost/appointment-rest
```
Response:
```http
HTTP/1.1 200 OK
Date: Fri, 08 Mar 2019 05:34:57 GMT
Server: Apache/2.4.33 (Win32) PHP/7.2.4
X-Powered-By: PHP/7.2.4
Content-Length: 985
Content-Type: application/json; charset=utf-8
{
    "data": [
        {
            "id": "13",
            "username": "Kirandeep Kaur",
            "reason_of_visit": "regular checkup",
            "start_time": "2019-01-01 01:00:00",
            "end_time": "2020-01-01 01:50:00"
        },
        {
            "id": "3",
            "username": "kiran123",
            "reason_of_visit": "Monthly-checkup",
            "start_time": "2019-02-24 05:56:00",
            "end_time": "2019-02-24 05:56:00"
        },
        {
            "id": "4",
            "username": "kiran123",
            "reason_of_visit": "Lab tests go-through",
            "start_time": "2019-02-24 05:56:00",
            "end_time": "2019-02-24 05:56:00"
        },
    ]
}
```

### GET Particular Appointment using  /appointment-rest/3

Request:
```http
curl -i -H "Accept: application/json" http://localhost/appointment-rest/13
```
Response:
```http
HTTP/1.1 200 OK
Date: Fri, 08 Mar 2019 05:36:19 GMT
Server: Apache/2.4.33 (Win32) PHP/7.2.4
X-Powered-By: PHP/7.2.4
Content-Length: 152
Content-Type: application/json; charset=utf-8
{
    "data": {
        "id": "3",
        "username": "kiran123",
        "reason_of_visit": "Monthly-checkup",
        "start_time": "2019-02-24 05:56:00",
        "end_time": "2019-02-24 05:56:00"
    }
}
```

### DELETE an appointment using 

Request:
```http
curl -i -H "Accept: application/json" -X DELETE http://localhost/appointment-rest/13
```
Response:
```http
HTTP/1.1 200 OK
Date: Fri, 08 Mar 2019 05:38:10 GMT
Server: Apache/2.4.33 (Win32) PHP/7.2.4
X-Powered-By: PHP/7.2.4
Content-Length: 18
Content-Type: application/json; charset=utf-8

{"data":"deleted"}
```
### POST and PUT not working properly..

Request:
```http
curl -i -H "Accept: application/json" -X POST -d "{\"username\":\"TestValue\",\"reason_of_visit\":\"Test Value\",\"start_time\":\"2019-01-01 01:00:00\",\"end_time\":\"2019-01-01 01:00:00\"}" http://localhost/appointment-rest
```

Response:
```http
{"status":"error","message":"invalid data"}
```

although they work without using api calls via localhost HOME PAGE.
###localhost/appointment
