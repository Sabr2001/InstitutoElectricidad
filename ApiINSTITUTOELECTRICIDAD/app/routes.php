<?php

declare(strict_types=1);

use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

include "../public/conexion.php";

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        return $response;
    });

    
    //Metodo para validar conexion 
    $app->get('/', function (Request $request, Response $response) {
        // Que se vea TODO mientras desarrollas
        error_reporting(E_ALL);
        ini_set('display_errors', '1');

        // 1) Verificar que conexion() exista
        if (!function_exists('conexion')) {
            $response->getBody()->write(json_encode([
                'ok'    => false,
                'error' => 'La función conexion() NO está definida. Revisa require_once de conexion.php'
            ], JSON_PRETTY_PRINT));
            return $response
                ->withStatus(500)
                ->withHeader('Content-Type', 'application/json');
        }

        try {
            $db = conexion();

            $row = $db->GetRow("SELECT DATABASE() AS db, NOW() AS ahora");
            $db->Close();

            $response->getBody()->write(json_encode([
                'ok'   => true,
                'info' => $row
            ], JSON_PRETTY_PRINT));
            return $response->withHeader('Content-Type', 'application/json');
        } catch (\Throwable $e) {
            // Cualquier excepción/fatal la devolvemos en JSON legible
            $response->getBody()->write(json_encode([
                'ok'    => false,
                'error' => $e->getMessage(),
                'file'  => $e->getFile(),
                'line'  => $e->getLine()
            ], JSON_PRETTY_PRINT));
            return $response
                ->withStatus(500)
                ->withHeader('Content-Type', 'application/json');
        }
    });

    //-----------------------CRUD PERMISOS--------------------------//
        $app->post('/guardarPermiso', function (Request $request, Response $response) {
            $fila = $request->getQueryParams();
            $db = conexion();
            $res = $db->AutoExecute("permisos", $fila, "INSERT");
            $db->Close();
            $response->getBody()->write(strval($res));
            return $response;
        });

        $app->put('/modificarPermiso', function (Request $request, Response $response) {
            $fila = $request->getQueryParams();
            $id = $fila["id"];
            $db = conexion();
            $res = $db->AutoExecute("permisos", $fila, "UPDATE", "id=$id");
            $db->Close();
            $response->getBody()->write(strval($res));
            return $response;
        });

        $app->delete('/borrarPermiso', function (Request $request, Response $response) {
            $response->getBody()->write('Borrando....');
            return $response;
        });

        $app->delete('/borrarPermiso/{id}', function (Request $request, Response $response, $args) {
            $id = $args['id'];
            $sql = "DELETE FROM permisos WHERE id=$id";
            $db = conexion();
            $res = $db->Execute($sql);
            $db->Close();
            $response->getBody()->write(strval(boolval($res)));
            return $response;
        });

        $app->get('/obtenertodosPermisos', function (Request $request, Response $response) {
            $sql = "SELECT * FROM permisos";
            $db = conexion();
            $db->SetFetchMode(ADODB_FETCH_ASSOC);
            $res = $db->GetAll($sql);
            $db->Close();
            $response->getBody()->write((json_encode($res)));
            return $response;
        });

        $app->get('/obtenerpermisoxid/{id}', function (Request $request, Response $response, $args) {
            $id = $args['id'];
            $sql = "SELECT * FROM permisos where id=$id";
            $db = conexion();
            $db->SetFetchMode(ADODB_FETCH_ASSOC);
            $res = $db->GetRow($sql);
            $db->Close();
            $response->getBody()->write((json_encode($res)));
            return $response;
        });
    //---------------------- Fin CRUD PERMISOS ---------------------//

    //-----------------------CRUD USUARIOS---------------------------//
        $app->post('/guardarUsuario', function (Request $request, Response $response) {
            $fila = $request->getQueryParams();
            $db = conexion();
            $res = $db->AutoExecute("usuarios", $fila, "INSERT");
            $db->Close();
            $response->getBody()->write(strval($res));
            return $response;
        });

        $app->put('/modificarUsuario', function (Request $request, Response $response) {
            $fila = $request->getQueryParams();
            $id = $fila["id"];
            $db = conexion();
            $res = $db->AutoExecute("usuarios", $fila, "UPDATE", "id=$id");
            $db->Close();
            $response->getBody()->write(strval($res));
            return $response;
        });

        $app->delete('/borrarUsuario/{id}', function (Request $request, Response $response, $args) {
            $id = $args['id'];
            $sql = "DELETE FROM usuarios WHERE id=$id";
            $db = conexion();
            $res = $db->Execute($sql);
            $db->Close();
            $response->getBody()->write(strval(boolval($res)));
            return $response;
        });

        $app->get('/obtenertodosUsuarios', function (Request $request, Response $response) {
            $sql = "SELECT * FROM usuarios";
            $db = conexion();
            $db->SetFetchMode(ADODB_FETCH_ASSOC);
            $res = $db->GetAll($sql);
            $db->Close();
            $response->getBody()->write((json_encode($res)));
            return $response;
        });

        $app->get('/obtenerusuarioxid/{id}', function (Request $request, Response $response, $args) {
            $id = $args['id'];
            $sql = "SELECT * FROM usuarios where id=$id";
            $db = conexion();
            $db->SetFetchMode(ADODB_FETCH_ASSOC);
            $res = $db->GetRow($sql);
            $db->Close();
            $response->getBody()->write((json_encode($res)));
            return $response;
        });
    //---------------------Fin CRUD USUARIOS-------------------------//


    //---------------- AGRUPACIONES --------------------------------//
        $app->get('/permisosPorEstado', function (Request $request, Response $response) {
            $sql = "SELECT habilitado, COUNT(*) AS total FROM permisos GROUP BY habilitado";
            $db = conexion();
            $db->SetFetchMode(ADODB_FETCH_ASSOC);
            $res = $db->GetAll($sql);
            $db->Close();
            $response->getBody()->write(json_encode($res));
            return $response;
        });

        $app->get('/permisosPorNombre', function (Request $request, Response $response) {
            $sql = "SELECT nombrePermiso, COUNT(*) AS total FROM permisos GROUP BY nombrePermiso";
            $db = conexion();
            $db->SetFetchMode(ADODB_FETCH_ASSOC);
            $res = $db->GetAll($sql);
            $db->Close();
            $response->getBody()->write(json_encode($res));
            return $response;
        });

        $app->get('/permisosPorDescripcion', function (Request $request, Response $response) {
            $sql = "SELECT descripcion, COUNT(*) AS total FROM permisos GROUP BY descripcion";
            $db = conexion();
            $db->SetFetchMode(ADODB_FETCH_ASSOC);
            $res = $db->GetAll($sql);
            $db->Close();
            $response->getBody()->write(json_encode($res));
            return $response;
        });

        $app->get('/buscarPermisosPorNombre/{texto}', function (Request $request, Response $response, $args) {
            $texto = $args['texto'];
            $sql = "SELECT * FROM permisos WHERE nombrePermiso LIKE ?";
            $db = conexion();
            $db->SetFetchMode(ADODB_FETCH_ASSOC);
            $res = $db->GetAll($sql, array('%' . $texto . '%'));
            $db->Close();
            $response->getBody()->write(json_encode($res));
            return $response;
        });
    //----------------Fin Agrupaciones ----------------------------//


    // --------------------Inicio LOGIN ----------------------------//
        $app->post('/login', function (Request $request, Response $response) {

            $params = $request->getParsedBody();
            $usuario = $params['correo'] ?? null;
            $clave   = $params['password'] ?? null;

            if (!$usuario || !$clave) {
                $payload = [
                    "success" => false,
                    "message" => "Faltan datos"
                ];
                $response->getBody()->write(json_encode($payload));
                return $response->withHeader('Content-Type', 'application/json');
            }

            $db = conexion();
            $db->SetFetchMode(ADODB_FETCH_ASSOC);

            $sql = "SELECT * FROM usuarios_ice WHERE correo = ? AND `password` = ?";
            $row = $db->GetRow($sql, [$usuario, $clave]);

            $db->Close();

            if ($row) {
                $payload = [
                    "success" => true,
                    "message" => "Login correcto",
                    "usuario" => $row
                ];
            } else {
                $payload = [
                    "success" => false,
                    "message" => "Credenciales incorrectas"
                ];
            }

            $response->getBody()->write(json_encode($payload));
            return $response->withHeader('Content-Type', 'application/json');
        });
    //---------------------Fin Login -------------------------------//

    //---------------------Inicio Lecturas-------------------------//
        $app->post('/guardarLectura/{nise}', function (Request $request, Response $response, $args) {
            $fila = $request->getQueryParams();
            $nise = $args['nise'];
            $fila['nise'] = $nise;
            $db = conexion();
            $res = $db->AutoExecute("lecturas", $fila, "INSERT");
            $db->Close();
            $response->getBody()->write(strval($res));
            return $response;
        });

        $app->put('/editLectura/{id}', function (Request $request, Response $response,  $args) {
            $fila = $request->getQueryParams();
            $id = $args['id'];
            $db = conexion();
            $res = $db->AutoExecute("lecturas", $fila, "UPDATE", "id=$id");
            $db->Close();
            $response->getBody()->write(strval($res));
            return $response;
        });

        $app->delete('/borrarLectura', function (Request $request, Response $response) {
            $response->getBody()->write('Borrando....');
            return $response;
        });

        $app->get('/obtenerLecturasByNise/{nise}', function (Request $request, Response $response, $args) {
            $nise = $args['nise'];
            $sql = "SELECT * FROM lecturas where nise=$nise";
            $db = conexion();
            $db->SetFetchMode(ADODB_FETCH_ASSOC);
            $res = $db->GetAll($sql);
            $db->Close();
            $response->getBody()->write((json_encode($res)));
            return $response;
        });
    //---------------------Fin Lecturas ---------------------------//


    // --------------------Modulo de formulario de consultas -------------------//
        // recibe el correo del usuario, lo busca en la tabla clientes y devuleve el NISE asociado
        $app->post('/enviarContacto', function ($request, $response) {

            $params = $request->getParsedBody();
            $db = conexion();
            if (empty($params['nise']) || empty($params['correo']) || empty($params['asunto']) || empty($params['descripcion'])) {
                $response->getBody()->write(json_encode(["error" => "Faltan datos obligatorios."]));
                return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
            }
            // Validar que el NISE esté registrado en la base de datos
            $cliente = $db->GetRow("SELECT * FROM clientes WHERE nise=?", [$params['nise']]);

            if (!$cliente) {
                $response->getBody()->write(json_encode(["error" => "El NISE ingresado no existe en el sistema."]));
                return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
            }

            $insertData = [
                'nise' => $params['nise'],
                'periodo_consultado' => $params['periodo'] ?? null,
                'tipo' => $params['tipo'],
                'asunto' => $params['asunto'],
                'descripcion' => $params['descripcion'],
                'correo_remitente' => $params['correo'],
                'telefono_contacto' => $params['telefono'] ?? null,
                'estado' => 'RECIBIDA'
            ];

            $success = $db->AutoExecute("contacto", $insertData, "INSERT");

            $response->getBody()->write(json_encode(["success" => (bool)$success]));
            return $response->withHeader('Content-Type', 'application/json');
        });
    // --------------------fin formulario de consultas ------------------------//

    // --------------------inicio formulario de facturas ----------------------//
        // recibe el correo del usuario
        $app->get('/getClienteByCorreo', function ($req, $res) {
            $correo = $_GET["correo"] ?? null;
            if (!$correo) {
                $res->getBody()->write(json_encode(["error" => "No se recibió el correo"]));
                return $res->withHeader('Content-Type', 'application/json')->withStatus(400);
            }

            $db = conexion();
            $row = $db->GetRow("SELECT nise FROM clientes WHERE email=?", [$correo]);
            $res->getBody()->write(json_encode($row ?: ["nise" => null]));
            return $res->withHeader('Content-Type', 'application/json');
        });
        // Recibe el NISE y el periodo, busca la factura y devuelve la informacion del cliente y la factura
        $app->get('/getFactura', function ($req, $res) {
            $nise = $_GET["nise"] ?? null;
            $periodo = $_GET["periodo"] ?? null;
            if (!$nise || !$periodo) {
                $res->getBody()->write(json_encode(["error" => "Datos incompletos"]));
                return $res->withHeader('Content-Type', 'application/json')->withStatus(400);
            }
            // conexion a la base de datos y busqueda de la factura
            $db = conexion();
            $factura = $db->GetRow("SELECT * FROM facturas WHERE nise=? AND periodo=?", [$nise, $periodo]);
            if (!$factura) {
                $res->getBody()->write(json_encode(["error" => "No se encontró factura para ese mes."]));
                return $res->withHeader('Content-Type', 'application/json');
            }
            // si se encuentra la factura, se busca la informacion del cliente
            $cliente = $db->GetRow("SELECT c.*, p.nombre AS provincia FROM clientes c 
                JOIN provincias p ON c.provincia_id=p.id WHERE nise=?", [$nise]);
            $resultado = [
                "cliente" => $cliente,
                "factura" => $factura
            ];
            $res->getBody()->write(json_encode($resultado));
            return $res->withHeader('Content-Type', 'application/json');
        });

    // --------------------fin formulario de facturas ------------------------//


    // --------------------Modulo de consulta para graficos -------------------//
        $app->get('/consumoMes', function (Request $request, Response $response) {
            $sql = "SELECT 
                    p.nombre AS provincia,
                    SUM(l.consumo_kWh) AS total_consumo
                FROM lecturas l
                JOIN provincias p ON p.id = l.provincia_id
                WHERE (l.fecha_lectura) >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)
                GROUP BY p.id, p.nombre
                ORDER BY p.nombre";

            $db = conexion();
            $db->SetFetchMode(ADODB_FETCH_ASSOC);
            $res = $db->GetAll($sql);
            $db->Close();

            $response->getBody()->write(json_encode($res));
            return $response;
        });

        $app->get('/consumoTrimestre', function (Request $request, Response $response) {
            $sql = "SELECT 
                    p.nombre AS provincia,
                    SUM(l.consumo_kWh) AS total_consumo
                FROM lecturas l
                JOIN provincias p ON p.id = l.provincia_id
                WHERE l.fecha_lectura >= DATE_SUB(CURDATE(), INTERVAL 3 MONTH)
                GROUP BY p.id, p.nombre
                ORDER BY p.nombre";

            $db = conexion();
            $db->SetFetchMode(ADODB_FETCH_ASSOC);
            $res = $db->GetAll($sql);
            $db->Close();

            $response->getBody()->write(json_encode($res));
            return $response;
        });

        $app->get('/consumoSemestre', function (Request $request, Response $response) {
            $sql = "SELECT 
                    p.nombre AS provincia,
                    SUM(l.consumo_kWh) AS total_consumo
                FROM lecturas l
                JOIN provincias p ON p.id = l.provincia_id
                WHERE l.fecha_lectura >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH)
                GROUP BY p.id, p.nombre
                ORDER BY p.nombre";

            $db = conexion();
            $db->SetFetchMode(ADODB_FETCH_ASSOC);
            $res = $db->GetAll($sql);
            $db->Close();

            $response->getBody()->write(json_encode($res));
            return $response;
        });

        $app->get('/consumoAnual', function (Request $request, Response $response) {
            $sql = "SELECT 
                    p.nombre AS provincia,
                    SUM(l.consumo_kWh) AS total_consumo
                FROM lecturas l
                JOIN provincias p ON p.id = l.provincia_id
                WHERE l.fecha_lectura >= DATE_SUB(CURDATE(), INTERVAL 12 MONTH)
                GROUP BY p.id, p.nombre
                ORDER BY p.nombre";

            $db = conexion();
            $db->SetFetchMode(ADODB_FETCH_ASSOC);
            $res = $db->GetAll($sql);
            $db->Close();

            $response->getBody()->write(json_encode($res));
            return $response;
        });



    // --------------------fin de consulta para graficos consumo  ------------------------//

};
