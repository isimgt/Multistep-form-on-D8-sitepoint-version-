<?php

/**
 * @file
 * Contains \Drupal\multistep\Form\MultistepThreeForm.
 */

namespace Drupal\multistep\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
 * Class MultistepThreeForm.
 *
 * @package Drupal\multistep\Form
 */
class MultistepThreeForm extends MultistepFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'multistep_three_form';
  }

  /**
   * {@inheritdoc}.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form = parent::buildForm($form, $form_state);

    $form['color'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Your favorite color'),
      '#default_value' => $this->store->get('color') ? $this->store->get('color') : '',
    );

    $form['movie'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Your favorite movie'),
      '#default_value' => $this->store->get('movie') ? $this->store->get('movie') : '',
    );

    $form['actions']['previous'] = array(
      '#type' => 'link',
      '#title' => $this->t('Previous'),
      '#attributes' => array(
        'class' => array('button'),
      ),
      '#weight' => 0,
      '#url' => Url::fromRoute('demo.multistep_two'),
    );

    return $form;
  }

  /**
   * {@inheritdoc}
   */
    public function submitForm(array &$form, FormStateInterface $form_state) {
      $this->store->set('color', $form_state->getValue('color'));
      $this->store->set('movie', $form_state->getValue('movie'));

      // Save the data
      parent::saveData();
      $form_state->setRedirect('demo.multistep_one');
    }

}
