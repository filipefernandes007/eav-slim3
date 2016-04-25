<?php
/**
 * Created by PhpStorm.
 * User: Filipe
 * Date: 22/07/15
 * Time: 21:32
 */

namespace App\RestController;


use App\BaseAbstract\AbstractController;
use App\Core\EntityManagerSystem;
use App\Resource\System\ApplicationResource as Resource;
use Core\Utils;

/**
 * Class RestAppController
 * @package App\Controller\REST
 */
class RestAppController extends AbstractController {

    /**
     * @param null|int $id
     * @return null|string
     */
    public function read($id = null) {
        $result   = null;

        $resource = new Resource();

        if(!is_null($id)) {
            $result = $resource->getByIdJson($id);
        } else {
            $result = $resource->getAllJson();
        }

        if(Utils::verifyAJAXCall()) {
            die($result);
        }

        return $result;
    }

    public function json($id = null) {
        $result = $this->read($id);

        if(is_null($result))
            die("Empty!");
        else
            print_r($result);
    }
} 