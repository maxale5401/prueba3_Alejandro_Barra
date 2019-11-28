<!DOCTYPE html>
<html lang="es">
    <head>

        <meta charset="UTF-8">
        <title>Registro Medico</title>
    </head>
    <body>
    <?php
    require 'DAO.php';
    $a = new DAO();
    $id = '';
    $pac = '';
    $diag = '';
    $dias = '';
    $btn1 = "disabled='disabled'";
    $btn2 = "disabled='disabled'";
    $btn3 = "disabled='disabled'";
    // preguntar si presiono el boton registrar
    if(isset($_POST['btnadd'])){
        $id = $_POST['txtid'];
        $pac = $_POST['txtpac'];
        $diag = $_POST['txtdiag'];
        $dias = $_POST['txtdias'];
        $p = new Paciente($id,$pac,$diag,$dias);
        $a->Register_Patient($p);
        $id = '';
        $pac = '';
        $diag = '';
        $dias = '';
        $btn1 = "disabled='disabled'";
        $btn2 = "disabled='disabled'";
        $btn3 = "disabled='disabled'";
    }
    if (isset($_GET['ideli'])) {
        $id = $_GET['ideli'];
        $a->Delete_Patient($id);
        $id = "";
        $btn1 = "disabled='disabled'";
        $btn2 = "disabled='disabled'";
        $btn3 = "disabled='disabled'";
    }
    if (isset($_POST['btndel'])) {
        $id = $_POST['txtid'];
        $a->Delete_Patient($id);
        $id = "";
        $btn1 = "disabled='disabled'";
        $btn2 = "disabled='disabled'";
        $btn3 = "disabled='disabled'";
    }
    if (isset($_POST['btncon'])) {
        $id = $_POST['txtid'];
        $p = $a->Get_patient($id);
        if ($p) {
            $id = $p->getId();
            $pac = $p->getPaciente();
            $diag = $p->getDiagnostico();
            $dias = $p->getDias();
            echo "Patient found";
            $btn1 = "disabled='disabled'";
            $btn2 = "";
            $btn3 = "";
        } else {
            echo "no entries found";
            $btn1 = "";
            $btn2 = "disabled='disabled'";
            $btn3 = "disabled='disabled'";
        }
    }
    if(isset($_POST['btnmod'])){
        $id = $_POST['txtid'];
        $pac = $_POST['txtpac'];
        $diag = $_POST['txtdiag'];
        $dias = $_POST['txtdias'];
        $p = new Paciente($id,$pac,$diag,$dias);
        $a->Modify_Patient($p);
        $id = '';
        $pac = '';
        $diag = '';
        $dias = '';
        $btn1 = "disabled='disabled'";
        $btn2 = "disabled='disabled'";
        $btn3 = "disabled='disabled'";
    }

    ?>
        <form name="form1" id="form1" method="post" action="index.php">
            <h2>Registro de Pacientes</h2>
            <label>ID:</label>
            <input type="number" name="txtid" id="txtid" required="required" value="<?php echo $id ;?>">
            <button type="submit" name="btncon" id="btncon">Consultar</button>
            <br>
            <label>Paciente:</label>
            <input type="text" name="txtpac" id="txtpac" value="<?php echo $pac ;?>">
            <br>
            <label>Diagnostico:</label>
            <input type="text" name="txtdiag" id="txtdiag"value="<?php echo $diag ;?>">
            <br>
            <label>Dias:</label>
            <input type="number" name="txtdias" id="txtdias" value="<?php echo $dias ;?>">
            <br>
            <button type="submit" name="btnadd" id="btnadd" <?php echo $btn1 ;?>>Agregar</button>
            <button type="submit" name="btnmod" id="btnmod" <?php echo $btn2 ;?>>Modificar</button>
            <button type="submit" name="btndel" id="btndel" <?php echo $btn3 ;?>>Eliminar</button>
            <br>
            <table width="1000" border="1">
                <caption>Listado de Personas</caption>
                <tr>
                    <th>Id</th>
                    <th>Paciente</th>
                    <th>Diagnostico</th>
                    <th>Dias</th>
                    <th>Eliminar</th>
                </tr>
                <?php
                $list = $a->List_patients();
                for($i = 0; $i < count($list); $i++){
                    $p = $list[$i];
                    $id =$p->getid();
                    $pac =$p->getPaciente();
                    $diag =$p->getDiagnostico();
                    $dias =$p->getDias();
                    echo "<tr>";
                    echo "<td>$id</td>";
                    echo "<td>$pac</td>";
                    echo "<td>$diag</td>";
                    echo "<td>$dias</td>";
                    echo "<td><a href='index.php?ideli=$id'>Eliminar</a></td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </form>
    </body>
</html>
