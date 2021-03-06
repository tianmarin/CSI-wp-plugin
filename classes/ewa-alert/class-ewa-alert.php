<?php
defined('ABSPATH') or die("No script kiddies please!");

class NOVIS_CSI_EWA_ALERT_CLASS extends NOVIS_CSI_CLASS{

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
	$this->class_name	= 'ewa_alert';
	//Nombre singular para títulos, mensajes a usuario, etc.
	$this->name_single	= 'Alerta';
	//Nombre plural para títulos, mensajes a usuario, etc.
	$this->name_plural	= 'Alertas';
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
	$this->db_version	= '0.6.1';
	//Reglas actuales de caracteres a nivel de DB.
	//Dado que esto sólo se usa en la cración de la tabla
	//no se guarda como variable de clase.
	$charset_collate	= $wpdb->get_charset_collate();
	//Sentencia SQL de creación (y ajuste) de la tabla de la clase
	$this->crt_tbl_sql_wt	="(
								id bigint unsigned not null auto_increment COMMENT 'Unique ID for each entry',
								ewa_session_no bigint(13) unsigned not null COMMENT 'EWA session number',
								alert_group varchar(40) not null COMMENT 'EWA alert group text',
								alert_rating varchar(1) not null COMMENT 'EWA alert rating char',
								alert_no tinyint unsigned not null COMMENT 'EWA alert number',
								alert_text varchar(255) not null COMMENT 'EWA alert text',
								auto_asign bool null default 0 COMMENT 'Indicates if record was modified by automated process',
								hidden bool not null default 0 COMMENT 'Duplicate fields must be hidden by the system',
								action_party_id tinyint(2) unsigned null COMMENT 'Specify which action party is to be used',
								action_id varchar(50) null COMMENT 'Specify the identifier in the action party',
								customer_flag bool null COMMENT 'Specify if the execution of the action in on the customer side',
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
		'alert_group' => array(
			'type'						=>'text',
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
		'alert_rating' => array(
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
		'alert_no' => array(
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
		'alert_text' => array(
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
		'auto_asign' => array(
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
		'hidden' => array(
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
		'action_party_id' => array(
			'type'						=>'nat_number',
			'backend_wp_in_table'		=>false,
			'backend_wp_sp_table'		=>false,
			'backend_wp_table_lead'		=>false,
			'data_required'				=>false,
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
		'action_id' => array(
			'type'						=>'nat_number',
			'backend_wp_in_table'		=>false,
			'backend_wp_sp_table'		=>false,
			'backend_wp_table_lead'		=>false,
			'data_required'				=>false,
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
		'customer_flag' => array(
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
	
	register_activation_hook(CSI_PLUGIN_DIR."/index.php",		array( $this , 'db_install'					));
	//in a new blog creation, create the db for new blog
	//Applies only for non-network classes
	if( true != $this->network_class ){
		add_action( 'wpmu_new_blog',							array( $this , 'db_install'					));
	}
	add_action( 'wp_ajax_csi_ajax_template_ewa_control_center_update_alerts',				array( $this , 'csi_ajax_template_ewa_control_center_update_alerts'	));
	add_shortcode( 'csi_ewa_system_panel',				 		array( $this , 'shortcode_system_panel'		));
}
public function shortcode_system_panel($atts){
	global $wpdb;
	global $novis_csi_vars;
	$output		='';
	$system		= isset($atts['system']) && is_numeric($atts['system']) ? $atts['system'] : null;
	$weeks		= isset($atts['weeks']) && is_numeric($atts['weeks']) ? $atts['weeks'] : 8;
	$graph		= isset($atts['weeks']) && true == $atts['weeks'] ? true : false;
	
	if ( $system > 0 ){
		//Obtener información del Sistema
		global $NOVIS_CSI_EWA_ALERT_RATING;
		global $NOVIS_CSI_EWA_ACTION_PARTY;
		$output.='<div class="col-xs-12 col-sm-12 col-md-6">';
		$output.='<header>';
			$output.='<h3>CRP <small>CRM Productivo</small></h3>';
		
		$output.='</header>';

		$sql="SELECT
				id as id,
				issued_date as date,
				COUNT( IF( alert_priority_id = 1, 1, NULL ) ) as critical,
				COUNT( IF( alert_priority_id = 2, 1, NULL ) ) as warning
			FROM $this->tbl_name
			WHERE system_id=$system
			GROUP BY issued_date
			LIMIT $weeks
			";		
		if ( $graph ) {
			$dates = self::get_sql($sql);
			$dataProvider = array();
			foreach ( $dates as $date ){
				$date_data = array(
					'date'		=>$date['date'],
					'warning'	=>$date['warning'],
					'critical'	=>$date['critical'],
				);
				array_push($dataProvider, $date_data);
			}
			wp_register_script(
				'csiShortcodeProjectPanel',
				CSI_PLUGIN_URL.'/js/shortcodes/min/shortcode-project-panel-min.js' ,
				array('amcharts','amcharts-serial','amcharts-responsive'),
				'0.9.0'
			);
			wp_enqueue_script('csiShortcodeProjectPanel');
			wp_localize_script(
				'csiShortcodeProjectPanel',
				'csiShortcodeProjectPanel_'.'ewa_system_graph_'.$system,
				array(
					'ppost'							=> $this->plugin_post,
					'ajaxurl'						=> admin_url( 'admin-ajax.php' ),
					'ewa_system_graph_'.$system	=> json_encode($dataProvider),
				)
			);
			$output.='<section>';
				$output.='<div id="ewa_system_graph_'.$system.'" class="csi_ewa_system_panel" style="height:300px;"></div>';
			$output.='</section>';
		}
		$output.='<section>';
		$dates = self::get_sql($sql);
		foreach ( $dates as $date ){
			$beauty_date=date_create($date['date']);
			$beauty_date = date_format($beauty_date,"M d");
			$output.='<div class="panel panel-default container-fluid">
						<div class="panel-heading row">
							<div class="col-xs-3 text-center"><i class="fa fa-calendar"></i> '.$beauty_date.'</div>
							<div class="col-xs-3 text-center text-danger"><i class="fa fa-exclamation-circle"></i> '.$date['critical'].'</div>
							<div class="col-xs-3 text-center text-warning"><i class="fa fa-exclamation-triangle"></i> '.$date['warning'].'</div>
							<div class="col-xs-3 text-center">
								<a class="btn btn-default btn-sm" role="button" data-toggle="collapse" href="#ewa_system_graph_'.$system.'_'.$date['date'].'" aria-expanded="false" aria-controls="collapseExample">
									<i class="fa fa-plus"></i> Ver más
								</a>
							</div>
						</div><!-- panel-heading -->';
//			$output.=$date;
			$output.='<ul class="list-group row collapse" id="ewa_system_graph_'.$system.'_'.$date['date'].'">';
			$sql="SELECT
					a.id as alert_id,
					a.alert_message as message,
					b.css_class as class,
					b.icon as priority_icon,
					c.short_name as party_name,
					c.url as party_url,
					c.icon as party_icon,
					a.action_id as action
					FROM
						(($this->tbl_name as a
						LEFT JOIN $NOVIS_CSI_EWA_ALERT_RATING->tbl_name as b ON a.alert_priority_id = b.id)
						LEFT JOIN $NOVIS_CSI_EWA_ACTION_PARTY->tbl_name as c ON a.action_party_id = c.id)
					WHERE
						a.system_id=$system
						AND a.issued_date='".$date['date']."'
				";
			$alerts = self::get_sql($sql);
			foreach ( $alerts as $alert){
				$output.='<li class="list-group-item list-group-item-'.$alert['class'].'">
							<h5 class="list-group-item-heading"><i class="fa fa-'.$alert['priority_icon'].'"></i> '.$alert['message'].'</h5>
							<div class="row">';
				if ( '' != $alert['action'] ){
					$output.='<p class="text-muted text-justify col-xs-8">El análisis y resolución de este mensaje de error, están siendo tratados en <em>'.$alert['party_name'].'</em></p>';
					$url = str_replace ( '[TICKET]', $alert['action'], $alert['party_url'] );
					$output.='<div class="col-xs-4 text-center">';
					$output.='<div class="btn-group" role="group" aria-label="...">';
					$output.='<a href="'.$url.'" class="btn btn-'.$alert['class'].' btn-sm"><i class="fa fa-'.$alert['party_icon'].' fa-fw"></i> '.$alert['action'].'</a>';
					$output.='<a href="#" class="btn btn-default btn-sm"><i class="fa fa-edit fa-fw"></i></a>';
					$output.='</div>';
					$output.='</div>';
				}else{
					$output.='<p class="text-muted text-justify col-xs-8">El análisis y resolución de este mensaje de error <strong>NO</strong> están siendo tratados.</p>';
					$output.='<div class="col-xs-4 text-center">';
					$output.='<div class="btn-group" role="group" aria-label="...">';
					$output.='<a href="#" class="btn btn-default btn-sm"><i class="fa fa-edit fa-fw"></i></a>';
					$output.='</div>';
					$output.='</div>';
				}
				$output.='</div></li>';
			}
			$output.='</ul>';
			$output.='</div>';
		}
		$output.="</section>";
		$output.="</div>";
	}else{
		$output.='<div class="well">';
				$output.='<p class="h3"><i class="fa fa-exclamation-circle fa-sm text-danger"></i> Error</p>';
				$output.='<p>Ha ocurrido un error, o probablemente no est&aacute;s usando de modo correcto el <code>shortcode</code>.</p>';
				$output.='<p><code>[csi_ewa_system_panel system=<kbd>id-del-sistema</kbd> weeks=<kbd>numero-de-semanas-previas</kbd> graph=<kbd>true|false</kbd></code></p>';
				$output.='<a href="'.get_site_option('ics_shortcode_help_url','#').'" class="btn btn-sm btn-primary">Aprender m&aacute;s</a>';
		$output.='</div>';
	}
	return $output;
}


public function csi_ajax_template_ewa_control_center_update_alerts(){
	//global variables
	global $wpdb;
	//local variables
	$request = $_REQUEST;
	$alert_id			= isset ( $request['alert_id'] ) ? intval ( $request['alert_id'] ) : NULL ;
	$action_party_id	= isset ( $request['action_party_id'] ) ? intval ( $request['action_party_id'] ) : NULL ;
	$action_id			= isset ( $request['action_id'] ) ? $request['action_id'] : NULL ;
	$customer_flag		= isset ( $request['customer_flag'] ) ? $request['customer_flag'] : NULL;
	if (	NULL === $alert_id &&
			NULL === $action_party_id &&
			NULL === $action_id &&
			NULL === $customer_flag ){
		$respnse['error']=true;
		$response['message']="Ha ocurrido un error.";
	}else{
		$whereArray	= array(
			'id'				=> $request['alert_id'],			
		);
		$current_user = wp_get_current_user();
		$editArray	= array(
			'action_party_id'			=> $request['action_party_id'],
			'action_id'					=> $request['action_id'],
			'customer_flag'				=> ( 'true' == $request['customer_flag'] ? 1 : 0 ),
			'last_modified_user_id'		=> intval(get_current_user_id()),
			'last_modified_user_email'	=> $current_user->user_email,
			'last_modified_date'		=> date("Y-m-d"),
			'last_modified_time'		=> date("H:i:s"),
		);
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
	}
	echo json_encode($response);
	wp_die();	
}


//END OF CLASS	
}



global $NOVIS_CSI_EWA_ALERT;
$NOVIS_CSI_EWA_ALERT =new NOVIS_CSI_EWA_ALERT_CLASS();
?>