<?php
require RESTpAPIABSPATH . '/classes/library/vendor/autoload.php';
require dirname(__FILE__, 3) . '/app/libs/artify/classes/Queryfy.php';

use Firebase\JWT\JWT;
use Firebase\JWT\JWK;
use Firebase\JWT\Key;
use Firebase\JWT\CachedKeySet;
use Firebase\JWT\BeforeValidException;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\SignatureInvalidException;

Class RESTpAPI {

    protected $settings;
    protected $currentLang;
    protected $langData;
    protected $errors;
    protected $message;
    protected $httpVersion = "HTTP/1.1";
    protected $operator = "=";
    protected $requestContentType;
    protected $responseContentType;
    protected $requestMethod;
    protected $statusCode;
    protected $callback;

    /**
     * Constructor 
     */
    public function __construct() {
        $this->initializeSettings();
        $this->loadLangData();
    }

    /**
     * Initialize Settings when object of class created, from the config.php settings
     */
    protected function initializeSettings() {
        global $config;
        $this->settings = $config;
    }

    protected function loadLangData() {
        $file = RESTpAPIABSPATH . '/languages/' . $this->currentLang . '.ini';
        if (!file_exists($file)) {
            $this->currentLang = "es";
            $file = RESTpAPIABSPATH . '/languages/' . $this->currentLang . '.ini';
        }

        $this->langData = parse_ini_file($file);
    }

    /**
     * Return language data
     * @param   string   $param                           Get data for language
     * return   sting                                     language translation for the parameter
     */
    protected function getLangData($param) {
        if (isset($this->langData[$param]))
            return $this->langData[$param];
        return $param;
    }

    /**
     * Set language data
     * @param   string   $param                          lanuguage key for which data needs to save
     * @param   string   $val                            Value for the language parameter
     * return   object                                   Object of class
     */
    public function setLangData($param, $val) {
        $this->langData[$param] = $val;
        return $this;
    }

    /**
     * Add callback function to be called on certain event
     * @param   string   $eventName                       Eventname for which callback function needs to be called
     * @param   string   $callback                        Name of callback function
     * return   object                                    Object of class
     */
    public function addCallback($eventName, $callback) {
        $this->callback[$eventName][] = $callback;
        return $this;
    }

    private function handleCallback($eventName, $data) {
        if (isset($this->callback[$eventName])) {
            foreach ($this->callback[$eventName] as $callback) {
                if (is_callable($callback))
                    return call_user_func($callback, $data, $this);
            }
        }
        return $data;
    }

    /**
     * Writes logs if enabled in config 
     * @param   string   $text                          error text
     * return   object                                  Object of class
     */
    public function writeLogs($text) {
        try {
            if ($this->settings["enableLogs"]) {
                if (is_array($text)) {
                    // Si $text es un array, conviértelo a una cadena antes de escribirlo en el archivo
                    $text = json_encode($text, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
                }
    
                $text = "\n" . date('Y-m-d H:i:s') . " " . $text;
                $handle = fopen($this->settings["logFile"], 'a+');
                fwrite($handle, $text);
                fclose($handle);
            }
        } catch (Exception $e) {
            
        }
        return $this;
    }

    /**
     * Set HTTP Header 
     * @param   string   $responseContentType                   Content type
     * @param   string   $statusCode                           Status code to be sent
     */
    public function setHttpHeaders($responseContentType = "", $statusCode = "") {
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            // Manejo de solicitudes preflight
            header("Access-Control-Allow-Origin: *");
            header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
            header("Access-Control-Allow-Headers: Authorization, Content-Type, X-Requested-With");
            http_response_code(200);
            exit();
        }
    
        // Validar y establecer el tipo de contenido
        $validFormats = ["application/json", "text/html", "application/xml"];
        if (!in_array($responseContentType, $validFormats)) {
            // Si el formato no es válido, usar JSON como predeterminado
            $responseContentType = "application/json";
        }
    
        // Establecer los encabezados de respuesta
        $statusMessage = $this->getHttpStatusMessage($statusCode);
        header($this->httpVersion . " " . $statusCode . " " . $statusMessage);
        header("Content-Type: " . $responseContentType);
    
        // Manejar encabezados adicionales (CORS)
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Authorization, Content-Type, X-Requested-With");
    }


    /**
     * encode response as HTML
     * @param   mixed   $responseData                   response data to be encoded
     * return   string                                  Outputs HTML as string
     */
    public function encodeHtml($responseData) {
        if($this->settings["encodeHtml"]){
            if (isset($this->settings["tableFormat"]) && $this->settings["tableFormat"] === "verticle") {
                $htmlResponse = "<table>";
                if (isset($responseData["data"]) && is_array($responseData["data"]) && count($responseData["data"])) {
                    foreach ($responseData["data"] as $data)
                        foreach ($data as $key => $value) {
                            $htmlResponse .= "<tr><td>" . $key . "</td><td>" . $value . "</td></tr>";
                        }
                }
                $htmlResponse .= "</table>";
            } else {
                $htmlResponse = "<table>";
                if (isset($responseData["data"]) && is_array($responseData["data"]) && count($responseData["data"])) {
                    $htmlResponse .= "<tr>";
                    foreach ($responseData["data"][0] as $key => $value) {
                        $htmlResponse .= "<th>" . $key . "</th>";
                    }
                    $htmlResponse .= "</tr>";

                    foreach ($responseData["data"] as $data) {
                        $htmlResponse .= "<tr><td>" . implode("</td><td>", $data) . "</td></tr>";
                    }
                }
                $htmlResponse .= "</table>";
            }
            return $htmlResponse;
        }
    }

    /**
     * encode response as JSON
     * @param   mixed   $responseData                  response data to be encoded
     * return   json                                   Outputs JSON
     */
    public function encodeJson($responseData) {
        $jsonResponse = json_encode($responseData, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->addError("Error al codificar JSON: " . json_last_error_msg());
            return json_encode(["error" => "Error interno del servidor"]);
        }
        return $jsonResponse;
    }


    /**
     * encode response as XML
     * @param   mixed   $responseData                  response data to be encoded
     * return   xml                                   Outputs XMS
     */
    public function encodeXml($responseData) {
        $xml = new SimpleXMLElement('<?xml version="1.0"?><table></table>');
        if (isset($responseData["data"]) && is_array($responseData["data"]) && count($responseData["data"])) {
            foreach ($responseData["data"] as $data)
                foreach ($data as $key => $value) {
                    $xml->addChild($key, $value);
                }
        }
        return $xml->asXML();
    }

    /**
     * get http status message based on status code
     * @param   int   $statusCode                       status code
     * return   string                                  status message 
     */
    public function getHttpStatusMessage($statusCode) {
        $httpStatus = array(
            100 => 'Continue',
            101 => 'Switching Protocols',
            200 => 'OK',
            201 => 'Created',
            202 => 'Accepted',
            203 => 'Non-Authoritative Information',
            204 => 'No Content',
            205 => 'Reset Content',
            206 => 'Partial Content',
            300 => 'Multiple Choices',
            301 => 'Moved Permanently',
            302 => 'Found',
            303 => 'See Other',
            304 => 'Not Modified',
            305 => 'Use Proxy',
            306 => '(Unused)',
            307 => 'Temporary Redirect',
            400 => 'Bad Request',
            401 => 'Unauthorized',
            402 => 'Payment Required',
            403 => 'Forbidden',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            406 => 'Not Acceptable',
            407 => 'Proxy Authentication Required',
            408 => 'Request Timeout',
            409 => 'Conflict',
            410 => 'Gone',
            411 => 'Length Required',
            412 => 'Precondition Failed',
            413 => 'Request Entity Too Large',
            414 => 'Request-URI Too Long',
            415 => 'Unsupported Media Type',
            416 => 'Requested Range Not Satisfiable',
            417 => 'Expectation Failed',
            500 => 'Internal Server Error',
            501 => 'Not Implemented',
            502 => 'Bad Gateway',
            503 => 'Service Unavailable',
            504 => 'Gateway Timeout',
            505 => 'HTTP Version Not Supported');
        return ($httpStatus[$statusCode]) ? $httpStatus[$statusCode] : $httpStatus[500];
    }

    public function render() {
        if ($this->validateRequest()) {
            $this->statusCode = 100;
            $this->requestContentType = $this->getRequestContentType();
            $this->responseContentType = $this->getResponseContentType();
            $this->requestMethod = $this->getRequestMethod();
            $data = $this->getRequestData($this->requestContentType, $this->requestMethod);
            if ($this->validateInputData($data, $this->requestMethod)) {
                $data = $this->cleanInputData($data);
                $output = $this->handleRequest($data["op"], $data);
                $this->setHttpHeaders($this->responseContentType, $this->statusCode);
                $output = $this->getOutputResponse($output, $this->responseContentType);
                echo $output;
            } else {
                $this->responseContentType = $this->getResponseContentType();
                $output = $this->getResponse();
                $output = $this->getOutputResponse($output, $this->responseContentType);
                echo $output;
            }
        } else {
            $this->statusCode = 401;
            $this->setHttpHeaders($this->responseContentType, $this->statusCode);
            $this->responseContentType = $this->getResponseContentType();
            $output = $this->getResponse();
            $output = $this->getOutputResponse($output, $this->responseContentType);
            echo $output;
        }
    }

    public function validateRequest() {
        if (isset($this->settings["blockIPs"]) && is_array($this->settings["blockIPs"]) && count($this->settings["blockIPs"])) {
            if (!$this->blockAccessByIPs()) {
                $this->message = $this->getLangData("access_not_allowed");
                return false;
            }
        }

        if (isset($this->settings["allowedIPs"]) && is_array($this->settings["allowedIPs"]) && count($this->settings["allowedIPs"])) {
            if (!$this->allowAccessByIPs()) {
                $this->message = $this->getLangData("access_not_allowed");
                return false;
            }
        }

        if (isset($this->settings["enableJWTAuth"]) && $this->settings["enableJWTAuth"]) {
            if (isset($_SERVER['QUERY_STRING'])) {
                parse_str($_SERVER['QUERY_STRING'], $param);
                if(isset($param["op"]) && strtolower($param["op"]) === "jwtauth") return true;
            }
            if (!$this->validateJWT()) {
                $this->message = $this->getLangData("access_not_allowed");
                return false;
            }
        }

        return true;
    }

    public function getRequestContentType() {
        $requestContentType = isset($_SERVER['CONTENT_TYPE']) ? $_SERVER['CONTENT_TYPE'] : "json";
        
        if (strpos($requestContentType, 'json') !== false) {
            return "json";
        } else if (strpos($requestContentType, 'x-www-form-urlencoded') !== false) {
            return "array";
        } else if (strpos($requestContentType, 'html') !== false) {
            return "html";
        } else {
            return "json";
        }
    }    

    public function getResponseContentType() {
        $responseContentType = isset($_SERVER['HTTP_ACCEPT']) ? $_SERVER['HTTP_ACCEPT'] : null;
    
        if ($responseContentType !== null) {
            // Verifica si 'application/json' está presente en la cadena
            if (strpos($responseContentType, 'application/json') !== false) {
                return "json";
            }
            // Verifica si 'text/html' está presente en la cadena
            else if (strpos($responseContentType, 'text/html') !== false) {
                return "html";
            }
            // Verifica si 'application/xml' está presente en la cadena
            else if (strpos($responseContentType, 'application/xml') !== false) {
                return "xml";
            }
        }
    
        // Si no coincide con ninguno de los tipos anteriores, devuelve el valor predeterminado
        return $this->settings["defaultResponseType"];
    }    
    

    public function getRequestData($requestContentType, $method) {
        $data = array();
        if (strtoupper($method) === "GET") {
            $data["op"] = "select";
        } else if (strtoupper($method) === "POST") {
            $data["op"] = "insert";
        } else if (strtoupper($method) === "PUT") {
            $data["op"] = "update";
        } else if (strtoupper($method) === "DELETE") {
            $data["op"] = "delete";
        }

        if (isset($_GET["path"])) {
            $path = trim($_GET["path"], "/");
            $param = explode('/', $path);
            $data = $this->getPrettyURLParam($data, $param);
        }
        if (isset($_SERVER["PATH_INFO"])) {
            $path = trim($_SERVER["PATH_INFO"], "/");
            $param = explode('/', $path);
            $data = $this->getPrettyURLParam($data, $param);
        }

        if (strtoupper($method) === "GET") {
            if (isset($_SERVER['QUERY_STRING'])) {
                parse_str($_SERVER['QUERY_STRING'], $param);
                $data = array_merge($data, $param);
            }
        } else {
            if (isset($_SERVER['QUERY_STRING'])) {
                parse_str($_SERVER['QUERY_STRING'], $param);
                $data = array_merge($data, $param);
            }
            $postedData = file_get_contents('php://input');
            if ($postedData) {
                if ($requestContentType === "json") {
                    $data = array_merge($data, json_decode($postedData, true, 512, JSON_UNESCAPED_UNICODE));
                } else if ($requestContentType === "array") {
                    parse_str($postedData, $postVar);
                    $data = array_merge($data, $postVar);
                }
            }
        }
        return $data;
    }

    public function getPrettyURLParam($data, $param) {
        $paramIndex = 0;
        if (isset($param[$paramIndex]) && !empty($param[$paramIndex])) {
            $data["table"] = trim($param[$paramIndex], "/");
            $paramIndex++;
        }
        if (isset($param[$paramIndex]) && !empty($param[$paramIndex]) && isset($param[$paramIndex + 1]) && !empty($param[$paramIndex + 1])) {
            $key = $param[$paramIndex];
            $val = $param[$paramIndex + 1];
            $op = "eq";
            $where = array($key, $val, $op);
            $data["where"] = array(implode(",", $where));
        } else if (isset($param[$paramIndex]) && !empty($param[$paramIndex]) && !isset($param[$paramIndex + 1])) {
            $queryfy = $this->getQueryfyObj();
            $pk = $queryfy->primaryKey($data["table"]);
            if ($pk) {
                $key = $pk;
                $val = $param[$paramIndex];
                $op = "eq";
                $where = array($key, $val, $op);
                $data["where"] = array(implode(",", $where));
            }
        }
        return $data;
    }

    public function getOutputResponse($output, $responseContentType) {
        switch ($responseContentType) {
            case "json": return $this->encodeJson($output);
                break;
            case "html": return $this->encodeHtml($output);
                break;
            case "xml": return $this->encodeXml($output);
                break;
        }
    }

    public function handleRequest($operationType, $data) {
        switch (strtolower($operationType)) {
            case "insert" : return $this->dbInsert($data);
                break;
            case "update" : return $this->dbUpdate($data);
                break;
            case "select" : return $this->dbSelect($data);
                break;
            case "delete" : return $this->dbDelete($data);
                break;
            case "query" : return $this->dbQuery($data);
                break;
            case "droptable" : return $this->dbDropTable($data);
                break;
            case "renametable" : return $this->dbRenameTable($data);
                break;
            case "truncatetable" : return $this->dbTruncateTable($data);
                break;
            case "primarykey" : return $this->dbPrimaryKey($data);
                break;
            case "tables" : return $this->dbAllDBTables($data);
                break;
            case "columns" : return $this->dbGetColumns($data);
                break;
            case "jwtauth" : return $this->dbJWTAuth($data);
                break;
        }
    }

    public function dbInsert($data) {

        if (!isset($data["data"])) {
            // Si no existe, se agrega un error y se devuelve una respuesta con el estado 400 (Bad Request)
            $this->statusCode = 400;
            $this->message = "Error: Los datos para insertar no están presentes.";
            return $this->getResponse(null);
        }

        $data = $this->handleCallback('before_insert', $data);
        $queryfy = $this->getQueryfyObj();
        $queryfy->insert($data["table"], $data["data"]);
        $lastInsertId = $queryfy->lastInsertId;
        if ($queryfy->rowsChanged > 0) {
            $this->statusCode = 201;
            $this->message = $this->getLangData("success");
        } else {
            $this->statusCode = 500;
            $this->message = $this->getLangData("error");
            $this->addError($queryfy->error);
        }
        $response = $this->getResponse($lastInsertId);
        $response = $this->handleCallback('after_insert', $response);
        return $response;
    }

    public function dbUpdate($data) {

        if (!isset($data["data"])) {
            // Si no existe, se agrega un error y se devuelve una respuesta con el estado 400 (Bad Request)
            $this->statusCode = 400;
            $this->message = "Error: Los datos para actualizar no están presentes.";
            return $this->getResponse(null);
        }

        $data = $this->handleCallback('before_update', $data);
        $queryfy = $this->getQueryfyObj();
        $queryfy = $this->applyParameter($queryfy, $data);
        $queryfy->update($data["table"], $data["data"]);
        if ($queryfy->rowsChanged > 0) {
            $this->statusCode = 200;
            $this->message = $this->getLangData("success");
        } else {
            $this->statusCode = 500;
            $this->message = $this->getLangData("error");
            $this->addError($queryfy->error);
        }
        $response = $this->getResponse($queryfy->rowsChanged);
        $response = $this->handleCallback('after_update', $response);
        return $response;
    }

    public function dbSelect($data) {

        if (!isset($data['table'])) {
            $this->message = $this->getLangData("missing_table");
            $this->statusCode = 400; // Código de estado 400 para Bad Request
            $this->addError("Table name is missing in the request data.");
            $this->setHttpHeaders($this->responseContentType, $this->statusCode);
            return $this->getResponse([]);
        }
        
        $data = $this->handleCallback('before_select', $data);

        $queryfy = $this->getQueryfyObj();
        $queryfy = $this->applyParameter($queryfy, $data);
        $result = $queryfy->select($data["table"]);
        if ($queryfy->totalRows > 0) {
            $this->message = $this->getLangData("success");
            $this->statusCode = 200;
        } else {
            $this->message = $this->getLangData("no_data");
            $this->statusCode = 404;
            $this->addError($queryfy->error);
            $this->setHttpHeaders($this->responseContentType, $this->statusCode);
        }
        $response = $this->getResponse($result);
        $response = $this->handleCallback('after_select', $response);

        return $response;
    }

    public function dbDelete($data) {

        if (!isset($data["data"])) {
            // Si no existe, se agrega un error y se devuelve una respuesta con el estado 400 (Bad Request)
            $this->statusCode = 400;
            $this->message = "Error: Los datos para eliminar no están presentes.";
            return $this->getResponse(null);
        }

        $data = $this->handleCallback('before_delete', $data);
        $queryfy = $this->getQueryfyObj();
        $queryfy = $this->applyParameter($queryfy, $data);
        $queryfy->delete($data["table"]);
        if ($queryfy->rowsChanged > 0) {
            $this->statusCode = 200;
            $this->message = $this->getLangData("success");
        } else {
            $this->statusCode = 500;
            $this->message = $this->getLangData("error");
            $this->addError($queryfy->error);
        }
        $response = $this->getResponse($queryfy->rowsChanged);
        $response = $this->handleCallback('after_delete', $response);
        return $response;
    }

    public function dbQuery($data) {
        if ($this->settings["allowQueryExecution"]) {
            $data = $this->handleCallback('before_query', $data);
            $queryfy = $this->getQueryfyObj();
            $queryfy = $this->applyParameter($queryfy, $data);
            if (isset($data["values"]) && is_array($data["values"]) && count($data["values"]))
                $result = $queryfy->executeQuery($data["sql"], $data["values"]);
            else
                $result = $queryfy->executeQuery($data["sql"]);

            if ($queryfy->totalRows > 0) {
                $this->message = $this->getLangData("success");
                $this->statusCode = 200;
            } else {
                $this->message = $this->getLangData("no_data");
                $this->statusCode = 404;
                $this->setHttpHeaders($this->responseContentType, $this->statusCode);
                $this->addError($queryfy->error);
            }
        } else {
            $this->message = $this->getLangData("access_not_allowed");
            $this->statusCode = "500";
            $this->setHttpHeaders($this->responseContentType, $this->statusCode);
            $this->addError($queryfy->error);
        }
        $response = $this->getResponse($result);
        $response = $this->handleCallback('after_query', $response);
        return $response;
    }

    public function dbDropTable($data) {
        $queryfy = $this->getQueryfyObj();
        if ($queryfy->dropTable($data["table"]) > 0) {
            $this->statusCode = 200;
            $this->message = $this->getLangData("success");
        } else {
            $this->statusCode = 500;
            $this->message = $this->getLangData("error");
            $this->addError($queryfy->error);
        }
        return $this->getResponse();
    }

    public function dbRenameTable($data) {
        $queryfy = $this->getQueryfyObj();
        if ($queryfy->renameTable($data["table"], $data["newtable"]) > 0) {
            $this->statusCode = 200;
            $this->message = $this->getLangData("success");
        } else {
            $this->statusCode = 500;
            $this->message = $this->getLangData("error");
            $this->addError($queryfy->error);
        }
        return $this->getResponse();
    }

    public function dbTruncateTable($data) {
        $queryfy = $this->getQueryfyObj();
        if ($queryfy->truncateTable($data["table"]) > 0) {
            $this->statusCode = 200;
            $this->message = $this->getLangData("success");
        } else {
            $this->statusCode = 500;
            $this->message = $this->getLangData("error");
        }
        return $this->getResponse();
    }

    public function dbPrimaryKey($data) {
        $queryfy = $this->getQueryfyObj();
        $primaryKey = $queryfy->primaryKey($data["table"]);
        if (!empty($primaryKey)) {
            $this->statusCode = 200;
            $this->message = $this->getLangData("success");
        } else {
            $this->statusCode = 500;
            $this->message = $this->getLangData("error");
            $this->addError($queryfy->error);
        }
        return $this->getResponse($primaryKey);
    }

    public function dbAllDBTables($data) {
        $data = $this->handleCallback('before_dbtable', $data);
        $queryfy = $this->getQueryfyObj();
        $queryfy = $this->applyParameter($queryfy, $data);
        $result = $queryfy->getAllTables();
        if (is_array($result) && count($result) > 0) {
            $this->message = $this->getLangData("success");
            $this->statusCode = 200;
        } else {
            $this->message = $this->getLangData("no_data");
            $this->statusCode = 404;
            $this->setHttpHeaders($this->responseContentType, $this->statusCode);
            die();
        }
        $response = $this->getResponse($result);
        $response = $this->handleCallback('after_dbtable', $response);
        return $response;
    }

    public function dbGetColumns($data) {
        $data = $this->handleCallback('before_getcol', $data);
        $queryfy = $this->getQueryfyObj();
        $queryfy = $this->applyParameter($queryfy, $data);
        $result = $queryfy->columnNames($data["table"]);
        if (is_array($result) && count($result) > 0) {
            $this->message = $this->getLangData("success");
            $this->statusCode = 200;
        } else {
            $this->message = $this->getLangData("no_data");
            $this->statusCode = 404;
            $this->setHttpHeaders($this->responseContentType, $this->statusCode);
            $this->addError($queryfy->error);
        }
        $response = $this->getResponse($result);
        $response = $this->handleCallback('after_getcol', $response);
        return $response;
    }
    
    public function dbJWTAuth($data) {
        $data = $this->handleCallback('before_jwt_auth', $data);
        $queryfyObj = $this->getQueryfyObj();
        $queryfyObj = $this->applyParameter($queryfyObj, $data);
        $userPassword = "";
        $encryptPassword = isset($this->settings["encryptPassword"]) ? strtolower($this->settings["encryptPassword"]) : "";

        if (isset($data["data"])) {
            foreach ($data["data"] as $col => $val) {
                if (isset($this->settings["passwordFieldName"]) && $col === $this->settings["passwordFieldName"]) {
                    // Solo encriptar si $encryptPassword no está vacío
                    if (!empty($encryptPassword)) {
                        $originalPassword = $val; // Guardar la contraseña original para verificarla después
                        $val = $this->encryptPassword($val);
                        if ($encryptPassword === "bcrypt") {
                            continue; // Si es bcrypt, no agregar la contraseña encriptada al where
                        }
                    }
                }

                $queryfyObj->where($col, $val);
            }
        }

        $result = $queryfyObj->select($data["table"]);
        $encoded = "";
        $verifyPassword = true;

        // Verificar contraseña solo si se usa bcrypt y hay resultados
        if ($encryptPassword === "bcrypt" && !empty($result) && isset($result[0][$this->settings["passwordFieldName"]])) {
            $verifyPassword = password_verify($originalPassword, $result[0][$this->settings["passwordFieldName"]]);
        }

        if ($queryfyObj->totalRows > 0 && $verifyPassword) {
            require_once RESTpAPIABSPATH . 'library/php-jwt-master/src/JWT.php';

            // Verificar que los campos críticos existen en la configuración
            $userIdFieldName = $this->settings["userIdFieldName"] ?? null;
            $secretKey = $this->settings["secretkey"] ?? null;
            $issuer = $this->settings["iss"] ?? null;
            $expTime = $this->settings["expTime"] ?? 3600; // Valor predeterminado de 1 hora

            if (!$userIdFieldName || !$secretKey || !$issuer) {
                $this->message = $this->getLangData("invalid_configuration");
                $this->statusCode = 500;
                return false;
            }

            $userId = $result[0][$userIdFieldName] ?? null;

            try {
                $payload = [
                    'iss' => $issuer,
                    'iat' => time(),
                    'nbf' => time(), // El token es válido inmediatamente
                    'exp' => time() + $expTime, // El token expira después de expTime segundos
                    'userId' => $userId
                ];
                
                $encoded = JWT::encode($payload, $secretKey, 'HS256');
                $this->message = $this->getLangData("success");
                $this->statusCode = 200;
            } catch (Exception $e) {
                $this->message = $this->getLangData("token_generation_failed");
                $this->statusCode = 500;
                return false;
            }
        } else {
            $this->message = $this->getLangData("no_data");
            $this->statusCode = 404;
            $this->addError($queryfyObj->error ?? "No matching records found.");
            $this->setHttpHeaders($this->responseContentType, $this->statusCode);
        }

        $response = $this->getResponse($encoded);
        $response = $this->handleCallback('after_jwt_auth', $response);
        return $response;
    }
    
    public function encryptPassword($val) {
        if (isset($this->settings["encryptPassword"]) && !empty($this->settings["encryptPassword"])) {
            if (strtolower($this->settings["encryptPassword"]) === "bcrypt") {
                return $val;
            } else {
                return $this->settings["encryptPassword"]($val);
            }
        }
        return $val;
    }

    public function getQueryfyObj() {
        $queryfy = new Queryfy();
        if ($queryfy->connect($this->settings["hostname"], $this->settings["username"], $this->settings["password"], $this->settings["database"], $this->settings["dbtype"], $this->settings["characterset"])) {
            return $queryfy;
        } else {
            $this->addError($this->getLangData("db_connection_error"));
            die();
        }
    }

    protected function applyParameter($queryfy, $data) {
        if (isset($data["where"])) {
            if (is_string($data["where"]))
                $data["where"] = array($data["where"]);

            foreach ($data["where"] as $where) {
                $wh = explode(",", $where);
                $op = (isset($wh[2])) ? $this->getOperator($wh[2]) : "=";
                if (isset($wh[0]) && isset($wh[1]) && !empty($wh[0]) && !empty($wh[1])) {
                    $col = trim($wh[0]);
                    $val = trim($wh[1]);
                    if ($op === "IN" || $op === "NOT IN" || $op === "BETWEEN") {
                        $val = explode($this->settings["valueSeparator"], $wh[1]);
                    }
                    $queryfy->where($col, $val, $op);
                }
                if (isset($wh[3]) && !empty($wh[3])) {
                    $queryfy->andOrOperator = $wh[3];
                }
                if (isset($wh[4]) && !empty($wh[4])) {
                    if (strtolower($wh[4]) === "ob" || strtolower($wh[4]) === "(") {
                        $queryfy->openBrackets = "(";
                    }
                    if (strtolower($wh[4]) === "cb" || strtolower($wh[4]) === ")") {
                        $queryfy->closedBrackets = ")";
                    }
                }
            }
        }

        if (isset($data["columns"])) {
            if (is_array($data["columns"]) && count($data["columns"]))
                $queryfy->columns = $data["columns"];
            else if (is_string($data["columns"]))
                $queryfy->columns = explode(",", $data["columns"]);
        }

        if (isset($data["orderby"])) {
            if (is_array($data["orderby"]) && count($data["orderby"]))
                $queryfy->orderByCols = $data["orderby"];
            else if (is_string($data["orderby"]))
                $queryfy->orderByCols = explode(",", $data["orderby"]);
        }

        if (isset($data["groupby"])) {
            if (is_array($data["groupby"]) && count($data["groupby"]))
                $queryfy->groupByCols = $data["groupby"];
            else if (is_string($data["groupby"]))
                $queryfy->groupByCols = explode(",", $data["groupby"]);
        }

        if (isset($data["having"]) && is_array($data["having"]) && count($data["groupby"])) {
            if (is_array($data["having"]) && count($data["having"]))
                $queryfy->havingCondition = $data["having"];
            else if (is_string($data["having"]))
                $queryfy->havingCondition = explode(",", $data["having"]);
        }

        if (isset($data["limit"])) {
            $queryfy->limit = $data["limit"];
        }

        return $queryfy;
    }

    protected function getOperator($op) {
        switch (strtolower(trim($op))) {
            case "eq": return "=";
                break;
            case "neq": return "!=";
                break;
            case "in": return "IN";
                break;
            case "nin": return "NOT IN";
                break;
            case "lt": return "<";
                break;
            case "le": return "<=";
                break;
            case "gt": return ">";
                break;
            case "ge": return ">=";
                break;
            case "bt": return "BETWEEN";
                break;
            case "lk": return "LIKE";
                break;
            default : return "=";
        }
    }

    protected function getResponse($data = array()) {
        $response = array(
            "mensaje" => $this->message,
            "error" => $this->getErrors(),
            "data" => $data
        );

        if ($this->settings["enableLogs"]) {
            if (!empty($this->getErrors()))
                $this->writeLogs($this->getErrors());
            else if (!empty($this->message))
                $this->writeLogs($this->message);
        }

        $this->setHttpHeaders($this->responseContentType, $this->statusCode);
        return $response;
    }

    protected function cleanInputData($data) {
        if (isset($data["data"])) {
            foreach ($data["data"] as $key => $val)
                if (is_string($val)) {
                    $val = htmlspecialchars($val, ENT_NOQUOTES, 'UTF-8');
                }
            $data["data"][$key] = $val;
        }
        return $data;
    }

    protected function validateInputData($data, $method) {
        if (!isset($data["op"]) || !isset($data["op"])) {
            $this->statusCode = 400;
            $this->setHttpHeaders($this->responseContentType, $this->statusCode);
            $this->message = $this->getLangData("invalid_format");
            return false;
        }
        if (isset($data["table"]) && isset($this->settings["blockTables"]) && !empty($data["table"]) && in_array($data["table"], $this->settings["blockTables"])) {
            $this->statusCode = 500;
            $this->setHttpHeaders($this->responseContentType, $this->statusCode);
            $this->message = $this->getLangData("access_not_allowed");
            return false;
        }
        $operation = $data["op"];
        return $this->actionFilter($operation, $method);
    }

    public function actionFilter($operation, $method) {
        $actionFilter = true;
        switch (strtolower($operation)) {
            case "insert":
                if (strtoupper($method) !== "POST")
                    $actionFilter = false;
                break;
            case "update":
                if (strtoupper($method) !== "PUT")
                    $actionFilter = false;
                break;
            case "delete":
                if (strtoupper($method) !== "DELETE")
                    $actionFilter = false;
                break;
            case "select":
                if (strtoupper($method) !== "GET")
                    $actionFilter = false;
                break;
        }
        if (!$actionFilter) {
            $this->statusCode = "405";
            $this->setHttpHeaders($this->responseContentType, $this->statusCode);
            $this->message = $this->getLangData("invalid_request_type");
            return false;
        }

        return $actionFilter;
    }

    public function getRequestMethod() {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method === 'POST' && array_key_exists('HTTP_X_HTTP_METHOD', $_SERVER)) {
            if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'DELETE') {
                $method = 'DELETE';
            } else if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'PUT') {
                $method = 'PUT';
            } else {
                $this->statusCode = 500;
                $this->message = $this->getLangData("unexpected_header");
                return false;
            }
        }
        return $method;
    }

    public function blockAccessByIPs() {
        $blockIPs = $this->settings["blockIPs"];
        if (in_array($_SERVER['REMOTE_ADDR'], $blockIPs) || (isset($_SERVER["HTTP_X_FORWARDED_FOR"]) && in_array($_SERVER["HTTP_X_FORWARDED_FOR"], $blockIPs))) {
            $this->statusCode = 403;
            $this->setHttpHeaders($this->responseContentType, $this->statusCode);
            $this->message = $this->getLangData("access_not_allowed");
            return false;
        }
    }

    public function allowAccessByIPs() {
        $allow = $this->settings["allowedIPs"];
        if (!in_array($_SERVER['REMOTE_ADDR'], $allow)) {
            $this->statusCode = 403;
            $this->setHttpHeaders($this->responseContentType, $this->statusCode);
            $this->message = $this->getLangData("access_not_allowed");
            return false;
        }
    }

    public function validateJWT()
    {
        $jwt = "";
        if (isset($_SERVER["HTTP_AUTHORIZATION"])) {
            $authorizationHeader = $_SERVER["HTTP_AUTHORIZATION"];
            $bearerPrefix = 'Bearer ';

            if (strpos($authorizationHeader, $bearerPrefix) !== false) {
                $jwt = trim(substr($authorizationHeader, strlen($bearerPrefix)));
            }
        } else {
            $header = apache_request_headers();
            if (isset($header["Authorization"])) {
                $authorizationHeader = $header["Authorization"];
                $bearerPrefix = 'Bearer ';

                if (strpos($authorizationHeader, $bearerPrefix) !== false) {
                    $jwt = trim(substr($authorizationHeader, strlen($bearerPrefix)));
                }
            }
        }

        if (!empty($jwt)) {
            try {
                $decoded = JWT::decode($jwt, new Key($this->settings["secretkey"], 'HS256'));
                return true;
            } catch (ExpiredException $e) {
                return false;
            } catch (UnexpectedValueException $e){
                return false;
            }
        }

        return false;
    }


    protected function addError($error, $override = false) {
        $this->errors[] = $error;

        if ($override) {
            echo $error;
            die();
        }
    }

    protected function getErrors() {
        return $this->errors;
    }

}