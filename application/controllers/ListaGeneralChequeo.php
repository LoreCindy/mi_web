<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Heredamos de la clase CI_Controller */
class ListaGeneralChequeo extends CI_Controller {

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
			$crud->set_table('lista_generalchequeo');

			/* Le asignamos un nombre */
			$crud->set_subject('Lista_generalchequeo');

                        $crud->set_primary_key('id_listageneral','lista_generalchequeo');
                        
                        
                         /* aqui indicamos la llave primaria de la tabla relacion revision estudio previo*/
                        $crud->set_primary_key('id_listachequeorevisioestudio','listachequeo_revisionestudiop');
                        
                         /* aqui indicamos las relaciones de la tabla revision estudio previo*/
                       $crud -> set_relation ( 'id_listaChequeo_revisionEstudioP' , 'listachequeo_revisionestudiop' , ' nombre_supervisor' ) ;
                       
                       
                        /* aqui indicamos la llave primaria de la tabla relacion revision legalizacion*/
                        $crud->set_primary_key('id_listachequeo_legalizacion','listadechequeo_legalizacioncontrato');
                        
                         /* aqui indicamos las relaciones de la tabla revision estudio previo*/
                       $crud -> set_relation ( 'id_listaChequeo_legalizacionContrato' , 'listadechequeo_legalizacioncontrato' , 'supervisor' ) ;
                                           
			/* Asignamos el idioma español */
			$crud->set_language('spanish');

			/* Aqui le decimos a grocery que estos campos son obligatorios */
			$crud->required_fields('id_listageneral',
                                'nombredependencia_responsable', 
                                'nombrelista_chequeo', 
                                'informacion_general', 
                                'id_listaChequeo_revisionEstudioP',
                                'id_listaChequeo_legalizacionContrato',
                                'observaciones');

			/* Aqui le indicamos que campos deseamos mostrar */
			$crud->columns(
                                'id_listageneral',
                                'nombredependencia_responsable', 
                                'nombrelista_chequeo', 
                                'informacion_general', 
                                'id_listaChequeo_revisionEstudioP',
                                'id_listaChequeo_legalizacionContrato',
                                'observaciones');
                                             
                                                
			/* Generamos la tabla */
			$output = $crud->render();
			
			/* La cargamos en la vista situada en 
			/applications/views/productos/administracion.php */
			$this->load->view('listageneralchequeo/listageneralchequeo', $output);
			
		}catch(Exception $e){
			/* Si algo sale mal cachamos el error y lo mostramos */
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
}




