<?php
/**
 * Created by PhpStorm.
 * User: sugarfixx
 * Date: 01/07/2020
 * Time: 00:05
 */
$di = new RecursiveDirectoryIterator('data');
foreach (new RecursiveIteratorIterator($di) as $filename => $file) {
    echo $filename . '<br/>';
}
