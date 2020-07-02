<?php
require_once "AudioStream.php";
require_once "AudioChannel.php";

// Figure out correct config
$configFile = file_get_contents("config.json");
$config = json_decode($configFile);

$templateId = (int)$_POST['template'];

$selectedTemplate = null;

foreach ($config->Templates  as $template) {
    if ($template->TemplateId === $templateId) {
        $selectedTemplate = $template;
    }
}

// Load correct profile
$submittedFile = $_POST['file'];
$file = file_get_contents($submittedFile);
$object = json_decode($file);
$mediainfo = $object->mediainfo;

$i =0;
$streams = [];
$mapping = [];
foreach ($mediainfo->audio_streams as $stream)
{
    $conf = $selectedTemplate->Tracks;
    $stream = new AudioStream($stream, $conf[$i]);
    $i++;
    $streams[] = $stream->getStream();
    $mapping[] = $stream->getMapping();
}



$data = ['streams' => $streams, 'mapping' => $mapping];

$json = json_encode($data, JSON_PRETTY_PRINT);

?>
<pre><code class="language-json"><?php echo $json ?></code></pre>

<a href="./">Back</a>
