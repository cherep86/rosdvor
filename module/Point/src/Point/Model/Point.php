<?php


namespace Point\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Point  implements InputFilterAwareInterface{
	protected $id;
	protected $latitude;
	protected $longitude;
	protected $address;
	protected $trade_id;
	protected $title;
	/**
	 * @var InputFilter
	 */
	protected $inputFilter;

	public function exchangeArray($data)
	{
		$this->id     = (!empty($data['id'])) ? $data['id'] : null;
		$this->latitude = (!empty($data['latitude'])) ? $data['latitude'] : null;
		$this->longitude  = (!empty($data['longitude'])) ? $data['longitude'] : null;
		$this->address  = (!empty($data['address'])) ? $data['address'] : null;
		$this->trade_id  = (!empty($data['trade_id'])) ? $data['trade_id'] : null;
		$this->title = (!empty($data['title'])) ? $data['title'] : null;
	}

	public function setInputFilter(InputFilterInterface $inputFilter)
	{
		throw new \Exception("Not used");
	}

	public function getInputFilter()
	{
		if (!$this->inputFilter) {
			$inputFilter = new InputFilter();

			$inputFilter->add(array(
				'name'     => 'id',
				'required' => false,
				'filters'  => array(
					array('name' => 'Int'),
				),
			));

			$inputFilter->add(array(
				'name'     => 'title',
				'required' => false,
				'filters'  => array(
					array('name' => 'StripTags'),
					array('name' => 'StringTrim'),
				),
				'validators' => array(
					array(
						'name'    => 'StringLength',
						'options' => array(
							'encoding' => 'UTF-8',
							'min'      => 1,
							'max'      => 2000,
						),
					),
				),
			));

			$inputFilter->add(array(
				'name'     => 'address',
				'required' => false,
				'filters'  => array(
					array('name' => 'StripTags'),
					array('name' => 'StringTrim'),
				),
				'validators' => array(
					array(
						'name'    => 'StringLength',
						'options' => array(
							'encoding' => 'UTF-8',
							'min'      => 1,
							'max'      => 2000,
						),
					),
				),
			));

			$inputFilter->add(array(
				'name'     => 'trade_id',
				'required' => false,
				'filters'  => array(
					array('name' => 'Int'),
				),
			));

			$inputFilter->add(array(
				'name'     => 'latitude',
				'required' => true,
			));
			$inputFilter->add(array(
				'name'     => 'longitude',
				'required' => true,
			));

			$this->inputFilter = $inputFilter;
		}

		return $this->inputFilter;
	}

	public function getArrayCopy()
	{
		return get_object_vars($this);
	}

	/**
	 * @return mixed
	 */
	public function getAddress()
	{
		return $this->address;
	}

	/**
	 * @param mixed $address
	 */
	public function setAddress($address)
	{
		$this->address = $address;
	}

	/**
	 * @return mixed
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param mixed $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}

	/**
	 * @return mixed
	 */
	public function getLatitude()
	{
		return $this->latitude;
	}

	/**
	 * @param mixed $latitude
	 */
	public function setLatitude($latitude)
	{
		$this->latitude = $latitude;
	}

	/**
	 * @return mixed
	 */
	public function getLongitude()
	{
		return $this->longitude;
	}

	/**
	 * @param mixed $longitude
	 */
	public function setLongitude($longitude)
	{
		$this->longitude = $longitude;
	}

	/**
	 * @return mixed
	 */
	public function getTradeId()
	{
		return $this->trade_id;
	}

	/**
	 * @param mixed $trade_id
	 */
	public function setTradeId($trade_id)
	{
		$this->trade_id = $trade_id;
	}

	/**
	 * @return mixed
	 */
	public function getTitle()
	{
		return $this->title;
	}

	/**
	 * @param mixed $trade_id
	 */
	public function setTitle($title)
	{
		$this->title = $title;
	}
} 