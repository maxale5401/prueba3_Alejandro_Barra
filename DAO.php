<?php
require "Paciente.php";

class DAO
{
    private $my;

    private function Connect()
    {
        $this->my = new mysqli("localhost", "root", "", "prueba3");
        if ($this->my->connect_errno) {
            die("error connecting to database");
        }
    }

    private function disconnect()
    {
        $this->my->close();
    }

    public function Register_Patient(Paciente $p)
    {
        $this->Connect();
        $id = $p->getId();
        $pac = $p->getPaciente();
        $diag = $p->getDiagnostico();
        $dias = $p->getDias();
        $sql = "insert into hospitalizacion values('$id', '$pac', '$diag', '$dias')";
        $st = $this->my->query($sql);
        if ($this->my->affected_rows == 1) {
            echo "Success, Patient added to database";
        } else {
            echo "Failure, Failed to add patient";
        }
        $this->disconnect();
    }

    public function List_patients()
    {
        $this->Connect();
        $sql = "select * from hospitalizacion";
        $list = array();
        $st = $this->my->query($sql);
        while ($rs = mysqli_fetch_array($st)) {
            $id = $rs[0];
            $pac = $rs[1];
            $diag = $rs[2];
            $dias = $rs[3];
            $p = new parent($id, $pac, $diag, $dias);
            $list[] = $p;
        }
        $this->disconnect();
        return $list;
    }

    public function Delete_Patient(Paciente $p)
    {
        $this->Connect();
        $id = $p->getId();
        $sql = "delete from hospitalizacion where hospitalizacion.id='$id'";
        $st = $this->my->query($sql);
        if ($this->my->affected_rows == 1) {
            echo "Success, Patient deleted from database";
        } else {
            echo "Failure, Failed to delete patient";
        }
        $this->disconnect();
    }
    public function Modify_Patient(Paciente $p)
    {
        $this->Connect();
        $id = $p->getId();
        $pac = $p->getPaciente();
        $diag = $p->getDiagnostico();
        $dias = $p->getDias();
        $sql = "update hospitalizacion set paciente ='$pac',diagnostico ='$diag',dias='$dias' where id='$id'";
        $st = $this->my->query($sql);
        if ($this->my->affected_rows == 1) {
            echo "Success, Patient modified in database";
        } else {
            echo "Failure, Failed to modify patient";
        }
        $this->disconnect();
    }

}