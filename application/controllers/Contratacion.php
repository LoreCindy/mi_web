<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Contratacion extends CI_Controller {

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
		redirect('contratacion/contratacion');
	}

	/*
	 * 
 	 **/
	function contratacion()
	{
		try{

			/* Creamos el objeto */
			$crud = new grocery_CRUD();

			/* Seleccionamos el tema */
			$crud->set_theme('flexigrid');

			/* Seleccionmos el nombre de la tabla de nuestra base de datos*/
			$crud->set_table('contratacion');

			/* Le asignamos un nombre */
			$crud->set_subject('Contratacion');

                        $crud->set_primary_key('id_contratacion','contratacion');
                                              
			/* Asignamos el idioma español */
			$crud->set_language('spanish');

                        /* aqui indicamos el buscador de un archivo en pdf */
                       // $crud->set_field_upload('documento', 'assets/uploads/files');
                         
                        /* aqui indicamos la llave primaria de la tabla  */
                        $crud -> set_primary_key ('id_tipocontratacion' , 'tipo_contratacion') ;
                        
                        /* aqui indicamos las relaciones de la tabla Tipo contratación*/
                        $crud -> set_relation ('tipocontratacion' , 'tipo_contratacion' , 'nombre_tipocontratacion') ;
                        
                                                                       
                          /* aqui indicamos la llave primaria de la tabla documento  */
                        $crud -> set_primary_key ('id_documento' , 'documento') ;
                        
                        /* aqui indicamos las relaciones de la tabla documento*/
                       $crud -> set_relation ('documento' , 'documento' , 'nombre_documento') ;
                        
			/* Aqui le decimos a grocery que estos campos son obligatorios */
			$crud->required_fields(
				'id_contratacion',
				'nombre_proyecto',
                                'responsable', 
                                'informacionBancaria', 
                                'informacion_interventor', 
                                'firma_directora', 
                                'firma_contratista', 
                                'tipocontratacion', 
                                'documento' 
			);

			/* Aqui le indicamos que campos deseamos mostrar */
			$crud->columns(
				'id_contratacion',
				'nombre_proyecto',
                                'responsable', 
                                'informacionBancaria', 
                                'informacion_interventor', 
                                'firma_directora', 
                                'firma_contratista', 
                                'tipocontratacion', 
                                'documento' 
			);
			
			/* Generamos la tabla */
			$output = $crud->render();
			
			/* La cargamos en la vista situada en 
			/applications/views/productos/administracion.php */
			$this->load->view('contratacion/contratacion', $output);
			
		}catch(Exception $e){
			/* Si algo sale mal cachamos el error y lo mostramos */
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
}



