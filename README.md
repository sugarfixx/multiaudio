# multiaudio

##Install
If you are starting a blank project from a clean composer.json
```angular2html

{
   "require":{
      "sugarfixx/multiaudio":"0.1"
   },
   "repositories":[
      {
         "type":"vcs",
         "url":"git@github.com:sugarfixx/multiaudio.git"
      }
   ]
}
```

Run
```angular2html
composer require sugarfixx/multiaudio
```

### Simple usage

Include the autoload to your php file
```php
require "vendor/autoload.php";
```
#### Usage example
```php
use KafkaService\KafkaService;

// set the template
$template = [

];

// set the MediaInfo profile 
$mediaInfo = "mediaInfoProfile;

$data = new NepAudioModel\AudioModelBuilder();
$json = $data->build($mediaInfo, $template);
```
