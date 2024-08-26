<?php

namespace RCCFS\Simulacion\MX\Client\Model;
use \RCCFS\Simulacion\MX\Client\ObjectSerializer;

class CatalogoMoneda
{
    
    const MX = 'MX';
    const US = 'US';
    const UD = 'UD';
    
    
    public static function getAllowableEnumValues()
    {
        return [
            self::MX,
            self::US,
            self::UD,
        ];
    }
}
