<?php
/**
 * Created by PhpStorm.
 * User: sugarfixx
 * Date: 02/07/2020
 * Time: 09:49
 */

namespace NepAudioModel;

use NepAudioModel\AudioStream;

use NepAudioModel\AudioChannel;


class AudioModelBuilder implements AudioModelBuilderInterface
{
    public function build($mediaInfo, $conf)
    {
        if (!$this->validateConfig($mediaInfo, $conf)) {
            return json_encode([
                "message" => "Selected template in config does not meet the requirements"
            ], JSON_PRETTY_PRINT);
        }
        $i =0;
        $streams = [];
        $mapping = [];
        foreach ($mediaInfo->audio_streams as $stream)
        {
            $stream = new AudioStream($stream, $conf->Tracks[$i]);
            $i++;
            $streams[] = $stream->getStream();
            $mapping[] = $stream->getMapping();
        }

        return json_encode([
            "streams" => $streams,
            "mapping" => $mapping
        ], JSON_PRETTY_PRINT);
    }

    /**
     * @param $mediaInfo
     * @param $conf
     * @return bool
     */
    public function validateConfig($mediaInfo, $conf)
    {
        $configuredTracks = count($conf->Tracks);
        $format = $mediaInfo->format;
        $noOfAudioTracks = $format->streams_audio_count;
        return $configuredTracks >= $noOfAudioTracks ? true : false;
    }

}
