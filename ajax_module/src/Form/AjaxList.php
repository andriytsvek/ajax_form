<?php

namespace Drupal\ajax_module\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\Core\Ajax\CssCommand;

/**
 * Show Ajax Form.
 */
class AjaxList extends FormBase {

  public function getFormId() {
    return 'ajax_form_list';
  }

  /**
   * Build our form.
   */

  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['list'] = [
      '#theme' => 'item_list',
      '#list_type' => 'ul',
      '#items' => [
        [
          '#markup' => 'Item 1',
          '#wrapper_attributes' => [
            'class' => [
              'link-color1',
            ],
          ],
        ],
        [
          '#markup' => 'Item 2',
          '#wrapper_attributes' => [
            'class' => [
              'link-color2',
            ],
          ],
        ],
      ],
      '#attributes' => ['id' => 'Links'],
    ];

    $form['button'] = [
      '#type' => 'button',
      '#value' => t('Change Color'),
      '#ajax' => [
        'callback' => '::changeColor',
      ],
    ];

    return $form;
  }

  public function validateForm(array &$form, FormStateInterface $form_state) {

  }

  public function submitForm(array &$form, FormStateInterface $form_state) {

  }

  public function changeColor() {
    $response = new AjaxResponse();

    $link1_color = rand (0 , 999999);
    $link2_color = rand (0 , 999999);

    $response->addCommand(new CssCommand('.link-color1',  ['color' => '#' . $link1_color,]));
    $response->addCommand(new HtmlCommand('.link-color1', '#' . $link1_color));
    $response->addCommand(new CssCommand('.link-color2',  ['color' => '#' . $link2_color,]));
    $response->addCommand(new HtmlCommand('.link-color2', '#' . $link2_color));

    return $response;
  }

}
