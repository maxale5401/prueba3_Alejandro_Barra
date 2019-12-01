<?php
require "Paciente.php";

class DAO
{
    private $my;

    private function Connect()
    {
        $this->my = new mysqli("localhost", "root", "", "prueba3");
        if ($this->my->connect_error) {
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
        $sql = "insert into hospitalizacion values('$id','$pac','$diag','$dias')";
        $st = $this->my->query($sql);
        if ($this->my->affected_rows == 1) {
            echo "Success, Patient added to database";
        } else {
            echo "Failure, Failed to add patient";
        }
        $this->disconnect();
    }

    public function Patient_Stats($type)
    {
        $this->Connect();
        $count = 0;
        $sum = 0;
        $sql = "select dias from hospitalizacion";
        $st = $this->my->query($sql);
        while ($rs = mysqli_fetch_array($st)) {
            $count = $count + 1;
            $sum += $rs[0];
        }
        $pro = $sum / $count;
        switch ($type) {
            case 0:
                return $count;
                break;
            case 1:
                return $pro;
                break;
        }
    }

    public function Get_Patient($id)
    {
        $this->Connect();
        $sql = "select * from hospitalizacion where id='$id'";
        $st = $this->my->query($sql);
        $rs = mysqli_fetch_array($st);
        if ($rs == !null) {
            $pac = $rs[1];
            $diag = $rs[2];
            $dias = $rs[3];
            $p = new Paciente($id, $pac, $diag, $dias);
            $this->disconnect();
            return $p;

        }else{
            $this->disconnect();
            return null;
        }

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
            $p = new Paciente($id, $pac, $diag, $dias);
            $list[] = $p;
        }
        $this->disconnect();
        return $list;
    }

    public function Delete_Patient($id)
    {
        $this->Connect();
        $sql = "delete from hospitalizacion where id='$id'";
        $st = $this->my->query($sql);
        if ($this->my->affected_rows == 1) {
            echo "Success, Patient deleted from database";
        } else {
            echo "Failure, Failed to delete/find patient";
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