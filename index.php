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
    // preguntar si presiono el boton registrar
    if(isset($_POST['btnadd'])){
        $id = $_POST['txtid'];
        $pac = $_POST['txtpac'];
        $diag = $_POST['txtdiag'];
        $dias = $_POST['txtdias'];
        $p = new Paciente($id,$pac,$diag,$dias);
        $a->Register_Patient($p);
    }
    ?>
        <form name="form1" id="form1" method="post" action="index.php">
            <h2>Registro de Pacientes</h2>
            <label>ID:</label>
            <input type="number" name="txtid" id="txtid" required="required">
            <button type="button" name="btncon" id="btncon">Consultar</button>
            <br>
            <label>Paciente:</label>
            <input type="text" name="txtpac" id="txtpac" required="required">
            <br>
            <label>Diagnostico:</label>
            <input type="text" name="txtdiag" id="txtdiag" required="required">
            <br>
            <label>Dias:</label>
            <input type="number" name="txtdias" id="txtdias" required="required">
            <br>
            <button type="submit" name="btnadd" id="btnadd">Agregar</button>
            <br>
            <table width="1000" border="1">
                <caption>Listado de Personas</caption>
                <tr>
                    <th>Id</th>
                    <th>Paciente</th>
                    <th>Diagnostico</th>
                    <th>Dias</th>
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
                    echo "</tr>";
                }
                ?>
            </table>
        </form>
    </body>
</html>
