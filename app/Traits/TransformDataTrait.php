<?php
namespace App\Traits;

trait TransformDataTrait
{
    public static $oCollection;
    
    protected static $aIdToData;
    
    protected static $aDataToId;
    
    protected static $sDataKey = 'name';
    
    public static function setDataKey($sKey)
    {
       static::$sDataKey = $sKey;
    }
    
    public static function setupData($oModel)
    {
        if(empty(static::$aIdToData) || empty(static::$aDataToId))
        {
            if(in_array('SoftDeletingTrait', class_uses_recursive(__CLASS__)))
            {
                static::$oCollection = $oModel::withTrashed()->get();
            }
            else
            {
                static::$oCollection = $oModel::all();
            }
             
            foreach(static::$oCollection as $oModel)
            {
                static::$aIdToData[$oModel->id] = $oModel->{static::$sDataKey};
                static::$aDataToId[$oModel->{static::$sDataKey}] = $oModel->id;
            }
        }
    }
    
    public function __get($sValue)
    {
        if(substr($sValue, -4) === ucfirst(strtolower(static::$sDataKey)))
        {
            $sNewValue = substr($sValue, 0, -4);
            $sNewValue = snake_case($sNewValue, '-');
             
            if(!isset(static::$aDataToId[$sNewValue]))
            {
                return null;
            }
            return isset(static::$aIdToData[static::$aDataToId[$sNewValue]]) ? static::$aIdToData[static::$aDataToId[$sNewValue]] : null;
        }
        else
        {
            $sValue = snake_case($sValue, '-');
            return isset(static::$aDataToId[$sValue]) ? static::$aDataToId[$sValue] : null;
        }
    }
    
    public static function getIdToData()
    {
        return static::$aIdToData;
    }
    
    public static function getDataToId()
    {
        return static::$aDataToId;
    }
}