<?php
/**
 * Created by PhpStorm.
 * User: Filipe
 * Date: 14/04/15
 * Time: 21:45
 */

namespace Core;


class Utils {

    public static function uncamelizeDirFromClass($class) {
        return self::uncamelize($class);
    }

    public static function setRouteFromClass() {

    }

    public static function getAppNamespaceFromRoute($route) {
        $appClass = "\\App\\Applications\\"  . self::camelize($route) . "\\" . self::camelize($route);

        return $appClass;
    }

    public static function getCamelizedClassFromRoute($route) {
        return self::camelize($route);
    }

    /**
     * @link https://gist.github.com/troelskn/751517
     * @param string $scored
     * @return string
     */
    public static function camelize($scored) {
        return ucfirst(lcfirst(
            implode(
                '',
                array_map(
                    'ucfirst',
                    array_map(
                        'strtolower',
                        explode(
                            '-', $scored))))));
    }

    /**
     * @link https://gist.github.com/troelskn/751517
     * @param string $cameled
     * @return string
     */
    public static function uncamelize($cameled) {
        return implode(
            '-',
            array_map(
                'strtolower',
                preg_split('/([A-Z]{1}[^A-Z]*)/', $cameled, -1, PREG_SPLIT_DELIM_CAPTURE|PREG_SPLIT_NO_EMPTY)));
    }

    /**
     * @return bool
     */
    public static function verifyAJAXCall() {
        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            /* special ajax here */
            return true;
        }

        return false;
    }

    /**
     * @param $result
     */
    public function printAndDieOnAjaxCall($result) {
        if(self::verifyAJAXCall())
            die($result);
    }
} 