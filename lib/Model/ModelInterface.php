<?php

namespace RCCFS\Simulacion\MX\Client\Model;

interface ModelInterface
{
    
    public function getModelName();
    
    public static function RCCFSTypes();
    
    public static function RCCFSFormats();
    
    public static function attributeMap();
    
    public static function setters();
    
    public static function getters();
    
    public function listInvalidProperties();
    
    public function valid();
}
