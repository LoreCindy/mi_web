<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Heredamos de la clase CI_Controller */
class EstudioPrevio extends CI_Controller {

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
		redirect('estudioprevio/estudioprevio');
	}

	/*
	 * 
 	 **/
	function estudioprevio()
	{
		try{

			/* Creamos el objeto */
			$crud = new grocery_CRUD();

			/* Seleccionamos el tema */
			$crud->set_theme('flexigrid');

			/* Seleccionmos el nombre de la tabla de nuestra base de datos*/
			$crud->set_table('estudio_previo');

			/* Le asignamos un nombre */
			$crud->set_subject('Estudio_previo');

                        $crud->set_primary_key('id_estudioPrevio','estudio_previo');
                        
                        /* aqui indicamos la llave primaria de la tabla relacion */
                      $crud -> set_primary_key ( 'id_modalidad' , 'modalidad_seleccion' ) ;
                        
                        /* aqui indicamos las relaciones de la tabla modalidad de seleccion*/
                      $crud -> set_relation ( 'id_modalidadSeleccion' , 'modalidad_seleccion' , ' nombre_modalidad' ) ;
                        
                      // $crud ->set_relation_n_n(  'idproyecto' ,  'proyecto', '', 'id_proyecto ', $primary_key_alias_to_selection_table, $title_field_selection_table);
                       
                        /* aqui indicamos la llave primaria de la tabla relacion */
                        $crud->set_primary_key('id_proyecto','proyecto');
                        
                        /* aqui indicamos las relaciones de la tabla proyecto*/
                        $crud -> set_relation ( 'idproyecto' , 'proyecto' , 'nombre_proyecto' ) ;
                                              
                        
                        
                        
                       /* aqui indicamos la llave primaria de la tabla relacion */
                        $crud->set_primary_key('id_listachequeo_revisioestudio','listachequeo_revisionestudiop');
                        
                        /* aqui indicamos las relaciones de la tabla proyecto*/
                        $crud -> set_relation ( 'id_listaChequeo_RevisionEstudioP' , 'listachequeo_revisionestudiop' , 'nombre_supervisor' ) ;
			/* Asignamos el idioma español */
			$crud->set_language('spanish');

			/* Aqui le decimos a grocery que estos campos son obligatorios */
			$crud->required_fields(
				'id_estudioPrevio',
				'nombre_estudioPrevio', 
				'descripcion',
                                'estudio_documentos',
                                'estudio_DeSector',
                                'criterios_seleccion_oferta',
                                'analisis_delRiesgo',
                                'nombre_funcionario',
                                'id_modalidadSeleccion',
                                'id_listaChequeo_RevisionEstudioP',
                                'idproyecto'
                                
			);

			/* Aqui le indicamos que campos deseamos mostrar */
			$crud->columns(
				'id_estudioPrevio',
				'nombre_estudioPrevio', 
				'descripcion',
                                'estudio_documentos',
                                'estudio_DeSector',
                                'criterios_seleccion_oferta',
                                'analisis_delRiesgo',
                                'nombre_funcionario',
                                'id_modalidadSeleccion',
                                'id_listaChequeo_RevisionEstudioP',
                                'idproyecto'
			);
			
			/* Generamos la tabla */
			$output = $crud->render();
			
			/* La cargamos en la vista situada en 
			/applications/views/productos/administracion.php */
			$this->load->view('estudioprevio/estudioprevio', $output);
			
		}catch(Exception $e){
			/* Si algo sale mal cachamos el error y lo mostramos */
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
}




