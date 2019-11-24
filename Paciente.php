<?php


class Paciente
{
private $id;
private $paciente;
private $diagnostico;
private $dias;

    /**
     * Paciente constructor.
     * @param $id
     * @param $paciente
     * @param $diagnostico
     * @param $dias
     */
    public function __construct($id, $paciente, $diagnostico, $dias)
    {
        $this->id = $id;
        $this->paciente = $paciente;
        $this->diagnostico = $diagnostico;
        $this->dias = $dias;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getPaciente()
    {
        return $this->paciente;
    }

    /**
     * @return mixed
     */
    public function getDiagnostico()
    {
        return $this->diagnostico;
    }

    /**
     * @return mixed
     */
    public function getDias()
    {
        return $this->dias;
    }
    

}