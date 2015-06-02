<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of my_custom_model
 *
 * @author cindy
 */
class my_custom_model extends grocery_CRUD_Model{
    
    
function  get_relation_n_n_unselected_array ( $field_info, $selected_values ​​) 
    { 
        $selection_primary_key = $this -> get_primary_key ( $field_info -> selection_table ) ;
 
        if( $field_info -> nombre = '....' )
 
        { 
            $this->db -> where ('....' );
           // ....... tus consultas personalizadas
        }
 
        $This -> db -> order_by ( "{$field_info-> selection_table} {$field_info-> title_field_selection_table}." ) ;
 
        $resultados = $this -> db -> conseguir ( $field_info -> selection_table ) -> resultado ( ) ;
 
 
        $Results_array = array ( ) ;
         foreach ( $resultados  as  $fila )
 
        { 
            if ( ! isset ( $selected_values [ $row -> { $field_info -> primary_key_alias_to_selection_table } ] ) ) 
                $results_array [ $row -> { $field_info -> primary_key_alias_to_selection_table } ] = $row -> { $field_info -> title_field_selection_table } ; 
         }
 
 
         return  $results_array ;        
     }
}

?>
