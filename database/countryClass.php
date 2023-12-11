<?php
include("connection.php");
class Country extends Connection
{
    protected $tablename;
    function __construct()
    {
        parent::__construct();
    }
    // check repeated country
    public function repeatedCountry($country)
    {
        $query = $this->conn->prepare("select * from countries where country_name = ? ");
        $query->execute([$country]);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        if (count($result) > 0) {
            return true;
        }
        return false;
    }
    // store country
    public function storeCountry($country, $countrycode)
    {
        try {
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = $this->conn->prepare("insert into countries (country_name,country_code) values (?,?)");
            $query->execute([$country, $countrycode]);
        } catch (PDOException $e) {
            echo "" . $e->getMessage();
        }
    }
    // return countries data
    public function getCountries()
    {
        try {
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = $this->conn->prepare("select * from countries");
            $query->execute();
            $countries = $query->fetchAll(PDO::FETCH_ASSOC);

            return $countries;
        } catch (PDOException $e) {
            echo 'Error getting country name and country code' . $e->getMessage();
        }
    }
    // delete country
    public function deleteCountry($country)
    {
        $query = $this->conn->prepare("delete from countries where country_id = ?");
        $query->execute([$country]);

    }
    public function updateCountry($index, $updated_country, $updated_country_code)
    {
        $query = $this->conn->prepare("update countries set country_name =?,country_code =? where country_id = ?");
        $query->execute([$updated_country, $updated_country_code, $index]);

    }
}
class State extends Country
{
    protected $tablename;
    protected $countrylist;
    protected $countryId;
    function __construct()
    {
        parent::__construct();
        $this->tablename = "states";
    }
    public function repeatedState($state)
    {
        $query = $this->conn->prepare("select * from states where state_name = ? ");
        $query->execute([$state]);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        if (count($result) > 0) {
            return true;
        }
        return false;
    }
    // return statetable
    public function getStateTable()
    {
        $query = $this->conn->prepare("select * from states inner join countries on states.country_id = countries.country_id order by state_id ");
        $query->execute();
        $statedata = $query->fetchAll(PDO::FETCH_ASSOC);
        return $statedata;
    }
    // return states of selected country
    public function selectedStates($selectedCountry)
    { echo $selectedCountry;
        // exit();
        $query = $this->conn->prepare('select * from states inner join countries on states.country_id = countries.country_id where states.country_id = ?');
        $query->execute([$selectedCountry]);
        $statedata = $query->fetchAll(PDO::FETCH_ASSOC);
        return $statedata;
    }
    // store state data
    public function storeState($state, $statecode, $CountryId)
    {
        $query = $this->conn->prepare("insert into states (state_name,state_code,country_id) values (?,?,?)");
        $query->execute([$state, $statecode, $CountryId]);
    }
    // delete states
    public function deleteState($stateid)
    {
        $query = $this->conn->prepare("delete from states where state_id = ?");
        $query->execute([$stateid]);

    }
    // update
    public function updateState($index, $updated_state, $updated_state_code, $country_Id)
    {
        $query = $this->conn->prepare("update states set state_name =?,state_code =? , country_id=? where state_id = ?");
        $query->execute([$updated_state, $updated_state_code, $country_Id, $index]);
        if ($query) {
            echo "state Updated";
        }
        ;

    }
}
class City extends State
{
    protected $tablename = 'cities';
    protected $countryId;
    function __construct()
    {
        parent::__construct();
        $this->tablename = "cities";

    }
    // check repeated cities
    public function repeatedCity($city)
    {
        $query = $this->conn->prepare("select * from cities where city_name = ? ");
        $query->execute([$city]);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        if (count($result) > 0) {
            return true;
        }
        return false;
    }
    // return table data
    public function getCities()
    {
        $query = $this->conn->prepare("select * from $this->tablename inner join states on cities.state_id = states.state_id inner join countries on states.country_id = countries.country_id order by city_id");
        $query->execute();
        $statedata = $query->fetchAll(PDO::FETCH_ASSOC);
        return $statedata;
    }
    // return selectedcities
    public function selectedCities($selectedCity)
    {
        $query = $this->conn->prepare('select * from cities inner join states on cities.state_id = states.state_id inner join countries on countries.country_id = states.country_id where cities.state_id = ?');
        $query->execute([$selectedCity]);
        $citydata = $query->fetchAll(PDO::FETCH_ASSOC);
        return $citydata;
    }
    //   store cities
    public function storeCity($city, $citycode, $stateId, $countryId)
    {
        $query = $this->conn->prepare("insert into $this->tablename  (city_name,city_code,state_id,country_id) values (?,?,?,?)");
        $query->execute([$city, $citycode, $stateId, $countryId]);
    }
    // delete city
    public function deleteCity($cityid)
    {
        $query = $this->conn->prepare("delete from  $this->tablename where city_id = ?");
        $result = $query->execute([$cityid]);
        if ($result) {
            return true;
        }
        return false;
    }
    public function updateCity($index, $city, $citycode, $countryId, $stateId)
    {
        $query = $this->conn->prepare("update cities set city_name = ? , city_code = ? , state_id= ?, country_id= ?  where city_id = ? ");
        $query->execute([$city, $citycode, $stateId, $countryId, $index]);
        if ($query) {
            echo "city Updated";
        }
        ;
    }
}
class Area extends City
{
    function __construct()
    {
        parent::__construct();

    }
    function repeatedArea($area)
    {
        $query = $this->conn->prepare("select * from area where area_name = ? ");
        $query->execute([$area]);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        if (count($result) > 0) {
            return true;
        }
        return false;
    }
    function storeArea($area, $areacode, $cityId, $stateId, $countryId)
    {
        $query = $this->conn->prepare("insert into area  (area_name,area_code,city_id,state_id,country_id) values (?,?,?,?,?)");
        $query->execute([$area, $areacode, $cityId, $stateId, $countryId]);
    }
    function getArea()
    {
        $query = $this->conn->prepare("select * from area inner join cities on area.city_id = cities.city_id inner join states on cities.state_id = states.state_id inner join countries on states.country_id = countries.country_id order by area_id");
        $query->execute();
        $areadata = $query->fetchAll(PDO::FETCH_ASSOC);
        // echo"<pre>";
        // print_r($areadata);
        // exit();
        return $areadata;
    }
    function deleteArea($index)
    {
        $query = $this->conn->prepare("delete from area where area_id= ?");
        $query->execute([$index]);
    }
    function updateArea($index, $area, $areacode, $cityId, $stateId, $countryId)
    {
        $query = $this->conn->prepare("update area set area_name = ? , area_code = ? , city_id = ? , state_id= ?, country_id= ?  where area_id = ? ");
        $query->execute([$area, $areacode, $cityId, $stateId, $countryId, $index]);
        if ($query) {
            echo "Area Updated";
        }
    }

}