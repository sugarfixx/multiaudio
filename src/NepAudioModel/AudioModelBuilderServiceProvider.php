<?php
/**
 * Created by PhpStorm.
 * User: sugarfixx
 * Date: 02/07/2020
 * Time: 10:35
 */

namespace NepAudioModel;


class AudioModelBuilderServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AudioModelBuilderInterface::class, function() {
            return $this->app->make(AudioModelBuilder::class);
        });
    }
}
