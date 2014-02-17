<?php namespace Dyaa\Pushover\Facades;

use Illuminate\Support\Facades\Facade;

class Pushover extends Facade {
 
  /**
   * Get the registered name of the component.
   *
   * @return string
   */
  protected static function getFacadeAccessor() { return 'pushover'; }
 
}
