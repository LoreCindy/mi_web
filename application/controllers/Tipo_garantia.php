<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Tipo_garantia extends CI_Controller {

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
		redirect('tipo_garantia/tipo_garantia');
	}

	/*
	 * 
 	 **/
	function tipo_garantia()
	{
		try{

			/* Creamos el objeto */
			$crud = new grocery_CRUD();

			/* Seleccionamos el tema */
			$crud->set_theme('flexigrid');

			/* Seleccionmos el nombre de la tabla de nuestra base de datos*/
			$crud->set_table('tipo_garantia');
			/* Le asignamos un nombre */
			$crud->set_subject('Tipo_Garantia');

                        $crud->set_primary_key('id_tipo','tipo_garantia');
                                              
			/* Asignamos el idioma español */
			$crud->set_language('spanish');

                         /* aqui indicamos la llave primaria de la tabla  */
                      //  $crud -> set_primary_key ( 'id_garantia' , 'garantia' ) ;
                        
                        /* aqui indicamos las relaciones de la tabla Tipo contratación*/
                        //$crud -> set_relation ( 'tipocontratacion' , 'tipo_contratacion' , 'nombre_tipocontratacion' ) ;
                        
                                                                       
			/* Aqui le decimos a grocery que estos campos son obligatorios */
			$crud->required_fields(
				'id_tipo',
				'nombre_tipo'
                                
			);

			/* Aqui le indicamos que campos deseamos mostrar */
			$crud->columns(
				'id_tipo',
				'nombre_tipo'
			);
			
			/* Generamos la tabla */
			$output = $crud->render();
			
			/* La cargamos en la vista situada en 
			/applications/views/productos/administracion.php */
			$this->load->view('tipo_garantia/tipo_garantia', $output);
			
		}catch(Exception $e){
			/* Si algo sale mal cachamos el error y lo mostramos */
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
}




