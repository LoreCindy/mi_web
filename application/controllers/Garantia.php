<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Garantia extends CI_Controller {

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
		redirect('garantia/garantia');
	}

	/*
	 * 
 	 **/
	function garantia()
	{
		try{

			/* Creamos el objeto */
			$crud = new grocery_CRUD();

			/* Seleccionamos el tema */
			$crud->set_theme('flexigrid');

			/* Seleccionmos el nombre de la tabla de nuestra base de datos*/
			$crud->set_table('garantia');

			/* Le asignamos un nombre */
			$crud->set_subject('Garantia');

                        $crud->set_primary_key('id_garantia','garantia');
                                              
			/* Asignamos el idioma español */
			$crud->set_language('spanish');

                         /* aqui indicamos la llave primaria de la tabla  */
                       $crud->set_primary_key('id_tipo','tipo_garantia');
                        
                        /* aqui indicamos las relaciones de la tabla Tipo contratación*/
                        $crud -> set_relation ( 'id_tipoGarantia' , 'tipo_garantia' , 'nombre_tipo' ) ;
                        
                        
                         /* aqui indicamos la llave primaria de la tabla relacion revision legalizacion*/
                        $crud->set_primary_key('id_listachequeo_legalizacion','listadechequeo_legalizacioncontrato');
                        
                         /* aqui indicamos las relaciones de la tabla revision estudio previo*/
                       $crud -> set_relation ( 'listaChequeo_legalizacionContrato' , 'listadechequeo_legalizacioncontrato' , 'supervisor' ) ;
                       
                                                                       
			/* Aqui le decimos a grocery que estos campos son obligatorios */
			$crud->required_fields(
				'id_garantia',
				'descripcion_documento',
                                'aseguradora', 
                                 'valor',
                                 'listaChequeo_legalizacionContrato', 
                                 'id_tipoGarantia' ,
                                'numeroGarantia', 
                                'porcentaje', 
                                'tiempo_año'
                                
                               
                               
			);

			/* Aqui le indicamos que campos deseamos mostrar */
			$crud->columns(
				'id_garantia',
				'descripcion_documento',
                                'aseguradora', 
                                 'valor',
                                 'listaChequeo_legalizacionContrato', 
                                 'id_tipoGarantia' ,
                                'numeroGarantia', 
                                'porcentaje', 
                                'tiempo_año'
			);
			
			/* Generamos la tabla */
			$output = $crud->render();
			
			/* La cargamos en la vista situada en 
			/applications/views/productos/administracion.php */
			$this->load->view('garantia/garantia', $output);
			
		}catch(Exception $e){
			/* Si algo sale mal cachamos el error y lo mostramos */
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
}



