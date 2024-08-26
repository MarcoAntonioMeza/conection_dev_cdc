<?php

//require 'vendor/autoload.php';  // Asegúrate de cargar el autoload de Composer si usas Composer
require '../../vendor/autoload.php';


use \GuzzleHttp\Client;

use \RCCFS\Simulacion\MX\Client\Configuration;
use \RCCFS\Simulacion\MX\Client\ApiException;
use \RCCFS\Simulacion\MX\Client\ObjectSerializer;
use \RCCFS\Simulacion\MX\Client\Api\RCCFSApi as Instance;
use \RCCFS\Simulacion\MX\Client\Model\CatalogoEstados;
use \RCCFS\Simulacion\MX\Client\Model\PersonaPeticion;
use \RCCFS\Simulacion\MX\Client\Model\DomicilioPeticion;

class ApiTest
{

    public function setUp()
    {
        $config = new Configuration();
        $config->setHost('https://services.circulodecredito.com.mx/sandbox/v2/rccficoscore/');
        $client = new Client();
        $this->apiInstance = new Instance($client, $config);
        $this->x_api_key = "Hxg6ihfb0SGtFuBHxh7MchEG3eyvUKAV";
        $this->x_full_report = 'true';
    }

    public function testGetReporte()
    {
        $estado = new CatalogoEstados();
        $nacionalidad = new CatalogoEstados();
        $request = new PersonaPeticion();
        $domicilio = new DomicilioPeticion();

        $request->setApellidoPaterno("SESENTAYDOS");
        $request->setApellidoMaterno("PRUEBA");
        $request->setApellidoAdicional(null);
        $request->setPrimerNombre("JUAN");
        $request->setSegundoNombre(null);
        $request->setFechaNacimiento("1965-08-09");
        $request->setRfc("SEPJ650809JG1");
        $request->setCurp(null);
        $request->setNacionalidad("MX");
        $request->setResidencia(null);
        $request->setEstadoCivil(null); 
        $request->setSexo(null);
        $request->setClaveElectorIfe(null);
        $request->setNumeroDependientes(null);
        $request->setFechaDefuncion(null);

        $domicilio->setDireccion("PASADISO ENCONTRADO 58");
        $domicilio->setColoniaPoblacion("MONTEVIDEO");
        $domicilio->setDelegacionMunicipio("GUSTAVO A MADERO");
        $domicilio->setCiudad("CIUDAD DE MÉXICO");
        $domicilio->setEstado($estado::CDMX);
        $domicilio->setCp("07730");
        $domicilio->setFechaResidencia(null);
        $domicilio->setNumeroTelefono(null);
        $domicilio->setTipoDomicilio(null);
        $domicilio->setTipoAsentamiento(null);
        $request->setDomicilio($domicilio);

        try {
            $result = $this->apiInstance->getReporte($this->x_api_key, $request);

            // Utiliza ObjectSerializer para convertir el objeto a un formato serializable
            $sanitizedResult = ObjectSerializer::sanitizeForSerialization($result);

            $response = [
                'code' => 202,
                'data' => $sanitizedResult,
            ];

            return json_encode($response);
        } catch (Exception $e) {
            $response = [
                'code' => $e->getCode(),
                'message' => $e->getMessage()  // El mensaje es ya un string
            ];

            return json_encode($response);  // No necesitas ObjectSerializer aquí
        }
    }
}




header("Content-Type: application/json");  // Establece el tipo de contenido a JSON

// Solo permitir solicitudes POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);  // Método no permitido
    echo json_encode(['code'=>10, 'error' => 'Método no permitido. Solo se permite POST.']);
    exit;
}

// Leer y decodificar los datos de la solicitud POST
$input = json_decode(file_get_contents('php://input'), true);

if (!$input) {
    http_response_code(400);  // Solicitud incorrecta
    echo json_encode(['code'=>10,   'error' => 'Datos de entrada no válidos']);
    exit;
}



$api = new ApiTest();
$api->setUp();
echo $api->testGetReporte();
