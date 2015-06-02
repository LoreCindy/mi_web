<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class  ListaDeChequeo_legalizacionContrato extends CI_Controller {

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
		redirect('listaDeChequeo_legalizacionContrato/listaDeChequeo_legalizacionContrato');
	}

	/*
	 * 
 	 **/
	function listaDeChequeo_legalizacionContrato()
	{
		try{

			/* Creamos el objeto */
			$crud = new grocery_CRUD();

			/* Seleccionamos el tema */
			$crud->set_theme('flexigrid');

			/* Seleccionmos el nombre de la tabla de nuestra base de datos*/
			$crud->set_table('listadechequeo_legalizacioncontrato');
			/* Le asignamos un nombre */
			$crud->set_subject('ListaDeChequeo_legalizacionContrato');

                        $crud->set_primary_key('id_listachequeo_legalizacion','listadechequeo_legalizacioncontrato');
                                              
			/* Asignamos el idioma español */
			$crud->set_language('spanish');

                         /* aqui indicamos la llave primaria de la tabla relacion  */
                        $crud->set_primary_key('id_contratacion','contratacion');
                        
                        /* aqui indicamos las relaciones de la tabla Tipo contratación*/
                        $crud -> set_relation ( 'id_contratacion' , 'contratacion' , 'nombre_proyecto' ) ;
                        
                                                                       
			/* Aqui le decimos a grocery que estos campos son obligatorios */
			$crud->required_fields(
				'id_listachequeo_legalizacion',
				'supervisor',
                                'observaciones',
                                'nombre_quienRecibe',
                                'nombreDendencia',
                                'fecha',
                                'id_contratacion'
                                
			);

			/* Aqui le indicamos que campos deseamos mostrar */
			$crud->columns(
				'id_listachequeo_legalizacion',
				'supervisor',
                                'observaciones',
                                'nombre_quienRecibe',
                                'nombreDendencia',
                                'fecha',
                                'id_contratacion'
			);
			
			/* Generamos la tabla */
			$output = $crud->render();
			
			/* La cargamos en la vista situada en 
			/applications/views/productos/administracion.php */
			$this->load->view('listaDeChequeo_legalizacionContrato/listaDeChequeo_legalizacionContrato', $output);
			
		}catch(Exception $e){
			/* Si algo sale mal cachamos el error y lo mostramos */
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
}





