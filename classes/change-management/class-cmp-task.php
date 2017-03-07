<?php
defined('ABSPATH') or die("No script kiddies please!");

class NOVIS_CSI_CMP_TASK_CLASS extends NOVIS_CSI_CLASS{

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
	$this->class_name	= 'cmp_task';
	//Nombre singular para títulos, mensajes a usuario, etc.
	$this->name_single	= 'Tarea';
	//Nombre plural para títulos, mensajes a usuario, etc.
	$this->name_plural	= 'Tareas';
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
	$this->db_version	= '0.0.5';
	//Reglas actuales de caracteres a nivel de DB.
	//Dado que esto sólo se usa en la cración de la tabla
	//no se guarda como variable de clase.
	$charset_collate	= $wpdb->get_charset_collate();
	//Sentencia SQL de creación (y ajuste) de la tabla de la clase
	$this->crt_tbl_sql_wt	="
		(
			id int(10) unsigned not null auto_increment COMMENT 'Unique ID for each entry',
			cmp_id mediumint(8) unsigned not null COMMENT 'Plan ID',
			customer_system_id int(10) unsigned not null COMMENT 'Customer System ID',
			task_type_id tinyint(2) unsigned not null COMMENT 'Task Type ID',
			service_id mediumint(8) unsigned null COMMENT 'Service ID',
			offline_task_flag tinyint(1) null COMMENT 'Indicate if task implies offline downtime window',
			change_flag tinyint(1) null COMMENT 'Indicates if activity involves a change',
			change_urgent_flag tinyint(1) null COMMENT 'Indicates if activity involves an urgent change',
			change_requester_user_id bigint(20) unsigned null COMMENT 'User id of change request',
			change_requester_user_email varchar(100) null COMMENT 'Email of user. Used to track user if user id is deleted',
			change_text tinytext null COMMENT 'Change description',
			zoom_conf_id varchar(9) null COMMENT 'Zoom conference id',
			customer_visible_flag tinyint(1) null COMMENT 'Indicates if task is shown in customer calendar',
			comments varchar(255) null COMMENT 'Additional comments',
			status_id tinyint(2) unsigned not null COMMENT 'Status ID',
			ticket_no varchar(20) null COMMENT 'Ticket Number',
			start_datetime datetime not null COMMENT 'Start datetime of task',
			end_datetime datetime not null COMMENT 'End datetime of task',
			creation_user_id bigint(20) unsigned null COMMENT 'Id of user responsible of the creation of this record',
			creation_user_email varchar(100) null COMMENT 'Email of user. Used to track user if user id is deleted',
			creation_date date null COMMENT 'Date of the creation of this record',
			creation_time time null COMMENT 'Time of the creation of this record',
			last_modified_user_id bigint(20) unsigned null COMMENT 'Id of user responsible of the last modification of this record',
			last_modified_user_email varchar(100) null COMMENT 'Email of user. Used to track user if user id is deleted',
			last_modified_date date null COMMENT 'Date of the last modification of this record',
			last_modified_time time null COMMENT 'Time of the last modification of this record',

		UNIQUE KEY id (id)
		) $charset_collate;";
	//Sentencia SQL de creación (y ajuste) de la tabla de la clase
	$this->crt_tbl_sql	=	"CREATE TABLE ".$this->tbl_name." ".$this->crt_tbl_sql_wt;
	$this->db_fields	= array(
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
		'cmp_id' => array(
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
		'customer_system_id' => array(
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
		'task_type_id' => array(
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
		'service_id' => array(
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
		'offline_task_flag' => array(
			'type'						=>'bool',
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
		'customer_visible_flag' => array(
			'type'						=>'bool',
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
		'comments' => array(
			'type'						=>'text',
			'backend_wp_in_table'		=>false,
			'backend_wp_sp_table'		=>false,
			'backend_wp_table_lead'		=>false,
			'data_required'				=>true,
			'data_validation'			=>true,
			'data_validation_min'		=>false,
			'data_validation_max'		=>false,
			'data_validation_maxchar'	=>255,
			'form_disabled'				=>false,
			'form_help_text'			=>false,
			'form_input_size'			=>false,
			'form_label'				=>false,
			'form_options'				=>false,
			'form_placeholder'			=>false,
			'form_special_form'			=>false,
			'form_show_field'			=>false,
		),
		'status_id' => array(
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
		'ticket_no' => array(
			'type'						=>'text',
			'backend_wp_in_table'		=>false,
			'backend_wp_sp_table'		=>false,
			'backend_wp_table_lead'		=>false,
			'data_required'				=>false,
			'data_validation'			=>true,
			'data_validation_min'		=>false,
			'data_validation_max'		=>false,
			'data_validation_maxchar'	=>20,
			'form_disabled'				=>false,
			'form_help_text'			=>false,
			'form_input_size'			=>false,
			'form_label'				=>false,
			'form_options'				=>false,
			'form_placeholder'			=>false,
			'form_special_form'			=>false,
			'form_show_field'			=>false,
		),
		'start_datetime' => array(
			'type'						=>'datetime',
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
		'end_datetime' => array(
			'type'						=>'datetime',
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
	register_activation_hook(CSI_PLUGIN_DIR."/index.php",		array( $this , 'db_install'					));
	//in a new blog creation, create the db for new blog
	//Applies only for non-network classes
	if( true != $this->network_class ){
		add_action( 'wpmu_new_blog',							array( $this , 'db_install'					));
	}
	if ( !is_multisite() ) {
		add_action( 'admin_menu',		 						array( $this , "register_submenu_page"		));
	}else{
		add_action( 'network_admin_menu', 						array( $this , "register_submenu_page"		));
	}
	add_action( 'wp_ajax_csi_cmp_build_page_new_task_form',		array( $this , 'csi_cmp_build_page_new_task_form'	));
	add_action( 'wp_ajax_csi_cmp_create_cmp_task',				array( $this , 'csi_cmp_create_cmp_task'			));
	add_action( 'wp_ajax_csi_cmp_fetch_tasks_table',			array( $this , 'csi_cmp_fetch_tasks_table'			));
	add_action( 'wp_ajax_csi_cmp_build_page_show_task',			array( $this , 'csi_cmp_build_page_show_task'		));
	add_action( 'wp_ajax_csi_cmp_fetch_task_step_list_info',	array( $this , 'csi_cmp_fetch_task_step_list_info'	));
	add_action( 'wp_ajax_csi_cmp_fetch_task_in_table_info',		array( $this , 'csi_cmp_fetch_task_in_table_info'	));
	add_action( 'wp_ajax_csi_cmp_build_page_edit_task_form',	array( $this , 'csi_cmp_build_page_edit_task_form'	));
	add_action( 'wp_ajax_csi_cmp_edit_cmp_task',				array( $this , 'csi_cmp_edit_cmp_task'	));


}
public function csi_cmp_popup_task_info(){
	//Global Variables
	global $NOVIS_CSI_CUSTOMER;
	//Local Variables
	$response			= array();
	$o = '';

	$sql = 'SELECT * FROM ' . $this->tbl_name . ' ';
	$task_types = $this->get_sql($sql);
	$o.='<table class="table table-condensed">';
	$o.='
	<tr>
		<th class="col-xs-3">' . $this->name_plural . '</th>
		<th>Descripci&oacute;n</th>
	</tr>
	';
	foreach ( $task_types as $task_type ){
		$o.='
		<tr>
			<td class="col-xs-3"><code><i class="fa fa-' . $task_type['icon'] . ' hidden-xs"></i> ' . $task_type['short_name'] . '</code></td>
			<td><p class="text-justify">' . $task_type['description'] . '</p></td>
		</tr>
		';
	}
	$o.='</table>';
	$response['notification']=array(
		'buttons'			=> array(
			'OK'			=> array(
				'text'		=> '<small> Gracias por la informaci&oacute;n</small> <i class="fa fa-thumbs-up"></i>',
				'btnClass'	=> 'btn-info',
			),
		),
		'backgroundDismiss' =>true,
		'icon'				=> 'fa fa-info text-info',
		'columnClass'		=> 'large',
		'content'			=> $o,
		'title'				=> $this->name_plural,
		'type'				=> 'blue',
	);

	echo json_encode($response);
	wp_die();
}
public function csi_cmp_build_page_new_task_form(){
	//Global Variables
	global $NOVIS_CSI_CUSTOMER;
	global $NOVIS_CSI_CUSTOMER_SYSTEM_ENVIRONMENT;
	global $NOVIS_CSI_CUSTOMER_SYSTEM;
	global $NOVIS_CSI_SAPCUSTNO;
	global $NOVIS_CSI_CMP;
	global $NOVIS_CSI_CMP_TASK_TYPE;
	global $NOVIS_CSI_CMP_TASK_STATUS;
	global $NOVIS_CSI_SERVICE;
	global $wpdb;
	//Local Variables
	$response			= array();
	$post				= isset( $_POST[$this->plugin_post] ) &&  $_POST[$this->plugin_post]!=null ? $_POST[$this->plugin_post] : $_POST;
	$plan_id			= intval ( $post['plan_id'] );
	$executor_opts		= '';
	$systems_opt		= '';
	$task_status_opt	= '';
	$service_opts		= '';
	//--------------------------------------------------------------------------
	$sql = 'SELECT
				*,
				T00.id as plan_id,
				T00.title as plan_title,
				T00.manager_user_id as manager_id,
				T01.short_name as customer_name,
				T01.code as customer_code,
				T01.id as customer_id

			FROM
			' . $NOVIS_CSI_CMP->tbl_name . ' as T00
			LEFT JOIN ' . $NOVIS_CSI_CUSTOMER->tbl_name . ' as T01
				ON T01.id = T00.customer_id
			WHERE
				T00.id = "' . $plan_id . '"
	';
	$plan = $wpdb->get_row($sql);
	//--------------------------------------------------------------------------
	$sql = 'SELECT
				T03.id as id,
				T03.short_name as short_name
			FROM
				' . $NOVIS_CSI_CUSTOMER_SYSTEM->tbl_name . ' as T00
				LEFT JOIN ' . $NOVIS_CSI_SAPCUSTNO->tbl_name . ' as T01
					ON T00.sapcustno = T01.sapcustno
				LEFT JOIN ' . $NOVIS_CSI_CUSTOMER->tbl_name . ' as T02
					ON T01.customer_id = T02.id
				LEFT JOIN ' . $NOVIS_CSI_CUSTOMER_SYSTEM_ENVIRONMENT->tbl_name . ' as T03
					ON T00.environment_id = T03.id
			WHERE
				T02.id = "' . $plan->customer_id . '"
			GROUP BY T03.id
	';
	$environments = $this->get_sql ( $sql );
	foreach ( $environments as $environment ){
		$sql = 'SELECT
					T00.id as id,
					T00.sid as sid
				FROM
					' . $NOVIS_CSI_CUSTOMER_SYSTEM->tbl_name . ' as T00
					LEFT JOIN ' . $NOVIS_CSI_SAPCUSTNO->tbl_name . ' as T01
						ON T00.sapcustno = T01.sapcustno
					LEFT JOIN ' . $NOVIS_CSI_CUSTOMER->tbl_name . ' as T02
						ON T01.customer_id = T02.id
					LEFT JOIN ' . $NOVIS_CSI_CUSTOMER_SYSTEM_ENVIRONMENT->tbl_name . ' as T03
						ON T00.environment_id = T03.id
				WHERE
					T02.id = "' . $plan->customer_id . '"
					AND T03.id = "' . $environment['id'] . '"
		';
		$systems_opt.='<optgroup label="' . $environment['short_name'] . '">';
		$systems = $this->get_sql ( $sql );
		foreach ( $systems as $system ){
			$systems_opt .='<option value="' . $system['id'] . '">' . $system['sid'] . '</option>';
		}
		$systems_opt.='</optgroup>';
	}
	//--------------------------------------------------------------------------
	$sql ='SELECT
				*
			FROM
				' . $NOVIS_CSI_CMP_TASK_STATUS->tbl_name . '
	';
	$task_status = $this->get_sql ( $sql );
	foreach ( $task_status as $status ){
		$selected = ( 'proposed' == $status['code'] ) ? 'selected' : '';
		$task_status_opt .='<option value="' . $status['id'] . '" ' . $selected . '>' . $status['short_name'] . '</option>';
	}
	//--------------------------------------------------------------------------
	$sql = '
		SELECT
			*
		FROM
			' . $NOVIS_CSI_SERVICE->tbl_name . '
	';
	$services = $this->get_sql ( $sql );
	foreach ( $services as $service ){
		$service_opts .='<option value="' . $service['id'] . '">'. $service['short_name_es'] . '</option>';
	}
	//--------------------------------------------------------------------------
	$o='
	<!-- #AddTask -->
	<div id="csi-template-cmp-control-center-add-plan" class="container ">
		<h2></h2>
		<div class="panel panel-default row">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-plus"></i> Agregar tarea</h3>
			</div>
			<div class="panel-body">
				<form class="form-horizontal" data-function="csi_cmp_create_cmp_task" data-next-page="showplan?plan_id=' . $plan_id . '">
					<div class="form-group">
						<label class="col-sm-2 control-label">
							Cliente
						</label>
						<div class="col-sm-10">
								<p class="form-control disabled">' . $plan->customer_name . '</p>
							<span class="help-block">
							</span>
						</div>
					</div>
					<div class="form-group">
					<label class="col-sm-2 control-label">
						Plan
					</label>
						<div class="col-sm-10">
							<input type="hidden" id="cmp_id" name="cmp_id" value="' . $plan_id . '"/>
							<p class="form-control">
								' . $plan->plan_title . '
								<small>
									(<a href="#" class="csi-popup" data-action="csi_cmp_popup_cmp_info" data-plan-id="' . $plan_id . '">
										#PCM_' . $plan_id . '
									</a>)
								</small>
							</p>
							<span class="help-block">
							</span>
						</div>
					</div>
					<div class="form-group">
						<label for="service_id" class="col-sm-2 control-label">Servicio relacionado</label>
						<div class="col-sm-10">
							<select class="form-control select2" name="service_id" id="service_id" data-placeholder="Selecciona el Servicio relacionado" required="true"  style="width:100%">
								<option></option>
								' . $service_opts . '
							</select>
							<span class="help-block">
								<small class="text-warning pull-right">(requerido)</small>
								Si el servicio no aparece en la lista, selecciona <strong>Otros</strong>.
							</span>
						</div>
					</div>
					<div class="form-group">
						<label for="customer_system_id" class="col-sm-2 control-label">Sistema</label>
						<div class="col-sm-10">
							<input type="hidden" id="system-id" />
							<select class="form-control select2" name="customer_system_id" id="customer_system_id" data-placeholder="Selecciona el sistema de ' . $plan->customer_name . '" required="true""  style="width:100%">
								<option></option>
								' . $systems_opt . '
							</select>
							<span class="help-block">
								<small class="text-warning pull-right">(requerido)</small>
								El sistema involucrado indica el sistema del cliente afectado en la actividad.<br/>
								En el caso que esta tarea afecte dos sistemas existen diferentes.
							</span>
						</div>
					</div>
					<div class="form-group">
						<label for="ticket_no" class="col-sm-2 control-label">Ticket</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="ticket_no" id="ticket_no" placeholder="5000012345" maxlenght="15"/>
							<span class="help-block">
								N&uacute;mero de ticket NOVIS relacionado.<br/>
								En caso que el cliente tenga un sistema alterno de tickets, la referencia puede ser agregada en las <strong>Observaciones</strong>.<br/>
								<small>Tama&ntilde;o m&aacute;ximo: 15 caracteres.</small>
							</span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Visible para Cliente</label>
						<div class="col-sm-10">
							<input type="checkbox" class="form-control csi-cool-checkbox" id="customer_visible_flag" name="customer_visible_flag" value="1"/>
							<label for="customer_visible_flag">Visible para el Cliente</label>
							<span class="help-block">
								Indica si esta tarea debe aparecer en el calendario del Cliente.
							</span>
						</div>
					</div>
					<div class="form-group">
						<label for="comments" class="col-sm-2 control-label">Observaciones</label>
						<div class="col-sm-10">
							<textarea class="form-control" name="comments" id="comments" placeholder="Observaciones adicionales" maxlenght="255"></textarea>
							<span class="help-block">
							Este campo aparece como descripci&oacute;n en el calendario.<br/>
							<span class="text-warning"><i class="fa fa-exclamation-triangle"></i> Ten cuidado con el texto que pongas en este campo, ya que  puede ser visible por el cliente.</span><br/>
							<small>Tama&ntilde;o m&aacute;ximo: 255 caracteres.</small>
							</span>
						</div>
					</div>

					<div class="form-group hidden">
						<label for="status_id" class="col-sm-2 control-label">Status</label>
						<div class="col-sm-10">
						<select class="form-control select2" name="status_id" id="status_id" required="true" data-placeholder="Selecciona el status" required="true" style="width:100%">
							<option></option>
							' . $task_status_opt . '
						</select>
							<span class="help-block">
							<small class="text-warning pull-right">(requerido)</small>
							El status de la tarea indica el punto de resolución de la actividad
							<a href="#" class="csi-popup" data-action="csi_cmp_popup_task_status_info"><i class="fa fa-question-circle"></i></a>.
							</span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Ventana Offline</label>
						<div class="col-sm-10">
							<input type="checkbox" class="form-control csi-cool-checkbox" id="offline_task_flag" name="offline_task_flag" value="1"/>
							<label for="offline_task_flag">Ventana Offline</label>
							<span class="help-block">
								Indica si la actividad impacta la disponibilidad del sistema relacionado.
							</span>
						</div>
					</div>
					<div class="form-group">
						<label for="task_datetime" class="col-sm-2 control-label">Ventana de Ejecuci&oacute;n</label>
						<div class="col-sm-10">
							<div class="input-group">
								<span class="input-group-addon" title="Zona horaria Cliente">
									<a href="#">
										<i class="fa fa-calendar-check-o fa-fw"></i><i class="fa fa-building fa-fw"></i>
									</a>
								</span>
								<input type="text" class="csi-datetime-range-input form-control" name="task_datetime" id="task_datetime" required="true"/>
								<span class="input-group-addon duration ">X horas</span>
							</div>
							<!--
							<div class="input-group">
								<span class="input-group-addon" title="Zona horaria Usuario">
									<a href="#">
										<i class="fa fa-calendar-check-o fa-fw"></i><i class="fa fa-user-o fa-fw"></i>
									</a>
								</span>
								<input type="text" class="form-control" readonly="true"/>
							</div>
							-->
							<span class="help-block">
								<small class="text-warning pull-right">(requerido)</small>
								El campo de fecha y hora identifica el lapso de tiempo en el cual se desarrolla la tarea.
								<!--
								<div class="animated fadeLeftIn alert alert-warning alert-dismissible text-jutify" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									<i class="fa fa-exclamation-triangle text-warning fa-fw"></i>
									El horario y fecha debe ser expresado en la zona horaria del cliente.<br/>
									El cliente <strong>' . $plan->customer_name . '</strong> tiene la zona horaria [ZONA_HORARIA]. La fecha y hora actual es este cliente es: [FECHA_HORA_CLIENTE].
								</div>
								-->
							</span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Cambio</label>
						<div class="col-sm-10">
							<input type="checkbox" class="form-control csi-cool-checkbox" id="change_flag" name="change_flag" value="1" data-toggle="collapse" data-target="#csi-plan-task-change-additional-fields" />
							<label for="change_flag">Cambio</label>
							<span class="help-block">
								Indica si esta tarea es una actividad de Cambio.
							</span>
						</div>
					</div>
					<div id="csi-plan-task-change-additional-fields" class="collapse well csi-form-additional-fields">
						<div class="form-group">
							<label class="col-sm-2 control-label">Cambio Urgente</label>
							<div class="col-sm-10">
								<input type="checkbox" class="form-control csi-cool-checkbox" id="change_urgent_flag" name="change_urgent_flag" value="1"/>
								<label for="change_urgent_flag">Cambio Urgente</label>
								<span class="help-block">
									Indica si esta tarea es una actividad de Cambio Urgente. <a href="#" class="csi-popup" data-action="csi_cmp_popup_task_status_info"><i class="fa fa-question-circle"></i></a>
								</span>
							</div>
						</div>
						<!--
						<div class="form-group">
							<label class="col-sm-2 control-label">Responsable del Cambio</label>
							<div class="col-sm-10">
								<select class="form-control select2" id="change_requester_user_id" name="change_requester_user_id" data-placeholder="Selecciona el responsable del Cambio" required="true" style="width:100%">
									<option></option>
									<option valude="1">Cristian Marin</option>
								</select>
								<span class="help-block">
									<small class="text-warning pull-right">(requerido)</small>
									Cuando una tarea involucra un cambio, es necesario realizar el proceso de <a href="#">Solicitud de Cambio</a>. Por defecto el solicitante del cambio es el mismo que programa la actividad.
								</span>
							</div>
						</div>
						-->
					</div>
					<div class="form-group">
						<div class="alert alert-info" role="alert">
							<i class="fa fa-info fa-lg"></i>
							<p class="text-justify">
								Si has indicado que la tarea sea <strong>Visible para el Cliente</strong> y la tarea está en status diferente a <strong>Propuesta</strong>  aparecer&aacute; de modo inmediato en el Calendario del Cliente. Si tienes dudas en relaci&oacute;n a este punto revisa la <a href="#" target="_blank"> Gu&iacute;a de Usuario <i class="fa fa-external-link"></i></a> de esta herramienta o deja los valores por defecto (siempre puedes modificar estos valores despu&eacute;s).
							</p>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10 text-right">
							<button type="reset" class="btn btn-danger">Cancelar</button>
							<button type="submit" class="btn btn-primary">Entiendo, Crear tarea</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

	';
	$sql = 'SELECT ID, display_name FROM ' . $wpdb->base_prefix . 'users ORDER BY display_name ASC';
	$users = $this->get_sql ( $sql );
	foreach ( $users as $user ){
		$executor_opts .= '<option value="' . $user['ID'] . '">' . $user['display_name'] . '</option>';
	}
	$dynamic_fields=array(
		'task-executioner'			=> array(
			'maxFields'		=> 5,
			'addButton'		=> '<button class="btn btn-sm btn-success" id="doc-plus"><i class="fa fa-plus"></i> Agregar ejecutor</button>',
			'fieldBox'		=> '<div class="input-group select2-bootstrap-append select2-bootstrap-prepend">
									<span class="input-group-addon"><i class="fa fa-user-o"></i></span>
									<select
										type="text"
										class="form-control select2"
										data-placeholder="Ejecutor"
										name="task_executor_user_id[]"
										required="true"
									>
										<option></option>
										' . $executor_opts . '
									</select>
									<span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
									<input type="number" class="form-control col-xs-2" placeholder="3" name="task_executor_time[]"
									style="min-width:60px;"
									/>
									<span class="input-group-addon">horas</span>
									<span class="input-group-btn">
										<a href="#" class="btn btn-danger csi-cmp-delete-dynamic-field-button">
											<i class="fa fa-times"></i>
										</a>
									</span>
								</div>',
		),
	);
	$response['dynamicFields'] = $dynamic_fields;

	$response['message'] = $o;
	echo json_encode($response);
	wp_die();
}
public function csi_cmp_build_page_edit_task_form(){
	//Global Variables
	global $NOVIS_CSI_CUSTOMER;
	global $NOVIS_CSI_CUSTOMER_SYSTEM_ENVIRONMENT;
	global $NOVIS_CSI_CUSTOMER_SYSTEM;
	global $NOVIS_CSI_SAPCUSTNO;
	global $NOVIS_CSI_CMP;
	global $NOVIS_CSI_CMP_TASK_TYPE;
	global $NOVIS_CSI_CMP_TASK_STATUS;
	global $NOVIS_CSI_SERVICE;
	global $wpdb;
	//Local Variables
	$response			= array();
	$post				= isset( $_POST[$this->plugin_post] ) &&  $_POST[$this->plugin_post]!=null ? $_POST[$this->plugin_post] : $_POST;
	$task_id			= intval ( $post['task_id'] );
	$executor_opts		= '';
	$systems_opt		= '';
	$task_status_opt	= '';
	$service_opts		= '';
	//--------------------------------------------------------------------------
	$sql = 'SELECT * FROM ' . $this->tbl_name . ' WHERE id = "' . $task_id . '"';
	$task = $wpdb->get_row ( $sql );
	//--------------------------------------------------------------------------
	$sql = 'SELECT
				*,
				T00.id as plan_id,
				T00.title as plan_title,
				T00.manager_user_id as manager_id,
				T01.short_name as customer_name,
				T01.code as customer_code,
				T01.id as customer_id

			FROM
			' . $NOVIS_CSI_CMP->tbl_name . ' as T00
			LEFT JOIN ' . $NOVIS_CSI_CUSTOMER->tbl_name . ' as T01
				ON T01.id = T00.customer_id
			WHERE
				T00.id = "' . $task->cmp_id . '"
	';
	$plan = $wpdb->get_row($sql);
	//--------------------------------------------------------------------------
	$sql = 'SELECT
				T03.id as id,
				T03.short_name as short_name
			FROM
				' . $NOVIS_CSI_CUSTOMER_SYSTEM->tbl_name . ' as T00
				LEFT JOIN ' . $NOVIS_CSI_SAPCUSTNO->tbl_name . ' as T01
					ON T00.sapcustno = T01.sapcustno
				LEFT JOIN ' . $NOVIS_CSI_CUSTOMER->tbl_name . ' as T02
					ON T01.customer_id = T02.id
				LEFT JOIN ' . $NOVIS_CSI_CUSTOMER_SYSTEM_ENVIRONMENT->tbl_name . ' as T03
					ON T00.environment_id = T03.id
			WHERE
				T02.id = "' . $plan->customer_id . '"
			GROUP BY T03.id
	';
	$environments = $this->get_sql ( $sql );
	foreach ( $environments as $environment ){
		$sql = 'SELECT
					T00.id as id,
					T00.sid as sid
				FROM
					' . $NOVIS_CSI_CUSTOMER_SYSTEM->tbl_name . ' as T00
					LEFT JOIN ' . $NOVIS_CSI_SAPCUSTNO->tbl_name . ' as T01
						ON T00.sapcustno = T01.sapcustno
					LEFT JOIN ' . $NOVIS_CSI_CUSTOMER->tbl_name . ' as T02
						ON T01.customer_id = T02.id
					LEFT JOIN ' . $NOVIS_CSI_CUSTOMER_SYSTEM_ENVIRONMENT->tbl_name . ' as T03
						ON T00.environment_id = T03.id
				WHERE
					T02.id = "' . $plan->customer_id . '"
					AND T03.id = "' . $environment['id'] . '"
		';
		$systems_opt.='<optgroup label="' . $environment['short_name'] . '">';
		$systems = $this->get_sql ( $sql );
		foreach ( $systems as $system ){
			$selected = ($task->customer_system_id == $system['id'] ) ? 'selected' : '';
			$systems_opt .='<option value="' . $system['id'] . '" ' . $selected . '>' . $system['sid'] . '</option>';
		}
		$systems_opt.='</optgroup>';
	}
	//--------------------------------------------------------------------------
	$sql ='SELECT
				*
			FROM
				' . $NOVIS_CSI_CMP_TASK_STATUS->tbl_name . '
	';
	$task_status = $this->get_sql ( $sql );
	foreach ( $task_status as $status ){
		$selected = ( $task->status_id == $status['id'] ) ? 'selected' : '';
		$task_status_opt .='<option value="' . $status['id'] . '" ' . $selected . '>' . $status['short_name'] . '</option>';
	}
	//--------------------------------------------------------------------------
	$sql = '
		SELECT
			*
		FROM
			' . $NOVIS_CSI_SERVICE->tbl_name . '
	';
	$services = $this->get_sql ( $sql );
	foreach ( $services as $service ){
		$selected = ( $task->service_id == $service['id'] ) ? 'selected' : '';
		$service_opts .='<option value="' . $service['id'] . '" ' . $selected . '>'. $service['short_name_es'] . '</option>';
	}
	//--------------------------------------------------------------------------
	$start_datetime = new DateTime ( $task->start_datetime );
	$end_datetime = new DateTime ( $task->end_datetime );
	$duration = date_diff ( $end_datetime, $start_datetime );
	//--------------------------------------------------------------------------
	$o='
	<!-- #EditTask -->
	<div id="csi-template-cmp-control-center-edit-task" class="container ">
		<div class="panel panel-default row">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-pencil"></i> Editar tarea</h3>
			</div>
			<div class="panel-body">
				<form class="form-horizontal" data-function="csi_cmp_edit_cmp_task" data-next-page="showplan?plan_id=' . $task->cmp_id . '">
					<input type="hidden" name="task_id" value="' . $task->id . '"/>
					<div class="form-group">
						<label class="col-sm-2 control-label">
							Cliente
						</label>
						<div class="col-sm-10">
							<div class="input-group">
								<span class="input-group-addon">
									<span class="text-danger">
										<i class="fa fa-exclamation-circle"></i>
									</span>
								</span>
								<p class="form-control disabled">' . $plan->customer_name . '</p>
							</div>
							<span class="help-block">
							</span>
						</div>
					</div>
					<div class="form-group">
					<label class="col-sm-2 control-label">
						Plan
					</label>
						<div class="col-sm-10">
							<div class="input-group">
								<span class="input-group-addon">
									<span class="text-warning">
										<i class="fa fa-exclamation-triangle"></i>
									</span>
								</span>
								<input type="hidden" id="cmp_id" name="cmp_id" value="' . $task->cmp_id . '"/>
								<p class="form-control">
									' . $plan->plan_title . '
									<small>
										(<a href="#" class="csi-popup" data-action="csi_cmp_popup_cmp_info" data-plan-id="' . $task->cmp_id . '">
											#PCM_' . $task->cmp_id . '
										</a>)
									</small>
								</p>
							</div>
							<span class="help-block">
							</span>
						</div>
					</div>
					<div class="form-group">
						<label for="service_id" class="col-sm-2 control-label">Servicio relacionado</label>
						<div class="col-sm-10">
							<select class="form-control select2" name="service_id" id="service_id" data-placeholder="Selecciona el Servicio relacionado" required="true">
								<option></option>
								' . $service_opts . '
							</select>
							<span class="help-block">
								<small class="text-warning pull-right">(requerido)</small>
								Si el servicio no aparece en la lista, selecciona <strong>Otros</strong>.
							</span>
						</div>
					</div>
					<div class="form-group">
						<label for="customer_system_id" class="col-sm-2 control-label">Sistema</label>
						<div class="col-sm-10">
							<select class="form-control select2" name="customer_system_id" id="customer_system_id" data-placeholder="Selecciona el sistema" required="true"">
								<option></option>
								' . $systems_opt . '
							</select>
							<span class="help-block">
								<small class="text-warning pull-right">(requerido)</small>
								El sistema involucrado indica el sistema del cliente afectado en la actividad.<br/>
								En el caso que esta tarea afecte dos sistemas existen diferentes.
							</span>
						</div>
					</div>
					<div class="form-group">
						<label for="status_id" class="col-sm-2 control-label">Status</label>
						<div class="col-sm-10">
						<select class="form-control select2" name="status_id" id="status_id" required="true" data-placeholder="Selecciona el status">
							<option></option>
							' . $task_status_opt . '
						</select>
							<span class="help-block">
							<small class="text-warning pull-right">(requerido)</small>
							El status de la tarea indica el punto de resolución de la actividad
							<a href="#" class="csi-popup" data-action="csi_cmp_popup_task_status_info"><i class="fa fa-question-circle"></i></a>.
							</span>
						</div>
					</div>
					<div class="form-group">
						<label for="ticket_no" class="col-sm-2 control-label">Ticket</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="ticket_no" id="ticket_no" placeholder="5000012345" maxlenght="15" value="' . $task->ticket_no . '"/>
							<span class="help-block">
								El status de la tarea define el comportamiento de esta esta tarea en el proceso de evaluación de horas, y calendario <a href="#"><i class="fa fa-question-circle"></i></a>
							</span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Visible para Cliente</label>
						<div class="col-sm-10">
							<input type="checkbox" class="form-control csi-cool-checkbox" id="customer_visible_flag" name="customer_visible_flag" value="1" ' . ( 1 == $task->customer_visible_flag ? 'checked' : '' ) . '/>
							<label for="customer_visible_flag">Visible para el Cliente</label>
							<span class="help-block">
								Indica si esta tarea debe aparecer en el calendario del Cliente.
							</span>
						</div>
					</div>
					<div class="form-group">
						<label for="comments" class="col-sm-2 control-label">Observaciones</label>
						<div class="col-sm-10">
							<textarea class="form-control" name="comments" id="comments" placeholder="Observaciones adicionales" maxlenght="255">' . $task->comments . '</textarea>
							<span class="help-block">
							Este campo aparece como descripci&oacute;n en el calendario.<br/>
							<span class="text-warning"><i class="fa fa-exclamation-triangle"></i> Ten cuidado con el texto que pongas en este campo, ya que  puede ser visible por el cliente.</span><br/>
							<small>Tama&ntilde;o m&aacute;ximo: 255 caracteres.</small>
							</span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Ventana Offline</label>
						<div class="col-sm-10">
							<input type="checkbox" class="form-control csi-cool-checkbox" id="offline_task_flag" name="offline_task_flag" value="1" ' . ( 1 == $task->offline_task_flag ? 'checked' : '' ) . '/>
							<label for="offline_task_flag">Ventana Offline</label>
							<span class="help-block">
								Indica si la actividad impacta la disponibilidad del sistema relacionado.
							</span>
						</div>
					</div>
					<div class="form-group">
						<label for="task_datetime" class="col-sm-2 control-label">Ventana de Ejecuci&oacute;n</label>
						<div class="col-sm-10">
							<div class="input-group">
								<span class="input-group-addon" title="Zona horaria Cliente">
									<a href="#">
										<i class="fa fa-calendar-check-o fa-fw"></i><i class="fa fa-building fa-fw"></i>
									</a>
								</span>
								<input type="text" class="csi-datetime-range-input form-control" name="task_datetime" id="task_datetime" required="true" value="' . $start_datetime->format('Y/m/d H:i') . ' - ' . $end_datetime->format('Y/m/d H:i') . '"/>
								<span class="input-group-addon duration ">' . $duration->h . ' horas</span>
							</div>
							<span class="help-block">
								<small class="text-warning pull-right">(requerido)</small>
								El campo de fecha y hora identifica el lapso de tiempo en el cual se desarrolla la tarea.
							</span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Cambio</label>
						<div class="col-sm-10">
							<input
								type="checkbox"
								class="form-control csi-cool-checkbox"
								id="change_flag"
								name="change_flag"
								value="1"
								' . ( 1 == $task->change_flag ? 'checked' : '' ) . '
								data-toggle="collapse"
								data-target="#csi-plan-task-change-additional-fields"/>
							<label for="change_flag">Cambio</label>
							<span class="help-block">
								Indica si esta tarea es una actividad de Cambio.
							</span>
						</div>
					</div>
					<div id="csi-plan-task-change-additional-fields" class="collapse ' . ( 1 == $task->change_flag ? 'in' : '' ) . ' well csi-form-additional-fields">
						<div class="form-group">
							<label class="col-sm-2 control-label">Cambio Urgente</label>
							<div class="col-sm-10">
								<input type="checkbox" class="form-control csi-cool-checkbox ' . ( 1 == $task->change_flag ? 'disabled' : '' ) . '" id="change_urgent_flag" name="change_urgent_flag" value="1" ' . ( 1 == $task->change_urgent_flag ? 'checked' : '' ) . ' ' . ( 1 == $task->change_flag ? '' : 'disabled' ) . '/>
								<label for="change_urgent_flag">Cambio Urgente</label>
								<span class="help-block">
									Indica si esta tarea es una actividad de Cambio Urgente. <a href="#" class="csi-popup" data-action="csi_cmp_popup_task_status_info"><i class="fa fa-question-circle"></i></a>
								</span>
							</div>
						</div>
						<!--
						<div class="form-group">
							<label class="col-sm-2 control-label">Responsable del Cambio</label>
							<div class="col-sm-10">
								<select class="form-control select2 ' . ( 1 == $task->change_flag ? 'disabled' : '' ) . '" id="change_requester_user_id" name="change_requester_user_id" data-placeholder="Selecciona el responsable del Cambio" style="width:100%" ' . ( 1 == $task->change_flag ? '' : 'disabled' ) . '>
									<option></option>
									<option valude="1">Cristian Marin</option>
								</select>
								<span class="help-block">
									<small class="text-warning pull-right">(requerido)</small>
									Cuando una tarea involucra un cambio, es necesario realizar el proceso de <a href="#">Solicitud de Cambio</a>. Por defecto el solicitante del cambio es el mismo que programa la actividad.
								</span>
							</div>
						</div>
						-->
					</div>
					<div class="form-group">
						<div class="alert alert-info" role="alert">
							<i class="fa fa-info fa-lg"></i>
							<p class="text-justify">
								Si has indicado que la tarea sea <strong>Visible para el Cliente</strong> y la tarea está en status diferente a <strong>Propuesta</strong>  aparecer&aacute; de modo inmediato en el Calendario del Cliente. Si tienes dudas en relaci&oacute;n a este punto revisa la <a href="#" target="_blank"> Gu&iacute;a de Usuario <i class="fa fa-external-link"></i></a> de esta herramienta o deja los valores por defecto (siempre puedes modificar estos valores despu&eacute;s).
							</p>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10 text-right">
							<button type="reset" class="btn btn-default">Cancelar</button>
							<button type="submit" class="btn btn-primary">Entiendo, Editar tarea</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="panel panel-danger row">
			<div class="panel-heading">
				<h3 class="panel-title">Zona de peligro</h3>
			</div>
			<div class="panel-body">
				<form class="">
					<div class="form-group">
						<label class="col-sm-2 control-label">Eliminar esta tarea</label>
						<div class="col-sm-10">
							<p class="text-right">
								<button type="submit" class="btn btn-danger">
									<i class="fa fa-trash"></i> Eliminar esta tarea
								</button>
							</p>
							<p class="help-block">Al eliminar esta tarea, se perder&aacute; toda la informaci&oacute;n relacionada.</p>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div><!-- #csi-template-cmp-control-center-edit-task -->

	';
	$sql = 'SELECT ID, display_name FROM ' . $wpdb->base_prefix . 'users ORDER BY display_name ASC';
	$users = $this->get_sql ( $sql );
	foreach ( $users as $user ){
		$executor_opts .= '<option value="' . $user['ID'] . '">' . $user['display_name'] . '</option>';
	}
	$dynamic_fields=array(
		'task-executioner'			=> array(
			'maxFields'		=> 5,
			'addButton'		=> '<button class="btn btn-sm btn-success" id="doc-plus"><i class="fa fa-plus"></i> Agregar ejecutor</button>',
			'fieldBox'		=> '<div class="input-group select2-bootstrap-append select2-bootstrap-prepend">
									<span class="input-group-addon"><i class="fa fa-user-o"></i></span>
									<select
										type="text"
										class="form-control select2"
										data-placeholder="Ejecutor"
										name="task_executor_user_id[]"
										required="true"
									>
										<option></option>
										' . $executor_opts . '
									</select>
									<span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
									<input type="number" class="form-control col-xs-2" placeholder="3" name="task_executor_time[]"
									style="min-width:60px;"
									/>
									<span class="input-group-addon">horas</span>
									<span class="input-group-btn">
										<a href="#" class="btn btn-danger csi-cmp-delete-dynamic-field-button">
											<i class="fa fa-times"></i>
										</a>
									</span>
								</div>',
		),
	);
	$response['dynamicFields'] = $dynamic_fields;

	$response['message'] = $o;
	echo json_encode($response);
	wp_die();
}
public function csi_cmp_create_cmp_task(){
	//Global Variables
	global $NOVIS_CSI_CUSTOMER;
	global $NOVIS_CSI_PROJECT_STATUS;
	global $wpdb;
	//Local Variables
	$insertArray			= array();
	$response				= array();
	$post					= isset( $_POST[$this->plugin_post] ) &&  $_POST[$this->plugin_post]!=null ? $_POST[$this->plugin_post] : $_POST;
	//--------------------------------------------------------------------------
	$current_user			= get_userdata ( get_current_user_id() );
	//--------------------------------------------------------------------------
	$current_datetime		= new DateTime();
	$task_datetime			= explode ( ' - ', strip_tags ( stripslashes ( $post['task_datetime'] ) ) );
	$start_datetime			= new DateTime ( $task_datetime[0] . ':00' );
	$end_datetime			= new DateTime ( $task_datetime[1] . ':00' );
	//--------------------------------------------------------------------------
	$insertArray['cmp_id']							= strip_tags(stripslashes( $post['cmp_id'] ));
	$insertArray['service_id']						= strip_tags(stripslashes( $post['service_id'] ));
	$insertArray['customer_system_id']				= strip_tags(stripslashes( $post['customer_system_id'] ));
	$insertArray['ticket_no']						= strip_tags(stripslashes( $post['ticket_no'] ));
	$insertArray['customer_visible_flag']			= ('1' == $post['customer_visible_flag'] ) ? 1 : 0 ;
	$insertArray['comments']						= strip_tags(stripslashes( $post['comments'] ));
	$insertArray['status_id']						= strip_tags(stripslashes( $post['status_id'] ));
	$insertArray['offline_task_flag']				= ('1' == $post['offline_task_flag'] ) ? 1 : 0 ;
	$insertArray['start_datetime']					= $start_datetime->format ( 'Y-m-d H:i:s' );
	$insertArray['end_datetime']					= $end_datetime->format ( 'Y-m-d H:i:s' );
	$insertArray['change_flag']						= ('1' == $post['change_flag'] ) ? 1 : 0 ;
	$insertArray['change_urgent_flag']				= ('1' == $post['change_urgent_flag'] ) ? 1 : 0 ;
/*
	if ( isset ( $post['change_requester_user_id'] ) ){
		$insertArray['change_requester_user_id']		= intval ( $post['change_requester_user_id'] );
		$change_requester = get_userdata ( intval ( $post['change_requester_user_id'] ) );
		$insertArray['change_requester_user_email']		= $change_requester->user_email;
	}
*/
	$insertArray['creation_user_id']		= $current_user->ID;
	$insertArray['creation_user_email']		= $current_user->user_email;
	$insertArray['creation_date']			= $current_datetime->format('Y-m-d');
	$insertArray['creation_time']			= $current_datetime->format('H:i:s');

	if ( $wpdb->insert( $this->tbl_name, $insertArray ) ){
		$response['id']=$wpdb->insert_id;
		$plan_id = $wpdb->insert_id;
		//crear registro de Ejecutores
		$response['postSubmitAction']	='changeHash';
		$response['notification']=array(
			'buttons'			=> array(
				'OK'			=> array(
					'text'		=> 'OK',
					'btnClass'	=> 'btn-success',
				),
			),
			'icon'				=> 'fa fa-check fa-sm',
			'closeIcon'			=> true,
			'columnClass'		=> 'large',
			'content'			=> 'Has agregado un nuevo ' . $this->name_single . ' exitosamente. (ID: <code>#' . $plan_id . '</code>)',
			'title'				=> 'Bien!',
			'type'				=> 'green',
			'autoClose'			=> 'OK|3000',
		);
	}else{
		$response['error']=true;
		$response['notifStopNextPage'] = true;
		$response['notification']=array(
			'buttons'			=> array(
				'OK'			=> array(
					'text'		=> 'OK',
					'btnClass'	=> 'btn-danger',
				),
			),
			'icon'				=> 'fa fa-exclamation-triangle fa-sm text-danger',
			'closeIcon'			=> true,
			'columnClass'		=> 'large',
			'content'			=> 'Hubo un error al agregar el nuevo ' . $this->name_single . '; intenta nuevamente. :)<p><small><code>' . htmlspecialchars( $wpdb->last_error, ENT_QUOTES ) . '</code></small></p>',
			'title'				=> 'Error!',
			'type'				=> 'red',
			'autoClose'			=> 'OK|3000',
		);
	}
	echo json_encode($response);
	wp_die();
}
public function csi_cmp_edit_cmp_task(){
	//Global Variables
	global $NOVIS_CSI_CUSTOMER;
	global $NOVIS_CSI_CUSTOMER_SYSTEM;
	global $NOVIS_CSI_CMP_TASK_STATUS;
	global $wpdb;
	//Local Variables
	$insertArray			= array();
	$response				= array();
	$o						= '';
	$post					= isset( $_POST[$this->plugin_post] ) &&  $_POST[$this->plugin_post]!=null ? $_POST[$this->plugin_post] : $_POST;
	$task_id				= $post['task_id'];
	self::write_log ( $post );
	$current_user		= get_userdata ( get_current_user_id() );
	$current_datetime	= new DateTime();
	$task_datetime		= explode ( ' - ', strip_tags ( stripslashes ( $post['task_datetime'] ) ) );
	if ( 15 <= strlen ( $task_datetime[0]) ){
		$task_datetime[0] = substr ( $task_datetime[0], 0, 15);
	}
	if ( 15 <= strlen ( $task_datetime[1]) ){
		$task_datetime[1] = substr ( $task_datetime[1], 0, 15);
	}
	$start_datetime		= new DateTime ( $task_datetime[0] . ':00' );
	$end_datetime		= new DateTime ( $task_datetime[1] . ':00' );

	$whereArray['id']							= intval ( $post['task_id'] );


	$editArray['customer_system_id']			= intval ( $post['customer_system_id'] );
	$editArray['service_id']					= intval ( $post['service_id'] );
	$editArray['offline_task_flag']				= isset ( $post['offline_task_flag'] )? 1 : NULL ;
	$editArray['change_flag']					= isset ( $post['change_flag'] )? 1 : NULL ;
	$editArray['change_urgent_flag']			= isset ( $post['change_urgent_flag'] )? 1 : NULL ;
//	$editArray['change_requester_user_id']		= isset ( $post['change_requester_user_id'] ) ? intval ( $post['change_requester_user_id'] ) : NULL;
//	$editArray['change_requester_user_email']	= isset ( $post['change_requester_user_email'] ) ? intval ( $post['change_requester_user_email'] ) : NULL;
	$editArray['customer_visible_flag']			= isset ( $post['customer_visible_flag'] )? 1 : NULL ;
	$editArray['comments']						= strip_tags(stripslashes( $post['comments'] ));
	$editArray['status_id']						= intval ( $post['status_id'] );
	$editArray['ticket_no']						= strip_tags(stripslashes( $post['ticket_no'] ));
	$editArray['start_datetime']				= $start_datetime->format ( 'Y-m-d H:i:s' );
	$editArray['end_datetime']					= $end_datetime->format ( 'Y-m-d H:i:s' );
	$editArray['last_modified_user_id']			= $current_user->ID;
	$editArray['last_modified_user_email']		= $current_user->user_email;
	$editArray['last_modified_date']			= $current_datetime->format('Y-m-d');
	$editArray['last_modified_time']			= $current_datetime->format('H:i:s');
	//self::write_log ( $post );
	//self::write_log ( $editArray );
	$result = $wpdb->update ( $this->tbl_name, $editArray, $whereArray );
	if( $result === false ){
		$response['error']=true;
		$response['notification']=array(
			'buttons'			=> array(
				'OK'			=> array(
					'text'		=> 'OK',
					'btnClass'	=> 'btn-danger',
				),
			),
			'icon'				=> 'fa fa-exclamation-circle fa-sm',
			'closeIcon'			=> true,
			'columnClass'		=> 'large',
			'content'			=> 'Hubo un error al editar el ' . $this->name_single . '; intenta nuevamente. :)',
			'title'				=> 'Bien!',
			'type'				=> 'red',
			'autoClose'			=> 'OK|3000',
		);
	}elseif ( $result == 0){
		$response['error']=true;
		$response['notification']=array(
			'buttons'			=> array(
				'OK'			=> array(
					'text'		=> 'OK',
					'btnClass'	=> 'btn-warning',
				),
			),
			'icon'				=> 'fa fa-exclamation-triangle fa-sm',
			'closeIcon'			=> true,
			'columnClass'		=> 'large',
			'content'			=> 'Los valores son iguales. ' . $this->name_single . ' no modificado',
			'title'				=> 'Bien!',
			'type'				=> 'orange',
			'autoClose'			=> 'OK|3000',
		);
	}else{
		$response['postSubmitAction']	='changeHash';
		$response['notification']=array(
			'buttons'			=> array(
				'OK'			=> array(
					'text'		=> 'OK',
					'btnClass'	=> 'btn-success',
				),
			),
			'icon'				=> 'fa fa-exclamation-triangle fa-sm',
			'closeIcon'			=> true,
			'columnClass'		=> 'large',
			'content'			=> $this->name_single . ' editado exitosamente.',
			'title'				=> 'Bien!',
			'type'				=> 'green',
			'autoClose'			=> 'OK|3000',
		);
	}

	echo json_encode($response);
	wp_die();
}
public function csi_cmp_fetch_tasks_table(){
	//Global Variables
	global $NOVIS_CSI_CUSTOMER;
	global $NOVIS_CSI_CUSTOMER_SYSTEM;
	global $NOVIS_CSI_CMP_TASK_STATUS;
	global $wpdb;
	//Local Variables
	$insertArray			= array();
	$response				= array();
	$o						= '';
	$post					= isset( $_POST[$this->plugin_post] ) &&  $_POST[$this->plugin_post]!=null ? $_POST[$this->plugin_post] : $_POST;
	$plan_id				= $post['planId'];

	$sql='SELECT
			*,
			T00.id as task_id,
			T00.offline_task_flag as offline_task_flag,
			T00.customer_visible_flag as customer_visible_flag,
			T00.start_datetime as task_start,
			T00.end_datetime as task_end,
			T00.change_flag as change_flag,
			T00.change_urgent_flag as change_urgent_flag,
			UPPER(T01.sid) as sid,
			T02.short_name as status_name,
			T02.icon as status_icon,
			T02.hex_color as status_color,
			T02.code as status_code,
			IF(T02.cmp_finished_start_flag!=0,IF(T00.start_datetime<NOW(),1,0),0) as cmp_start_delay,
			IF(T02.cmp_finished_end_flag!=0,IF(T00.end_datetime<NOW(),1,0),0) as cmp_end_delay,
			T02.cmp_error_flag as cmp_error,
			T00.comments as task_comments

		FROM
			' . $this->tbl_name . ' as T00
			LEFT JOIN ' . $NOVIS_CSI_CUSTOMER_SYSTEM->tbl_name . ' as T01
				ON T00.customer_system_id = T01.id
			LEFT JOIN ' . $NOVIS_CSI_CMP_TASK_STATUS->tbl_name . ' as T02
				ON T00.status_id = T02.id
		WHERE
			T00.cmp_id = "' . $plan_id . '"
		ORDER BY T00.start_datetime ASC
	';
	$tasks = $this->get_sql ( $sql );
	foreach ( $tasks as $task ){
		//----------------------------------------------------------------------
		$start_datetime = new DateTime ( $task['task_start'] );
		$end_datetime = new DateTime ( $task['task_end'] );
		$duration = date_diff ( $end_datetime, $start_datetime );
		if ( 0 <= $duration->d && 24 <= $duration->h ){
			$time_window = $start_datetime->format('d/m/Y H:i') . 'hrs a ' . $end_datetime->format('d/m/Y H:i') . 'hrs <small><code>' . $duration->h . ':' . sprintf ( "%02s", $duration->m ) . 'hrs</code></small>';
		}else{
			$time_window = $start_datetime->format('d/m/Y') . ' de ' . $start_datetime->format('H:i') . 'hrs a ' . $end_datetime->format('H:i') . 'hrs <small><code>' . $duration->h . ':' . sprintf ( "%02s", $duration->m ) . 'hrs</code></small>';
		}
		//----------------------------------------------------------------------
		$color_r = hexdec ( substr ( $task['status_color'], 0, 2 ) );
		$color_g = hexdec ( substr ( $task['status_color'], 2, 2 ) );
		$color_b = hexdec ( substr ( $task['status_color'], 4, 2 ) );
		//----------------------------------------------------------------------
		if ( !$task['customer_visible_flag'] ){
			$customer_visible = '<span class="pull-right text-primary" title="Tarea no visible para el cliente" data-toggle="tooltip" data-placement="top"><i class="fa fa-eye-slash"></i></span>';
		}else{
			$customer_visible = '<span class="pull-right text-warning" title="Tarea visible para el cliente" data-toggle="tooltip" data-placement="top"><i class="fa fa-eye"></i></span>';
		}
		//----------------------------------------------------------------------
		if ( !$task['offline_task_flag'] ){
			$offline = '<i class="fa fa-leaf fa-sm text-success"></i> Online';
			$offline_flag = '';
		}else{
			$offline = '<i class="fa fa-bolt fa-sm text-danger"></i> Offline';
			$offline_flag = '<i class="fa fa-bolt"></i>';
		}
		//----------------------------------------------------------------------
		if ( '' == $task['ticket_no'] ){
			$ticket = '--';
		}else{
			$ticket = '<samp><small>' . $task['ticket_no'] . '</small></samp>';
		}
		//----------------------------------------------------------------------
		$task_status = '';
		$task_status_msg = '';
		if ( $task['cmp_start_delay'] ) {
			$task_status = '<i class="fa fa-exclamation-triangle text-warning"></i>';
			$task_status_msg = '<div class="alert alert-warning" role="alert">Esta tarea est&aacute; atrasada. Debería haber comenzado su ejecuci&oacute;n el <strong>' . $start_datetime->format('d/m') . '</strong> a las ' . $start_datetime->format('H:i') . '</div>';
		}
		if ( $task['cmp_end_delay'] ){
			$task_status = '<i class="fa fa-exclamation-triangle text-warning"></i>';
			$task_status_msg = '<div class="alert alert-warning" role="alert">Esta tarea est&aacute; atrasada. Debería haber finalizado su ejecuci&oacute;n el <strong>' . $start_datetime->format('d/m') . '</strong> a las ' . $start_datetime->format('H:i') . '</div>';

		}
		if ( $task['cmp_error'] ) {
			$task_status = '<i class="fa fa-exclamation-circle text-danger"></i>';
			$task_status_msg = '<div class="alert alert-danger" role="alert">Esta tarea est&aacute; en error.</div>';
		}
		//----------------------------------------------------------------------
		//border-left: 5px solid rgba(' . $color_r . ',' . $color_g . ',' . $color_b . ',1);
		$o.='
			<tr style="position:relative;">
				<td class="hidden-xs"><small>' . $task['task_id'] . '</small></td>
				<td class="text-center">' . $task_status . '</td>
				<td class="text-center">' . $task['sid'] . '</td>
				<td class="hidden-xs">' . $ticket . '</td>
				<td class="hidden text-center">
					' . ( $task['change_flag'] ? '<span class="label label-default">Pendiente</span>' : '' ) . '
				</td>
				<td>' . $task['status_name'] . '</td>
				<td><small>' . $start_datetime->format ('d/m H:i') . '</small></td>
				<td class="hidden-xs text-center">' . $offline_flag . '</td>
				<td class="small">' . $duration->h . ':' . sprintf ( "%02s", $duration->m ) . 'hrs</td>
				<td class="text-center">
					<a role="button" data-toggle="collapse" href="#show-plan-' . $task['task_id'] . '"><i class="fa fa-window-maximize"></i></a>
				</td>
			</tr>
			<tr class=" collapse" id="show-plan-' . $task['task_id'] . '">
				<td colspan="999" style="border-top:none;" class="active">
					' . $task_status_msg . '
					<div class="col-sm-6 ">
						<table class="table table-condensed">
							<thead>
								<th colspan="2">
									' . $customer_visible . '
									Informaci&oacute;n de la Actividad
								</th>
							</thead>
							<tbody>
								<tr>
									<td colspan="2">' . $time_window . '</td>
								</tr>
								<tr>
									<th class="text-muted small">Sistema involucrado</th>
									<td>' . $task['sid'] . '</td>
								</tr>
								<tr>
									<th class="text-muted small">Ticket</th>
									<td>' . $ticket . '</td>
								</tr>
								<tr>
									<th class="text-muted small">Ventana Tipo</th>
									<td>' . $offline . '</td>
								</tr>
								<tr>
									<th class="text-muted small">Servicio relacionado</th>
									<td>Actualización de Parche de Kernen SAP NW</td>
								</tr>
								<tr>
									<th class="text-muted small">Status</th>
									<td
										style="color: rgba(' . $color_r . ',' . $color_g . ',' . $color_b . ',1);"
										>
										<i class="fa fa-' . $task['status_icon'] . ' fa-sm"></i>
										' . $task['status_name'] . '
										<span class="pull-right"><a href="#" class="csi-popup" data-action="csi_cmp_popup_task_status_info"><i class="fa fa-question-circle"></i></a></span>
									</td>
								</tr>
								<tr>
									<td colspan="2">
										<span class="text-muted small">Observaciones</span>
										<p>' . ( '' != $task['task_comments'] ? $task['task_comments'] : '--' ) . '</p>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="col-sm-6">
						<table class="table table-condensed">
							<thead>
								<th colspan="2">Informaci&oacute;n del Cambio</th>
							</thead>
							<tbody>';
		if ( !$task['change_flag'] ){
			$o.='<tr><td colspan="2" class="active">No hay cambio asociado</td></tr>';
		}else{
			$o.= '
				<tr>
					<th class="text-muted small">Tipo de Cambio</th>
					<td>' . ( NULL == $task['change_urgent_flag'] ? '<span class="text-danger">Urgente</span>' : 'Normal' ) . '</td>
				</tr>
				<tr>
					<th class="text-muted small">Aprobación</th>
					<td><span class="label label-default pull-right">Pendiente</span></td>
				</tr>
				<tr>
					<td colspan="2" class="text-center">
						<a href="#!showtask?task_id=' . $task['task_id'] . '" title="M&aacute;s informaci&oacute;n" class="btn btn-sm btn-default" data-action="csi_cmp_fetch_task_in_table_info" data-task-id="' . $task['task_id'] . '">
							<i class="fa fa-wrench"></i> Control de Cambio
						</a>
					</td>
				</tr>';
		}
		$o.= '
							</tbody>
						</table>
					</div>
					<div class="col-xs-12 text-center">
						<a href="#!edittask?task_id=' . $task['task_id'] . '" class="btn btn-primary"><i class="fa fa-pencil"></i> Editar tarea</a>
					</div>
				</td>
			</tr>
		';
	}
	$o.='
	<tr>
		<td colspan="999" class="text-center">
			<a href="#!addtask?plan_id=' . $plan_id . '" class="btn btn-success">
				<i class="fa fa-plus"></i> Agregar Tarea
			</a>
		</td>
	</tr>
	';

	$response['tbody']		= $o;

	echo json_encode($response);
	wp_die();
}
public function csi_cmp_fetch_task_in_table_info(){
	//Globa Variables
	global $NOVIS_CSI_CMP_TASK_STEP;
	global $NOVIS_CSI_CMP_TASK_STEP_TYPE;
	global $wpdb;
	//Local Variables
	$response			= array();
	$o					= '';
	$post				= isset( $_POST[$this->plugin_post] ) &&  $_POST[$this->plugin_post]!=null ? $_POST[$this->plugin_post] : $_POST;
	$o = '
		<tr>
			<td colspan="999">Hola</td>
		</tr>
	';
	$response['message'] = $o;
	echo json_encode($response);
	wp_die();
}
public function csi_cmp_fetch_task_step_list_info(){
	//Globa Variables
	global $wpdb;
	global $NOVIS_CSI_CMP_TASK_STEP;
	global $NOVIS_CSI_CMP_TASK_STEP_TYPE;
	global $NOVIS_CSI_USER;
	//Local Variables
	$response			= array();
	$o					= '';
	$post				= isset( $_POST[$this->plugin_post] ) &&  $_POST[$this->plugin_post]!=null ? $_POST[$this->plugin_post] : $_POST;
	//--------------------------------------------------------------------------
	$sql = 'SELECT * FROM ' . $NOVIS_CSI_CMP_TASK_STEP_TYPE->tbl_name . ' WHERE id="' . $post['stepTypeId'] . '"';
	$step_type = $wpdb->get_row ( $sql );
	//--------------------------------------------------------------------------
	$sql = 'SELECT
				*
			FROM
				' . $NOVIS_CSI_CMP_TASK_STEP->tbl_name . '
			WHERE
				cmp_task_id="' . $post['taskId'] . '"
				AND cmp_task_step_type_id="' . $post['stepTypeId'] . '"
			ORDER BY
				planned_start_datetime
	';
	$task_steps = $this->get_sql ( $sql );
	//--------------------------------------------------------------------------
	foreach ( $task_steps as $task_step ){
		//----------------------------------------------------------------------
		if ( $task_step['internal_executor_flag'] ){
			$sql = 'SELECT
						T00.id as user_id,
						T01.display_name as display_name,
						T01.user_email as user_email
					FROM
						' . $NOVIS_CSI_USER->tbl_name . ' as T00
						LEFT JOIN ' . $wpdb->base_prefix . 'users as T01
							ON T00.id = T01.ID
					WHERE
						T00.id = "' . $task_step['internal_user_id'] . '"
			';
			$executor = $wpdb->get_row ( $sql );
			$executor = '<a href="#" class="user-data" data-user-id="' . $executor->user_id . '" title="Más información"><i class="fa fa-id-card-o"></i> ' . $executor->display_name . '</a>';
		}else{
			$executor = $task_step['external_executor'];
		}
		//----------------------------------------------------------------------
		if ( $task_step['execution_status_flag']){
			$status= '<i class="fa fa-check-square-o fa-lg"></i>';
		}else{
			$status= '<i class="fa fa-square-o fa-lg"></i>';
		}
		//----------------------------------------------------------------------
		$planned_start_datetime = new DateTime($task_step['planned_start_datetime']);
		$planned_end_datetime = new DateTime($task_step['planned_end_datetime']);
		//----------------------------------------------------------------------
		$edit_link = '<a href="#" class="in-table-form-button hidden-print" data-action="csi_cmp_popup_edit_step_form"
						data-step-id="' . $task_step['id'] . '"><i class="fa fa-edit"></i></a>&nbsp;';
		//----------------------------------------------------------------------
		$o.='
			<tr class="small">
				<td>' . $edit_link . '<samp>' . $task_step['short_name'] . '</samp></td>
				<td>' . $executor . '</td>
				<td class="text-center">' . $planned_start_datetime->format('d/m H:i') . ' - ' . $planned_end_datetime->format('d/m H:i') . '</td>
				<td class="text-center">' . $status . '</td>
			</tr>
		';
	}
	$o.='
	<tr style="position:relative;">
		<td colspan="999">
			<a
				href="#"
				class="in-table-form-button btn btn-default btn-sm"
				data-action="csi_cmp_popup_new_step_form"
				data-task-id="' . $post['taskId'] . '"
				data-step-type-id="' . $post['stepTypeId'] . '"
				>
				<i class="fa fa-plus"></i> Agregar paso de ' . $step_type->short_name . '
			</a>
		</td>
	</tr>

	';
	$response['tbody']		= $o;

	echo json_encode($response);
	wp_die();
}

public function csi_cmp_build_page_show_task(){
	//Globa Variables
	global $wpdb;
	global $NOVIS_CSI_USER;
	global $NOVIS_CSI_SERVICE;
	global $NOVIS_CSI_CMP;
	global $NOVIS_CSI_SAPCUSTNO;
	global $NOVIS_CSI_CUSTOMER;
	global $NOVIS_CSI_CUSTOMER_SYSTEM;
	global $NOVIS_CSI_CMP_TASK_STATUS;
	global $NOVIS_CSI_CMP_TASK_STEP;
	global $NOVIS_CSI_CMP_TASK_STEP_TYPE;
	//Local Variables
	$response			= array();
	$post				= isset( $_POST[$this->plugin_post] ) &&  $_POST[$this->plugin_post]!=null ? $_POST[$this->plugin_post] : $_POST;
	$task_id			= intval ( $post['task_id'] );
	$special_char = array ( ' ', '(', ')', '-' );
	$sql = 'SELECT
				T04.short_name as customer_short_name,
				T02.sid as sid,
				T01.title as plan_title,
				T02.id as plan_id,
				T00.start_datetime as task_start_datetime,
				T00.end_datetime as task_end_datetime,
				T00.comments as task_comments,
				T05.short_name as status_short_name,
				T05.id as status_id,
				T05.icon as status_icon,
				T06.short_name_es as service_short_name
			FROM
				' . $this->tbl_name . ' as T00
				LEFT JOIN ' . $NOVIS_CSI_CMP->tbl_name . ' as T01
					ON T00.cmp_id = T01.id
				LEFT JOIN ' . $NOVIS_CSI_CUSTOMER_SYSTEM->tbl_name . ' as T02
					ON T00.customer_system_id = T02.id
				LEFT JOIN ' . $NOVIS_CSI_SAPCUSTNO->tbl_name . ' as T03
					ON T02.sapcustno = T03.sapcustno
				LEFT JOIN ' . $NOVIS_CSI_CUSTOMER->tbl_name . ' as T04
					ON T03.customer_id = T04.id
				LEFT JOIN ' .$NOVIS_CSI_CMP_TASK_STATUS->tbl_name . ' as T05
					ON T00.status_id = T05.id
				LEFT JOIN ' . $NOVIS_CSI_SERVICE->tbl_name . ' as T06
					ON T00.service_id = T06.id
			WHERE
				T00.id = "' . $task_id . '"
	';
	$task = $wpdb->get_row ( $sql );
	//--------------------------------------------------------------------------
	$start_datetime = new DateTime ( $task->task_start_datetime );
	$end_datetime = new DateTime ( $task->task_end_datetime );
	$duration = date_diff ( $end_datetime, $start_datetime );
	//--------------------------------------------------------------------------
	$sql = 'SELECT * FROM ' . $NOVIS_CSI_CMP_TASK_STEP_TYPE->tbl_name . ' ORDER BY step_type_order ASC';
	$step_types = $this->get_sql ( $sql );
	//--------------------------------------------------------------------------
	$o = '
	<div class="container">
		<p class="row lead hidden-print">
			<a href="#!showplan?plan_id=' . $task->plan_id . '">
				<i class="fa fa-chevron-left"></i> Volver al plan <i>' . $task->plan_title . '</i>
			</a>
		</p>
		<div class="page-header row">
			<h2 class="">Solicitud de Cambio <small>' . $task->customer_short_name . ' - ' . $task->sid . '</small></h2>
		</div>
		<div class="row">
			<p class="text-muted hidden-print"><i class="fa fa-clock-o"></i> Cristian Marin solicitó la aprobación CAB Novis hace el 23/04/2017 21:30hrs.</p>
			<p class="text-right hidden-print">
				<a href="#" class="btn btn-default">
					<i class="fa fa-download"></i> Descargar como documento <i>Change Request</i>
				</a>
			</p>
		</div>
		<div class="row">
			<ul class="nav nav-tabs">
			<li role="presentation" class="active">
				<a href="#csi-cmp-task-' . $task_id . '-task-info" role="tab" data-toggle="tab">
					<span class="visible-xs">Cambio</span>
					<span class="hidden-xs">Información del Cambio</span>
				</a>
			</li>
				<li role="presentation" class="">
					<a href="#csi-cmp-task-' . $task_id . '-step-list" role="tab" data-toggle="tab">
						<span class="visible-xs">Act.</span>
						<span class="hidden-xs">Plan de Actividades</span>
					</a>
				</li>
				<li role="presentation">
					<a href="#csi-cmp-task-' . $task_id . '-contact-list" role="tab"data-toggle="tab">
						<span class="visible-xs">Escalamiento</span>
						<span class="hidden-xs">Matriz de Escalamiento</span>
					</a>
				</li>
			</ul>
			<div class="tab-content">
				<div role="tabpanel" class="tab-pane active" id="csi-cmp-task-' . $task_id . '-task-info">
					<div class="panel panel-default">
						<div class="panel-heading">
							<i class="fa fa-fw fa-info"></i> Informaci&oacute;n del Cambio
						</div>
						<div class="panel-body row">
							<div class="col-xs-12 col-sm-6">
								<div class="panel panel-default">
									<div class="panel-heading">
										<i class="fa fa-file-text-o"></i> Descripci&oacute;n detallada
										<span class="pull-right">
											<a href="#" class="refresh-button"><i class="fa fa-fw fa-pencil"></i></a>
										</span>
									</div>
									<table class="table table-condensed">
										<tbody>
											<tr>
												<th class="small text-muted">Cliente</th>
												<td>' . $task->customer_short_name . '</td>
											</tr>
											<tr>
												<th class="small text-muted">Plan</th>
												<td>
													' . $task->plan_title . '
													<small>(<a href="#" class="csi-popup" data-action="csi_cmp_popup_cmp_info" data-plan-id="' . $task->plan_id . '">#PCM_' . $task->plan_id . '</a>)</small>
												</td>
											</tr>
											<tr>
												<th class="small text-muted">Servicio Relacionado</th>
												<td><small>' . ( '' != $task->service_short_name ? $task->service_short_name : '--' ) . '</small></td>
											</tr>
											<tr>
												<th class="small text-muted">Ventana de Ejecución</th>
												<td>
													' . $start_datetime->format ( 'd/m H:i') . ' hrs<br/>
													<small>
														Duraci&oacute;n: <code>' . $duration->h . ':' . sprintf ( "%02s", $duration->m ) . 'hrs</code>
													</small>
												</td>
											</tr>
											<tr>
												<th class="small text-muted">Comentarios</th>
												<td>' . $task->task_comments . '</td>
											</tr>
										</tbody>
									</table>
									<div class="panel-body">
										<p><strong>Descripci&oacute;n del Cambio</strong></p>
										<samp><small>El sistema BPP tiene la versión de Kernel 7.20-400. El nivel de parche será modificado a 7.20-620.</small></samp>
									</div>
									<table class="table table-condensed">
										<thead>
											<tr>
												<th colspan="999" class="">Detalle de Cambio</th>
											</tr>
											<tr>
												<th><a href="#" class="text-success"><i class="fa fa-plus fa-fw"></i></a></th>
												<th>Elemento BPP</th>
												<th>Valor actual</th>
												<th>Valor propuesto</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td><a href="#" class="text-danger"><i class="fa fa-minus fa-fw"></i></a></td>
												<td>Kernel Patch Level</td>
												<td>7.20-400</td>
												<td>7.20-600</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
							<div class="col-xs-12 col-sm-6">
								<div class="panel panel-default">
									<div class="panel-heading">
										<i class="fa fa-flag"></i> Aprobaciones
									</div>
									<ul class="list-group">
										<li class="list-group-item">
											<p class="text-justify">Este cambio está aún en construcci&oacute;n.<br/>Si ya has terminado de documentar el cambio acorde a las <a href="#" target="_blank"> Reglas de Solcitud de Cambio <i class="fa fa-external-link"></i></a> puedes solicitar la aprobación del CAB NOVIS.</p>
											<p class="text-center"><a href="#" class="btn btn-default btn-sm disabled">Solicitar aprobación CAB NOVIS</a></p>
										</li>
										<!--
										<li class="list-group-item list-group-item-warning">
											Solicitud de aprobación CAB NOVIS enviada el 23/04/2017 21:30hrs
										</li>
										<li class="list-group-item list-group-item-success">
											Change Manager
											<span class="pull-right">
												<a href="#" class="text-success"><i class="fa fa-comment"></i></a>
												<span class="label label-success" title="Aprobada el 24/04/2017 09:34hrs">Aprobada</span>
											</span>
										</li>
										<li class="list-group-item">
											L&iacute;der T&eacute;cnico <span class="label label-default pull-right">Pendiente</span>
										</li>
										-->
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div role="tabpanel" class="tab-pane" id="csi-cmp-task-' . $task_id . '-step-list">
					<h3>
						<i class="fa fa-gear"></i> Plan de Actividades
						<a href="#" class="btn btn-warning btn-xs hidden-print">
							<i class="fa fa-magic"></i> Importar
						</a>
					</h3>';
	foreach ( $step_types as $step_type ){
		$o.='
		<div class="panel panel-' . $step_type['css_class'] . '">
			<div class="panel-heading">
				 Pasos de ' . $step_type['short_name'] . '
				<span class="pull-right hidden-print">
					<a href="#csi-cmp-fetch-task-step-list-info-' . $step_type['id'] . '" class="refresh-button text-' . $step_type['css_class'] . '"><i class="fa fa-fw fa-refresh"></i></a>
				</span>
			</div>
			<table class="table table-condensed refreshable" id="csi-cmp-fetch-task-step-list-info-' . $step_type['id'] . '" data-action="csi_cmp_fetch_task_step_list_info" data-step-type-id="' . $step_type['id'] . '" data-task-id="' . $task_id . '" style="position:relative;">
				<thead>
					<tr>
						<th class="">Descripci&oacute;n</th>
						<th class="">Ejecutor</th>
						<th class=" text-center">Tiempo Plan</th>
						<th class=" text-center">Status</th>
					</tr>
				</thead>
				<tbody style="position:relative;">
				</tbody>
			</table>
		</div>
		';
	}
	$o.='

				</div><!-- div#csi-cmp-task-' . $task_id . '-step-list -->
				<div role="tabpanel" class="tab-pane" id="csi-cmp-task-' . $task_id . '-contact-list">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<i class="fa fa-address-book"></i> Matriz de Escalamiento
					</div>
					<div class="panel-body">
						<ul class="list-group">
							<li class="list-group-item list-group-item-info">
								<span class="pull-right"><a href="#" class="text-info"><i class="fa fa-pencil"></i></a></span>
								<i class="fa fa-phone-square fa-lg"></i> Conferencia ZOOM Disponible (874-248-3833)<br/>
							</li>
							<li class="list-group-item">
								Ingresa directamente desde tu navegador o aplicación:
								 <a class="" href="https://novis.zoom.us/j/8742483833" target="_blank">874-248-3833</a>
							</li>
							<li class="list-group-item">
								M&eacute;xico:
								<a href="tel:+525541614288,8742483833#" title="Ingresa directamente desde tu dispositivo m&oacute;vil en M&eacute;xico">
									<i class="fa fa-phone"></i> +52 55 4161-4288 , 874-248-3833#
								</a>
							</li>
							<li class="list-group-item">
								Chile:
								<a href="tel:+56412560288,8742483833#" title="Ingresa directamente desde tu dispositivo m&oacute;vil en Chile">
									<i class="fa fa-phone"></i> +56 41 256-0288 , 874-248-3833#
								</a>
							</li>
							<li class="list-group-item">
								Per&uacute;:
								<a href="tel:+5117075788,8742483833#" title="Ingresa directamente desde tu dispositivo m&oacute;vil en Per&uacute;">
									<i class="fa fa-phone"></i> +51 1 707-5788 , 874-248-3833#
								</a>
							</li>
							<li class="list-group-item">
								Más números internacionales disponibles en el <a target="_blank" href="https://novis.zoom.us/zoomconference">sitio de zoom <i class="fa fa-external-link"></i></a>
							</li>
						</ul>
					</div>
					<table class="table table-condensed">
						<thead>
							<tr>
								<th><a href="#" class="text-success"><i class="fa fa-plus fa-fw"></i></a></th>
								<th>Empresa</th>
								<th>Nombre</th>
								<th>Desc</th>
								<th>EMail</th>
								<th>Contacto</th>
							</tr>
						</thead>
						<tbody>
						';
	$sql = 'SELECT
				T01.internal_user_id as task_executor_id,
				T02.phone_no as executor_phone,
				T03.user_email as executor_email,
				T03.display_name as executor_display_name
			FROM
				' . $this->tbl_name . ' as T00
				LEFT JOIN ' . $NOVIS_CSI_CMP_TASK_STEP->tbl_name . ' as T01
					ON T01.cmp_task_id = T00.id
					AND T01.internal_executor_flag = 1
				LEFT JOIN ' . $NOVIS_CSI_USER->tbl_name . ' as T02
					ON T01.internal_user_id = T02.id
				LEFT JOIN ' . $wpdb->base_prefix . 'users as T03
					ON T03.ID = T02.id
			WHERE
				T00.id = "' . $task_id . '"
				AND T02.id != ""
				AND T02.id != "0"
			';
	$internal_executors = $this->get_sql ( $sql );
	$internal_contact = '';
	foreach ( $internal_executors as $internal_executor ){
		$internal_contact.='
		<tr class="active">
			<td>&nbsp;</td>
			<td>NOVIS</td>
			<td>' . $internal_executor['executor_display_name'] . '</td>
			<td>Ejecutor</td>
			<td>
				<a href="mailto:' . $internal_executor['executor_email'] . '">
					<i class="fa fa-envelope-o"></i> ' . $internal_executor['executor_email'] . '
				</a>
			</td>
			<td>
				<a href="tel:' . str_replace ( $special_char, '', $internal_executor['executor_phone'] ). '">
					<i class="fa fa-phone"></i> ' . $internal_executor['executor_phone'] . '
				</a>
			</td>
		</tr>
		';
	}
	$o.= $internal_contact;
	$o.='
							<tr>
								<td><a href="#" class="text-danger"><i class="fa fa-minus fa-fw"></i></a></td>
								<td>IBM</td>
								<td>Javier Martinez</td>
								<td>Ejecutor IBM</td>
								<td>
									<a href="mailto:javier.martinez@ibm.com">
										<i class="fa fa-envelope-o"></i> javier.martinez@ibm.com
									</a>
								</td>
								<td>
									<a href="tel:+5215541902921">
										<i class="fa fa-phone"></i> +52 1 (55) 4190-2921
									</a>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				</div><!-- div#csi-cmp-task-' . $task_id . '-contact-list -->

		</div>
	</div><!-- div.container -->

	';

	$response['message'] = $o;
	echo json_encode($response);
	wp_die();
}
//END OF CLASS
}

global $NOVIS_CSI_CMP_TASK;
$NOVIS_CSI_CMP_TASK =new NOVIS_CSI_CMP_TASK_CLASS();
?>