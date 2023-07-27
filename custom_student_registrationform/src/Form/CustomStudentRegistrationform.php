<?php
/**
 * @file
 * Contains \Drupal\custom_student_registrationform\Form\CustomStudentRegistrationform.
 */
namespace Drupal\custom_student_registrationform\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class CustomStudentRegistrationform extends FormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'my registration pass the api form_if after submit the form';
  }
   public function buildForm(array $form, FormStateInterface $form_state){
        $form['student_name'] = [
            '#type' => 'textfield',
            '#title' => t('Enter Your Name'),
            '#required' => TRUE,
        ];
        $form['student_roll_number'] = [
            '#type' => 'textfield',
            '#title' => t("Enter Your Roll Number"),
            '#required' => TRUE,
        ];
        $form['student_email_id'] = [
            '#type' => 'Email',
            '#title' => t("Enter Your Email"),
            '#required' => TRUE,
        ];
        $form['student_contact_number'] = [
            '#type' => 'tel',
            '#title' => t('Enter Contact Number'),
        ];
        $form['student_DOB'] = [
            '#type' => 'date',
             '#title' => t('Enter DOB:'),
             '#required' => TRUE,
        ];
        $form['student_select'] = [
            '#type' => 'select',
            '#title' => ' Select Gender',
            '#options' => [
                'Male' => t('Male'),
                'Female' => t('Female'),
                'other' => t('Other'),
            ],
        ];
        $form['actions']['#type'] = 'actions';
        $form['actions']['submit'] = [
            '#type' => 'submit',
            '#value' => $this->t('Submit'),
            '#button_type' => 'primary',
        ];
        $form['#theme'] = 'my_template';
        return $form;   
      
   }   
   public function validateForm(array &$form, FormStateInterface $form_state) {
    if(strlen($form_state->getValue('student_roll_number')) < 8) {
      $form_state->setErrorByName('student_roll_number', $this->t('Please enter a valid Enrollment Number'));
    }
    if(strlen($form_state->getValue('student_contact_number')) < 10) {
      $form_state->setErrorByName('student_contact_number', $this->t('Please enter a valid Contact Number'));
    }
  }
  
  public function submitForm(array &$form, FormStateInterface $form_state) {
    \Drupal::messenger()->addMessage(t("Student Registration Done!! Registered Values are:"));
	foreach ($form_state->getValues() as $key => $value) {
	  \Drupal::messenger()->addMessage($key . ': ' . $value);
    }
  }
}
