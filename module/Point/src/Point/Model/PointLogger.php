<?php


namespace Point\Model;


use Zend\Http\Request;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class PointLogger implements FactoryInterface{
    /**
     * @var \MongoClient
     */
    protected $mongo_client;
    /**
     * @var \MongoDB
     */
    protected $db;

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator){
        $config = $serviceLocator->get('Config');
        $this->mongo_client = new \MongoClient($config['mongo']['server']);
        $this->db = $this->mongo_client->selectDB($config['mongo']['db']);

        return $this;
    }

    /**
     * @param $request Request
     */
    public function log($request){
        $headers = [];
        foreach ($request as $header){
            /**@var $header \Zend\Http\Header\HeaderInterface */
            $headers[strtolower($header->getFieldName())] = strtolower($header->getFieldValue());
        }
        $this->db->log->insert([
            'time'      =>  time(),
            'user_id'   =>  rand(0, 10),
            'url'       =>  $request->getUri()->__toString(),
            'method'    =>  strtolower($request->getMethod()),
            'headers'   =>  $headers,
        ]);

    }
}