<?
	class VenuesController extends AppController
	{
		var $name = 'Venue';
		var $uses = array('Venue', 'City');	//allow usage of City model

		function index ()
		{
			$params = array ('order' => 'Venue.name ASC');
			$this->set('venues', $this->Venue->find('all', $params));
		}

		function view ($id = null)
		{
			$this->pageTitle = 'Venue Info.';
			$this->Venue->id = $id;
			$this->set('venue', $this->Venue->read());
		}

		function add ()
		{
			$this->pageTitle = 'Add Venue';

			if(empty($this->data))
			{
				$params = array ('order' => 'City.name ASC');
				$this->set('cities', $this->City->find('all', $params));
				$this->set('submitted', false);
			}
			else
			{
				if ($this->Venue->save($this->data)) 
				{
					$this->set('submitted', true);
					$this->Session->setFlash('Your venue has been added.');
					$this->redirect('/venues');
				}
			}
		}
        
		function edit ($id = null)
               
		{
			if(is_null($id))
                       
			{
                                
				$this->Session->setFlash(__('Need specific venueId to edit.', true));
                                
				$this->redirect('/venues');
                       
			}
               
		}
	
	
	}
?>
