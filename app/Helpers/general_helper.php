<?php
// HELPER GENERAL

if (!function_exists('pre')) {

    /*** imprime una variable y corta la ejecucion de un proceso
     * @param $variable
     * @return string
     */
    function pre($variable){
        echo "<pre>";
        print_r($variable);
        echo "</pre>";
        die();
    }
}

if (!function_exists('nvl')) {
    /**
    funcion de php que simula nvl de ORACLE
     */
    function nvl ($key, $else) {
        return ($key!='' ? $key : $else);
    }
}

if (!function_exists('like_match')) {
    /**
    compara como un LIKE de sql
    $esp = (like_match('ESP-%', $p_tipo)==true)? 'TRUE' : 'FALSE';
     **/
    function like_match($pattern, $subject){
        $pattern = str_replace('%', '.*', preg_quote($pattern, '/'));
        return (bool) preg_match("/^{$pattern}$/i", $subject);
    }
}