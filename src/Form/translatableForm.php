<?php

namespace Drupal\translatable_module\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * My module basic translatableForm.
 */
class translatableForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'translatable_module_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'translatable_module.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildForm($form, $form_state);
    $settings = $this->config('translatable_module.settings');

    $form['example'] = [
      '#type'  => 'details',
      '#open'  => TRUE,
      '#title' => $this->t('Fieldset'),
    ];

    $form['example']['title'] = [
      '#title' => $this->t('Title:'),
      '#type'          => 'textfield',
      '#default_value' => $settings->get('title'),
    ];

    
    $form['example']['message'] = [
      '#title' => $this->t('Message:'),
      '#type'          => 'textarea',
      '#default_value' => $settings->get('message'),
    ];

    $form['example']['ckeditor'] = [
      '#title' => $this->t('Full Message:'),
      '#type'          => 'text_format',
      '#format'        => $settings->get('ckeditor')['format'],
      '#default_value' => $settings->get('ckeditor')['value'],
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $settings = $this->configFactory->getEditable('translatable_module.settings')
                ->set('title', $form_state->getValue('title'))
                ->set('message', $form_state->getValue('message'))
                ->set('ckeditor', $form_state->getValue('ckeditor'))->save();
  }

}