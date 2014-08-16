<?php


namespace Point\Controller;

use Point\Form\PointForm;
use Point\Model\Point;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class PointController extends AbstractActionController{
	/**
	 * @var \Point\Model\PointTable
	 */
	protected $pointTable;

	public function indexAction()
	{
		return new ViewModel(array(
			'points' => $this->getPointTable()->fetchAll(),
		));
	}

	public function addAction()
	{
		$form = new PointForm();
		$form->get('submit')->setValue('Add');

		$request = $this->getRequest();
		if ($request->isPost()) {
			$album = new Point();
			$form->setInputFilter($album->getInputFilter());
			$form->setData($request->getPost());

			if ($form->isValid()) {
				$album->exchangeArray($form->getData());
				$this->getPointTable()->savePoint($album);

				// Redirect to list of albums
				return $this->redirect()->toRoute('point');
			}
		}
		return array('form' => $form);
	}

	public function editAction()
	{
		$id = (int) $this->params()->fromRoute('id', 0);
		if (!$id) {
			return $this->redirect()->toRoute('point', array(
				'action' => 'add'
			));
		}

		try {
			$point = $this->getPointTable()->getPoint($id);
		}
		catch (\Exception $ex) {
			return $this->redirect()->toRoute('point', array(
				'action' => 'index'
			));
		}

		$form  = new PointForm();
		$form->bind($point);
		$form->get('submit')->setAttribute('value', 'Edit');

		$request = $this->getRequest();
		if ($request->isPost()) {
			$form->setInputFilter($point->getInputFilter());
			$form->setData($request->getPost());

			if ($form->isValid()) {
				$this->getPointTable()->savePoint($point);

				// Redirect to list of albums
				return $this->redirect()->toRoute('point');
			}
		}

		return array(
			'id' => $id,
			'form' => $form,
		);
	}

	public function deleteAction()
	{
		return new ViewModel();
	}

	/**
	 * @return \Point\Model\PointTable
	 */
	public function getPointTable()
	{
		if (!$this->pointTable) {
			$sm = $this->getServiceLocator();
			$this->pointTable = $sm->get('Point\Model\PointTable');
		}
		return $this->pointTable;
	}
}