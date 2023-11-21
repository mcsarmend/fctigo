<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDO;

class apisetiquetadosController extends Controller
{

    private $fechaActual;
    private $fechaMenosUnDia;

    public function __construct()
    {
        // Obtiene la fecha y hora actual
        $fechaActual = date("Y-m-d H:i:s");

        // Resta 6 horas a la fecha actual
        $fechaMenos6Horas = date("Y-m-d H:i:s", strtotime($fechaActual . " -6 hours"));

        // Resta 1 día y 6 horas a la fecha actual
        $fechaMenosUnDia6Horas = date("Y-m-d H:i:s", strtotime($fechaActual . " -1 day -6 hours"));

        $fechaMenos6HorasFormateada = substr($fechaMenos6Horas, 0, 10);
        $fechaMenosUnDia6HorasFormateada = substr($fechaMenosUnDia6Horas, 0, 10);

        // Calcular la fecha y hora actual
        $this->fechaActual = $fechaMenos6HorasFormateada;

        // Calcular la fecha actual menos 1 día y 6 horas
        $this->fechaMenosUnDia = $fechaMenosUnDia6HorasFormateada;
    }

    public function BajaPromecapMambu()
    {
        return "BAJA PROMECAP MAMBU";
    }
    public function AltaPromecapJV(Request $request)
    {

        $host = 'jucavi.trafficmanager.net';
        $database = 'JUCAVI_Grupal';
        $username = 'app_grupal';
        $password = 'fc@4pp.gr0up4@1x4y4';

        try {
            $pdo = new PDO("sqlsrv:Server=$host;Database=$database", $username, $password);

            $sqlStatementJucavi = "SELECT TOP 1 * FROM Cartera.CreditoClienteFondeo WHERE IdCredito = 300989";

            $statement = $pdo->query($sqlStatementJucavi);

            $results = $statement->fetch(PDO::FETCH_ASSOC);

            if (!$results) {
                $results = "No se encontraron resultados.";
            }
        } catch (PDOException $e) {
            $results = "Error: " . $e->getMessage();
        }

        return $results;

        $datFechaCorte = $this->fechaMenosUnDia;
        $intDiasMora = 0;
        $strUser = 770;

        $resp = $this->listaAltasPromecapJV($datFechaCorte, $intDiasMora, $strUser);
        return $response->strResult;
        // if ($resp.strResult == "OK")
        // {
        //     strJucavi = await etiquetaBursa.getEtiquetado(Convert.ToDateTime(strFechaCierre), 10, 1);
        //     if (strJucavi == "OK")
        //     {
        //         strSP = await etiquetaBursa.Proceso(strUser);
        //         return new string[] { strSP };//+ response.strJson.Rows.Count.ToString() + " créditos." };
        //     }
        //     else
        //         return new string[] { strJucavi };
        // }

    }
    public function listaAltasPromecapJV($datFechaCorte, $intDiasMora, $strUser)
    {
        try {
            $curl = curl_init();
            $hostODS = 'fcods.trafficmanager.net';
            $dbNameODS = 'clientes_ods';
            $userODS = 'hmonroy';
            $passwordODS = 'Monroy2011@';
            $portODS = 3306;
            // Conexión a la base de datos
            $pdoODS = new PDO("mysql:host=$hostODS;port=$portODS;dbname=$dbNameODS", $userODS, $passwordODS);

            $sqlStatementJucavi = "CALL SP_ListaAltaPromecapNuevo($datFechaCorte, $intDiasMora)";

            $statementJucavi = $pdoODS->query($sqlStatementJucavi);
            $results = $statementJucavi->fetchAll(PDO::FETCH_ASSOC);
            if (!empty($results)) {
                $response->strResult = 'OK';
                $response->strJson = $results; // Assuming your SP returns a result set
            } else {
                $response->strResult = 'No existen créditos por etiquetar.';
            }
        } catch (\Exception $exc) {
            $response->strResult = 'ERROR: ' . $exc->getMessage();
            // Log the error here if needed
        }

        return response()->json($response);
    }

    public function getEtiquetado($fondeador, $fondeadoranterior)
    {
        try {
            $hostODS = 'fcods.trafficmanager.net';
            $dbNameODS = 'clientes_ods';
            $userODS = 'hmonroy';
            $passwordODS = 'Monroy2011@';
            $portODS = 3306;
            // Conexión a la base de datos
            $pdoODS = new PDO("mysql:host=$hostODS;port=$portODS;dbname=$dbNameODS", $userODS, $passwordODS);
            $datFechaCorte = $this->fechaMenosUnDia;
            $sqlStatementJucavi = "CALL SP_GetEtiquetar($datFechaCorte,$fondeador,$fondeadoranterior)";

            $statementJucavi = $pdoODS->query($sqlStatementJucavi);
            $results = $statementJucavi->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $th) {
            //throw $th;
        }

        try {
            $host = 'jucavi.trafficmanager.net';
            $database = 'JUCAVI_Grupal';
            $username = 'app_grupal';
            $password = 'fc@4pp.gr0up4@1x4y4';

            try {
                $pdo = new PDO("sqlsrv:Server=$host;Database=$database", $username, $password);

                $sqlStatementJucavi = "EXEC Core.CreditosXEtiquetarBursa"; // Usar EXEC para llamar a un procedimiento almacenado

                $statement = $pdo->prepare($sqlStatementJucavi);
                $results = $statement->fetchAll(PDO::FETCH_ASSOC);

            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        } catch (\Throwable $th) {

        }

    }
}
