<?php
/**
 * Created by PhpStorm.
 * User: sugarfixx
 * Date: 02/07/2020
 * Time: 09:48
 */

namespace NepAudioModel;


interface AudioModelBuilderInterface
{
    public function build($mediaInfo, $conf);

    public function validateConfig($mediaInfo, $conf);
}
