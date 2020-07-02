<?php
/**
 * Created by PhpStorm.
 * User: sugarfixx
 * Date: 02/07/2020
 * Time: 14:26
 */
require_once __DIR__ .'/src/NepAudioModel/AudioModelBuilderInterface.php';
require_once __DIR__ .'/src/NepAudioModel/AudioModelBuilder.php';
require_once __DIR__ .'/src/NepAudioModel/AudioStream.php';
require_once __DIR__ .'/src/NepAudioModel/AudioChannel.php';
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/10.1.1/styles/default.min.css">
    <title>Multi Audio Tester</title>
</head>
<body>
<div class="container">
    <?php if (isset($_POST) and  !empty($_POST)) {
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
        $data = new NepAudioModel\AudioModelBuilder();
        $json = $data->build($mediainfo, $selectedTemplate);
        echo '<pre><code class="language-json">'.$json .'</code></pre>';
        echo '<a class="btn" href="./demo.php">Back</a>';

    } else {
        echo '<form method="post" action="demo.php">
        <div class="form-group">
            <label for="exampleFormControlSelect1">Profile</label>
            <select name="file" class="form-control" id="exampleFormControlSelect1">';
                $di = new RecursiveDirectoryIterator('data');
                foreach (new RecursiveIteratorIterator($di) as $filename => $file) {
                    if (strpos($filename, '/.') === false) {
                        echo '<option>' . $filename . '</option>';
                    }
                }
        echo '</select>
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect2">Template</label>
                <select name="template" class="form-control" id="exampleFormControlSelect2">
                    <option>1234</option>
                    <option>1235</option>
                </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>';

    }?>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/10.1.1/highlight.min.js"></script>
<script>hljs.initHighlightingOnLoad();</script>
</body>
</html>


