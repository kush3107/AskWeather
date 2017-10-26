<?php
/**
 * Created by PhpStorm.
 * User: kushagra
 * Date: 26/10/17
 * Time: 9:29 PM
 */

namespace App\Services;


use App\WitEntity;
use Curl\Curl;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class WitService
{
    const WIT_BASE_URL = 'https://api.wit.ai/';

    protected $curl;

    /**
     * WitService constructor.
     */
    public function __construct()
    {
        $this->curl = new Curl();
    }

    public function getEntities($query)
    {
        $this->curl->setHeader('Authorization', 'Bearer ' . env('WIT_SERVER_ACCESS_TOKEN'));

        $this->curl->get(self::WIT_BASE_URL . 'message', [
            'q' => $query
        ]);

        if ($this->curl->error) {
            throw new BadRequestHttpException($this->curl->errorMessage);
        }

        $response = $this->curl->response;

        $entities = [];

        if (isset($response->entities) && count($response->entities) > 0) {
            foreach ($response->entities as $key => $entity) {
                foreach ($entity as $e) {
                    $ob = new WitEntity($key, $e->value, $e->confidence);
                    array_push($entities, $ob);
                }
            }
        }

        return $entities;
    }

    public function __destruct()
    {
        $this->curl->close();
    }
}