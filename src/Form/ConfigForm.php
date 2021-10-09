<?php

namespace Drupal\mapbox\Form;

use Drupal\mapbox\Mapbox;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class ConfigForm.
 */
class ConfigForm extends ConfigFormBase {

  /**
   * Drupal\Core\StringTranslation\TranslationManager definition.
   *
   * @var \Drupal\Core\StringTranslation\TranslationManager
   */
  protected $stringTranslation;

  /**
   * Drupal\mapbox\Mapbox definition.
   *
   * @var \Drupal\mapbox\Mapbox
   */
  protected $mapbox;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    $instance = parent::create($container);
    $instance->stringTranslation = $container->get('string_translation');
    $instance->mapbox = $container->get('mapbox');
    return $instance;
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'mapbox.config',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'config_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('mapbox.config');

    $noTokenMessage = '';
    if (!$config->get('access_token'))
      $noTokenMessage = $this->stringTranslation->translate('Missing Mapbox access token. Acquire an access token from <a href="https://www.mapbox.com" target="_blank">Mapbox</a>.');

    $form['access_token'] = [
      '#type' => 'textfield',
      '#title' => $this->stringTranslation->translate('Access Token'),
      '#maxlength' => 96,
      '#size' => 86,
      '#required' => TRUE,
      '#default_value' => $config->get('access_token'),
    ];
    $form['mapbox_settings'] = [
      '#type' => 'details',
      '#title' => $this->stringTranslation->translate('Mapbox Settings'),
      '#open' => TRUE
    ];
    $form['mapbox_settings']['style'] = [
      '#type' => 'radios',
      '#title' => $this->stringTranslation->translate('Mapbox Style'),
      '#options' => $this->mapbox->getStyles(),
      '#default_value' => $config->get('style')
    ];
    $form['mapbox_settings']['preview'] = [
      '#type' => 'item',
      '#title' => $this->stringTranslation->translate('Preview'),
      '#markup' => "<div id='mapbox-preview'>$noTokenMessage</div>"
    ];

    $form['#attached']['library'][] = 'mapbox/config';
    $form['#attached']['library'][] = 'mapbox/apis';
    $form['#attached']['drupalSettings']['mapbox'] = [
      'accessToken' => $config->get('access_token') ? $config->get('access_token') : null,
      'style'       => $config->get('style') ? $config->get('style') : $this->mapbox->getStyle()
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $this->config('mapbox.config')
      ->set('access_token', $form_state->getValue('access_token'))
      ->set('style', $form_state->getValue('style'))
      ->save();
  }

}
