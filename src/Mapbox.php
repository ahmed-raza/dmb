<?php

namespace Drupal\mapbox;
use Drupal\Core\Config\ConfigFactoryInterface;

/**
 * Class Mapbox.
 */
class Mapbox {

  /**
   * Drupal\Core\Config\ConfigFactoryInterface definition.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;

  /**
   * Constructs a new Mapbox object.
   */
  public function __construct(ConfigFactoryInterface $config_factory) {
    $this->configFactory = $config_factory;
  }

  public function getStyle() {
    //
  }

}
