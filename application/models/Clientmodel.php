<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Client Model
*/
class Clientmodel extends CI_Model
{
    private $csvFile = '';

    function __construct()
    {
        $this->csvFile = $this->config->item('client_csv');
    }

    public function getCsvFileDir() {
        return $this->csvFile;
    }

    public function addClient($data=[])
    {
        if (empty($data)) {
            return false;
        }

        $fp = fopen($this->csvFile, 'a');
        if ($fp === false) {
            return false;
        }

        fputcsv($fp, $data);
        fclose($fp);

        return true;
    }

    public function getClients()
    {
        if (!file_exists($this->csvFile)) {
            return false;
        }
        
        $fp = fopen($this->csvFile, 'r');
        if ($fp === false) {
            return false;
        }

        $clients = [];
        while(($client = fgetcsv($fp)) !== FALSE) {
            $clients[] = $client;
        }
        fclose($fp);

        return empty($clients) ? false : $clients;
    }

    public function getClientById($id)
    {
        $clients = $this->getClients();
        return isset($clients[$id]) ? $clients[$id] : false;
    }
}