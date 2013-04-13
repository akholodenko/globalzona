<?
	class CitiesController extends AppController
	{
		var $name = 'City';
		var $uses = array('City', 'Country');	//allow usage of Country model

		function index ()
		{
			$params = array ('order' => 'City.name ASC');
			$this->set('cities', $this->City->find('all', $params));
		}

		function view ($id = null)
		{
			$this->pageTitle = 'City List';
			$this->City->id = $id;
			$this->set('city', $this->City->read());
		}

		function add ()
		{
			$this->pageTitle = 'Add City';

			if(empty($this->data))
			{
				$params = array ('order' => 'Country.name ASC');
				$this->set('countries', $this->Country->find('all', $params));
			}
			else
			{
				if ($this->City->save($this->data)) 
				{
					$this->Session->setFlash('Your city has been added.');
					$this->redirect('/cities');
				}
			}
		}
        /*
		function edit ($id = null)
               
		{
			if(is_null($id))
                       
			{
                                
				$this->Session->setFlash(__('Need specific venueId to edit.', true));
                                
				$this->redirect('/venues');
                       
			}
               
		}
		*/
	
	
	}
?>
