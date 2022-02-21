<?php

class StudentUpdate extends Users
{

    public function studentUpdateProfile($name,$surname,$phone,$homeAddress,$postalAddress,$country,$email,$sex,$dob,$id){
        parent::studentUpdateProfile($name,$surname,$phone,$homeAddress,$postalAddress,$country,$email,$sex,$dob,$id);
    }

}