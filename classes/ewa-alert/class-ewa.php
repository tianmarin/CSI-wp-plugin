<?php
defined('ABSPATH') or die("No script kiddies please!");

class NOVIS_CSI_EWA_CLASS extends NOVIS_CSI_CLASS{

/**
* __construct
*
* Esta función es llamada apenas se crea la clase.
* Es utilizada para instanciar las diferentes clases con su información vital.
*
*
*
*/
public function __construct(){
	global $wpdb;
	global $novis_csi_vars;
	//como se definió en novis_csi_vars
	$this->class_name	= 'ewa';
	//Nombre singular para títulos, mensajes a usuario, etc.
	$this->name_single	= 'Reporte EWA';
	//Nombre plural para títulos, mensajes a usuario, etc.
	$this->name_plural	= 'Reportes EWA';
	//Identificador de menú padre
	$this->parent_slug	= $novis_csi_vars['network_menu_slug'];
	//Identificador de submenú de la clase
	$this->menu_slug	= $novis_csi_vars[$this->class_name.'_menu_slug'];
	//Utilizadp para validaciones
	$this->plugin_post	= $novis_csi_vars['plugin_post'];
	//Permisos de usuario a nivel de backend WordPRess
	$this->capability	= $novis_csi_vars[$this->class_name.'_menu_cap'];
	//Network Activated Class
	$this->network_class= $novis_csi_vars[$this->class_name.'_network_class'];
	//Plugintable_prefix
	$this->table_prefix=$novis_csi_vars['table_prefix'];
	//Tabla de la clase
	if( true == $this->network_class ){
		$this->tbl_name = $wpdb->base_prefix	.$this->table_prefix	.$this->class_name;
	}else{
		$this->tbl_name = $wpdb->prefix			.$this->table_prefix	.$this->class_name;
	}
	//Versión de DB (para registro y actualización automática)
	$this->db_version	= '0.6.0';
	//Reglas actuales de caracteres a nivel de DB.
	//Dado que esto sólo se usa en la cración de la tabla
	//no se guarda como variable de clase.
	$charset_collate	= $wpdb->get_charset_collate();
	//Sentencia SQL de creación (y ajuste) de la tabla de la clase
	$this->crt_tbl_sql_wt	="(
								id bigint unsigned not null auto_increment COMMENT 'Unique ID for each entry',
								system_no bigint(18) unsigned not null COMMENT 'SAP System Number',
								ewa_session_no bigint(13) unsigned not null COMMENT 'EWA session number',
								planned_date date not null COMMENT 'Planned date of EWA',
								ewa_status varchar(1) not null COMMENT 'EWA Status char',
								ewa_rating varchar(1) not null COMMENT 'EWA Rating char',
								creation_user_id bigint(20) unsigned null COMMENT 'Id of user responsible of the creation of this record',
								creation_user_email varchar(100) null COMMENT 'Email of user. Used to track user if user id is deleted',
								creation_date date null COMMENT 'Date of the creation of this record',
								creation_time time null COMMENT 'Time of the creation of this record',
								creation_filename varchar(255) null COMMENT 'Name of the file used to create this record',
								last_modified_user_id bigint(20) unsigned null COMMENT 'Id of user responsible of the last modification of this record',
								last_modified_user_email varchar(100) null COMMENT 'Email of user. Used to track user if user id is deleted',
								last_modified_date date null COMMENT 'Date of the last modification of this record',
								last_modified_time time null COMMENT 'Time of the last modification of this record',
								
								UNIQUE KEY id (id)
							) $charset_collate;";
	//Sentencia SQL de creación (y ajuste) de la tabla de la clase
	$this->crt_tbl_sql	=	"CREATE TABLE ".$this->tbl_name." ".$this->crt_tbl_sql_wt;
	$this->db_fields	= array(
		/*	
		type					: Tipo de Dato para validacion
									- id
									- text
									- percentage
									- number
									- nat_number
									- timestamp
									- date
									- time
									- bool
									- radio
									- select
									- dual_id
		backend_wp_in_table		: Flag de mostrar el campo en las tablas de 
									true|false
		backend_wp_sp_table		: If true, 'sp_wp_table'+field_id function will be executed to show special content
		backend_wp_table_lead	: If true, 'Edit'button will be shown below field values in backend table
		form_disabled			: Show the field as a disabled or static input
									- false
									- disabled
									- static
		form_help_text			: Text showing guide to users
		form_input_size			: Form input size (bootstrap in form-group class)
									form-group-lg
									false
									form-group-sm
		form_label				: Label text
		form_options			: Value for options
									blank array()
									key => array(val,disabled)
		form_placeholder		: Placeholder for inputs
		form_special_form		: If true validates and execute a special function for form display (usually for select fields)
		form_show_field			: If false, field will be a 'hidden input'
									true|false
		data_required			: If true, form will not succed if field value is empty or 0
								  If true, 'insert' or 'update' evaluation will not succeed if field value is empty or 0
									true|false
		data_validation			: Check for specific values (javascript and PHP)
									true|alse
		data_validation_min		: Minumum numeric value
		data_validation_max		: Maximum numeric value
		data_validation_maxchar	: Maximum charcount for text inputs
		*/
		'id' => array(
			'type'						=>'id',
			'backend_wp_in_table'		=>false,
			'backend_wp_sp_table'		=>false,
			'backend_wp_table_lead'		=>false,
			'data_required'				=>true,
			'data_validation'			=>true,
			'data_validation_min'		=>1,
			'data_validation_max'		=>false,
			'data_validation_maxchar'	=>false,
			'form_disabled'				=>false,
			'form_help_text'			=>false,
			'form_input_size'			=>false,
			'form_label'				=>false,
			'form_options'				=>false,
			'form_placeholder'			=>false,
			'form_special_form'			=>false,
			'form_show_field'			=>false,
		),
		'system_no' => array(
			'type'						=>'nat_number',
			'backend_wp_in_table'		=>false,
			'backend_wp_sp_table'		=>false,
			'backend_wp_table_lead'		=>false,
			'data_required'				=>true,
			'data_validation'			=>true,
			'data_validation_min'		=>1,
			'data_validation_max'		=>false,
			'data_validation_maxchar'	=>false,
			'form_disabled'				=>false,
			'form_help_text'			=>false,
			'form_input_size'			=>false,
			'form_label'				=>false,
			'form_options'				=>false,
			'form_placeholder'			=>false,
			'form_special_form'			=>false,
			'form_show_field'			=>false,
		),
		'ewa_session_no' => array(
			'type'						=>'nat_number',
			'backend_wp_in_table'		=>false,
			'backend_wp_sp_table'		=>false,
			'backend_wp_table_lead'		=>false,
			'data_required'				=>true,
			'data_validation'			=>true,
			'data_validation_min'		=>1,
			'data_validation_max'		=>false,
			'data_validation_maxchar'	=>false,
			'form_disabled'				=>false,
			'form_help_text'			=>false,
			'form_input_size'			=>false,
			'form_label'				=>false,
			'form_options'				=>false,
			'form_placeholder'			=>false,
			'form_special_form'			=>false,
			'form_show_field'			=>false,
		),
		'planned_date' => array(
			'type'						=>'date',
			'backend_wp_in_table'		=>false,
			'backend_wp_sp_table'		=>false,
			'backend_wp_table_lead'		=>false,
			'data_required'				=>true,
			'data_validation'			=>false,
			'data_validation_min'		=>false,
			'data_validation_max'		=>false,
			'data_validation_maxchar'	=>false,
			'form_disabled'				=>false,
			'form_help_text'			=>false,
			'form_input_size'			=>false,
			'form_label'				=>false,
			'form_options'				=>false,
			'form_placeholder'			=>false,
			'form_special_form'			=>false,
			'form_show_field'			=>false,
		),
		'ewa_status' => array(
			'type'						=>'text',
			'backend_wp_in_table'		=>false,
			'backend_wp_sp_table'		=>false,
			'backend_wp_table_lead'		=>false,
			'data_required'				=>true,
			'data_validation'			=>false,
			'data_validation_min'		=>false,
			'data_validation_max'		=>false,
			'data_validation_maxchar'	=>false,
			'form_disabled'				=>false,
			'form_help_text'			=>false,
			'form_input_size'			=>false,
			'form_label'				=>false,
			'form_options'				=>false,
			'form_placeholder'			=>false,
			'form_special_form'			=>false,
			'form_show_field'			=>false,
		),
		'ewa_rating' => array(
			'type'						=>'text',
			'backend_wp_in_table'		=>false,
			'backend_wp_sp_table'		=>false,
			'backend_wp_table_lead'		=>false,
			'data_required'				=>true,
			'data_validation'			=>false,
			'data_validation_min'		=>false,
			'data_validation_max'		=>false,
			'data_validation_maxchar'	=>false,
			'form_disabled'				=>false,
			'form_help_text'			=>false,
			'form_input_size'			=>false,
			'form_label'				=>false,
			'form_options'				=>false,
			'form_placeholder'			=>false,
			'form_special_form'			=>false,
			'form_show_field'			=>false,
		),
		'creation_user_id' => array(
			'type'						=>'create_user_id',
			'backend_wp_in_table'		=>false,
			'backend_wp_sp_table'		=>false,
			'backend_wp_table_lead'		=>false,
			'data_required'				=>true,
			'data_validation'			=>false,
			'data_validation_min'		=>false,
			'data_validation_max'		=>false,
			'data_validation_maxchar'	=>false,
			'form_disabled'				=>false,
			'form_help_text'			=>false,
			'form_input_size'			=>false,
			'form_label'				=>false,
			'form_options'				=>false,
			'form_placeholder'			=>false,
			'form_special_form'			=>false,
			'form_show_field'			=>false,
		),
		'creation_user_email' => array(
			'type'						=>'create_user_email',
			'backend_wp_in_table'		=>false,
			'backend_wp_sp_table'		=>false,
			'backend_wp_table_lead'		=>false,
			'data_required'				=>true,
			'data_validation'			=>false,
			'data_validation_min'		=>false,
			'data_validation_max'		=>false,
			'data_validation_maxchar'	=>false,
			'form_disabled'				=>false,
			'form_help_text'			=>false,
			'form_input_size'			=>false,
			'form_label'				=>false,
			'form_options'				=>false,
			'form_placeholder'			=>false,
			'form_special_form'			=>false,
			'form_show_field'			=>false,
		),
		'creation_date' => array(
			'type'						=>'create_date',
			'backend_wp_in_table'		=>false,
			'backend_wp_sp_table'		=>false,
			'backend_wp_table_lead'		=>false,
			'data_required'				=>true,
			'data_validation'			=>false,
			'data_validation_min'		=>false,
			'data_validation_max'		=>false,
			'data_validation_maxchar'	=>false,
			'form_disabled'				=>false,
			'form_help_text'			=>false,
			'form_input_size'			=>false,
			'form_label'				=>false,
			'form_options'				=>false,
			'form_placeholder'			=>false,
			'form_special_form'			=>false,
			'form_show_field'			=>false,
		),
		'creation_time' => array(
			'type'						=>'create_time',
			'backend_wp_in_table'		=>false,
			'backend_wp_sp_table'		=>false,
			'backend_wp_table_lead'		=>false,
			'data_required'				=>true,
			'data_validation'			=>false,
			'data_validation_min'		=>false,
			'data_validation_max'		=>false,
			'data_validation_maxchar'	=>false,
			'form_disabled'				=>false,
			'form_help_text'			=>false,
			'form_input_size'			=>false,
			'form_label'				=>false,
			'form_options'				=>false,
			'form_placeholder'			=>false,
			'form_special_form'			=>false,
			'form_show_field'			=>false,
		),
		'creation_filename' => array(
			'type'						=>'text',
			'backend_wp_in_table'		=>false,
			'backend_wp_sp_table'		=>false,
			'backend_wp_table_lead'		=>false,
			'data_required'				=>false,
			'data_validation'			=>false,
			'data_validation_min'		=>false,
			'data_validation_max'		=>false,
			'data_validation_maxchar'	=>false,
			'form_disabled'				=>false,
			'form_help_text'			=>false,
			'form_input_size'			=>false,
			'form_label'				=>false,
			'form_options'				=>false,
			'form_placeholder'			=>false,
			'form_special_form'			=>false,
			'form_show_field'			=>false,
		),
		'last_modified_user_id' => array(
			'type'						=>'edit_user_id',
			'backend_wp_in_table'		=>false,
			'backend_wp_sp_table'		=>false,
			'backend_wp_table_lead'		=>false,
			'data_required'				=>false,
			'data_validation'			=>false,
			'data_validation_min'		=>false,
			'data_validation_max'		=>false,
			'data_validation_maxchar'	=>false,
			'form_disabled'				=>false,
			'form_help_text'			=>false,
			'form_input_size'			=>false,
			'form_label'				=>false,
			'form_options'				=>false,
			'form_placeholder'			=>false,
			'form_special_form'			=>false,
			'form_show_field'			=>false,
		),
		'last_modified_user_email' => array(
			'type'						=>'edit_user_email',
			'backend_wp_in_table'		=>false,
			'backend_wp_sp_table'		=>false,
			'backend_wp_table_lead'		=>false,
			'data_required'				=>false,
			'data_validation'			=>false,
			'data_validation_min'		=>false,
			'data_validation_max'		=>false,
			'data_validation_maxchar'	=>false,
			'form_disabled'				=>false,
			'form_help_text'			=>false,
			'form_input_size'			=>false,
			'form_label'				=>false,
			'form_options'				=>false,
			'form_placeholder'			=>false,
			'form_special_form'			=>false,
			'form_show_field'			=>false,
		),
		'last_modified_date' => array(
			'type'						=>'edit_date',
			'backend_wp_in_table'		=>false,
			'backend_wp_sp_table'		=>false,
			'backend_wp_table_lead'		=>false,
			'data_required'				=>false,
			'data_validation'			=>false,
			'data_validation_min'		=>false,
			'data_validation_max'		=>false,
			'data_validation_maxchar'	=>false,
			'form_disabled'				=>false,
			'form_help_text'			=>false,
			'form_input_size'			=>false,
			'form_label'				=>false,
			'form_options'				=>false,
			'form_placeholder'			=>false,
			'form_special_form'			=>false,
			'form_show_field'			=>false,
		),
		'last_modified_time' => array(
			'type'						=>'edit_time',
			'backend_wp_in_table'		=>false,
			'backend_wp_sp_table'		=>false,
			'backend_wp_table_lead'		=>false,
			'data_required'				=>false,
			'data_validation'			=>false,
			'data_validation_min'		=>false,
			'data_validation_max'		=>false,
			'data_validation_maxchar'	=>false,
			'form_disabled'				=>false,
			'form_help_text'			=>false,
			'form_input_size'			=>false,
			'form_label'				=>false,
			'form_options'				=>false,
			'form_placeholder'			=>false,
			'form_special_form'			=>false,
			'form_show_field'			=>false,
		),
	);
	
	register_activation_hook(CSI_PLUGIN_DIR."/index.php",		array( $this , 'db_install'								));
	//in a new blog creation, create the db for new blog
	//Applies only for non-network classes
	if( true != $this->network_class ){
		add_action( 'wpmu_new_blog',							array( $this , 'db_install'								));
	}
	add_action( 'wp_ajax_csi_ajax_upload_ewa_file',				array( $this , 'csi_ajax_upload_ewa_file'				));
	add_action( 'wp_ajax_csi_ajax_template_ewa_control_center_fetch_alerts',		array( $this , 'csi_ajax_template_ewa_control_center_fetch_alerts'				));
	add_action( 'wp_ajax_csi_ajax_template_ewa_mgmt_control_center_fetch_alerts',	array( $this , 'csi_ajax_template_ewa_mgmt_control_center_fetch_alerts'			));
	add_action( 'wp_ajax_csi_ajax_template_ewa_mgmt_control_center_alert_chart',	array( $this , 'csi_ajax_template_ewa_mgmt_control_center_alert_chart'			));
	add_action( 'wp_ajax_csi_ajax_template_ewa_mgmt_control_center_action_gauge',	array( $this , 'csi_ajax_template_ewa_mgmt_control_center_action_gauge'			));
	add_action( 'wp_ajax_csi_ajax_template_ewa_mgmt_control_center_ewa_status_chart',	array( $this , 'csi_ajax_template_ewa_mgmt_control_center_ewa_status_chart'	));
	add_action( 'wp_ajax_csi_ajax_template_ewa_mgmt_control_center_alert_pies',			array( $this , 'csi_ajax_template_ewa_mgmt_control_center_alert_pies'		));
	add_action( 'wp_ajax_csi_ajax_template_ewa_mgmt_control_center_customer_ewas',		array( $this , 'csi_ajax_template_ewa_mgmt_control_center_customer_ewas'	));
	add_action( 'wp_ajax_csi_ajax_template_ewa_mgmt_control_center_customer_alerts',	array( $this , 'csi_ajax_template_ewa_mgmt_control_center_customer_alerts'	));
	
	
	
	
	
	
	add_shortcode( 'ewa_system_history',			 			array( $this , 'csi_shortcode_ewa_system_history'		));
	add_shortcode( 'csi_ewa_status',					 		array( $this , 'csi_shortcode_ewa_status'				));
	add_shortcode( 'csi_ewa_status_by_customer',		 		array( $this , 'csi_shortcode_ewa_status_by_customer'	));
	add_shortcode( 'csi_ewa_system_dashboard',			 		array( $this , 'csi_shortcode_ewa_ssystem_dashboard'	));
	add_shortcode( 'csi_ewa_customer_block',			 		array( $this , 'csi_shortcode_ewa_customer_block'		));
	add_shortcode( 'csi_ewa_week_summary',				 		array( $this , 'csi_shortcode_ewa_week_summary'			));
	

}

public function get_ewa_session_no_col(){
	global $wpdb;
	$sql = "SELECT ewa_session_no FROM ".$this->tbl_name;
	return $wpdb->get_col( $sql );
}

public function csi_ajax_upload_ewa_file(){
	//global variables
	global $wpdb;
	global $NOVIS_CSI_CUSTOMER_SYSTEM;
	//local variables
	$response 					= array();	
	$curr_system_no				= array();
	$error_flag					= FALSE;
	$error_msg					= '';
	$EWA_insert_array			= array();
	$EWA_insert_array_temp		= array();
	$ALERT_insert_array			= array();
	$ALERT_insert_array_temp	= array();
	$non_reg_systno				= array();
	$non_reg_output				= '';
	$mime_type_error			= '';
	$db_error					= '';
	$rewind_error				= '';
	$no_new_data				= '';
	$prevent_dup_alert			= 0;
	$skipped_ewa_reports		= 0;
	$line_lenght				= 2000; //longest lenght of line
	$current_user				= wp_get_current_user();

	set_time_limit(600);	
	
	$curr_system_no				=$NOVIS_CSI_CUSTOMER_SYSTEM->get_system_no_col();
	$curr_sessno				=$this->get_ewa_session_no_col();
	$allowed_mime_types 		= array('text/csv','text/plain', '', 'application/vmd.ms-excel');
	
	if ( FALSE == array_search( mime_content_type($_FILES['file']['tmp_name']) , $allowed_mime_types ) ){
		$error_flag=TRUE;
		$mime_type_error='<div class="alert alert-danger" role="alert">';
		$mime_type_error.='Tipo de archivo incorrecto: <code>'.mime_content_type($_FILES['file']['tmp_name']).'</code>';
		$mime_type_error='</div>';
	}else{
		$csv_filename = $_FILES['file']['name'];
		$csv_file = fopen($_FILES['file']['tmp_name'], 'rb');
		//CSV Structure
		//SAPCUSTNO|SOLID|SOLDESC|DBID|INSTNO|SYSTNO|SESSNO|PLANNED_DATE|EWA_STATUS|EWA_RATING|ALERT_GROUP|ALERT_NUMBER|ALERT_RATING|TEXT		
		//Get CSV Headers
		$line = fgetcsv($csv_file,$line_lenght);
		foreach ( $line as $key => $field){
			$line[$key] = htmlspecialchars ( trim ( $field ) );
		}
		if ( FALSE === ($csv_h_sapcustno	= array_search("SAPCUSTNO",		$line)) ) {
			$error_msg.='<p class="text-warning">No se ha identificado la columna SAPCUSTNO en el archivo. Esta alerta no es cr&iacute;tica.</p>';
			}
		if ( FALSE === ($csv_h_solid		= array_search("SOLID"	,		$line)) ) {
			$error_msg.='<p class="text-warning">No se ha identificado la columna SOLID en el archivo. Esta alerta no es cr&iacute;tica.</p>';
			}
		if ( FALSE === ($csv_h_soldesc		= array_search("SOLDESC",		$line)) ) {
			$error_msg.='<p class="text-warning">No se ha identificado la columna SOLDESC en el archivo. Esta alerta no es cr&iacute;tica.</p>';
			}
		if ( FALSE === ($csv_h_dbid			= array_search("DBID",			$line)) ) {
			$error_msg.='<p class="text-danger">No se ha identificado la columna DBID en el archivo. Esta alerta no es cr&iacute;tica.</p>';
			}
		if ( FALSE === ($csv_h_instno		= array_search("INSTNO",		$line)) ) {
			$error_flag = TRUE;
			$error_msg.='<p class="text-danger">No se ha identificado la columna INSTNO en el archivo. Este comportamiento puede provocar errores en la carga.</p>';
			}
		if ( FALSE === ($csv_h_systno		= array_search("SYSTNO",		$line)) ) {
			$error_flag = TRUE;
			$error_msg.='<p class="text-danger">No se ha identificado la columna SYSTNO en el archivo. Este comportamiento puede provocar errores en la carga.</p>';
			}
		if ( FALSE === ($csv_h_sessno		= array_search("SESSNO",		$line)) ) {
			$error_flag = TRUE;
			$error_msg.='<p class="text-danger">No se ha identificado la columna SESSNO en el archivo. Este comportamiento puede provocar errores en la carga.</p>';
			}
		if ( FALSE === ($csv_h_planned_date	= array_search("PLANNED_DATE",	$line)) ) {
			$error_flag = TRUE;
			$error_msg.='<p class="text-danger">No se ha identificado la columna PLANNED_DATE en el archivo. Este comportamiento puede provocar errores en la carga.</p>';
			}
		if ( FALSE === ($csv_h_ewa_status	= array_search("EWA_STATUS",	$line)) ) {
			$error_flag = TRUE;
			$error_msg.='<p class="text-danger">No se ha identificado la columna EWA_STATUS en el archivo. Este comportamiento puede provocar errores en la carga.</p>';
			}
		if ( FALSE === ($csv_h_ewa_rating	= array_search("EWA_RATING",	$line)) ) {
			$error_flag = TRUE;
			$error_msg.='<p class="text-danger">No se ha identificado la columna EWA_RATING en el archivo. Este comportamiento puede provocar errores en la carga.</p>';
			}
		if ( FALSE === ($csv_h_alert_group	= array_search("ALERT_GROUP",	$line)) ) {
			$error_flag = TRUE;
			$error_msg.='<p class="text-danger">No se ha identificado la columna ALERT_GROUP en el archivo. Este comportamiento puede provocar errores en la carga.</p>';
			}
		if ( FALSE === ($csv_h_alert_number	= array_search("ALERT_NUMBER",	$line)) ) {
			$error_flag = TRUE;
			$error_msg.='<p class="text-danger">No se ha identificado la columna ALERT_NUMBER en el archivo. Este comportamiento puede provocar errores en la carga.</p>';
			}
		if ( FALSE === ($csv_h_alert_rating	= array_search("ALERT_RATING",	$line)) ) {
			$error_flag = TRUE;
			$error_msg.='<p class="text-danger">No se ha identificado la columna ALERT_RATING en el archivo. Este comportamiento puede provocar errores en la carga.</p>';
			}
		if ( FALSE === ($csv_h_alert_text	= array_search("TEXT",			$line)) ) {
			$error_flag = TRUE;
			$error_msg.='<p class="text-danger">No se ha identificado la columna TEXT en el archivo. Este comportamiento puede provocar errores en la carga.</p>';
			}
//		if ( FALSE == $error_flag ) {
			while  ( FALSE !== ($line = fgetcsv($csv_file,$line_lenght) ) ){
				foreach ( $line as $key => $field){
						$line[$key] = htmlspecialchars ( trim ( $field ) ) ;
				}
				//Check if system is registered
				if ( FALSE === array_search($line[$csv_h_systno], $curr_system_no)){
					if ( FALSE === array_search( $line[$csv_h_systno], array_column( $non_reg_systno, 'systno' ) ) ) {
						if ( 0 < intval ( $line[$csv_h_systno] ) ) {
							$reg=array(
								'sapcustno'		=> $line[$csv_h_sapcustno],
								'solid'			=> $line[$csv_h_solid],
								'soldesc'		=> $line[$csv_h_soldesc],
								'dbid'			=> $line[$csv_h_dbid],
								'systno'		=> $line[$csv_h_systno],
							);
							array_push($non_reg_systno, $reg);
						}
					}
				}else{
					//Validar si el ewa ya está registrado en el sistema
					//Si el ewa ya fue ingresado al sistema, se guarda como EWAs Omitidos
					//Check if ewa_session_no is registered
					if ( FALSE === array_search( $line[$csv_h_sessno], $curr_sessno ) ) {
						//Check if is not already registered to save
						if ( FALSE === array_search( $line[$csv_h_sessno], array_column( $EWA_insert_array, 'ewa_session_no' ) ) ) {
							$EWA = array(
								'system_no'			=> $line[$csv_h_systno],
								'ewa_session_no'	=> $line[$csv_h_sessno],
								'planned_date'		=> $line[$csv_h_planned_date],
								'ewa_status'		=> $line[$csv_h_ewa_status],
								'ewa_rating'		=> $line[$csv_h_ewa_rating],
								'creation_filename'	=> $csv_filename,
							);
							$count_ewas = array_push( $EWA_insert_array, $EWA );
						}else{
							// silence is golden
						}
					}else{
						$skipped_ewa_reports++;
				// 		Este ewa ya existe en el sistema.... por lo tanto se omite
					}
				}
			}
			//prepare the variables for insert
		
			if ( FALSE != rewind($csv_file) ){
				$line = fgetcsv($csv_file,$line_lenght);
				while  ( FALSE !== ($line = fgetcsv($csv_file,$line_lenght) ) ){
					foreach ( $line as $key => $field){
						$line[$key] = htmlspecialchars ( trim ( $field ) ) ;
					}
					//Check if ewa_session_no is going to be inserted
					if ( FALSE === array_search( $line[$csv_h_sessno], array_column( $EWA_insert_array, 'ewa_session_no' ) ) ) {
						//silence is golden
					}else{
						if ( 'NULL' == $line[$csv_h_alert_number] || '' == $line[$csv_h_alert_rating] ){
							if ( 'G' == $line[$csv_h_ewa_rating] ){
								continue;
							}
							$line[$csv_h_alert_group]	= 'NOVIS_NO_ALERT';
							$line[$csv_h_alert_rating]	= 'Z';
							$line[$csv_h_alert_number]	= '1';
							$line[$csv_h_alert_text]	= 'No alert has been generated [novis]';
						}
						$ALERT = array(
//							'system_no'				=> $line[$csv_h_systno],
							'ewa_session_no'		=> $line[$csv_h_sessno],
							'alert_group'			=> $line[$csv_h_alert_group],
							'alert_rating'			=> $line[$csv_h_alert_rating],
							'alert_no'				=> $line[$csv_h_alert_number],
							'alert_text'			=> $line[$csv_h_alert_text],
							'creation_filename'		=> $csv_filename,
						);
						$ALERT_exists = FALSE;
						foreach ( $ALERT_insert_array as $ALERT_insert_array_serial ){
							if ( serialize ( $ALERT_insert_array_serial )  == serialize ( $ALERT ) ) {
								$ALERT_exists = TRUE;
							}
						}
						if ( FALSE == $ALERT_exists ){
							$count_alerts = array_push( $ALERT_insert_array, $ALERT );
						}else{
							$prevent_dup_alert++;						
						}
					}
				}
				$ALERT_insert_array = array_unique($ALERT_insert_array, SORT_REGULAR);
				if (0 < count ( $EWA_insert_array ) ) {
					$sql = "INSERT INTO ".$this->tbl_name. " (system_no, ewa_session_no, planned_date, ewa_status, ewa_rating, creation_filename, creation_user_id, creation_user_email, creation_date, creation_time)
							VALUES ";
					foreach ( $EWA_insert_array as $key => $row ){
						$EWA_insert_array_temp[$key]=' ("'.$row['system_no'].'","'.$row['ewa_session_no'].'","'.$row['planned_date'].'","'.$row['ewa_status'].'","'.$row['ewa_rating'].'","'.$row['creation_filename'].'","'.intval(get_current_user_id()).'","'.$current_user->user_email.'","'.date("Y-m-d").'","'.date("H:i:s").'") ';
					}
					$sql.=implode(",", $EWA_insert_array_temp);
					$ewa_inserts = $wpdb->query($sql);
					
					if ( FALSE === $ewa_inserts ){
						$error_flag=TRUE;
						$db_error='<p>Ha ocurrido un error al insertar los registros de EWA en la Base de Datos.</p><p><code>'.$sql.'</code></p>';
						$db_error.='<br/>Solicita apoyo al administrador del sistema.';
					}else{
						global $NOVIS_CSI_EWA_ALERT;
						$sql = "INSERT INTO ".$NOVIS_CSI_EWA_ALERT->tbl_name. " (ewa_session_no, alert_group, alert_rating, alert_no, alert_text, creation_filename, creation_user_id, creation_user_email, creation_date, creation_time)
								VALUES ";
						foreach ( $ALERT_insert_array as $key => $row ){
							$ALERT_insert_array_temp[$key] =' ("'.$row['ewa_session_no'].'","'.$row['alert_group'].'","'.$row['alert_rating'].'","'.$row['alert_no'].'","'.$row['alert_text'].'","'.$row['creation_filename'].'","'.intval(get_current_user_id()).'","'.$current_user->user_email.'","'.date("Y-m-d").'","'.date("H:i:s").'") ';
						}
						$sql.=implode(",", $ALERT_insert_array_temp);
						// Normally @@global.max_allowed_packet = 1048576
						$check_max_allowed_packet= $wpdb->get_row('SELECT @@global.max_allowed_packet as max_allowed_packet','ARRAY_A')['max_allowed_packet'];
						$query_size = strlen( $sql ) + 1024 * 4;
						self::write_log( $query_size );
						self::write_log($check_max_allowed_packet);
						if ( $query_size >= $check_max_allowed_packet ){
							self::write_log("WARNING! To prevent DB Error for getting packet bigger than 'max_allowed_packet' bytes, global.max_allowed_packet will be temporarily modified. QUERY_SIZE : ".$query_size." max_allowed_packet : ".$check_max_allowed_packet);
							//In order to this fix to work, you need to grant the database user the "SUPER" privilege
							/*
							REVOKE ALL PRIVILEGES ON *.* FROM 'user'@'localhost';
							REVOKE GRANT OPTION ON *.* FROM 'user'@'localhost';
							GRANT SUPER ON *.* TO 'user'@'localhost' REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;
							*/
							$query_size = ( $query_size < 33554432 )? 33554432 : 67108864 ;
							self::write_log( $wpdb->query( 'SET @@global.max_allowed_packet = ' . $query_size ) );
							self::write_log ( "WARNING! max_allowed_packet changed to ".$query_size );
							$alert_inserts = $wpdb->query($sql);
							self::write_log( $wpdb->query( 'SET @@global.max_allowed_packet = ' . $check_max_allowed_packet ) );
							self::write_log ( "WARNING! max_allowed_packet changed back to " . $check_max_allowed_packet );
						}else{
							$alert_inserts = $wpdb->query($sql);
						}
						if ( FALSE === $alert_inserts ){
							$error_flag=TRUE;
							$db_error='<p>Ha ocurrido un error al insertr los registros de Alertas de EWA en la Base de Datos.</p><p><code>'.$sql.'</code></p>';
							$db_error.='<br/>Solicita apoyo al administrador del sistema.';
						}
					}
					
				}else{
					$no_new_data ='<div class="alert alert-danger" role="alert">';
					$no_new_data.='Ninguno de los registros en este archivo son v&aacute;lidos.';
					$no_new_data.='<br/>Puede que estés cargando el archivo por segunda vez o los sistemas no est&eacute;n registrados.';
					$no_new_data.='</div>';
					
				}
			}else{
				$error_flag=TRUE;
				
				$rewind_error ='<div class="alert alert-danger" role="alert">';
				$rewind_error.='Ha ocurrido un error al procesar el archivo (<code>Rewind CSV File <small>'.$_FILES['file']['tmp_name'].'</small></code>).';
				$rewind_error.='<br/>Solicita apoyo al administrador del sistema.';
				$rewind_error.='</div>';
			}
//		}else{
			
//		}
			// ----- 
	}
	if ( 0 < $prevent_dup_alert ){
		$prevent_dup_output ='<div class="alert alert-info" role="alert">';
		$prevent_dup_output .='Se han omitido ' . intval ( $prevent_dup_alert ) .' alertas duplicadas.';
		$prevent_dup_output .='</div>';
	}else{
		$prevent_dup_output ='';
	}
	if ( '' != $error_msg){
		$error_msg = '
				<div class="alert alert-info" role="alert">
					<p class="text-info"><i class="fa fa-info"></i>Se han detectado algunos mensajes durante el proceso de carga.</p>
					' . $error_msg . '
				</div>';
	}
	if ( FALSE === $error_flag ){
		if ( 0 < count( $non_reg_systno ) ) {
			$non_reg_output.='<div class="row">';
			$non_reg_output.='<div class="col-xs-12">';
			$non_reg_output.='<h4>Sistemas no registrados</h4>';
			$non_reg_output.='<p>Existen sistemas que no están registrados. Debes registrar el sistema y posteriormente puedes re-procesar la carga.</p>';
			$non_reg_output.='<p class="text-muted">Esta informaci&oacute;n no es almacenada. Te recomendamos guardar esta p&aacute;gina como PDF.</p>';
			$non_reg_output.='<table class="table table-condensed table-hover">';
			$non_reg_output.='<thead><tr><th>SAP Customer Number</th><th>Solution ID</th><th>Solution Desc</th><th>DBID</th><th>System Number</th></tr></thead>';
			$non_reg_output.='<tbody>';
			foreach ( $non_reg_systno as $sys){
				$non_reg_output.='<tr><td>'.$sys['sapcustno'].'</td><td>'.$sys['solid'].'</td><td>'.$sys['soldesc'].'</td><td>'.$sys['dbid'].'</td><td>'.$sys['systno'].'</td></tr>';
			}
			$non_reg_output.='</tbody></table>';
			$non_reg_output.='</div>';
			$non_reg_output.='</div>';
		}
	}
	$response['status']='ok';
	$response['message']	 ='';
	$response['message']	 =$error_msg;
	$response['message']	.=$prevent_dup_output;
	$response['message']	.='<p class="lead">Se han insertado ' . count ( $EWA_insert_array ) . ' EWAs.</p>';
	$response['message']	.='<p class="lead">Se han insertado ' . count ( $ALERT_insert_array ) . ' alertas.</p>';
	$response['message']	.=$mime_type_error;
	$response['message']	.=$db_error;
	$response['message']	.=$rewind_error;
	$response['message']	.=$no_new_data;
	$response['message']	.=$non_reg_output;
	echo json_encode($response);
	wp_die();
}

public function csi_shortcode_ewa_system_history(){
	global $wpdb;
	$output = '';
//	$systems = explode(',', $atts['system']);
	//ensure systems array is 'system_no' array
//	foreach ( $systems as $key => $system ){
		$system = '312137533';
		wp_register_script(
			'csiEWASystemHistory',
			CSI_PLUGIN_URL.'/js/shortcodes/min/shortcode-ewa-system-history-min.js' ,
			array('amcharts','amcharts-serial','amcharts-responsive'),
			'0.9.0'
		);
		wp_enqueue_script('csiEWASystemHistory');
		global $NOVIS_CSI_EWA_ALERT;
		global $NOVIS_CSI_EWA_ALERT_RATING;
		$sql = 'SELECT
				T01.alert_group,
				T01.alert_no,
				T02.hex_color,
				T01.alert_text
				FROM
					'.$this->tbl_name.' as T00
					LEFT JOIN '.$NOVIS_CSI_EWA_ALERT->tbl_name.' as T01 ON T00.ewa_session_no = T01.ewa_session_no
					LEFT JOIN '.$NOVIS_CSI_EWA_ALERT_RATING->tbl_name.' as T02 ON T01.alert_rating = T02.alert_rating
				GROUP BY
					T01.alert_group,T01.alert_no
				';
//				WHERE
//					T00.system_no="'.$system.'"
		$id_alerts = $this->get_sql($sql);
		$dataProvider = array();
		$graphs = array();
		foreach ( $id_alerts as $id_alert ){
			$alert_id = $id_alert['alert_group'].'_'.$id_alert['alert_no'];
			$graph = array(
				'balloonText'	=> "<small>[[title]]</small>",
				'fillAlphas'	=> 1,
//				'labelText'		=> "[[title]]",
				'lineAlpha'		=> 0.5,
				'title'			=> $id_alert['alert_text'],
				'type'			=> "column",
				'fillColors'	=> '#'.$id_alert['hex_color'],
				'lineColor'		=> '#FFF',
				'valueField'	=> $alert_id,
				'hidden'		=> true,
			);
			array_push($graphs, $graph);
			$sql = 'SELECT
					T00.planned_date,
					T01.alert_group,
					T01.alert_no,
					COUNT(*) as total
					FROM
						'.$this->tbl_name.' as T00
						LEFT JOIN '.$NOVIS_CSI_EWA_ALERT->tbl_name.' as T01 ON T00.ewa_session_no = T01.ewa_session_no
						LEFT JOIN '.$NOVIS_CSI_EWA_ALERT_RATING->tbl_name.' as T02 ON T01.alert_rating = T02.alert_rating
					WHERE
						T01.alert_group="'.$id_alert['alert_group'].'"
						AND T01.alert_no="'.$id_alert['alert_no'].'"
					GROUP BY 
						T00.planned_date
					ORDER BY 
						T00.planned_date
					';
//T00.system_no="'.$system.'"
//						AND 

			$alerts = $this->get_sql($sql,'ARRAY_A');
			foreach ($alerts as $alert ){
				$reg = array(
					'planned_date'	=> $alert['planned_date'],
					$alert_id		=> $alert['total'],
				);
				$index = array_search( $alert['planned_date'], array_column( $dataProvider, 'planned_date' ) );
				if (FALSE === $index ){
					array_push($dataProvider, $reg);
				}else{
					$dataProvider[$index][$alert_id] = $alert['total'];
				}
			}
		}
//		self::write_log($dataProvider);
//		self::write_log($graphs);
		wp_localize_script(
			'csiEWASystemHistory',
			'csiEWASystemHistory'.'_system_'.$system,
			array(
				'ppost'			=> $this->plugin_post,
				'ajaxurl'		=> admin_url( 'admin-ajax.php' ),
				'dataProvider'	=> $dataProvider,
//				'graphs'		=> json_encode($graphs),
				'graphs'		=> $graphs,
			)
		);
		$output.='<h3>Resumen de Alertas EWA - Sistema BSP <small>312137533</small></h3>';
		$output.='<div id="ewa_system_history_dp_'.$system.'" class="ewa_system_history_graph" data-system-id="'.$system.'" style="min-height: 300px"></div>';
		$output.='<div id="ewa_system_history_dp_'.$system.'_legend" class="ewa_system_history_legend" data-system-id="'.$system.'" ></div>';
	
//	}
	
	return $output;
}

public function csi_shortcode_ewa_status_by_customer ( $atts ) {
	//Variable definition
	global $wpdb;
	global $NOVIS_CSI_EWA_RATING;
	global $NOVIS_CSI_CUSTOMER;
	global $NOVIS_CSI_CUSTOMER_SYSTEM;
	global $NOVIS_CSI_SAPCUSTNO;
	$output = '';

	//Parameters evaluation
	$environment = array( 1, );
	$customer = $atts [ 'customer' ];
	if ( NULL == $customer ){
		//Current BLOG Customer
		$sql = 'SELECT id FROM '.$NOVIS_CSI_CUSTOMER->tbl_name.' WHERE blog_id = "'.get_current_blog_id().'"';
		$customer = $wpdb->get_col( $sql );
	}elseif ( 'all' == $customer){
		//All Customers
		$sql = 'SELECT id FROM '.$NOVIS_CSI_CUSTOMER->tbl_name;
		$customer = $wpdb->get_col( $sql );
	}else{
		$customer = explode ( ',', $customer );
		foreach ($customer as $key => $val ){
			if (FALSE == intval ( $customer[$key] ) ){
				$sql = 'SELECT id FROM '.$NOVIS_CSI_CUSTOMER->tbl_name.' WHERE code="'.$customer[$key].'"';
				$customer_id = $wpdb->get_var( $sql, 0, 0 );
				$customer[$key] = intval ( $customer_id );
			}
		}
	}

	//get SAPCUSTNO from $customer array
	$sql = 'SELECT sapcustno FROM '.$NOVIS_CSI_SAPCUSTNO->tbl_name.' WHERE customer_id IN ('.implode(', ', $customer ).')';
	$sapcustno = $wpdb->get_col( $sql );

	//get SYSTEMO_NO from $sapcustno array and $environment
	$sql = 'SELECT system_no FROM '.$NOVIS_CSI_CUSTOMER_SYSTEM->tbl_name;
	$sql.=' WHERE sapcustno IN ('.implode(', ', $sapcustno ).') AND environment_id IN ('.implode(',', $environment).') ORDER BY system_no';
	$system_no = $wpdb->get_col( $sql );
	
	$dataProvider = array();
	$graphs = array();

	foreach ( $system_no as $system){
		$sql = 'SELECT
					T00.planned_date,
					T01.hex_color
				FROM
					'.$this->tbl_name.' as T00
					LEFT JOIN '.$NOVIS_CSI_EWA_RATING->tbl_name.' as T01 ON T00.ewa_rating = T01.ewa_rating
				WHERE
					T00.system_no="'.$system.'"
				GROUP BY
					T00.planned_date
				ORDER BY
					T00.planned_date
		';
		$ewas = $this->get_sql( $sql );
		foreach ( $ewas as $key => $ewa){
			$ewa['planned_date'] = self::findMonday($ewa['planned_date']);
			$ewa['planned_date'] = $ewa['planned_date']->format('Y-m-d');
			$reg = array(
				'planned_date'		=> $ewa['planned_date'],
				$system.'_color'	=> '#'.$ewa['hex_color'],
				$system.'_size'		=> 10,
				$system				=> 1,
				'total'				=> 1,
			);
			$index = array_search( $ewa['planned_date'], array_column( $dataProvider, 'planned_date' ) );
			if (FALSE === $index ){
				array_push($dataProvider, $reg);
			}else{
				$dataProvider[$index][$system]			= 1;
				$dataProvider[$index][$system.'_color']	= '#'.$ewa['hex_color'];
				$dataProvider[$index][$system.'_size']	+= 10;
				$dataProvider[$index]['total']			= 1;
			}
		}
		$system_info = $NOVIS_CSI_CUSTOMER_SYSTEM->get_row_by_system_no($system);
		$sql = 'SELECT
					T02.short_name
				FROM
					'.$NOVIS_CSI_CUSTOMER_SYSTEM->tbl_name.' as T00
					LEFT JOIN '.$NOVIS_CSI_SAPCUSTNO->tbl_name.' as T01 ON T00.sapcustno=T01.sapcustno
					LEFT JOIN '.$NOVIS_CSI_CUSTOMER->tbl_name.' as T02 ON T01.customer_id=T02.id
				WHERE
					T00.system_no='.$system;
		$customer_shortname = $wpdb->get_var( $sql, 0, 0 );
		$graph = array(
			'balloonText'				=> "<small>[[title]]</small>",
//			'fillAlphas'				=> 1,
//			'lineThickness'				=> 3,
//			'lineAlpha'					=> 1,
			"fillColorsField"			=> $system.'_color',
			'title'						=> $customer_shortname.' - '.$system_info['sid'],
			'type'						=> "line",
//			'fillColors'				=> '#'.$ewa_rating['hex_color'],
			'lineColor'					=> '#FFF',
			'valueField'				=> $system,
			'id'						=> $system,
			"labelText"					=> $system_info['sid'],
			"lineColor"					=> "#786c56",
			"lineAlpha"					=> 0.25,
			"lineThickness"				=> 1,
			"bullet" 					=> "square",
			"bulletBorderAlpha"			=> 0.25,
			"bulletBorderColor"			=> "#000000",
			"bulletSize"				=> 10,
			"bulletBorderThickness"		=> 2,
			"colorField"				=> $system.'_color',
			"dashLength"				=> 3,
//			"bulletSizeField"			=> $system.'_size'			
//			'visibleInLegend'	=> false,
		);
		array_push($graphs, $graph);
	}
	$graph = array(
		'balloonText'		=> "<small>[[value]]</small>",
//		'fillAlphas'		=> 1,
		'lineAlpha'			=> 0.0,
		'title'				=> 'total',
		'type'				=> "step",
		'lineColor'			=> '#33F',
		'valueField'		=> 'total',
		'id'				=> 'total',
		'visibleInLegend'	=> false,
//		'hidden'			=> true,
	);
	array_push($graphs, $graph);
	
/*
	//get EWA_SESSION_NO from $system_no aarray
	$weeks				= isset ($atts [ 'weeks' ]) ? intval( $atts [ 'weeks' ] ) : 53;
	$days				= intval ($weeks * 7 );
	$current_datetime	= new DateTime();
	$past_datetime		= new DateTime();
	$past_datetime		= $past_datetime->modify('-'. $days . ' days' );
	$current_datetime	=$current_datetime->format('Y-m-d');
	$past_datetime		=$past_datetime->format('Y-m-d');
	$sql				= 'SELECT ewa_session_no FROM '.$this->tbl_name.' WHERE system_no IN ('.implode(',', $system_no).') ';
	$sql				.='AND planned_date BETWEEN "'.$past_datetime.'" AND "'.$current_datetime.'"';
	$ewa_session_no		= $wpdb->get_col( $sql );
//	self::write_log($sql);
	$sql='SELECT
			T00.ewa_rating,
			T01.short_name,
			T01.hex_color
		FROM 
			'.$this->tbl_name.' as T00
			LEFT JOIN '.$NOVIS_CSI_EWA_RATING->tbl_name.' as T01 ON T00.ewa_rating=T01.ewa_rating
		WHERE
			ewa_session_no IN ('.implode(',', $ewa_session_no).') 
		GROUP BY
			T00.ewa_rating
		ORDER BY
			T00.ewa_rating DESC
			';
	$ewa_ratings = $this->get_sql($sql);

	wp_register_script(
		'csiEWASummary',
		CSI_PLUGIN_URL.'/js/shortcodes/min/shortcode-ewa-summary-min.js' ,
		array('amcharts','amcharts-serial','amcharts-responsive'),
		'0.9.0'
	);
	wp_enqueue_script('csiEWASummary');
	$dataProvider = array();
	$graphs = array();
	foreach ( $ewa_ratings as $ewa_rating ){
		$graph = array(
			'balloonText'	=> "<small>[[title]]</small>",
			'fillAlphas'	=> 1,
			'lineAlpha'		=> 1,
			'title'			=> $ewa_rating['short_name'],
			'type'			=> "column",
			'fillColors'	=> '#'.$ewa_rating['hex_color'],
			'lineColor'		=> '#FFF',
			'valueField'	=> $ewa_rating['ewa_rating'],
			'id'			=> $ewa_rating['ewa_rating'],
		);
		array_push($graphs, $graph);
		$sql='SELECT
				T00.planned_date,
				T00.ewa_rating,
				T01.hex_color,
				COUNT(T00.ewa_session_no) as total
				FROM
				'.$this->tbl_name.' as T00 LEFT JOIN '.$NOVIS_CSI_EWA_RATING->tbl_name.' as T01 ON T00.ewa_rating=T01.ewa_rating
				WHERE
					T00.ewa_rating = "'.$ewa_rating['ewa_rating'].'"
					AND ewa_session_no IN ('.implode(',', $ewa_session_no).') 
				GROUP BY
					T00.planned_date
				ORDER BY
					T00.planned_date ASC
				';
		$ewas = $this->get_sql($sql,'ARRAY_A');
		foreach ($ewas as $ewa ){
			if ( $ewa['planned_date'] == '2016-07-14' ){
				self::write_log ( $ewa['planned_date'] );
				self::write_log ( self::findMonday($ewa['planned_date']) );
			}
			$ewa['planned_date'] = self::findMonday($ewa['planned_date']);
			$ewa['planned_date'] = $ewa['planned_date']->format('Y-m-d');
			
			$reg = array(
				'planned_date'				=> $ewa['planned_date'],
				$ewa_rating['ewa_rating']	=> $ewa['total'],
				'total'						=> $ewa['total'],
			);
			$index = array_search( $ewa['planned_date'], array_column( $dataProvider, 'planned_date' ) );
			if (FALSE === $index ){
				array_push($dataProvider, $reg);
			}else{
				if ( isset ( $dataProvider[$index][$ewa_rating['ewa_rating']] )){
					$dataProvider[$index][$ewa_rating['ewa_rating']] += $ewa['total'];
				}else{
					$dataProvider[$index][$ewa_rating['ewa_rating']] = $ewa['total'];					
				}
				$dataProvider[$index]['total'] += $ewa['total'];
			}
		}
//		array_multisort($dataProvider, SORT_ASC, SORT_STRING);
//		array_multisort($graphs, SORT_ASC, SORT_STRING);

	}
	$graph = array(
		'balloonText'		=> "<small>[[title]]</small>",
		'fillAlphas'		=> 1,
		'lineAlpha'			=> 1,
		'title'				=> $ewa_rating['short_name'],
		'type'				=> "column",
		'lineColor'			=> '#000',
		'valueField'		=> 'total',
		'id'				=> 'total',
		'visibleInLegend'	=> false,
		'hidden'			=> true,
	);
	array_push($graphs, $graph);
*/
	wp_register_script(
		'csiEWASummary',
		CSI_PLUGIN_URL.'/js/shortcodes/min/shortcode-ewa-summary-by-customer-min.js' ,
		array('amcharts','amcharts-serial','amcharts-responsive'),
		'0.9.0'
	);
	wp_enqueue_script('csiEWASummary');
	wp_localize_script(
		'csiEWASummary',
		'csiEWASummary',
		array(
			'ppost'			=> $this->plugin_post,
			'ajaxurl'		=> admin_url( 'admin-ajax.php' ),
			'dataProvider'	=> $dataProvider,
			'graphs'		=> $graphs,
		)
	);
	$output.='<div class="row">';
		$output.='<div id="ewa_summary" class="ewa_summary_graph" style="min-height: 500px"></div>';
		$output.='<div id="ewa_summary_legend" class="ewa_summary_legend"  ></div>';
//		$output.='<p class="text-muted text-center"><small>Para generar esta gr&aacute;fica se han analizado '.count($customer).' clientes, '.count($system_no).' systemas ';
//		$output.=' y '.count($ewa_session_no).' reportes EWA considerando los reportes generados entre '.$past_datetime.' y '.$current_datetime.'<small></p>';
	$output.='</div>';
	return $output;
}

public function csi_shortcode_ewa_status($atts){
	//Variable definition
	global $wpdb;
	global $NOVIS_CSI_EWA_RATING;
	global $NOVIS_CSI_CUSTOMER;
	global $NOVIS_CSI_CUSTOMER_SYSTEM;
	global $NOVIS_CSI_SAPCUSTNO;
	$output = '';

	//Parameters evaluation
	$environment = array( 1, );
	$customer = $atts [ 'customer' ];
	if ( NULL == $customer ){
		//Current BLOG Customer
		$sql = 'SELECT id FROM '.$NOVIS_CSI_CUSTOMER->tbl_name.' WHERE blog_id = "'.get_current_blog_id().'"';
		$customer = $wpdb->get_col( $sql );
	}elseif ( 'all' == $customer){
		//All Customers
		$sql = 'SELECT id FROM '.$NOVIS_CSI_CUSTOMER->tbl_name;
		$customer = $wpdb->get_col( $sql );
	}else{
		$customer = explode ( ',', $customer );
		foreach ($customer as $key => $val ){
			if (FALSE == intval ( $customer[$key] ) ){
				$sql = 'SELECT id FROM '.$NOVIS_CSI_CUSTOMER->tbl_name.' WHERE code="'.$customer[$key].'"';
				$customer_id = $wpdb->get_var( $sql, 0, 0 );
				$customer[$key] = intval ( $customer_id );
			}
		}
	}

	//get SAPCUSTNO from $customer array
	$sql = 'SELECT sapcustno FROM '.$NOVIS_CSI_SAPCUSTNO->tbl_name.' WHERE customer_id IN ('.implode(', ', $customer ).')';
	$sapcustno = $wpdb->get_col( $sql );

	//get SYSTEMO_NO from $sapcustno array and $environment
	$sql = 'SELECT system_no FROM '.$NOVIS_CSI_CUSTOMER_SYSTEM->tbl_name;
	$sql.=' WHERE sapcustno IN ('.implode(', ', $sapcustno ).') AND environment_id IN ('.implode(',', $environment).') ORDER BY system_no';
	$system_no = $wpdb->get_col( $sql );

	//get EWA_SESSION_NO from $system_no aarray
	$weeks				= isset ($atts [ 'weeks' ]) ? intval( $atts [ 'weeks' ] ) : 53;
	$days				= intval ($weeks * 7 );
	$current_datetime	= new DateTime();
	$past_datetime		= new DateTime();
	$past_datetime		= $past_datetime->modify('-'. $days . ' days' );
	$current_datetime	=$current_datetime->format('Y-m-d');
	$past_datetime		=$past_datetime->format('Y-m-d');
	$sql				= 'SELECT ewa_session_no FROM '.$this->tbl_name.' WHERE system_no IN ('.implode(',', $system_no).') ';
	$sql				.='AND planned_date BETWEEN "'.$past_datetime.'" AND "'.$current_datetime.'"';
	$ewa_session_no		= $wpdb->get_col( $sql );
//	self::write_log($sql);
	$sql='SELECT
			T00.ewa_rating,
			T01.short_name,
			T01.hex_color
		FROM 
			'.$this->tbl_name.' as T00
			LEFT JOIN '.$NOVIS_CSI_EWA_RATING->tbl_name.' as T01 ON T00.ewa_rating=T01.ewa_rating
		WHERE
			ewa_session_no IN ('.implode(',', $ewa_session_no).') 
		GROUP BY
			T00.ewa_rating
		ORDER BY
			T00.ewa_rating DESC
			';
	$ewa_ratings = $this->get_sql($sql);

	wp_register_script(
		'csiEWASummary',
		CSI_PLUGIN_URL.'/js/shortcodes/min/shortcode-ewa-summary-min.js' ,
		array('amcharts','amcharts-serial','amcharts-responsive'),
		'0.9.0'
	);
	wp_enqueue_script('csiEWASummary');
	$dataProvider = array();
	$graphs = array();
	foreach ( $ewa_ratings as $ewa_rating ){
		$graph = array(
			'balloonText'	=> "<small>[[title]]</small>",
			'fillAlphas'	=> 1,
			'lineAlpha'		=> 1,
			'title'			=> $ewa_rating['short_name'],
			'type'			=> "column",
			'fillColors'	=> '#'.$ewa_rating['hex_color'],
			'lineColor'		=> '#FFF',
			'valueField'	=> $ewa_rating['ewa_rating'],
			'id'			=> $ewa_rating['ewa_rating'],
		);
		array_push($graphs, $graph);
		$sql='SELECT
				T00.planned_date,
				T00.ewa_rating,
				T01.hex_color,
				COUNT(T00.ewa_session_no) as total
				FROM
				'.$this->tbl_name.' as T00 LEFT JOIN '.$NOVIS_CSI_EWA_RATING->tbl_name.' as T01 ON T00.ewa_rating=T01.ewa_rating
				WHERE
					T00.ewa_rating = "'.$ewa_rating['ewa_rating'].'"
					AND ewa_session_no IN ('.implode(',', $ewa_session_no).') 
				GROUP BY
					T00.planned_date
				ORDER BY
					T00.planned_date ASC
				';
		$ewas = $this->get_sql($sql,'ARRAY_A');
		foreach ($ewas as $ewa ){
			$ewa['planned_date'] = self::findMonday($ewa['planned_date']);
			$ewa['planned_date'] = $ewa['planned_date']->format('Y-m-d');
			
			$reg = array(
				'planned_date'				=> $ewa['planned_date'],
				$ewa_rating['ewa_rating']	=> intval( $ewa['total'] ),
//				'total'						=> intval( $ewa['total'] ),
			);
			$index = array_search( $ewa['planned_date'], array_column( $dataProvider, 'planned_date' ) );
			if (FALSE === $index ){
				array_push($dataProvider, $reg);
			}else{
				if ( isset ( $dataProvider[$index][$ewa_rating['ewa_rating']] )){
					$dataProvider[$index][$ewa_rating['ewa_rating']] += intval( $ewa['total'] );
				}else{
					$dataProvider[$index][$ewa_rating['ewa_rating']] = intval( $ewa['total'] );
				}
//				$dataProvider[$index]['total'] += intval( $ewa['total'] );
			}
		}
//		array_multisort($dataProvider, SORT_ASC, SORT_STRING);
//		array_multisort($graphs, SORT_ASC, SORT_STRING);

	}
/*
	$graph = array(
		'balloonText'		=> "<small>[[title]]</small>",
		'fillAlphas'		=> 1,
		'lineAlpha'			=> 1,
		'title'				=> $ewa_rating['short_name'],
		'type'				=> "column",
		'lineColor'			=> '#000',
		'valueField'		=> 'total',
		'id'				=> 'total',
		'visibleInLegend'	=> false,
		'hidden'			=> true,
	);
	array_push($graphs, $graph);
*/	
	wp_register_script(
		'csiEWASummary',
		CSI_PLUGIN_URL.'/js/shortcodes/min/shortcode-ewa-summary-min.js' ,
		array('amcharts','amcharts-serial','amcharts-responsive'),
		'0.9.0'
	);
	wp_enqueue_script('csiEWASummary');
	wp_localize_script(
		'csiEWASummary',
		'csiEWASummary',
		array(
			'ppost'			=> $this->plugin_post,
			'ajaxurl'		=> admin_url( 'admin-ajax.php' ),
			'dataProvider'	=> $dataProvider,
			'graphs'		=> $graphs,
		)
	);
//	self::write_log( json_encode($dataProvider));
//	self::write_log( json_encode($graphs));
	$output.='<div class="row">';
		$output.='<div id="ewa_summary" class="ewa_summary_graph" style="min-height: 500px"></div>';
		$output.='<div id="ewa_summary_legend" class="ewa_summary_legend"  ></div>';
		$output.='<p class="text-muted text-center"><small>Para generar esta gr&aacute;fica se han analizado '.count($customer).' clientes, '.count($system_no).' systemas ';
		$output.=' y '.count($ewa_session_no).' reportes EWA considerando los reportes generados entre '.$past_datetime.' y '.$current_datetime.'<small></p>';
	$output.='</div>';
	return $output;
}

public function csi_shortcode_ewa_ssystem_dashboard($atts){
	//global variables
	global $wpdb;
	global $NOVIS_CSI_CUSTOMER_SYSTEM;
	global $NOVIS_CSI_EWA_RATING;
	global $NOVIS_CSI_EWA_ALERT;
	global $NOVIS_CSI_EWA_ALERT_RATING;
	//local variables
	$o			='';
	$weeks		= 10;
	$system		= '312137533';
	$javascript = array (
		'ppost'							=> $this->plugin_post,
		'ajaxurl'						=> admin_url( 'admin-ajax.php' ),
	);

	$o.='<style>
			.csi-system-dashboard-alert-chart{
				height:20px;
			}
			.csi-system-dashboard-ewa-chart{
				height:80px;
			}
			</style>';
	//check if system exists
	//calculate dates
	//get info of system
	//get ewas of system in ewas
	//build ewa status chart info
	//build table
	//build header
	//get alerts  in ewas
	//foreach alert build two rows
		//build row of alert
		//build info of alert chart
		//build alert table
		//get alerts detail
		//fill alerts detail
	//Parameters evaluation
	$system = intval ( $atts [ 'system' ] );
	if ( NULL == $system || 0 === $system){
		//error message
	}else{
		$start_date			= self::findMonday();
		$days				= intval ($weeks * 7 );
		$current_datetime	= new DateTime();
		$past_datetime		= new DateTime();
		$past_datetime		= $past_datetime->modify('-'. $days . ' days' );
		$current_datetime	= $current_datetime->format('Y-m-d');
		$past_datetime		= $past_datetime->format('Y-m-d');
		$sql = 'SELECT ewa_session_no FROM '.$this->tbl_name.' WHERE system_no="'.$system.'" AND planned_date BETWEEN "'.$past_datetime.'" AND "'.$current_datetime.'"';
		$ewas_id = $wpdb->get_col ( $sql);

		//System Table
		$o.='<div>';
		$o.='<table class="table table-condensed">';
		//System Table Head
		$o.='<thead>';
		$o.='<tr>';
		$sql = 'SELECT
					T00.ewa_session_no,
					T00.planned_date,
					T01.short_name,
					T01.icon,
					T01.css_class,
					T01.hex_color
				FROM
					' . $this->tbl_name . ' as T00
					LEFT JOIN ' . $NOVIS_CSI_EWA_RATING->tbl_name . ' as T01
						ON T00.ewa_rating = T01.ewa_rating
				WHERE
					T00.ewa_session_no IN ('.implode(',', $ewas_id).')
				ORDER BY
					T00.planned_date
		';
		$ewas_data_temp	= $this->get_sql ( $sql );
		$graphs_ewa_data = array();
		foreach ( $ewas_data_temp as $graph_ewa_data ){
			$graphs_ewa_data[$graph_ewa_data['planned_date']] = array(1, $graph_ewa_data['ewa_session_no'], $graph_ewa_data['hex_color'] );
		}
		$dataProvider		= array();
		
		$aa1 = new DateTime($past_datetime);
		$aa2 = new DateTime($current_datetime);
		$daterange = new DatePeriod($aa1, new DateInterval('P1D'), $aa2);
		foreach($daterange as $date){
			$i_date					= $date->format('Y-m-d');
			$val					= isset ( $graphs_ewa_data[ $i_date ] ) ? 1 : null ;
			$color			= isset ( $graphs_ewa_data[ $i_date ] ) ? $graphs_ewa_data[ $i_date ][2] : null ;
			$data_point = array(
				'planned_date'		=> $i_date,
				'color'				=>'#'.$color,
				'val'				=> $val,
			);
			array_push($dataProvider, $data_point);
		}
		$javascript [ $system . '_DataProvider' ] = $dataProvider;
		$graphs = array(
			array(
				"balloonText"	=> "<small>[[category]]</small>",
				"colorField"	=> 'color',
				"fillAlphas"	=> 1,
				"lineThickness"	=> 0,
				"lineAlpha"		=> 0.5,
				"title"			=> $system,
				"type"			=> "column",
				"valueField"	=> "val",
				//------
				"type"			=> "line",
				"lineColor"		=> "#786c56",
				"fillAlphas"	=> 0,
				"lineAlpha"		=> 0,
				"bullet" 		=> "circle",
				"lineColorField"	=> 'color',
				"bulletBorderAlpha"=> 0.125,
				"bulletBorderColor"=> "#000000",
				"bulletSize"	=> 20,
				"bulletBorderThickness"=> 2,
			),
		);
		$javascript [ $system . '_Graphs' ] = $graphs;
		$system_row = $NOVIS_CSI_CUSTOMER_SYSTEM->get_row_by_system_no($system);
		$o.='<th>';
		$o.='<h3> Sistema '.$system_row['sid'].' <small>' . $system . '</small></h3>';
		$o.='<p><a href="#ewa-dashboard-alerts-' . $system . '" data-toggle="collapse">mas</a></p>';
		$o.='<div
				class="csi-system-dashboard-ewa-chart"
				id="' . $system . '"
				data-chart-data="' . $system . '"
				data-system-id="'.$system.'"
			></div>';
		$o.='</th>';

		$o.='</tr>';
		$o.='</thead>';
		$o.='</table>';
		
		//System Table Body
		$o.='<table class="table table-condensed collapse" id="ewa-dashboard-alerts-' . $system . '">';
		$o.='<tbody>';

		$sql = 'SELECT
				T00.alert_group,
				T00.alert_rating,
				T00.alert_no,
				T00.alert_text,
				T01.icon,
				T01.css_class,
				T01.hex_color
			FROM
				'.$NOVIS_CSI_EWA_ALERT->tbl_name.' as T00
				LEFT JOIN '.$NOVIS_CSI_EWA_ALERT_RATING->tbl_name.' as T01
					ON T00.alert_rating=T01.alert_rating
			WHERE
				ewa_session_no IN ('.implode(',', $ewas_id).')
			GROUP BY
				alert_group,
				alert_no
		';
		$alerts = $this->get_SQL ( $sql );

		foreach ( $alerts as $alert ){
			$alert_id = $system . '_' . $alert['alert_group'] . '_' . $alert['alert_no'];
			$o.='<tr class="active">';
			$o.='<td>';
			$o.='<div class="clearfix">';
			$o.='<h5 class="pull-left"><i class="fa fa-' . $alert['icon'] . ' text-' . $alert['css_class'] . ' fa-fw"></i> ' . $alert['alert_text'] . ' </h5>';
			$o.='<div class="pull-right">';
			$o.='<button class="btn btn-default" data-target="#' . $alert_id . '_detail" data-toggle="collapse">';
			$o.='Ver mas';
			$o.='</button>';
			$o.='</div>';
			$o.='</div>';
			//Alert Chart
			$sql = 'SELECT
						T01.planned_date,
						T00.alert_rating,
						T00.alert_text,
						T00.last_modified_user_id,
						T00.last_modified_user_email,
						T00.last_modified_date,
						T00.last_modified_time,
						T00.action_party_id,
						T00.action_id,
						T02.icon,
						T02.css_class,
						T02.hex_color
					FROM
						' . $NOVIS_CSI_EWA_ALERT->tbl_name . ' as T00
						LEFT JOIN ' . $this->tbl_name . ' as T01
							ON T00.ewa_session_no = T01.ewa_session_no
						LEFT JOIN '.$NOVIS_CSI_EWA_ALERT_RATING->tbl_name.' as T02
							ON T00.alert_rating=T02.alert_rating
					WHERE
						T00.alert_group		= "' . $alert['alert_group'] . '"
						AND T00.alert_no	= "' . $alert['alert_no'] . '"
						AND T00.ewa_session_no IN ('.implode(',', $ewas_id).')
					ORDER BY
						T01.planned_date
			';


			$alerts_data_temp	= $this->get_sql ( $sql );
			$graphs_alert_data = array();
			foreach ( $alerts_data_temp as $graph_alert_data ){
				$graphs_alert_data[$graph_alert_data['planned_date']] = 1;
			}
			$dataProvider		= array();
			
			$aa1 = new DateTime($past_datetime);
			$aa2 = new DateTime($current_datetime);
			$daterange = new DatePeriod($aa1, new DateInterval('P1D'), $aa2);
			foreach($daterange as $date){
				$i_date = $date->format('Y-m-d');
				$val = isset ( $graphs_alert_data[ $i_date ] ) ? 1 : null ;
				$data_point = array(
					'planned_date'	=> $i_date,
					'val'			=> $val,
				);
				array_push($dataProvider, $data_point);
			}
			$javascript [ $alert_id . '_DataProvider' ] = $dataProvider;
			$graphs = array(
				array(
					"balloonText"	=> "<small>[[category]]</small>",
					"fillColors"	=> array ('#'.$alert['hex_color']),
					"fillAlphas"	=> 1,
					"lineThickness"	=> 0,
					"lineAlpha"		=> 0.5,
					"title"			=> $system,
					"type"			=> "column",
					"valueField"	=> "val",
					//------
//					"type"			=> "line",
//					"lineColor"		=> "#786c56",
//					"fillAlphas"	=> 0,
//					"lineAlpha"		=> 0,
//					"bullet" 		=> "circle",
//					"bulletColor"	=> array ('#'.$alert['hex_color']),
//					"bulletBorderAlpha"=> 0.125,
//					"bulletBorderColor"=> "#000000",
//					"bulletSize"	=> 20,
//					"bulletBorderThickness"=> 2,
				),
			);
			$javascript [ $alert_id . '_Graphs' ] = $graphs;
			$o.='<div
					class="csi-system-dashboard-alert-chart"
					id="' . $alert_id . '"
					data-chart-data="' . $alert_id . '"
					data-system-id="'.$system.'"
				></div>';
				
			$o.='</td>';
			$o.='</tr>';
			$o.='<tr class="collapse" id="' . $alert_id . '_detail">';
			$o.='<td colspan="999" >';

			//Detailed Alert Table
			$o.='<table class="table table-condensed">';

			//Detailed Alert Table Head
			$o.='<thead>';
			$o.='<tr>';
			$o.='<th>Fecha</th>';
			$o.='<th class="text-center">Rating</th>';
			$o.='<th class="text-center">Prioridad</th>';
			$o.='<th class="text-center">&Uacute;ltima modificaci&oacute;n</th>';
			$o.='<th class="text-center">Acci&oacute;n</th>';
			$o.='</tr>';	
			$o.='</thead>';

			//Detailed Alert Table Body
			$o.='<tbody>';
			foreach ( $alerts_data_temp as $alert ){
				$o.='<tr>';
				$o.='<td>' . $alert['planned_date'] . '</td>';
				$o.='<td class="text-center"><i class="fa fa-' . $alert['icon'] . ' text-' . $alert['css_class'] . '"></i></td>';
				$o.='<td class="text-center"><small class="text-danger">
											<i class="fa fa-star fa-sm"></i>
											<i class="fa fa-star fa-sm"></i>
											<i class="fa fa-star-o fa-sm"></i>
											<i class="fa fa-star-o fa-sm"></i>
											<i class="fa fa-star-o fa-sm"></i>
										</small>
					</td>';
				if ( $alert['last_modified_user_id'] > 0 ){
					$user_info = get_userdata($alert['last_modified_user_id']);
					$user_name = $user_info->user_login;
				}else{
					$user_name = '';
				}
				$o.='<td class="text-center">
						<p class=""><a href="mailto:' . $alert['last_modified_user_email'] . '">' . $user_name . '</a></p>
						<p class="text-muted"><small>' . $alert['last_modified_date'] . ' - ' . $alert['last_modified_time'] . '</small></p>
					</td>';
				$o.='<td class="text-center"><a href="#" class="btn btn-primary">Accion</a></td>';
				$o.='</tr>';
				
			}
			
			$o.='</tbody>';
			
			$o.='</table>';
			$o.='</td>';
			$o.='</tr>';			
		}
		$o.='</tbody>';
		$o.='</table>';
		$o.='</div>';
		wp_register_script(
			'csiEWASystemDashboard',
			CSI_PLUGIN_URL.'/js/shortcodes/min/shortcode-ewa-system-dashboard-min.js' ,
			array('jquery','bootstrap','amcharts','amcharts-serial','amcharts-responsive'),
			'0.0.1'
		);
		wp_enqueue_script('csiEWASystemDashboard');
		wp_localize_script(
			'csiEWASystemDashboard',
			'csiEWASystemDashboard'.$system,
			$javascript
		);
	}
	return $o;
}

public function csi_shortcode_ewa_customer_block ( $atts ) { 
	//global variables
	global $wpdb;
	global $NOVIS_CSI_CUSTOMER;
	global $NOVIS_CSI_CUSTOMER_SYSTEM;
	global $NOVIS_CSI_EWA_RATING;
	global $NOVIS_CSI_EWA_ALERT;
	global $NOVIS_CSI_EWA_ALERT_RATING;
	global $NOVIS_CSI_SAPCUSTNO;
	//local variables
	$customers		= array( 20);
	$environment	= array(1);
	$o				='';
	$weeks			= isset ($atts [ 'weeks' ]) ? intval( $atts [ 'weeks' ] ) : 0;
	$days			= intval ($weeks * 7 );
	$javascript = array (
		'ppost'							=> $this->plugin_post,
		'ajaxurl'						=> admin_url( 'admin-ajax.php' ),
	);
	$o.='<style>
			.ewa-customer-block-ewa-chart{
				vertical-align: middle;
				min-height:100px;
			}
			</style>';
	$customer = isset ( $atts [ 'customer' ] ) ? $atts [ 'customer' ] : NULL;
	if ( NULL == $customer ){
		if ( is_multisite() ){
			//Current BLOG Customer
			$sql = 'SELECT id FROM '.$NOVIS_CSI_CUSTOMER->tbl_name.' WHERE blog_id = "'.get_current_blog_id().'"';
			$customer = $wpdb->get_col( $sql );
		}else{
			$customer = 'all';
		}
	}
	if ( 'all' == $customer){
		//All Customers
		$sql = 'SELECT id FROM '.$NOVIS_CSI_CUSTOMER->tbl_name;
		$customer = $wpdb->get_col( $sql );
	}else{
		$customer = explode ( ',', $customer );
		foreach ($customer as $key => $val ){
			if (FALSE == intval ( $customer[$key] ) ){
				$sql = 'SELECT id FROM '.$NOVIS_CSI_CUSTOMER->tbl_name.' WHERE code="'.$customer[$key].'"';
				$customer_id = $wpdb->get_var( $sql, 0, 0 );
				$customer[$key] = intval ( $customer_id );
			}
		}
	}
	$customers = $customer;

	$now			= new DateTime();
	if ( 0 != $days ){
		$now = $now->modify('-' . $days . ' days' );
	}
	$week			= $now->format("W");
	$year			= $now->format("Y");
	$monday			= new DateTime();
	$monday->setISODate($year,$week);
	$monday			= $monday->format('Y-m-d');
	$sunday			= new DateTime();
	$sunday->setISODate($year,$week,7);
	$sunday 		= $sunday->format('Y-m-d');
	$o.='	<h1>Dashboard de Reportes EWA Semanal <small> Semana ' . $week . ' ' .$year . ' ( ' . $monday . '-' . $sunday . ')</small></h1>';
	$o.='<div class="row">';
	foreach ( $customers as $customer){
		//get SAPCUSTNO from $customer array
		$sql = 'SELECT sapcustno FROM '.$NOVIS_CSI_SAPCUSTNO->tbl_name.' WHERE customer_id = "' . $customer .'"';
		$sapcustno = $wpdb->get_col( $sql );
		if ( 0 == count ($sapcustno) ){
			continue;
		}
	
		//get SYSTEMO_NO from $sapcustno array and $environment
		$sql = 'SELECT system_no FROM '.$NOVIS_CSI_CUSTOMER_SYSTEM->tbl_name;
		$sql.=' WHERE sapcustno IN ('.implode(', ', $sapcustno ).') AND environment_id IN ('.implode(',', $environment).') ORDER BY system_no';
		$system_no = $wpdb->get_col( $sql );
		if ( 0 == count ($system_no) ){
			continue;
		}
	
		//get EWA_SESSION_NO from $system_no array
		$sql = 'SELECT
					T00.ewa_session_no,
					T00.ewa_rating,
					T01.short_name,
					T01.hex_color
				FROM
					' . $this->tbl_name . ' as T00
					LEFT JOIN ' . $NOVIS_CSI_EWA_RATING->tbl_name . ' as T01
						ON T00.ewa_rating=T01.ewa_rating
				WHERE
					system_no IN ('.implode(',', $system_no).')
					AND planned_date BETWEEN "'.$monday.'" AND "'.$sunday.'"
		';
		$ewas_id = $wpdb->get_col( $sql );
		$ewas	= $this->get_sql ( $sql );
		if ( 0 == count ($ewas) ){
			continue;
		}
	
		$dataProvider = array();
		foreach ( $ewas as $ewa ){
			$reg = array(
				'title'	=> $ewa['short_name'],
				'ewas'	=> 1,
				'color'	=> '#' . $ewa['hex_color']
			);
			$index = array_search( $ewa['short_name'], array_column( $dataProvider, 'title' ) );
			if (FALSE === $index ){
				array_push($dataProvider, $reg);
			}else{
				$dataProvider[$index]['ewas'] += 1;
			}
		}
		$javascript [ $customer . '_ewa_DataProvider' ] = $dataProvider;
		//get ALERTS from $ewas_id array
		$sql = 'SELECT
					T00.alert_rating
				FROM
					' . $NOVIS_CSI_EWA_ALERT->tbl_name . ' as T00
					LEFT JOIN ' . $NOVIS_CSI_EWA_ALERT_RATING->tbl_name . ' as T01
						ON T00.alert_rating=T01.alert_rating
				WHERE
					T00.ewa_session_no IN ('.implode(',', $ewas_id).')
		';
		$alerts	= $wpdb->get_col ( $sql );

		$o.='<div class="csi-ewa-customer-block col-xs-12 col-sm-4 col-md-3 col-lg-3">';
		$o.='<div class="panel panel-default">';
			$sql = 'SELECT code, short_name, blog_id FROM ' . $NOVIS_CSI_CUSTOMER->tbl_name . ' WHERE id = "' . $customer . '"';
			$customer_data = $this->get_sql( $sql );
			$o.='<div class="panel-heading">
					<a href="' . get_site_url( $customer_data[0]['blog_id'], 'co/ewa-management' ) . '">
						<p class="panel-title">' . $customer_data[0]['short_name'] . ' <small>(' . $customer_data[0]['code'] . ')</small></p>
					</a>
				</div>';
			$o.='<div class="panel-body">';
				$o.='<div class="row">
						<div
							class="ewa-customer-block-ewa-chart"
							id="ewa-customer-block-ewa-chart-' . $customer . '"
							data-chart-data="' . $customer . '_ewa"
							data-customer-id="' . $customer . '"
							></div>
					</div>';
				$o.='<div class="row">
						<div class="col-xs-4 text-center">
							<div class=""><strong>' . count( $system_no ) . '</strong></div>
							<div class="text-muted"><small>Sistemas</small></div>
						</div>
						<div class="col-xs-4 text-center">
							<div class=""><strong>' . count( $ewas ) . '</strong></div>
							<div class="text-muted"><small>EWA</small></div>
						</div>
						<div class="col-xs-4 text-center">
							<div class=""><strong>' . count ($alerts ) . '</strong></div>
							<div class="text-muted"><small>Alertas</small></div>
						</div>
					</div>
					';
			$o.='</div><!-- end panel-body -->';
//			$o.='<div class="panel-footer clearfix">';
//				$o.='<p class="text-center"><strong>Semana ' . $week . '</strong> <small>(' . $year . ')</small></p>';
//				$o.='<small class="col-xs-6 text-center">' . $monday . '</small>';
//				$o.='<small class="col-xs-6 text-center">' . $sunday . '</small>';
//			$o.='</div><!-- end panel-footer -->';
		$o.='</div><!-- end panel -->';
		$o.='</div><!-- end csi-ewa-customer-block -->';		
	}
	$o.='</div><!-- end row -->';
	wp_register_script(
		'csiEWACustomerBlock',
		CSI_PLUGIN_URL.'/js/shortcodes/min/shortcode-ewa-customer-block-min.js' ,
		array('jquery','bootstrap','amcharts','amcharts-serial','amcharts-responsive','amcharts-pie'),
		'0.0.1'
	);
	wp_enqueue_script('csiEWACustomerBlock');
	wp_localize_script(
		'csiEWACustomerBlock',
		'csiEWACustomerBlock',
		$javascript
	);
	return $o;
}

public function csi_shortcode_ewa_week_summary ( $atts ) {
	//global variables
	global $wpdb;
	global $NOVIS_CSI_CUSTOMER;
	global $NOVIS_CSI_CUSTOMER_SYSTEM;
	global $NOVIS_CSI_EWA_RATING;
	global $NOVIS_CSI_EWA_ALERT;
	global $NOVIS_CSI_EWA_ALERT_RATING;
	global $NOVIS_CSI_SAPCUSTNO;
	//local variables
	$javascript = array (
		'ppost'							=> $this->plugin_post,
		'ajaxurl'						=> admin_url( 'admin-ajax.php' ),
	);
	$customers		= self::shortcode_get_customers_atts($atts);
	$weeks			= isset ($atts [ 'weeks' ]) ? intval( $atts [ 'weeks' ] ) : 0;
	$days			= intval ($weeks * 7 );
	$now			= new DateTime();
	$now			= $now->modify('-' . $days . ' days');
	$week			= $now->format("W");
	$year			= $now->format("Y");
	$monday			= new DateTime();
	$monday->setISODate($year,$week);
	$monday			= $monday->format('Y-m-d');
	$sunday			= new DateTime();
	$sunday->setISODate($year,$week,7);
	$sunday 		= $sunday->format('Y-m-d');

	$o				='';
	$o.='<h2>Tabla de EWAs por cliente - Semana ' . $week . ' <small>' . $monday . ' - ' . $sunday . '</small></h2>';
	$o.='<table class="table table-condensed">';
		$o.='<thead>';
			$o.='<tr>';
				$o.='<th>Cliente</th>';
				$o.='<th class="text-center">Sistemas</th>';
				$o.='<th class="text-center">EWAs</th>';
				$o.='<th class="text-center">Status <small>EWAs generados</small></th>';
				$o.='<th>&nbsp;</th>';
			$o.='</tr>';
		$o.='</thead>';
		//Por cada cliente (ordenado por algo?)
		$o.='<tbody>';
	foreach ( $customers as $customer ){
		$customer = $wpdb->get_row('SELECT * FROM ' . $NOVIS_CSI_CUSTOMER->tbl_name . ' WHERE id = "' . $customer . '"','ARRAY_A');
		$systems_no = self::get_systems_no_by_cust_id( $customer['id'] );
		if ( 0 < count ( $systems_no )){
			$ewas = self::get_ewa_session_no_by_system_list( $systems_no, $monday, $sunday);			
		}else{
			$ewas = NULL;
		}
		$o.='<tr class="active">';
		$o.='<th>' . $customer['short_name'] . ' <small class="text-muted">' . $customer['code'] . '</small></th>';
		$o.='<td class="text-center">' . ( $systems_no != false ? count ( $systems_no ) : 0 ) . ' Sistemas</td>';
		$o.='<td class="text-center">';
		$o.=count ( $ewas['ewas_id'] ) . ' EWAs ';
		if ( count ( $systems_no ) > count ( $ewas['ewas_id'] ) ) {
			$o.='<i class="fa fa-exclamation-circle fa-fw text-danger"></i>';
		}
		if ( count ( $systems_no ) == count ( $ewas['ewas_id'] ) ) {
			$o.='<i class="fa fa-check-square fa-fw text-success"></i>';
		}
		if ( count ( $systems_no ) < count ( $ewas['ewas_id'] ) ) {
			$o.='<i class="fa fa-exclamation-triangle fa-fw text-warning"></i>';
		}
		$o.='</td>';
		$o.='<td><div class="text-center">';
		//build ewas array grouped by rating
		if ( NULL != $ewas && 0 < count ( $ewas['ewas'] ) ) {
			$ewas_rating = array();
			foreach ( $ewas['ewas'] as $ewa ){
				$ewa = array(
					'ewa_rating'	=> $ewa['ewa_rating'],
					'short_name'	=> $ewa['short_name'],
					'css_class'		=> $ewa['css_class'],
					'hex_color'		=> $ewa['hex_color'],
					'total'			=> 1,
				);
				$index = array_search( $ewa['ewa_rating'], array_column( $ewas_rating, 'ewa_rating' ) );
				if (FALSE === $index ){
					array_push($ewas_rating, $ewa);
				}else{
					$ewas_rating[$index]['total'] += 1;
				}
			}
			foreach ( $ewas_rating as $ewa_rating ){
				$o.='<span
						class="label label-' . $ewa_rating['css_class'] . '"
						data-toggle="tooltip"
						data-placement="top"
						title="' . $ewa_rating['short_name'] . ': ' . $ewa_rating['total'] . '">' . $ewa_rating['total'] . '</span>';
			}
		}
		$o.='
				</div>
		</td>';
		$o.='<td class="text-center">';
		if ( 0 < count ( $systems_no ) &&  NULL != $systems_no){
			$o.='<button
				class="btn btn-default btn-sm"
				type="button"
				data-toggle="collapse"
				data-target="#csi-ewa-week-summary-' . $customer['id'] . '"
				aria-expanded="false"
				aria-controls="collapseExample">
				Ver mas
			</button>';
		}else{
			$o.='&nbsp;';
		}
		$o.='</td>';
		$o.='</tr>';
		if ( 0 < count ( $systems_no ) &&  NULL != $systems_no){
			$o.='<tr class="collapse" id="csi-ewa-week-summary-' . $customer['id'] . '">';
			$o.='<td></td>';				
			$o.='<td colspan="999">';
			$o.='<table class="table table-condensed table-hover">';
			$o.='<thead>';
			$o.='<tr>';
			$o.='<th>SID</td>';
			$o.='<th>EWA</th>';
			$o.='<th>Alertas</th>';
			$o.='</tr>';
			$o.='</thead>';
			$o.='<tbody>';
			foreach ( $systems_no as $system_no ){
				$ewas = self::get_ewa_session_no_by_system_list( array ( $system_no ) , $monday, $sunday);				
				$system = $wpdb->get_row ( 'SELECT * FROM ' . $NOVIS_CSI_CUSTOMER_SYSTEM->tbl_name . ' WHERE system_no = "' . $system_no . '"', 'ARRAY_A' );
				$url = 'http://intranetmx.noviscorp.com/novis/co/ewa-management/ewa-control-center/?customer_code=' . $customer['code'] . '&sid=' . $system['sid'] . '&date=this-week';
				$o.='<tr>';
				$o.='<td><a href="' . $url . '">' . $system['sid'] . ' <small class="text-muted">' . $system['system_no'] . '</small></a></td>';
				$o.='<td>';
				if ( NULL != $ewas && 0 < count ( $ewas['ewas'] ) ){
					$o.='<a href="' . $url . '">';
					foreach ( $ewas['ewas'] as $ewa){
						$o.='<span
								class="label label-' . $ewa['css_class'] . '"
								data-toggle="tooltip"
								data-placement="top"
								title="' . $ewa['ewa_session_no'] . ' (' . $ewa['short_name'] . ')">1</span>';
					}
					$o.='</a>';
				}else{
					$o.='&nbsp;';
				}
				$o.='</td>';
				$o.='<td>';
					$alerts = self::get_alerts_by_ewa_session_no_list ( $ewas['ewas_id'] );
					if ( NULL != $alerts && 0 < count ( $alerts) ) {
						$o.='<a href="' . $url . '">';
						$alerts_rating = array();
						foreach ( $alerts as $alert ){
							$alert = array(
								'alert_rating'	=> $alert['alert_rating'],
								'short_name'	=> $alert['short_name'],
								'css_class'		=> $alert['css_class'],
								'hex_color'		=> $alert['hex_color'],
								'total'			=> 1,
							);
							$index = array_search( $alert['alert_rating'], array_column( $alerts_rating, 'alert_rating' ) );
							if (FALSE === $index ){
								array_push($alerts_rating, $alert);
							}else{
								$alerts_rating[$index]['total'] += 1;
							}
						}
						foreach ( $alerts_rating as $alert_rating ){
							$o.='<span
									class="label label-' . $alert_rating['css_class'] . '"
									data-toggle="tooltip"
									data-placement="top"
									title="' . $alert_rating['short_name'] . ': ' . $alert_rating['total'] . '">' . $alert_rating['total'] . '</span>';
						}
						$o.='</a>';
					}else{
						if ( 0 < count ( $ewas['ewas_id'] ) ) {
							$o.='<span class="text-success"><i class="fa fa-check fa-fw"></i></span>';
						}else{
							$o.='<button class="btn btn-default btn-sm ewa-week-summary-sql-code-button" data-system-no="' . $system['system_no'] . '"><i class="fa fa-code fa-fw"></i></button>';
						}
					}
				$o.='</td>';
				$o.='</tr>';
			}
			$o.='</tbody>';
			$o.='</table>';
			$o.='</td>';
			$o.='</tr>';
		}//if count $systems_no
	}//foreach $customers
		$o.='</tbody>';
	$o.='</table>';
		wp_register_style(
			"jquery-confirm",
			CSI_PLUGIN_URL.'/external/jquery-confirm/dist/jquery-confirm.min.css' ,
			null,
			"1.0",
			"all"
		);
		wp_enqueue_style("jquery-confirm" );
	wp_register_script(
		'csiEWAWeekSummary',
		CSI_PLUGIN_URL.'/js/shortcodes/min/shortcode-ewa-week-summary-min.js' ,
		array('jquery','bootstrap', 'jquery-confirm', 'amcharts','amcharts-serial','amcharts-responsive','amcharts-pie'),
		'0.0.1'
	);
	wp_enqueue_script('csiEWAWeekSummary');
	wp_localize_script(
		'csiEWAWeekSummary',
		'csiEWAWeekSummary',
		$javascript
	);
	return $o;
}

protected function shortcode_get_customers_atts($atts){
	global $NOVIS_CSI_CUSTOMER;
	global $wpdb;
	$customer = isset ( $atts [ 'customer' ] ) ? $atts [ 'customer' ] : NULL;
	if ( NULL == $customer ){
		if ( is_multisite() ){
			//Current BLOG Customer
			$sql = 'SELECT id FROM '.$NOVIS_CSI_CUSTOMER->tbl_name.' WHERE blog_id = "'.get_current_blog_id().'"';
			$customer = $wpdb->get_col( $sql );
		}else{
			$customer = 'all';
		}
	}
	if ( 'all' == $customer){
		//All Customers
		$sql = 'SELECT id FROM '.$NOVIS_CSI_CUSTOMER->tbl_name . ' ORDER BY short_name';
		$customer = $wpdb->get_col( $sql );
	}else{
		$customer = explode ( ',', $customer );
		foreach ($customer as $key => $val ){
			if (FALSE == intval ( $customer[$key] ) ){
				$sql = 'SELECT id FROM '.$NOVIS_CSI_CUSTOMER->tbl_name.' WHERE code="'.$customer[$key].'"';
				$customer_id = $wpdb->get_var( $sql, 0, 0 );
				$customer[$key] = intval ( $customer_id );
			}
		}
	}
	return $customer;
}

protected function get_systems_no_by_cust_id ( $customer_id, $environment = array( 1 ) ) {
	global $wpdb;
	global $NOVIS_CSI_SAPCUSTNO;
	global $NOVIS_CSI_CUSTOMER_SYSTEM;

	$sql = 'SELECT sapcustno FROM ' . $NOVIS_CSI_SAPCUSTNO->tbl_name . ' WHERE customer_id = "' . $customer_id .'"';
	$sapcustno = $wpdb->get_col( $sql );
	
	if ( 0 >= count ( $sapcustno) ){
		return false;
	}
	$sql = 'SELECT system_no FROM ' . $NOVIS_CSI_CUSTOMER_SYSTEM->tbl_name;
	$sql.=' WHERE sapcustno IN (' . implode ( ', ', $sapcustno ) . ') AND environment_id IN (' . implode ( ',', $environment) . ') ORDER BY sid, system_no';
	$system_no = $wpdb->get_col( $sql );
	
	return $system_no;
}

protected function get_ewa_session_no_by_system_list( $system_list = array() , $start_date , $end_date ) {
	global $wpdb;
	global $NOVIS_CSI_EWA_RATING;
	if ( $system_list == null || 0 === count ( $system_list) ){
		return false;
	}
	if ( $start_date === null ){
		$start_date		= new DateTime();
		$start_date		= $start_date->format ( 'Y-m-d' );
	}
	if ( $end_date === null ){
		$end_date		= new DateTime();
		$end_date		= $end_date->format ( 'Y-m-d' );
	}
	$sql = 'SELECT
				T00.ewa_session_no,
				T00.planned_date,
				T00.ewa_rating,
				T01.short_name,
				T01.css_class,
				T01.hex_color
			FROM
				' . $this->tbl_name . ' as T00
				LEFT JOIN ' . $NOVIS_CSI_EWA_RATING->tbl_name . ' as T01
					ON T00.ewa_rating=T01.ewa_rating
			WHERE
				system_no IN (' . implode ( ',', $system_list ) .')
				AND planned_date BETWEEN "' . $start_date . '" AND "' . $end_date . '"
	';
	return array(
		'ewas_id'	=> $wpdb->get_col ( $sql ),
		'ewas'		=> $this->get_sql ( $sql ),
	);
}

protected function get_alerts_by_ewa_session_no_list ( $ewa_session_no = array() ){
	global $wpdb;
	global $NOVIS_CSI_EWA_ALERT;
	global $NOVIS_CSI_EWA_ALERT_RATING;
	if ( $ewa_session_no == null || 0 === count ( $ewa_session_no) ){
		return false;
	}
	$sql = 'SELECT
				T02.ewa_rating,
				T00.alert_rating,
				T01.short_name,
				T01.css_class,
				T01.icon,
				T01.hex_color
			FROM
				' . $NOVIS_CSI_EWA_ALERT->tbl_name . ' as T00
				LEFT JOIN ' . $NOVIS_CSI_EWA_ALERT_RATING->tbl_name . ' as T01
					ON T00.alert_rating=T01.alert_rating
				LEFT JOIN ' . $this->tbl_name . ' as T02
					ON T00.ewa_session_no = T02.ewa_session_no
			WHERE
				T00.ewa_session_no IN (' . implode ( ',', $ewa_session_no ) .')
			';
	return $this->get_sql ( $sql );
}

public function csi_ajax_template_ewa_control_center_fetch_alerts(){
	//variables globales
	global $wpdb;
	global $NOVIS_CSI_EWA_ALERT;
	global $NOVIS_CSI_CUSTOMER_SYSTEM;
	global $NOVIS_CSI_SAPCUSTNO;
	global $NOVIS_CSI_CUSTOMER;
	global $NOVIS_CSI_EWA_ALERT_RATING;
	global $NOVIS_CSI_EWA_ALERT_ACTION_PARTY;
	//variables localse
	$tbody				= '';
	$graphs_container	='';
	$graphs				= array();
	$response			= array();
	$now				= NULL;
	$alerts				= array();
	//parámetros de función
	if ( isset ( $_REQUEST [ 'date' ] ) ){
		$timestamp		= strtotime ( $_REQUEST [ 'date' ] );
		if ( FALSE == $timestamp ){
			$now		= NULL;
		}else{
			$now		= new DateTime ( date ( 'Y-m-d', $timestamp ) );
		}
	}
	if ( NULL == $now ) {
		$now			= new DateTime();
	}

	$week				= $now->format("W");
	$year				= $now->format("Y");
	$monday				= new DateTime();
	$monday->setISODate($year,$week);
	$monday				= $monday->format('Y-m-d');
	$sunday				= new DateTime();
	$sunday->setISODate($year,$week,7);
	$sunday				= $sunday->format('Y-m-d');
	$action_flag		= ( isset ( $_REQUEST ['action_flag'] ) && 'true' == $_REQUEST ['action_flag'] ) ? TRUE : FALSE;
	
	//filter
	$filter_customer	= ( isset ( $_REQUEST ['filter_customer'] ) && '' != $_REQUEST ['filter_customer'] ) ? $_REQUEST ['filter_customer'] : FALSE;
	$filter_sid			= ( isset ( $_REQUEST ['filter_sid'] ) && '' != $_REQUEST ['filter_sid'] ) ? $_REQUEST ['filter_sid'] : FALSE;
	$filter_group		= ( isset ( $_REQUEST ['filter_group'] ) && '' != $_REQUEST ['filter_group'] ) ? $_REQUEST ['filter_group'] : FALSE;
	$filter_text		= ( isset ( $_REQUEST ['filter_text'] ) && '' != $_REQUEST ['filter_text'] ) ? $_REQUEST ['filter_text'] : FALSE;

	$response ['action_flag']		= $action_flag;
	$response ['date_m']			= $monday;
	$response ['date_s']			= $sunday;
	
	$sql = '
			SELECT
			T01.id,
			T01.alert_rating,
			T04.short_name,
			T04.code,
			T02.sid,
			T01.alert_group,
			T01.alert_text,
			T05.css_class,
			T05.icon,
			T01.action_party_id,
			T01.action_id,
			T01.customer_flag,
			T06.url
			FROM
				' . $this->tbl_name . ' as T00
				LEFT JOIN ' . $NOVIS_CSI_EWA_ALERT->tbl_name . ' as T01
					ON T01.ewa_session_no = T00.ewa_session_no
				LEFT JOIN ' . $NOVIS_CSI_CUSTOMER_SYSTEM->tbl_name . ' as T02
					ON T00.system_no = T02.system_no
				LEFT JOIN ' . $NOVIS_CSI_SAPCUSTNO->tbl_name . ' as T03
					ON T02.sapcustno = T03.sapcustno
				LEFT JOIN ' . $NOVIS_CSI_CUSTOMER->tbl_name . ' as T04
					ON T03.customer_id = T04.id
				LEFT JOIN ' . $NOVIS_CSI_EWA_ALERT_RATING->tbl_name . ' as T05
					ON T05.alert_rating = T01.alert_rating
				LEFT JOIN ' . $NOVIS_CSI_EWA_ALERT_ACTION_PARTY->tbl_name . ' as T06
					ON T01.action_party_id = T06.id 
			WHERE
				T00.planned_date BETWEEN "' . $monday . '" AND "' . $sunday . '"
	';
	if ( FALSE == $action_flag ){
		$sql .=' AND T01.action_id is NULL ';
	}
	if ( FALSE != $filter_customer ){
		$sql .=' AND UPPER(T04.code) LIKE "%' . strtoupper( $filter_customer ) . '%" ';
	}
	if ( FALSE != $filter_sid ){
		$sql .=' AND UPPER(T02.sid) LIKE "%' . strtoupper( $filter_sid ) . '%" ';
	}
	if ( FALSE != $filter_group ){
		$sql .=' AND UPPER(T01.alert_group) LIKE "%' . strtoupper( $filter_group ) . '%" ';
	}
	if ( FALSE != $filter_text ){
		$sql .=' AND UPPER(T01.alert_text) LIKE "%' . strtoupper( $filter_text ) . '%" ';
	}
	$sql.=' LIMIT 30 ';
	$alerts = $this->get_sql($sql);
	if ( 0 < count ( $alerts ) ){
		$sql = 'SELECT * FROM ' . $NOVIS_CSI_EWA_ALERT_ACTION_PARTY->tbl_name;
		$action_parties = $this->get_sql ( $sql );
		$action = '';
		foreach ( $alerts as $alert ){
			if ( NULL != $alert['action_id'] ){
				$url=str_replace('[TICKET]', $alert['action_id'], $alert['url'] );
				$action_btn = '<a href="'. $url . '" class="btn btn-primary btn-sm">' . $alert['action_id'] . '</a>';
			}else{
				$action_btn='';
			}
			$tbody.=
				'<tr class="' . $alert['css_class'] . '">
					<th>' . $alert['code'] . '</th>
					<td>' . $alert['sid'] . '</td>
					<td class="hidden-xs"> PRIORIDAD </td>
					<td class=""><small>' . $alert['alert_group'] . '</small></td>
					<td class="text-' . $alert['css_class'] . ' col-xs-4"><small><i class="fa fa-' . $alert['icon'] . ' "></i> ' . $alert['alert_text'] . '</small></td>
					<td>
						<div class="btn-group" role="group" aria-label="options">
							' . $action_btn . '
							<button
								class="btn btn-default btn-sm"
								type="button"
								data-toggle="collapse"
								data-target="#csi-ewa-template-control-center-alert-' . $alert['id'] . '"
								aria-expanded="false"
								aria-controls="csi-ewa-template-control-center-alert-' . $alert['id'] . '"
								data-parent="#accordion">
								<i class="fa fa-pencil fa-fw"></i>
							</button>
						</div><!-- .btn-group -->
					</td>
				</tr>';
			$tbody.='
				<tr class="collapse ' . $alert['css_class'] . '" id="csi-ewa-template-control-center-alert-' . $alert['id'] . '">
					<td colspan="999">
						<p class="text-center">
							<form class="form-inline text-center csi-ewa-template-control-center-alert-form" data-alert-id="' . $alert['id'] . '">
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon"><i class="fa fa-cogs  fa-fw"></i></div>
											<select class="form-control" name="action_party_id">';
			foreach ( $action_parties as $action_party ){
				$tbody.='<option value="' . $action_party['id'] . '" ' . ($action_party['id'] == $alert['action_party_id'] ? 'selected' : '') . ' >';
				$tbody.=$action_party['short_name'];
				$tbody.='</option>';
			}
			$tbody.='						</select>
										</div>
								</div>
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon"><i class="fa fa-hashtag fa-sm"></i></div>
										<input type="text" class="form-control" name="action_id" placeholder="#" maxchar="50" value="' . $alert['action_id'] . '">
										</div>
								</div>
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">Responsabilidad de Cliente</div>
											<span class="form-control">
												<input
													type="checkbox"
													id="alert-customer-flag-' . $alert['id'] . '"
													class="sr-only csi-ewa-template-control-center-alert-form-check"
													name="customer_flag" ' . (1 == $alert['customer_flag'] ? 'checked' : '') . '
												/>
												<label for="alert-customer-flag-' . $alert['id'] . '" >
													<i class="fa fa-lg fa-fw"></i>
												</label>
											</span>
										</div>
								</div>
								<button type="submit" class="btn btn-primary">
									' . ( $alert['action_id'] == '' ? '<i class="fa fa-send fa-fw"></i> Asignar' : 'Editar') . '
								</button>
							</form>
						</p>
					</td>
				</tr>
				
			';
		}
		//justgage
		$sql = '
				SELECT
					T00.alert_rating,
					T02.hex_color,
					T02.short_name,
					T02.id,
					COUNT(T00.alert_rating) as total,
					SUM(CASE WHEN T00.action_id IS NOT NULL THEN 1 else 0 end) as action
				FROM
					' . $NOVIS_CSI_EWA_ALERT->tbl_name . ' as T00
					LEFT JOIN ' . $this->tbl_name . ' as T01
						ON T01.ewa_session_no = T00.ewa_session_no
					LEFT JOIN ' . $NOVIS_CSI_EWA_ALERT_RATING->tbl_name . ' as T02
						ON T00.alert_rating = T02.alert_rating
				WHERE
					T01.planned_date BETWEEN "' . $monday . '" AND "' . $sunday . '"
				GROUP BY
					T00.alert_rating
		';
		$alerts				= $this->get_sql ( $sql );
		$graphs_container	= '';
		$graphs				= array();
		foreach ( $alerts as $alert ){
			$graph = array(
				'id'					=> 'csi-template-ewa-control-center-graph-' . $alert['id'],
				'label'					=> '%',
				'levelColorsGradient'	=> false,
				'max'					=> 100,
				'min'					=> 0,
				'levelColors'			=> array ( '#' . $alert['hex_color'], '#' . $alert['hex_color'] ),
				'customSectors'			=> array(
					'percents'			=> true,
					'ranges'			=> array(
						'color'			=> '#' . $alert['hex_color'],
						'lo'			=> 0,
						'hi'			=> 100,
						),
					),
				'refreshAnimationTime'	=> 1000,
				'refreshAnimationType'	=> "bounce",
				'shadowOpacity'			=> 0,
				'shadowSize'			=> 0,
				'shadowVerticalOffset'	=> 10,
				'title'					=> '',
				'startAnimationTime'	=> 500,
				'startAnimationType'	=> '>',
				'value'					=> intval ( $alert['action'] / $alert['total'] * 100 ),
			);
			array_push($graphs, $graph);
			$graphs_container .= '
				<div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 animated flipInX">
					<div id="csi-template-ewa-control-center-graph-' . $alert['id'] . '"></div>
					<p class="text-center text-muted"><small>Alertas <strong>' . $alert['short_name'] . '</strong> con acci&oacute;n (' . $alert['action'] . ' de ' . $alert['total'] . ')</small></p>
				</div>
			';
		}
	}else{
		$tbody.='<tr class="active"><td colspan="999"><p class="h3 text-muted text-center">No hay alertas en este per&iacute;odo con el filtro indicado.</p></td></tr>';
	}



	$response['date']				= '<i class="fa fa-calendar fa-fw"></i> Semana ' . $week . '<br/><small>' . $monday . ' - ' . $sunday . '</small>';
	$response['tbody']				= $tbody;
	$response['graphs']				= $graphs;
	$response['graphsContainer']	= $graphs_container;
	echo json_encode($response);
	wp_die();	
}

public function csi_ajax_template_ewa_mgmt_control_center_fetch_alerts(){
	//variables globales
	global $wpdb;
	global $NOVIS_CSI_CUSTOMER;
	global $NOVIS_CSI_CUSTOMER_SYSTEM;
	global $NOVIS_CSI_SAPCUSTNO;
	global $NOVIS_CSI_EWA_RATING;
	global $NOVIS_CSI_EWA_ALERT;
	global $NOVIS_CSI_EWA_ALERT_RATING;
	global $NOVIS_CSI_EWA_ALERT_ACTION_PARTY;
	//variables locales
	$page_size				= 20;
	$pagination				= '';
	$request				= $_REQUEST;
	$tbody					= '';
	$graphs_container		='';
	$graphs					= array();
	$response				= array();
	$now					= NULL;
	$alerts					= array();
	
	$page_no				= isset ( $request['page_no'] ) ? intval ( $request['page_no'] ) : 0 ;
	$count_sql = " SELECT COUNT(DISTINCT T00.ewa_session_no) as total ";
	$count_sql.= self::csi_ajax_template_ewa_mgmt_control_center_generate_base_sql ( $request, FALSE );
	$total_ewas = $wpdb->get_var ( $count_sql );
	$page_count = ceil ( $total_ewas / $page_size );
//	self::write_log ( $count_sql );
	
	$sql = self::csi_ajax_template_ewa_mgmt_control_center_generate_base_sql($request);
	$ewa_sql = $sql . '
			GROUP BY
				T00.ewa_session_no
			ORDER BY
				T00.planned_date, T03.code, T01.sid,T00.ewa_session_no
			LIMIT ' . $page_no * $page_size . ',' . $page_size . '
	';
	$ewas = $this->get_sql ( $ewa_sql );
	foreach ( $ewas as $ewa ){
		$tbody.='
			<tr>
				<td>' . $ewa['customer_short_name'] . ' <small class="text-muted">(' . $ewa['customer_code'] . ')</small></td>
				<td class="text-center">' . $ewa['ewa_planned_date'] . '</td>
				<td class="' . $ewa['ewa_class'] . '">
					<a href="#alerts_ewa_' . $ewa['ewa_session_no'] . '" data-toggle="collapse" title="Alarmas del EWA: ' . $ewa['ewa_session_no'] . '">
						<span class="text-' . $ewa['ewa_class'] . '" >
							<i class="fa fa-' . $ewa['ewa_icon'] . ' text-' . $ewa['ewa_class'] . '"></i> ' . $ewa['sid'] . '
						</span>
					</a>
				</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
		';
		if (
				( $_REQUEST['filter_alert_group'] != '' )
			||	( $_REQUEST['filter_alert_text'] != '' )
//			||	( isset ( $_GET['sid'] ) && $_GET['sid'] != '' ) 
//			||	( isset ( $_REQUEST['filter_ewa_rating'] ) && $_REQUEST['filter_ewa_rating'] != 0 ) 
//			||	( isset ( $_REQUEST['filter_alert_rating'] ) && $_REQUEST['filter_alert_rating'] != 0 ) 
//			||	( isset ( $_REQUEST['filter_action'] ) && $_REQUEST['filter_action'] != 0 ) 
//			||	( isset ( $_REQUEST['filter_customer_flag']) && $_REQUEST['filter_customer_flag'] != 0 ) 
			) {
			$display_alerts = 'in';
		}else{
			$display_alerts = '';
		}
		$tbody.='
			<tr class="collapse ' . $display_alerts . '" id="alerts_ewa_' . $ewa['ewa_session_no'] . '">
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td class="text-muted"><small>session number<br/>' . $ewa['ewa_session_no'] . '</small></td>
				<td colspan="3"><table class="table table-condensed table-hover">';
		$alert_sql = $sql . '
				AND T00.ewa_session_no = "' . $ewa['ewa_session_no'] . '"
		';
		$alerts = $this->get_sql ( $alert_sql );
		foreach ( $alerts as $alert ){
			if ( NULL != $alert['action_id'] ){
				$url=str_replace('[TICKET]', $alert['action_id'], $alert['url'] );
				$action_btn = '<a href="'. $url . '" class="btn btn-primary btn-sm">' . $alert['action_id'] . '</a>';
			}else{
				$action_btn='&nbsp;';
			}
			$tbody.='
					<tr>
						<td><code><small>' . $alert['alert_group'] . '</small></code></td>
						<td><small class=" text-' . $alert['alert_class'] . '"><i class="fa fa-' . $alert['alert_icon'] . '"></i> ' . $alert['alert_text'] . '</small></td>
						<td>' . $action_btn . '</td>
					</tr>
			';
		}
				
		$tbody.='
					</table>
				</td>
			</tr>
		';
	}
	$start_date		= self::csi_date_adjust( $request['filter_start_date'], 'monday' );
	$end_date		= self::csi_date_adjust( $request['filter_end_date'], 'sunday' );
	$response['panelTitleDates'] = '
	<div class="form-group">
		<div class="input-group">
			<div class="input-group-addon text-center">
				Semana ' . $start_date['week'] . ' <small class="text-muted">' . $start_date['year'] . '</small><br>
				<small class="text-muted">' . $start_date['datetime']->format('M, j') . '</small>
			</div>
			<div class="input-group-addon"><i class="fa fa-arrow-right"></i></div>
			<div class="input-group-addon text-center">
				Semana ' . $end_date['week'] . ' <small class="text-muted">' . $end_date['year'] . '</small><br>
				<small class="text-muted">' . $end_date['datetime']->format('M, j') . '</small>
			</div>
		</div>
	</div>
	';
	$response['panelTitleDates'].='<div class=""><small>Con los filtros seleccionados se han obtenido ' . $total_ewas . ' Reportes EWAs.</small></div>';
	$response['tbody'] = $tbody;

	$pagination.= '
	<nav aria-label="Page navigation">
		<ul class="pagination">
			<li class="' . ( ( $page_no <= 0 ) ? 'disabled' : '' ). '">
				<a href="#" aria-label="Previous" data-page-no="' . strval ( ( $page_no <= 0 ) ? 0 : intval ( $page_no - 1 ) ) . '">
					<span aria-hidden="true">&laquo;</span>
				</a>
			</li>
	';
		for ( $i = 0 ; $i < $page_count ; $i++ ){
			$pagination.= ' <li class="' . ( $i == $page_no ? 'active' : '' ). '"><a href="#" data-page-no="' . $i . '">' . strval ( intval ($i + 1 ) ) . '</a></li>';
		}
	$pagination.='
				<li class="' . ( ( $page_no + 1 >= $page_count) ? 'disabled' : '' ) . '">
					<a href="#" aria-label="Next" data-page-no="' . ( strval ( $page_no + 1 >= $page_count ) ? $page_count-1 : intval ( $page_no + 1 ) ). '">
					<span aria-hidden="true">&raquo;</span>
				</a>
			</li>
		</ul>
	</nav>';
	$response['pagination'] = $pagination;
	echo json_encode($response);
	wp_die();
}

protected function csi_date_adjust ( $date = NULL, $day_flag = 0 ){
	if ( NULL !== $date ) {
		$timestamp = strtotime ( $date );
		if ( FALSE == $timestamp ){
			$date = NULL;
		}else{
			$date = new DateTime ( date ( 'Y-m-d', $timestamp ) );
		}
	}
	if ( NULL == $date ) {
		$date = new DateTime();
	}
	$week				= $date->format("W");
	$year				= $date->format("Y");
	switch ($day_flag){
		case 'monday':
			$date = new DateTime();
			$date->setISODate ( $year, $week );
			break;
		case 'sunday':
			$date = new DateTime();
			$date->setISODate ( $year, $week, 7 );
			break;
		default:
	}	
	return array(
		'date'		=> $date->format('Y-m-d'),
		'datetime'	=> $date,
		'week'		=> $week,
		'year'		=> $year,
	);
}

/**
* csi_ajax_template_ewa_mgmt_control_center_alert_chart
*
* Number of alerts per status in period
*/
public function csi_ajax_template_ewa_mgmt_control_center_alert_chart(){
	ini_set('memory_limit', '-1');
	//variables globales
	global $wpdb;
	global $NOVIS_CSI_CUSTOMER;
	global $NOVIS_CSI_CUSTOMER_SYSTEM;
	global $NOVIS_CSI_SAPCUSTNO;
	global $NOVIS_CSI_EWA_RATING;
	global $NOVIS_CSI_EWA_ALERT;
	global $NOVIS_CSI_EWA_ALERT_RATING;
	global $NOVIS_CSI_EWA_ALERT_ACTION_PARTY;
	//variables localse
	$graphs					= array();
	$dataProvider			= array();
	$response				= array();

	$sql = self::csi_ajax_template_ewa_mgmt_control_center_generate_base_sql($_REQUEST);
	$sql.='
		ORDER BY
			T00.planned_date ASC
	';
	$alerts = $this->get_sql ( $sql );
	self::write_log ( $sql );
	foreach ( $alerts as $alert ){
		$alert['ewa_planned_date']		= self::findMonday($alert['ewa_planned_date'])->format('Y-m-d');
		$index = array_search( $alert['ewa_planned_date'], array_column( $dataProvider, 'date' ) );
		if (FALSE === $index ){
			$reg = array(
				'date'					=> $alert['ewa_planned_date'],
				$alert['alert_rating']	=> 1,
			);
			array_push($dataProvider, $reg);
		}else{
			if ( ! isset ( $dataProvider[$index][$alert['alert_rating']] ) ) {
				$dataProvider[$index][$alert['alert_rating']] =1;
			}else{
				$dataProvider[$index][$alert['alert_rating']] +=1;
			}
		}
		$index = array_search( $alert['alert_rating'], array_column( $graphs, 'valueField' ) );
		if (FALSE === $index ){
			$graph = array(
				'balloonText'				=> "[[title]]: [[value]]",
				'bullet'					=> "round",
				'bulletSize'				=> 6,
				'bulletAlpha'				=> 0.4,
				'bulletBorderAlpha'			=> 0.25,
				'bulletBorderColor'			=> '#000000',
				'bulletBorderThickness'		=> 1,
				'fillAlphas'				=> 0.1,
				'lineAlpha'					=> 1,
				'title'						=> $alert['alert_short_name'],
				'type'						=> "smoothedLine",
				'fillColors'				=> array('#'.$alert['hex_color'],'rgba(255,255,255,0)'),
				'lineColor'					=> '#'.$alert['hex_color'],
				'valueField'				=> $alert['alert_rating'],
			);
			array_push($graphs, $graph);
		}
		
	}
	$o='';
	$valueAxes = array(
		array(
//		'stackType'						=> 'regular',
		'integersOnly'					=> true,
		),
	);
	$chart_cursor = array(
		'categoryBalloonDateFormat'		=> "YYYY-MM-DD",
		'cursorAlpha'					=> 0,
		'valueLineEnabled'				=> false,
		'valueLineBalloonEnabled'		=> false,
		'valueLineAlpha'				=> 0.5,
		'fullWidth'						=> true,
	);
	$category_axis	= array(
		'minPeriod'						=> 'WW',
		'parseDates'					=> true,
		'minorGridAlpha'				=> 0.1,
//		'minorGridEnabled'				=> true,
	);
	$legend = array(
		'enabled'						=> true,
		'align'							=> 'center',
//		'useMarkerColorForValues'		=> true,
//		'useMarkerColorForLabels'		=> true,
		'periodValueText'				=> '[[value.sum]]',
//		'divId'							=> 'csi-template-ewa-mgmt-control-center-infographics-alert-legend',
	);
	$title = array(
		array(
				'text'							=> 'Distribución de alertas',
				'bold'							=> false
		),
	);
	$chart = array(
		'type'							=> 'serial',
		'dataProvider'					=> $dataProvider,
		'graphs'						=> $graphs,
		'dataDateFormat'				=> 'YYYY-MM-DD',
		'categoryField'					=> 'date',
		'categoryAxis'					=> $category_axis,
		'valueAxes'						=> $valueAxes,
		'chartCursor'					=> $chart_cursor,
		'legend'						=> $legend,
//		'titles'						=> $title,
	);
	$response['chart']			= $chart;
	$response['dataProvider']	= $dataProvider;
	$response['graphs']			= $graphs;
	echo json_encode($response);
	wp_die();
}

public function csi_ajax_template_ewa_mgmt_control_center_action_gauge(){
	//variables locales
	$charts_container	= '';
	$charts				= array();
	//justgage
	$sql = '
			SELECT
				T05.alert_rating,
				T06.hex_color,
				T06.short_name,
				T06.id,
				COUNT(T05.alert_rating) as total,
				SUM(CASE WHEN T05.action_id IS NOT NULL THEN 1 else 0 end) as action
			';
	$sql.= self::csi_ajax_template_ewa_mgmt_control_center_generate_base_sql($_REQUEST, FALSE );
	$sql.='
			GROUP BY
				T05.alert_rating
			ORDER BY
				T00.planned_date
	';
	$alerts				= $this->get_sql ( $sql );
	foreach ( $alerts as $alert ){
		if ($alert['total'] != 0 ){
			$bands = array(
				array(
					'color'					=> '#' . $alert['hex_color'],
					'endValue'				=> intval ( $alert['action'] / $alert['total'] * 100 ),
					'startValue'			=> 0,
				),
				array(
					'color'					=> '#CCC',
					'endValue'				=> 100,
					'startValue'			=> intval ( $alert['action'] / $alert['total'] * 100 ),
				),
			);
			$arrows = array(
				array(
					'value'		=> intval ( $alert['action'] / $alert['total'] * 100 ),
				),
			);
			$axes = array(
				array(
					'bands'				=> $bands,			
					'bottomText'		=> intval ( $alert['action'] / $alert['total'] * 100 ) .'% con acción',
					'endValue'			=> 100,
					'axisThickness'		=> 1,
					'axisAlpha'			=> 0.2,
					'tickAlpha'			=> 0.2,
					'endAngle'			=> 90,
					'startAngle'		=> -90,
					'bottomTextYOffset'	=> -20,
				),
			);
			$chart = array(
				'type'		=> 'gauge',
				'arrows'	=> $arrows,
				'axes'		=> $axes,
				'divId'		=> 'csi-template-ewa-mgmt-control-center-action-gauge-' . $alert['id'],
			);
			array_push($charts, $chart);
			$charts_container .= '
				<div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 animated flipInX">
					<div id="csi-template-ewa-mgmt-control-center-action-gauge-' . $alert['id'] . '" style="height:150px;"></div>
					<p class="text-center text-muted"><small>Alertas <strong>' . $alert['short_name'] . '</strong> (' . $alert['action'] . ' de ' . $alert['total'] . ')</small></p>
				</div>
			';
		}
	}
	$response['charts']				= $charts;
	$response['chartsContainer']	= $charts_container;
	echo json_encode($response);
	wp_die();	
}

protected function csi_ajax_template_ewa_mgmt_control_center_generate_base_sql($request = array(), $select = TRUE ){
	//variables globales
	global $wpdb;
	global $NOVIS_CSI_CUSTOMER;
	global $NOVIS_CSI_CUSTOMER_SYSTEM;
	global $NOVIS_CSI_SAPCUSTNO;
	global $NOVIS_CSI_EWA_RATING;
	global $NOVIS_CSI_EWA_ALERT;
	global $NOVIS_CSI_EWA_ALERT_RATING;
	global $NOVIS_CSI_EWA_ALERT_ACTION_PARTY;
	//variables locales
	$sql					= '';
	$environment			= array(1);
	//parámetros de función
	$filter_start_date		= self::csi_date_adjust( $request['filter_start_date'], 'monday' );
	$filter_end_date		= self::csi_date_adjust( $request['filter_end_date'], 'sunday' );
	$filter_customer		= isset ( $request['filter_customer'] )			&& '' != $request['filter_customer']		? $request['filter_customer']		: FALSE ;
	$filter_sid				= isset ( $request['filter_sid'] )				&& '' != $request['filter_sid']				? $request['filter_sid']			: FALSE ;
	$filter_ewa_rating		= isset ( $request['filter_ewa_rating'] )		&&  0 != $request['filter_ewa_rating']		? $request['filter_ewa_rating']		: FALSE ;
	$filter_alert_group		= isset ( $request['filter_alert_group'] )		&& '' != $request['filter_alert_group']		? $request['filter_alert_group']	: FALSE ;
	$filter_alert_text		= isset ( $request['filter_alert_text'] )		&& '' != $request['filter_alert_text']		? $request['filter_alert_text']		: FALSE ;
	$filter_alert_rating	= isset ( $request['filter_alert_rating'] )		&&  0 != $request['filter_alert_rating']	? $request['filter_alert_rating']	: FALSE ;
	$filter_action			= isset ( $request['filter_action'] )			&&  0 != $request['filter_action']			? $request['filter_action']			: FALSE ;
	$filter_customer_flag	= isset ( $request['filter_customer_flag'] )	&&  0 != $request['filter_customer_flag']	? $request['filter_customer_flag']	: FALSE ;
	
	if ( TRUE == $select ){
		$sql.= '
			SELECT
				T03.code as customer_code,
				T03.short_name as customer_short_name,
				T04.icon as ewa_icon,
				T04.css_class as ewa_class,
				T01.sid as sid,
				T00.planned_date as ewa_planned_date,
				T00.ewa_session_no as ewa_session_no,
				T04.icon as ewa_icon,
				T04.short_name as ewa_short_name,
				T04.css_class as ewa_class,
				T04.hex_color as ewa_hex_color,
				T04.ewa_rating as ewa_rating,
				T05.alert_group as alert_group,
				T05.alert_rating as alert_rating,
				T05.alert_text as alert_text,
				T05.action_id as action_id,
				T06.icon as alert_icon,
				T06.short_name as alert_short_name,
				T06.css_class as alert_class,
				T06.hex_color as hex_color,
				T07.url as url
		';
	}
	$sql.='
			FROM
				' . $this->tbl_name . ' as T00
				LEFT JOIN ' . $NOVIS_CSI_CUSTOMER_SYSTEM->tbl_name . ' as T01
					ON T00.system_no = T01.system_no
				LEFT JOIN ' . $NOVIS_CSI_SAPCUSTNO->tbl_name . ' as T02
					ON T01.sapcustno = T02.sapcustno
				LEFT JOIN ' . $NOVIS_CSI_CUSTOMER->tbl_name . ' as T03
					ON T02.customer_id = T03.id
				LEFT JOIN ' . $NOVIS_CSI_EWA_RATING->tbl_name . ' as T04
					ON T04.ewa_rating = T00.ewa_rating
				LEFT JOIN ' . $NOVIS_CSI_EWA_ALERT->tbl_name . ' as T05
					ON T00.ewa_session_no = T05.ewa_session_no
				LEFT JOIN ' . $NOVIS_CSI_EWA_ALERT_RATING->tbl_name . ' as T06
					ON T06.alert_rating = T05.alert_rating
				LEFT JOIN ' . $NOVIS_CSI_EWA_ALERT_ACTION_PARTY->tbl_name . ' as T07
					ON T05.action_party_id = T07.id
			WHERE
				T00.planned_date BETWEEN "' . $filter_start_date['date'] . '" AND "' . $filter_end_date['date'] . '"
				AND T01.environment_id IN (' . implode ( ',', $environment ) .')
	';
	if ( FALSE != $filter_customer ){
		$sql.=' AND ( UPPER(T03.code) LIKE "%' . strtoupper($filter_customer) . '%" OR UPPER(T03.short_name) LIKE "%' . strtoupper($filter_customer) . '%" ) ';
	}
	if ( FALSE != $filter_sid ){
		$sql.=' AND UPPER(T01.sid) LIKE "%' . strtoupper($filter_sid) . '%" ';
	}
	if ( FALSE != $filter_ewa_rating ){
		$sql.=' AND T04.id = "' . intval($filter_ewa_rating) . '" ';
	}
	if ( FALSE != $filter_alert_group ){
		$sql.=' AND UPPER(T05.alert_group) LIKE "%' . strtoupper($filter_alert_group) . '%" ';
	}
	if ( FALSE != $filter_alert_text ){
		$sql.=' AND UPPER(T05.alert_text) LIKE "%' . strtoupper($filter_alert_text) . '%" ';
	}
	if ( FALSE != $filter_alert_rating ){
		$sql.=' AND T06.id = "' . intval($filter_alert_rating) . '" ';
	}
	switch ($filter_action){
		case 2: //Con acción
			$sql.= ' AND T05.action_id IS NOT NULL ';
			break;
		case 3: //Sin acción
			$sql.= ' AND T05.action_id IS NULL ';
			break;
		default:
	}
	switch ($filter_customer_flag){
		case 2: //Con acción
			$sql.= ' AND T05.customer_flag = "1" ';
			break;
		case 3: //Sin acción
			$sql.= ' AND T05.customer_flag != "1" ';
			break;
		default:
	}
	return $sql;	
}

public function csi_ajax_template_ewa_mgmt_control_center_ewa_status_chart(){
	//variables globales
	global $wpdb;
	global $NOVIS_CSI_CUSTOMER;
	global $NOVIS_CSI_CUSTOMER_SYSTEM;
	global $NOVIS_CSI_SAPCUSTNO;
	global $NOVIS_CSI_EWA_RATING;
	global $NOVIS_CSI_EWA_ALERT;
	global $NOVIS_CSI_EWA_ALERT_RATING;
	global $NOVIS_CSI_EWA_ALERT_ACTION_PARTY;
	//variables localse
	$graphs					= array();
	$dataProvider			= array();
	$response				= array();

	$sql = self::csi_ajax_template_ewa_mgmt_control_center_generate_base_sql($_REQUEST);
	$sql.='
		GROUP BY
			T00.ewa_session_no
		ORDER BY
			T00.planned_date ASC
	';
	$ewas = $this->get_sql ( $sql );
	foreach ( $ewas as $ewa ){
		$ewa['ewa_planned_date']		= self::findMonday($ewa['ewa_planned_date'])->format('Y-m-d');
		$graph = array(
			'balloonText'				=> "[[title]]: [[value]]",
			'fillAlphas'				=> 0.8,
			'lineAlpha'					=> 0,
			'title'						=> $ewa['ewa_short_name'],
			'type'						=> "column",
			'fillColors'				=> '#'.$ewa['ewa_hex_color'],
			'lineColor'					=> '#'.$ewa['ewa_hex_color'],
			'valueField'				=> $ewa['ewa_rating'],
		);
//		$ewa['ewa_planned_date']		= self::findMonday($ewa['ewa_planned_date']);
		$reg = array(
			'date'					=> $ewa['ewa_planned_date'],
			$ewa['ewa_rating']	=> 1,
		);
		$index = array_search( $ewa['ewa_planned_date'], array_column( $dataProvider, 'date' ) );
		if (FALSE === $index ){
			array_push($dataProvider, $reg);
		}else{
			if ( ! isset ( $dataProvider[$index][$ewa['ewa_rating']] ) ) {
				$dataProvider[$index][$ewa['ewa_rating']] =1;
//				array_push($dataProvider[$index], array ( $ewa['ewa_rating'] , 1 ) );
			}else{
				$dataProvider[$index][$ewa['ewa_rating']] +=1;
			}
		}
		$index = array_search( $ewa['ewa_rating'], array_column( $graphs, 'valueField' ) );
		if (FALSE === $index ){
			array_push($graphs, $graph);
		}
		
	}
	$o='';
	$valueAxes = array(
		array(
		'stackType'						=> 'regular',
		'integersOnly'					=> true,
		),
	);
	$chart_cursor = array(
		'categoryBalloonDateFormat'		=> "YYYY-MM-DD",
		'cursorAlpha'					=> 0,
		'valueLineEnabled'				=> false,
		'valueLineBalloonEnabled'		=> false,
		'valueLineAlpha'				=> 0.5,
		'fullWidth'						=> true,
	);
	$category_axis	= array(
		'parseDates'					=> true,
		'minPeriod'						=> 'WW',
		'minorGridAlpha'				=> 0.1,
	);
	$chart = array(
		'type'				=> 'serial',
		'dataProvider'		=> $dataProvider,
		'graphs'			=> $graphs,
		'dataDateFormat'	=> 'YYYY-MM-DD',
		'categoryField'		=> 'date',
		'categoryAxis'		=> $category_axis,
		'chartCursor'		=> $chart_cursor,
		'valueAxes'			=> $valueAxes,
	);
	$response['chart']			= $chart;
	$response['dataProvider']	= $dataProvider;
	$response['graphs']			= $graphs;
	echo json_encode($response);
	wp_die();
}

public function csi_ajax_template_ewa_mgmt_control_center_alert_pies(){
	//variables locales
	$charts_container	= '';
	$charts				= array();
	$dataProvider		= array();
	//justgage
	$sql = '
			SELECT
				COUNT(DISTINCT T05.id) as count_alert_group,
				T05.alert_group as alert_group
			';
	$sql.= self::csi_ajax_template_ewa_mgmt_control_center_generate_base_sql($_REQUEST, FALSE );
	$sql.='
			GROUP BY
				T05.alert_group
			ORDER BY
				T05.alert_group
	';
	$alert_groups		= $this->get_sql ( $sql );
	foreach ( $alert_groups as $alert_group ){
		$reg = array(
			'alert_group'			=> $alert_group['alert_group'],
			'count_alert_group'		=> $alert_group['count_alert_group'],
			
		);
		array_push($dataProvider, $reg);
	}
	$balloon = array(
		'fixedPosition'	=> true,
	);
	$chart_alert_group = array(
		'type'			=> 'pie',
		'dataProvider'	=> $dataProvider,
		'valueField'	=> 'count_alert_group',
		'titleField'	=> 'alert_group',
		'balloon'		=> $balloon,
		'divId'			=> 'csi-template-ewa-mgmt-control-center-alert-pies-alert-group',
		'labelText'		=> '',
	);
	array_push($charts, $chart_alert_group);
	$sql = '
			SELECT
				COUNT(DISTINCT T05.id) as count_alert_text,
				T05.alert_text as alert_text
			';
	$sql.= self::csi_ajax_template_ewa_mgmt_control_center_generate_base_sql($_REQUEST, FALSE );
	$sql.='
			GROUP BY
				T05.alert_text
			ORDER BY
				T05.alert_text
	';
	$alert_texts		= $this->get_sql ( $sql );
	foreach ( $alert_texts as $alert_text ){
		$reg = array(
			'alert_text'			=> $alert_text['alert_text'],
			'count_alert_text'		=> $alert_text['count_alert_text'],
			
		);
		array_push($dataProvider, $reg);
	}
	$chart_alert_text = array(
		'type'			=> 'pie',
		'theme'			=> 'light',
		'dataProvider'	=> $dataProvider,
		'valueField'	=> 'count_alert_text',
		'titleField'	=> 'alert_text',
		'balloon'		=> $balloon,
		'divId'			=> 'csi-template-ewa-mgmt-control-center-alert-pies-alert-text',
		'labelText'		=> '',
	);
	array_push($charts, $chart_alert_text);
	$charts_container	= '
				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 animated flipInX">
					<div id="csi-template-ewa-mgmt-control-center-alert-pies-alert-group" style="height:250px;"></div>
					<p class="text-center text-muted">Grupo de Alerta</p>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 animated flipInX">
					<div id="csi-template-ewa-mgmt-control-center-alert-pies-alert-text" style="height:250px;"></div>
					<p class="text-center text-muted">Texto de Alerta</p>
				</div>
	';
	$response['charts']				= $charts;
	$response['chartsContainer']	= $charts_container;
	echo json_encode($response);
	wp_die();	
}

public function csi_ajax_template_ewa_mgmt_control_center_customer_ewas(){
	ini_set('memory_limit', '-1');
	//variables globales
	global $wpdb;
	global $NOVIS_CSI_CUSTOMER;
	global $NOVIS_CSI_CUSTOMER_SYSTEM;
	global $NOVIS_CSI_SAPCUSTNO;
	global $NOVIS_CSI_EWA_RATING;
	global $NOVIS_CSI_EWA_ALERT;
	global $NOVIS_CSI_EWA_ALERT_RATING;
	global $NOVIS_CSI_EWA_ALERT_ACTION_PARTY;
	//variables localse
	$graphs					= array();
	$dataProvider			= array();
	$response				= array();

	$sql = self::csi_ajax_template_ewa_mgmt_control_center_generate_base_sql($_REQUEST);
	$sql.='
		GROUP BY
			T00.ewa_session_no
		ORDER BY
			T03.code ASC
	';
	$ewas = $this->get_sql ( $sql );
	foreach ( $ewas as $ewa ){
		$ewa['ewa_planned_date']		= self::findMonday($ewa['ewa_planned_date'])->format('Y-m-d');
		$graph = array(
			'balloonText'				=> "[[title]]: [[value]]",
			'fillAlphas'				=> 0.8,
			'lineAlpha'					=> 0,
			'title'						=> $ewa['ewa_short_name'],
			'type'						=> "column",
			'fillColors'				=> '#'.$ewa['ewa_hex_color'],
			'lineColor'					=> '#'.$ewa['ewa_hex_color'],
			'valueField'				=> $ewa['ewa_rating'],
		);
//		$ewa['ewa_planned_date']		= self::findMonday($ewa['ewa_planned_date']);
		$reg = array(
			'code'					=> $ewa['customer_code'],
			$ewa['ewa_rating']	=> 1,
		);
		$index = array_search( $ewa['customer_code'], array_column( $dataProvider, 'code' ) );
		if (FALSE === $index ){
			array_push($dataProvider, $reg);
		}else{
			if ( ! isset ( $dataProvider[$index][$ewa['ewa_rating']] ) ) {
				$dataProvider[$index][$ewa['ewa_rating']] =1;
//				array_push($dataProvider[$index], array ( $ewa['ewa_rating'] , 1 ) );
			}else{
				$dataProvider[$index][$ewa['ewa_rating']] +=1;
			}
		}
		$index = array_search( $ewa['ewa_rating'], array_column( $graphs, 'valueField' ) );
		if (FALSE === $index ){
			array_push($graphs, $graph);
		}
		
	}
	$o='';
	$balloon = array(
		
	);
	$valueAxes = array(
		array(
		'stackType'						=> 'regular',
		'integersOnly'					=> true,
		),
	);
	$chart_cursor = array(
//		'categoryBalloonDateFormat'		=> "YYYY-MM-DD",
		'cursorAlpha'					=> 0,
		'valueLineEnabled'				=> false,
		'valueLineBalloonEnabled'		=> false,
		'valueLineAlpha'				=> 0.5,
		'fullWidth'						=> true,
	);
	$category_axis	= array(
//		'parseDates'					=> true,
//		'minPeriod'						=> 'WW',
		'minorGridAlpha'				=> 0.1,
	);
	$chart = array(
		'type'				=> 'serial',
		'dataProvider'		=> $dataProvider,
		'graphs'			=> $graphs,
//		'dataDateFormat'	=> 'YYYY-MM-DD',
		'categoryField'		=> 'code',
		'categoryAxis'		=> $category_axis,
		'chartCursor'		=> $chart_cursor,
		'valueAxes'			=> $valueAxes,
		'balloon'			=> $balloon,
	);
	$response['chart']			= $chart;
	$response['dataProvider']	= $dataProvider;
	$response['graphs']			= $graphs;
	echo json_encode($response);
	wp_die();
}

public function csi_ajax_template_ewa_mgmt_control_center_customer_alerts(){
	ini_set('memory_limit', '-1');
	//variables globales
	global $wpdb;
	global $NOVIS_CSI_CUSTOMER;
	global $NOVIS_CSI_CUSTOMER_SYSTEM;
	global $NOVIS_CSI_SAPCUSTNO;
	global $NOVIS_CSI_EWA_RATING;
	global $NOVIS_CSI_EWA_ALERT;
	global $NOVIS_CSI_EWA_ALERT_RATING;
	global $NOVIS_CSI_EWA_ALERT_ACTION_PARTY;
	//variables localse
	$graphs					= array();
	$dataProvider			= array();
	$response				= array();

	$sql = self::csi_ajax_template_ewa_mgmt_control_center_generate_base_sql($_REQUEST);
	$sql.='
		GROUP BY
			T05.id
		ORDER BY
			T03.code ASC
	';
	$alerts = $this->get_sql ( $sql );
	foreach ( $alerts as $alert ){
//		$alert['alert_planned_date']		= self::findMonday($alert['alert_planned_date'])->format('Y-m-d');
		$graph = array(
			'balloonText'				=> "[[title]]: [[value]]",
			'fillAlphas'				=> 0.8,
			'lineAlpha'					=> 0,
			'title'						=> $alert['alert_short_name'],
			'type'						=> "column",
			'fillColors'				=> '#'.$alert['hex_color'],
			'lineColor'					=> '#'.$alert['hex_color'],
			'valueField'				=> $alert['alert_rating'],
		);
//		$alert['alert_planned_date']		= self::findMonday($alert['alert_planned_date']);
		$reg = array(
			'code'					=> $alert['customer_code'],
			$alert['alert_rating']	=> 1,
		);
		$index = array_search( $alert['customer_code'], array_column( $dataProvider, 'code' ) );
		if (FALSE === $index ){
			array_push($dataProvider, $reg);
		}else{
			if ( ! isset ( $dataProvider[$index][$alert['alert_rating']] ) ) {
				$dataProvider[$index][$alert['alert_rating']] =1;
//				array_push($dataProvider[$index], array ( $alert['alert_rating'] , 1 ) );
			}else{
				$dataProvider[$index][$alert['alert_rating']] +=1;
			}
		}
		$index = array_search( $alert['alert_rating'], array_column( $graphs, 'valueField' ) );
		if (FALSE === $index ){
			array_push($graphs, $graph);
		}
		
	}
	$o='';
	$valueAxes = array(
		array(
		'stackType'						=> 'regular',
		'integersOnly'					=> true,
		),
	);
	$chart_cursor = array(
//		'categoryBalloonDateFormat'		=> "YYYY-MM-DD",
		'cursorAlpha'					=> 0,
		'valueLineEnabled'				=> false,
		'valueLineBalloonEnabled'		=> false,
		'valueLineAlpha'				=> 0.5,
		'fullWidth'						=> true,
	);
	$category_axis	= array(
//		'parseDates'					=> true,
//		'minPeriod'						=> 'WW',
		'minorGridAlpha'				=> 0.1,
	);
	$chart = array(
		'type'				=> 'serial',
		'dataProvider'		=> $dataProvider,
		'graphs'			=> $graphs,
//		'dataDateFormat'	=> 'YYYY-MM-DD',
		'categoryField'		=> 'code',
		'categoryAxis'		=> $category_axis,
		'chartCursor'		=> $chart_cursor,
		'valueAxes'			=> $valueAxes,
	);
	$response['chart']			= $chart;
	$response['dataProvider']	= $dataProvider;
	$response['graphs']			= $graphs;
	echo json_encode($response);
	wp_die();
}


//END OF CLASS	
}


global $NOVIS_CSI_EWA;
$NOVIS_CSI_EWA =new NOVIS_CSI_EWA_CLASS();
?>