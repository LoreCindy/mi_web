<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Heredamos de la clase CI_Controller */
class Proyectos extends CI_Controller {

	function __construct() 
	{
		
		parent::__construct();

		/* Cargamos la base de datos */
		$this->load->database();

		/* Cargamos la libreria*/
		$this->load->library('grocery_crud');

		/* Añadimos el helper al controlador */
		$this->load->helper('url');
                $this->_init();
	}
        
        private function _init()
	{
		$this->output->set_template('default');
                $this->load->js('assets/themes/default/js/jquery-1.9.1.min.js');
		$this->load->js('assets/themes/default/hero_files/bootstrap-transition.js');
		$this->load->js('assets/themes/default/hero_files/bootstrap-collapse.js');

		
	}


	

	/*
	 * 
 	 **/
	function index()
	{
		try{

			/* Creamos el objeto */
			$crud = new grocery_CRUD();

			/* Seleccionamos el tema */
			$crud->set_theme('flexigrid');

			/* Seleccionmos el nombre de la tabla de nuestra base de datos*/
			$crud->set_table('proyecto');

			/* Le asignamos un nombre */
			$crud->set_subject('Proyecto');

                        $crud->set_primary_key('id_proyecto','proyecto');
                                              
			/* Asignamos el idioma español */
			$crud->set_language('spanish');
                         
                         /* aqui indicamos la llave primaria de la tabla relacion  */
                        $crud->set_primary_key('id_listageneral ','lista_generalchequeo');
                        
                        /* aqui indicamos las relaciones de la tabla lista general chequeo*/
                        $crud -> set_relation ( 'id_listageneral_chequeo' , 'lista_generalchequeo' , 'nombredependencia_responsable ' ) ;
                        
                        
                       // $crud->callback_edit_field('listageneral_chequeo', array($this,'_call_back_offices'));
                       // $crud->callback_add_field('listageneral_chequeo', array($this,'_call_back_offices'));
                        //$crud->set_relation('listageneral_chequeo', 'listageneral_chequeo', 'listageneral_chequeo');

			/* Aqui le decimos a grocery que estos campos son obligatorios */
			$crud->required_fields(
				'id_proyecto',
				'nombre_proyecto', 
				'codigoBPID',
                               'id_listageneral_chequeo'
			);

			/* Aqui le indicamos que campos deseamos mostrar */
			$crud->columns(
                                'id_proyecto',
				'nombre_proyecto ', 
				'codigoBPID',
                                'id_listageneral_chequeo'
			);
			
                       
			/* Generamos la tabla */
			$output = $crud->render();
			
			/* La cargamos en la vista situada en 
			/applications/views/productos/administracion.php */
			$this->load->view('proyectos/administracion', $output);
			
                        }catch(Exception $e){
			/* Si algo sale mal cachamos el error y lo mostramos */
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
        
        
        

}


