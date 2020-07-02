<?php
/**
 * Created by PhpStorm.
 * User: sugarfixx
 * Date: 24/06/2020
 * Time: 12:03
 */
require_once "AudioStream.php";
require_once "AudioChannel.php";
echo "Multi Audio Ingest Tooling <hr>";

// $templateId = 1234;
$templateId = 1235;

$configJson = file_get_contents("config.json");
$conf = json_decode($configJson);
$templates = $conf->Templates;
$file = file_get_contents("ffprofile_output.json");
$object = json_decode($file);

$ffprobeStreams = $object->ffprobe->audio_streams;

$mediainfo = $object->mediainfo;
$mediainfoStreams = $mediainfo->audio_streams;
$format = $mediainfo->format;
$noOfAudioTracks = $format->streams_audio_count;

$selectedTemplate = null;

foreach ($templates  as $template) {
    if ($template->TemplateId === $templateId) {
        $selectedTemplate = $template;
    }
}


echo $noOfAudioTracks ."<br>";

echo "Config templateId:". $templateId ."<hr>";
echo '<textarea rows="30" cols="120">'. json_encode($selectedTemplate) .'</textarea>';
echo '<hr>';
// $audioChannel = new AudioChannel();
// var_dump($audioChannel->createStereoChannels());



$data = [];
$i =0;
$streams = [];
$mapping = [];
foreach ($mediainfoStreams as $stream)
{
    $conf = $selectedTemplate->Tracks;
    $stream = new AudioStream($stream, $conf[$i]);
    $i++;
    $streams[] = $stream->getStream();
    $mapping[] = $stream->getMapping();
}



$data['streams'] = $streams;
$data['mapping'] = $mapping;
$json = json_encode($data,  JSON_PRETTY_PRINT);
echo '<textarea rows="30" cols="120">'. $json .'</textarea>';

