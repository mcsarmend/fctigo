<?php

namespace App\Http\Controllers;

use App\Models\historicoaforo;
use App\Models\User;
use PDO;
use PDOException;

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
            $query = "SELECT NombreFondeador as nombrefondeador, COUNT(*) as cantidadregistros, SUM( Sh_monto_seguro + sh_saldo_capital ) as monto from ( SELECT ( select fo_nombre from clientes_ods.c_fondeadores where sh_fondeador = fo_numfondeador ) as NombreFondeador, Sh_monto_seguro, sh_saldo_capital FROM clientes_ods.d_saldos_hist sh LEFT JOIN clientes_ods.d_saldos s ON ( Sh_numclientesicap = s.ib_numclientesicap AND Sh_numsolicitudsicap = s.ib_numsolicitudsicap AND sh.origsistema = s.origsistema ) LEFT JOIN clientes_ods.d_ciclos_grupales cg ON ( s.ib_numclientesicap = cg.ci_numgrupo AND s.ib_numsolicitudsicap = cg.ci_numciclo AND s.origsistema = cg.origsistema AND ci_origenmigracion = 0 ) LEFT JOIN clientes_ods.c_fondeadores ON ( fo_numfondeador = sh_fondeo_garantia ) LEFT JOIN clientes_ods.c_sucursales ON (sh_numsucursal = su_numsucursal) LEFT JOIN clientes_ods.c_estados ON (su_estado = es_numestado) LEFT JOIN clientes_ods.c_operaciones ON (op_numoperacion = Sh_producto) WHERE sh_fecha_historico = DATE_FORMAT( DATE_SUB( CURDATE(), INTERVAL 1 DAY ), '%Y-%m-%d' ) AND sh_fecha_desembolso <= DATE_FORMAT( DATE_SUB( CURDATE(), INTERVAL 1 DAY ), '%Y-%m-%d' ) AND Sh_fondeador IN (1, 10, 16, 17) AND sh_estatus IN (1, 2, 3, 4, 5, 6) GROUP BY Sh_credito, Sh_numclientesicap, Sh_numsolicitudsicap ) as subquery group by NombreFondeador";
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

    public function sohmambu()
    {
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
            $query = "SELECT fondeador as nombrefondeador, COUNT(*) as cantidadregistros, SUM(saldocapital) as monto FROM mambu_prod.soh_mambu WHERE fechacorte = ( SELECT MAX(fechadesembolso) FROM mambu_prod.soh_mambu ) GROUP BY fondeador;";

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

    public function calculofondeadorpromecap()
    {

        try {

            $ultimoRegistro = historicoaforo::latest('fecha')->first();
            $fechaHoy = date("Y-m-d");
            $fechaSinHora = substr($ultimoRegistro->fecha, 0, 10);

            if ($fechaSinHora == $fechaHoy) {
                return $ultimoRegistro->aforo;
            } else {

                // CONEXION JUCAVI
                $hostODS = 'fcods.trafficmanager.net';
                $dbNameODS = 'clientes_ods';
                $userODS = 'hmonroy';
                $passwordODS = 'Monroy2011@';
                $portODS = 3306;
                $pdoODS = new PDO("mysql:host=$hostODS;port=$portODS;dbname=$dbNameODS", $userODS, $passwordODS);

                $queryODS = "SELECT case WHEN sh_nombresucursal = 'Acambaro' THEN 'Acambaro Multiproducto' WHEN sh_nombresucursal = 'Acapulco' THEN 'Acapulco Multiproducto' WHEN sh_nombresucursal = 'Acapulco Centro' THEN 'Acapulco Centro Multiproducto' WHEN sh_nombresucursal = 'Acapulco Renacimieto' THEN 'Acapulco Renacimiento Multiproducto' WHEN sh_nombresucursal = 'Aguascalientes' THEN 'Aguascalientes Multiproducto' WHEN sh_nombresucursal = 'Apatzingan' THEN 'Apatzingan Multiproducto' WHEN sh_nombresucursal = 'Apatzingan Madero' THEN 'Apatzingan Madero Multiproducto' WHEN sh_nombresucursal = 'Apizaco' THEN 'Apizaco Multiproducto' WHEN sh_nombresucursal = 'Atlacomulco' THEN 'Atlacomulco Multiproducto' WHEN sh_nombresucursal = 'Autlan' THEN 'Autlan Multiproducto' WHEN sh_nombresucursal = 'Boca del Rio' THEN 'Boca del Rio Multiproducto' WHEN sh_nombresucursal = 'Bucerias' THEN 'Bucerias Multiproducto' WHEN sh_nombresucursal = 'Celaya Centro' THEN 'Celaya Centro Multiproducto' WHEN sh_nombresucursal = 'Chilapa' THEN 'Chilapa Multiproducto' WHEN sh_nombresucursal = 'Chilpancingo Norte' THEN 'Chilpancingo Norte Multiproducto' WHEN sh_nombresucursal = 'Coatzacoalcos' THEN 'Coatzacoalcos Multiproducto' WHEN sh_nombresucursal = 'Colima' THEN 'Colima Multiproducto' WHEN sh_nombresucursal = 'Comitan' THEN 'Comitan Multiproducto' WHEN sh_nombresucursal = 'Cosamaloapan' THEN 'Cosamaloapan Multiproducto' WHEN sh_nombresucursal = 'Culiacan' THEN 'Culiacan Multiproducto' WHEN sh_nombresucursal = 'Dolores Hidalgo' THEN 'Dolores Hidalgo Multiproducto' WHEN sh_nombresucursal = 'Durango' THEN 'Durango Multiproducto' WHEN sh_nombresucursal = 'Guadalajara Centro' THEN 'Guadalajara Centro Multiproducto' WHEN sh_nombresucursal = 'Guadalupe' THEN 'Guadalupe Multiproducto' WHEN sh_nombresucursal = 'Guanajuato' THEN 'Guanajuato Multiproducto' WHEN sh_nombresucursal = 'Hermosillo' THEN 'Hermosillo Multiproducto' WHEN sh_nombresucursal = 'Heroica Cardenas' THEN 'Heroica Cardenas Multiproducto' WHEN sh_nombresucursal = 'Huajuapan de Leon' THEN 'Huajuapan de Leon Multiproducto' WHEN sh_nombresucursal = 'Iguala' THEN 'Iguala Multiproducto' WHEN sh_nombresucursal = 'Ixtlahuaca' THEN 'Ixtlahuaca Multiproducto' WHEN sh_nombresucursal = 'Lagos de Moreno' THEN 'Lagos de Moreno Multiproducto' WHEN sh_nombresucursal = 'Lazaro Cardenas' THEN 'Lazaro Cardenas Multiproducto' WHEN sh_nombresucursal = 'Leon Centro' THEN 'Leon centro Multiproducto' WHEN sh_nombresucursal = 'Lerdo' THEN 'Lerdo Multiproducto' WHEN sh_nombresucursal = 'Los Reyes' THEN 'Los Reyes Multiproducto' WHEN sh_nombresucursal = 'Manzanillo' THEN 'Manzanillo Multiproducto' WHEN sh_nombresucursal = 'Martinez de la Torre' THEN 'Martinez de la Torre Multiproducto' WHEN sh_nombresucursal = 'Matehuala' THEN 'Matehuala Multiproducto' WHEN sh_nombresucursal = 'Mazatlan' THEN 'Mazatlan Multiproducto' WHEN sh_nombresucursal = 'Monterrey' THEN 'Monterrey Multiproducto' WHEN sh_nombresucursal = 'Monterrey Centro' THEN 'Monterrey Centro Multiproducto' WHEN sh_nombresucursal = 'Morelia Camelinas' THEN 'Morelia Camelinas Multiproducto' WHEN sh_nombresucursal = 'Morelia Madero' THEN 'Morelia Madero Multiproducto' WHEN sh_nombresucursal = 'Navojoa' THEN 'Navojoa Multiproducto' WHEN sh_nombresucursal = 'Oaxaca' THEN 'Oaxaca Multiproducto' WHEN sh_nombresucursal = 'Ocotlan de Morelos' THEN 'Ocotlan de Morelos Multiproducto' WHEN sh_nombresucursal = 'Orizaba' THEN 'Orizaba Multiproducto' WHEN sh_nombresucursal = 'Papantla' THEN 'Papantla Multiproducto' WHEN sh_nombresucursal = 'Patzcuaro' THEN 'Patzcuaro Multiproducto' WHEN sh_nombresucursal = 'Puebla' THEN 'Puebla Multiproducto' WHEN sh_nombresucursal = 'Queretaro' THEN 'Queretaro Multiproducto' WHEN sh_nombresucursal = 'Rio Verde' THEN 'Rio Verde Multiproducto' WHEN sh_nombresucursal = 'Sahuayo' THEN 'Sahuayo Multiproducto' WHEN sh_nombresucursal = 'Salamanca' THEN 'Salamanca Multiproducto' WHEN sh_nombresucursal = 'Saltillo' THEN 'Saltillo Multiproducto' WHEN sh_nombresucursal = 'San Andres' THEN 'San Andres Multiproducto' WHEN sh_nombresucursal = 'San Juan del Rio' THEN 'San Juan Del Rio Multiproducto' WHEN sh_nombresucursal = 'San Luis' THEN 'San Luis Multiproducto' WHEN sh_nombresucursal = 'San Luis Centro' THEN 'San Luis Centro Multiproducto' WHEN sh_nombresucursal = 'San Luis Zona Industrial' THEN 'San Luis Zona Industrial Multiproducto' WHEN sh_nombresucursal = 'Santa Catarina' THEN 'Santa Catarina Multiproducto' WHEN sh_nombresucursal = 'Tacambaro' THEN 'Tacambaro Multiproducto' WHEN sh_nombresucursal = 'Tala' THEN 'Tala Multiproducto' WHEN sh_nombresucursal = 'Tapachula' THEN 'Tapachula Multiproducto' WHEN sh_nombresucursal = 'Tecpan de Galeana' THEN 'Tecpan de Galeana Multiproducto' WHEN sh_nombresucursal = 'Tepic' THEN 'Tepic Multiproducto' WHEN sh_nombresucursal = 'Tlajomulco' THEN 'Tlajomulco Multiproducto' WHEN sh_nombresucursal = 'Tlaxiaco' THEN 'Tlaxiaco Multiproducto' WHEN sh_nombresucursal = 'Tonala Centro' THEN 'Tonala Centro Multiproducto' WHEN sh_nombresucursal = 'Tonala Chiapas' THEN 'Tonala Chiapas Multiproducto' WHEN sh_nombresucursal = 'Torreon' THEN 'Torreon Multiproducto' WHEN sh_nombresucursal = 'Tuxtepec' THEN 'Tuxtepec Multiproducto' WHEN sh_nombresucursal = 'Tuxtla' THEN 'Tuxtla Multiproducto' WHEN sh_nombresucursal = 'Uruapan Centro' THEN 'Uruapan Centro Multiproducto' WHEN sh_nombresucursal = 'Veracruz' THEN 'Veracruz Multiproducto' WHEN sh_nombresucursal = 'Villa Flores' THEN 'Villaflores Multiproducto' WHEN sh_nombresucursal = 'Villa Victoria' THEN 'Villa Victoria Multiproducto' WHEN sh_nombresucursal = 'Villahermosa Olmeca' THEN 'Villahermosa Olmeca Multiproducto' WHEN sh_nombresucursal = 'Zacapu' THEN 'Zacapu Multiproducto' WHEN sh_nombresucursal = 'Zamora' THEN 'Zamora Multiproducto' WHEN sh_nombresucursal = 'Zihuatanejo' THEN 'Zihuatanejo Multiproducto' WHEN sh_nombresucursal = 'Zitacuaro' THEN 'Zitacuaro Multiproducto' else '' end as sucursal, CASE WHEN sh_nombresucursal = 'Acambaro' THEN 'Guanajuato' WHEN sh_nombresucursal = 'Acapulco' THEN 'Guerrero' WHEN sh_nombresucursal = 'Acapulco Centro' THEN 'Guerrero' WHEN sh_nombresucursal = 'Acapulco Renacimieto' THEN 'Guerrero' WHEN sh_nombresucursal = 'Aguascalientes' THEN 'Aguascalientes' WHEN sh_nombresucursal = 'Apatzingan' THEN 'Michoacán de Ocampo' WHEN sh_nombresucursal = 'Apatzingan Madero' THEN 'Michoacán de Ocampo' WHEN sh_nombresucursal = 'Apizaco' THEN 'Tlaxcala' WHEN sh_nombresucursal = 'Atlacomulco' THEN 'Estado de México' WHEN sh_nombresucursal = 'Autlan' THEN 'Jalisco' WHEN sh_nombresucursal = 'Boca del Rio' THEN 'Veracruz de Ignacio de la Llave' WHEN sh_nombresucursal = 'Bucerias' THEN 'Nayarit' WHEN sh_nombresucursal = 'Celaya Centro' THEN 'Guanajuato' WHEN sh_nombresucursal = 'Chilapa' THEN 'Guerrero' WHEN sh_nombresucursal = 'Chilpancingo Norte' THEN 'Guerrero' WHEN sh_nombresucursal = 'Coatzacoalcos' THEN 'Veracruz de Ignacio de la Llave' WHEN sh_nombresucursal = 'Colima' THEN 'Colima' WHEN sh_nombresucursal = 'Comitan' THEN 'Chiapas' WHEN sh_nombresucursal = 'Cosamaloapan' THEN 'Veracruz de Ignacio de la Llave' WHEN sh_nombresucursal = 'Culiacan' THEN 'Sinaloa' WHEN sh_nombresucursal = 'Dolores Hidalgo' THEN 'Guanajuato' WHEN sh_nombresucursal = 'Durango' THEN 'Durango' WHEN sh_nombresucursal = 'Guadalajara Centro' THEN 'Jalisco' WHEN sh_nombresucursal = 'Guadalupe' THEN 'Nuevo León' WHEN sh_nombresucursal = 'Guanajuato' THEN 'Guanajuato' WHEN sh_nombresucursal = 'Hermosillo' THEN 'Sonora' WHEN sh_nombresucursal = 'Heroica Cardenas' THEN 'Tabasco' WHEN sh_nombresucursal = 'Huajuapan de Leon' THEN 'Oaxaca' WHEN sh_nombresucursal = 'Iguala' THEN 'Guerrero' WHEN sh_nombresucursal = 'Ixtlahuaca' THEN 'Estado de México' WHEN sh_nombresucursal = 'Lagos de Moreno' THEN 'Jalisco' WHEN sh_nombresucursal = 'Lazaro Cardenas' THEN 'Michoacán de Ocampo' WHEN sh_nombresucursal = 'Leon Centro' THEN 'Guanajuato' WHEN sh_nombresucursal = 'Lerdo' THEN 'Durango' WHEN sh_nombresucursal = 'Los Reyes' THEN 'Michoacán de Ocampo' WHEN sh_nombresucursal = 'Manzanillo' THEN 'Colima' WHEN sh_nombresucursal = 'Martinez de la Torre' THEN 'Veracruz de Ignacio de la Llave' WHEN sh_nombresucursal = 'Matehuala' THEN 'San Luis Potosi' WHEN sh_nombresucursal = 'Mazatlan' THEN 'Sinaloa' WHEN sh_nombresucursal = 'Monterrey' THEN 'Nuevo León' WHEN sh_nombresucursal = 'Monterrey Centro' THEN 'Nuevo León' WHEN sh_nombresucursal = 'Morelia Camelinas' THEN 'Michoacán de Ocampo' WHEN sh_nombresucursal = 'Morelia Madero' THEN 'Michoacán de Ocampo' WHEN sh_nombresucursal = 'Navojoa' THEN 'Sinaloa' WHEN sh_nombresucursal = 'Oaxaca' THEN 'Oaxaca' WHEN sh_nombresucursal = 'Ocotlan de Morelos' THEN 'Oaxaca' WHEN sh_nombresucursal = 'Orizaba' THEN 'Veracruz de Ignacio de la Llave' WHEN sh_nombresucursal = 'Papantla' THEN 'Veracruz de Ignacio de la Llave' WHEN sh_nombresucursal = 'Patzcuaro' THEN 'Michoacán de Ocampo' WHEN sh_nombresucursal = 'Puebla' THEN 'Puebla' WHEN sh_nombresucursal = 'Queretaro' THEN 'Querétaro' WHEN sh_nombresucursal = 'Rio Verde' THEN 'San Luis Potosi' WHEN sh_nombresucursal = 'Sahuayo' THEN 'Michoacán de Ocampo' WHEN sh_nombresucursal = 'Salamanca' THEN 'Guanajuato' WHEN sh_nombresucursal = 'Saltillo' THEN 'Coahuila de Zaragoza' WHEN sh_nombresucursal = 'San Andres' THEN 'Veracruz de Ignacio de la Llave' WHEN sh_nombresucursal = 'San Juan del Rio' THEN 'Querétaro' WHEN sh_nombresucursal = 'San Luis' THEN 'San Luis Potosi' WHEN sh_nombresucursal = 'San Luis Centro' THEN 'San Luis Potosi' WHEN sh_nombresucursal = 'San Luis Zona Industrial' THEN 'San Luis Potosi' WHEN sh_nombresucursal = 'Santa Catarina' THEN 'Nuevo León' WHEN sh_nombresucursal = 'Tacambaro' THEN 'Michoacán de Ocampo' WHEN sh_nombresucursal = 'Tala' THEN 'Jalisco' WHEN sh_nombresucursal = 'Tapachula' THEN 'Chiapas' WHEN sh_nombresucursal = 'Tecpan de Galeana' THEN 'Guerrero' WHEN sh_nombresucursal = 'Tepic' THEN 'Nayarit' WHEN sh_nombresucursal = 'Tlajomulco' THEN 'Jalisco' WHEN sh_nombresucursal = 'Tlaxiaco' THEN 'Oaxaca' WHEN sh_nombresucursal = 'Tonala Centro' THEN 'Jalisco' WHEN sh_nombresucursal = 'Tonala Chiapas' THEN 'Chiapas' WHEN sh_nombresucursal = 'Torreon' THEN 'Coahuila de Zaragoza' WHEN sh_nombresucursal = 'Tuxtepec' THEN 'Oaxaca' WHEN sh_nombresucursal = 'Tuxtla' THEN 'Chiapas' WHEN sh_nombresucursal = 'Uruapan Centro' THEN 'Michoacán de Ocampo' WHEN sh_nombresucursal = 'Veracruz' THEN 'Veracruz de Ignacio de la Llave' WHEN sh_nombresucursal = 'Villa Flores' THEN 'Chiapas' WHEN sh_nombresucursal = 'Villa Victoria' THEN 'Estado de México' WHEN sh_nombresucursal = 'Villahermosa Olmeca' THEN 'Tabasco' WHEN sh_nombresucursal = 'Zacapu' THEN 'Michoacán de Ocampo' WHEN sh_nombresucursal = 'Zamora' THEN 'Michoacán de Ocampo' WHEN sh_nombresucursal = 'Zihuatanejo' THEN 'Guerrero' WHEN sh_nombresucursal = 'Zitacuaro' THEN 'Michoacán de Ocampo' WHEN sh_nombresucursal = 'CD Altamirano' THEN 'Guerrero' ELSE '' END AS estado, SUM( CASE WHEN sh_saldo_capital > 900000 THEN 900000 WHEN Sh_num_dias_mora > 21 THEN 0 ELSE sh_saldo_capital END + Sh_monto_seguro ) AS suma_capital_modificado FROM clientes_ods.d_saldos_hist sh LEFT JOIN clientes_ods.d_saldos s ON ( Sh_numclientesicap = s.ib_numclientesicap AND Sh_numsolicitudsicap = s.ib_numsolicitudsicap AND sh.origsistema = s.origsistema ) LEFT JOIN clientes_ods.d_ciclos_grupales cg ON ( s.ib_numclientesicap = cg.ci_numgrupo AND s.ib_numsolicitudsicap = cg.ci_numciclo AND s.origsistema = cg.origsistema AND ci_origenmigracion = 0 ) LEFT JOIN clientes_ods.c_fondeadores ON ( fo_numfondeador = sh_fondeo_garantia ) LEFT JOIN clientes_ods.c_sucursales ON (sh_numsucursal = su_numsucursal) LEFT JOIN clientes_ods.c_estados ON (su_estado = es_numestado) LEFT JOIN clientes_ods.c_operaciones ON (op_numoperacion = Sh_producto) WHERE fo_nombre = 'Promecap' AND sh_fecha_historico = DATE_FORMAT( DATE_SUB( CURDATE(), INTERVAL 1 DAY ), '%Y-%m-%d' ) AND sh_fecha_desembolso <= DATE_FORMAT( DATE_SUB( CURDATE(), INTERVAL 1 DAY ), '%Y-%m-%d' ) AND Sh_fondeador IN (1, 10, 16, 17) AND sh_estatus IN (1, 2, 3, 4, 5, 6) GROUP BY sh_nombresucursal, estado order by sucursal;;";
                $statementODS = $pdoODS->prepare($queryODS);
                $statementODS->execute();
                $tablajucavi = $statementODS->fetchAll(PDO::FETCH_ASSOC);

                // CONEXION MAMBU
                $host = 'fcontigo-rs-cluster-01.cdxtyqbdsp7d.us-east-1.redshift.amazonaws.com';
                $port = '5439';
                $database = 'mambu_prod';
                $user = 'marcadodev';
                $password = 'marcadoDev00';
                $dsn = "pgsql:host=$host;port=$port;dbname=$database";
                $pdo = new PDO($dsn, $user, $password);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $query = "SELECT sucursal as sucursal, case WHEN sucursal = 'Acambaro Multiproducto' THEN 'Guanajuato' WHEN sucursal = 'Acapulco Multiproducto' THEN 'Guerrero' WHEN sucursal = 'Acapulco Centro Multiproducto' THEN 'Guerrero' WHEN sucursal = 'Acapulco Renacimiento Multiproducto' THEN 'Guerrero' WHEN sucursal = 'Aguascalientes Multiproducto' THEN 'Aguascalientes' WHEN sucursal = 'Apatzingan Multiproducto' THEN 'Michoacán de Ocampo' WHEN sucursal = 'Apatzingan Madero Multiproducto' THEN 'Michoacán de Ocampo' WHEN sucursal = 'Apizaco Multiproducto' THEN 'Tlaxcala' WHEN sucursal = 'Atlacomulco Multiproducto' THEN 'Estado de México' WHEN sucursal = 'Autlan Multiproducto' THEN 'Jalisco' WHEN sucursal = 'Boca del Rio Multiproducto' THEN 'Veracruz de Ignacio de la Llave' WHEN sucursal = 'Bucerias Multiproducto' THEN 'Nayarit' WHEN sucursal = 'Celaya Centro Multiproducto' THEN 'Guanajuato' WHEN sucursal = 'Chilapa Multiproducto' THEN 'Guerrero' WHEN sucursal = 'Chilpancingo Norte Multiproducto' THEN 'Guerrero' WHEN sucursal = 'Coatzacoalcos Multiproducto' THEN 'Veracruz de Ignacio de la Llave' WHEN sucursal = 'Colima Multiproducto' THEN 'Colima' WHEN sucursal = 'Comitan Multiproducto' THEN 'Chiapas' WHEN sucursal = 'Cosamaloapan Multiproducto' THEN 'Veracruz de Ignacio de la Llave' WHEN sucursal = 'Culiacan Multiproducto' THEN 'Sinaloa' WHEN sucursal = 'Dolores Hidalgo Multiproducto' THEN 'Guanajuato' WHEN sucursal = 'Durango Multiproducto' THEN 'Durango' WHEN sucursal = 'Guadalajara Centro Multiproducto' THEN 'Jalisco' WHEN sucursal = 'Guadalupe Multiproducto' THEN 'Nuevo León' WHEN sucursal = 'Guanajuato Multiproducto' THEN 'Guanajuato' WHEN sucursal = 'Hermosillo Multiproducto' THEN 'Sonora' WHEN sucursal = 'Heroica Cardenas Multiproducto' THEN 'Tabasco' WHEN sucursal = 'Huajuapan de Leon Multiproducto' THEN 'Oaxaca' WHEN sucursal = 'Iguala Multiproducto' THEN 'Guerrero' WHEN sucursal = 'Ixtlahuaca Multiproducto' THEN 'Estado de México' WHEN sucursal = 'Lagos de Moreno Multiproducto' THEN 'Jalisco' WHEN sucursal = 'Lazaro Cardenas Multiproducto' THEN 'Michoacán de Ocampo' WHEN sucursal = 'Leon centro Multiproducto' THEN 'Guanajuato' WHEN sucursal = 'Lerdo Multiproducto' THEN 'Durango' WHEN sucursal = 'Los Reyes Multiproducto' THEN 'Michoacán de Ocampo' WHEN sucursal = 'Manzanillo Multiproducto' THEN 'Colima' WHEN sucursal = 'Martinez de la Torre Multiproducto' THEN 'Veracruz de Ignacio de la Llave' WHEN sucursal = 'Matehuala Multiproducto' THEN 'San Luis Potosi' WHEN sucursal = 'Mazatlan Multiproducto' THEN 'Sinaloa' WHEN sucursal = 'Monterrey Multiproducto' THEN 'Nuevo León' WHEN sucursal = 'Monterrey Centro Multiproducto' THEN 'Nuevo León' WHEN sucursal = 'Morelia Camelinas Multiproducto' THEN 'Michoacán de Ocampo' WHEN sucursal = 'Morelia Madero Multiproducto' THEN 'Michoacán de Ocampo' WHEN sucursal = 'Navojoa Multiproducto' THEN 'Sinaloa' WHEN sucursal = 'Oaxaca Multiproducto' THEN 'Oaxaca' WHEN sucursal = 'Ocotlan de Morelos Multiproducto' THEN 'Oaxaca' WHEN sucursal = 'Orizaba Multiproducto' THEN 'Veracruz de Ignacio de la Llave' WHEN sucursal = 'Papantla Multiproducto' THEN 'Veracruz de Ignacio de la Llave' WHEN sucursal = 'Patzcuaro Multiproducto' THEN 'Michoacán de Ocampo' WHEN sucursal = 'Puebla Multiproducto' THEN 'Puebla' WHEN sucursal = 'Queretaro Multiproducto' THEN 'Querétaro' WHEN sucursal = 'Rio Verde Multiproducto' THEN 'San Luis Potosi' WHEN sucursal = 'Sahuayo Multiproducto' THEN 'Michoacán de Ocampo' WHEN sucursal = 'Salamanca Multiproducto' THEN 'Guanajuato' WHEN sucursal = 'Saltillo Multiproducto' THEN 'Coahuila de Zaragoza' WHEN sucursal = 'San Andres Multiproducto' THEN 'Veracruz de Ignacio de la Llave' WHEN sucursal = 'San Juan Del Rio Multiproducto' THEN 'Querétaro' WHEN sucursal = 'San Luis Multiproducto' THEN 'San Luis Potosi' WHEN sucursal = 'San Luis Centro Multiproducto' THEN 'San Luis Potosi' WHEN sucursal = 'San Luis Zona Industrial Multiproducto' THEN 'San Luis Potosi' WHEN sucursal = 'Santa Catarina Multiproducto' THEN 'Nuevo León' WHEN sucursal = 'Tacambaro Multiproducto' THEN 'Michoacán de Ocampo' WHEN sucursal = 'Tala Multiproducto' THEN 'Jalisco' WHEN sucursal = 'Tapachula Multiproducto' THEN 'Chiapas' WHEN sucursal = 'Tecpan de Galeana Multiproducto' THEN 'Guerrero' WHEN sucursal = 'Tepic Multiproducto' THEN 'Nayarit' WHEN sucursal = 'Tlajomulco Multiproducto' THEN 'Jalisco' WHEN sucursal = 'Tlaxiaco Multiproducto' THEN 'Oaxaca' WHEN sucursal = 'Tonala Centro Multiproducto' THEN 'Jalisco' WHEN sucursal = 'Tonala Chiapas Multiproducto' THEN 'Chiapas' WHEN sucursal = 'Torreon Multiproducto' THEN 'Coahuila de Zaragoza' WHEN sucursal = 'Tuxtepec Multiproducto' THEN 'Oaxaca' WHEN sucursal = 'Tuxtla Multiproducto' THEN 'Chiapas' WHEN sucursal = 'Uruapan Centro Multiproducto' THEN 'Michoacán de Ocampo' WHEN sucursal = 'Veracruz Multiproducto' THEN 'Veracruz de Ignacio de la Llave' WHEN sucursal = 'Villaflores Multiproducto' THEN 'Chiapas' WHEN sucursal = 'Villa Victoria Multiproducto' THEN 'Estado de México' WHEN sucursal = 'Villahermosa Olmeca Multiproducto' THEN 'Tabasco' WHEN sucursal = 'Zacapu Multiproducto' THEN 'Michoacán de Ocampo' WHEN sucursal = 'Zamora Multiproducto' THEN 'Michoacán de Ocampo' WHEN sucursal = 'Zihuatanejo Multiproducto' THEN 'Guerrero' WHEN sucursal = 'Zitacuaro Multiproducto' THEN 'Michoacán de Ocampo' WHEN sucursal = 'Xochimilco Multiproducto' THEN 'CDMX' WHEN sucursal = 'Santa Cruz Multiproducto' THEN 'CDMX' WHEN sucursal = 'Valle de Chalco Multiproducto' THEN 'Estado de México' WHEN sucursal = 'Chalco Multiproducto' THEN 'Estado de México' WHEN sucursal = 'Tulyehualco Multiproducto' THEN 'CDMX' WHEN sucursal = 'Ayotla Multiproducto' THEN 'Estado de México' WHEN sucursal = 'San Lorenzo Multiproducto' THEN 'CDMX' WHEN sucursal = 'Pantitlan Multiproducto' THEN 'CDMX' WHEN sucursal = 'Milpa Alta Multiproducto' THEN 'CDMX' WHEN sucursal = 'La Joya Multiproducto' THEN 'CDMX' WHEN sucursal = 'Iztapalapa Oriente Multiproducto' THEN 'CDMX' WHEN sucursal = 'Iztacalco Multiproducto' THEN 'CDMX' WHEN sucursal = 'Ixtapaluca Multiproducto' THEN 'Estado de México' WHEN sucursal = 'Eduardo Molina Multiproducto' THEN 'CDMX' WHEN sucursal = 'Chimalhuacan Multiproducto' THEN 'Estado de México' WHEN sucursal = 'Cafetales Multiproducto' THEN 'CDMX' WHEN sucursal = 'Ajusco Multiproducto' THEN 'CDMX' WHEN sucursal = 'Orizaba Multiproducto' THEN 'Veracruz de Ignacio de la Llave' WHEN sucursal = 'Pachuca Multiproducto' THEN 'Hidalgo' WHEN sucursal = 'Papantla Multiproducto' THEN 'Veracruz de Ignacio de la Llave' WHEN sucursal = 'Patzcuaro Multiproducto' THEN 'Michoacán de Ocampo' WHEN sucursal = 'Pijijiapan Multiproducto' THEN 'Chiapas' WHEN sucursal = 'Puebla Multiproducto' THEN 'Puebla' WHEN sucursal = 'Puerto Vallarta Multiproducto' THEN 'Jalisco' WHEN sucursal = 'Queretaro Multiproducto' THEN 'Querétaro' WHEN sucursal = 'Rio Verde Multiproducto' THEN 'San Luis Potosi' WHEN sucursal = 'Sahuayo Multiproducto' THEN 'Michoacán de Ocampo' WHEN sucursal = 'Salamanca Multiproducto' THEN 'Guanajuato' WHEN sucursal = 'Saltillo Multiproducto' THEN 'Coahuila de Zaragoza' WHEN sucursal = 'San Andres Multiproducto' THEN 'Veracruz de Ignacio de la Llave' WHEN sucursal = 'San Cristobal Multiproducto' THEN 'Chiapas' WHEN sucursal = 'San Juan Del Rio Multiproducto' THEN 'Querétaro' WHEN sucursal = 'San Luis Multiproducto' THEN 'San Luis Potosi' WHEN sucursal = 'San Luis Centro Multiproducto' THEN 'San Luis Potosi' WHEN sucursal = 'San Luis Zona Industrial Multiproducto' THEN 'San Luis Potosi' WHEN sucursal = 'San Martin Texmelucan Multiproducto' THEN 'Puebla' WHEN sucursal = 'Santa Catarina Multiproducto' THEN 'Nuevo León' WHEN sucursal = 'Santiago Ixcuintla Multiproducto' THEN 'Nayarit' WHEN sucursal = 'Silao Multiproducto' THEN 'Guanajuato' WHEN sucursal = 'Suchiate Multiproducto' THEN 'Chiapas' WHEN sucursal = 'Tacambaro Multiproducto' THEN 'Michoacán de Ocampo' WHEN sucursal = 'Conmigo Vales Hermosillo' THEN 'Sonora' WHEN sucursal = 'Cuernavaca Multiproducto' THEN 'Morelos' WHEN sucursal = 'Acambaro Multiproducto' THEN 'Guanajuato' WHEN sucursal = 'Acayucan Multiproducto' THEN 'Veracruz de Ignacio de la Llave' WHEN sucursal = 'Actopan Multiproducto' THEN 'Hidalgo' WHEN sucursal = 'Aguascalientes Multiproducto' THEN 'Aguascalientes' WHEN sucursal = 'Apatzingan Multiproducto' THEN 'Michoacán de Ocampo' WHEN sucursal = 'Apatzingan Madero Multiproducto' THEN 'Michoacán de Ocampo' WHEN sucursal = 'Atlacomulco Multiproducto' THEN 'Estado de México' WHEN sucursal = 'Tala Multiproducto' THEN 'Jalisco' WHEN sucursal = 'Tapachula Multiproducto' THEN 'Chiapas' WHEN sucursal = 'Tapachula Norte Multiproducto' THEN 'Chiapas' WHEN sucursal = 'Taxco Multiproducto' THEN 'Guerrero' WHEN sucursal = 'Tecamac Multiproducto' THEN 'Hidalgo' WHEN sucursal = 'Tecamachalco Multiproducto' THEN 'Puebla' WHEN sucursal = 'Tecoman Multiproducto' THEN 'Colima' WHEN sucursal = 'Tecpan de Galeana Multiproducto' THEN 'Guerrero' WHEN sucursal = 'Tepic Multiproducto' THEN 'Nayarit' WHEN sucursal = 'Teziutlan Multiproducto' THEN 'Puebla' WHEN sucursal = 'Tierra Blanca Multiproducto' THEN 'Veracruz de Ignacio de la Llave' WHEN sucursal = 'Tlajomulco Multiproducto' THEN 'Jalisco' WHEN sucursal = 'Tlaxiaco Multiproducto' THEN 'Oaxaca' WHEN sucursal = 'Toluca Multiproducto' THEN 'Estado de México' WHEN sucursal = 'Tonala Multiproducto' THEN 'Jalisco' WHEN sucursal = 'Tonala Centro Multiproducto' THEN 'Jalisco' WHEN sucursal = 'Tonala Chiapas Multiproducto' THEN 'Chiapas' WHEN sucursal = 'Torreon Multiproducto' THEN 'Coahuila de Zaragoza' WHEN sucursal = 'Tula Multiproducto' THEN 'Hidalgo' WHEN sucursal = 'Tulancingo Multiproducto' THEN 'Hidalgo' WHEN sucursal = 'Tuxpan Multiproducto' THEN 'Veracruz de Ignacio de la Llave' WHEN sucursal = 'Tuxtepec Multiproducto' THEN 'Oaxaca' WHEN sucursal = 'Tuxtla Multiproducto' THEN 'Chiapas' WHEN sucursal = 'Tuxtla Libramiento Multiproducto' THEN 'Chiapas' WHEN sucursal = 'Uruapan Centro Multiproducto' THEN 'Michoacán de Ocampo' WHEN sucursal = 'Veracruz Multiproducto' THEN 'Veracruz de Ignacio de la Llave' WHEN sucursal = 'Villa Cuauhtemoc Multiproducto' THEN 'Estado de México' WHEN sucursal = 'Villaflores Multiproducto' THEN 'Chiapas' WHEN sucursal = 'Villahermosa Multiproducto' THEN 'Tabasco' WHEN sucursal = 'Villahermosa Olmeca Multiproducto' THEN 'Tabasco' WHEN sucursal = 'Xalapa Multiproducto' THEN 'Veracruz de Ignacio de la Llave' WHEN sucursal = 'Zacapu Multiproducto' THEN 'Michoacán de Ocampo' WHEN sucursal = 'Zacatecas Multiproducto' THEN 'Zacatecas' WHEN sucursal = 'Zamora Multiproducto' THEN 'Michoacán de Ocampo' WHEN sucursal = 'Zapopan Multiproducto' THEN 'Jalisco' WHEN sucursal = 'Zihuatanejo Multiproducto' THEN 'Guerrero' WHEN sucursal = 'Zinacantepec Multiproducto' THEN 'Estado de México' WHEN sucursal = 'Zitacuaro Multiproducto' THEN 'Michoacán de Ocampo' WHEN sucursal = 'Zumpango Multiproducto' THEN 'Estado de México' WHEN sucursal = 'Acapulco Multiproducto' THEN 'Guerrero' WHEN sucursal = 'Acapulco Centro Multiproducto' THEN 'Guerrero' WHEN sucursal = 'Acapulco Renacimiento Multiproducto' THEN 'Guerrero' WHEN sucursal = 'Atoyac Multiproducto' THEN 'Guerrero' WHEN sucursal = 'Autlan Multiproducto' THEN 'Jalisco' WHEN sucursal = 'Boca del Rio Multiproducto' THEN 'Veracruz de Ignacio de la Llave' WHEN sucursal = 'Bucerias Multiproducto' THEN 'Nayarit' WHEN sucursal = 'Catemaco Multiproducto' THEN 'Veracruz de Ignacio de la Llave' WHEN sucursal = 'Cd Hidalgo Multiproducto' THEN 'Hidalgo' WHEN sucursal = 'Cd Obregon Multiproducto' THEN 'Sonora' WHEN sucursal = 'Celaya Multiproducto' THEN 'Guanajuato' WHEN sucursal = 'Celaya Centro Multiproducto' THEN 'Guanajuato' WHEN sucursal = 'Chilapa Multiproducto' THEN 'Guerrero' WHEN sucursal = 'Chilpancingo Multiproducto' THEN 'Guerrero' WHEN sucursal = 'Chilpancingo Norte Multiproducto' THEN 'Guerrero' WHEN sucursal = 'Coatzacoalcos Multiproducto' THEN 'Veracruz de Ignacio de la Llave' WHEN sucursal = 'Cocula Multiproducto' THEN 'Jalisco' WHEN sucursal = 'Colima Multiproducto' THEN 'Colima' WHEN sucursal = 'Comitan Multiproducto' THEN 'Chiapas' WHEN sucursal = 'Cordoba Multiproducto' THEN 'Veracruz de Ignacio de la Llave' WHEN sucursal = 'Cosamaloapan Multiproducto' THEN 'Veracruz de Ignacio de la Llave' WHEN sucursal = 'Cuajimalpa Multiproducto' THEN 'CDMX' WHEN sucursal = 'Cuautla Multiproducto' THEN 'Morelos' WHEN sucursal = 'Cuernavaca Boulevard Multiproducto' THEN 'Morelos' WHEN sucursal = 'Culiacan Multiproducto' THEN 'Sinaloa' WHEN sucursal = 'Dolores Hidalgo Multiproducto' THEN 'Guanajuato' WHEN sucursal = 'Durango Multiproducto' THEN 'Durango' WHEN sucursal = 'Etla Multiproducto' THEN 'Oaxaca' WHEN sucursal = 'Gomez Palacio Multiproducto' THEN 'Durango' WHEN sucursal = 'Guadalajara Oblatos Multiproducto' THEN 'Jalisco' WHEN sucursal = 'Guadalajara Centro Multiproducto' THEN 'Jalisco' WHEN sucursal = 'Guadalupe Multiproducto' THEN 'Nuevo León' WHEN sucursal = 'Guamuchil Multiproducto' THEN 'Sinaloa' WHEN sucursal = 'Guanajuato Multiproducto' THEN 'Guanajuato' WHEN sucursal = 'Hermosillo Multiproducto' THEN 'Sonora' WHEN sucursal = 'Heroica Cardenas Multiproducto' THEN 'Tabasco' WHEN sucursal = 'Huahuchinango Multiproducto' THEN 'Puebla' WHEN sucursal = 'Huajuapan de Leon Multiproducto' THEN 'Oaxaca' WHEN sucursal = 'Iguala Multiproducto' THEN 'Guerrero' WHEN sucursal = 'Irapuato Multiproducto' THEN 'Guanajuato' WHEN sucursal = 'Ixtlahuaca Multiproducto' THEN 'Estado de México' WHEN sucursal = 'Jojutla Multiproducto' THEN 'Morelos' WHEN sucursal = 'Juchitan Multiproducto' THEN 'Oaxaca' WHEN sucursal = 'La Piedad Multiproducto' THEN 'Michoacán de Ocampo' WHEN sucursal = 'Lagos de Moreno Multiproducto' THEN 'Jalisco' WHEN sucursal = 'Lazaro Cardenas Multiproducto' THEN 'Michoacán de Ocampo' WHEN sucursal = 'Leon centro Multiproducto' THEN 'Guanajuato' WHEN sucursal = 'Lerdo Multiproducto' THEN 'Durango' WHEN sucursal = 'Lerma Multiproducto' THEN 'Estado de México' WHEN sucursal = 'Loreto Multiproducto' THEN 'Zacatecas' WHEN sucursal = 'Los Mochis Multiproducto' THEN 'Sinaloa' WHEN sucursal = 'Los Reyes Multiproducto' THEN 'Michoacán de Ocampo' WHEN sucursal = 'Macuspana Multiproducto' THEN 'Tabasco' WHEN sucursal = 'Manzanillo Multiproducto' THEN 'Colima' WHEN sucursal = 'Martinez de la Torre Multiproducto' THEN 'Veracruz de Ignacio de la Llave' WHEN sucursal = 'Matehuala Multiproducto' THEN 'San Luis Potosi' WHEN sucursal = 'Mazatlan Multiproducto' THEN 'Sinaloa' WHEN sucursal = 'Miahuatlan Multiproducto' THEN 'Oaxaca' WHEN sucursal = 'Minatitlan Multiproducto' THEN 'Veracruz de Ignacio de la Llave' WHEN sucursal = 'Monterrey Multiproducto' THEN 'Nuevo León' WHEN sucursal = 'Monterrey Centro Multiproducto' THEN 'Nuevo León' WHEN sucursal = 'Morelia Camelinas Multiproducto' THEN 'Michoacán de Ocampo' WHEN sucursal = 'Morelia Centro Multiproducto' THEN 'Michoacán de Ocampo' WHEN sucursal = 'Morelia Madero Multiproducto' THEN 'Michoacán de Ocampo' WHEN sucursal = 'Moroleon Multiproducto' THEN 'Guanajuato' WHEN sucursal = 'Navojoa Multiproducto' THEN 'Sinaloa' WHEN sucursal = 'Neza Multiproducto' THEN 'Estado de México' WHEN sucursal = 'Oaxaca Multiproducto' THEN 'Oaxaca' WHEN sucursal = 'Ocotlan Multiproducto' THEN 'Jalisco' WHEN sucursal = 'Ocotlan de Morelos Multiproducto' THEN 'Oaxaca' WHEN sucursal = 'CD Altamirano Multiproducto' THEN 'Guerrero' else '' end as estado, SUM( CASE WHEN saldocapital > 900000 THEN 900000 WHEN diasatraso > 21 THEN 0 ELSE saldocapital END ) AS suma_capital_modificado FROM mambu_prod.soh_mambu WHERE fondeador = 'PROMECAP' AND fechacorte = ( SELECT MAX(fechadesembolso) FROM mambu_prod.soh_mambu ) GROUP BY sucursal, estadosucursal order by sucursal; ";
                $statement = $pdo->query($query);
                $tablamambu = $statement->fetchAll(PDO::FETCH_ASSOC);

                //   $tjucavi = '[{"sucursal":"","estado":"Guerrero","suma_capital_modificado":"2161911.57"},{"sucursal":"Acambaro Multiproducto","estado":"Guanajuato","suma_capital_modificado":"5566328.21"},{"sucursal":"Acapulco Centro Multiproducto","estado":"Guerrero","suma_capital_modificado":"4479176.01"},{"sucursal":"Acapulco Multiproducto","estado":"Guerrero","suma_capital_modificado":"9785153.53"},{"sucursal":"Acapulco Renacimiento Multiproducto","estado":"Guerrero","suma_capital_modificado":"6376741.84"},{"sucursal":"Aguascalientes Multiproducto","estado":"Aguascalientes","suma_capital_modificado":"7899350.15"},{"sucursal":"Apatzingan Multiproducto","estado":"Michoacán de Ocampo","suma_capital_modificado":"31454082.68"},{"sucursal":"Apizaco Multiproducto","estado":"Tlaxcala","suma_capital_modificado":"3257065.66"},{"sucursal":"Atlacomulco Multiproducto","estado":"Estado de México","suma_capital_modificado":"7540189.52"},{"sucursal":"Autlan Multiproducto","estado":"Jalisco","suma_capital_modificado":"3269871.68"},{"sucursal":"Bucerias Multiproducto","estado":"Nayarit","suma_capital_modificado":"3829450.54"},{"sucursal":"Celaya Centro Multiproducto","estado":"Guanajuato","suma_capital_modificado":"4909544.55"},{"sucursal":"Chilapa Multiproducto","estado":"Guerrero","suma_capital_modificado":"6964186.94"},{"sucursal":"Chilpancingo Norte Multiproducto","estado":"Guerrero","suma_capital_modificado":"6024579.10"},{"sucursal":"Coatzacoalcos Multiproducto","estado":"Veracruz de Ignacio de la Llave","suma_capital_modificado":"5085804.33"},{"sucursal":"Colima Multiproducto","estado":"Colima","suma_capital_modificado":"2692392.67"},{"sucursal":"Cosamaloapan Multiproducto","estado":"Veracruz de Ignacio de la Llave","suma_capital_modificado":"8388956.50"},{"sucursal":"Culiacan Multiproducto","estado":"Sinaloa","suma_capital_modificado":"5194744.82"},{"sucursal":"Dolores Hidalgo Multiproducto","estado":"Guanajuato","suma_capital_modificado":"8557795.80"},{"sucursal":"Durango Multiproducto","estado":"Durango","suma_capital_modificado":"1046826.40"},{"sucursal":"Guadalajara Centro Multiproducto","estado":"Jalisco","suma_capital_modificado":"8554970.92"},{"sucursal":"Guadalupe Multiproducto","estado":"Nuevo León","suma_capital_modificado":"4830144.64"},{"sucursal":"Guanajuato Multiproducto","estado":"Guanajuato","suma_capital_modificado":"8707716.27"},{"sucursal":"Hermosillo Multiproducto","estado":"Sonora","suma_capital_modificado":"7728768.25"},{"sucursal":"Heroica Cardenas Multiproducto","estado":"Tabasco","suma_capital_modificado":"3625585.96"},{"sucursal":"Huajuapan de Leon Multiproducto","estado":"Oaxaca","suma_capital_modificado":"1839903.74"},{"sucursal":"Iguala Multiproducto","estado":"Guerrero","suma_capital_modificado":"6541586.60"},{"sucursal":"Ixtlahuaca Multiproducto","estado":"Estado de México","suma_capital_modificado":"6303415.65"},{"sucursal":"Lazaro Cardenas Multiproducto","estado":"Michoacán de Ocampo","suma_capital_modificado":"5792156.30"},{"sucursal":"Leon centro Multiproducto","estado":"Guanajuato","suma_capital_modificado":"9015550.84"},{"sucursal":"Manzanillo Multiproducto","estado":"Colima","suma_capital_modificado":"4429333.98"},{"sucursal":"Martinez de la Torre Multiproducto","estado":"Veracruz de Ignacio de la Llave","suma_capital_modificado":"5641563.89"},{"sucursal":"Matehuala Multiproducto","estado":"San Luis Potosi","suma_capital_modificado":"717839.87"},{"sucursal":"Mazatlan Multiproducto","estado":"Sinaloa","suma_capital_modificado":"4223657.39"},{"sucursal":"Monterrey Centro Multiproducto","estado":"Nuevo León","suma_capital_modificado":"6214695.14"},{"sucursal":"Morelia Camelinas Multiproducto","estado":"Michoacán de Ocampo","suma_capital_modificado":"12666193.58"},{"sucursal":"Navojoa Multiproducto","estado":"Sinaloa","suma_capital_modificado":"248468.59"},{"sucursal":"Oaxaca Multiproducto","estado":"Oaxaca","suma_capital_modificado":"7616129.27"},{"sucursal":"Ocotlan de Morelos Multiproducto","estado":"Oaxaca","suma_capital_modificado":"4888408.58"},{"sucursal":"Orizaba Multiproducto","estado":"Veracruz de Ignacio de la Llave","suma_capital_modificado":"6031353.77"},{"sucursal":"Papantla Multiproducto","estado":"Veracruz de Ignacio de la Llave","suma_capital_modificado":"2637676.95"},{"sucursal":"Patzcuaro Multiproducto","estado":"Michoacán de Ocampo","suma_capital_modificado":"10518896.50"},{"sucursal":"Puebla Multiproducto","estado":"Puebla","suma_capital_modificado":"3458773.99"},{"sucursal":"Queretaro Multiproducto","estado":"Querétaro","suma_capital_modificado":"5288156.54"},{"sucursal":"Rio Verde Multiproducto","estado":"San Luis Potosi","suma_capital_modificado":"5533819.35"},{"sucursal":"Salamanca Multiproducto","estado":"Guanajuato","suma_capital_modificado":"6743146.07"},{"sucursal":"Saltillo Multiproducto","estado":"Coahuila de Zaragoza","suma_capital_modificado":"4872629.25"},{"sucursal":"San Andres Multiproducto","estado":"Veracruz de Ignacio de la Llave","suma_capital_modificado":"6302702.58"},{"sucursal":"San Juan Del Rio Multiproducto","estado":"Querétaro","suma_capital_modificado":"3468505.32"},{"sucursal":"San Luis Centro Multiproducto","estado":"San Luis Potosi","suma_capital_modificado":"7925250.19"},{"sucursal":"San Luis Multiproducto","estado":"San Luis Potosi","suma_capital_modificado":"6411016.64"},{"sucursal":"San Luis Zona Industrial Multiproducto","estado":"San Luis Potosi","suma_capital_modificado":"11384670.42"},{"sucursal":"Santa Catarina Multiproducto","estado":"Nuevo León","suma_capital_modificado":"13021506.79"},{"sucursal":"Tala Multiproducto","estado":"Jalisco","suma_capital_modificado":"3568899.77"},{"sucursal":"Tapachula Multiproducto","estado":"Chiapas","suma_capital_modificado":"8109675.85"},{"sucursal":"Tecpan de Galeana Multiproducto","estado":"Guerrero","suma_capital_modificado":"2351834.72"},{"sucursal":"Tepic Multiproducto","estado":"Nayarit","suma_capital_modificado":"2909212.53"},{"sucursal":"Tlajomulco Multiproducto","estado":"Jalisco","suma_capital_modificado":"1674872.81"},{"sucursal":"Tlaxiaco Multiproducto","estado":"Oaxaca","suma_capital_modificado":"3992380.97"},{"sucursal":"Tonala Chiapas Multiproducto","estado":"Chiapas","suma_capital_modificado":"3168342.44"},{"sucursal":"Torreon Multiproducto","estado":"Coahuila de Zaragoza","suma_capital_modificado":"5925367.63"},{"sucursal":"Tuxtepec Multiproducto","estado":"Oaxaca","suma_capital_modificado":"3244644.41"},{"sucursal":"Tuxtla Multiproducto","estado":"Chiapas","suma_capital_modificado":"5375897.80"},{"sucursal":"Uruapan Centro Multiproducto","estado":"Michoacán de Ocampo","suma_capital_modificado":"11638572.51"},{"sucursal":"Veracruz Multiproducto","estado":"Veracruz de Ignacio de la Llave","suma_capital_modificado":"9103383.68"},{"sucursal":"Villa Victoria Multiproducto","estado":"Estado de México","suma_capital_modificado":"3372697.80"},{"sucursal":"Villahermosa Olmeca Multiproducto","estado":"Tabasco","suma_capital_modificado":"3808736.19"},{"sucursal":"Zacapu Multiproducto","estado":"Michoacán de Ocampo","suma_capital_modificado":"13162668.25"},{"sucursal":"Zamora Multiproducto","estado":"Michoacán de Ocampo","suma_capital_modificado":"10982285.41"},{"sucursal":"Zihuatanejo Multiproducto","estado":"Guerrero","suma_capital_modificado":"11348748.87"},{"sucursal":"Zitacuaro Multiproducto","estado":"Michoacán de Ocampo","suma_capital_modificado":"1214308.63"}]';
                //   $tmpmambu = '[{"sucursal":"Actopan Multiproducto","estado":"Hidalgo","suma_capital_modificado":"911660.25"},{"sucursal":"Ayotla Multiproducto","estado":"Estado de México","suma_capital_modificado":"1413546.00"},{"sucursal":"Chalco Multiproducto","estado":"Estado de México","suma_capital_modificado":"1679137.50"},{"sucursal":"Chimalhuacan Multiproducto","estado":"Estado de México","suma_capital_modificado":"1805767.75"},{"sucursal":"Cuautla Multiproducto","estado":"Morelos","suma_capital_modificado":"903658.50"},{"sucursal":"Cuernavaca Multiproducto","estado":"Morelos","suma_capital_modificado":"718510.00"},{"sucursal":"Eduardo Molina Multiproducto","estado":"CDMX","suma_capital_modificado":"1276913.00"},{"sucursal":"Iztacalco Multiproducto","estado":"CDMX","suma_capital_modificado":"1726040.00"},{"sucursal":"Iztapalapa Oriente Multiproducto","estado":"CDMX","suma_capital_modificado":"1779508.00"},{"sucursal":"Jojutla Multiproducto","estado":"Morelos","suma_capital_modificado":"370246.00"},{"sucursal":"La Joya Multiproducto","estado":"CDMX","suma_capital_modificado":"874007.46"},{"sucursal":"Lerma Multiproducto","estado":"Estado de México","suma_capital_modificado":"2646877.28"},{"sucursal":"Neza Multiproducto","estado":"Estado de México","suma_capital_modificado":"1790510.04"},{"sucursal":"Pachuca Multiproducto","estado":"Hidalgo","suma_capital_modificado":"617343.25"},{"sucursal":"Pantitlan Multiproducto","estado":"CDMX","suma_capital_modificado":"1308972.00"},{"sucursal":"Santa Cruz Multiproducto","estado":"CDMX","suma_capital_modificado":"1161916.00"},{"sucursal":"Tecamac Multiproducto","estado":"Hidalgo","suma_capital_modificado":"1533572.64"},{"sucursal":"Toluca Multiproducto","estado":"Estado de México","suma_capital_modificado":"865289.50"},{"sucursal":"Tula Multiproducto","estado":"Hidalgo","suma_capital_modificado":"1361447.50"},{"sucursal":"Tulyehualco Multiproducto","estado":"CDMX","suma_capital_modificado":"1846487.56"},{"sucursal":"Xochimilco Multiproducto","estado":"CDMX","suma_capital_modificado":"2129450.00"},{"sucursal":"Zumpango Multiproducto","estado":"Estado de México","suma_capital_modificado":"1823141.50"}]';

                $tsucursales = '[{"sucursal":"Acambaro Multiproducto","estado":"Guanajuato"},{"sucursal":"Acapulco Centro Multiproducto","estado":"Guerrero"},{"sucursal":"Acapulco Multiproducto","estado":"Guerrero"},{"sucursal":"Acapulco Renacimiento Multiproducto","estado":"Guerrero"},{"sucursal":"Actopan Multiproducto","estado":"Hidalgo"},{"sucursal":"Aguascalientes Multiproducto","estado":"Aguascalientes"},{"sucursal":"Apatzingan Madero Multiproducto","estado":"Michoacán de Ocampo"},{"sucursal":"Apatzingan Multiproducto","estado":"Michoacán de Ocampo"},{"sucursal":"Apizaco Multiproducto","estado":"Tlaxcala"},{"sucursal":"Atlacomulco Multiproducto","estado":"Estado de México"},{"sucursal":"Autlan Multiproducto","estado":"Jalisco"},{"sucursal":"Ayotla Multiproducto","estado":"Estado de México"},{"sucursal":"Boca del Rio Multiproducto","estado":"Veracruz de Ignacio de la Llave"},{"sucursal":"Bucerias Multiproducto","estado":"Nayarit"},{"sucursal":"CD Altamirano Multiproducto","estado":"Guerrero"},{"sucursal":"Celaya Centro Multiproducto","estado":"Guanajuato"},{"sucursal":"Chalco Multiproducto","estado":"Estado de México"},{"sucursal":"Chilapa Multiproducto","estado":"Guerrero"},{"sucursal":"Chilpancingo Norte Multiproducto","estado":"Guerrero"},{"sucursal":"Chimalhuacan Multiproducto","estado":"Estado de México"},{"sucursal":"Coatzacoalcos Multiproducto","estado":"Veracruz de Ignacio de la Llave"},{"sucursal":"Colima Multiproducto","estado":"Colima"},{"sucursal":"Comitan Multiproducto","estado":"Chiapas"},{"sucursal":"Cosamaloapan Multiproducto","estado":"Veracruz de Ignacio de la Llave"},{"sucursal":"Cuautla Multiproducto","estado":"Morelos"},{"sucursal":"Cuernavaca Multiproducto","estado":"Morelos"},{"sucursal":"Culiacan Multiproducto","estado":"Sinaloa"},{"sucursal":"Dolores Hidalgo Multiproducto","estado":"Guanajuato"},{"sucursal":"Durango Multiproducto","estado":"Durango"},{"sucursal":"Eduardo Molina Multiproducto","estado":"CDMX"},{"sucursal":"Guadalajara Centro Multiproducto","estado":"Jalisco"},{"sucursal":"Guadalupe Multiproducto","estado":"Nuevo León"},{"sucursal":"Guanajuato Multiproducto","estado":"Guanajuato"},{"sucursal":"Hermosillo Multiproducto","estado":"Sonora"},{"sucursal":"Heroica Cardenas Multiproducto","estado":"Tabasco"},{"sucursal":"Huajuapan de Leon Multiproducto","estado":"Oaxaca"},{"sucursal":"Iguala Multiproducto","estado":"Guerrero"},{"sucursal":"Ixtlahuaca Multiproducto","estado":"Estado de México"},{"sucursal":"Iztacalco Multiproducto","estado":"CDMX"},{"sucursal":"Iztapalapa Oriente Multiproducto","estado":"CDMX"},{"sucursal":"Jojutla Multiproducto","estado":"Morelos"},{"sucursal":"La Joya Multiproducto","estado":"CDMX"},{"sucursal":"Lagos de Moreno Multiproducto","estado":"Jalisco"},{"sucursal":"Lazaro Cardenas Multiproducto","estado":"Michoacán de Ocampo"},{"sucursal":"Leon centro Multiproducto","estado":"Guanajuato"},{"sucursal":"Lerdo Multiproducto","estado":"Durango"},{"sucursal":"Lerma Multiproducto","estado":"Estado de México"},{"sucursal":"Los Reyes Multiproducto","estado":"Michoacán de Ocampo"},{"sucursal":"Manzanillo Multiproducto","estado":"Colima"},{"sucursal":"Martinez de la Torre Multiproducto","estado":"Veracruz de Ignacio de la Llave"},{"sucursal":"Matehuala Multiproducto","estado":"San Luis Potosi"},{"sucursal":"Mazatlan Multiproducto","estado":"Sinaloa"},{"sucursal":"Monterrey Centro Multiproducto","estado":"Nuevo León"},{"sucursal":"Monterrey Multiproducto","estado":"Nuevo León"},{"sucursal":"Morelia Camelinas Multiproducto","estado":"Michoacán de Ocampo"},{"sucursal":"Morelia Madero Multiproducto","estado":"Michoacán de Ocampo"},{"sucursal":"Navojoa Multiproducto","estado":"Sinaloa"},{"sucursal":"Neza Multiproducto","estado":"Estado de México"},{"sucursal":"Oaxaca Multiproducto","estado":"Oaxaca"},{"sucursal":"Ocotlan de Morelos Multiproducto","estado":"Oaxaca"},{"sucursal":"Orizaba Multiproducto","estado":"Veracruz de Ignacio de la Llave"},{"sucursal":"Pachuca Multiproducto","estado":"Hidalgo"},{"sucursal":"Pantitlan Multiproducto","estado":"CDMX"},{"sucursal":"Papantla Multiproducto","estado":"Veracruz de Ignacio de la Llave"},{"sucursal":"Patzcuaro Multiproducto","estado":"Michoacán de Ocampo"},{"sucursal":"Puebla Multiproducto","estado":"Puebla"},{"sucursal":"Queretaro Multiproducto","estado":"Querétaro"},{"sucursal":"Rio Verde Multiproducto","estado":"San Luis Potosi"},{"sucursal":"Sahuayo Multiproducto","estado":"Michoacán de Ocampo"},{"sucursal":"Salamanca Multiproducto","estado":"Guanajuato"},{"sucursal":"Saltillo Multiproducto","estado":"Coahuila de Zaragoza"},{"sucursal":"San Andres Multiproducto","estado":"Veracruz de Ignacio de la Llave"},{"sucursal":"San Juan Del Rio Multiproducto","estado":"Querétaro"},{"sucursal":"San Luis Centro Multiproducto","estado":"San Luis Potosi"},{"sucursal":"San Luis Multiproducto","estado":"San Luis Potosi"},{"sucursal":"San Luis Zona Industrial Multiproducto","estado":"San Luis Potosi"},{"sucursal":"Santa Catarina Multiproducto","estado":"Nuevo León"},{"sucursal":"Santa Cruz Multiproducto","estado":"CDMX"},{"sucursal":"Tacambaro Multiproducto","estado":"Michoacán de Ocampo"},{"sucursal":"Tala Multiproducto","estado":"Jalisco"},{"sucursal":"Tapachula Multiproducto","estado":"Chiapas"},{"sucursal":"Tecamac Multiproducto","estado":"Hidalgo"},{"sucursal":"Tecpan de Galeana Multiproducto","estado":"Guerrero"},{"sucursal":"Tepic Multiproducto","estado":"Nayarit"},{"sucursal":"Tlajomulco Multiproducto","estado":"Jalisco"},{"sucursal":"Tlaxiaco Multiproducto","estado":"Oaxaca"},{"sucursal":"Toluca Multiproducto","estado":"Estado de México"},{"sucursal":"Tonala Centro Multiproducto","estado":"Jalisco"},{"sucursal":"Tonala Chiapas Multiproducto","estado":"Chiapas"},{"sucursal":"Torreon Multiproducto","estado":"Coahuila de Zaragoza"},{"sucursal":"Tula Multiproducto","estado":"Hidalgo"},{"sucursal":"Tulyehualco Multiproducto","estado":"CDMX"},{"sucursal":"Tuxtepec Multiproducto","estado":"Oaxaca"},{"sucursal":"Tuxtla Multiproducto","estado":"Chiapas"},{"sucursal":"Uruapan Centro Multiproducto","estado":"Michoacán de Ocampo"},{"sucursal":"Veracruz Multiproducto","estado":"Veracruz de Ignacio de la Llave"},{"sucursal":"Villa Victoria Multiproducto","estado":"Estado de México"},{"sucursal":"Villaflores Multiproducto","estado":"Chiapas"},{"sucursal":"Villahermosa Olmeca Multiproducto","estado":"Tabasco"},{"sucursal":"Xochimilco Multiproducto","estado":"CDMX"},{"sucursal":"Zacapu Multiproducto","estado":"Michoacán de Ocampo"},{"sucursal":"Zamora Multiproducto","estado":"Michoacán de Ocampo"},{"sucursal":"Zihuatanejo Multiproducto","estado":"Guerrero"},{"sucursal":"Zitacuaro Multiproducto","estado":"Michoacán de Ocampo"},{"sucursal":"Zumpango Multiproducto","estado":"Estado de México"}]';

                // $tmpmambu = json_decode($tmpmambu, true);
                // $tjucavi = json_decode($tjucavi, true);

                $tjucavi = $tablajucavi;
                $tmpmambu = $tablamambu;

                $sucursales = json_decode($tsucursales, true);

                for ($i = 0; $i < count($sucursales); $i++) {

                    $sucursal = $sucursales[$i]; // Usamos una referencia para poder modificar el elemento actual
                    // Buscar la sucursal en $tmpmambu
                    $tmpmambuMatch = null;
                    foreach ($tmpmambu as $item) {
                        if ($item['sucursal'] === $sucursal['sucursal']) {
                            $tmpmambuMatch = $item;
                            break; // Salir del bucle una vez que se encuentre una coincidencia
                        }
                    }

                    // Buscar la sucursal en $tjucavi
                    $tjucaviMatch = null;
                    foreach ($tjucavi as $item) {
                        if ($item['sucursal'] === $sucursal['sucursal']) {
                            $tjucaviMatch = $item;
                            break; // Salir del bucle una vez que se encuentre una coincidencia
                        }
                    }

                    // Calcular el saldo capital si se encuentran coincidencias
                    $saldoCapital = 0;
                    if (!is_null($tmpmambuMatch)) {
                        $saldoCapital += floatval($tmpmambuMatch['suma_capital_modificado']);
                    }
                    if (!is_null($tjucaviMatch)) {
                        $saldoCapital += floatval($tjucaviMatch['suma_capital_modificado']);
                    }

                    // Añadir el campo saldo_capital
                    $sucursales[$i]['saldo_capital'] = number_format($saldoCapital, 2); // Formatear el número si es necesario
                }

                //return $sucursales;

                $suma_total = 0.0; // Inicializa la suma total

                foreach ($sucursales as $item) {
                    $saldo_capital = floatval(str_replace(',', '', $item['saldo_capital']));
                    $suma_total += $saldo_capital;
                }

                $saldomaximo = $suma_total * 0.05;

                // Calcula el porcentaje proporcional para cada elemento y agrega el campo "porcentaje"
                for ($i = 0; $i < count($sucursales); $i++) {
                    $saldo_capital = $sucursales[$i]['saldo_capital'];
                    $saldocasteado = floatval(str_replace(',', '', $saldo_capital));

                    if ($saldocasteado > $saldomaximo) {
                        $sucursales[$i]['saldo_capital'] = number_format($saldomaximo, 2);
                        $porcentaje = number_format(5.00, 2);
                        $sucursales[$i]["porcentaje"] = number_format($porcentaje, 2);
                    } else {
                        $porcentaje = ($saldocasteado / $suma_total) * 100;
                        $sucursales[$i]["porcentaje"] = number_format($porcentaje, 2);
                    }

                }

                $saldos_por_estado = array();

                // Recorre el arreglo de sucursales
                foreach ($sucursales as $item) {
                    $estado = $item['estado'];
                    $saldo_capital = floatval(str_replace(',', '', $item['saldo_capital'])); // Convierte el saldo a flotante

                    // Si el estado ya existe en el arreglo $saldos_por_estado, suma el saldo al valor existente
                    if (isset($saldos_por_estado[$estado])) {
                        $saldos_por_estado[$estado] += $saldo_capital;
                    } else {
                        // Si el estado no existe, crea una nueva entrada con el saldo actual
                        $saldos_por_estado[$estado] = $saldo_capital;
                    }
                }

                $suma_total_estados = array_sum($saldos_por_estado);

                $arreglo_estados_porcentajes = array();

                foreach ($saldos_por_estado as $estado => $valor) {
                    $porcentaje = ($valor / $suma_total_estados) * 100;
                    $tmparray = [
                        "estado" => $estado,
                        "saldo" => $valor,
                        "porcentaje" => $porcentaje,
                    ];
                    array_push($arreglo_estados_porcentajes, $tmparray);
                }

                for ($i = 0; $i < count($arreglo_estados_porcentajes); $i++) {
                    switch ($arreglo_estados_porcentajes[$i]["estado"]) {
                        case 1:
                            echo "CDMX";
                            if ($value["porcentaje"] > 30.00) {
                                $arreglo_estados_porcentajes[$i]["saldo"] = $suma_total_estados * 0.3;
                                $arreglo_estados_porcentajes[$i]["porcentaje"] = 30.0;
                            }
                            break;
                        case 2:
                            echo "Estado de México";
                            if ($value["porcentaje"] > 30.00) {
                                $arreglo_estados_porcentajes[$i]["saldo"] = $suma_total_estados * 0.3;
                                $arreglo_estados_porcentajes[$i]["porcentaje"] = 20.0;
                            }
                            break;
                        case 3:
                            echo "Michoacán de Ocampo";
                            if ($value["porcentaje"] > 20.00) {
                                $arreglo_estados_porcentajes[$i]["saldo"] = $suma_total_estados * 0.2;
                                $arreglo_estados_porcentajes[$i]["porcentaje"] = 20.0;
                            }
                            break;
                        default:

                    }

                }

                $aforo_calculado = 0.0;

                foreach ($arreglo_estados_porcentajes as $key => $value) {
                    $aforo_calculado += $value["saldo"];
                }


                $nuevoRegistro = new historicoaforo;
                $nuevoRegistro->fondeador = 'PROMECAP';
                $nuevoRegistro->aforo = $aforo_calculado;
                $nuevoRegistro->fecha = $fechaHoy;
                $nuevoRegistro->save();

                return $aforo_calculado;
            }

        } catch (\Throwable $th) {
            return $th->getMessage();
        }

    }

    public function historicoaforopromecap()
    {
        $fechaUnMesAtras = now()->subMonth();
        $registros = historicoaforo::whereBetween('fecha', [$fechaUnMesAtras, now()])->get();
        return $registros;
    }

}
