<?php
/**
 * ChurchEvents
 *
 * Copyright 2010 by Joshua Gulledge <jgulledge19@hotmail.com>
 *
 * This file is part of ChurchEvents, a simple archive navigation system for MODx
 * Revolution.
 *
 * ChurchEvents is under the terms of the GNU General Public License
 *
 * ChurchEvents is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU General Public License for more
 * details.
 *
 * @package churchevents
 */
 
/*
	Steps
	1. Create namespace: http://rtfm.modx.com/display/revolution20/Namespaces -> 
		http://rtfm.modx.com/display/revolution20/Custom+Manager+Pages
	2. 
	
*/
//////////
// Snippet: 
/*
<?php
  
$namespace = $modx->getObject('modNamespace','churchEvents');  
//$namespace->get('name').' has a path of: '.
  include $namespace->get('path').'index.php';  

  //include_once MODX_CORE_PATH.'components\churchEvents\index.php';
  
  return $text;
*/


/////////////
// File:


// load the CSS file
$modx->regClientCSS(MODX_ASSETS_URL.'components/churchevents/css/calendar.css');
$modx->regClientCSS(MODX_ASSETS_URL.'components/churchevents/css/form.css');
// look here for CSS: http://davidwalsh.name/php-calendar

/*
 * Some possible calendar scripts (repeating): 
 * http://www.phpclasses.org/package/6178-PHP-Calculate-the-schedule-of-periodic-events.html
 * http://supercali.inforest.com/ - 12/2008
 *http://www.php-calendar.com/ 
 * http://sourceforge.net/projects/phxeventmanager/files/
 * 
 * */
$show_calendar = true;
$view = '';
/*
	Permissions:
*/
// logged in:
$show_request = false;
$url_scheme = -1;
if ( isset( $scheme ) ) {
	$url_scheme = $scheme;
}
$tmp_base = $modx->makeUrl($output = $modx->resource->get('id'), '', '', $url_scheme);
if ( substr_count($tmp_base,'?') == 1 ) {
	$tmp_base .= '&amp;';
} else {
	$tmp_base .= '?';
}
define( 'CH_URL_BASE', $tmp_base );// http://rtfm.modx.com/display/revolution20/modX.makeUrl

if ( $modx->user->isAuthenticated('mgr') ) {
	// can do everything:
	$allow_veiws = array( 
		'list','add','edit','delete','event',
		'addLocation','editLocaction','deleteLocation',
		'addCalendar', 'editCalendar', 'listCalendars',
		'addCategory', 'editCategory', 'listCategories'
		);
} else {
	$allow_veiws = array( 
		'list','event'
		);
	// can people request events?
	if ( $modx->getObject('modSystemSetting',array('key' => 'churchevents.allowRequests')) ) {
		$show_request = true;
		$allow_veiws[] = 'request';
		//echo '<br>Allow Request<br>';
	}
	//echo '<br>Option: '. $modx->getOption('churchevents.allowRequest');
}

if ( isset($_REQUEST['view']) ){
	$view = $_REQUEST['view'];
	// 1. is this an acutal view?
	if ( !in_array($view,$allow_veiws) ){
		$view = '';
	}
	/*
	 *  @TO DO: create permissions for chruch calendar
	 */
	// 2. do they have permissions? 
	
}
// get the classes:
require_once 'classes/calendar_populate.php';
require_once 'classes/calendar_simple.php';
require_once 'classes/HTML_forms.php';
require_once 'classes/Form_validate.php';

// Load the DB classes:
$base_path = !empty($base_path) ? $base_path : $modx->getOption('core_path').'components/churchevents/';
// This will add the package to xPDO, and allow you to use all of xPDO's functions with your model. 
$modx->addPackage('churchevents', $base_path.'model/');
// Let's test it out:
/*
	$events = $modx->getCollection('chEvents');
	$cals = $modx->getCollection('chCalendar');
	$cats = $modx->getCollection('chECategory');
*/
/*
Note the first time you run this, it might throw an error. 
This is because xPDO is dynamically creating your database table from your schema. After running, it should show "Total: 0".
*/
// echo '<br>Total E: '.count($events).' - Cal: '.count($cals).' - Cat: '.count($cats);


	$event_id = 0;
	if ( isset($_REQUEST['event_id']) && is_numeric($_REQUEST['event_id']) ){
		$event_id = $_REQUEST['event_id'];
	}
	$m = date("n");
	if ( isset($_REQUEST['month']) && is_numeric($_REQUEST['month']) ){
		$m = $_REQUEST['month'];
	}
	$y = date("Y");
	if ( isset($_REQUEST['year']) && is_numeric($_REQUEST['year']) ){
		$y = $_REQUEST['year'];
	}
	$a = 0;
	if ( isset($_REQUEST['a'])){
		$a = $_REQUEST['a'];
	}
	$page_id=0;
	if ( isset($_REQUEST['id'])){
		$page_id = $_REQUEST['id'];
	}
/*
// from the Login Snippet:
$ctxs = !empty($ctxs) ? $ctxs : $modx->context->get('key');
if ( !is_array($ctxs) ) {
	$ctxs = explode(',',$ctxs);
	echo 'Key: '.$ctxs;
	print_r($ctxs);
}
 $keys = $modx->user->getSessionContexts();  
 echo'<br>Sessions: ';
 print_r($keys); // prints Array ( 'web', 'mgr' );  
/*
$user = $modx->getUser(); // echo $user->get('username');
//if ( $modx->user->get('username') != 'anonymous' ) {
if ( !$user->isAuthenticated('web') ) {
if ( !$modx->user->hasSessionContext($ctxs) ) {
    //$modx->sendUnauthorizedPage();
}*/ 
	// echo '<br>View: '.$view;
	switch( $view ){
		// Manage the category views:
		case 'addCategory':
		case 'editCategory':
		case 'listCategories':
			require_once 'views/managecategory.php';
			break;
		// Manage the calendar views:
		case 'addCalendar':
		case 'editCalendar':
		case 'listCalendars':
			require_once 'views/managecalendar.php';
			break;
		case 'editLocation':
			// load data:
			
		case 'addLocation':
			require_once 'views/addLocation.php';
			break;
		case 'deleteLocation':
			break;
		case 'event':
			require_once 'views/event.php';
			break;
		case 'request':
		case 'edit':
		case 'add':
			require_once 'views/add.php';
			break;
		case 'delete':
			require_once 'views/delete.php';
			break;
		case 'list':
		default:
	}
	
if ( $show_calendar ){
	if ( isset($message) && !empty($message) ){
		$text .= '
		<div id="message">'.$message.'</div>';
	}
	// echo 'M: '.$m;
	$m = $m*1;
	$calendar = new calendar_simple($m,$y);
	/*
	Help:
		http://rtfm.modx.com/display/xPDO20/xPDOQuery
	*/
	//$event = $modx->newObject('chEvents');
	$query = $modx->newQuery('chEvents');
	//$c->innerJoin('BoxOwner','Owner'); // arguments are: className, alias
	$start_where = date("Y-m-d", (strtotime($y.'-'.$m.'-01')-6*3600*24) );
	$end_where = date("Y-m-d", (strtotime($y.'-'.$m.'-31')+6*3600*24) );
	$query->where(array(
		'start_date:>=' => $start_where,
		'start_date:<=' => $end_where
	));
	// church_calendar_id
	if ( isset($_GET['church_calendar_id']) && is_numeric($_GET['church_calendar_id']) ) {
		$church_calendar_id = $_SESSION['church_calendar_id'] = $_GET['church_calendar_id'];
	} elseif ( isset($_GET['church_calendar_id']) ) {
		// clear the session:
		$church_calendar_id = $_GET['church_calendar_id'] = $_SESSION['church_calendar_id'] = 0;
	} elseif ( $_SESSION['church_calendar_id'] && is_numeric($_SESSION['church_calendar_id']) ) {
		$church_calendar_id = $_GET['church_calendar_id'] = $_SESSION['church_calendar_id'];
	}
	// echo 'ID: '. $church_calendar_id;
	if ( $church_calendar_id > 0 ) {
		$query->andCondition(array( 'church_calendar_id' => $church_calendar_id ) );
	}
	// church_ecategory_id
	if ( isset($_GET['church_ecategory_id']) && is_numeric($_GET['church_ecategory_id']) ) {
		$church_ecategory_id = $_SESSION['church_ecategory_id'] = $_GET['church_ecategory_id'];
	} elseif ( isset($_GET['church_ecategory_id']) ) {
		// clear the session:
		$church_ecategory_id = $_GET['church_ecategory_id'] = $_SESSION['church_ecategory_id'] = 0;
	} elseif ( $_SESSION['church_ecategory_id'] && is_numeric($_SESSION['church_ecategory_id']) ) {
		$church_ecategory_id = $_GET['church_ecategory_id'] = $_SESSION['church_ecategory_id'];
	}
	if ( $church_ecategory_id > 0 ) { 
		$query->andCondition(array( 'church_ecategory_id' => $church_ecategory_id ) );
	}
	if ( !$modx->user->isAuthenticated('mgr') ) {
		//echo '<br>test status <br>';
		$query->andCondition(array( 'status' => 'approved' ) );
	}
	$query->sortby('start_date','ASC');
	//$c->limit(5);
	$ev = $modx->getCollection('chEvents',$query);
	//echo 'SQL:<br>'.$query->toSQL();
	//print_r($ev);
	$events = array();
	foreach ($ev as $e_id => $event ) {
		//$templateVars =& $resource->getMany('TemplateVars');
		/*
		foreach ($templateVars as $tvId => $templateVar) {
			$tvs[$tvPrefix . $templateVar->get('name')] = !empty($processTVs) ? 
				$templateVar->renderOutput($resource->get('id')) : $templateVar->get('value');
		}
		*/
		// $resource->toArray()
		list($date) = explode(' ',$event->get('start_date'));
		$time_str = '';
		switch ( $event->get('event_timed')  ){
			case 'Y':
				list($d, $time) = explode(' ',$event->get('public_start'));
				list($hr,$min) = explode(":", $time);
				$hr = (int)$hr;
				$min = (int)$min;
				list($dhr,$dmin) = explode(":", $event->get('duration'));
				$dhr = (int)$dhr;
				$dmin = (int)$dmin;
				$time_str = '<span class="eTime">'.english_time($hr, $min).' &ndash; '.english_time(($hr+$dhr), ($min+$dmin)).'</span> ';
				break;
			case 'allday':
				$time_str = '<span class="allDay">All Day</span>';
				break;
			case 'N':
			default:
				
				break;
				
		}
		// build the event info - this is also the URL:
		$notice = '';
		if ( $event->get('status') != 'approved' ) {
			$notice = '<img src="'.MODX_ASSETS_URL.'components/churchevents/images/'.$event->get('status').'.png" title="This event is marked as '.$event->get('status').'" /> ';
		}
		$event_title = $event->get('title');
		if ( $event->get('event_type') == 'private' ) {
			$event_title = 'Reserved';
			if ( $modx->user->isAuthenticated('mgr') ) {
				$event_title = $event->get('title');
			}
		}
		$events[$date][$event->get('id')] = array(
			'event' => $notice.$time_str.'<a href="'.CH_URL_BASE.'id='.$page_id.'&amp;a='.$a.'&amp;view=event&amp;event_id='.$event->get('id').'">'.
			$event_title.'</a>',
			'class' => 'chEvent chCat_'.$event->get('church_ecategory_id')// the CSS class(es)
		);
			
		//echo '<br>E ID: '.$event->get('id').' - Date: '.$date.'<br>';
	}
	//echo 'ID: '.$modx->documentIdentifier;
	// User info: http://rtfm.modx.com/display/revolution20/modUser.isAuthenticated
	//echo 'User: '.$modx->user->get('username'); 
	$manage_cal = '';
	$manage_cat = '';
	if ( $modx->user->isAuthenticated('mgr') ) { // not sure but this does not work
	//if ( $modx->user->get('username') != 'anonymous' ) {
		// $text .= '<a href="?id='.$page_id.'&amp;a='.$a.'&amp;view=add">Add Event</a> ';
		// have the add buttons:
		$calendar->set_add_link('&amp;id='.$page_id.'&amp;a='.$a);
		$manage_cal = '<a href="'.CH_URL_BASE.'view=listCalendars&amp;id='.$page_id.'&amp;a='.$a.'" title="Manager Calendars">Manage</a>';
		$manage_cat = '<a href="'.CH_URL_BASE.'view=listCategories&amp;id='.$page_id.'&amp;a='.$a.'" title="Manager Categories">Manage</a>';
	} elseif ( $show_request ) {
		$calendar->set_request_link('&amp;id='.$page_id.'&amp;a='.$a);
	}
	// need a sort by Calendar and Category:
	// Get the Calendar Options:
	$cals = $modx->getCollection('chCalendar');
	$calendar_array = array();
	foreach ( $cals as $chCalendar ) {
		$calendar_array[$chCalendar->get('title')] = $chCalendar->get('id');
	}
	// Get the Category Options: 
	$cats = $modx->getCollection('chECategory');
	$category_array = array();
	$cat_css = '';
	foreach ( $cats as $category ) {
		$category_array[$category->get('name')] = $category->get('id');
		$cat_css .= '
	li.chCat_'.$category->get('id').',
	li.chCat_'.$category->get('id').' a{
		background: #'.$category->get('background').';
		color: #'.$category->get('color').';
	}
	li.chCat_'.$category->get('id').'{
		border: 1px solid #'.$category->get('background').';
	}
	li.chCat_'.$category->get('id').':hover{
		border: 1px solid #FF0000;
	}';
	}
	// create the styles for the categories:
	$modx->regClientStartupHTMLBlock('
<style type="text/css">
	'.$cat_css.'
</style>');
	// Show the previous and next options:
	$text .= $calendar->nav('&amp;id='.$page_id.'&amp;a='.$a).'
		';
	$form = new HTML_forms('sort_form', /*$_SERVER['PHP_SELF'].*/CH_URL_BASE.''.$_SERVER['QUERY_STRING'], 'get');
	$text .=  $form->form_head(' class="standard" ').'
		<fieldset class="clear">
			<legend>Sort the Calendars</legend>
			<ul class="plan">
				<li class="autoWidth spaceRight">
					<label for="sel_church_calendar_id">Choose a Calendar</label> '.$manage_cal.'
					'.$form->select('church_calendar_id', $calendar_array, $church_calendar_id, $type, ' All ', ' class="displayBlock" id="sel_church_calendar_id" ').'
				</li>
				<li class="autoWidth spaceRight">
					<label for="sel_church_ecategory_id">Choose a Category</label> '.$manage_cat.'
					'.$form->select('church_ecategory_id', $category_array, $church_ecategory_id, $type, ' All ', ' class="displayBlock" id="sel_church_ecategory_id" ').'
				</li>
				<li class="small">
					'.$form->submit('submit', ' Sort ', ' class="submit" ').'
				</li>
			</ul>
		</fieldset>
			'.$form->hidden('a', $a).'
			'.$form->hidden('id', $id).'
		'.$form->form_footer();
	
	
	$text .= $calendar->get_month($m,$events);
	
}


return $text;
function english_time($hr, $min) {
	$hr = trim($hr);
	$am = 'a';
	if( $min > 0 && $min < 10){
		$min = '0'.$min;
	} elseif ( $min >= 60 ) {
		$hr += 1;
		$min -= 60;
	}
	if ( $hr > 24 ){
		if ( $hr > 24){
			$hr = $hr - 24;
		}
	}
	if($hr >= 12 ){
		$am = 'p';
		if($hr > 12){
			$hr = $hr - 12;
		}
	}
	if ( $min == '00' ) {
		return $hr.$am;
	} else {
		return $hr.':'.$min.$am;
	}
}

?>