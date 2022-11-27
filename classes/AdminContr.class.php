<?php
class AdminContr extends AdminModel {

    public function deleteProgram($programID){
        parent::deleteProgram($programID);
    }

    public function addProgram($name)
    {
        parent::addProgram($name);
    }

    public function deleteCategory($id)
    {
        parent::deleteCategory($id);
    }

    public function addCategory($name, $description){
        parent::addCategory($name, $description);
    }

    public function addAcc($loginID, $name, $type)
    {
        parent::addAcc($loginID, $name, $type);
    }

}
