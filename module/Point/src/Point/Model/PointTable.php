<?php


namespace Point\Model;

use Zend\Db\TableGateway\TableGateway;

class PointTable {
	/**
	 * @var \Zend\Db\TableGateway\TableGateway
	 */
	protected $tableGateway;

	public function __construct(TableGateway $tableGateway)
	{
		$this->tableGateway = $tableGateway;
	}

	public function fetchAll()
	{
		$resultSet = $this->tableGateway->select();
		return $resultSet;
	}

	public function getPoint($id)
	{
		$id  = (int) $id;
		$rowset = $this->tableGateway->select(array('id' => $id));
		$row = $rowset->current();
		if (!$row) {
			throw new \Exception("Could not find row $id");
		}
		return $row;
	}

	public function savePoint(Point $point)
	{
		$data = array(
			'address' => $point->getAddress(),
			'trade_id' => $point->getTradeId(),
			'title'  => $point->getTitle(),
			'latitude'  => $point->getLatitude(),
			'longitude'  => $point->getLongitude(),
		);

		$id = (int) $point->getId();
		if ($id == 0) {
			$this->tableGateway->insert($data);
		} else {
			if ($this->getPoint($id)) {
				$this->tableGateway->update($data, array('id' => $id));
			} else {
				throw new \Exception('Point id does not exist');
			}
		}
	}

	public function deletePoint($id)
	{
		$this->tableGateway->delete(array('id' => (int) $id));
	}
} 