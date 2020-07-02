<?php
/**
 * Created by PhpStorm.
 * User: sugarfixx
 * Date: 26/06/2020
 * Time: 08:05
 */

namespace NepAudioModel;

class AudioStream
{
    private $id;
    private $bitDepth;
    private $bitRate;
    private $bitRateMode;
    private $codecId;
    private $endianess;
    private $format;
    private $sampleRate;
    private $type;
    private $wrapping;
    private $streamOrder;
    private $channelCount;
    private $channels;
    private $mappingTitle;
    private $channelIndexes;

    public function __construct($mediaInfo, $config = null)
    {

        $this->setStream($mediaInfo, $config);
    }

    public function setStream($mediaInfo, $config = null)
    {

        $this->bitDepth = $mediaInfo->BitDepth;
        $this->bitRate = $mediaInfo->BitRate;
        $this->bitRateMode = $mediaInfo->BitRate_Mode;
        $this->codecId = $mediaInfo->CodecID;
        $this->format = $mediaInfo->Format;
        $this->endianess = $mediaInfo->Format_Settings_Endianness;
        $this->wrapping = $mediaInfo->Format_Settings_Wrapping;
        $this->sampleRate = $mediaInfo->SamplingRate;
        $this->streamOrder = $mediaInfo->StreamOrder;
        $this->id =  $mediaInfo->ID;
        $this->channelCount = $mediaInfo->Channels;

        $channels = new AudioChannel();

        if ($this->channelCount === 2) {
            if ($config) {
                $this->mappingTitle = $config->Label;
            }
            $this->channels = $channels->createStereoChannels($config);
            $this->type = "sterep";
            $this->channelIndexes = [1,2];
        }
        elseif ( $this->channelCount > 2) {
            if ($config) {
                $this->mappingTitle = $config->Label;
            }
            $this->channels = $channels->createChannelsFromCount($this->channelCount, $config);
            $this->type = "multi";
            $this->channelIndexes = $this->stupidChannelIndexer($this->channelCount);
        }
        else {
            if ($config) {
                $this->mappingTitle = $config->Label;
            }
            $channels->setChannel(1, $config);
            $this->channels = $channels->getChannel();
            $this->type = "mono";
            $this->channelIndexes = [1];
        }
    }


    public function getStream()
    {
        return [
            "bit_depth" => $this->bitDepth,
            "bit_rate" => $this->bitRate,
            "bit_rate_mode" => $this->bitRateMode,
            "channels" => $this->channels,
            "codec_id" => $this->codecId,
            "endianess" => $this->endianess,
            "format" => $this->format,
            "id" => $this->id,
            "sample_rate" => $this->sampleRate,
            "stream_index" => $this->streamOrder,
            "type" => $this->type, // stereo, mono, multi
            "wrapping" => $this->wrapping
        ];
    }

    public function getMapping()
    {
        return [
            'mapping_index' => $this->streamOrder,
            'label' => $this->mappingTitle,
            'type' => $this->type,
            'streams' => [
                'stream_index' => $this->streamOrder,
                'channel_indexes' => $this->channelIndexes,
            ]
        ];
    }

    private function stupidChannelIndexer($count)
    {
        $array = [
            3 => [1,2,3],
            4 => [1,2,3,4],
            5 => [1,2,3,4,5],
            6 => [1,2,3,4,5,6],
            7 => [1,2,3,4,5,6,7],
            8 => [1,2,3,4,5,6,7,8]
        ];
        return $array[$count];
    }
}
