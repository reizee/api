<?php

namespace Reizee\Api;

use Illuminate\Support\ServiceProvider;
use Reizee\Api\Exception\RequiredParameterMissingException;

class ReizeeApiServiceProvider extends ServiceProvider
{
  public function register()
  {
    $this->app->bind('reizee_api', function ($app) {

      $version  = $app->config->get('reizee.api.version');

      if (!$config = $app->config->get("reizee.api.{$version}")) {
        throw new RequiredParameterMissingException("Reizee Config not found", 1);
      }

      return new ReizeeApi($version, $config);
    });
  }

  public function boot()
  {
    if ($this->app->runningInConsole()) {

      $this->publishes([
        __DIR__ . '/../config/config.php' => config_path('reizee.php'),
      ], 'config');
    }
  }
}
