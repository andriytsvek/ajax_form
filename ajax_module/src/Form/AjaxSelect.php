<?php

namespace Drupal\ajax_module\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\CssCommand;
use Drupal\Core\Url;
use Drupal\Core\Link;

/**
 * Show Ajax Form.
 */
class AjaxSelect extends FormBase {

  public function getFormId() {
    return 'ajax_form_select';
  }

  /**
   * Build our form.
   */

  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['textfield'] = [
      '#type' => 'textfield',
      '#title' => t('Textfield:'),
    ];

    $form['checkbox1'] = [
      '#type' => 'checkbox',
      '#title' => t('Show Fieldset'),
      '#ajax' => [
        'event' => 'change',
        'callback' => '::showFieldset',
      ],
    ];

    $form['fieldset'] = [
      '#name' => 'fieldset',
      '#type' => 'fieldset',
      '#title' => t('fieldset'),
      '#attributes' => [
        'id' => 'fieldset',
        'style' => 'display:none;',
      ],
    ];

    $form['fieldset']['textfield1'] = [
      '#type' => 'textfield',
      '#title' => t('textfield1'),
    ];

    $form['fieldset']['textfield2'] = [
      '#type' => 'textfield',
      '#title' => t('textfield2'),
    ];

    $form['checkbox2'] = [
      '#type' => 'checkbox',
      '#title' => t('Show Link'),
      '#ajax' => [
        'event' => 'change',
        'callback' => '::showLink',
      ],
    ];

    $form['link'] = [
      '#title' => t('google.com'),
      '#type' => 'link',
      '#url' => Url::fromUri('https://google.com/'),
      '#attributes' => [
        'id' => 'link',
        'style' => 'display:none;',
        ],
    ];

    return $form;
  }

  public function validateForm(array &$form, FormStateInterface $form_state) {

  }

  public function submitForm(array &$form, FormStateInterface $form_state) {

  }

  public function showFieldset(array &$form, FormStateInterface $form_state) {
    $response = new AjaxResponse();

    if ($form_state->getValue('checkbox1')) {
      $response->addCommand(new CssCommand('#fieldset',  ['display' => 'block',]));
    }
    else {
      $response->addCommand(new CssCommand('#fieldset',  ['display' => 'none',]));
    }

    return $response;
  }

  public function showLink(array &$form, FormStateInterface $form_state) {
    $response = new AjaxResponse();

    if ($form_state->getValue('checkbox2')) {
      $response->addCommand(new CssCommand('#link',  ['display' => 'block',]));
    }
    else {
      $response->addCommand(new CssCommand('#link',  ['display' => 'none',]));
    }

    return $response;
  }

}
