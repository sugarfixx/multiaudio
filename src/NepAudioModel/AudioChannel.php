<?php
/**
 * Created by PhpStorm.
 * User: sugarfixx
 * Date: 26/06/2020
 * Time: 07:18
 */

namespace NepAudioModel;

class AudioChannel
{
    private $channelIndex;
    private $description = "undescribed";
    private $title = "untitled";
    private $languages = null;
    private $type = "undefined";


    public function createChannelsFromCount($count, $config = null)
    {
        $result = [];

        if ($config) {
            $this->setFromConfig($config);
        }

        for ($x = 1; $x <= $count; $x++) {
            $result[] = [
                "channel_index" => $x,
                "description" => $this->description,
                "title" => $this->title . " - [" . $x . "]",
                "languages" => $this->languages,
                "type" => $this->type
            ];
        }
        return $result;
    }

    public function createStereoChannels($config = null)
    {
        $result = [];

        if ($config) {
            $this->setFromConfig($config);
        }

        for ($x = 1; $x <= 2; $x++) {
            $type = $x === 1 ? "L" : "R";
            $result[] = [
                "channel_index" => $x,
                "description" => $this->description,
                "title" => $this->title . " - [" . $type . "]",
                "languages" => $this->languages,
                "type" => $type
            ];
        }
        return $result;
    }


    public function setChannel($index, $config = null)
    {
        $this->channelIndex = $index;

        if ($config) {
            $this->setFromConfig($config);
        }
    }

    public function setFromConfig($conf)
    {
        $this->languages = $conf->Language;
        $this->description = $conf->Label;
        $this->title = $conf->Label;
    }

    public function getChannel()
    {
        return [
            "channel_index" => $this->channelIndex,
            "description" => $this->description,
            "title" => $this->title,
            "languages" => $this->languages,
            "type" => $this->type
        ];
    }
}
