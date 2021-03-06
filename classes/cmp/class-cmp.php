<?php
defined('ABSPATH') or die("No script kiddies please!");

class NOVIS_CSI_CMP_CLASS extends NOVIS_CSI_CLASS{

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
	$this->class_name	= 'cmp';
	//Nombre singular para títulos, mensajes a usuario, etc.
	$this->name_single	= 'Plan';
	//Nombre plural para títulos, mensajes a usuario, etc.
	$this->name_plural	= 'Planes';
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
	$this->db_version	= '0.1.0';
	//Reglas actuales de caracteres a nivel de DB.
	//Dado que esto sólo se usa en la cración de la tabla
	//no se guarda como variable de clase.
	$charset_collate	= $wpdb->get_charset_collate();
	//Sentencia SQL de creación (y ajuste) de la tabla de la clase
	$this->crt_tbl_sql_wt	="(
								id mediumint unsigned not null auto_increment COMMENT 'Unique ID for each entry',
                                customer_id int unsigned not null COMMENT 'Customer ID',
                                title varchar(100) not null COMMENT 'Title text',
                                description varchar(255) null COMMENT 'Description text',
                                manager_user_id bigint(20) unsigned not null COMMENT 'Id of user responsible of this plan',
                                manager_user_email varchar(100) not null COMMENT 'Email of user. Used to track user if user id is deleted',
                                source_tags varchar(255) null COMMENT 'Tags to add sources of the plan',
								creation_user_id bigint(20) unsigned null COMMENT 'Id of user responsible of the creation of each record',
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
		'customer_id' => array(
			'type'						=>'nat_number',
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
		'title' => array(
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
        'description' => array(
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
        'source_tags' => array(
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
		'manager_user_id' => array(
			'type'						=>'nat_number',
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
		'manager_user_email' => array(
			'type'						=>'text',
			'backend_wp_in_table'		=>false,
			'backend_wp_sp_table'		=>false,
			'backend_wp_table_lead'		=>false,
			'data_required'				=>false,
			'data_validation'			=>true,
			'data_validation_min'		=>false,
			'data_validation_max'		=>false,
			'data_validation_maxchar'	=>100,
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

	add_action( 'wp_ajax_csi_cmp_build_page_intro',				array( $this , 'csi_cmp_build_page_intro'			));
	add_action( 'wp_ajax_csi_cmp_build_page_list_plans',		array( $this , 'csi_cmp_build_page_list_plans'		));
	add_action( 'wp_ajax_csi_cmp_build_page_new_plan_form',		array( $this , 'csi_cmp_build_page_new_plan_form'	));
	add_action( 'wp_ajax_csi_cmp_build_page_create_plan',		array( $this , 'csi_cmp_build_page_create_plan'		));
	add_action( 'wp_ajax_csi_cmp_fetch_filtered_plan_table',	array( $this , 'csi_cmp_fetch_filtered_plan_table'	));
	add_action( 'wp_ajax_csi_cmp_build_page_show_plan',			array( $this , 'csi_cmp_build_page_show_plan'		));
	add_action( 'wp_ajax_csi_cmp_fetch_plan_info',				array( $this , 'csi_cmp_fetch_plan_info'			));
	add_action( 'wp_ajax_csi_cmp_build_page_new_task_form',		array( $this , 'csi_cmp_build_page_new_task_form'	));



}
public function csi_cmp_fetch_filtered_plan_table(){
	//Global Variables
	global $NOVIS_CSI_CUSTOMER;
	global $wpdb;
	//Local Variables
	$response			= array();
	$tbody				= '';
	$sql = 'SELECT
				*,
				T00.id as plan_id,
				T00.manager_user_id as manager_id,
				T01.short_name as customer_name,
				T01.code as customer_code,
				T02.user_login as user_name

			FROM
			' . $this->tbl_name . ' as T00
			LEFT JOIN ' . $NOVIS_CSI_CUSTOMER->tbl_name . ' as T01
				ON T01.id = T00.customer_id
			LEFT JOIN ' . $wpdb->prefix . 'users as T02
				ON T00.manager_user_id = T02.id

	';
	$plans = $this->get_sql($sql);
	foreach ( $plans as $plan ){
		$tbody .= '
			<tr>
				<td>' . $plan['plan_id'] . '</td>
				<td>Pais</td>
				<td>' . $plan['customer_name'] . ' <small>(' . strtoupper ( $plan['customer_code'] ) .')</small></td>
				<td><a href="#!showplan?plan_id=' . $plan['plan_id'] . '&otra=wea"><small>' . $plan['title'] . '<small></a></td>
				<td><a href="#" class="user-data" data-user-id="' . $plan['manager_id'] . '" title="M&aacute;s informaci&oacute;n"><small><i class="fa fa-id-card-o"></i> ' . $plan['user_name'] . '</a></td>
				<td>tareas</td>
			</tr>
		';
	}
	$response['tbody'] = $tbody;
	echo json_encode($response);
	wp_die();
}
public function csi_cmp_build_page_show_plan(){
	//Global Variables
	global $NOVIS_CSI_CUSTOMER;
	global $NOVIS_CSI_PROJECT_STATUS;
	global $wpdb;
	//Local Variables
	$insertArray			= array();
	$response				= array();
	$post					= isset( $_POST[$this->plugin_post] ) &&  $_POST[$this->plugin_post]!=null ? $_POST[$this->plugin_post] : $_POST;
	# Validate user capability ??
	$plan_id 				= intval($post['plan_id']);
	$current_user			= get_userdata ( get_current_user_id() );
	$current_datetime		= new DateTime();
	if ( 0 < $plan_id ){
		$sql = 'SELECT
					*,
					T00.id as plan_id,
					T00.title as plan_title,
					T00.last_modified_user_id as plan_last_modified_user_id,
					T00.last_modified_date as plan_last_modified_date,
					T00.last_modified_time as plan_last_modified_time,
					T00.creation_user_id as plan_creation_user_id,
					T00.creation_date as plan_creation_date,
					T00.creation_time as plan_creation_time,
					T00.manager_user_id as manager_id,
					T01.short_name as customer_name,
					T01.code as customer_code,
					T02.user_login as user_name

				FROM
				' . $this->tbl_name . ' as T00
				LEFT JOIN ' . $NOVIS_CSI_CUSTOMER->tbl_name . ' as T01
					ON T01.id = T00.customer_id
				LEFT JOIN ' . $wpdb->prefix . 'users as T02
					ON T00.manager_user_id = T02.id
				WHERE
					T00.id = "' . $plan_id . '"

		';
		$plan = $wpdb->get_row($sql);
		if ( NULL == $plan->plan_last_modified_user_id){
			$last_modified_user	= NULL;
			$creation_user = get_userdata ( $plan->plan_creation_user_id );
		}else{
			$last_modified_user = get_userdata ( $plan->plan_last_modified_user_id );
			$creation_user = NULL;
		}
	}else{

	}

	if ( NULL == $last_modified_user ){
		$modif_text = $creation_user->user_nicename . ' cre&oacute; el plan';
		$modif_datetime = new DateTime($plan->plan_creation_date . ' ' . $plan->plan_creation_time );
	}else{
		$modif_text = $last_modified_user->user_nicename . ' modific&oacute; las propiedades del plan';
		$modif_datetime = new DateTime($plan->plan_last_modified_date . ' ' . $plan->plan_last_modified_time );
	}
	$current_datetime = new DateTime();
	//last_action_time
	$lat = date_diff($modif_datetime, $current_datetime);
	if ( 0 != $lat->y ){
		if ( 0 != $lat->m ){
			$last_action_time_text = 'm&aacute;s de ' . $lat->y . ' a&ntilde;os';
		}else{
			$last_action_time_text = $lat->y . ' a&ntilde;os';
		}
	}else{
		if ( 0 != $lat->m ){
			$last_action_time_text = $lat->m . ' meses';
		}else{
			if ( 0 != $lat->d ){
				$last_action_time_text = $lat->d . ' d&iacute;as';
			}else{
				$last_action_time_text = ' ' . $lat->h . ' horas';
			}
		}
	}


	$o='
	<div id="csi-template-cmp-control-center-show-plan" class="container">
		<div class="page-header">
			<h2>' . $plan->plan_title . ' <small>' . $plan->customer_code . '</small></h2>
			<p class="text-muted hidden-print"><i class="fa fa-clock-o"></i> ' . $modif_text . ' hace ' . $last_action_time_text . '.</p>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
				<div class="panel panel-default">
					<div class="panel-heading">
						<i class="fa fa-fw fa-info"></i> Información del Plan
						<div class="pull-right">
							<a href="#csi-cmp-fetch-plan-info" class="refresh-button"><i class="fa fa-fw fa-refresh"></i></a>
							|
							<a data-toggle="collapse" href="#plan-info" role="button">
								<i class="fa fa-fw fa-caret-down"></i>
							</a>
						</div>
					</div>
					<div id="plan-info" class="collapse">
						<table class="table table-condensed refreshable" style="position:relative;" id="csi-cmp-fetch-plan-info" data-action="csi_cmp_fetch_plan_info" data-plan-id="' . $plan_id . '">
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
				<div class="panel panel-default">
					<div class="panel-heading">
						<i class="fa fa-fw fa-folder-o"></i> Documentos asociados
						<div class="pull-right">
							<a href="#"><i class="fa fa-fw fa-refresh"></i></a>
							|
							<a data-toggle="collapse" href="#plan-3-docs" role="button">
								<i class="fa fa-fw fa-caret-down"></i>
							</a>
						</div>
					</div>
					<div class="list-group collapse" id="plan-3-docs">
						<a class="list-group-item" target="_blank" href="#">
							Documento 1
							<div class="pull-right">
								<span class="fa fa-fw text-info fa-cloud-download"></span>
							</div>
						</a>
						<a class="list-group-item" target="_blank" href="#">
							Documento 1
							<div class="pull-right">
								<span class="fa fa-fw text-info fa-cloud-download"></span>
							</div>
						</a>
						<a class="list-group-item" target="_blank" href="#">
							Documento 1
							<div class="pull-right">
								<span class="fa fa-fw text-info fa-cloud-download"></span>
							</div>
						</a>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
				<div class="panel panel-default">
					<div class="panel-heading">
						<i class="fa fa-fw fa-tasks"></i> Actividades
						<div class="pull-right">
							<a href="#"><i class="fa fa-fw fa-refresh"></i></a>
							|
							<a data-toggle="collapse" href="#plan-3-tasks" role="button">
								<i class="fa fa-fw fa-caret-down"></i>
							</a>
						</div>
					</div>
					<ul class="list-group collapse" id="plan-3-tasks">
						<li class="list-group-item">
							<span class="text-center lead">Avance del Plan</span>
							<div class="progress">
								<div class="progress-bar progress-bar-info progress-bar-striped active" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
									60%
								</div>
							</div>
							<small>Este valor refleja el porcentaje de tareas de ejecución efecutadas contra las por ejecutar.</small>
						</li>
						<li class="list-group-item">012: Propuestas</li>
						<li class="list-group-item">002: VoBo Cliente</li>
						<li class="list-group-item">010: Programado</li>
						<li class="list-group-item">001: En Ejecuci&oacute;n</li>
						<li class="list-group-item">002: Suspendidas</li>
						<li class="list-group-item">025: Ejecutadas</li>
						<li class="list-group-item">000: Vueltra Atrás</li>
						<li class="list-group-item">001: Canceladas</li>
					</ul>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
				<div class="panel panel-default">
					<div class="panel-heading">
						<i class="fa fa-fw fa-users"></i> Ejecutores
						<div class="pull-right">
							<a href="#"><i class="fa fa-fw fa-refresh"></i></a>
							|
							<a data-toggle="collapse" href="#plan-3-tasks-type" role="button">
								<i class="fa fa-fw fa-caret-down"></i>
							</a>
						</div>
					</div>
					<ul id="plan-3-tasks-type" class="list-group collapse">
						<li class="list-group-item">Cristian Marin <span class="badge">12</span></li>
						<li class="list-group-item">Ricardo De Acha <span class="badge">8</span></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="">
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-fw fa-book"></i> Logs
					<div class="pull-right">
						<a href="#"><i class="fa fa-fw fa-plus"></i></a>
						|
						<a href="#"><i class="fa fa-fw fa-refresh"></i></a>
						|
						<a data-toggle="collapse" href="#plan-3-log" role="button">
							<i class="fa fa-fw fa-caret-down"></i>
						</a>
					</div>
				</div>
				<div id="plan-3-log" class="collapse">
					<table class="table table-condensed table-striped" style="margin:0;">
						<tbody>
							<tr>
								<th class="small">23/09/2016 13:56hrs</th>
								<td class="small">Cristian Marin</td>
								<td class="small">El cliente ha solicitado suspender la actividad <a href="#">#46764</a></td>
							</tr>
							<tr>
								<th class="small">28/09/2016 13:56hrs</th>
								<td class="small">Cristian Marin</td>
								<td class="small">El cliente ha solicitado suspender la actividad <a href="#">#46764</a> por Falta de autorización del equipo funcional y del área de Negocios.</td>
							</tr>
							<tr>
								<th class="small">30/09/2016 13:56hrs</th>
								<td class="small">Cristian Marin</td>
								<td class="small">El cliente ha solicitado suspender la actividad <a href="#">#46764</a></td>
							</tr>
						</tbody>
						<tfoot>
							<tr>
								<td colspan="999" class="text-center small">
									<nav aria-label="Page navigation">
										<ul class="pagination" style="margin:0;">
											<li>
												<a href="#" aria-label="Previous">
													<span aria-hidden="true">&laquo;</span>
												</a>
											</li>
											<li><a href="#">1</a></li>
											<li><a href="#">2</a></li>
											<li><a href="#">3</a></li>
											<li><a href="#">4</a></li>
											<li><a href="#">5</a></li>
											<li>
												<a href="#" aria-label="Next">
													<span aria-hidden="true">&raquo;</span>
												</a>
											</li>
										</ul>
									</nav>
								</td>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<p class="text-right">
					<button class="btn btn-primary btn-xs">
						<i class="fa fa-filter"></i> Filtrar
					</button>
				</p>
			</div>
			<table class="table table condensed">
				<thead>
					<tr>
						<th><i class="fa fa-hashtag"></i></th>
						<th class="hidden-xs">Landscape</th>
						<th class="hidden-xs">Ambiente</th>
						<th>SID</th>
						<th>Ticket</th>
						<th>Status</th>
						<th>Inicio</th>
						<th>Duraci&oacute;n</th>
						<th>Log</th>
						<th>Opciones</th>
					</tr>
					<tr class="csi-template-table-filter collapse">
						<th>&nbsp;</th>
						<th class="hidden-xs">&nbsp;</th>
						<th class="hidden-xs">&nbsp;</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td colspan="999" class="text-center">
							<a href="#!addtask?plan_id=' . $plan_id . '" class="btn btn-success">
								<i class="fa fa-plus"></i> Agregar Tarea
							</a>
						</td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<th><i class="fa fa-hashtag"></i></th>
						<th class="hidden-xs">Landscape</th>
						<th class="hidden-xs">Ambiente</th>
						<th>SID</th>
						<th>Ticket</th>
						<th>Status</th>
						<th>Inicio</th>
						<th>Duraci&oacute;n</th>
						<th>Log</th>
						<th>Opciones</th>
					</tr>
				</tfoot>
			</table>
			<div style="position:relative;">
				<div id="csi-template-cmp-control-center-table-pagination" class="text-center"></div>
			</div>
		</div>
	</div>

	';
	$response['message'] = $o;
	echo json_encode($response);
	wp_die();

}
public function csi_cmp_fetch_plan_info(){
	//Global Variables
	global $NOVIS_CSI_CUSTOMER;
	global $wpdb;
	//Local Variables
	$post				= isset( $_POST[$this->plugin_post] ) &&  $_POST[$this->plugin_post]!=null ? $_POST[$this->plugin_post] : $_POST;
	$response			= array();
	$plan_id 			= intval ( $post['planId'] );
	$sql='SELECT
			*,
			T00.manager_user_id as plan_manager_user_id,
			T01.short_name as customer_name,
			T01.code as customer_code
		FROM
			' . $this->tbl_name . ' as T00
			LEFT JOIN ' . $NOVIS_CSI_CUSTOMER->tbl_name . ' as T01
				ON T00.customer_id = T01.id
		WHERE
			T00.id = "' . $plan_id . '"
	';
	$plan = $wpdb->get_row($sql);
	$manager_user = get_userdata ( $plan->plan_manager_user_id);
	$o='
	<tr>
		<th class="small">Cliente</th>
		<td>' . $plan->customer_name . '</td>
	</tr>
	<tr>
		<th class="small">Responsable</th>
		<td><a href="#" class="user-data" data-user-id="' . $plan->plan_manager_user_id . '" title="M&aacute;s informaci&oacute;n"><i class="fa fa-id-card-o"></i> ' .  $manager_user->user_nicename . '</a></td>
	</tr>
	<tr>
		<th class="small">Actividad</th>
		<td>
			<ul class="list-unstyled">
				<li><i class="fa fa-fw fa-flag-o"></i> 24 / Febrero / 2017</li>
				<li><i class="fa fa-fw fa-flag-checkered"></i> 24 / Marzo / 2017</li>
			</ul>
		</td>
	</tr>
	<tr>
		<th class="small">Esfuerzo</th>
		<td class="">
			<ul class="list-unstyled">
				<li><strong>32</strong> HH - Invertidas</li>
				<li><strong>58</strong> HH - Planificadas</li>
				<li><strong>90</strong> HH - Total</li>
			</ul>
		</td>
	</tr>
	<tr>
		<th class="small">Avance</th>
		<td>
			<div class="progress">
				<div class="progress-bar progress-bar-info progress-bar-striped active" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
					60%
				</div>
			</div>
		</td>
	</tr>

	';
	$response['tbody'] = $o;
	echo json_encode($response);
	wp_die();

}
public function csi_cmp_build_page_intro(){
	//Global Variables
	//Local Variables
	$response			= array();
	$o = '
		<div class="jumbotron">
			<div class="container">
				<h2>Plan de Correcci&oacute;n o Mantenimiento</h2>
				<p>M&oacute;dulo de registro y control de actividades técnicas para la gesti&oacute;n del Equipo de Operaciones de NOVIS.</p>
				<p><a class="btn btn-primary btn-lg" href="#!listplans" role="button">Aprender m&aacute;s</a></p>
			</div>
		</div>
		<nav class="container">
			<div class="row">
				<div class="list-group col-sm-6 col-md-4">
					<a href="#!listplans" class="list-group-item active">
						<h3><i class="fa fa-tasks"></i> PCM</h3>
						<p class="text-justify">Detalle de los Planes de Correcci&oacute;n o Mantenimiento registrados.</p>
					</a>
				</div>
				<div class="list-group col-sm-6 col-md-4">
					<a href="#" class="list-group-item list-group-item-success">
						<h3><i class="fa fa-dashboard"></i> Dashboards</h3>
						<p class="text-justify">Vsitas pre-fabricadas para la gestión de los Planes de Corrección o Mantenimiento.</p>
					</a>
				</div>
				<div class="list-group col-sm-6 col-md-4">
					<a href="#" class="list-group-item list-group-item-danger">
						<h3><i class="fa fa-calendar"></i> Calendario</h3>
						<p class="text-justify">Vista rápida de las próximas actividades por ejecutar acorde a los PCM de clientes.</p>
					</a>
				</div>
				<div class="list-group col-sm-6 col-md-4">
					<a href="#" class="list-group-item list-group-item-info">
						<h3><i class="fa fa-area-chart"></i> Capacity</h3>
						<p class="text-justify">Reportes de la capacidad del personal relacionado a las tareas.</p>
					</a>
				</div>
				<div class="list-group col-sm-6 col-md-4">
					<a href="#" class="list-group-item">
						<h3><i class="fa fa-user-o"></i> Mis Planes</h3>
						<p class="text-justify">Accede a los planes que has creado y los planes en los que has participado.</p>
					</a>
				</div>
				<div class="list-group col-sm-6 col-md-4">
					<a href="#" class="list-group-item list-group-item-warning">
						<h3><i class="fa fa-television"></i> Presentación</h3>
						<p class="text-justify">Reportes orientados a dar soporte a seguimiento periódico con clientes.</p>
					</a>
				</div>
			</div>
		</nav>
	';
	$response['message'] = $o;
	echo json_encode($response);
	wp_die();
}


public function csi_cmp_build_page_list_plans(){
	//Global Variables
	//Local Variables
	$response			= array();
	$o = '
	<div id="csi-template-cmp-control-center-list-plans" class="container">
        <div class="page-header row">
            <h3 class="col-sm-10">Planes de Corrección o Mantenimiento</h3>
			<h3 class="col-sm-2">
				<a href="#!addplan" class="btn btn-success" id="csi-template-cmp-add-new-plan">
					<i class="fa fa-plus"></i> Nuevo PCM
				</a>
			</h3>
        </div>
		<div>
			<h4><i class="fa fa-pie-chart"></i> Infogr&aacute;ficos</h4>
		</div>
		<div class="row panel panel-default">
            <div class="panel-body">
				<a href="#list-plans-saved-filter" data-toggle="collapse" >
					<strong class="panel-title">
						<i class="fa fa-filter"></i>
						Filtros
					</strong>
				</a>
				<div class="pull-right">
					<a href="#list-plans-new-filter" data-toggle="collapse" >
						<i class="fa fa-fw fa-plus"></i>
					</a>
				</div>
            </div>
			<div class="panel-body collapse" id="list-plans-saved-filter">
				<div class="panel panel-default">
					<div class="panel-heading">
						<a href="#list-plans-company-filter" data-toggle="collapse" >
							<strong class="">
								<i class="fa fa-building-o"></i>
								Filtros Est&aacute;ndar
							</strong>
						</a>
						<div class="pull-right">
							<a href="#">
								<i class="fa fa-fw fa-refresh"></i>
							</a>
							|
							<a href="#list-plans-company-filter" data-toggle="collapse" >
								<i class="fa fa-fw fa-caret-down"></i>
							</a>
						</div>
					</div>
					<ul class="list-group collapse" id="list-plans-company-filter">
						<li class="list-group-item">
							<a href="#">
								<i class="fa fa-filter"></i>
								Planes en curso
							</a>
							<div class="pull-right">
								<a href="#">
									<i class="fa fa-fw fa-minus-circle text-danger"></i>
								</a>
							</div>
						</li>
					</ul>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">
						<a href="#list-plans-own-filter" data-toggle="collapse" >
							<strong class="">
								<i class="fa fa-user-o"></i>
								Filtros <i>Cristian Marin</i>
							</strong>
						</a>
						<div class="pull-right">
							<a href="#">
								<i class="fa fa-fw fa-refresh"></i>
							</a>
							|
							<a href="#list-plans-own-filter" data-toggle="collapse" >
								<i class="fa fa-fw fa-caret-down"></i>
							</a>
						</div>
					</div>
					<ul class="list-group collapse" id="list-plans-own-filter">
						<li class="list-group-item">
							<a href="#">
								<i class="fa fa-filter"></i>
								Gentera - Esta semana
							</a>
							<div class="pull-right">
								<a href="#">
									<i class="fa fa-fw fa-minus-circle text-danger"></i>
								</a>
							</div>
						</li>
						<li class="list-group-item text-center">
							<a class="btn btn-sm btn-success" href="#list-plans-new-filter" data-toggle="collapse">
								<i class="fa fa-fw fa-plus"></i>
								Crear Filtro
							</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="panel-body collapse" id="list-plans-new-filter">
				<div class="panel panel-default">
					<div class="panel-heading">
						<strong class="">
							<i class="fa fa-filter"></i>
							Nuevo Filtro
						</strong>
						<div class="pull-right">
							<a href="#list-plans-new-filter" data-toggle="collapse" >
								<i class="fa fa-fw fa-times"></i>
							</a>
						</div>
					</div>
					<form class=" list-group">
						<div class="form-group list-group-item">
							<label class="sr-only">Id de Pa&iacute;s</label>
							<div class="input-group">
								<select class="form-control input-sm">
									<option>Id de Pa&iacute;s</option>
								</select>
								<div class="input-group-addon"><i class="fa fa-angle-right"></i></div>
								<select class="form-control input-sm">
									<option>es</option>
									<option>no es</option>
								</select>
								<div class="input-group-addon"><i class="fa fa-angle-right"></i></div>
								<select class="form-control input-sm">
									<option>Gentera</option>
								</select>
							</div>
						</div>
						<div class="list-group-item text-center">
							<button class="btn btn-default btn-sm">
								<i class="fa fa-plus"></i>
								Agregar campo
							</button>
						</div>
						<div class="list-group-item panel-footer text-right">
							<button class="btn btn-default btn-xs">
								<i class="fa fa-fw fa-save"></i>
								Guardar
							</button>
								<button class="btn btn-primary btn-xs">
									<i class="fa fa-fw fa-filter"></i>
									Filtrar
								</button>
						</div>
					</form>
				</div>
			</div>
		</div>
        <div class="panel panel-default row">
			<div class="panel-heading">
				<strong class="">
					<i class="fa fa-tasks"></i>
					Planes de Correcci&oacute;n o Mantenimiento
				</strong>
				<div class="pull-right">
					<a class="refresh-button" data-refresh-table="" href="#csi-template-cmp-filtered-plan-table">
						<i class="fa fa-fw fa-refresh"></i>
					</a>
				</div>
			</div>
			<div class="collapse in">
			</div>
            <table id="csi-template-cmp-filtered-plan-table" class="table table condensed refreshable" data-action="csi_cmp_fetch_filtered_plan_table">
                <thead>
                    <tr>
                        <th><small><i class="fa fa-hashtag"></i></small></th>
                        <th>Pa&iacute;s</th>
                        <th>Cliente</th>
                        <th>T&iacute;tulo</th>
                        <th>Responsable</th>
                        <th>Tareas</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                    <tr>
						<th><small><i class="fa fa-hashtag"></i></small></th>
                        <th>Pa&iacute;s</th>
                        <th>Cliente</th>
                        <th>T&iacute;tulo</th>
                        <th>Responsable</th>
                        <th>Tareas</th>
                    </tr>
                </tfoot>
            </table>
			<div style="position:relative;">
				<div id="csi-template-cmp-control-center-table-pagination" class="text-center"></div>
			</div>
        </div>
    </div>

	';
	$response['message'] = $o;
	echo json_encode($response);
	wp_die();
}
public function csi_cmp_build_page_create_plan(){
	//Global Variables
	global $NOVIS_CSI_CUSTOMER;
	global $NOVIS_CSI_PROJECT_STATUS;
	global $wpdb;
	//Local Variables
	$insertArray			= array();
	$response				= array();
	$post					= isset( $_POST[$this->plugin_post] ) &&  $_POST[$this->plugin_post]!=null ? $_POST[$this->plugin_post] : $_POST;
	# Validate user capability ??
	$current_user			= get_userdata ( get_current_user_id() );
	$manager_user			= get_userdata ( $post['manager_user_id'] );
	$current_datetime		= new DateTime();

	$insertArray['customer_id']				= strip_tags(stripslashes( $post['customer_id'] ));
	$insertArray['title']					= strip_tags(stripslashes( $post['title'] ));
	$insertArray['description']				= strip_tags(stripslashes( $post['description'] ));
	$insertArray['manager_user_id']			= strip_tags(stripslashes( $post['manager_user_id'] ));
	$insertArray['manager_user_email']		= $manager_user->user_email;
	$insertArray['source_tags']				= strip_tags(stripslashes( $post['source_tags'] ));
	$insertArray['creation_user_id']		= $current_user->ID;
	$insertArray['creation_user_email']		= $current_user->user_email;
	$insertArray['creation_date']			= $current_datetime->format('Y-m-d');
	$insertArray['creation_time']			= $current_datetime->format('H:i:s');

	if ( $wpdb->insert( $this->tbl_name, $insertArray ) ){
		$response['id']=$wpdb->insert_id;
//		$response['notifMessage']="El nuevo ".$this->name_single." ha sido guardado.";
		$plan_id = $wpdb->insert_id;
		//crear registro de documentos
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
		$response['postSubmitAction']	='changeHash';
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
public function csi_cmp_build_page_new_plan_form(){
	//Global Variables
	global $NOVIS_CSI_CUSTOMER;
	//Local Variables
	$sql = 'SELECT id,code,short_name FROM ' . $NOVIS_CSI_CUSTOMER->tbl_name . ' ORDER BY code ASC';
	$customer_opts = '';
	$customers = $this->get_sql($sql);
	foreach ( $customers as $customer ){
		$customer_opts .= '<option value="' . $customer['id'] . '">' . $customer['short_name'] . ' (' . $customer['code'] . ')</option>';
	}
	$response			= array();
	$o	='
	<div class="panel panel-default row">
		<div class="panel-heading">
		</div>
		<div class="panel-body">
			<form class="form-horizontal" data-function="csi_cmp_build_page_create_plan" data-next-page="listplans">
				<div class="form-group">
					<label for="customer_id" class="col-sm-2 control-label">Cliente</label>
					<div class="col-sm-10">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-fw fa-users"></i></span>
							<select class="form-control select2" id="customer_id" name="customer_id" required="true" data-placeholder="Selecciona el cliente">
								<option></option>
								<optgroup label="México">
									' . $customer_opts . '
								</optgroup>
							</select>
						</div>
						<span class="help-block">
							Todo <i>Plan de Correcci&oacute;n o Mantenimiento</i> debe ir asociado con un cliente.
							En el caso que quieras generar un plan interno debes indicar que el cliente es <strong>Novis</strong>.
						</span>
					</div>
				</div>
				<div class="form-group">
					<label for="title" class="col-sm-2 control-label">T&iacute;tulo</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="title" name="title" placeholder="T&iacute;tulo" required="true" />
						<span class="help-block">
							Titulo / nombre del Plan.<br/>
							Frecuentemente se utiliza una descripción sencilla como <small><code>Actualización de Kernel Q3 ' . date( 'Y' ) . '</code></small>.<br/>
							<small>Tama&ntilde;o m&aacute;ximo: 100 caracteres.</small>
						</span>
					</div>
				</div>
				<div class="form-group">
					<label for="description" class="col-sm-2 control-label">Descripci&oacute;n</label>
					<div class="col-sm-10">
						<textarea class="form-control" id="description" name="description" placeholder="Descripci&oacute;n"></textarea>
						<span class="help-block">
							Descripci&oacute;n breve del Plan de Correcci&oacute;n o Mantenimiento.<br/>
							<small>Tama&ntilde;o m&aacute;ximo: 255 caracteres.</small>
						</span>
					</div>
				</div>
				<div class="form-group">
					<label for="manager_user_id" class="col-sm-2 control-label">Responsable</label>
					<div class="col-sm-10">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-fw fa-user-o"></i></span>
							<select class="form-control select2" id="manager_user_id" name="manager_user_id" required="true" >
								<optgroup label="MXOPN2">
									<option value="1">Rogelio Roque</option>
									<option value="incidente">Otro mas</option>
								</optgroup>
								<optgroup label="Subdirectores">
									<option value="1" selected>Cristian Marin</option>
									<option value="incidente">Ricardo De Acha</option>
									<option value="incidente">Javier Caballero</option>
								</optgroup>
							</select>
						</div>
						<span class="help-block">
							Responsable del Plan de Correcci&oacute;n o Mantenimiento.<br/>
							<small class="text-danger"><i class="fa fa-exclamation-triangle"></i> Solo el responsable del plan puede realizar modificaciones posteriores.</Small>
						</span>
					</div>
				</div>
				<div class="form-group">
					<label for="source_tags" class="col-sm-2 control-label">Etiquetas de Origen</label>
					<div class="col-sm-10">
					<select class="form-control select2" data-tags="true" multiple id="source_tags" name="source_tags" required="true" data-placeholder="ewa incidente">
						<option value="ewa">ewa</option>
						<option value="incidente">incidente</option>
					</select>
						<span class="help-block">
							Las etiquetas de Origen, permiten indicar las causas que originaron la creación de este plan.<br/>
							<i class="fa fa-info"></i> Las etiquetas deben estar separadas por espacios.<br/>
							Opciones comunes son: <small><kbd>ewa</kbd> <kbd>incidente</kbd> <kbd>recomendaciones_sap</kbd></small>.<br/>
							<small>Tama&ntilde;o m&aacute;ximo: 100 caracteres.</small>
						</span>
					</div>
				</div>
				<div class="form-group">
					<label for="doc-plus" class="col-sm-2 control-label">Documentos relacionados</label>
					<div class="col-sm-10">
						<div class="input-group">
							<span class="input-group-btn">
								<button class="btn btn-danger">
									<i class="fa fa-minus-circle"></i>
								</button>
							</span>
							<span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
							<input type="text" class="form-control" placeholder="Descripci&oacute;n del Documento" />
							<span class="input-group-addon"><i class="fa fa-link"></i></span>
							<input type="text" class="form-control" placeholder="Doc. URL" />
						</div>
						<div class="text-center">
							<button class="btn btn-sm btn-success" id="doc-plus">
								<i class="fa fa-plus"></i> Agregar documento
							</button>
						</div>
						<span class="help-block">
							Los documentos relacionados permiten adjuntar enlaces a los documentos en los cuales se reflejan diferentes componentes del plan.<br/>
							Los siguientes documentos son recomendados:
							<ul>
								<li>Documento de Objetivos <i class="fa fa-question-circle text-info"></i></li>
								<li>Documento de Seguimiento <i class="fa fa-question-circle text-info"></i></li>
							</ul>
						</span>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-1 col-sm-10">
						<p class="text-muted text-justify">
							La creación de un Plan de Corrección o Mantenimiento aparecerá de modo inmediato en los planes del cliente seleccionado.
						</p>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10 text-right">
						<button type="reset" class="btn btn-danger">Cancelar</button>
						<button type="submit" class="btn btn-primary">Entiendo, Crear Plan</button>
					</div>
				</div>
			</form>
		</div>
	</div>

	';
	$response['message'] = $o;
	echo json_encode($response);
	wp_die();
}
public function csi_cmp_build_page_new_task_form(){
	//Global Variables
	global $NOVIS_CSI_CUSTOMER;
	global $NOVIS_CSI_CUSTOMER_SYSTEM;
	global $NOVIS_CSI_SAPCUSTNO;
	global $wpdb;
	//Local Variables
	$response			= array();
	$post				= isset( $_POST[$this->plugin_post] ) &&  $_POST[$this->plugin_post]!=null ? $_POST[$this->plugin_post] : $_POST;
	$plan_id			= intval ( $post['plan_id'] );

	$sql = 'SELECT
				*,
				T00.id as plan_id,
				T00.title as plan_title,
				T00.manager_user_id as manager_id,
				T01.short_name as customer_name,
				T01.code as customer_code,
				T01.id as customer_id

			FROM
			' . $this->tbl_name . ' as T00
			LEFT JOIN ' . $NOVIS_CSI_CUSTOMER->tbl_name . ' as T01
				ON T01.id = T00.customer_id
			WHERE
				T00.id = "' . $plan_id . '"
	';
	$plan = $wpdb->get_row($sql);
	$sql = 'SELECT
				T00.id as id,
				T00.sid as sid
			FROM
				' . $NOVIS_CSI_CUSTOMER_SYSTEM->tbl_name . ' as T00
				LEFT JOIN ' . $NOVIS_CSI_SAPCUSTNO->tbl_name . ' as T01
					ON T00.sapcustno = T01.sapcustno
				LEFT JOIN ' . $NOVIS_CSI_CUSTOMER->tbl_name . ' as T02
					ON T01.customer_id = T02.id
			WHERE
				T02.id = "' . $plan->customer_id . '"
	';
	$systems = $this->get_sql ( $sql );
	$systems_opt = '';
	foreach ( $systems as $system ){
		$systems_opt .='<option value="' . $system['id'] . '>' . $system['sid'] . '</option>';
	}
	$o='
	<!-- #AddTask -->
	<div id="csi-template-cmp-control-center-add-plan" class="container ">
		<div class="panel panel-default row">
            <div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-plus"></i> Agregar tarea</h3>
            </div>
			<div class="panel-body">
				<form class="form-horizontal">
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
								<p class="form-control">
									' . $plan->plan_title . '
									<small>
										(<a href="#">#' . $plan_id . '</a>)
									</small>
								</p>
							</div>
							<span class="help-block">
							</span>
						</div>
					</div>
					<div class="form-group">
						<label for="system" class="col-sm-2 control-label">Sistema</label>
						<div class="col-sm-10">
							<input type="hidden" id="system-id" />
							<select class="form-control select2" id="system" data-placeholder="Selecciona el sistema" required="true"">
								<option></option>
								' . $systems_opt . '
							</select>
							<span class="help-block">
								El sistema involucrado indica el sistema del cliente afectado en la actividad.<br/>
								En el caso que esta tarea afecte dos sistemas existen diferentes.
							</span>
						</div>
					</div>
					<div class="form-group">
						<label for="cmp-task-type" class="col-sm-2 control-label">Tipo de Tarea</label>
						<div class="col-sm-10">
							<select class="form-control" id="cmp-task-type" required="true">
								<option value="0" disabled >Seleccionar Tipo</option>
							</select>
							<span class="help-block">
								El tipo de tarea define el comportamiento de esta tarea en el proceso de evaluación de horas, y calendario <a href="#"><i class="fa fa-question-circle"></i></a>
							</span>
						</div>
					</div>
					<div class="form-group">
						<label for="activity-type" class="col-sm-2 control-label">Servicio a ejecutar</label>
						<div class="col-sm-10">
							<select  class="form-control select2" id="service-id" data-placeholder="Selecciona el Servicio a ejecutar" required="true">
								<option></option>
							</select>
							<span class="help-block">
								Si el servicio no aparece en la lista, selecciona <strong>Otros</strong>.
							</span>
						</div>
					</div>
					<div class="form-group">
						<label for="activity-availability" class="col-sm-2 control-label">¿Ventana Offline?</label>
						<div class="col-sm-10">
							<input type="checkbox" class="form-control" id="activity-availability"/>
							<span class="help-block">
								Indica si la actividad impacta la disponibilidad del sistema relacionado.
							</span>
						</div>
					</div>
					<div class="form-group">
						<label for="customer-visible" class="col-sm-2 control-label">Visible para Cliente</label>
						<div class="col-sm-10">
							<input type="checkbox" class="form-control" id="customer-visible"/>
							<span class="help-block">
								Si el campo est&aacute; seleccionado (dependiendo del <label for="cmp-task-type">Tipo de Tarea <i class="fa fa-chevron-circle-up"></i></label>) esta actividad es visible para el calendario del cliente.
							</span>
						</div>
					</div>
					<div class="form-group">
						<label for="task-description" class="col-sm-2 control-label">Observaciones</label>
						<div class="col-sm-10">
							<textarea class="form-control" id="task-description" placeholder="Observaciones adicionales"></textarea>
							<span class="help-block">
								Si el tipo de actividad es sincronizado con el calentadio, este texto aparecerá como contenido adicional en el evento.<br/>
								Tama&ntilde;o m&aacute;ximo: 255 caracteres.
							</span>
						</div>
					</div>
					<div class="form-group">
						<label for="task-status" class="col-sm-2 control-label">Status</label>
						<div class="col-sm-10">
							<select class="form-control" id="task-status">
								<option value="0" disabled="true">Seleccionar Status</option>
							</select>
							<span class="help-block">
								El status de la tarea define el comportamiento de esta esta tarea en el proceso de evaluación de horas, y calendario <a href="#"><i class="fa fa-question-circle"></i></a>
							</span>
						</div>
					</div>
					<div class="form-group">
						<label for="task-ticket" class="col-sm-2 control-label">Ticket</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="task-ticket" placeholder="5000012345" />
							<span class="help-block">
								El status de la tarea define el comportamiento de esta esta tarea en el proceso de evaluación de horas, y calendario <a href="#"><i class="fa fa-question-circle"></i></a>
							</span>
						</div>
					</div>
					<div class="form-group">
						<label for="manager" class="col-sm-2 control-label">Fecha y hora</label>
						<div class="col-sm-10">
							<input type="date" class="hidden" id="filter-date-start"/>
							<input type="date" class="hidden" id="filter-date-end"/>
							<div id="filter-date-range" class="text-center form-control text-right">
								<small><span class=""></span></small>&nbsp;<i class="fa fa-caret-down fa-fw"></i>
							</div>
							<span class="help-block">
								El campo de fecha y hora identifica el lapso de tiempo en el cual se desarrolla la tarea.
							</span>
						</div>
					</div>
					<div class="form-group">
						<label for="task-add-executor" class="col-sm-2 control-label">Ejecutores</label>
						<div class="col-sm-10">
							<div class="input-group">
								<span class="input-group-btn">
									<button class="btn btn-danger">
										<i class="fa fa-minus-circle"></i>
									</button>
								</span>
								<span class="input-group-addon"><i class="fa fa-user-o"></i></span>
								<input type="text" class="form-control" placeholder="Cristian Marin" />
								<span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
								<input type="number" class="form-control" placeholder="3 hrs" />
								<span class="input-group-addon">horas</span>
							</div>
							<button class="btn btn-block btn-info" id="task-add-executor">
								<i class="fa fa-plus-circle"></i> Agregar ejecutor
							</button>
							<span class="help-block">
								Los ejecutores de una actividad permiten la notificación previa en el calendario personal.<br/>
								Si el campo de tiempo de actividad en cada responsable se deja en blanco, el sistema asigna la duración total de la tarea. (<a href="#">Aprender m&aacute;s</a>).
							</span>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-10">
							<p class="text-muted text-justify">
								La creaci&oacute;n de un Plan de Correcci&oacute;n o Mantenimiento aparecer&aacute; de modo inmediato en los planes del cliente seleccionado.
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


	$response['message'] = $o;
	echo json_encode($response);
	wp_die();
}

//END OF CLASS
}

global $NOVIS_CSI_CMP;
$NOVIS_CSI_CMP =new NOVIS_CSI_CMP_CLASS();
?>
