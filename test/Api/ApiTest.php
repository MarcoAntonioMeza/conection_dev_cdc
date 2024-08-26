<?php

namespace RCCFS\Simulacion\MX\Client;

use \GuzzleHttp\Client;

use \RCCFS\Simulacion\MX\Client\Configuration;
use \RCCFS\Simulacion\MX\Client\ApiException;
use \RCCFS\Simulacion\MX\Client\ObjectSerializer;
use \RCCFS\Simulacion\MX\Client\Api\RCCFSApi as Instance;
use \RCCFS\Simulacion\MX\Client\Model\CatalogoEstados;
use \RCCFS\Simulacion\MX\Client\Model\PersonaPeticion;
use \RCCFS\Simulacion\MX\Client\Model\DomicilioPeticion;

class ApiTest extends \PHPUnit_Framework_TestCase
{  

    public function setUp()
    {
        $config = new Configuration();
        $config->setHost('https://services.circulodecredito.com.mx/sandbox/v2/rccficoscore/');
        $client = new Client();
        $this->apiInstance = new Instance($client, $config);
        $this->x_api_key = "your_x_api_key";
        $this->x_full_report = '';
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
            print_r($result);
            $this->assertTrue($result->getFolioConsulta()!==null);

            return $result->getFolioConsulta();
        } catch (Exception $e) {
            echo 'Exception when calling RCCFS\Simulacion\MXApi->getReporte: ', $e->getMessage(), PHP_EOL;
        }
    }
}