<?php

namespace App\Http\Controllers;

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
        $pdo = new PDO("mysql:host=$hostODS;port=$portODS;dbname=$dbNameODS", $userODS, $passwordODS);

        try {

            // Conexión a la base de datos
            $pdo = new PDO("mysql:host=$hostODS;port=$portODS;dbname=$dbNameODS", $userODS, $passwordODS);

            // Preparar la consulta SQL
            $query = "SELECT Sh_origen, Sh_credito, Sh_referencia, Sh_numclientesicap, Sh_numsolicitudsicap, Sh_numclienteibs, Sh_nombrecliente, Sh_rfc, Sh_numsucursal, Sh_nombresucursal, DATE_FORMAT(sh_fecha_envio, '%d-%c-%Y') as FechaEnvio, Sh_fecha_generacion, Sh_hora_generacion, Sh_num_cuotas, Sh_num_cuotas_trancurridas, Sh_plazo, Sh_periodicidad, DATE_FORMAT(sh_fecha_desembolso, '%d-%c-%Y') as FechaDesembolso, DATE_FORMAT(sh_fecha_vencimiento, '%d-%c-%Y') as FechaVencimiento, Sh_monto_desembolsado-IFNULL(Sh_monto_seguro,0) as Sh_monto_dispersado, Sh_monto_seguro, Sh_monto_credito, Sh_saldo_total_dia, Sh_saldo_capital, Sh_saldo_interes, Sh_saldo_interes_vigente, Sh_saldo_interes_vencido, Sh_saldo_interes_vencido_90dias, Sh_saldo_interes_cuentas_orden, Sh_saldo_iva_interes, Sh_saldo_bonificacion_iva, Sh_saldo_interes_mora, Sh_saldo_iva_mora, Sh_saldo_multa, Sh_saldo_iva_multa, Sh_capital_pagado, Sh_interes_normal_pagado, Sh_iva_interes_normal_pagado, Sh_bonificacion_pagada, Sh_moratorio_pagado, Sh_iva_moratorio_pagado, Sh_multa_pagada, Sh_iva_multa_pagada, Sh_comision, Sh_iva_comision, DATE_FORMAT(sh_fecha_sig_amortizacion, '%d-%c-%Y') as FechaSigAmortizacion, Sh_capital_sig_amortizacion, Sh_interes_sig_amortizacion, Sh_iva_interes_sig_amortizacion, Sh_fondeador, (select fo_nombre from clientes_ods.c_fondeadores where sh_fondeador = fo_numfondeador) as NombreFondeador, IFNULL('',fo_nombre) as Garantia, Sh_tasa_interes_sin_iva, Sh_tasa_mora_sin_iva, Sh_tasa_iva, Sh_saldo_con_intereses_al_final, Sh_capital_vencido, Sh_interes_vencido, Sh_iva_interes_vencido, Sh_total_vencido, Sh_estatus, Sh_producto, op_nombre as NombreProducto, Sh_fecha_incumplimiento, DATE_FORMAT(Sh_fecha_a_cartera_vencida, '%d-%c-%Y') as FechaCarteraVencida, Sh_num_dias_mora, CASE WHEN sh_num_dias_mora = 0 THEN 'MOP 01' WHEN sh_num_dias_mora = 1 OR sh_num_dias_mora <= 7 THEN 'MOP 02' WHEN sh_num_dias_mora = 8 OR sh_num_dias_mora <= 14 THEN 'MOP 03' WHEN sh_num_dias_mora = 15 OR sh_num_dias_mora <= 21 THEN 'MOP 04' WHEN sh_num_dias_mora = 22 OR sh_num_dias_mora <= 27 THEN 'MOP 05' WHEN sh_num_dias_mora = 28 OR sh_num_dias_mora <= 34 THEN 'MOP 06' WHEN sh_num_dias_mora = 35 OR sh_num_dias_mora <= 41 THEN 'MOP 07' WHEN sh_num_dias_mora = 42 OR sh_num_dias_mora <= 48 THEN 'MOP 08' WHEN sh_num_dias_mora = 49 OR sh_num_dias_mora <= 55 THEN 'MOP 09' WHEN sh_num_dias_mora = 56 OR sh_num_dias_mora <= 62 THEN 'MOP 10' WHEN sh_num_dias_mora = 63 OR sh_num_dias_mora <= 69 THEN 'MOP 11' WHEN sh_num_dias_mora = 70 OR sh_num_dias_mora <= 76 THEN 'MOP 12' WHEN sh_num_dias_mora = 77 OR sh_num_dias_mora <= 83 THEN 'MOP 13' WHEN sh_num_dias_mora = 84 OR sh_num_dias_mora <= 90 THEN 'MOP 14' WHEN sh_num_dias_mora = 91 OR sh_num_dias_mora <= 97 THEN 'MOP 15' WHEN sh_num_dias_mora = 98 OR sh_num_dias_mora <= 104 THEN 'MOP 16' WHEN sh_num_dias_mora = 105 OR sh_num_dias_mora <= 111 THEN 'MOP 17' WHEN sh_num_dias_mora = 112 OR sh_num_dias_mora <= 119 THEN 'MOP 18' WHEN sh_num_dias_mora > 119 THEN 'MOP 19' END AS referencia, Sh_dias_transcurridos, Sh_cuotas_vencidas, Sh_num_pagos_realizados, Sh_moto_total_pagado, Sh_fecha_ultimo_pago, Sh_bandera_reestructura, Sh_credito_reestructurado, Sh_dias_mora_reestructura, Sh_tasa_preferencial_iva, Sh_cuenta_bucket, Sh_saldo_bucket, Sh_cta_contable, Sh_fecha_historico, sh_integranteini as integrantesDispersados, sh_integrantecan as integrantesCancelados, sh_addintegrante as integrantesInterciclo, sh_monto_cuenta_congelada, sh_interes_xdevengar, sh_iva_interes_xdevengar, sh_interes_devengado, sh_iva_interes_devengado, sh_integranteini as Integrantes_Iniciales, sh_integrantecan as Integrantes_Cancelados, sh_addintegrante as Integrantes_Agregados, sh.origsistema as Origen_Sistema, s.ib_tasaelegida as Tasa_Mensual_sin_Iva, IF(cg.ci_porgarantia = 1, '0%', IF(cg.ci_porgarantia = 2, '5%', IF(cg.ci_porgarantia = 3, '10%', '-'))) AS Garantia, sh_cta_contable as No_Asesor, (SELECT CONCAT(ej_nombre, ' ', ej_apaterno, ' ', ej_amaterno) FROM clientes_ods.c_ejecutivos WHERE sh_cta_contable = ej_numejecutivo) as Asesor, es_nombre as Estado, sh_saldogarantia FROM clientes_ods.d_saldos_hist sh LEFT JOIN clientes_ods.d_saldos s ON (Sh_numclientesicap = s.ib_numclientesicap AND Sh_numsolicitudsicap = s.ib_numsolicitudsicap AND sh.origsistema = s.origsistema) LEFT JOIN clientes_ods.d_ciclos_grupales cg ON (s.ib_numclientesicap = cg.ci_numgrupo AND s.ib_numsolicitudsicap = cg.ci_numciclo AND s.origsistema = cg.origsistema AND ci_origenmigracion = 0) LEFT JOIN clientes_ods.c_fondeadores ON (fo_numfondeador = sh_fondeo_garantia) LEFT JOIN clientes_ods.c_sucursales ON (sh_numsucursal = su_numsucursal) LEFT JOIN clientes_ods.c_estados ON (su_estado = es_numestado) LEFT JOIN clientes_ods.c_operaciones ON (op_numoperacion = Sh_producto) WHERE sh_fecha_historico = '2023-06-27' AND sh_fecha_desembolso <= '2023-06-27' AND Sh_fondeador IN (1, 10, 16, 17) AND sh_estatus IN (1, 2, 3, 4, 5, 6) GROUP BY Sh_credito, Sh_numclientesicap, Sh_numsolicitudsicap;";
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
            $query = "SELECT * FROM mambu_prod.soh_mambu where  fechacorte = '2023-06-27'; ";

            $statement = $pdo->query($query);
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
            return response()->json(['success' => "Consulta realizada correctamente"], 200);

        } catch (\Throwable $th) {
            return $th;

            return response()->json(['error' => $th], 400);

        }

    }
}
