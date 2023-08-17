<?php

namespace App\Http\Controllers;

use PDO;
use PDOException;
use App\Models\User;
class dashboardController extends Controller
{

    public function testsoh()
    {
        return ["Hola"];
    }
    public function testsohrep()
    {


        $hostODS = 'fcods.trafficmanager.net';
        $dbNameODS = 'clientes_ods';
        $userODS = 'hmonroy';
        $passwordODS = 'Monroy2011@';
        $portODS = 3306;

        try {

            // Conexión a la base de datos
            $pdo = new PDO("mysql:host=$hostODS;port=$portODS;dbname=$dbNameODS", $userODS, $passwordODS);

            // Preparar la consulta SQL
            // $query = "SELECT NombreFondeador, SUM(CantidadNombreFondeador) as SumaCantidadNombreFondeador FROM ( SELECT COUNT(DISTINCT fo_nombre) as CantidadNombreFondeador, GROUP_CONCAT(DISTINCT fo_nombre) as NombreFondeador FROM clientes_ods.d_saldos_hist sh LEFT JOIN clientes_ods.d_saldos s ON ( Sh_numclientesicap = s.ib_numclientesicap AND Sh_numsolicitudsicap = s.ib_numsolicitudsicap AND sh.origsistema = s.origsistema ) LEFT JOIN clientes_ods.d_ciclos_grupales cg ON ( s.ib_numclientesicap = cg.ci_numgrupo AND s.ib_numsolicitudsicap = cg.ci_numciclo AND s.origsistema = cg.origsistema AND ci_origenmigracion = 0 ) LEFT JOIN clientes_ods.c_fondeadores ON ( fo_numfondeador = sh_fondeo_garantia ) LEFT JOIN clientes_ods.c_sucursales ON (sh_numsucursal = su_numsucursal) LEFT JOIN clientes_ods.c_estados ON (su_estado = es_numestado) LEFT JOIN clientes_ods.c_operaciones ON (op_numoperacion = Sh_producto) WHERE sh_fecha_historico = DATE_FORMAT( DATE_SUB( CURDATE(), INTERVAL 1 DAY ), '%Y-%m-%d' ) AND sh_fecha_desembolso <= DATE_FORMAT( DATE_SUB( CURDATE(), INTERVAL 1 DAY ), '%Y-%m-%d' ) AND Sh_fondeador IN (1, 10, 16, 17) AND sh_estatus IN (1, 2, 3, 4, 5, 6) GROUP BY Sh_credito, Sh_numclientesicap, Sh_numsolicitudsicap ) AS subquery GROUP BY NombreFondeador;";
            $query = "SELECT NombreFondeador as nombrefondeador, COUNT(*) as cantidadregistros, SUM(Sh_monto_seguro + Sh_monto_credito) as monto from ( SELECT ( select fo_nombre from clientes_ods.c_fondeadores where sh_fondeador = fo_numfondeador ) as NombreFondeador, Sh_monto_seguro, Sh_monto_credito FROM clientes_ods.d_saldos_hist sh LEFT JOIN clientes_ods.d_saldos s ON ( Sh_numclientesicap = s.ib_numclientesicap AND Sh_numsolicitudsicap = s.ib_numsolicitudsicap AND sh.origsistema = s.origsistema ) LEFT JOIN clientes_ods.d_ciclos_grupales cg ON ( s.ib_numclientesicap = cg.ci_numgrupo AND s.ib_numsolicitudsicap = cg.ci_numciclo AND s.origsistema = cg.origsistema AND ci_origenmigracion = 0 ) LEFT JOIN clientes_ods.c_fondeadores ON ( fo_numfondeador = sh_fondeo_garantia ) LEFT JOIN clientes_ods.c_sucursales ON (sh_numsucursal = su_numsucursal) LEFT JOIN clientes_ods.c_estados ON (su_estado = es_numestado) LEFT JOIN clientes_ods.c_operaciones ON (op_numoperacion = Sh_producto) WHERE sh_fecha_historico = DATE_FORMAT( DATE_SUB( CURDATE(), INTERVAL 1 DAY ), '%Y-%m-%d' ) AND sh_fecha_desembolso <= DATE_FORMAT( DATE_SUB( CURDATE(), INTERVAL 1 DAY ), '%Y-%m-%d' ) AND Sh_fondeador IN (1, 10, 16, 17) AND sh_estatus IN (1, 2, 3, 4, 5, 6) GROUP BY Sh_credito, Sh_numclientesicap, Sh_numsolicitudsicap) as subquery group by NombreFondeador";
            $statement = $pdo->prepare($query);

            // Ejecutar la consulta
            $statement->execute();

            // Obtener los resultados
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);

            return $results;
        } catch (PDOException $e) {
            // Manejo de errores
            echo "Error: " . $e->getMessage();
        }

    }

    public function sohmambu(){
        $fechaActual = date("Y-m-d");

        try {
            $host = 'fcontigo-rs-cluster-01.cdxtyqbdsp7d.us-east-1.redshift.amazonaws.com';
            $port = '5439';
            $database = 'mambu_prod';
            $user = 'marcadodev';
            $password = 'marcadoDev00';
            $dsn = "pgsql:host=$host;port=$port;dbname=$database";
            $pdo = new PDO($dsn, $user, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            // Ejemplo de consulta
            $formattedFechaMov = date("Y-m-d", strtotime($fechaActual . "-1 day"));
            $query = "SELECT fondeador as nombrefondeador, COUNT(*) as cantidadregistros, SUM(capitalotorgado) as monto FROM mambu_prod.soh_mambu WHERE fechacorte = (SELECT MAX(fechadesembolso) FROM mambu_prod.soh_mambu) GROUP BY fondeador;";

            $statement = $pdo->query($query);
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
            return response()->json(['success' => "Consulta realizada correctamente"], 200);

        } catch (\Throwable $th) {
            return $th;

            return response()->json(['error' => $th], 400);

        }

    }

    public function recuperarcontrasena()
    {
        $usuarios = User::select('id', 'name')->get();
        return view('recuperarcontrasena', ['usuarios' => $usuarios]);

    }
}
