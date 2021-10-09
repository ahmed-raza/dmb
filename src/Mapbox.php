<?php

namespace Drupal\mapbox;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\StringTranslation\TranslationManager;

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
   * Drupal\Core\StringTranslation\TranslationManager definition.
   *
   * @var \Drupal\Core\StringTranslation\TranslationManager
   */
  protected $stringTranslation;

  /**
   * Constructs a new Mapbox object.
   */
  public function __construct(ConfigFactoryInterface $config_factory, TranslationManager $string_translation) {
    $this->configFactory      = $config_factory;
    $this->stringTranslation  = $string_translation;
  }

  public function getStyle() {
    return 'mapbox://styles/mapbox/streets-v11';
  }

  public function getStyles() {
    return [
      'mapbox://styles/mapbox/streets-v11'            => $this->stringTranslation->translate('Mapbox Streets'),
      'mapbox://styles/mapbox/outdoors-v11'           => $this->stringTranslation->translate('Mapbox Outdoors'),
      'mapbox://styles/mapbox/light-v10'              => $this->stringTranslation->translate('Mapbox Light'),
      'mapbox://styles/mapbox/dark-v10'               => $this->stringTranslation->translate('Mapbox Dark'),
      'mapbox://styles/mapbox/satellite-v9'           => $this->stringTranslation->translate('Mapbox Satellite'),
      'mapbox://styles/mapbox/satellite-streets-v11'  => $this->stringTranslation->translate('Mapbox Satellite Streets'),
      'mapbox://styles/mapbox/navigation-day-v1'      => $this->stringTranslation->translate('Mapbox Navigation Day'),
      'mapbox://styles/mapbox/navigation-night-v1'    => $this->stringTranslation->translate('Mapbox Navigation Night'),
    ];
  }

}
