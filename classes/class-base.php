<?php
defined('ABSPATH') or die("No script kiddies please!");

abstract class NOVIS_CSI_CLASS{
	public 			$class_name;		//como se definió en novis_csi_vars
	protected 		$name_single;		//Nombre singular para títulos, mensajes a usuario, etc.
	protected 		$name_plural;		//Nombre plural para títulos, mensajes a usuario, etc.
	protected 		$parent_slug;		//Identificador de menú padre
	protected 		$menu_slug;			//Identificador de submenú de la clase
	protected 		$plugin_post;		//Utilizado para validaciones (deprecated)
	protected 		$p_post;			//Utilizado para validaciones
	protected 		$capability;		//Permisos de usuario a nivel de backend WordPRess
	public	 		$tbl_name;			//Tabla de la clase
	protected 		$tbl_prefix;		//Tabla de la clase
	public	 		$network_class;		//Network activated class flag (for multisite installations)
	protected 		$db_version;		//Versión de DB (para registro y actualización automática)
	protected 		$crt_tbl_sql;		//Sentencia SQL de creación (y ajuste) de la tabla de la clase
	protected 		$crt_tbl_sql_wt;	//Sentencia SQL de creación (y ajuste) sin el nombre de la tabla
	protected 		$db_fields;			//Registro de columnas de la tabla utilizado para validaciones y visualización de formatos
//---------------------------------------------------------------------------------------------------------------------------------------------------------
/**
* Create or update the Class DB Table structure
*
* This function launches with the register_activation_hook. It executes the
* 'create table' sentence. If the Class table_db_version is higher or
* non-existent.
*
* @author Cristian Marin
*/
public function db_install(){
	global $wpdb;
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	
	if ( is_multisite() && FALSE == $this->network_class ) {
		// Get all blogs in the network and create or update the table on each one
		$args = array(
			'network_id'	=> $wpdb->siteid,
			'public'    	=> null,
			'archived'  	=> null,
			'mature'    	=> null,
			'spam'      	=> null,
			'deleted'   	=> null,
			'limit'     	=> 200,
			'offset'    	=> 1,
		); 
		$sites = wp_get_sites($args);
		foreach ( $sites as $i => $site ) {
			if ( true == switch_to_blog( $site['blog_id'] ) ) {
				$this->tbl_name = $wpdb->prefix	.$this->table_prefix.$this->class_name;
				$this->crt_tbl_sql	=	"CREATE TABLE ".$this->tbl_name." ".$this->crt_tbl_sql_wt;

				$current_db_version = get_option( $this->tbl_name."_db_version");
				if( $current_db_version == false || $current_db_version != $this->db_version ){
					$delta = dbDelta($this->crt_tbl_sql);
					self::write_log($delta);
					update_option( $this->tbl_name."_db_version" , $this->db_version );
				}
				restore_current_blog();				
			}else{
				self::write_log('No hay blog con el ID: '.$site['blog_id']);
			}
		}
    } else {
		$current_db_version = get_option( $this->tbl_name."_db_version");
		if( $current_db_version == false || $current_db_version != $this->db_version ){
			$delta = dbDelta($this->crt_tbl_sql);
			self::write_log($delta);
			update_option( $this->tbl_name."_db_version" , $this->db_version );
		}
	}
	return true;
}
//---------------------------------------------------------------------------------------------------------------------------------------------------------
/**
* Registers the Class submenu in the WordPress system.
*
* This function is called by the Wordpress 'admin_menu' action.
*
* @since 1.0
* @author Cristian Marin
*/
public function register_submenu_page() {
	global $novis_csi_vars;
	$parent_slug	=$this->parent_slug;
	$page_title		='Administraci&oacute;n de '.$this->name_plural;
	$menu_title		=$this->name_plural;
	$capability		=$this->capability;
	$menu_slug		=$this->menu_slug;
	$function		=array( $this , "bluid_submenu_page" );

	add_submenu_page(
		$parent_slug,
		$page_title,
		$menu_title,
		$capability,
		$menu_slug,
		$function
	);
}

//---------------------------------------------------------------------------------------------------------------------------------------------------------
/**
* Generates the basic Class Wordpress Admin Adminitration page.
* This function evaluates the $_GET variables in order to correctly display the
* desire content.
* It also calls the eval_post_vars() function to evaluates and execute POST
* functions
* This function is called by the Wordpress 'add_submenu_page' function.
*
* @since 1.0
* @author Cristian Marin
*/
public function bluid_submenu_page(){
	wp_register_style(
		"ics_admin_style",
		CSI_PLUGIN_URL.'/css/admin.css' ,
		null,
		"1.0",
		"all"
		);
	wp_enqueue_style("ics_admin_style" );
	wp_register_script(
		'ics_WPADMIN',
		CSI_PLUGIN_URL.'/js/admin-min.js' ,
		array('jquery'),
		'1.0'
	);
	wp_enqueue_script('ics_WPADMIN');
	wp_localize_script(
		'ics_WPADMIN',
		'icsWPADMIN',
		array(
			'ppost'		=> $this->plugin_post,
			'ajaxurl'	=> admin_url( 'admin-ajax.php' ),
		)
	);
	$output='<div class="bootstrap-wrapper">';
	$output.='<div class="container-fluid">';
		$output.='<div class="page-header">';
			$QS = http_build_query(array_merge($_GET, array(
					"action"		=>'add',
					'actioncode' 	=> wp_create_nonce("add"),
					)));
			$URL=htmlspecialchars('?'.$QS);

//			$link.='?page='.$this->menu_slug.'&action=add&actioncode='.wp_create_nonce($element['id']."add");
			$link=$URL;
			$output.='<div class="page-header"><h1>Administraci&oacute;n de  '.$this->name_plural.' <small>(<a href="'.$link.'">Crear nuevo</a>)</small></h2></div>';
		$output.='</div>';
//	$output.='</div>';
	$action = ( isset( $_GET["action"] ) ) ? $_GET["action"] : "";
	$item = ( isset( $_GET["item"] ) ) ? $_GET["item"] : "";
	$actioncode = ( isset( $_GET["actioncode"] ) ) ? $_GET["actioncode"] : "";

	
	$output.=self::eval_post_vars('post');
	switch($action){
		case 'add':
			$output.=$this->show_form("add");
			break;
		case 'edit':
			$output.=$this->show_form("edit",$item );				
			break;
		case null:
		case '':
			$output.=$this->show_table();
			break;
		default:
			$output.=$this->special_wp_admin_page($action);
	}
	$output.="</div>";
	$output.="</div>";
	echo $output;
}
protected function special_wp_admin_page($action){
	if(method_exists($this, $action)){
		return call_user_func_array(array($this, $action), array());
	}else{
		return false;
	}
}
//---------------------------------------------------------------------------------------------------------------------------------------------------------
/**
* Check the content of the REQUEST (GET and POST) variables and subsequently
* choses an action to perform.
* The main POST variable with all the content would be the self $plugin_post
* variable.
*
* @since 1.0
* @author Cristian Marin
*/
protected function eval_post_vars($method = null){
	global $novis_csi_vars;
	$response='';
	if ($method == 'post'){
		$post = isset( $_POST[$this->plugin_post] ) ? $_POST[$this->plugin_post] : null;
	}else{
		$post = isset( $_REQUEST[$this->plugin_post] ) ? $_REQUEST[$this->plugin_post] : null;
	}
//	$response.=$post;
	if( $post != '' ){
		if( isset( $post["action"] ) && isset( $post["actioncode"] ) ){
			if( wp_verify_nonce( $post["actioncode"], $post["action"] ) ){
				switch ( $post["action"] ){
					case "add":
						$query=self::update_class_row('add',$post);
						if($query['status'] == 'ok'){
							$response = '<div class="alert alert-success" role="alert">'.$query['message'].'</div>';
						}else{
							$response = '<div class="alert alert-warning" role="alert">'.$query['message'].'</div>';
						}
						break;
					case "bulkdelete":
						self::bulk_delete( $post );
						break;
					case "edit":
						$query=self::update_class_row('edit',$post);
						if($query['status'] == 'ok'){
							$response = '<div class="alert alert-success" role="alert">'.$query['message'].'</div>';
						}else{
							$response = '<div class="alert alert-warning" role="alert">'.$query['message'].'</div>';
						}
						break;
				}
			}else{
				$response = '<div class="alert alert-danger" role="alert">Error de validación de seguridad (wp_verify_nonce).</div>';
			}
		}else{
			$response = '<div class="alert alert-danger" role="alert">Error de validación de variables post (action & actioncode).</div>';			
		}
	}
	return $response;
}
//---------------------------------------------------------------------------------------------------------------------------------------------------------
/**
* Adds or Updates a single Class row into the database.
* This function evaluates the input array regarding the class $db_fields.
* Every db_field input is analyzed according to its 'type' definition, and prepares
* non-user inputs (e.g. timestamp, id)
*
* This function returns an array with status, and the id of the inserted row.
*
* @since 1.0
* @author Cristian Marin
*/
protected function update_class_row($action="edit", $postvs ){
	global $wpdb;
	$response = array();
	if(self::check_form_values($postvs)){
		$current_user = wp_get_current_user();
		$insertArray 	= array();
		$editArray		= array();
		$editArray_eval	= array();
		$whereArray		= array();
		foreach($this->db_fields as $key => $db_field){
			switch($db_field['type']){
				case 'id':
					$insertArray[$key]='';
					if( isset($postvs[$key]) ){
						$whereArray=array($key => intval($postvs[$key]));
					}
					break;
				case 'dual_id':
					$insertArray[$key] = $whereArray[$key] = $editArray[$key] = intval($postvs[$key]);
					break;
				case 'timestamp':
					$insertArray[$key]=current_time( 'mysql');
					break;
				case 'create_user_id':
					$insertArray[$key]=intval(get_current_user_id());
					break;
				case 'create_user_email':
					$insertArray[$key]=$current_user->user_email;
					break;
				case 'create_date':
					$insertArray[$key]=date("Y-m-d");
					break;
				case 'create_time':
					$insertArray[$key]=date("H:i:s");
					break;
				case 'edit_user_id':
					$insertArray[$key]=intval(get_current_user_id());
					break;
				case 'edit_user_email':
					$editArray[$key]=$current_user->user_email;
					break;
				case 'edit_date':
					$editArray[$key]=date("Y-m-d");
					break;
				case 'edit_time':
					$editArray[$key]=date("H:i:s");
					break;
				case 'nat_number':
				case 'select':
					$insertArray[$key] = $editArray[$key] = intval($postvs[$key]);
					break;
				case 'bool':
					if(isset($postvs[$key])):
						$insertArray[$key] = $editArray[$key] = 1;
					else:
						$insertArray[$key] = $editArray[$key] = 0;
					endif;
					break;
				case 'exclude':
				case 'display':
					break;
				default:
					if ( isset ( $postvs[$key] ) ) {
						$insertArray[$key] = $editArray[$key] = strip_tags(stripslashes( $postvs[$key] ));
					}
			}
		}
		$response['insert']=$insertArray;
		$response['edit']=$editArray;
		$response['where']=$whereArray;
		if($action == 'add'){
			if ( $wpdb->insert( $this->tbl_name, $insertArray ) ){
				$response['id']=$wpdb->insert_id;
				$response['status']='ok';
				$response['message']="El nuevo ".$this->name_single." ha sido guardado.";
			}else{
				$response['status']='error';
				$response['message']="Hubo un error al agregar el nuevo ".$this->name_single."; intenta nuevamente. :)";
			}
		}elseif($action == 'edit'){
			$result = $wpdb->update($this->tbl_name,$editArray,$whereArray);
			if( $result === false ){
				$response['status']='error';
				$response['message']="Hubo un error al editar el ".$this->name_single."; intenta nuevamente. :)";
			}elseif ( $result == 0){
				$response['status']='error';
				$response['message']="Los valores son iguales. ".$this->name_single." no modificado.";
			}else{
				$response['status']='ok';
				$response['message']=$this->name_single." editado exitosamente.";
			}
		}elseif($action == 'delete'){
			self::write_log($this->tbl_name);
			self::write_log($editArray);
			self::write_log($whereArray);
			$result = $wpdb->delete($this->tbl_name,$editArray,null);
			if( $result === false ){
				$response['status']='error';
				$response['message']="Hubo un error al eliminar el ".$this->name_single."; intenta nuevamente. :)";
			}elseif ( $result == 0){
				$response['status']='error';
				$response['message']="No hay ".$this->name_plural." que eliminar.";
			}else{
				$response['status']='ok';
				$response['message']=$this->name_single." eliminado exitosamente.";
			}
		}
	}else{
		$response['status']='error';
		$response['message']="No has ingresado los datos correctos para ";
		$response['message'].=(($action=='add')?'un nuevo ':'editar un').$this->name_single."; intenta nuevamente. :)";
	}
	return $response;
	
}
//---------------------------------------------------------------------------------------------------------------------------------------------------------
/**
* Check the correct values of the required input variables according to
* Class definition by $db_fields.
*
* @since 1.0
* @author Cristian Marin
*/
protected function check_form_values( $postvs=null){
	foreach ( $this->db_fields as $key => $db_field ) {
		if ( true == $db_field['data_required'] ) {
			switch($db_field['type']){
				case 'id':
					break;
				case 'number':
					if ( !is_numeric( $postvs[$key] ) ) {
						return false;
					}elseif ( isset( $db_field['data-validation'] ) ) {
						
					}
					break;
				case 'nat_number':
					if (!is_numeric($postvs[$key]) || $postvs[$key]<1):
						return false;
					endif;
					break;
				case 'select':
					if (!is_numeric($postvs[$key]) || $postvs[$key]<1):
						return false;
					endif;
					break;
				case 'text':
					if (!is_string($postvs[$key]) || $postvs[$key]==''):
						return false;
					endif;
					break;
				default:
			}
		}
	}
	return true;
}
//---------------------------------------------------------------------------------------------------------------------------------------------------------
/**
* Creates the main content of the administation page
*
* @global wpdb $wpdb
* @since 1.0
* @author Cristian Marin
* @package WordPress
*/
function show_table(){
	//Global
	global $wpdb;
	global $novis_csi_vars;
	$output='';
	$output.='<table class="table table-striped table-condensed">';
	$output.='<thead>';
	$output.='<tr>';
	foreach($this->db_fields as $key => $db_field){
		if(isset($db_field['backend_wp_in_table']) &&  $db_field['backend_wp_in_table'] == true){
			$output.='<th>';
			$output.='<p class="text-uppercase ">'.$db_field['form_label'].'</p>';
			$output.='</th>';
		}
	}
	$output.='</tr>';
	$output.='</thead>';
	$output.='<tbody>';
	$content=self::select_rows();
	$output.=$content['tbody'];
	$output.='</tbody>';
	$output.='</table>';
	$output.=$content['pagination'];
	return $output;
}
//---------------------------------------------------------------------------------------------------------------------------------------------------------
/**
* Selects a subset of the class registry, based on the $_REQUEST variables.
*
*
*
* @since 1.0
* @author Cristian Marin
*/
protected function select_rows($elem_per_page = 10){
	global $wpdb;
	global $novis_csi_vars;
	$response=array();
	$sql_elements=array();
	$display_elements=array();
	settype($tbody,'string');
	settype($nav,'string');
	$current_page=isset($_REQUEST['pageno']) ? $_REQUEST['pageno'] : 1;
	foreach($this->db_fields as $key => $db_field) {
		if( isset( $db_field['backend_wp_in_table'] ) ) {
			if ( true == $db_field['backend_wp_in_table'] ) {
				if ( $db_field['type'] != 'display' ) {
					array_push($sql_elements, $key);
				}
			}
		}
	}
	if ( 0 == count($sql_elements) ){
		$response['tbody']='<tr class="danger"><td class="text-center" colspan="999"><p class="lead">La clase no est&aacute; configurada para desplegar estos men&uacute;.</p></td><tr>';
		$response['pagination'] = '';
		return $response;
	}
	$sql="SELECT ".implode(",", $sql_elements)." 
			FROM ".$this->tbl_name."
			LIMIT ".$elem_per_page*($current_page-1).",".$elem_per_page;
	$elements=self::get_sql($sql);
	foreach($elements as $element){
		$tbody.="<tr>";
		foreach($this->db_fields as $key => $db_field){
			if($db_field['type'] == 'display'){
				$element[$key]=true;
			}
		}
		foreach($element as $key => $value){
			$tbody.='<td>';
//			$tbody.=' key: '.$key.'<br/>';
//			$tbody.=' value: '.$value.'<br/>';
//			$tbody.=' id: '.$element['id'].'<br/>';
			if(isset($this->db_fields[$key]['backend_wp_in_table']) && true == $this->db_fields[$key]['backend_wp_in_table'] ){
				if ( method_exists ( $this, 'backend_wp_sp_table_'.$key ) ) {
					$tbody.=call_user_func_array(array($this, 'backend_wp_sp_table_'.$key), array($value,$element));
				}else{
					$tbody.=$value;
				}
			}else{
				$tbody.=$value;
			}
			
				if(isset($this->db_fields[$key]['backend_wp_table_lead']) && $this->db_fields[$key]['backend_wp_table_lead'] == true){
				$tbody.='<div class="row-actions">';
					$tbody.='<span class="edit">';
						$tbody.='<a href="?page='.$this->menu_slug.'&action=edit&item=';
						$tbody.=$element['id'].'&actioncode='.wp_create_nonce($element['id']."edit").'" ';
//						$tbody.='class="btn btn-default btn-sm"';
						$tbody.='>';
							$tbody.='Editar';
						$tbody.='</a>';
					$tbody.='</span>';
				$tbody.='</div>';
			}
			$tbody.='</td>';
		}
		$tbody.="</tr>";
	}
	$count =intval($wpdb->get_var( "SELECT COUNT(*) FROM ".$this->tbl_name));
	$total_pages=ceil($count / $elem_per_page );
	if($total_pages > 1){
		$nav='<nav aria-label="...">';
			$nav.='<ul class="pagination">';
				$prev=($current_page-1 > 1)?$current_page-1 : 1;
				$QS = http_build_query(array_merge($_GET, array("pageno"=>$prev)));
				$URL=htmlspecialchars('?'.$QS);
				$nav.='<li class="'.($current_page==1 ? 'disabled' : '').'"><a href="'.$URL.'" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
				for($i=1; $i <= $total_pages ; $i++){
					$QS = http_build_query(array_merge($_GET, array("pageno"=>$i)));
				$URL=htmlspecialchars('?'.$QS);
					$nav.='<li class="'.($current_page == $i ? 'active' : '').'"><a href="'.$URL.'">'.$i.'<span class="sr-only">(current)</span></a></li>';
				}
				$post=($current_page+1 < $total_pages)?$current_page+1 : $total_pages;
				$QS = http_build_query(array_merge($_GET, array("pageno"=>$post)));
				$URL=htmlspecialchars('?'.$QS);
				$nav.='<li class="'.($total_pages==$current_page ? 'disabled' : '') .'"><a href="'.$URL.'" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>';
			$nav.='</ul>';
		$nav.='</nav>';
	}
	$response['tbody']=$tbody;
	$response['pagination']=$nav;
	return $response;
}
//---------------------------------------------------------------------------------------------------------------------------------------------------------
/**
* Read a single Class registry from the database
* $output_style
*  + ARRAY_A	:array of rows (associative array (column => value, ...))
*  + ARRAY_N	:array of rows (numerically indexed array (0 => value, ...))
*  + OBJECT		:array of rows (object. ( ->column = value ))
*  + OBJECT_K	:associative array of row objects keyed by the value of each row's first column's value. Duplicate keys are discarded.
* @since 1.0
* @author Cristian Marin
*/
function get_all($output_style='ARRAY_A'){
	global $wpdb;
	global $novis_csi_vars;
	$output = $wpdb->get_results( "SELECT * FROM ".$this->tbl_name,$output_style);
	if($novis_csi_vars['DEBUG']):
		$wpdb->show_errors();
	endif;
	return $output;
}
//---------------------------------------------------------------------------------------------------------------------------------------------------------
/**
* Read a single Class registry from the database
*
* $id			: id of the wanted row
* $output_style
*  + ARRAY_A	:array of rows (associative array (column => value, ...))
*  + ARRAY_N	:array of rows (numerically indexed array (0 => value, ...))
*  + OBJECT		:array of rows (object. ( ->column = value ))
*  + OBJECT_K	:associative array of row objects keyed by the value of each row's first column's value. Duplicate keys are discarded.
* @since 1.0
* @author Cristian Marin
*/
function get_single( $id = 0 , $output_style = 'ARRAY_A' ){
	global $wpdb;
	global $novis_csi_vars;
	$output = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM ".$this->tbl_name." WHERE `id` = %d", $id ),$output_style );
	if($novis_csi_vars['DEBUG']):
		$wpdb->show_errors();
	endif;
	return $output;
}
//---------------------------------------------------------------------------------------------------------------------------------------------------------
/**
* Read all Class registry from the database
*
* @since 1.0
* @author Cristian Marin
*/
function get_sql($sql , $output_style = 'ARRAY_A' ){
	global $wpdb;
	global $novis_csi_vars;
	//Protects from SQL injection and names with apostrophes
	//$sql = $mysqli->real_escape_string($sql);
	$output=$wpdb->get_results( $sql, $output_style );
	if($novis_csi_vars['DEBUG']):
		$wpdb->show_errors();
	endif;
	return $output;
}
//---------------------------------------------------------------------------------------------------------------------------------------------------------
/**
* Form to add/edit a single Class registry
*
* @since 1.0
* @author Cristian Marin
*/
public function show_form(
					$type=null,				//add,update
					$item=null,				//id a editar
					$menu_slug=null,
					$plugin_post=null,
					$fields=null,
					$id=null){
	global $wpdb;
	$tbody='';
	switch($type){
		case 'edit':
			$title='Editar ';
			$subtitle=' <small>(ID: '.$item.')</small>';
			$sql="SELECT * FROM ".$this->tbl_name." WHERE id=".$item;
			$element=self::get_single( $item);
			foreach ( $this->db_fields as $key => $field ) {
				if ( $this->db_fields[$key]['type'] != 'display' ) {
					$this->db_fields[$key]['value'] = $element[$key];					
				}
			}
			break;
			//Seleccionar valores
		case 'add':
			$title='Crear nuevo ';
			$subtitle='';
			break;
	}
	$output='';
	$output.='<div class="row">';
		$output.='<div class="page-header">';
			$output.='<h3>'.$title.$this->name_single.$subtitle.'</h3>';
		$output.='</div>';
		$output.='<form
					class="form-horizontal"
					action="?page='.$this->menu_slug.'"
					method="post"
					id="'.$this->menu_slug.'"
					>';
	$output.='<input type="hidden" name="'.$this->plugin_post.'[action]" value="'.$type.'" />';
	$output.=wp_nonce_field( $type, $this->plugin_post."[actioncode]",true,false);
	if(isset($item)){
		$output.='<input type="hidden" name="'.$this->plugin_post.'[id]" value="'.$item.'" />';
	}
	
//	wp_create_nonce($element['id']."edit")
	foreach ( $this->db_fields as $key => $field ) {
		
		$id=$this->plugin_post.'['.$key.']';

		$data_required = '';
		if ( isset( $field['data_required'] ) ) {
			if( null != $field['data_required'] ) {
				$data_required = ' data-required="true" ';
			}
		}

		$data_validation = '';
		if ( isset( $field['data_validation'] ) ) {
			if( null != $field['data_validation'] ) {
				$data_validation = ' data-validation="true" ';
			}
		}

		$data_validation_min = '';
		if ( isset( $field['data_validation_min'] ) ) {
			if( null != $field['data_validation_min'] ) {
				$data_validation = ' data-validation-min="'.$field['data_validation_min'].'" ';
			}
		}

		$data_validation_max = '';
		if ( isset( $field['data_validation_max'] ) ) {
			if( null != $field['data_validation_max'] ) {
				$data_validation_max = ' data-validation-max="'.$field['data_validation_max'].'" ';
			}
		}

		$data_validation_maxchar = '';
		if ( isset( $field['data_validation_maxchar'] ) ) {
			if( null != $field['data_validation_maxchar'] ) {
				$data_validation_maxchar = ' data-validation-maxchar="'.$field['data_validation_maxchar'].'" ';
				$data_validation_maxchar .= ' maxlength="'.$field['data_validation_maxchar'].'" ';
			}
		}
		
		$form_disabled = '';
		if ( isset( $field['form_disabled'] ) ) {
			if( 'disabled' === $field['form_disabled'] ) {
				$form_disabled = ' disabled ';
			}elseif ( 'static' === $field['form_disabled'] ) {
				$form_disabled = ' class="form-control-static" ';
			}
		}
		
		$form_help_text = '';
		if ( isset( $field['form_help_text'] ) ) {
			if( null != $field['form_help_text'] ) {
				$form_help_text = $field['form_help_text'];
			}
		}

		$form_input_size = '';
		if ( isset( $field['form_input_size'] ) ) {
			if( null != $field['form_input_size'] ) {
				$form_input_size = $field['form_input_size'];
			}
		}

		$form_label = '';
		if ( isset( $field['form_label'] ) ) {
			if( null != $field['form_label'] ) {
				$form_label = $field['form_label'];
			}
		}
		
		$form_placeholder = '';
		if ( isset( $field['form_placeholder'] ) ) {
			if( null !== $field['form_placeholder'] ) {
				$form_placeholder = ' placeholder="'.$field['form_placeholder'].'" ';
			}
		}

		$value = '';
		if ( isset( $field['value'] ) ) {
			if( '' != $field['value'] ) {
				$value = ' value="'.$field['value'].'" ';
			}
		}
		
		if ( isset($field['form_show_field']) && false == $field['form_show_field'] ) {
//			$output.='<input type="hidden" id="'.$id.'" name="'.$id.'" value="'.$id.'" />';
		}else{
			$output.='<div class="form-group '.$form_input_size.'" name="'.$id.'">';
				$output.='<label for="'.$id.'" class="col-sm-2 control-label">'.$form_label.'</label>';
				$output.='<div class="col-sm-10">';
				switch($field['type']){
					case 'date':
						$output.='<input
										type="date"
										class="form-control"
										id="'.$id.'"
										name="'.$id.'"
										'.$form_placeholder.'
										'.$data_required.'
										'.$value.'
										/>';
						break;
					case 'text':
						$output.='<input
										type="text"
										class="form-control"
										id="'.$id.'"
										name="'.$id.'"
										'.$form_placeholder.'
										'.$data_validation.'
										'.$data_validation_maxchar.'
										'.$data_required.'
										'.$value.'
										/>';
						break;
					case 'textarea':
						$output.='<textarea
										rows="4"
										class="form-control"
										id="'.$id.'"
										name="'.$id.'"
										'.$form_placeholder.'
										'.$data_validation.'
										'.$data_validation_maxchar.'
										'.$data_required.'
										>'.$value.'</textarea>';
						break;
					case 'bool':
						$output.='<input
										type="checkbox"
										class="form-control aa-admin-check"
										id="'.$id.'"
										name="'.$id.'"
										'.(isset($field['value']) && ($field['value'] != false)?'checked':'').'
										/>';
							$output.='<label for="'.$id.'">'.$form_label.'</label>';
						break;
					case 'number':
						$output.='<input
										type="number"
										class="form-control"
										id="'.$id.'"
										name="'.$id.'"
										'.$form_placeholder.'
										'.$data_validation.'
										'.$data_validation_min.'
										'.$data_validation_max.'
										'.$data_required.'
										'.$value.'
										/>';
						break;
					case 'nat_number':
						$output.='<input
										type="number"
										class="form-control"
										id="'.$id.'"
										name="'.$id.'"
										'.$form_placeholder.'
										'.$data_validation.'
										data-validation-min="0"
										'.$data_validation_max.'
										'.$data_required.'
										'.$value.'
										/>';
						break;
					case 'hex':
						if(method_exists($this, 'form_special_form_'.$key)){
							$special_form=array(
								'id'							=>	$id,
								'data_required'					=> $data_required,
								'data_validation'				=> $data_validation,
								'data_validation_min'			=> $data_validation_min,
								'data_validation_max'			=> $data_validation_max,
								'data_validation_maxchar'		=> $data_validation_maxchar,
								'form_disabled'					=> $form_disabled,
								'form_help_text'				=> $form_help_text,
								'form_input_size'				=> $form_input_size,
								'form_label'					=> $form_label,
								'form_placeholder'				=> $form_placeholder,
								'value'							=> $value,
							);
							$output.=call_user_func_array(array($this, 'form_special_form_'.$key),array($special_form));
						}else{
							$output.='<div class="input-group">';
								$output.='<div class="input-group-addon">#</div>';
								$output.='<input
												type="text"
												class="form-control"
												id="'.$id.'"
												name="'.$id.'"
												'.$form_placeholder.'
												'.$data_validation.'
												'.$data_validation_min.'
												'.$data_validation_max.'
												'.$data_required.'
												'.$value.'
												/>';
								$output.='<div class="input-group-addon" id="hex-color"></div>';
							$output.='</div>';
						}
						break;
					case 'percentage':
						$output.='<div class="input-group">';
						$output.='<input
										type="number"
										class="form-control"
										id="'.$id.'"
										name="'.$id.'"
										'.$form_placeholder.'
										'.$data_validation.'
										'.$data_validation_min.'
										'.$data_validation_max.'
										'.$data_required.'
										'.$value.'
										/>';
						$output.='<span class="input-group-addon" id="basic-addon2">%</span>';
						$output.='</div>';
						break;
					case 'select':
						if(method_exists($this, 'form_special_form_'.$key)){
							$options=call_user_func_array(array($this, 'form_special_form_'.$key),array());
							if(count($options) == 0){
								$field['options']=array(0 => "No hay informaci&oacute;n");
							}else{
								$field['options']=$options;
							}
						}else{
							$field['options']=array(0 => "No hay informaci&oacute;n");
						}
						$output.='<select
									class="form-control"
									id="'.$id.'"
									name="'.$id.'"
									'.$data_required.'
									">';
						$output.='<option value="0" disabled>Seleccionar</option>';
						foreach($field['options'] as $sel_key => $sel_opt){
							$output.='<option value="'.$sel_key.'" ';
							
							$output.=isset($field['value']) ? ($sel_key == $field['value'] ? " selected " : '') : '';
							$output.='>'.$sel_opt.'</option>';
						}
						$output.='</select>';
					break;
				}
					$output.='<p class="help-block">'.$form_help_text.'</p>';
				$output.='</div>';
			$output.='</div>';
			
		}
	}
//	if(method_exists($this, 'special_form')){
//		$output.=$this->special_form($item);
//	}
	$output.='<div class="form-group ">';
		$output.='<div class="col-sm-2 control-label"></div>';
			$output.='<div class="col-sm-10">';
				$QS = http_build_query(array_merge($_GET, array("action"=>'')));
				$URL=htmlspecialchars('?'.$QS);
				$output.='<a href="'.$URL.'" class="btn btn-default">Cancelar</a>';
				$msg=($type=="add")?"Agregar":"Editar";
				$output.='<button type="submit" class="btn btn-primary">'.$msg.'</button>';
			$output.='</div>';
		$output.='</div>';
	$output.='</div>';
	$output.='</form>';
	$output.='</div>';
	return $output;
}
public function write_log($log){
	if ( is_array( $log ) || is_object( $log ) ) {
		error_log( print_r( $log, true ) );
	}else{
		error_log( $log );
	}
}

protected function validate_date($date, $format = 'Y-m-d'){
	$d = DateTime::createFromFormat($format, $date);
	return $d && $d->format($format) == $date;
}
protected function findMonday($date = null){
	if ($date instanceof DateTime) {
		$date = clone $date;
	} else if (!$date) {
		$date = new DateTime();
	} else {
		$date = new DateTime($date);
	}

	$date->setTime(0, 0, 0);

	if ($date->format('N') == 1) {
		// If the date is already a Monday, return it as-is
		return $date;
	} else {
		// Otherwise, return the date of the nearest Monday in the past
		// This includes Sunday in the previous week instead of it being the start of a new week
		return $date->modify('last monday');
	}
}
//END OF CLASS	
}
?>