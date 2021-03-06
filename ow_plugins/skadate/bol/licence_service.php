<?php

/**
 * Copyright (c) 2014, Skalfa LLC
 * All rights reserved.
 * 
 * ATTENTION: This commercial software is intended for exclusive use with SkaDate Dating Software (http://www.skadate.com) and is licensed under SkaDate Exclusive License by Skalfa LLC.
 * 
 * Full text of this license can be found at http://www.skadate.com/sel.pdf
 */
final class SKADATE_BOL_LicenceService
{
    /**
     * Singleton instance.
     *
     * @var SKADATE_BOL_LicenceService
     */
    private static $classInstance;

    /**
     * Returns an instance of class (singleton pattern implementation).
     *
     * @return SKADATE_BOL_Service
     */
    public static function getInstance()
    {
        if ( self::$classInstance === null )
        {
            self::$classInstance = new self();
        }

        return self::$classInstance;
    }

    /**
     * Constructor.
     */
    private function __construct()
    {
        
    }

    public function validateKey()
    {
        $licenseKey = OW::getConfig()->getValue('skadate', 'license_key');

        if ( empty($licenseKey) )
        {
            $licenseKey = "invalid_key";
        }

        $result = array();

        try
        {
            $result = $this->checkLicenseKey($licenseKey);
        }
        catch ( LogicException $e )
        {
            return;
        }

        if ( isset($result['licenseValid']) )
        {
            OW::getConfig()->saveConfig('skadate', 'license_key_valid', (bool) $result['licenseValid']);
        }

        $brandRemoval = false;

        if ( isset($result['brandingRemoval']) )
        {
            $brandRemoval = (bool) $result['brandingRemoval'];
        }

        OW::getConfig()->saveConfig('skadate', 'license_info', json_encode($result));
        OW::getConfig()->saveConfig('skadate', 'brand_removal', $brandRemoval);
    }

    /**
     * @param string $licenseKey
     * @throws LogicException
     * @return mixed
     */
    public function checkLicenseKey( $licenseKey )
    {
        if ( empty($licenseKey) )
        {
            $licenseKey = "empty_license_key";
        }

        $curl = curl_init();
        $url = parse_url(OW_URL_HOME);
        $paramsString = json_encode(array('bundleName' => 'skadate', 'licenseKey' => $licenseKey, 'domain' => $url['host'], 'dir' => OW_DIR_ROOT));
        $url = BOL_PluginService::UPDATE_SERVER . 'validate-bundle-license-key?params=' . urlencode($paramsString);
        $options = array(
            CURLOPT_PORT => 80,
            CURL_HTTP_VERSION_1_1 => true,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
        );

        curl_setopt_array($curl, $options);

        if ( !$curl )
        {
            throw new LogicException("CURL init error");
        }

        $result = curl_exec($curl);

        $connectionError = curl_error($curl);
        curl_close($curl);

        if ( $connectionError )
        {
            throw new LogicException($connectionError);
        }

        if ( !$result )
        {
            $data = file_get_contents($url);

            if ( $data )
            {
                $result = $data;
            }
        }

        $result = json_decode($result, true);

        if ( !isset($result['result']) )
        {
            throw new LogicException("Invalid server response");
        }

        return $result;
    }
}
