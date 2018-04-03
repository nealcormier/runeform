<?php

/**
 * @file
 * Contains \Drupal\runeform\Form\RuneForm.
*/

 namespace Drupal\runeform\Form;

 use Drupal\Core\Form\FormBase;
 use Drupal\Core\Form\FormStateInterface;
 use Drupal\Component\Utility\UrlHelper;
 // use Drupal\Core\Form\ConfigFormBase


 /**
 * Implements a custom form for Runebeck Construction.
 */

 class RuneForm extends \Drupal\Core\Form\FormBase {

	 /**
	 * {@inheritdoc}.
	 */

	 public function getFormID() {
	 	return 'rune_form';
	 }

	  /**
	 * {@inheritdoc}.
	 */

	  public function buildForm(array $form, FormStateInterface &$form_state) {
	 	$form['fname'] = array(
	 		'#type' => 'textfield',
	 		'#title' => $this->t('Enter Your Full Name')
		);
		$form['phone_number'] = array(
	 		'#type' => 'tel',
	 		'#title' => $this->t('Your Phone Number')
		);
		$form['email'] = array(
	 		'#type' => 'textfield',
	 		'#title' => $this->t('Your Email')
		);
		$form['date'] = array(
	 		'#type' => 'date',
	 		'#title' => $this->t('Enter The Date')
		);
		$form['construction_type'] = array(
	 		'#type' => 'checkboxes',
	 		'#options' => array(t('Home Owner'), t('Builder')),
	 		'#title' => t('Owner or Builder?')
		);
		$form['image_runeform_image_fid'] = array(
			'#title' => t('Image'),
			'#type' => 'managed_file',
			'#description' => t('Upload a pic of your desired home or place of work. Your uploaded image will appear right on this page.'),
			'#default_value' => variable_get('image_runeform_image_fid', ''),
			'#upload_location' => 'public://image_runeform_images/',
		);
	    $form['candidate_confirmation'] = array (
	      '#type' => 'radios',
	      '#title' => ('Are you s Spec Builder?'),
	      '#options' => array(
	        'Yes' =>t('Yes'),
	        'No' =>t('No')
	      ),
	    );
	    $form['video'] = array(
	      '#type' => 'textfield',
	      '#title' => t('Learn More About Our Products'),
	    );
		


		$form['actions']['#type'] = 'actions';
		$form['actions']['submit'] = array (
			'#type' => 'submit',
			'#value' => $this->t('Save'),
			'#button_type' => 'primary',


		);
			return $form;
	 }



	 public function validateForm(array &$form, FormStateInterface &$form_state) {
	 	if(strlen($form_state['']['']) < 7 ) {
	 		\Drupal::formBuilder()->setErrorByName('phone_number', $form_state, 'Phone number has to be at least 7 digits.');
	 	}
	 	// Validate Runebeck video URL.
	    if (!UrlHelper::isValid($form_state->getValue('video'), TRUE)) {
	      $form_state->setErrorByName('video', $this->t("The video url '%url' is not valid.", array('%url' => $form_state->getValue('video'))));
	    }
	 }


	  public function submitForm(array &$form, FormStateInterface $form_state) {
		   drupal_set_message($this->t('@Build! Thank you for submitting to Runebeck!', array('@Build' => $form_state->getValue('rune_form'))));
	    	$form_state->setRedirect('/runebeckthankyoupage);

  		}


}












