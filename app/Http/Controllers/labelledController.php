<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDO;

class labelledController extends Controller
{
    public function jucavibursa()
    {
        return view('etiquetado.jucavi.bursa');
    }
    public function jucavipromecap()
    {
        return view('etiquetado.jucavi.promecap');
    }
    public function jucaviblao()
    {
        return view('etiquetado.jucavi.blao');
    }
    public function mambubursa()
    {
        return view('etiquetado.mambu.bursa');
    }
    public function mambupromecap()
    {
        return view('etiquetado.mambu.promecap');
    }
    public function mambublao()
    {
        return view('etiquetado.mambu.blao');
    }
    public function mambumintos()
    {
        return view('etiquetado.mambu.mintos');
    }
    public function promecap_preetiequetado_mambu()
    {
        try {

            $dayOfWeek = date('N');
            if ($dayOfWeek >= 6) {
                // Es fin de semana (sábado o domingo)
                return response()->json(['error' => 'No se realiza etiquetado con corte de fin de semana'], 400);
            } else {
                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'http://fcetiquetado.azurewebsites.net/ProcesoBursa/api/EtiquetadoPromecapM/PreetiquetadoPromecapMambu/',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'GET',
                    CURLOPT_HTTPHEADER => array(
                        'Cookie: ARRAffinity=f338cc84dcd26ef0541e10991beb3f601c2d1a0e9ced27dcfbc2140d4a6a8e25',
                    ),
                ));

                $response = curl_exec($curl);

                if (strpos($v[0], "Error") !== false) {
                    return response()->json(['error' => $v[0]], 400);

                } else {
                    return response()->json(['success' => $v[0]], 200);
                }
            }

        } catch (\Throwable $th) {
            echo $th;
        }

    }
    public function bajapromecapmambu(Request $request)
    {
        $fechaActual = date("Y-m-d");
        $lstCreditos = $request->baja;
        try {
            $host = 'fcontigo-rs-cluster-01.cdxtyqbdsp7d.us-east-1.redshift.amazonaws.com';
            $port = '5439';
            $database = 'mambu_prod';
            $user = 'marcadodev';
            $password = 'marcadoDev00';

            // "call  bursa.sp_reporteTransacciones('2023-06-05 00:00:00','2023-06-09 23:59:59')";
            $dsn = "pgsql:host=$host;port=$port;dbname=$database";
            $pdo = new PDO($dsn, $user, $password);
            // Configurar opciones adicionales si es necesario
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo 'Conexión exitosa a PostgreSQL';

            // Ejemplo de consulta
            $query = "INSERT INTO bursa.lista_baja_promecap (id, fondeador, fondeador_anterior, fecha_baja) VALUES ";

            foreach ($lstCreditos as $id) {
                $query .= '("' . $id . '", "CREDITO REAL", "PROMECAP", "' . $fechaActual . '"),';
            }

            $query = rtrim($query, ',');
            $query .= ';';

            $statement = $pdo->query($query);
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return response()->json(['success' => "Baja realizada correctamente"], 200);

        } catch (\Throwable $th) {
            return response()->json(['error' => $th], 400);

        }

    }
    public function etiquetadopromecapmambu(Request $request)
    {
        $mambu = $request->mambu;
        $jucavi = $request->jucavi;
        $curl = curl_init();
        try {
            // ------------------------------EMPIEZA ETIQUETADO MAMBU----------------------------------

            $host = 'fcontigo-rs-cluster-01.cdxtyqbdsp7d.us-east-1.redshift.amazonaws.com';
            $port = '5439';
            $database = 'mambu_prod';
            $user = 'marcadodev';
            $password = 'marcadoDev00';
            $dsn = "pgsql:host=$host;port=$port;dbname=$database";
            $pdo = new PDO($dsn, $user, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sqlStatement = "delete from mambu_prod.mambu_prod.creditos_excel_promecap;\n";

            foreach ($mambu as $item) {
                $sqlStatement .= "insert into mambu_prod.mambu_prod.creditos_excel_promecap (id_acuerdocredito) values ('" . $item . "');\n";
            }

            $statement = $pdo->query($sqlStatement);
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://fcetiquetado.azurewebsites.net/ProcesoBursa/api/EtiquetadoPromecapM/AltaPromecapMambu/843',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Cookie: ARRAffinity=f338cc84dcd26ef0541e10991beb3f601c2d1a0e9ced27dcfbc2140d4a6a8e25',
                ),
            ));

            $response = curl_exec($curl);

            // ------------------------------TERMINA ETIQUETADO MAMBU----------------------------------

            // ------------------------------EMPIEZA ETIQUETADO JUCAVI----------------------------------

            $hostODS = 'fcods.trafficmanager.net';
            $dbNameODS = 'clientes_ods';
            $userODS = 'hmonroy';
            $passwordODS = 'Monroy2011@';
            $portODS = 3306;
             // Conexión a la base de datos
            $pdoODS = new PDO("mysql:host=$hostODS;port=$portODS;dbname=$dbNameODS", $userODS, $passwordODS);


            $fechaActual = date("Y-m-d");
            $sqlStatementJucavi = "use cartera_ods; INSERT INTO d_etiquetado_previopromecap (ep_num_credito, ep_fecha_etiquetado,ep_fechamov) VALUES \n";

            $formattedFechaMov = date("Y-m-d", strtotime($fechaActual . "-1 day"));

            foreach ($jucavi as $id) {
                $sqlStatementJucavi .= '("' . $id . '", "' . $fechaActual . '", "' . $formattedFechaMov . '"),';
            }

            $sqlStatementJucavi = rtrim($sqlStatementJucavi, ',');
            $sqlStatementJucavi .= ';';

            $statementJucavi = $pdoODS->query($sqlStatementJucavi);
            $resultJucavi = $statementJucavi->fetchAll(PDO::FETCH_ASSOC);

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://fcetiquetado.azurewebsites.net/ProcesoBursa/api/EtiquetadoPromecapJ/AltaPromecapJV/843',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Cookie: ARRAffinity=f338cc84dcd26ef0541e10991beb3f601c2d1a0e9ced27dcfbc2140d4a6a8e25',
                ),
            ));

            $response2 = curl_exec($curl);

            // ------------------------------TERMINA ETIQUETADO JUCAVI----------------------------------

            return response()->json(['success' => "Etiquetado realizado correctamente"], 200);

        } catch (\Throwable $th) {
            return response()->json(["error" => $th]);
        }

        return $request;
    }
    public function blao_preetiequetado_mambu()
    {
        // PHP code
        try {

            $dayOfWeek = date('N');
            if ($dayOfWeek >= 6) {
                // Es fin de semana (sábado o domingo)
                return response()->json(['error' => 'No se realiza etiquetado con corte de fin de semana'], 400);
            } else {
                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'http://fcetiquetado.azurewebsites.net/ProcesoBursa/api/EtiquetadoBlaoM/PreetiquetadoBlaoMambu/',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'GET',
                    CURLOPT_HTTPHEADER => array(
                        'Cookie: ARRAffinity=f338cc84dcd26ef0541e10991beb3f601c2d1a0e9ced27dcfbc2140d4a6a8e25',
                    ),
                ));

                $response = curl_exec($curl);

                if (strpos($v[0], "Error") !== false) {
                    return response()->json(['error' => $v[0]], 400);

                } else {
                    return response()->json(['success' => $v[0]], 200);
                }
            }

        } catch (\Throwable $th) {
            echo $th;
        }

    }
    public function bajablaomambu(Request $request)
    {

        $fechaActual = date("Y-m-d");
        $lstCreditos = $request->baja;
        $strFondedor = "CREDITO REAL";
        $strFondeadorAnterior = "BLAO";

        try {
            // Conexion a mambu Prod
            $host = 'fcontigo-rs-cluster-01.cdxtyqbdsp7d.us-east-1.redshift.amazonaws.com';
            $port = '5439';
            $database = 'mambu_prod';
            $user = 'marcadodev';
            $password = 'marcadoDev00';

            $dsn = "pgsql:host=$host;port=$port;dbname=$database";
            $pdo = new PDO($dsn, $user, $password);
            // Configurar opciones adicionales si es necesario
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo 'Conexión exitosa a PostgreSQL';

            $queryValidaBaja = "select * from bursa.creditos_etiquetados" .
                " where fondeador = '" . $strFondedor . "'" .
                " and fondeadoranterior = '" . $strFondeadorAnterior . "'" .
                " and to_char(fechaetiquetado, 'YYYY-MM-DD') = '" . $fechaActual . "'";
            $statementValidaBaja = $pdo->query($queryValidaBaja);
            $resultValidaDia = $statementValidaBaja->fetchAll(PDO::FETCH_ASSOC);

            // Validar si es buen día para hacer baja

            $queryValidaDia = "call bursa.sp_validafechaejecucion(5, 'B','" . $fechaActual . "');";
            $statementValidaDia = $pdo->query($queryValidaDia);
            $resultValidaDia = $statementValidaDia->fetchAll(PDO::FETCH_ASSOC);
            if ($resultValidaDia[0]["strresult"] == "NO PROCEDE") {
                return response()->json(['error' => "Hoy no es un día para realizar la baja."], 400);
            } else {
                // Verifica si existe baja
                if ($resultValidaDia) {
                    $queryValidaBaja = "select * from bursa.creditos_etiquetados" .
                        " where fondeador = '" . $strFondedor . "'" .
                        " and fondeadoranterior = '" . $strFondeadorAnterior . "'" .
                        " and to_char(fechaetiquetado, 'YYYY-MM-DD') = '" . $fechaActual . "'";
                    $statementValidaBaja = $pdo->query($queryValidaBaja);
                    $resultValidaDia = $statementValidaBaja->fetchAll(PDO::FETCH_ASSOC);

                    if ($resultValidaDia != []) {
                        return response()->json(['error' => "La baja ya fue realizada."], 400);
                    } else {
                        // Se realizará la baja
                        $curl = curl_init();

                        curl_setopt_array($curl, array(
                            CURLOPT_URL => 'https://fcetiquetado.azurewebsites.net/ProcesoBursa/api/EtiquetadoBlaoJ/BajaPromecapBLaO/1/843',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'GET',
                            CURLOPT_HTTPHEADER => array(
                                'Cookie: ARRAffinity=f338cc84dcd26ef0541e10991beb3f601c2d1a0e9ced27dcfbc2140d4a6a8e25',
                            ),
                        ));

                        $response = curl_exec($curl);

                        return response()->json(['success' => $response], 200);

                    }

                }
            }

        } catch (\Throwable $th) {
            return response()->json(['error' => $th], 400);

        }

    }
    public function etiquetadoblaomambu(Request $request)
    {
        $mambu = $request->mambu;
        $jucavi = $request->jucavi;
        $curl = curl_init();
        try {
            // ------------------------------EMPIEZA ETIQUETADO MAMBU----------------------------------

            $host = 'fcontigo-rs-cluster-01.cdxtyqbdsp7d.us-east-1.redshift.amazonaws.com';
            $port = '5439';
            $database = 'mambu_prod';
            $user = 'marcadodev';
            $password = 'marcadoDev00';
            $dsn = "pgsql:host=$host;port=$port;dbname=$database";
            $pdo = new PDO($dsn, $user, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sqlStatement = "delete from mambu_prod.mambu_prod.creditos_excel_promecap;\n";

            foreach ($mambu as $item) {
                $sqlStatement .= "insert into mambu_prod.mambu_prod.creditos_excel_promecap (id_acuerdocredito) values ('" . $item . "');\n";
            }

            $statement = $pdo->query($sqlStatement);
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://fcetiquetado.azurewebsites.net/ProcesoBursa/api/EtiquetadoPromecapM/AltaPromecapMambu/843',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Cookie: ARRAffinity=f338cc84dcd26ef0541e10991beb3f601c2d1a0e9ced27dcfbc2140d4a6a8e25',
                ),
            ));

            $response = curl_exec($curl);

            // ------------------------------TERMINA ETIQUETADO MAMBU----------------------------------

            // ------------------------------EMPIEZA ETIQUETADO JUCAVI----------------------------------

            // $fechaActual = date("Y-m-d");
            // $sqlStatementJucavi = "use cartera_ods; INSERT INTO d_etiquetado_previopromecap (ep_num_credito, ep_fecha_etiquetado,ep_fechamov) VALUES \n";

            // $formattedFechaMov = date("Y-m-d", strtotime($fechaActual . "-1 day"));

            // foreach ($jucavi as $id) {
            //     $sqlStatementJucavi .= '("' . $id . '", "' . $fechaActual . '", "' . $formattedFechaMov . '"),';
            // }

            // $sqlStatementJucavi = rtrim($sqlStatementJucavi, ',');
            // $sqlStatementJucavi .= ';';

            // return $sqlStatementJucavi;

            // $statement = $pdo->query($query);
            // $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            // curl_setopt_array($curl, array(
            //     CURLOPT_URL => 'https://fcetiquetado.azurewebsites.net/ProcesoBursa/api/EtiquetadoPromecapJ/AltaPromecapJV/843',
            //     CURLOPT_RETURNTRANSFER => true,
            //     CURLOPT_ENCODING => '',
            //     CURLOPT_MAXREDIRS => 10,
            //     CURLOPT_TIMEOUT => 0,
            //     CURLOPT_FOLLOWLOCATION => true,
            //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            //     CURLOPT_CUSTOMREQUEST => 'GET',
            //     CURLOPT_HTTPHEADER => array(
            //         'Cookie: ARRAffinity=f338cc84dcd26ef0541e10991beb3f601c2d1a0e9ced27dcfbc2140d4a6a8e25',
            //     ),
            // ));

            // $response2 = curl_exec($curl);

            // ------------------------------TERMINA ETIQUETADO JUCAVI----------------------------------

            return response()->json(['success' => "Etiquetado realizado correctamente"], 200);

        } catch (\Throwable $th) {
            return response()->json(["error" => $th]);
        }

        return $request;
    }

    public function etiquetadomintos(Request $request)
    {
        return "Etquetado Mintos";

    }

    public function mintos_preetiquetado(Request $request)
    {
        try {
            // Conexion a mambu Prod
            $host = 'fcontigo-rs-cluster-01.cdxtyqbdsp7d.us-east-1.redshift.amazonaws.com';
            $port = '5439';
            $database = 'mambu_prod';
            $user = 'marcadodev';
            $password = 'marcadoDev00';

            $dsn = "pgsql:host=$host;port=$port;dbname=$database";
            $pdo = new PDO($dsn, $user, $password);
            // Configurar opciones adicionales si es necesario
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo 'Conexión exitosa a PostgreSQL';

            $sqlLista = "select distinct CVF_E4.value, L.id, L.encodedkey, c2.value, c3.value, CVF_E4.value, L.amount " .
                "from mambu_prod.lineofcredit L " .
                "join mambu_prod.loanaccount lo " .
                "on lo.lineofcreditkey = L.encodedkey " .
                "join mambu_prod.customfieldvalue c2 " .
                "ON c2.PARENTKEY = L.ENCODEDKEY AND c2.CUSTOMFIELDKEY = '8a4442f87ffa68db017ffba97fc44ed3' " .
                "join mambu_prod.customfield C " .
                "ON C.ENCODEDKEY = C2.CUSTOMFIELDKEY and c.type IN ('LINE_OF_CREDIT') " .
                "left JOIN mambu_prod.customfield as CF_E " .
                "ON CF_E.ID = '_Fecha_Etiquetado' " .
                "join mambu_prod.customfieldvalue c3 " .
                "ON c3.PARENTKEY = L.ENCODEDKEY AND c3.CUSTOMFIELDKEY = '8a442e697ddb93e7017dddbcc99720bf' " .
                "left JOIN mambu_prod.customfield as CF_E3 " .
                "ON CF_E3.ID = '_IdFondeador' " .
                "left JOIN mambu_prod.customfieldvalue AS CVF_E " .
                "ON CVF_E.CUSTOMFIELDKEY = CF_E.ENCODEDKEY and CVF_E.PARENTKEY = L.ENCODEDKEY " .
                "left join mambu_prod.mambu_prod.client cli " .
                "on L.clientkey = cli.encodedkey " .
                "left join mambu_prod.customfield as c4 " .
                "on c4.id = 'IdGrupo_Clients' " .
                "left JOIN mambu_prod.customfieldvalue AS CVF_E4 " .
                "on CVF_E4.parentkey=cli.encodedkey and CVF_E4.customfieldkey = c4.encodedkey " .
                "where c3.value = 'CREDITO REAL' " .
                "and L.amount between 194.80 and 2366722.60";

            $statementLista = $pdo->query($sqlLista);
            $posts = $statementLista->fetchAll(PDO::FETCH_ASSOC);

            // Inicia preetiquetado
            $fechaActual = date("Y-m-d");
            $postfields = '{
            "customInformation": [
                {
                    "customFieldID": "_fecha_preetiquetado",
                    "value": ' . $fechaActual . '
                },
                {
                    "customFieldID": "_IdFondeador",
                    "value": "MINTOS"
                }
            ]
        }';
            $curl = curl_init();
            foreach ($posts as $post) {
                $url = 'https://fcontigo.mambu.com/api/linesofcredit/' . $post["encodedkey"] . '/custominformation';

                curl_setopt_array($curl, array(
                    CURLOPT_URL => $url,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'PATCH',
                    CURLOPT_POSTFIELDS => $postfields,
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json',
                        'Authorization: Basic Y29uRm9uZGVhZG9yZXM6TjYjS3V0SEkhcA==',
                    ),
                ));

                $response = curl_exec($curl);
                return response()->json(['success' => "Preetiquetado realizado correctamente"], 200);
            }
        } catch (\Throwable $th) {
            return response()->json(['error' => $th], 401);
        }
    }

    public function preeliminarjucaviblao(Request $request)
    {

        // Reporte previo
        $lista = [];
        $fechaActual = date("Y-m-d");
        $fechaMenosUnDia = date("Y-m-d", strtotime("-1 day", strtotime($fechaActual))); // Resta un día a la fecha actual
        $lista = $this->getListaAltaBlaoJ($fechaMenosUnDia); //
        return $lista;

    }

    public function preetiquetadoblaojucavi(Request $request)
    {

        try {
            $host = 'fcods.trafficmanager.net';
            $dbName = 'clientes_ods';
            $user = 'hmonroy';
            $password = 'Monroy2011@';
            $port = 3306;
             // Conexión a la base de datos
            $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbName", $user, $password);


            $lstcreditos = $request->lstcreditos;
            return $lstcreditos;
            $dayOfWeek = date('N');
            $fechaActual = date("Y-m-d");
            if ($dayOfWeek >= 6) {
                // Es fin de semana (sábado o domingo)
                return response()->json(['error' => 'No se realiza etiquetado con corte de fin de semana.'], 400);
            } else {
                $strValidaCierre = $this->verificaEtiquetado($fechaActual, 17);
                if ($strValidaCierre == "Continua.") {

                    $sqlStatementJucaviBlao = "use cartera_ods; INSERT INTO d_etiquetado_previoblao (ep_num_credito, ep_fecha_etiquetado,ep_fechamov) VALUES  \n";

                    $formattedFechaMov = date("Y-m-d", strtotime($fechaActual . "-1 day"));

                    foreach ($lstcreditos as $id) {
                        $sqlStatementJucaviBlao .= '("' . $id . '", "' . $formattedFechaMov . '", "' . $fechaActual . '"),';
                    }

                    $sqlStatementJucaviBlao = rtrim($sqlStatementJucaviBlao, ',');
                    $sqlStatementJucaviBlao .= ';';

                    $statement = $pdo->query($sqlStatementJucaviBlao);
                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

                    return response()->json(['success' => "Preetiquetado enviado correctamente"], 200);

                } else {

                    return response()->json(['error' => 'El archivo con los créditos autorizados por ACFIN ya fueron enviados y etiquetados.'], 400);
                }

            }

        } catch (\Throwable $th) {
            return response()->json(['error' => $th], 400);
        }



    }

    public function bajablaojucavi(Request $request)
    {
        try {

            $lstcreditos = $request->lstcreditos;
            $fechaActual = date("Y-m-d");
            $queryValidaDia = "call bursa.sp_validafechaejecucion(5, 'B','" . $fechaActual . "');";
            $statementValidaDia = $pdo->query($queryValidaDia);
            $resultValidaDia = $statementValidaDia->fetchAll(PDO::FETCH_ASSOC);
            if ($resultValidaDia[0]["strresult"] == "NO PROCEDE") {
                return response()->json(['error' => "Hoy no es un día para realizar la baja."], 400);
            }else{
                $strValidaCierre = $this->validaBaja($fechaActual,1, 17);
                if ($strValidaCierre == "Continua.") {

                    $sqlStatementJucaviBlao = "use cartera_ods; INSERT INTO d_etiquetado_previoblao_baja (ep_num_credito, ep_fecha_etiquetado,ep_fechamov) VALUES  \n";

                    $formattedFechaMov = date("Y-m-d", strtotime($fechaActual . "-1 day"));

                    foreach ($lstcreditos as $id) {
                        $sqlStatementJucaviBlao .= '("' . $id . '", "' . $formattedFechaMov . '", "' . $fechaActual . '"),';
                    }

                    $sqlStatementJucaviBlao = rtrim($sqlStatementJucaviBlao, ',');
                    $sqlStatementJucaviBlao .= ';';

                    $statement = $pdo->query($sqlStatementJucaviBlao);
                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);



                    return response()->json(['success' => "Baja realizada correctamente correctamente"], 200);

                }else{
                    return response()->json(['error' => 'El archivo con los créditos autorizados por ACFIN ya fueron enviados y etiquetados.'], 400);
                }


            }

        } catch (\Throwable $th) {
            return response()->json(['error' => $th], 400);
        }

    }


    public function promecap_preetiequetado_jucavi()
    {
        // PHP code
        try {
            // Reporte previo
            $lista = [];
            $fechaActual = date("Y-m-d");
            $fechaMenosUnDia = date("Y-m-d", strtotime("-1 day", strtotime($fechaActual))); // Resta un día a la fecha actual
            $lista = $this->GetLitaAltaPromecapJ($fechaMenosUnDia); //
            return $lista;

        } catch (\Throwable $th) {
            echo $th;
        }

    }
    public function GetLitaAltaPromecapJ($fechaMenosUnDia)
    {

        // Conexion a ODS
        $host = 'fcods.trafficmanager.net';
        $dbName = 'clientes_ods';
        $user = 'hmonroy';
        $password = 'Monroy2011@';
        $port = 3306;

        try {
            // Conexión a la base de datos
            $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbName", $user, $password);

            // Preparar la consulta SQL
            ini_set('max_execution_time', 300);
            $query = "call clientes_ods.SP_ListaPrevioPromecapNuevo('" . $fechaMenosUnDia . "');";
            $statement = $pdo->prepare($query);

            // Ejecutar la consulta
            $statement->execute();

            // Obtener los resultados
            $posts = $statement->fetchAll(PDO::FETCH_ASSOC);

            return $posts;

            foreach ($posts as $post) {
                $nestedData["NoCredito"] = $post["NoCredito"];
                $nestedData["NoGrupo"] = $post["NoGrupo"];
                $nestedData["NoCiclo"] = $post["NoCiclo"];
                $nestedData["Monto"] = $post["Monto"];
                $nestedData["SaldoInsoluto"] = $post["SaldoInsoluto"];
                $nestedData["DiasMora"] = $post["DiasMora"];
                $nestedData["NoPlazos"] = $post["NoPlazos"];
                $nestedData["IVA"] = $post["IVA"];
                $nestedData["Estado"] = $post["Estado"];
                $nestedData["NoIntegrantes"] = $post["NoIntegrantes"];
                $nestedData["AddIntegrantes"] = $post["AddIntegrantes"];
                $dataList = $nestedData;
            }

            return $dataList;
        } catch (PDOException $e) {
            // Manejo de errores
            echo "Error: " . $e->getMessage();
        }

    }
    public function bajapromecapjucavi(Request $request)
    {
        $curl = curl_init();
        try {

            // Conexion a ODS
            $host = 'fcods.trafficmanager.net';
            $dbName = 'clientes_ods';
            $user = 'hmonroy';
            $password = 'Monroy2011@';
            $port = 3306;

            $lstcreditos = $request->jucavi;
            $fechaActual = date("Y-m-d");

            // Conexión a la base de datos
            $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbName", $user, $password);

            // Preparar la consulta SQL
            ini_set('max_execution_time', 300);

            $queryValidaDia = "SELECT pa_valor FROM clientes_ods.c_parametros WHERE pa_cve_param = 'FECHA_CIERRE';";
            $statementValidaDia = $pdo->query($queryValidaDia);
            $resultValidaDia = $statementValidaDia->fetchAll(PDO::FETCH_ASSOC);

            if ($resultValidaDia[0]["pa_valor"] == "") {
                return response()->json(['error' => "Hoy no es un día para realizar la baja."], 400);
            }else{
                $strFechaCierre = date("Y-m-d", strtotime("-1 day", strtotime($resultValidaDia[0]["pa_valor"])));

                $strValidaCierre = $this->validaBaja($strFechaCierre,1, 10);

                if ($strValidaCierre[0]["strResult"] == "Continua.") {

                    $sqlStatementJucaviPromecap = "use cartera_ods; INSERT INTO d_etiquetado_previopromecap_baja (ep_num_credito, ep_fecha_etiquetado,ep_fechamov) VALUES  \n";

                    $formattedFechaMov = date("Y-m-d", strtotime($fechaActual . "-1 day"));

                    foreach ($lstcreditos as $id) {
                        $sqlStatementJucaviPromecap .= '("' . $id . '", "' . $formattedFechaMov . '", "' . $fechaActual . '"),';
                    }

                    $sqlStatementJucaviPromecap = rtrim($sqlStatementJucaviPromecap, ',');
                    $sqlStatementJucaviPromecap .= ';';

                    $statement = $pdo->query($sqlStatementJucaviPromecap);
                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

                    curl_setopt_array($curl, array(
                        CURLOPT_URL => 'https://fcetiquetado.azurewebsites.net/ProcesoBursa/api/EtiquetadoPromecapJ/BajaPromecapJV/69',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'GET',
                        CURLOPT_HTTPHEADER => array(
                            'Cookie: ARRAffinity=f338cc84dcd26ef0541e10991beb3f601c2d1a0e9ced27dcfbc2140d4a6a8e25',
                        ),
                    ));

                    $response = curl_exec($curl);

                    return response()->json(['success' => "Baja realizada correctamente correctamente"], 200);

                }else{
                    return response()->json(['error' => 'El archivo con los créditos autorizados por ACFIN ya fueron enviados y etiquetados.'], 400);
                }
            }

        } catch (\Throwable $th) {
            return response()->json(['error' => $th], 400);
        }

    }
    public function getListaAltaBlaoJ($fecha)
    {

        // Conexion a ODS
        $host = 'fcods.trafficmanager.net';
        $dbName = 'clientes_ods';
        $user = 'hmonroy';
        $password = 'Monroy2011@';
        $port = 3306;

        try {
            // Conexión a la base de datos
            $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbName", $user, $password);

            // Preparar la consulta SQL
            $query = "call clientes_ods.SP_ListaPrevioBlao('" . $fecha . "');";
            $statement = $pdo->prepare($query);

            // Ejecutar la consulta
            $statement->execute();

            // Obtener los resultados
            $posts = $statement->fetchAll(PDO::FETCH_ASSOC);

            foreach ($posts as $post) {
                $nestedData["NoCredito"] = $post["NoCredito"];
                $nestedData["NoGrupo"] = $post["NoGrupo"];
                $nestedData["NoCiclo"] = $post["NoCiclo"];
                $nestedData["Monto"] = $post["Monto"];
                $nestedData["SaldoInsoluto"] = $post["SaldoInsoluto"];
                $nestedData["DiasMora"] = $post["DiasMora"];
                $nestedData["NoPlazos"] = $post["NoPlazos"];
                $nestedData["IVA"] = $post["IVA"];
                $nestedData["Estado"] = $post["Estado"];
                $nestedData["NoIntegrantes"] = $post["NoIntegrantes"];
                $nestedData["AddIntegrantes"] = $post["AddIntegrantes"];
                $dataList = $nestedData;
            }

            return $dataList;
        } catch (PDOException $e) {
            // Manejo de errores
            echo "Error: " . $e->getMessage();
        }

    }
    public function verificaEtiquetado($fecha, $fondeador)
    {

        // Conexion a ODS
        $host = 'fcods.trafficmanager.net';
        $dbName = 'clientes_ods';
        $user = 'hmonroy';
        $password = 'Monroy2011@';
        $port = 3306;

        try {
            // Conexión a la base de datos
            $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbName", $user, $password);

            // Preparar la consulta SQL
            $query = "call clientes_ods.SP_ValidaEtiquetado('" . $fecha . "',.$fondeador.);";
            $statement = $pdo->query($query);
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);


            return $result;
        } catch (PDOException $e) {
            // Manejo de errores
            echo "Error: " . $e->getMessage();
        }

    }
    public function validaBaja($fecha,$intFondeador,$intfondeadoranterior){
        // Conexion a ODS
        $host = 'fcods.trafficmanager.net';
        $dbName = 'clientes_ods';
        $user = 'hmonroy';
        $password = 'Monroy2011@';
        $port = 3306;

        try {
            // Conexión a la base de datos
            $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbName", $user, $password);

            // Preparar la consulta SQL
            $query = "call clientes_ods.SP_ValidaBaja('" . $fecha . "'," . $intFondeador . "," . $intfondeadoranterior . ");";

            $statement = $pdo->query($query);
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);


            return $result;
        } catch (PDOException $e) {
            // Manejo de errores
            echo "Error: " . $e->getMessage();
        }

   }

}
