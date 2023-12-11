<?php
require_once('CountryClass.php');
$areaObj = new Area();
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET)) {
        $actionby = $_GET['actionby'];
        $index = $_GET['index'];
        switch ($actionby) {
            case 'area':
                $areaObj->deleteArea($index);
            case 'city':
                $areaObj->deleteCity($index);
                break;
            case 'state':
                $areaObj->deleteState($index);
                break;
            case 'country':
                $areaObj->deleteCountry($index);
                break;
            case 'ucountry':
                $index = $_GET['index'];
                $updated_country = $_GET['updatedcountry'];
                $updated_country_code = $_GET['updatedcountrycode'];
                $areaObj->updateCountry($index, $updated_country, $updated_country_code);
                break;
            case 'ustate':
                $index = $_GET['index'];
                $state = $_GET['state'];
                $statecode = $_GET['statecode'];
                $countryId = $_GET['countryId'];
                // echo $index, $state, $statecode, $countryId;
                $areaObj->updateState($index, $state, $statecode, $countryId);
                break;
            case 'ucity':
                $index = $_GET['index'];
                $city = $_GET['city'];
                $citycode = $_GET['citycode'];
                $countryId = $_GET['countryId'];
                $stateId = $_GET['stateId'];
                // echo 'index' . $index, 'city' . $city, 'citycode' . $citycode, 'cid' . $countryId, 'sid' . $stateId;
                $areaObj->updateCity($index, $city, $citycode, $countryId, $stateId);
                break;
            case 'uarea':
                $index = $_GET['index'];
                $area = $_GET['area'];
                $areacode = $_GET['areacode'];
                $cityId = $_GET['cityId'];
                $stateId = $_GET['stateId'];
                $countryId = $_GET['countryId'];
                echo $index, $area, $areacode, $cityId, $stateId, $countryId;
                $areaObj->updateArea($index, $area, $areacode, $cityId, $stateId, $countryId);
                break;

        }
    }
}
?>