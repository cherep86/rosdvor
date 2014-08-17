<?php


namespace Point\Form;

use Zend\Form\Form;
class PointForm extends Form{
	public function __construct($name = null)
	{
		// we want to ignore the name passed
		parent::__construct('point');

		$this->add(array(
			'name' => 'id',
			'type' => 'Hidden',
		));
		$this->add(array(
			'name' => 'title',
			'type' => 'Text',
			'options' => array(
				'label' => 'Title',
			),
		));
		$this->add(array(
			'name' => 'address',
			'type' => 'Text',
			'options' => array(
				'label' => 'Address',
			),
		));
		$this->add(array(
			'name' => 'trade_id',
			'type' => 'Text',
			'options' => array(
				'label' => 'Trade id',
			),
		));
		$this->add(array(
			'name' => 'latitude',
			'type' => 'Text',
			'options' => array(
				'label' => 'Latitude',
			),
		));
		$this->add(array(
			'name' => 'longitude',
			'type' => 'Text',
			'options' => array(
				'label' => 'Longitude',
			),
		));
		$this->add(array(
			'name' => 'submit',
			'type' => 'Submit',
			'attributes' => array(
				'value' => 'Go',
				'id' => 'submitbutton',
			),
		));
	}
} 