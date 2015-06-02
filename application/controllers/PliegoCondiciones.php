<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class  PliegoCondiciones extends CI_Controller {

	function __construct() 
	{
		
		parent::__construct();

		/* Cargamos la base de datos */
		$this->load->database();

		/* Cargamos la libreria*/
		$this->load->library('grocery_crud');

		/* Añadimos el helper al controlador */
		$this->load->helper('url');
	}

	function index() 
	{
		/*
		 * Mandamos todo lo que llegue a la funcion
		 * administracion().
		 **/
		redirect('pliegocondiciones/pliegocondiciones');
	}

	/*
	 * 
 	 **/
	function pliegocondiciones()
	{
		try{

			/* Creamos el objeto */
			$crud = new grocery_CRUD();

			/* Seleccionamos el tema */
			$crud->set_theme('flexigrid');

			/* Seleccionmos el nombre de la tabla de nuestra base de datos*/
			$crud->set_table('pliego_condiciones');
			/* Le asignamos un nombre */
			$crud->set_subject('Pliego_Condiciones');

                        $crud->set_primary_key('id_pliego_condicion','pliego_condiciones');
                                              
			/* Asignamos el idioma español */
			$crud->set_language('spanish');

                         /* aqui indicamos la llave primaria de la tabla relacion proyecto */
                          $crud->set_primary_key('id_proyecto','proyecto');
                        
                        /* aqui indicamos las relaciones de la tabla Proyecto*/
                       $crud -> set_relation ( 'id_proyecto' , 'proyecto' , 'nombre_proyecto' ) ;
                       
                       
                          /* aqui indicamos la llave primaria de la tabla relacion documento */
                        $crud->set_primary_key('id_documento','documento');
                        
                         /* aqui indicamos las relaciones de la tabla documento*/
                       $crud -> set_relation ( 'id_documento' , 'documento' , 'nombre_documento' ) ;
                        
                                                                       
			/* Aqui le decimos a grocery que estos campos son obligatorios */
			$crud->required_fields('id_pliego_condicion','descripcion_pliego_condicion','id_documento','id_proyecto'                               
			);

			/* Aqui le indicamos que campos deseamos mostrar */
			$crud->columns(
				'id_pliego_condicion ',
				'descripcion_pliego_condicion',
                                'id_documento',
                                'id_proyecto'
			);
			
			/* Generamos la tabla */
			$output = $crud->render();
			
			/* La cargamos en la vista situada en 
			/applications/views/productos/administracion.php */
			$this->load->view('pliegocondiciones/pliegocondiciones', $output);
			
		}catch(Exception $e){
			/* Si algo sale mal cachamos el error y lo mostramos */
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
}





