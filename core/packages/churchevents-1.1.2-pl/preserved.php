<?php return array (
  'd3eb4928346b9329394ebac9a420d91e' => 
  array (
    'criteria' => 
    array (
      'name' => 'churchevents',
    ),
    'object' => 
    array (
      'name' => 'churchevents',
      'path' => '{core_path}components/churchevents/',
      'assets_path' => NULL,
    ),
  ),
  '08ed3b2a72e1a52bd706737f293653d4' => 
  array (
    'criteria' => 
    array (
      'category' => 'ChurchEvents',
    ),
    'object' => 
    array (
      'id' => 4,
      'parent' => 0,
      'category' => 'ChurchEvents',
    ),
  ),
  'b04709ab6a80e60a7ffdd701750724a1' => 
  array (
    'criteria' => 
    array (
      'name' => 'ChurchEvents_CalColumnHeadTpl',
    ),
    'object' => 
    array (
      'id' => 6,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'ChurchEvents_CalColumnHeadTpl',
      'description' => 'Calendar column header',
      'editor_type' => 0,
      'category' => 4,
      'cache_type' => 0,
      'snippet' => '<!-- these are the Day of the week, headings -->
<th>
	[[+weekDay]]
</th>',
      'locked' => 0,
      'properties' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '<!-- these are the Day of the week, headings -->
<th>
	[[+weekDay]]
</th>',
    ),
  ),
  'cf2e4115c5bc5e62107f515a93fabd4c' => 
  array (
    'criteria' => 
    array (
      'name' => 'ChurchEvents_CalColumnTpl',
    ),
    'object' => 
    array (
      'id' => 7,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'ChurchEvents_CalColumnTpl',
      'description' => 'Calendar column',
      'editor_type' => 0,
      'category' => 4,
      'cache_type' => 0,
      'snippet' => '<td class="[[+column_class]]">
	<div class="dayWrapper">
		<a href="[[+day_url]]" class="date">[[+day]]</a>
		<!-- Only if perms allow other avable: +allow_add, +add_url +month +day +year -->
		[[+add_url:notempty=`<a class="addEvent" href="[[+add_url]]" title="[[+add_message]]">[ + ]</a>`]]
		<!-- Now actual event list(day holder) -->
		[[+calDayHolderTpl]]
	</div>
</td>',
      'locked' => 0,
      'properties' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '<td class="[[+column_class]]">
	<div class="dayWrapper">
		<a href="[[+day_url]]" class="date">[[+day]]</a>
		<!-- Only if perms allow other avable: +allow_add, +add_url +month +day +year -->
		[[+add_url:notempty=`<a class="addEvent" href="[[+add_url]]" title="[[+add_message]]">[ + ]</a>`]]
		<!-- Now actual event list(day holder) -->
		[[+calDayHolderTpl]]
	</div>
</td>',
    ),
  ),
  '27217af92a9b63ecd4dd5cc0068d342a' => 
  array (
    'criteria' => 
    array (
      'name' => 'ChurchEvents_CalDayHolderTpl',
    ),
    'object' => 
    array (
      'id' => 8,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'ChurchEvents_CalDayHolderTpl',
      'description' => 'Calendar day holder',
      'editor_type' => 0,
      'category' => 4,
      'cache_type' => 0,
      'snippet' => '<!-- Now actual event list -->
<ul class="dayList">
	<!-- this goes through a loop -->
	[[+calEventTpl]]
</ul>
',
      'locked' => 0,
      'properties' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '<!-- Now actual event list -->
<ul class="dayList">
	<!-- this goes through a loop -->
	[[+calEventTpl]]
</ul>
',
    ),
  ),
  '82c395e6d3ff7e512ec2934d804669f2' => 
  array (
    'criteria' => 
    array (
      'name' => 'ChurchEvents_CalEventTpl',
    ),
    'object' => 
    array (
      'id' => 9,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'ChurchEvents_CalEventTpl',
      'description' => 'Calendar Event',
      'editor_type' => 0,
      'category' => 4,
      'cache_type' => 0,
      'snippet' => '<li id="e_[[+event_id]]" class="chEvent chCat_[[+category_id]]">
	<img src="assets/components/churchevents/images/[[+status]].png" alt="[[+status]]" title="[[+status]]" /> 
    <span class="eTime">[[+event_time]]</span> 
    <br />
	<a href="[[+event_url]]">[[+event_title]]</a>
</li>',
      'locked' => 0,
      'properties' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '<li id="e_[[+event_id]]" class="chEvent chCat_[[+category_id]]">
	<img src="assets/components/churchevents/images/[[+status]].png" alt="[[+status]]" title="[[+status]]" /> 
    <span class="eTime">[[+event_time]]</span> 
    <br />
	<a href="[[+event_url]]">[[+event_title]]</a>
</li>',
    ),
  ),
  '54e83434418da0e7522c0e9949cde2ee' => 
  array (
    'criteria' => 
    array (
      'name' => 'ChurchEvents_CalFilterTpl',
    ),
    'object' => 
    array (
      'id' => 10,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'ChurchEvents_CalFilterTpl',
      'description' => 'Calendar Filter',
      'editor_type' => 0,
      'category' => 4,
      'cache_type' => 0,
      'snippet' => '<form name="sort_form" action="" method="get"  class="standard" >
    <fieldset class="clear">
        <legend>Sort the Calendars</legend>
        <ul class="plan">
            <li class="autoWidth spaceRight">
                <label for="sel_church_calendar_id">Choose a Calendar</label> 
                
                <select name="church_calendar_id" class="displayBlock" id="sel_church_calendar_id" > 
                    [[+select_calendar]]
                </select>
            </li>
            <li class="autoWidth spaceRight">
                <label for="sel_church_ecategory_id">Choose a Category</label> 
                
                <select name="church_ecategory_id" class="displayBlock" id="sel_church_ecategory_id" > 
                    [[+select_category]]
                </select>
            </li>
            <!-- Search the tilte option -->
            <li class="small spaceRight">
                <label for="txt_filterSearch" >[[+filterSearch_label]]</label> 
                <input name="filterSearch" type="text" value="[[+filterSearch]]" id="txt_filterSearch" class="full" />
            </li>
            <li class="small spaceRight">
                <input name="submit" type="submit" value="Sort"  class="submit" />
            </li>
            <li class="small spaceLeft">
                <p><a href="[[+icalUrl]]"><img title="iCal Download" src="assets/components/churchevents/images/smical.png" alt="iCal"/></a> 
                [[+rssUrl:notempty=` <a href="[[+rssUrl]]"><img title="RSS Feed" src="assets/components/churchevents/images/smrss.png" alt="RSS"/></a>`]]
                </p>
            </li>
        </ul>
         
        [[+locationInfo:notempty=`
        <p class="clear">
            <input name="filterLocations" type="radio" value="0" [[+filterLocations:isequalto=`0`:then=`checked="checked"`:else=``]] id="rd_filterLocationsN" class="radio changeToggle" /> 
            <label for="rd_filterLocationsN">[[+filterLocationsN_label]]</label>
            <input name="filterLocations" type="radio" value="1" [[+filterLocations:isequalto=`1`:then=`checked="checked"`:else=``]] id="rd_filterLocations" class="radio changeToggle" /> 
            <label for="rd_filterLocations">[[+filterLocationsY_label]]</label>
        </p>
        <div id="filterLocationsHolder">
            [[+locationInfo]]
        </div>`]]
        
    </fieldset>
<!-- must have this for search to work for pages with out furl -->
    <input name="id" type="hidden" value="[[*id]]" />

</form>

<ul id="view_tabs">
    <li class=""><a href="[[~[[*id]]? &view=`day` &month=`[[+cMonth]]` &day=`[[+cDay]]` &year=`[[+cYear]]` ]]">Today</a></li>
    <li class="[[+view:isequalto=`day`:then=`selected`:else:``]]"><a href="[[~[[*id]]? &view=`day`]]">Day</a></li>
    <li class="[[+view:isequalto=`week`:then=`selected`:else:``]]"><a href="[[~[[*id]]? &view=`week`]]">Week</a></li>
    <li class="[[+view:isequalto=`month`:then=`selected`:else:``]]"><a href="[[~[[*id]]? &view=`month`]]">Month</a></li>
    <li class="[[+view:isequalto=`year`:then=`selected`:else:``]]"><a href="[[~[[*id]]? &view=`year` ]]">Year</a></li>
</ul>',
      'locked' => 0,
      'properties' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '<form name="sort_form" action="" method="get"  class="standard" >
    <fieldset class="clear">
        <legend>Sort the Calendars</legend>
        <ul class="plan">
            <li class="autoWidth spaceRight">
                <label for="sel_church_calendar_id">Choose a Calendar</label> 
                
                <select name="church_calendar_id" class="displayBlock" id="sel_church_calendar_id" > 
                    [[+select_calendar]]
                </select>
            </li>
            <li class="autoWidth spaceRight">
                <label for="sel_church_ecategory_id">Choose a Category</label> 
                
                <select name="church_ecategory_id" class="displayBlock" id="sel_church_ecategory_id" > 
                    [[+select_category]]
                </select>
            </li>
            <!-- Search the tilte option -->
            <li class="small spaceRight">
                <label for="txt_filterSearch" >[[+filterSearch_label]]</label> 
                <input name="filterSearch" type="text" value="[[+filterSearch]]" id="txt_filterSearch" class="full" />
            </li>
            <li class="small spaceRight">
                <input name="submit" type="submit" value="Sort"  class="submit" />
            </li>
            <li class="small spaceLeft">
                <p><a href="[[+icalUrl]]"><img title="iCal Download" src="assets/components/churchevents/images/smical.png" alt="iCal"/></a> 
                [[+rssUrl:notempty=` <a href="[[+rssUrl]]"><img title="RSS Feed" src="assets/components/churchevents/images/smrss.png" alt="RSS"/></a>`]]
                </p>
            </li>
        </ul>
         
        [[+locationInfo:notempty=`
        <p class="clear">
            <input name="filterLocations" type="radio" value="0" [[+filterLocations:isequalto=`0`:then=`checked="checked"`:else=``]] id="rd_filterLocationsN" class="radio changeToggle" /> 
            <label for="rd_filterLocationsN">[[+filterLocationsN_label]]</label>
            <input name="filterLocations" type="radio" value="1" [[+filterLocations:isequalto=`1`:then=`checked="checked"`:else=``]] id="rd_filterLocations" class="radio changeToggle" /> 
            <label for="rd_filterLocations">[[+filterLocationsY_label]]</label>
        </p>
        <div id="filterLocationsHolder">
            [[+locationInfo]]
        </div>`]]
        
    </fieldset>
<!-- must have this for search to work for pages with out furl -->
    <input name="id" type="hidden" value="[[*id]]" />

</form>

<ul id="view_tabs">
    <li class=""><a href="[[~[[*id]]? &view=`day` &month=`[[+cMonth]]` &day=`[[+cDay]]` &year=`[[+cYear]]` ]]">Today</a></li>
    <li class="[[+view:isequalto=`day`:then=`selected`:else:``]]"><a href="[[~[[*id]]? &view=`day`]]">Day</a></li>
    <li class="[[+view:isequalto=`week`:then=`selected`:else:``]]"><a href="[[~[[*id]]? &view=`week`]]">Week</a></li>
    <li class="[[+view:isequalto=`month`:then=`selected`:else:``]]"><a href="[[~[[*id]]? &view=`month`]]">Month</a></li>
    <li class="[[+view:isequalto=`year`:then=`selected`:else:``]]"><a href="[[~[[*id]]? &view=`year` ]]">Year</a></li>
</ul>',
    ),
  ),
  'a98a701dff74b6eef97386ec85e4fcb7' => 
  array (
    'criteria' => 
    array (
      'name' => 'ChurchEvents_CalNavTpl',
    ),
    'object' => 
    array (
      'id' => 11,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'ChurchEvents_CalNavTpl',
      'description' => 'Calendar navigation, next and previous months',
      'editor_type' => 0,
      'category' => 4,
      'cache_type' => 0,
      'snippet' => '<ul id="cal_nav">
    <li class="previous">
    	&lt; <a href="[[+prev_url]]">[[+previous]]</a>
    </li> 
    <li class="title">
        [[+view:isequalto=`day`:then=`[[+month]] [[+day]], [[+year]]`:else=``]]
        [[+view:isequalto=`week`:then=`[[+startDateFormated]] &ndash; [[+endDateFormated]]`:else=``]]
        [[+view:isequalto=`month`:then=`[[+month]] [[+year]]`:else=``]]
        [[+view:isequalto=`year`:then=`[[+year]]`:else=``]]
    </li>
    <li class="next">
    	<a href="[[+next_url]]">[[+next]]</a> &gt;
	</li>
</ul>',
      'locked' => 0,
      'properties' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '<ul id="cal_nav">
    <li class="previous">
    	&lt; <a href="[[+prev_url]]">[[+previous]]</a>
    </li> 
    <li class="title">
        [[+view:isequalto=`day`:then=`[[+month]] [[+day]], [[+year]]`:else=``]]
        [[+view:isequalto=`week`:then=`[[+startDateFormated]] &ndash; [[+endDateFormated]]`:else=``]]
        [[+view:isequalto=`month`:then=`[[+month]] [[+year]]`:else=``]]
        [[+view:isequalto=`year`:then=`[[+year]]`:else=``]]
    </li>
    <li class="next">
    	<a href="[[+next_url]]">[[+next]]</a> &gt;
	</li>
</ul>',
    ),
  ),
  'c4a64468b4323b5cdff29c0822558b11' => 
  array (
    'criteria' => 
    array (
      'name' => 'ChurchEvents_CalRowTpl',
    ),
    'object' => 
    array (
      'id' => 12,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'ChurchEvents_CalRowTpl',
      'description' => 'Calendar row',
      'editor_type' => 0,
      'category' => 4,
      'cache_type' => 0,
      'snippet' => '<tr>
    [[+calColumnTpl]]
</tr>',
      'locked' => 0,
      'properties' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '<tr>
    [[+calColumnTpl]]
</tr>',
    ),
  ),
  'b79a3fe1027fe220b1be03c3410247af' => 
  array (
    'criteria' => 
    array (
      'name' => 'ChurchEvents_CalTableTpl',
    ),
    'object' => 
    array (
      'id' => 13,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'ChurchEvents_CalTableTpl',
      'description' => 'Calendar table',
      'editor_type' => 0,
      'category' => 4,
      'cache_type' => 0,
      'snippet' => '[[+fi.returnMessage:notempty=`<div class="message">[[+fi.returnMessage]]</div>`]]
<table class="calendar">
	<tr>
		[[+calColumnHeadTpl]]
	</tr>
	[[+calRowTpl]]
</table>',
      'locked' => 0,
      'properties' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '[[+fi.returnMessage:notempty=`<div class="message">[[+fi.returnMessage]]</div>`]]
<table class="calendar">
	<tr>
		[[+calColumnHeadTpl]]
	</tr>
	[[+calRowTpl]]
</table>',
    ),
  ),
  'ef5b47dbc44d5699bf87292d9310ecc7' => 
  array (
    'criteria' => 
    array (
      'name' => 'ChurchEvents_CategoryHeadTpl',
    ),
    'object' => 
    array (
      'id' => 14,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'ChurchEvents_CategoryHeadTpl',
      'description' => 'Category CSS or JS that will go thourgh loop and be placed in <head>',
      'editor_type' => 0,
      'category' => 4,
      'cache_type' => 0,
      'snippet' => 'li.chCat_[[+category_id]],
li.chCat_[[+category_id]] a{
    background: #[[+background]];
    color: #[[+color]];
}
li.chCat_[[+category_id]]{
    border: 1px solid #[[+background]];
}
li.chCat_[[+category_id]]:hover{
    border: 1px solid #FF0000;
}',
      'locked' => 0,
      'properties' => '',
      'static' => 0,
      'static_file' => '',
      'content' => 'li.chCat_[[+category_id]],
li.chCat_[[+category_id]] a{
    background: #[[+background]];
    color: #[[+color]];
}
li.chCat_[[+category_id]]{
    border: 1px solid #[[+background]];
}
li.chCat_[[+category_id]]:hover{
    border: 1px solid #FF0000;
}',
    ),
  ),
  'be7048a0658d7a8ce0a08ee52020d39c' => 
  array (
    'criteria' => 
    array (
      'name' => 'ChurchEvents_DeleteFormHeadTpl',
    ),
    'object' => 
    array (
      'id' => 15,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'ChurchEvents_DeleteFormHeadTpl',
      'description' => 'Any JS/CSS for the delete form',
      'editor_type' => 0,
      'category' => 4,
      'cache_type' => 0,
      'snippet' => '<link rel="stylesheet" href="assets/components/churchevents/css/form.css" type="text/css" />',
      'locked' => 0,
      'properties' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '<link rel="stylesheet" href="assets/components/churchevents/css/form.css" type="text/css" />',
    ),
  ),
  '41954b6091f61c49340d33140805a4bc' => 
  array (
    'criteria' => 
    array (
      'name' => 'ChurchEvents_DeleteFormRepeatTpl',
    ),
    'object' => 
    array (
      'id' => 16,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'ChurchEvents_DeleteFormRepeatTpl',
      'description' => 'Option for repeating events on the delete form, all or single instance',
      'editor_type' => 0,
      'category' => 4,
      'cache_type' => 0,
      'snippet' => '<ul class="plan">
    <li class="full">
        <p class="small_font [[!+fi.error.edit_repeat:notempty=`formError`]]" style="margin:0;padding:0;">[[+deleteRepeat_heading]]</p>
        <ul>
            <li class="autoWidth spaceRight">
                <input name="edit_repeat" type="radio" value="all" [[!+fi.edit_repeat:FormItIsChecked=`all`]] id="rd_edit_repeat_all" class="radio" /> 
                <label for="rd_edit_repeat_all">[[+deleteRepeatAll_label]]</label>
            </li>
            <!-- Not yet a feature
            <li class="autoWidth spaceRight">
                <input name="edit_repeat" type="radio" value="unchanged" id="rd_edit_repeat_un" class="radio"  /> 
                <label for="rd_edit_repeat_un">Overide only unchanged instances</label>
            </li> -->
            <li class="autoWidth spaceRight">
                <input name="edit_repeat" type="radio" value="instance" [[!+fi.edit_repeat:FormItIsChecked=`instance`]] id="rd_edit_repeat_single" class="radio" /> 
                <label for="rd_edit_repeat_single">[[+deleteRepeatSingle_label]]</label>
            </li>
        </ul>
    </li>
</ul>
',
      'locked' => 0,
      'properties' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '<ul class="plan">
    <li class="full">
        <p class="small_font [[!+fi.error.edit_repeat:notempty=`formError`]]" style="margin:0;padding:0;">[[+deleteRepeat_heading]]</p>
        <ul>
            <li class="autoWidth spaceRight">
                <input name="edit_repeat" type="radio" value="all" [[!+fi.edit_repeat:FormItIsChecked=`all`]] id="rd_edit_repeat_all" class="radio" /> 
                <label for="rd_edit_repeat_all">[[+deleteRepeatAll_label]]</label>
            </li>
            <!-- Not yet a feature
            <li class="autoWidth spaceRight">
                <input name="edit_repeat" type="radio" value="unchanged" id="rd_edit_repeat_un" class="radio"  /> 
                <label for="rd_edit_repeat_un">Overide only unchanged instances</label>
            </li> -->
            <li class="autoWidth spaceRight">
                <input name="edit_repeat" type="radio" value="instance" [[!+fi.edit_repeat:FormItIsChecked=`instance`]] id="rd_edit_repeat_single" class="radio" /> 
                <label for="rd_edit_repeat_single">[[+deleteRepeatSingle_label]]</label>
            </li>
        </ul>
    </li>
</ul>
',
    ),
  ),
  '83621cbfc253858cfb43b7ed65ecbca3' => 
  array (
    'criteria' => 
    array (
      'name' => 'ChurchEvents_DeleteFormTpl',
    ),
    'object' => 
    array (
      'id' => 17,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'ChurchEvents_DeleteFormTpl',
      'description' => 'The delete event form, uses FormIt',
      'editor_type' => 0,
      'category' => 4,
      'cache_type' => 0,
      'snippet' => '[[!+fi.validation_error_message]]
[[+fi.errorMessage]]
[[+returnMessage]]
<form name="event_form" action="" method="post"  class="standard" >

    <fieldset>
        <legend>[[+delete_heading]]</legend>
        <input name="a" type="hidden" value="0"/>
        <input name="view" type="hidden" value="[[+fi.view]]"  />
        <input name="event_id" type="hidden" value="[[+fi.event_id]]"  />
        
        [[+repeatOptions]]
        
        <ul class="plan">
            <li class="spaceRight"><input name="submit" type="submit" value="[[+delete_button]]" class="submit" /></li>
            <li><input name="cancel" type="submit" value="[[+cancel_button]]" class="submit" /></li>
        </ul>
    
    </fieldset>
    <hr />
    <h2>[[+title_label]]</h2>
    <p>[[!+fi.title]]</p>
    
    <h3>[[+publicDesc_label]]</h3>
    <p>[[!+fi.public_desc]]</p>
    
    <h3>[[+notes_label]]</h3> 
    <p>[[!+fi.notes]]</p>
    
    <h3>[[+contact_label]]</h3>
    <p>[[!+fi.contact]]</p>
    <!--
    [[+contactEmail_label]]
    [[!+fi.contact_email]]
    [[+contactPhone_label]]
    [[!+fi.contact_phone]]
    -->
</form>',
      'locked' => 0,
      'properties' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '[[!+fi.validation_error_message]]
[[+fi.errorMessage]]
[[+returnMessage]]
<form name="event_form" action="" method="post"  class="standard" >

    <fieldset>
        <legend>[[+delete_heading]]</legend>
        <input name="a" type="hidden" value="0"/>
        <input name="view" type="hidden" value="[[+fi.view]]"  />
        <input name="event_id" type="hidden" value="[[+fi.event_id]]"  />
        
        [[+repeatOptions]]
        
        <ul class="plan">
            <li class="spaceRight"><input name="submit" type="submit" value="[[+delete_button]]" class="submit" /></li>
            <li><input name="cancel" type="submit" value="[[+cancel_button]]" class="submit" /></li>
        </ul>
    
    </fieldset>
    <hr />
    <h2>[[+title_label]]</h2>
    <p>[[!+fi.title]]</p>
    
    <h3>[[+publicDesc_label]]</h3>
    <p>[[!+fi.public_desc]]</p>
    
    <h3>[[+notes_label]]</h3> 
    <p>[[!+fi.notes]]</p>
    
    <h3>[[+contact_label]]</h3>
    <p>[[!+fi.contact]]</p>
    <!--
    [[+contactEmail_label]]
    [[!+fi.contact_email]]
    [[+contactPhone_label]]
    [[!+fi.contact_phone]]
    -->
</form>',
    ),
  ),
  'b1b571266244dca17b574cb2014156c9' => 
  array (
    'criteria' => 
    array (
      'name' => 'ChurchEvents_EventDescriptionBasicLocationTpl',
    ),
    'object' => 
    array (
      'id' => 18,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'ChurchEvents_EventDescriptionBasicLocationTpl',
      'description' => 'Basic location information on the event description page.  Only used if the Use Locations System Setting is No.',
      'editor_type' => 0,
      'category' => 4,
      'cache_type' => 0,
      'snippet' => '<ul>
    <li>
        [[+location_name]]
    </li>
    <li>
        [[+address]] <br /> 
        [[+city]] [[+state]] [[+zip]] [[+country]]
    </li>
</ul>
',
      'locked' => 0,
      'properties' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '<ul>
    <li>
        [[+location_name]]
    </li>
    <li>
        [[+address]] <br /> 
        [[+city]] [[+state]] [[+zip]] [[+country]]
    </li>
</ul>
',
    ),
  ),
  '9820ea2d07ec44148497a247324099b0' => 
  array (
    'criteria' => 
    array (
      'name' => 'ChurchEvents_EventDescriptionLocationTpl',
    ),
    'object' => 
    array (
      'id' => 19,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'ChurchEvents_EventDescriptionLocationTpl',
      'description' => 'Loops through each location(room) and shows information on the event description page.  Only used if the Use Locations System Setting is Yes.',
      'editor_type' => 0,
      'category' => 4,
      'cache_type' => 0,
      'snippet' => '<li>
    [[+name]] [[+map_url:notempty=`<a href="[[+map_url]]" target="_blank">Map</a>`]]
</li>',
      'locked' => 0,
      'properties' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '<li>
    [[+name]] [[+map_url:notempty=`<a href="[[+map_url]]" target="_blank">Map</a>`]]
</li>',
    ),
  ),
  '8b4c999200a9e4986c00b2f1bfa1555e' => 
  array (
    'criteria' => 
    array (
      'name' => 'ChurchEvents_EventDescriptionLocationTypeTpl',
    ),
    'object' => 
    array (
      'id' => 20,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'ChurchEvents_EventDescriptionLocationTypeTpl',
      'description' => 'Loops through each location type(building) and shows all locations(rooms) in it on the event description page.  Only used if the Use Locations System Setting is Yes.',
      'editor_type' => 0,
      'category' => 4,
      'cache_type' => 0,
      'snippet' => '<div id="building_type_[[!+id]]" class="locationHolder">
    <h3>[[+name]]</h3>
    <p>[[+notes]]</p>
    <ul>
        [[+locations]]
    </ul>
</div>',
      'locked' => 0,
      'properties' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '<div id="building_type_[[!+id]]" class="locationHolder">
    <h3>[[+name]]</h3>
    <p>[[+notes]]</p>
    <ul>
        [[+locations]]
    </ul>
</div>',
    ),
  ),
  'b2c0fb46e825d024f05caefba7169f09' => 
  array (
    'criteria' => 
    array (
      'name' => 'ChurchEvents_EventDescriptionTpl',
    ),
    'object' => 
    array (
      'id' => 21,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'ChurchEvents_EventDescriptionTpl',
      'description' => 'Shows event description information of a single event (event description page).',
      'editor_type' => 0,
      'category' => 4,
      'cache_type' => 0,
      'snippet' => '<!-- the event description -->

<!--
   id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `church_calendar_id` int(11) unsigned NOT NULL DEFAULT \'0\',
  `church_ecategory_id` int(11) unsigned NOT NULL DEFAULT \'0\',
  `parent_id` int(11) unsigned NOT NULL DEFAULT \'0\',
  `version` tinyint(3) unsigned NOT NULL DEFAULT \'1\',
  `web_user_id` int(8) unsigned NOT NULL DEFAULT \'0\',
  `status` set(\'approved\',\'deleted\',\'pending\',\'submitted\',\'rejected\') NOT NULL DEFAULT \'submitted\',
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `event_timed` set(\'Y\',\'N\',\'allday\') NOT NULL DEFAULT \'Y\',
  `duration` time NOT NULL,
  `public_start` datetime NOT NULL,
  `public_end` datetime NOT NULL,
  `repeat_type` set(\'none\',\'daily\',\'weekly\',\'monthly\') DEFAULT \'none\',
  `interval` tinyint(3) unsigned NOT NULL DEFAULT \'0\',
  `days` varchar(128) NOT NULL DEFAULT \'\',
  `event_type` set(\'public\',\'private\') DEFAULT \'public\',
  `title` varchar(100) NOT NULL DEFAULT \'\',
  `public_desc` text NOT NULL,
  `notes` text NOT NULL,
  `office_notes` text NOT NULL,
  `contact` varchar(128) NOT NULL DEFAULT \'\',
  `contact_email` varchar(128) NOT NULL DEFAULT \'\',
  `contact_phone` varchar(32) NOT NULL DEFAULT \'\',
  `personal_subscribers` text NOT NULL,
  `locations` text NOT NULL,
  `location_name` varchar(128) NOT NULL DEFAULT \'\',
  `address` varchar(128) NOT NULL DEFAULT \'\',
  `city` varchar(128) NOT NULL DEFAULT \'\',
  `state` varchar(128) NOT NULL DEFAULT \'\',
  `zip` varchar(32) NOT NULL DEFAULT \'0\',
  `country` varchar(128) NOT NULL DEFAULT \'\',
  `extended`  
     -->
<div id="church_events_wrapper">
    
    <h2>[[+event_title]]</h2>
    [[+edit_url:notempty=`<p><a href="[[+edit_url]]">[[+descEdit_link]]</a> || <a href="[[+delete_url]]">[[+descDelete_link]]</a></p>`]]

    <p><a href="[[~[[*id]]]]">[[+descBack]]</a></p>
    
    <ul>
        <li><strong>[[+descDate_heading]]</strong> 
            [[+start_time]] [[+end_time:notempty=`&ndash; [[+end_time]], `]] [[+event_date]] </li>
        <!-- <li><strong>Repeats</strong> </li> 
        <li><strong>[[+descNextDate_heading]]</strong> [[+nextDate]] [[+nextTime]]</li>
            -->
       
        <li><strong>[[+descDescription_heading]]</strong> [[+public_desc]]</li>

        <li><strong>[[+descContact_heading]]</strong>
            <ul>
                <li>[[+contact]]</li>
                <li>[[+contact_email:notempty=`<a href="mailto:[[+contact_email]]">[[+contact_email]]</a>`]]</li>
            </ul>
        </li>
        <!-- <li><strong>Calendar</strong> </li>
        <li><strong>Category</strong> </li> -->

        <li><strong>[[+descLocation_heading]]</strong>
            <!-- this is processing another chunk -->  
            [[+locationInfo]]
        </li>
        <li><strong>[[+descSetupNotes_heading]]</strong> 
            <ul>
                <li><strong>[[+descSetupTime_heading]]</strong> [[+setup_time]]</li>
                <li>[[+notes]]</li>
            </ul>

        </li>
        <!-- 
        <li><strong>Administrative Information</strong>
            <ul >
                <li>Event status</li>
                <li>What type of event is this? event_type</li>
                <li>[[+descOfficeNotes_heading]]</li>
            </ul>
        </li>
        -->
    </ul>
</div>',
      'locked' => 0,
      'properties' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '<!-- the event description -->

<!--
   id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `church_calendar_id` int(11) unsigned NOT NULL DEFAULT \'0\',
  `church_ecategory_id` int(11) unsigned NOT NULL DEFAULT \'0\',
  `parent_id` int(11) unsigned NOT NULL DEFAULT \'0\',
  `version` tinyint(3) unsigned NOT NULL DEFAULT \'1\',
  `web_user_id` int(8) unsigned NOT NULL DEFAULT \'0\',
  `status` set(\'approved\',\'deleted\',\'pending\',\'submitted\',\'rejected\') NOT NULL DEFAULT \'submitted\',
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `event_timed` set(\'Y\',\'N\',\'allday\') NOT NULL DEFAULT \'Y\',
  `duration` time NOT NULL,
  `public_start` datetime NOT NULL,
  `public_end` datetime NOT NULL,
  `repeat_type` set(\'none\',\'daily\',\'weekly\',\'monthly\') DEFAULT \'none\',
  `interval` tinyint(3) unsigned NOT NULL DEFAULT \'0\',
  `days` varchar(128) NOT NULL DEFAULT \'\',
  `event_type` set(\'public\',\'private\') DEFAULT \'public\',
  `title` varchar(100) NOT NULL DEFAULT \'\',
  `public_desc` text NOT NULL,
  `notes` text NOT NULL,
  `office_notes` text NOT NULL,
  `contact` varchar(128) NOT NULL DEFAULT \'\',
  `contact_email` varchar(128) NOT NULL DEFAULT \'\',
  `contact_phone` varchar(32) NOT NULL DEFAULT \'\',
  `personal_subscribers` text NOT NULL,
  `locations` text NOT NULL,
  `location_name` varchar(128) NOT NULL DEFAULT \'\',
  `address` varchar(128) NOT NULL DEFAULT \'\',
  `city` varchar(128) NOT NULL DEFAULT \'\',
  `state` varchar(128) NOT NULL DEFAULT \'\',
  `zip` varchar(32) NOT NULL DEFAULT \'0\',
  `country` varchar(128) NOT NULL DEFAULT \'\',
  `extended`  
     -->
<div id="church_events_wrapper">
    
    <h2>[[+event_title]]</h2>
    [[+edit_url:notempty=`<p><a href="[[+edit_url]]">[[+descEdit_link]]</a> || <a href="[[+delete_url]]">[[+descDelete_link]]</a></p>`]]

    <p><a href="[[~[[*id]]]]">[[+descBack]]</a></p>
    
    <ul>
        <li><strong>[[+descDate_heading]]</strong> 
            [[+start_time]] [[+end_time:notempty=`&ndash; [[+end_time]], `]] [[+event_date]] </li>
        <!-- <li><strong>Repeats</strong> </li> 
        <li><strong>[[+descNextDate_heading]]</strong> [[+nextDate]] [[+nextTime]]</li>
            -->
       
        <li><strong>[[+descDescription_heading]]</strong> [[+public_desc]]</li>

        <li><strong>[[+descContact_heading]]</strong>
            <ul>
                <li>[[+contact]]</li>
                <li>[[+contact_email:notempty=`<a href="mailto:[[+contact_email]]">[[+contact_email]]</a>`]]</li>
            </ul>
        </li>
        <!-- <li><strong>Calendar</strong> </li>
        <li><strong>Category</strong> </li> -->

        <li><strong>[[+descLocation_heading]]</strong>
            <!-- this is processing another chunk -->  
            [[+locationInfo]]
        </li>
        <li><strong>[[+descSetupNotes_heading]]</strong> 
            <ul>
                <li><strong>[[+descSetupTime_heading]]</strong> [[+setup_time]]</li>
                <li>[[+notes]]</li>
            </ul>

        </li>
        <!-- 
        <li><strong>Administrative Information</strong>
            <ul >
                <li>Event status</li>
                <li>What type of event is this? event_type</li>
                <li>[[+descOfficeNotes_heading]]</li>
            </ul>
        </li>
        -->
    </ul>
</div>',
    ),
  ),
  'aa07cbf8cbaeacd58c87004ab7b24227' => 
  array (
    'criteria' => 
    array (
      'name' => 'ChurchEvents_EventFormAdminTpl',
    ),
    'object' => 
    array (
      'id' => 22,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'ChurchEvents_EventFormAdminTpl',
      'description' => 'Event form admin section, only shows if user has permission to be admin',
      'editor_type' => 0,
      'category' => 4,
      'cache_type' => 0,
      'snippet' => '<fieldset>
    <legend>[[+admin_heading]]</legend>
    <ul class="plan">
        <li>
            <label for="sel_status" class="[[!+fi.error.status:notempty=`formError`]]">[[+status_label]]</label> 
            <select name="status" id="sel_status" > 
                [[+fi.status_select]]
            </select>
        </li>
        <li class="full">
            <label for="txt_office_notes" class="[[!+fi.error.office_notes:notempty=`formError`]]">[[+officeNotes_label]]</label>
            <textarea name="office_notes" id="txt_office_notes" >[[+office_notes]]</textarea>
        </li>
    </ul>

</fieldset>',
      'locked' => 0,
      'properties' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '<fieldset>
    <legend>[[+admin_heading]]</legend>
    <ul class="plan">
        <li>
            <label for="sel_status" class="[[!+fi.error.status:notempty=`formError`]]">[[+status_label]]</label> 
            <select name="status" id="sel_status" > 
                [[+fi.status_select]]
            </select>
        </li>
        <li class="full">
            <label for="txt_office_notes" class="[[!+fi.error.office_notes:notempty=`formError`]]">[[+officeNotes_label]]</label>
            <textarea name="office_notes" id="txt_office_notes" >[[+office_notes]]</textarea>
        </li>
    </ul>

</fieldset>',
    ),
  ),
  'e634ae6152ea794aa494510133cb2b24' => 
  array (
    'criteria' => 
    array (
      'name' => 'ChurchEvents_EventFormBasicLocationTpl',
    ),
    'object' => 
    array (
      'id' => 23,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'ChurchEvents_EventFormBasicLocationTpl',
      'description' => 'Basic location information, only used if the Use Locations System Setting is No.',
      'editor_type' => 0,
      'category' => 4,
      'cache_type' => 0,
      'snippet' => '    <ul class="plan">
        <li class="full">
            <label for="txt_location_name" class="[[!+fi.error.location_name:notempty=`formError`]]">Location Name</label>
            <input name="location_name" type="text" value="" id="txt_location_name" class="full"  />
        </li>

        <li class="medium">
            <label for="txt_address" class="[[!+fi.error.address:notempty=`formError`]]">Address</label> 
            <input name="address" type="text" value="[[!+fi.address]]" id="txt_address"  />
        </li>
        <li class="spaceLeft">
            <label for="txt_country" class="[[!+fi.error.country:notempty=`formError`]]">Country</label> 
            <input name="country" type="text" value="[[!+fi.country]]" id="txt_country"  />
        </li>
        <li class="spaceRight">
            <label for="txt_city" class="[[!+fi.error.city:notempty=`formError`]]">City</label> 
            <input name="city" type="text" value="[[!+fi.city]]" id="txt_city"  />
        </li>
        <li class="small spaceRight">
            <label for="txt_state" class="[[!+fi.error.state:notempty=`formError`]]">State</label> 
            <input name="state" type="text" value="[[!+fi.state]]" id="txt_state"  />
        </li>
        <li class="small">
            <label for="txt_zip" class="[[!+fi.error.zip:notempty=`formError`]]">Zip</label> 
            <input name="zip" type="text" value="[[!+fi.zip]]" id="txt_zip"  />
        </li>
    </ul>
',
      'locked' => 0,
      'properties' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '    <ul class="plan">
        <li class="full">
            <label for="txt_location_name" class="[[!+fi.error.location_name:notempty=`formError`]]">Location Name</label>
            <input name="location_name" type="text" value="" id="txt_location_name" class="full"  />
        </li>

        <li class="medium">
            <label for="txt_address" class="[[!+fi.error.address:notempty=`formError`]]">Address</label> 
            <input name="address" type="text" value="[[!+fi.address]]" id="txt_address"  />
        </li>
        <li class="spaceLeft">
            <label for="txt_country" class="[[!+fi.error.country:notempty=`formError`]]">Country</label> 
            <input name="country" type="text" value="[[!+fi.country]]" id="txt_country"  />
        </li>
        <li class="spaceRight">
            <label for="txt_city" class="[[!+fi.error.city:notempty=`formError`]]">City</label> 
            <input name="city" type="text" value="[[!+fi.city]]" id="txt_city"  />
        </li>
        <li class="small spaceRight">
            <label for="txt_state" class="[[!+fi.error.state:notempty=`formError`]]">State</label> 
            <input name="state" type="text" value="[[!+fi.state]]" id="txt_state"  />
        </li>
        <li class="small">
            <label for="txt_zip" class="[[!+fi.error.zip:notempty=`formError`]]">Zip</label> 
            <input name="zip" type="text" value="[[!+fi.zip]]" id="txt_zip"  />
        </li>
    </ul>
',
    ),
  ),
  'c4886dc97baec45347a477653780b22c' => 
  array (
    'criteria' => 
    array (
      'name' => 'ChurchEvents_EventFormConflictTpl',
    ),
    'object' => 
    array (
      'id' => 24,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'ChurchEvents_EventFormConflictTpl',
      'description' => 'Shows error message list of events that are conflicting, only used if the Use Locations System Setting is Yes.',
      'editor_type' => 0,
      'category' => 4,
      'cache_type' => 0,
      'snippet' => '<li id="conflict_[[+event_id]]" >
    <span class="">[[+event_time]] [[+event_date]]</span> 
    <a target="_blank" href="[[+event_url]]">[[+event_title]]</a>
</li>',
      'locked' => 0,
      'properties' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '<li id="conflict_[[+event_id]]" >
    <span class="">[[+event_time]] [[+event_date]]</span> 
    <a target="_blank" href="[[+event_url]]">[[+event_title]]</a>
</li>',
    ),
  ),
  '0cc503d90d260a1198fc464337ef2a85' => 
  array (
    'criteria' => 
    array (
      'name' => 'ChurchEvents_EventFormHeadTpl',
    ),
    'object' => 
    array (
      'id' => 25,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'ChurchEvents_EventFormHeadTpl',
      'description' => 'The <head> JS/CSS for the add/edit/request event form.',
      'editor_type' => 0,
      'category' => 4,
      'cache_type' => 0,
      'snippet' => '<link rel="stylesheet" href="assets/components/churchevents/css/form.css" type="text/css" />
<!-- jQuery 
    http://docs.jquery.com/Downloading_jQuery
    http://docs.jquery.com/UI/Datepicker
    http://multidatespickr.sourceforge.net/
-- >
<link type="text/css" href="assets/components/churchevents/jquery/css/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
-->
<link type="text/css" href="assets/components/churchevents/js/jquery/css/smoothness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
<script type="text/javascript" src="//code.jquery.com/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="assets/components/churchevents/js/jquery/js/jquery-ui-1.8.16.custom.min.js"></script>
<!-- loads mdp -->
<script type="text/javascript" src="assets/components/churchevents/js/jquery/multidate/jquery-ui.multidatespicker.js"></script>
<script type="text/javascript">
    
    // Toggle the elements:
    var show_times = false;
    var show_end_date = false;
    var show_daily = false;
    var show_weekly = false;
    var show_monthly = false;
    
    var daily_repeat = \'\';  
    var weekly_repeat = \'\';
    var monthly_repeat = \'\';
    var li_end_date = \'\';
    var ul_time = \'\';
    
    var myTimer = 0;
    
    $(function(){
        // Tabs
        $(\'#tabs\').tabs();

        // Dialog           
        $(\'#dialog\').dialog({
            autoOpen: false,
            width: 600,
            buttons: {
                "Ok": function() { 
                    $(this).dialog("close"); 
                }, 
                "Cancel": function() { 
                    $(this).dialog("close"); 
                } 
            }
        });
        
        // Dialog Link
        $(\'#dialog_link\').click(function(){
            $(\'#dialog\').dialog(\'open\');
            return false;
        });

        // Datepicker
        $(\'#txt_public_start\').datepicker({
            inline: true
            ,dateFormat: \'[[+datepickerFormat]]\' // \'yy-mm-dd\' - http://docs.jquery.com/UI/Datepicker/%24.datepicker.formatDate
            ,onSelect: function(dateText, inst) { 
                //setter
                $( "#txt_public_end" ).datepicker( "option", "minDate", new Date(dateText) );
                $( "#txt_exceptions" ).datepicker( "option", "minDate", new Date(dateText)  );
            }
        });
        $(\'#txt_public_end\').datepicker({
            inline: true
            ,dateFormat: \'[[+datepickerFormat]]\'
            ,onSelect: function(dateText, inst) { 
                //setter
                $( "#txt_exceptions" ).datepicker( "option", "maxDate", new Date(dateText)  );
            }
        });
        $(\'#txt_exceptions\').multiDatesPicker({showButtonPanel: true, dateFormat: \'[[+datepickerFormat]]\'});
        
        $( "#txt_public_end" ).datepicker( "option", "minDate", new Date($(\'#txt_public_start\').val()) );
        $( "#txt_exceptions" ).datepicker( "option", "minDate", new Date($(\'#txt_public_start\').val()) );
        $( "#txt_exceptions" ).datepicker( "option", "maxDate", new Date($(\'#txt_public_end\').val()) );
                
        //hover states on the static widgets
        $(\'#dialog_link, ul#icons li\').hover(
            function() { $(this).addClass(\'ui-state-hover\'); }, 
            function() { $(this).removeClass(\'ui-state-hover\'); }
        );
        
        
        
        // Event repeat:
        daily_repeat = $(\'#daily_repeat\');
        daily_repeat.hide();
        weekly_repeat = $(\'#weekly_repeat\');
        weekly_repeat.hide();
        monthly_repeat = $(\'#monthly_repeat\');
        monthly_repeat.hide();
        // event end date:
        li_end_date = $(\'.repeat_info\');
        li_end_date.hide();
        // event times:
        ul_time = $(\'#ul_time\');
        ul_time.hide();
        
        $("input.changeToggle").change(function() {
            toggleForm();
        });
        toggleForm();
    });
    
    

function toggleForm(){
    // End date:
    var repeatType = $(\'input:radio[name=repeat_type]:checked\').val();
    if ( repeatType == \'none\' && show_end_date ) {
        // hide repeat opitions:
        li_end_date.slideUp();
        daily_repeat.slideUp();
        weekly_repeat.slideUp();
        monthly_repeat.slideUp();
        show_end_date = false;
        show_daily = false;
        show_weekly = false;
        show_monthly = false;
    } else if ( repeatType == \'daily\' && !show_daily ) {
        // show Daily and end date: 
        li_end_date.slideDown();
        daily_repeat.slideDown();
        show_end_date = true;
        show_daily = true;
        if ( show_weekly ) {
            weekly_repeat.slideUp();
            show_weekly = false;
        }
        if ( show_monthly ) {
            monthly_repeat.slideUp();
            show_monthly = false;
        }
    } else if ( repeatType == \'weekly\' && !show_weekly ) {
        // show weekly and end date: 
        li_end_date.slideDown();
        weekly_repeat.slideDown();
        show_end_date = true;
        show_weekly = true;
        if ( show_daily ) {
            daily_repeat.slideUp();
            show_daily = false;
        }
        if ( show_monthly ) {
            monthly_repeat.slideUp();
            show_monthly = false;
        }
    } else if (  repeatType == \'monthly\' && !show_monthly ) {
        // show monthly and end date: 
        li_end_date.slideDown();
        monthly_repeat.slideDown();
        show_end_date = true;
        show_monthly = true;
        if ( show_daily ) {
            daily_repeat.slideUp();
            show_daily = false;
        }
        if ( show_weekly ) {
            weekly_repeat.slideUp();
            show_weekly = false;
        }
    }
    
    var eventTimed = $(\'input:radio[name=event_timed]:checked\').val();
    // Time:
    if ( eventTimed == \'Y\' && !show_times ) {
        // show time
        ul_time.slideDown();
        show_times = true;
    } else if ( eventTimed != \'Y\' && show_times ) {
        // hide time: 
        ul_time.slideUp();
        show_times = false;
    }
} 
</script>
<style >
.ui-state-highlight {
    background: none repeat scroll 0 0 #FCEFA1;
   /*    background: #fbf9ee url(images/ui-bg_glass_55_fbf9ee_1x400.png) 50% 50% repeat-x; */
}
.ui-state-highlight a.ui-state-default {
    background: #fff;
}
</style>

<!-- This if the orginal Mootools, you can use it if you want but I will no longer be developing it
<link rel="stylesheet" href="assets/components/churchevents/js/web/datepicker_vista/datepicker_vista.css" type="text/css" />
<script type="text/javascript" src="assets/components/churchevents/js/web/mootools-core-1.3.js"></script>
<script type="text/javascript" src="assets/components/churchevents/js/web/mootools-fx-1.3.js"></script>

<script type="text/javascript" src="assets/components/churchevents/js/web/mootools-more-date.js"></script>
<script type="text/javascript" src="assets/components/churchevents/js/web/datepicker.js"></script>
<script type="text/javascript" src="assets/components/churchevents/js/web/add.js"></script>
-->',
      'locked' => 0,
      'properties' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '<link rel="stylesheet" href="assets/components/churchevents/css/form.css" type="text/css" />
<!-- jQuery 
    http://docs.jquery.com/Downloading_jQuery
    http://docs.jquery.com/UI/Datepicker
    http://multidatespickr.sourceforge.net/
-- >
<link type="text/css" href="assets/components/churchevents/jquery/css/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
-->
<link type="text/css" href="assets/components/churchevents/js/jquery/css/smoothness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
<script type="text/javascript" src="//code.jquery.com/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="assets/components/churchevents/js/jquery/js/jquery-ui-1.8.16.custom.min.js"></script>
<!-- loads mdp -->
<script type="text/javascript" src="assets/components/churchevents/js/jquery/multidate/jquery-ui.multidatespicker.js"></script>
<script type="text/javascript">
    
    // Toggle the elements:
    var show_times = false;
    var show_end_date = false;
    var show_daily = false;
    var show_weekly = false;
    var show_monthly = false;
    
    var daily_repeat = \'\';  
    var weekly_repeat = \'\';
    var monthly_repeat = \'\';
    var li_end_date = \'\';
    var ul_time = \'\';
    
    var myTimer = 0;
    
    $(function(){
        // Tabs
        $(\'#tabs\').tabs();

        // Dialog           
        $(\'#dialog\').dialog({
            autoOpen: false,
            width: 600,
            buttons: {
                "Ok": function() { 
                    $(this).dialog("close"); 
                }, 
                "Cancel": function() { 
                    $(this).dialog("close"); 
                } 
            }
        });
        
        // Dialog Link
        $(\'#dialog_link\').click(function(){
            $(\'#dialog\').dialog(\'open\');
            return false;
        });

        // Datepicker
        $(\'#txt_public_start\').datepicker({
            inline: true
            ,dateFormat: \'[[+datepickerFormat]]\' // \'yy-mm-dd\' - http://docs.jquery.com/UI/Datepicker/%24.datepicker.formatDate
            ,onSelect: function(dateText, inst) { 
                //setter
                $( "#txt_public_end" ).datepicker( "option", "minDate", new Date(dateText) );
                $( "#txt_exceptions" ).datepicker( "option", "minDate", new Date(dateText)  );
            }
        });
        $(\'#txt_public_end\').datepicker({
            inline: true
            ,dateFormat: \'[[+datepickerFormat]]\'
            ,onSelect: function(dateText, inst) { 
                //setter
                $( "#txt_exceptions" ).datepicker( "option", "maxDate", new Date(dateText)  );
            }
        });
        $(\'#txt_exceptions\').multiDatesPicker({showButtonPanel: true, dateFormat: \'[[+datepickerFormat]]\'});
        
        $( "#txt_public_end" ).datepicker( "option", "minDate", new Date($(\'#txt_public_start\').val()) );
        $( "#txt_exceptions" ).datepicker( "option", "minDate", new Date($(\'#txt_public_start\').val()) );
        $( "#txt_exceptions" ).datepicker( "option", "maxDate", new Date($(\'#txt_public_end\').val()) );
                
        //hover states on the static widgets
        $(\'#dialog_link, ul#icons li\').hover(
            function() { $(this).addClass(\'ui-state-hover\'); }, 
            function() { $(this).removeClass(\'ui-state-hover\'); }
        );
        
        
        
        // Event repeat:
        daily_repeat = $(\'#daily_repeat\');
        daily_repeat.hide();
        weekly_repeat = $(\'#weekly_repeat\');
        weekly_repeat.hide();
        monthly_repeat = $(\'#monthly_repeat\');
        monthly_repeat.hide();
        // event end date:
        li_end_date = $(\'.repeat_info\');
        li_end_date.hide();
        // event times:
        ul_time = $(\'#ul_time\');
        ul_time.hide();
        
        $("input.changeToggle").change(function() {
            toggleForm();
        });
        toggleForm();
    });
    
    

function toggleForm(){
    // End date:
    var repeatType = $(\'input:radio[name=repeat_type]:checked\').val();
    if ( repeatType == \'none\' && show_end_date ) {
        // hide repeat opitions:
        li_end_date.slideUp();
        daily_repeat.slideUp();
        weekly_repeat.slideUp();
        monthly_repeat.slideUp();
        show_end_date = false;
        show_daily = false;
        show_weekly = false;
        show_monthly = false;
    } else if ( repeatType == \'daily\' && !show_daily ) {
        // show Daily and end date: 
        li_end_date.slideDown();
        daily_repeat.slideDown();
        show_end_date = true;
        show_daily = true;
        if ( show_weekly ) {
            weekly_repeat.slideUp();
            show_weekly = false;
        }
        if ( show_monthly ) {
            monthly_repeat.slideUp();
            show_monthly = false;
        }
    } else if ( repeatType == \'weekly\' && !show_weekly ) {
        // show weekly and end date: 
        li_end_date.slideDown();
        weekly_repeat.slideDown();
        show_end_date = true;
        show_weekly = true;
        if ( show_daily ) {
            daily_repeat.slideUp();
            show_daily = false;
        }
        if ( show_monthly ) {
            monthly_repeat.slideUp();
            show_monthly = false;
        }
    } else if (  repeatType == \'monthly\' && !show_monthly ) {
        // show monthly and end date: 
        li_end_date.slideDown();
        monthly_repeat.slideDown();
        show_end_date = true;
        show_monthly = true;
        if ( show_daily ) {
            daily_repeat.slideUp();
            show_daily = false;
        }
        if ( show_weekly ) {
            weekly_repeat.slideUp();
            show_weekly = false;
        }
    }
    
    var eventTimed = $(\'input:radio[name=event_timed]:checked\').val();
    // Time:
    if ( eventTimed == \'Y\' && !show_times ) {
        // show time
        ul_time.slideDown();
        show_times = true;
    } else if ( eventTimed != \'Y\' && show_times ) {
        // hide time: 
        ul_time.slideUp();
        show_times = false;
    }
} 
</script>
<style >
.ui-state-highlight {
    background: none repeat scroll 0 0 #FCEFA1;
   /*    background: #fbf9ee url(images/ui-bg_glass_55_fbf9ee_1x400.png) 50% 50% repeat-x; */
}
.ui-state-highlight a.ui-state-default {
    background: #fff;
}
</style>

<!-- This if the orginal Mootools, you can use it if you want but I will no longer be developing it
<link rel="stylesheet" href="assets/components/churchevents/js/web/datepicker_vista/datepicker_vista.css" type="text/css" />
<script type="text/javascript" src="assets/components/churchevents/js/web/mootools-core-1.3.js"></script>
<script type="text/javascript" src="assets/components/churchevents/js/web/mootools-fx-1.3.js"></script>

<script type="text/javascript" src="assets/components/churchevents/js/web/mootools-more-date.js"></script>
<script type="text/javascript" src="assets/components/churchevents/js/web/datepicker.js"></script>
<script type="text/javascript" src="assets/components/churchevents/js/web/add.js"></script>
-->',
    ),
  ),
  'e2f8585cc09ba19aa8adc9df2b224b89' => 
  array (
    'criteria' => 
    array (
      'name' => 'ChurchEvents_EventFormLocationTpl',
    ),
    'object' => 
    array (
      'id' => 26,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'ChurchEvents_EventFormLocationTpl',
      'description' => 'Loops through each location(room) and shows information on the event form page.  Only used if the Use Locations System Setting is Yes.',
      'editor_type' => 0,
      'category' => 4,
      'cache_type' => 0,
      'snippet' => '    <li class="autoWidth spaceRight">
        <input name="formLoc[]" type="checkbox" value="[[+id]]" [[+is_checked]] id="rd_location_[[+id]]" class="radio"  /> 
        <label for="rd_location_[[+id]]">[[+name]]</label> <span class="locationNotes">[[+notes]]</span>
    </li>',
      'locked' => 0,
      'properties' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '    <li class="autoWidth spaceRight">
        <input name="formLoc[]" type="checkbox" value="[[+id]]" [[+is_checked]] id="rd_location_[[+id]]" class="radio"  /> 
        <label for="rd_location_[[+id]]">[[+name]]</label> <span class="locationNotes">[[+notes]]</span>
    </li>',
    ),
  ),
  '194f427e885b66a110a8723408ee31fc' => 
  array (
    'criteria' => 
    array (
      'name' => 'ChurchEvents_EventFormLocationTypeTpl',
    ),
    'object' => 
    array (
      'id' => 27,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'ChurchEvents_EventFormLocationTypeTpl',
      'description' => 'Loops through each location type(building) and shows all locations(rooms) in it on the event form page.  Only used if the Use Locations System Setting is Yes.',
      'editor_type' => 0,
      'category' => 4,
      'cache_type' => 0,
      'snippet' => '<div id="building_type_[[!+id]]" class="clear locationHolder">
    <h2>[[+name]]</h2>
    <p>[[+notes]]</p>
    <ul>
        [[+locations]]
    </ul>
</div>',
      'locked' => 0,
      'properties' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '<div id="building_type_[[!+id]]" class="clear locationHolder">
    <h2>[[+name]]</h2>
    <p>[[+notes]]</p>
    <ul>
        [[+locations]]
    </ul>
</div>',
    ),
  ),
  '6a849e9fd3f8573184e0e7e16f8e1c1f' => 
  array (
    'criteria' => 
    array (
      'name' => 'ChurchEvents_EventFormRepeatTpl',
    ),
    'object' => 
    array (
      'id' => 28,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'ChurchEvents_EventFormRepeatTpl',
      'description' => 'Option for repeating events on the edit form, all or single instance',
      'editor_type' => 0,
      'category' => 4,
      'cache_type' => 0,
      'snippet' => '<fieldset>
    <legend>[[+repeat_heading]]</legend>
    <ul class="plan">
        <li class="full">
            <p class="small_font [[!+fi.error.edit_repeat:notempty=`formError`]]" style="margin:0;padding:0;">[[+editRepeat_heading]]</p>
            <ul>
                <li class="autoWidth spaceRight">
                    <input name="edit_repeat" type="radio" value="all" [[!+fi.edit_repeat:FormItIsChecked=`all`]] id="rd_edit_repeat_all" class="radio" /> 
                    <label for="rd_edit_repeat_all">[[+editRepeatAll_label]]</label>
                </li>
                <!-- Not yet a feature
                <li class="autoWidth spaceRight">
                    <input name="edit_repeat" type="radio" value="unchanged" id="rd_edit_repeat_un" class="radio"  /> 
                    <label for="rd_edit_repeat_un">Overide only unchanged instances</label>
                </li> -->
                <li class="autoWidth spaceRight">
                    <input name="edit_repeat" type="radio" value="instance" [[!+fi.edit_repeat:FormItIsChecked=`instance`]] id="rd_edit_repeat_single" class="radio" /> 
                    <label for="rd_edit_repeat_single">[[+editRepeatSingle_label]]</label>
                </li>
            </ul>
        </li>
    </ul>
</fieldset>
',
      'locked' => 0,
      'properties' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '<fieldset>
    <legend>[[+repeat_heading]]</legend>
    <ul class="plan">
        <li class="full">
            <p class="small_font [[!+fi.error.edit_repeat:notempty=`formError`]]" style="margin:0;padding:0;">[[+editRepeat_heading]]</p>
            <ul>
                <li class="autoWidth spaceRight">
                    <input name="edit_repeat" type="radio" value="all" [[!+fi.edit_repeat:FormItIsChecked=`all`]] id="rd_edit_repeat_all" class="radio" /> 
                    <label for="rd_edit_repeat_all">[[+editRepeatAll_label]]</label>
                </li>
                <!-- Not yet a feature
                <li class="autoWidth spaceRight">
                    <input name="edit_repeat" type="radio" value="unchanged" id="rd_edit_repeat_un" class="radio"  /> 
                    <label for="rd_edit_repeat_un">Overide only unchanged instances</label>
                </li> -->
                <li class="autoWidth spaceRight">
                    <input name="edit_repeat" type="radio" value="instance" [[!+fi.edit_repeat:FormItIsChecked=`instance`]] id="rd_edit_repeat_single" class="radio" /> 
                    <label for="rd_edit_repeat_single">[[+editRepeatSingle_label]]</label>
                </li>
            </ul>
        </li>
    </ul>
</fieldset>
',
    ),
  ),
  '77c9410a1d276ed581cb77c9d845bec0' => 
  array (
    'criteria' => 
    array (
      'name' => 'ChurchEvents_EventFormTpl',
    ),
    'object' => 
    array (
      'id' => 29,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'ChurchEvents_EventFormTpl',
      'description' => 'The add/edit event form, uses FormIt',
      'editor_type' => 0,
      'category' => 4,
      'cache_type' => 0,
      'snippet' => '[[!+fi.validation_error_message]]
[[+fi.errorMessage]]
[[+returnMessage]]
[[+fi.locationConflicts:notempty=`<div class="errors message"><h2>[[+conflictMessage]]</h2><ul>[[+fi.locationConflicts]]</ul></div>`]]
<form name="event_form" action="" method="post"  class="standard" >
    [[+adminInfo]]
<!--
    <input name="status" type="hidden" value="submitted" />
    <input name="event_type" type="hidden" value="public" />
-->

    [[+repeatOptions]]

[[!tinymce]]
    <fieldset>
        <legend>[[+event_heading]]</legend>
        <ul class="plan">
            <li class="spaceLeft">
                <p class="small_font [[!+fi.error.event_type:notempty=`formError`]]" style="margin:0;padding:0;">[[+eventType_heading]]</p>
                <ul>
                    <li class="autoWidth spaceRight">
                        <input name="event_type" type="radio" value="public" [[!+fi.event_type:FormItIsChecked=`public`]] id="rd_event_type_public" class="radio" /> 
                        <label for="rd_event_type_public">[[+eventTypePublic_label]]</label></li>
                    <li class="autoWidth">
                        <input name="event_type" type="radio" value="private" [[!+fi.event_type:FormItIsChecked=`private`]] id="rd_event_type_private" class="radio" /> 
                        <label for="rd_event_type_private">[[+eventTypePrivate_label]]</label>
                    </li>
                </ul>
            </li>
            <li class="full">
                <label for="txt_title" class="[[!+fi.error.title:notempty=`formError`]]">[[+title_label]]</label> 
                <input name="title" type="text" value="[[!+fi.title]]" id="txt_title" class="full" />
            </li>
            <li class="clear full">
                <input name="prominent" type="checkbox" value="Yes" id="ck_prominent" [[!+fi.prominent:FormItIsChecked=`Yes`]] class="radio"  />
                <label for="ck_prominent" class="[[!+fi.error.title:notempty=`formError`]]">[[+prominent_label]]</label>
            </li>
            <li class="full">
                <label for="txt_public_desc" class="[[!+fi.error.public_desc:notempty=`formError`]]">[[+publicDesc_label]]</label>
                <textarea name="public_desc" id="txt_public_desc" class="mceEditor" >[[!+fi.public_desc]]</textarea>
            </li>
            <li class="full">
                <label for="txt_notes" class="[[!+fi.error.notes:notempty=`formError`]]">[[+notes_label]]</label> 
                <textarea name="notes" id="txt_notes" >[[!+fi.notes]]</textarea>

            </li>
            <li class="spaceRight">
                <label for="txt_contact" class="[[!+fi.error.contact:notempty=`formError`]]">[[+contact_label]]</label> 
                <input name="contact" type="text" value="[[!+fi.contact]]" id="txt_contact" />
            </li>
            <li class="spaceRight">
                <label for="txt_contact_email" class="[[!+fi.error.contact_email:notempty=`formError`]]">[[+contactEmail_label]]</label> 
                <input name="contact_email" type="text" value="[[!+fi.contact_email]]" id="txt_contact_email" />
            </li>
            <li>
                <label for="txt_contact_phone" class="[[!+fi.error.contact_phone:notempty=`formError`]]">[[+contactPhone_label]]</label> 
                <input name="contact_phone" type="text" value="[[!+fi.contact_phone]]" id="txt_contact_phone" />
            </li>
            
            
            <li class="autoWidth spaceRight">
                <label for="sel_calendar_id" class="[[!+fi.error.calendar_id:notempty=`formError`]]">[[+calendar_label]]</label> 
                <br>
                <select name="calendar_id" id="sel_calendar_id" >
                    [[+fi.calendar_select]]
                </select>
            </li>
            <li class="autoWidth">
                <label for="sel_category_id" class="[[!+fi.error.category_id:notempty=`formError`]]">[[+category_label]]</label> 
                <br>
                <select name="category_id" id="sel_category_id" >
                    [[+fi.category_select]]
                </select>
            </li>
        </ul>
    </fieldset>
    
    
    <fieldset>
        <legend>[[+dateTime_heading]]</legend>
        
        <ul>
            <li class="full">
                <p class="small_font [[!+fi.error.repeat_type:notempty=`formError`]]" style="margin-top:0;padding-top:0;">[[+repeatType_heading]]</p>
                <ul>
                    <li class="autoWidth spaceRight">
                        <input name="repeat_type" type="radio" value="none" [[!+fi.repeat_type:FormItIsChecked=`none`]]  id="rd_repeat_type_none" class="radio changeToggle" /> 
                        <label for="rd_repeat_type_none">[[+repeatTypeNo_label]]</label>
                    </li>
                    <li class="autoWidth spaceRight">
                        <input name="repeat_type" type="radio" value="daily" [[!+fi.repeat_type:FormItIsChecked=`daily`]] id="rd_repeat_type_daily" class="radio changeToggle" /> 
                        <label for="rd_repeat_type_daily">[[+repeatTypeDaily_label]]</label>
                    </li>
                    <li class="autoWidth spaceRight">
                        <input name="repeat_type" type="radio" value="weekly" [[!+fi.repeat_type:FormItIsChecked=`weekly`]] id="rd_repeat_type_weekly" class="radio changeToggle" /> 
                        <label for="rd_repeat_type_weekly">[[+repeatTypeWeekly_label]]</label>
                    </li>

                    <li class="autoWidth spaceRight">
                        <input name="repeat_type" type="radio" value="monthly" [[!+fi.repeat_type:FormItIsChecked=`monthly`]] id="rd_repeat_type_monthly" class="radio changeToggle" /> 
                        <label for="rd_repeat_type_monthly">[[+repeatTypeMonthly_label]]</label>
                    </li>
                    
                </ul>
            </li>
            
            <!-- Daily repeat -->
            <li class="full" >
                <div id="daily_repeat" style="margin-left: 25px;">
                    <label for="sel_day_interval" class="[[!+fi.error.day_interval:notempty=`formError`]]">[[+interval_label]]</label> 
                    <select name="day_interval" id="sel_day_interval" >
                        <option value="1" >[[+repeatTypeDaily_option]]</option>
                        <option value="2" >[[+repeatTypeDailyOther_option]]</option>
                        <option value="3" >[[+repeatTypeDaily3_option]]</option>
                        <option value="4" >[[+repeatTypeDaily4_option]]</option>
                        <option value="5" >[[+repeatTypeDaily5_option]]</option>
                        <option value="6" >[[+repeatTypeDaily6_option]]</option>
                        <option value="7" >[[+repeatTypeDaily7_option]]</option>
                        
                    </select>
                </div>
            </li>
            
            <!-- Weekly repeat -->
            <li class="full">
                <div id="weekly_repeat" style="margin-left: 25px;">
                    <label for="sel_interval" class="[[!+fi.error.week_interval:notempty=`formError`]]">[[+interval_label]]</label> 
                            
                    <select name="week_interval" id="sel_interval" >
                        <option value="1">[[+repeatTypeWeekly_option]]</option>
                        <option value="2">[[+repeatTypeWeeklyOther_option]]</option>
                        <option value="3">[[+repeatTypeWeekly3_option]]</option>
                        <option value="4">[[+repeatTypeWeekly4_option]]</option>
                        <option value="5">[[+repeatTypeWeekly5_option]]</option>
                        <option value="6">[[+repeatTypeWeekly6_option]]</option>
                    </select>

                    <p class="small_font" class="[[!+fi.error.ch_days:notempty=`formError`]]">[[+whichDays_heading]]</p>
                    <table class="table_select">
                        <tr>
                        <td>
                            <input name="days_7" type="checkbox" value="Y" [[!+fi.days_7:FormItIsChecked=`Y`]] id="ck_days_7" class="radio"  />
                            <label for="ck_days_7">[[+sunday]]</label>
                        </td>
                        <td>
                            <input name="days_1" type="checkbox" value="Y" [[!+fi.days_1:FormItIsChecked=`Y`]] id="ck_days_1" class="radio"  />
                            <label for="ck_days_1">[[+monday]]</label>
                        </td>
                        <td>
                            <input name="days_2" type="checkbox" value="Y" [[!+fi.days_2:FormItIsChecked=`Y`]] id="ck_days_2" class="radio"  />
                            <label for="ck_days_2">[[+tuesday]]</label>
                        </td>
                        <td>
                            <input name="days_3" type="checkbox" value="Y" [[!+fi.days_3:FormItIsChecked=`Y`]] id="ck_days_3" class="radio"  />
                            <label for="ck_days_3">[[+wednesday]]</label>
                        </td>
                        <td>
                            <input name="days_4" type="checkbox" value="Y" [[!+fi.days_4:FormItIsChecked=`Y`]] id="ck_days_4" class="radio"  />
                            <label for="ck_days_4">[[+thursday]]</label>
                        </td>
                        <td>
                            <input name="days_5" type="checkbox" value="Y" [[!+fi.days_5:FormItIsChecked=`Y`]] id="ck_days_5" class="radio"  />
                            <label for="ck_days_5">[[+friday]]</label>
                        </td>
                        <td>
                            <input name="days_6" type="checkbox" value="Y" [[!+fi.days_6:FormItIsChecked=`Y`]] id="ck_days_6" class="radio"  />
                            <label for="ck_days_6">[[+saturday]]</label>
                        </td>
                    </tr>

                    </table>
                </div>
            </li>
            
            <!-- Monthly repeat -->
            <li class="full">
                <div id="monthly_repeat" style="margin-left: 25px;">
                    <label for="sel_mon_interval">[[+interval_label]]</label> 
                            
                <select name="month_interval" id="sel_mon_interval" > 
                    <option value="1">[[+repeatTypeMonthly_option]]</option>
                    <option value="2">[[+repeatTypeMonthlyOther_option]]</option>
                    <option value="3">[[+repeatTypeMonthly3_option]]</option>
                    <option value="4">[[+repeatTypeMonthly4_option]]</option>
                    <option value="5">[[+repeatTypeMonthly5_option]]</option>
                    <option value="6">[[+repeatTypeMonthly6_option]]</option>
                </select>
                    <p class="small_font">[[+whichMonthDays_heading]]</p>
                    <table class="table_select tGrid">
                        <tr>
                            <th>&nbsp;</th>
                            <th>[[+sunday]]</th>
                            <th>[[+monday]]</th>
                            <th>[[+tuesday]]</th>
                            <th>[[+wednesday]]</th>
                            <th>[[+thursday]]</th>
                            <th>[[+friday]]</th>
                            <th>[[+saturday]]</th>
                        </tr>
                        <tr>
                            <th>[[+firstWeek_heading]]</th>
                            <td>
                                <input name="month_days_0" type="checkbox" value="Y" [[!+fi.month_days_0:FormItIsChecked=`Y`]]  id="ck_month_days_0" class="radio"  />
                            </td>
                            <td>
                                <input name="month_days_1" type="checkbox" value="Y" [[!+fi.month_days_1:FormItIsChecked=`Y`]] id="ck_month_days_1" class="radio"  />
                            </td>
                            <td>
                                <input name="month_days_2" type="checkbox" value="Y" [[!+fi.month_days_2:FormItIsChecked=`Y`]] id="ck_month_days_2" class="radio"  />
                            </td>
                            <td>
                                <input name="month_days_3" type="checkbox" value="Y" [[!+fi.month_days_3:FormItIsChecked=`Y`]] id="ck_month_days_3" class="radio"  />
                            </td>
                            <td>
                                <input name="month_days_4" type="checkbox" value="Y" [[!+fi.month_days_4:FormItIsChecked=`Y`]] id="ck_month_days_4" class="radio"  />
                            </td>
                            <td>
                                <input name="month_days_5" type="checkbox" value="Y" [[!+fi.month_days_5:FormItIsChecked=`Y`]] id="ck_month_days_5" class="radio"  />
                            </td>
                            <td>
                                <input name="month_days_6" type="checkbox" value="Y" [[!+fi.month_days_6:FormItIsChecked=`Y`]] id="ck_month_days_6" class="radio"  />
                            </td>
                        </tr>
                        <tr>
                            <th>[[+secondWeek_heading]]</th>
                            <td>
                                <input name="month_days_7" type="checkbox" value="Y" [[!+fi.month_days_7:FormItIsChecked=`Y`]] id="ck_month_days_7" class="radio"  />
                            </td>
                            <td>
                                <input name="month_days_8" type="checkbox" value="Y" [[!+fi.month_days_8:FormItIsChecked=`Y`]] id="ck_month_days_8" class="radio"  />
                            </td>
                            <td>
                                <input name="month_days_9" type="checkbox" value="Y" [[!+fi.month_days_9:FormItIsChecked=`Y`]] id="ck_month_days_9" class="radio"  />
                            </td>
                            <td>
                                <input name="month_days_10" type="checkbox" value="Y" [[!+fi.month_days_10:FormItIsChecked=`Y`]] id="ck_month_days_10" class="radio"  />
                            </td>
                            <td>
                                <input name="month_days_11" type="checkbox" value="Y" [[!+fi.month_days_11:FormItIsChecked=`Y`]] id="ck_month_days_11" class="radio"  />
                            </td>
                            <td>
                                <input name="month_days_12" type="checkbox" value="Y" [[!+fi.month_days_12:FormItIsChecked=`Y`]] id="ck_month_days_12" class="radio"  />
                            </td>
                            <td>
                                <input name="month_days_13" type="checkbox" value="Y" [[!+fi.month_days_13:FormItIsChecked=`Y`]] id="ck_month_days_13" class="radio"  />
                            </td>
                        </tr>
                        <tr>
                            <th>[[+thirdWeek_heading]]</th>
                            <td>
                                <input name="month_days_14" type="checkbox" value="Y" [[!+fi.month_days_14:FormItIsChecked=`Y`]] id="ck_month_days_14" class="radio"  />
                            </td>
                            <td>
                                <input name="month_days_15" type="checkbox" value="Y" [[!+fi.month_days_15:FormItIsChecked=`Y`]] id="ck_month_days_15" class="radio"  />
                            </td>
                            <td>
                                <input name="month_days_16" type="checkbox" value="Y" [[!+fi.month_days_16:FormItIsChecked=`Y`]] id="ck_month_days_16" class="radio"  />
                            </td>
                            <td>
                                <input name="month_days_17" type="checkbox" value="Y" [[!+fi.month_days_17:FormItIsChecked=`Y`]] id="ck_month_days_17" class="radio"  />
                            </td>
                            <td>
                                <input name="month_days_18" type="checkbox" value="Y" [[!+fi.month_days_18:FormItIsChecked=`Y`]] id="ck_month_days_18" class="radio"  />
                            </td>
                            <td>
                                <input name="month_days_19" type="checkbox" value="Y" [[!+fi.month_days_19:FormItIsChecked=`Y`]] id="ck_month_days_19" class="radio"  />
                            </td>
                            <td>
                                <input name="month_days_20" type="checkbox" value="Y" [[!+fi.month_days_20:FormItIsChecked=`Y`]] id="ck_month_days_20" class="radio"  />
                            </td>
                        </tr>
                        <tr>
                            <th>[[+forthWeek_heading]]</th>
                            <td>
                                <input name="month_days_21" type="checkbox" value="Y" [[!+fi.month_days_21:FormItIsChecked=`Y`]] id="ck_month_days_21" class="radio"  />
                            </td>
                            <td>
                                <input name="month_days_22" type="checkbox" value="Y" [[!+fi.month_days_22:FormItIsChecked=`Y`]] id="ck_month_days_22" class="radio"  />
                            </td>
                    
                            <td>
                                <input name="month_days_23" type="checkbox" value="Y" [[!+fi.month_days_23:FormItIsChecked=`Y`]] id="ck_month_days_23" class="radio"  />
                            </td>
                            <td>
                                <input name="month_days_24" type="checkbox" value="Y" [[!+fi.month_days_24:FormItIsChecked=`Y`]] id="ck_month_days_24" class="radio"  />
                            </td>
                            <td>
                                <input name="month_days_25" type="checkbox" value="Y" [[!+fi.month_days_25:FormItIsChecked=`Y`]] id="ck_month_days_25" class="radio"  />
                            </td>
                    
                            <td>
                                <input name="month_days_26" type="checkbox" value="Y" [[!+fi.month_days_26:FormItIsChecked=`Y`]] id="ck_month_days_26" class="radio"  />
                            </td>
                            <td>
                                <input name="month_days_27" type="checkbox" value="Y" [[!+fi.month_days_27:FormItIsChecked=`Y`]] id="ck_month_days_27" class="radio"  />
                            </td>
                        </tr>
                        <tr>
                            <th>[[+fifthWeek_heading]]</th>
                            <td>
                                <input name="month_days_28" type="checkbox" value="Y" [[!+fi.month_days_28:FormItIsChecked=`Y`]] id="ck_month_days_28" class="radio"  />
                            </td>
                            <td>
                                <input name="month_days_29" type="checkbox" value="Y" [[!+fi.month_days_29:FormItIsChecked=`Y`]] id="ck_month_days_29" class="radio"  />
                            </td>
                            <td>
                                <input name="month_days_30" type="checkbox" value="Y" [[!+fi.month_days_30:FormItIsChecked=`Y`]] id="ck_month_days_30" class="radio"  />
                            </td>
                            <td>
                                <input name="month_days_31" type="checkbox" value="Y" [[!+fi.month_days_31:FormItIsChecked=`Y`]] id="ck_month_days_31" class="radio"  />
                            </td>
                            <td>
                                <input name="month_days_32" type="checkbox" value="Y" [[!+fi.month_days_32:FormItIsChecked=`Y`]] id="ck_month_days_32" class="radio"  />
                            </td>
                            <td>
                                <input name="month_days_33" type="checkbox" value="Y" [[!+fi.month_days_33:FormItIsChecked=`Y`]] id="ck_month_days_33" class="radio"  />
                            </td>
                            <td>
                                <input name="month_days_34" type="checkbox" value="Y" [[!+fi.month_days_34:FormItIsChecked=`Y`]] id="ck_month_days_34" class="radio"  />
                            </td>
                        </tr>
                    </table>
                </div>
            </li>
            <li>
                <label for="txt_public_start" class="displayBlock [[!+fi.error.public_start:notempty=`formError`]]">[[+publicStart_label]]</label>
                <input name="public_start" type="text" value="[[+fi.public_start]]" title="ex: 10/21/2011" class="date"  id="txt_public_start" />
            </li>
            <li>
                <div class="repeat_info">
                    <label for="txt_public_end"  class="displayBlock">[[+publicEnd_label]]</label>
                    <input name="public_end" type="text" value="[[+fi.public_end]]" title="ex: 10/21/2011" class="date"  id="txt_public_end"  />
                </div>
            </li>
            <li class="full">
                <div class="repeat_info">
                    <label for="txt_exceptions"  class="displayBlock">[[+exceptions_label]]</label>
                    <input type="text" name="exceptions" title="ex: 10/21/2011,10/222011"  class="full" id="txt_exceptions" value="[[+fi.exceptions]]"/>
                </div>
            </li>
            <li class="full clear">

                <p>[[+eventTimed_heading]]</p>
                <ul>
                    <li class="full">
                        <input name="event_timed" [[!+fi.event_timed:FormItIsChecked=`Y`]]  type="radio" value="Y" id="rd_event_timed_Y" class="radio changeToggle" /> 
                        <label for="rd_event_timed_Y">[[+eventTimedYes_label]]</label>
                        <div id="ul_time" style="height: 60px; margin-left: 25px;">
                            <ul>
                                <li class="autoWidth spaceRight">

                                    <label for="hour_1" class="displayBlock">[[+publicTime_label]]</label> 
                                            
                                    <select name="public_time_hr" title="Select the hour" class="hour" id="hour_1" >
                                        [[!+fi.public_hour_select]]
                                    </select> : 
                                    <select name="public_time_min" title="Select the minute" class="hour" id="min_1" >
                                        [[!+fi.public_minute_select]]
                                    </select> 
                                    <input name="public_time_am" type="radio" [[!+fi.public_am:FormItIsChecked=`am`]] value="am" class="am" id="am_1"  /> 
                                    <label for="am_1">am</label> 
                                    
                                    <input name="public_time_am" type="radio" [[!+fi.public_am:FormItIsChecked=`pm`]] value="pm" class="pm" id="pm_1"  /> 
                                    <label for="pm_1">pm</label> 
                                </li>

                                <li class="autoWidth spaceRight spaceLeft">
                                    <label for="hour_2" class="displayBlock">[[+duration_label]]</label>
                                            
                                        <select name="duration_hr" title="Select the hour" class="hour" id="hour_2" > 
                                            [[!+fi.duration_hour_select]]
                                        </select> : 
                                        <select name="duration_min" title="Select the minute" class="hour" id="min_2" > 
                                            [[!+fi.duration_minute_select]]
                                        </select>

                                </li>
                                <li class="autoWidth spaceRight spaceLeft">
                                    <label for="hour_3" class="displayBlock">[[+setupTime_label]]</label>
                                            
                                        <select name="setup_time_hr" title="Select the hour" class="hour" id="hour_3" > 
                                            [[!+fi.setup_hour_select]]
                                        </select> : 
                                        <select name="setup_time_min" title="Select the minute" class="hour" id="min_3" > 
                                            [[!+fi.setup_minute_select]]
                                        </select> 
                                        <input name="setup_time_am" type="radio" [[!+fi.setup_time_am:FormItIsChecked=`am`]] value="am" class="am" id="am_3"  /> 
                                        <label for="am_3">am</label> 
                                        
                                        <input name="setup_time_am" type="radio" [[!+fi.setup_time_am:FormItIsChecked=`pm`]] value="pm" class="pm" id="pm_3"  /> 
                                        <label for="pm_3">pm</label> 
                                </li>
                            </ul>
                        </div>
                    </li>
                    <!-- 
                    Future:
                    <li class="full">
                        <input name="event_timed" type="radio" value="N" id="rd_event_timed_N" class="radio changeToggle" /> 
                        <label for="rd_event_timed_N">No, this is just a note (will not check for conflicts)</label>
                    </li>
                    -->

                    <li class="full">
                        <input name="event_timed" type="radio" value="allday" [[!+fi.event_timed:FormItIsChecked=`allday`]] id="rd_event_timed_allday" class="radio changeToggle"  /> 
                        <label for="rd_event_timed_allday">[[+eventTimedAllday_label]]</label>
                    </li>
                    
                </ul>
            </li>
            
            <!-- 
            Future - Execptions:
            <li class="full">
                Are there days that this event will not take place of the repeated times?
            </li>
            -->
        </ul>
        
    </fieldset>
    <fieldset>
        <legend>[[+location_heading]]</legend>
        
        [[!+fi.locationInfo]]
    </fieldset>

    
    <p>
        <input name="a" type="hidden" value="0"/>
        <input name="view" type="hidden" value="[[+fi.view]]"  />
        <input name="event_id" type="hidden" value="[[+fi.event_id]]"  />
        
        <input name="submit" type="submit" value="[[+submit_button]]" class="submit" /> 
        <input name="cancel" type="submit" value="[[+cancel_button]]" class="submit" />

    </p>
</form>',
      'locked' => 0,
      'properties' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '[[!+fi.validation_error_message]]
[[+fi.errorMessage]]
[[+returnMessage]]
[[+fi.locationConflicts:notempty=`<div class="errors message"><h2>[[+conflictMessage]]</h2><ul>[[+fi.locationConflicts]]</ul></div>`]]
<form name="event_form" action="" method="post"  class="standard" >
    [[+adminInfo]]
<!--
    <input name="status" type="hidden" value="submitted" />
    <input name="event_type" type="hidden" value="public" />
-->

    [[+repeatOptions]]

[[!tinymce]]
    <fieldset>
        <legend>[[+event_heading]]</legend>
        <ul class="plan">
            <li class="spaceLeft">
                <p class="small_font [[!+fi.error.event_type:notempty=`formError`]]" style="margin:0;padding:0;">[[+eventType_heading]]</p>
                <ul>
                    <li class="autoWidth spaceRight">
                        <input name="event_type" type="radio" value="public" [[!+fi.event_type:FormItIsChecked=`public`]] id="rd_event_type_public" class="radio" /> 
                        <label for="rd_event_type_public">[[+eventTypePublic_label]]</label></li>
                    <li class="autoWidth">
                        <input name="event_type" type="radio" value="private" [[!+fi.event_type:FormItIsChecked=`private`]] id="rd_event_type_private" class="radio" /> 
                        <label for="rd_event_type_private">[[+eventTypePrivate_label]]</label>
                    </li>
                </ul>
            </li>
            <li class="full">
                <label for="txt_title" class="[[!+fi.error.title:notempty=`formError`]]">[[+title_label]]</label> 
                <input name="title" type="text" value="[[!+fi.title]]" id="txt_title" class="full" />
            </li>
            <li class="clear full">
                <input name="prominent" type="checkbox" value="Yes" id="ck_prominent" [[!+fi.prominent:FormItIsChecked=`Yes`]] class="radio"  />
                <label for="ck_prominent" class="[[!+fi.error.title:notempty=`formError`]]">[[+prominent_label]]</label>
            </li>
            <li class="full">
                <label for="txt_public_desc" class="[[!+fi.error.public_desc:notempty=`formError`]]">[[+publicDesc_label]]</label>
                <textarea name="public_desc" id="txt_public_desc" class="mceEditor" >[[!+fi.public_desc]]</textarea>
            </li>
            <li class="full">
                <label for="txt_notes" class="[[!+fi.error.notes:notempty=`formError`]]">[[+notes_label]]</label> 
                <textarea name="notes" id="txt_notes" >[[!+fi.notes]]</textarea>

            </li>
            <li class="spaceRight">
                <label for="txt_contact" class="[[!+fi.error.contact:notempty=`formError`]]">[[+contact_label]]</label> 
                <input name="contact" type="text" value="[[!+fi.contact]]" id="txt_contact" />
            </li>
            <li class="spaceRight">
                <label for="txt_contact_email" class="[[!+fi.error.contact_email:notempty=`formError`]]">[[+contactEmail_label]]</label> 
                <input name="contact_email" type="text" value="[[!+fi.contact_email]]" id="txt_contact_email" />
            </li>
            <li>
                <label for="txt_contact_phone" class="[[!+fi.error.contact_phone:notempty=`formError`]]">[[+contactPhone_label]]</label> 
                <input name="contact_phone" type="text" value="[[!+fi.contact_phone]]" id="txt_contact_phone" />
            </li>
            
            
            <li class="autoWidth spaceRight">
                <label for="sel_calendar_id" class="[[!+fi.error.calendar_id:notempty=`formError`]]">[[+calendar_label]]</label> 
                <br>
                <select name="calendar_id" id="sel_calendar_id" >
                    [[+fi.calendar_select]]
                </select>
            </li>
            <li class="autoWidth">
                <label for="sel_category_id" class="[[!+fi.error.category_id:notempty=`formError`]]">[[+category_label]]</label> 
                <br>
                <select name="category_id" id="sel_category_id" >
                    [[+fi.category_select]]
                </select>
            </li>
        </ul>
    </fieldset>
    
    
    <fieldset>
        <legend>[[+dateTime_heading]]</legend>
        
        <ul>
            <li class="full">
                <p class="small_font [[!+fi.error.repeat_type:notempty=`formError`]]" style="margin-top:0;padding-top:0;">[[+repeatType_heading]]</p>
                <ul>
                    <li class="autoWidth spaceRight">
                        <input name="repeat_type" type="radio" value="none" [[!+fi.repeat_type:FormItIsChecked=`none`]]  id="rd_repeat_type_none" class="radio changeToggle" /> 
                        <label for="rd_repeat_type_none">[[+repeatTypeNo_label]]</label>
                    </li>
                    <li class="autoWidth spaceRight">
                        <input name="repeat_type" type="radio" value="daily" [[!+fi.repeat_type:FormItIsChecked=`daily`]] id="rd_repeat_type_daily" class="radio changeToggle" /> 
                        <label for="rd_repeat_type_daily">[[+repeatTypeDaily_label]]</label>
                    </li>
                    <li class="autoWidth spaceRight">
                        <input name="repeat_type" type="radio" value="weekly" [[!+fi.repeat_type:FormItIsChecked=`weekly`]] id="rd_repeat_type_weekly" class="radio changeToggle" /> 
                        <label for="rd_repeat_type_weekly">[[+repeatTypeWeekly_label]]</label>
                    </li>

                    <li class="autoWidth spaceRight">
                        <input name="repeat_type" type="radio" value="monthly" [[!+fi.repeat_type:FormItIsChecked=`monthly`]] id="rd_repeat_type_monthly" class="radio changeToggle" /> 
                        <label for="rd_repeat_type_monthly">[[+repeatTypeMonthly_label]]</label>
                    </li>
                    
                </ul>
            </li>
            
            <!-- Daily repeat -->
            <li class="full" >
                <div id="daily_repeat" style="margin-left: 25px;">
                    <label for="sel_day_interval" class="[[!+fi.error.day_interval:notempty=`formError`]]">[[+interval_label]]</label> 
                    <select name="day_interval" id="sel_day_interval" >
                        <option value="1" >[[+repeatTypeDaily_option]]</option>
                        <option value="2" >[[+repeatTypeDailyOther_option]]</option>
                        <option value="3" >[[+repeatTypeDaily3_option]]</option>
                        <option value="4" >[[+repeatTypeDaily4_option]]</option>
                        <option value="5" >[[+repeatTypeDaily5_option]]</option>
                        <option value="6" >[[+repeatTypeDaily6_option]]</option>
                        <option value="7" >[[+repeatTypeDaily7_option]]</option>
                        
                    </select>
                </div>
            </li>
            
            <!-- Weekly repeat -->
            <li class="full">
                <div id="weekly_repeat" style="margin-left: 25px;">
                    <label for="sel_interval" class="[[!+fi.error.week_interval:notempty=`formError`]]">[[+interval_label]]</label> 
                            
                    <select name="week_interval" id="sel_interval" >
                        <option value="1">[[+repeatTypeWeekly_option]]</option>
                        <option value="2">[[+repeatTypeWeeklyOther_option]]</option>
                        <option value="3">[[+repeatTypeWeekly3_option]]</option>
                        <option value="4">[[+repeatTypeWeekly4_option]]</option>
                        <option value="5">[[+repeatTypeWeekly5_option]]</option>
                        <option value="6">[[+repeatTypeWeekly6_option]]</option>
                    </select>

                    <p class="small_font" class="[[!+fi.error.ch_days:notempty=`formError`]]">[[+whichDays_heading]]</p>
                    <table class="table_select">
                        <tr>
                        <td>
                            <input name="days_7" type="checkbox" value="Y" [[!+fi.days_7:FormItIsChecked=`Y`]] id="ck_days_7" class="radio"  />
                            <label for="ck_days_7">[[+sunday]]</label>
                        </td>
                        <td>
                            <input name="days_1" type="checkbox" value="Y" [[!+fi.days_1:FormItIsChecked=`Y`]] id="ck_days_1" class="radio"  />
                            <label for="ck_days_1">[[+monday]]</label>
                        </td>
                        <td>
                            <input name="days_2" type="checkbox" value="Y" [[!+fi.days_2:FormItIsChecked=`Y`]] id="ck_days_2" class="radio"  />
                            <label for="ck_days_2">[[+tuesday]]</label>
                        </td>
                        <td>
                            <input name="days_3" type="checkbox" value="Y" [[!+fi.days_3:FormItIsChecked=`Y`]] id="ck_days_3" class="radio"  />
                            <label for="ck_days_3">[[+wednesday]]</label>
                        </td>
                        <td>
                            <input name="days_4" type="checkbox" value="Y" [[!+fi.days_4:FormItIsChecked=`Y`]] id="ck_days_4" class="radio"  />
                            <label for="ck_days_4">[[+thursday]]</label>
                        </td>
                        <td>
                            <input name="days_5" type="checkbox" value="Y" [[!+fi.days_5:FormItIsChecked=`Y`]] id="ck_days_5" class="radio"  />
                            <label for="ck_days_5">[[+friday]]</label>
                        </td>
                        <td>
                            <input name="days_6" type="checkbox" value="Y" [[!+fi.days_6:FormItIsChecked=`Y`]] id="ck_days_6" class="radio"  />
                            <label for="ck_days_6">[[+saturday]]</label>
                        </td>
                    </tr>

                    </table>
                </div>
            </li>
            
            <!-- Monthly repeat -->
            <li class="full">
                <div id="monthly_repeat" style="margin-left: 25px;">
                    <label for="sel_mon_interval">[[+interval_label]]</label> 
                            
                <select name="month_interval" id="sel_mon_interval" > 
                    <option value="1">[[+repeatTypeMonthly_option]]</option>
                    <option value="2">[[+repeatTypeMonthlyOther_option]]</option>
                    <option value="3">[[+repeatTypeMonthly3_option]]</option>
                    <option value="4">[[+repeatTypeMonthly4_option]]</option>
                    <option value="5">[[+repeatTypeMonthly5_option]]</option>
                    <option value="6">[[+repeatTypeMonthly6_option]]</option>
                </select>
                    <p class="small_font">[[+whichMonthDays_heading]]</p>
                    <table class="table_select tGrid">
                        <tr>
                            <th>&nbsp;</th>
                            <th>[[+sunday]]</th>
                            <th>[[+monday]]</th>
                            <th>[[+tuesday]]</th>
                            <th>[[+wednesday]]</th>
                            <th>[[+thursday]]</th>
                            <th>[[+friday]]</th>
                            <th>[[+saturday]]</th>
                        </tr>
                        <tr>
                            <th>[[+firstWeek_heading]]</th>
                            <td>
                                <input name="month_days_0" type="checkbox" value="Y" [[!+fi.month_days_0:FormItIsChecked=`Y`]]  id="ck_month_days_0" class="radio"  />
                            </td>
                            <td>
                                <input name="month_days_1" type="checkbox" value="Y" [[!+fi.month_days_1:FormItIsChecked=`Y`]] id="ck_month_days_1" class="radio"  />
                            </td>
                            <td>
                                <input name="month_days_2" type="checkbox" value="Y" [[!+fi.month_days_2:FormItIsChecked=`Y`]] id="ck_month_days_2" class="radio"  />
                            </td>
                            <td>
                                <input name="month_days_3" type="checkbox" value="Y" [[!+fi.month_days_3:FormItIsChecked=`Y`]] id="ck_month_days_3" class="radio"  />
                            </td>
                            <td>
                                <input name="month_days_4" type="checkbox" value="Y" [[!+fi.month_days_4:FormItIsChecked=`Y`]] id="ck_month_days_4" class="radio"  />
                            </td>
                            <td>
                                <input name="month_days_5" type="checkbox" value="Y" [[!+fi.month_days_5:FormItIsChecked=`Y`]] id="ck_month_days_5" class="radio"  />
                            </td>
                            <td>
                                <input name="month_days_6" type="checkbox" value="Y" [[!+fi.month_days_6:FormItIsChecked=`Y`]] id="ck_month_days_6" class="radio"  />
                            </td>
                        </tr>
                        <tr>
                            <th>[[+secondWeek_heading]]</th>
                            <td>
                                <input name="month_days_7" type="checkbox" value="Y" [[!+fi.month_days_7:FormItIsChecked=`Y`]] id="ck_month_days_7" class="radio"  />
                            </td>
                            <td>
                                <input name="month_days_8" type="checkbox" value="Y" [[!+fi.month_days_8:FormItIsChecked=`Y`]] id="ck_month_days_8" class="radio"  />
                            </td>
                            <td>
                                <input name="month_days_9" type="checkbox" value="Y" [[!+fi.month_days_9:FormItIsChecked=`Y`]] id="ck_month_days_9" class="radio"  />
                            </td>
                            <td>
                                <input name="month_days_10" type="checkbox" value="Y" [[!+fi.month_days_10:FormItIsChecked=`Y`]] id="ck_month_days_10" class="radio"  />
                            </td>
                            <td>
                                <input name="month_days_11" type="checkbox" value="Y" [[!+fi.month_days_11:FormItIsChecked=`Y`]] id="ck_month_days_11" class="radio"  />
                            </td>
                            <td>
                                <input name="month_days_12" type="checkbox" value="Y" [[!+fi.month_days_12:FormItIsChecked=`Y`]] id="ck_month_days_12" class="radio"  />
                            </td>
                            <td>
                                <input name="month_days_13" type="checkbox" value="Y" [[!+fi.month_days_13:FormItIsChecked=`Y`]] id="ck_month_days_13" class="radio"  />
                            </td>
                        </tr>
                        <tr>
                            <th>[[+thirdWeek_heading]]</th>
                            <td>
                                <input name="month_days_14" type="checkbox" value="Y" [[!+fi.month_days_14:FormItIsChecked=`Y`]] id="ck_month_days_14" class="radio"  />
                            </td>
                            <td>
                                <input name="month_days_15" type="checkbox" value="Y" [[!+fi.month_days_15:FormItIsChecked=`Y`]] id="ck_month_days_15" class="radio"  />
                            </td>
                            <td>
                                <input name="month_days_16" type="checkbox" value="Y" [[!+fi.month_days_16:FormItIsChecked=`Y`]] id="ck_month_days_16" class="radio"  />
                            </td>
                            <td>
                                <input name="month_days_17" type="checkbox" value="Y" [[!+fi.month_days_17:FormItIsChecked=`Y`]] id="ck_month_days_17" class="radio"  />
                            </td>
                            <td>
                                <input name="month_days_18" type="checkbox" value="Y" [[!+fi.month_days_18:FormItIsChecked=`Y`]] id="ck_month_days_18" class="radio"  />
                            </td>
                            <td>
                                <input name="month_days_19" type="checkbox" value="Y" [[!+fi.month_days_19:FormItIsChecked=`Y`]] id="ck_month_days_19" class="radio"  />
                            </td>
                            <td>
                                <input name="month_days_20" type="checkbox" value="Y" [[!+fi.month_days_20:FormItIsChecked=`Y`]] id="ck_month_days_20" class="radio"  />
                            </td>
                        </tr>
                        <tr>
                            <th>[[+forthWeek_heading]]</th>
                            <td>
                                <input name="month_days_21" type="checkbox" value="Y" [[!+fi.month_days_21:FormItIsChecked=`Y`]] id="ck_month_days_21" class="radio"  />
                            </td>
                            <td>
                                <input name="month_days_22" type="checkbox" value="Y" [[!+fi.month_days_22:FormItIsChecked=`Y`]] id="ck_month_days_22" class="radio"  />
                            </td>
                    
                            <td>
                                <input name="month_days_23" type="checkbox" value="Y" [[!+fi.month_days_23:FormItIsChecked=`Y`]] id="ck_month_days_23" class="radio"  />
                            </td>
                            <td>
                                <input name="month_days_24" type="checkbox" value="Y" [[!+fi.month_days_24:FormItIsChecked=`Y`]] id="ck_month_days_24" class="radio"  />
                            </td>
                            <td>
                                <input name="month_days_25" type="checkbox" value="Y" [[!+fi.month_days_25:FormItIsChecked=`Y`]] id="ck_month_days_25" class="radio"  />
                            </td>
                    
                            <td>
                                <input name="month_days_26" type="checkbox" value="Y" [[!+fi.month_days_26:FormItIsChecked=`Y`]] id="ck_month_days_26" class="radio"  />
                            </td>
                            <td>
                                <input name="month_days_27" type="checkbox" value="Y" [[!+fi.month_days_27:FormItIsChecked=`Y`]] id="ck_month_days_27" class="radio"  />
                            </td>
                        </tr>
                        <tr>
                            <th>[[+fifthWeek_heading]]</th>
                            <td>
                                <input name="month_days_28" type="checkbox" value="Y" [[!+fi.month_days_28:FormItIsChecked=`Y`]] id="ck_month_days_28" class="radio"  />
                            </td>
                            <td>
                                <input name="month_days_29" type="checkbox" value="Y" [[!+fi.month_days_29:FormItIsChecked=`Y`]] id="ck_month_days_29" class="radio"  />
                            </td>
                            <td>
                                <input name="month_days_30" type="checkbox" value="Y" [[!+fi.month_days_30:FormItIsChecked=`Y`]] id="ck_month_days_30" class="radio"  />
                            </td>
                            <td>
                                <input name="month_days_31" type="checkbox" value="Y" [[!+fi.month_days_31:FormItIsChecked=`Y`]] id="ck_month_days_31" class="radio"  />
                            </td>
                            <td>
                                <input name="month_days_32" type="checkbox" value="Y" [[!+fi.month_days_32:FormItIsChecked=`Y`]] id="ck_month_days_32" class="radio"  />
                            </td>
                            <td>
                                <input name="month_days_33" type="checkbox" value="Y" [[!+fi.month_days_33:FormItIsChecked=`Y`]] id="ck_month_days_33" class="radio"  />
                            </td>
                            <td>
                                <input name="month_days_34" type="checkbox" value="Y" [[!+fi.month_days_34:FormItIsChecked=`Y`]] id="ck_month_days_34" class="radio"  />
                            </td>
                        </tr>
                    </table>
                </div>
            </li>
            <li>
                <label for="txt_public_start" class="displayBlock [[!+fi.error.public_start:notempty=`formError`]]">[[+publicStart_label]]</label>
                <input name="public_start" type="text" value="[[+fi.public_start]]" title="ex: 10/21/2011" class="date"  id="txt_public_start" />
            </li>
            <li>
                <div class="repeat_info">
                    <label for="txt_public_end"  class="displayBlock">[[+publicEnd_label]]</label>
                    <input name="public_end" type="text" value="[[+fi.public_end]]" title="ex: 10/21/2011" class="date"  id="txt_public_end"  />
                </div>
            </li>
            <li class="full">
                <div class="repeat_info">
                    <label for="txt_exceptions"  class="displayBlock">[[+exceptions_label]]</label>
                    <input type="text" name="exceptions" title="ex: 10/21/2011,10/222011"  class="full" id="txt_exceptions" value="[[+fi.exceptions]]"/>
                </div>
            </li>
            <li class="full clear">

                <p>[[+eventTimed_heading]]</p>
                <ul>
                    <li class="full">
                        <input name="event_timed" [[!+fi.event_timed:FormItIsChecked=`Y`]]  type="radio" value="Y" id="rd_event_timed_Y" class="radio changeToggle" /> 
                        <label for="rd_event_timed_Y">[[+eventTimedYes_label]]</label>
                        <div id="ul_time" style="height: 60px; margin-left: 25px;">
                            <ul>
                                <li class="autoWidth spaceRight">

                                    <label for="hour_1" class="displayBlock">[[+publicTime_label]]</label> 
                                            
                                    <select name="public_time_hr" title="Select the hour" class="hour" id="hour_1" >
                                        [[!+fi.public_hour_select]]
                                    </select> : 
                                    <select name="public_time_min" title="Select the minute" class="hour" id="min_1" >
                                        [[!+fi.public_minute_select]]
                                    </select> 
                                    <input name="public_time_am" type="radio" [[!+fi.public_am:FormItIsChecked=`am`]] value="am" class="am" id="am_1"  /> 
                                    <label for="am_1">am</label> 
                                    
                                    <input name="public_time_am" type="radio" [[!+fi.public_am:FormItIsChecked=`pm`]] value="pm" class="pm" id="pm_1"  /> 
                                    <label for="pm_1">pm</label> 
                                </li>

                                <li class="autoWidth spaceRight spaceLeft">
                                    <label for="hour_2" class="displayBlock">[[+duration_label]]</label>
                                            
                                        <select name="duration_hr" title="Select the hour" class="hour" id="hour_2" > 
                                            [[!+fi.duration_hour_select]]
                                        </select> : 
                                        <select name="duration_min" title="Select the minute" class="hour" id="min_2" > 
                                            [[!+fi.duration_minute_select]]
                                        </select>

                                </li>
                                <li class="autoWidth spaceRight spaceLeft">
                                    <label for="hour_3" class="displayBlock">[[+setupTime_label]]</label>
                                            
                                        <select name="setup_time_hr" title="Select the hour" class="hour" id="hour_3" > 
                                            [[!+fi.setup_hour_select]]
                                        </select> : 
                                        <select name="setup_time_min" title="Select the minute" class="hour" id="min_3" > 
                                            [[!+fi.setup_minute_select]]
                                        </select> 
                                        <input name="setup_time_am" type="radio" [[!+fi.setup_time_am:FormItIsChecked=`am`]] value="am" class="am" id="am_3"  /> 
                                        <label for="am_3">am</label> 
                                        
                                        <input name="setup_time_am" type="radio" [[!+fi.setup_time_am:FormItIsChecked=`pm`]] value="pm" class="pm" id="pm_3"  /> 
                                        <label for="pm_3">pm</label> 
                                </li>
                            </ul>
                        </div>
                    </li>
                    <!-- 
                    Future:
                    <li class="full">
                        <input name="event_timed" type="radio" value="N" id="rd_event_timed_N" class="radio changeToggle" /> 
                        <label for="rd_event_timed_N">No, this is just a note (will not check for conflicts)</label>
                    </li>
                    -->

                    <li class="full">
                        <input name="event_timed" type="radio" value="allday" [[!+fi.event_timed:FormItIsChecked=`allday`]] id="rd_event_timed_allday" class="radio changeToggle"  /> 
                        <label for="rd_event_timed_allday">[[+eventTimedAllday_label]]</label>
                    </li>
                    
                </ul>
            </li>
            
            <!-- 
            Future - Execptions:
            <li class="full">
                Are there days that this event will not take place of the repeated times?
            </li>
            -->
        </ul>
        
    </fieldset>
    <fieldset>
        <legend>[[+location_heading]]</legend>
        
        [[!+fi.locationInfo]]
    </fieldset>

    
    <p>
        <input name="a" type="hidden" value="0"/>
        <input name="view" type="hidden" value="[[+fi.view]]"  />
        <input name="event_id" type="hidden" value="[[+fi.event_id]]"  />
        
        <input name="submit" type="submit" value="[[+submit_button]]" class="submit" /> 
        <input name="cancel" type="submit" value="[[+cancel_button]]" class="submit" />

    </p>
</form>',
    ),
  ),
  '709f316b5e907d02703993520fb6af26' => 
  array (
    'criteria' => 
    array (
      'name' => 'ChurchEvents_HeadTpl',
    ),
    'object' => 
    array (
      'id' => 30,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'ChurchEvents_HeadTpl',
      'description' => 'This is the JS/CSS for the calendar goes in the <head> and can use the results from looping categoryHeadTpl like [[+categoryHeadTpl]]',
      'editor_type' => 0,
      'category' => 4,
      'cache_type' => 0,
      'snippet' => '<link rel="stylesheet" href="[[+assets_url]]/components/churchevents/css/calendar.css" type="text/css" />
<link rel="stylesheet" href="[[+assets_url]]/components/churchevents/css/form.css" type="text/css" />
<style type="text/css" media="all">
    /* this is a loop from CategoryHeadTpl */
	[[+categoryHeadTpl]]
</style>
<!--<script type="text/javascript" src="//code.jquery.com/jquery-1.7.1.min.js"></script>-->
<script type="text/javascript">
    
    // Toggle the elements:
    var show_locfilter = false;

    $(function(){
        locFilter = $(\'#filterLocationsHolder\');
        //locFilter.hide();
        $("input.changeToggle").change(function() {
            toggleForm(true);
        });
        toggleForm(false);
    });
    
function toggleForm(slide){
    // End date:
    var filterLocation = $(\'input:radio[name=filterLocations]:checked\').val();
    if ( filterLocation == 1 ) {
        locFilter.slideDown();
        
    } else {
        // show Daily and end date:
        if ( slide ) {
            locFilter.slideUp();
        } else {
            locFilter.hide();
        }
    } 
} 
</script>',
      'locked' => 0,
      'properties' => 'a:0:{}',
      'static' => 0,
      'static_file' => '',
      'content' => '<link rel="stylesheet" href="[[+assets_url]]/components/churchevents/css/calendar.css" type="text/css" />
<link rel="stylesheet" href="[[+assets_url]]/components/churchevents/css/form.css" type="text/css" />
<style type="text/css" media="all">
    /* this is a loop from CategoryHeadTpl */
	[[+categoryHeadTpl]]
</style>
<!--<script type="text/javascript" src="//code.jquery.com/jquery-1.7.1.min.js"></script>-->
<script type="text/javascript">
    
    // Toggle the elements:
    var show_locfilter = false;

    $(function(){
        locFilter = $(\'#filterLocationsHolder\');
        //locFilter.hide();
        $("input.changeToggle").change(function() {
            toggleForm(true);
        });
        toggleForm(false);
    });
    
function toggleForm(slide){
    // End date:
    var filterLocation = $(\'input:radio[name=filterLocations]:checked\').val();
    if ( filterLocation == 1 ) {
        locFilter.slideDown();
        
    } else {
        // show Daily and end date:
        if ( slide ) {
            locFilter.slideUp();
        } else {
            locFilter.hide();
        }
    } 
} 
</script>',
    ),
  ),
  'c899389679394959fe180e874d6e8095' => 
  array (
    'criteria' => 
    array (
      'name' => 'ChurchEvents_ListDayHolderTpl',
    ),
    'object' => 
    array (
      'id' => 31,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'ChurchEvents_ListDayHolderTpl',
      'description' => 'The holder for a list of events.',
      'editor_type' => 0,
      'category' => 4,
      'cache_type' => 0,
      'snippet' => '<li>
    <span class="date">[[+timestamp:date=`%b`]] <!-- [[+month]] --><br />
    <span class="day">[[+day]]</span></span>
    <ul> 
        [[+listEventTpl]]
    </ul>
</li>',
      'locked' => 0,
      'properties' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '<li>
    <span class="date">[[+timestamp:date=`%b`]] <!-- [[+month]] --><br />
    <span class="day">[[+day]]</span></span>
    <ul> 
        [[+listEventTpl]]
    </ul>
</li>',
    ),
  ),
  'f13616e2df401167a1650db2630d416f' => 
  array (
    'criteria' => 
    array (
      'name' => 'ChurchEvents_ListEventTpl',
    ),
    'object' => 
    array (
      'id' => 32,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'ChurchEvents_ListEventTpl',
      'description' => 'The event details for the list, ListDayHolderTpl',
      'editor_type' => 0,
      'category' => 4,
      'cache_type' => 0,
      'snippet' => '<li>
    <h3><a href="[[+event_url]]">[[+event_title]]</a></h3>
    <p>[[+start_time]] <!-- [[+end_time]] | Multiple Locations --></p>
</li>',
      'locked' => 0,
      'properties' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '<li>
    <h3><a href="[[+event_url]]">[[+event_title]]</a></h3>
    <p>[[+start_time]] <!-- [[+end_time]] | Multiple Locations --></p>
</li>',
    ),
  ),
  '5a14693087310ae557c91fa669412151' => 
  array (
    'criteria' => 
    array (
      'name' => 'EmailBasicLocationTpl',
    ),
    'object' => 
    array (
      'id' => 33,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'EmailBasicLocationTpl',
      'description' => 'Basic location information, only used if the Use Locations System Setting is No.',
      'editor_type' => 0,
      'category' => 4,
      'cache_type' => 0,
      'snippet' => '<ul>
    <li>
        [[+location_name]]
    </li>
    <li>
        [[+address]] <br /> 
        [[+city]] [[+state]] [[+zip]] [[+country]]
    </li>
</ul>
',
      'locked' => 0,
      'properties' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '<ul>
    <li>
        [[+location_name]]
    </li>
    <li>
        [[+address]] <br /> 
        [[+city]] [[+state]] [[+zip]] [[+country]]
    </li>
</ul>
',
    ),
  ),
  'c6778a63173f487e554798fb6e6933dc' => 
  array (
    'criteria' => 
    array (
      'name' => 'EmailLocationTpl',
    ),
    'object' => 
    array (
      'id' => 34,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'EmailLocationTpl',
      'description' => 'Loops through each location(room) and shows information on the event request email.  Only used if the Use Locations System Setting is Yes.',
      'editor_type' => 0,
      'category' => 4,
      'cache_type' => 0,
      'snippet' => '<li>
    [[+name]] [[+map_url:notempty=`<a href="[[+map_url]]" target="_blank">Map</a>`]]
</li>',
      'locked' => 0,
      'properties' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '<li>
    [[+name]] [[+map_url:notempty=`<a href="[[+map_url]]" target="_blank">Map</a>`]]
</li>',
    ),
  ),
  'e187e23de99cfe585b7b8216877233cc' => 
  array (
    'criteria' => 
    array (
      'name' => 'EmailLocationTypeTpl',
    ),
    'object' => 
    array (
      'id' => 35,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'EmailLocationTypeTpl',
      'description' => 'Loops through each location type(building) and shows all locations(rooms) in it on the event request email.  Only used if the Use Locations System Setting is Yes.',
      'editor_type' => 0,
      'category' => 4,
      'cache_type' => 0,
      'snippet' => '<div id="building_type_[[!+id]]" class="locationHolder">
    <h3>[[+name]]</h3>
    <p>[[+notes]]</p>
    <ul>
        [[+locations]]
    </ul>
</div>',
      'locked' => 0,
      'properties' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '<div id="building_type_[[!+id]]" class="locationHolder">
    <h3>[[+name]]</h3>
    <p>[[+notes]]</p>
    <ul>
        [[+locations]]
    </ul>
</div>',
    ),
  ),
  '0499dcf88b37e2de72e232ee99637a93' => 
  array (
    'criteria' => 
    array (
      'name' => 'EmailRequestNoticeTpl',
    ),
    'object' => 
    array (
      'id' => 36,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'EmailRequestNoticeTpl',
      'description' => 'The is the email that will be send if a user requests an event.',
      'editor_type' => 0,
      'category' => 4,
      'cache_type' => 0,
      'snippet' => '<div>
    <p>An event has been submitted.</p>
    
    <h2>[[+event_title]]</h2>

    <p><a href="[[+eventUrl]]">[[+descEdit_link]]</a></p>
    
    <ul>
        <li><strong>[[+descDate_heading]]</strong> 
            [[+start_time]] [[+end_time:notempty=`&ndash; [[+end_time]], `]] [[+event_date]] </li>
        <!-- <li><strong>Repeats</strong> </li> 
        <li><strong>[[+descNextDate_heading]]</strong> [[+nextDate]] [[+nextTime]]</li>
            -->
       
        <li><strong>[[+descDescription_heading]]</strong> [[+public_desc]]</li>

        <li><strong>[[+descContact_heading]]</strong>
            <ul>
                <li>[[+contact]]</li>
                <li>[[+contact_email:notempty=`<a href="mailto:[[+contact_email]]">[[+contact_email]]</a>`]]</li>
            </ul>
        </li>
        <!-- <li><strong>Calendar</strong> </li>
        <li><strong>Category</strong> </li> -->

        <li><strong>[[+descLocation_heading]]</strong>
            <!-- this is processing another chunk -->  
            [[+locationInfo]]
        </li>
        <li><strong>[[+descSetupNotes_heading]]</strong> 
            <ul>
                <li><strong>[[+descSetupTime_heading]]</strong> [[+setup_time]]</li>
                <li>[[+notes]]</li>
            </ul>

        </li>
        <!-- 
        <li><strong>Administrative Information</strong>
            <ul >
                <li>Event status</li>
                <li>What type of event is this? event_type</li>
                <li>[[+descOfficeNotes_heading]]</li>
            </ul>
        </li>
        -->
    </ul>
</div>',
      'locked' => 0,
      'properties' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '<div>
    <p>An event has been submitted.</p>
    
    <h2>[[+event_title]]</h2>

    <p><a href="[[+eventUrl]]">[[+descEdit_link]]</a></p>
    
    <ul>
        <li><strong>[[+descDate_heading]]</strong> 
            [[+start_time]] [[+end_time:notempty=`&ndash; [[+end_time]], `]] [[+event_date]] </li>
        <!-- <li><strong>Repeats</strong> </li> 
        <li><strong>[[+descNextDate_heading]]</strong> [[+nextDate]] [[+nextTime]]</li>
            -->
       
        <li><strong>[[+descDescription_heading]]</strong> [[+public_desc]]</li>

        <li><strong>[[+descContact_heading]]</strong>
            <ul>
                <li>[[+contact]]</li>
                <li>[[+contact_email:notempty=`<a href="mailto:[[+contact_email]]">[[+contact_email]]</a>`]]</li>
            </ul>
        </li>
        <!-- <li><strong>Calendar</strong> </li>
        <li><strong>Category</strong> </li> -->

        <li><strong>[[+descLocation_heading]]</strong>
            <!-- this is processing another chunk -->  
            [[+locationInfo]]
        </li>
        <li><strong>[[+descSetupNotes_heading]]</strong> 
            <ul>
                <li><strong>[[+descSetupTime_heading]]</strong> [[+setup_time]]</li>
                <li>[[+notes]]</li>
            </ul>

        </li>
        <!-- 
        <li><strong>Administrative Information</strong>
            <ul >
                <li>Event status</li>
                <li>What type of event is this? event_type</li>
                <li>[[+descOfficeNotes_heading]]</li>
            </ul>
        </li>
        -->
    </ul>
</div>',
    ),
  ),
  '6efb4d6f5e4df920e466f1b5f6f58469' => 
  array (
    'criteria' => 
    array (
      'name' => 'EventsRssItemTpl',
    ),
    'object' => 
    array (
      'id' => 37,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'EventsRssItemTpl',
      'description' => 'Event RSS Item',
      'editor_type' => 0,
      'category' => 4,
      'cache_type' => 0,
      'snippet' => '
<item>
  <title><![CDATA[ [[+event_title]] ]]></title>
  <link>[[++site_url]][[+event_url]]</link>
  <author>[[+contact_email]]</author>
  <category><![CDATA[ [[+category_id]] ]]></category>
  <description>
    <![CDATA[
    [[+status:notequalto=`approved`:then=`<img src="assets/components/churchevents/images/[[+status]].png" title="[[+status]]" />`]]
    [[+public_desc:ellipsis=`600`]]
    ]]>
  </description>
  <pubDate>[[+timestamp:date=`%a, %d %b %Y %H:%M:%S -0400`]]</pubDate>
  <guid isPermaLink="false">[[++site_url]][[+event_url]]</guid>

</item>

',
      'locked' => 0,
      'properties' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '
<item>
  <title><![CDATA[ [[+event_title]] ]]></title>
  <link>[[++site_url]][[+event_url]]</link>
  <author>[[+contact_email]]</author>
  <category><![CDATA[ [[+category_id]] ]]></category>
  <description>
    <![CDATA[
    [[+status:notequalto=`approved`:then=`<img src="assets/components/churchevents/images/[[+status]].png" title="[[+status]]" />`]]
    [[+public_desc:ellipsis=`600`]]
    ]]>
  </description>
  <pubDate>[[+timestamp:date=`%a, %d %b %Y %H:%M:%S -0400`]]</pubDate>
  <guid isPermaLink="false">[[++site_url]][[+event_url]]</guid>

</item>

',
    ),
  ),
  '8b216372cc89243f116cdf0bd8bc8ab3' => 
  array (
    'criteria' => 
    array (
      'name' => 'EventsRssTpl',
    ),
    'object' => 
    array (
      'id' => 38,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'EventsRssTpl',
      'description' => 'The RSS template',
      'editor_type' => 0,
      'category' => 4,
      'cache_type' => 0,
      'snippet' => '<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom" xmlns:dc="http://purl.org/dc/elements/1.1/">
<channel>
    <title>[[*pagetitle]]</title>
    <link>[[~[[*id]]? &scheme=`full`]]</link>
    <description>[[*introtext:cdata]]</description>
    <language>[[++cultureKey]]</language>
    <ttl>120</ttl>
    <atom:link href="[[~[[*id]]? &scheme=`full`]]" rel="self" type="application/rss+xml" />
    
    [[+rssItems]]

</channel>
</rss>',
      'locked' => 0,
      'properties' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom" xmlns:dc="http://purl.org/dc/elements/1.1/">
<channel>
    <title>[[*pagetitle]]</title>
    <link>[[~[[*id]]? &scheme=`full`]]</link>
    <description>[[*introtext:cdata]]</description>
    <language>[[++cultureKey]]</language>
    <ttl>120</ttl>
    <atom:link href="[[~[[*id]]? &scheme=`full`]]" rel="self" type="application/rss+xml" />
    
    [[+rssItems]]

</channel>
</rss>',
    ),
  ),
  '3055263d2788151d17ce6113632006dd' => 
  array (
    'criteria' => 
    array (
      'name' => 'ChurchEvents_DayHolderTpl',
    ),
    'object' => 
    array (
      'id' => 39,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'ChurchEvents_DayHolderTpl',
      'description' => 'Calendar day holder for the day view',
      'editor_type' => 0,
      'category' => 4,
      'cache_type' => 0,
      'snippet' => '<table class="dayList">
    <tr>
        <th class="timeColumn">Time</th>
        <th>Event</th>
        <th>Location</th>
        <th>Calendar</th>
        <th>Category</th>
    </tr>
    [[+listEventTpl]]
</table>',
      'locked' => 0,
      'properties' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '<table class="dayList">
    <tr>
        <th class="timeColumn">Time</th>
        <th>Event</th>
        <th>Location</th>
        <th>Calendar</th>
        <th>Category</th>
    </tr>
    [[+listEventTpl]]
</table>',
    ),
  ),
  'b249e1ac6c1a05d8f3ba2819963e8a46' => 
  array (
    'criteria' => 
    array (
      'name' => 'ChurchEvents_DayEventTpl',
    ),
    'object' => 
    array (
      'id' => 40,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'ChurchEvents_DayEventTpl',
      'description' => 'Calendar Event for day view',
      'editor_type' => 0,
      'category' => 4,
      'cache_type' => 0,
      'snippet' => '<tr>
    <td>
        [[+start_time]] &ndash; [[+end_time]] <!-- [[+event_time]] -->
    </td>
    <td>
        <a href="[[+event_url]]">[[+event_title]]</a>
    </td>
    <td>[[+locationInfoUrls]]<!-- [[+locationInfo]] Multiple Locations --></td>
    <td>[[+calendar]]</td>
    <td>[[+category]]</td>
</tr>',
      'locked' => 0,
      'properties' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '<tr>
    <td>
        [[+start_time]] &ndash; [[+end_time]] <!-- [[+event_time]] -->
    </td>
    <td>
        <a href="[[+event_url]]">[[+event_title]]</a>
    </td>
    <td>[[+locationInfoUrls]]<!-- [[+locationInfo]] Multiple Locations --></td>
    <td>[[+calendar]]</td>
    <td>[[+category]]</td>
</tr>',
    ),
  ),
  '40e782515d23c7f6a8f64253e50b416e' => 
  array (
    'criteria' => 
    array (
      'name' => 'ChurchEvents_YearTableTpl',
    ),
    'object' => 
    array (
      'id' => 41,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'ChurchEvents_YearTableTpl',
      'description' => 'Calendar table for the year view',
      'editor_type' => 0,
      'category' => 4,
      'cache_type' => 0,
      'snippet' => '<table class="calendarYear">
    <tr class="title">
        <th colspan="7">
            <a href="[[+month_url]]">[[+month]]</a>
        </th>
    </tr>
	<tr>
		[[+calColumnHeadTpl]]
	</tr>
	[[+calRowTpl]]
</table>',
      'locked' => 0,
      'properties' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '<table class="calendarYear">
    <tr class="title">
        <th colspan="7">
            <a href="[[+month_url]]">[[+month]]</a>
        </th>
    </tr>
	<tr>
		[[+calColumnHeadTpl]]
	</tr>
	[[+calRowTpl]]
</table>',
    ),
  ),
  '390ba584d4435b6765e4f359ea3208f2' => 
  array (
    'criteria' => 
    array (
      'name' => 'ChurchEvents_YearColumnTpl',
    ),
    'object' => 
    array (
      'id' => 42,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'ChurchEvents_YearColumnTpl',
      'description' => 'Calendar column for the year view',
      'editor_type' => 0,
      'category' => 4,
      'cache_type' => 0,
      'snippet' => '<td class="[[+column_class]]">
    <a href="[[+day_url]]" class="[[+eventClass]]" title="[[+eventTotal]] Events">[[+day]]</a>
</td>',
      'locked' => 0,
      'properties' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '<td class="[[+column_class]]">
    <a href="[[+day_url]]" class="[[+eventClass]]" title="[[+eventTotal]] Events">[[+day]]</a>
</td>',
    ),
  ),
  '6389b3d7a182a009eacf9616fa001e3a' => 
  array (
    'criteria' => 
    array (
      'name' => 'ChurchEvents_LocationDescriptionTpl',
    ),
    'object' => 
    array (
      'id' => 43,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'ChurchEvents_LocationDescriptionTpl',
      'description' => 'Displays info about one location for the location view',
      'editor_type' => 0,
      'category' => 4,
      'cache_type' => 0,
      'snippet' => '<!-- the loctation description -->
<div id="church_events_wrapper">
    <a href="[[~[[*id]]]]">Back</a>
    <h2>[[+type_name]]</h2>
    <p>[[+type_notes]]</p>
    <h3>[[+name]]</h3>
    <ul>
        <li><strong>Floor:</strong> [[+floor]]</li>
        <li><strong>Address:</strong>
            [[+map_url:notempty=`<a href="[[+map_url]]" target="_blank">Map</a><br/>`]]
            [[+address]] [[+address2]]</br>
            [[+city]] [[+state]]  [[+zip]]
        </li>
        <li><strong>Phone</strong> [[+toll_free]] [[+phone]]</li>
        <li><strong>Fax</strong> [[+fax]]</li>
        <li><strong>Website</strong>[[+website]]</li>
        <li><strong>Notes</strong>[[+notes]]</li>
        <li><strong>Contact</strong> [[+contact_phone]] [[+contact_name]] [[+contact_email]]</li>
        
    </ul>
</div>',
      'locked' => 0,
      'properties' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '<!-- the loctation description -->
<div id="church_events_wrapper">
    <a href="[[~[[*id]]]]">Back</a>
    <h2>[[+type_name]]</h2>
    <p>[[+type_notes]]</p>
    <h3>[[+name]]</h3>
    <ul>
        <li><strong>Floor:</strong> [[+floor]]</li>
        <li><strong>Address:</strong>
            [[+map_url:notempty=`<a href="[[+map_url]]" target="_blank">Map</a><br/>`]]
            [[+address]] [[+address2]]</br>
            [[+city]] [[+state]]  [[+zip]]
        </li>
        <li><strong>Phone</strong> [[+toll_free]] [[+phone]]</li>
        <li><strong>Fax</strong> [[+fax]]</li>
        <li><strong>Website</strong>[[+website]]</li>
        <li><strong>Notes</strong>[[+notes]]</li>
        <li><strong>Contact</strong> [[+contact_phone]] [[+contact_name]] [[+contact_email]]</li>
        
    </ul>
</div>',
    ),
  ),
  '888cabdfd29d1202bdd4193d0c6c5ddc' => 
  array (
    'criteria' => 
    array (
      'name' => 'ChurchEventsCalendar',
    ),
    'object' => 
    array (
      'id' => 11,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'ChurchEventsCalendar',
      'description' => 'Events calendar grid view',
      'editor_type' => 0,
      'category' => 4,
      'cache_type' => 0,
      'snippet' => '/*
require_once $modx->getOption(\'formit.core_path\',null,$modx->getOption(\'core_path\',null,MODX_CORE_PATH).\'components/formit/\').\'model/formit/formit.class.php\';
$fi = new FormIt($modx,$scriptProperties);
$fi->initialize($modx->context->get(\'key\'));
$fi->loadRequest();

$fields = $fi->request->prepare();
return $fi->request->handle($fields);
*/


$package_name = \'churchevents\';
$config = array( 
        \'packageName\' => $package_name
    );
// load the controller class - mycontroller.class.php
define(\'CMP_MODEL_DIR\', $modx->getOption(\'core_path\',null,MODX_CORE_PATH).\'components/\');//dirname(dirname(__FILE__)).\'/model/\' );
require_once CMP_MODEL_DIR.$package_name.\'/model/\'.$package_name.\'/mycontroller.class.php\';

$cmpController = new myController($modx, $config );
$cmpController->initialize($modx->context->get(\'key\'));
$request = $cmpController->loadRequest();
$calendar = $request->loadCalendar();

$output = $calendar->process($scriptProperties);
$calendar->loadHead();

return $output;',
      'locked' => 0,
      'properties' => NULL,
      'moduleguid' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '/*
require_once $modx->getOption(\'formit.core_path\',null,$modx->getOption(\'core_path\',null,MODX_CORE_PATH).\'components/formit/\').\'model/formit/formit.class.php\';
$fi = new FormIt($modx,$scriptProperties);
$fi->initialize($modx->context->get(\'key\'));
$fi->loadRequest();

$fields = $fi->request->prepare();
return $fi->request->handle($fields);
*/


$package_name = \'churchevents\';
$config = array( 
        \'packageName\' => $package_name
    );
// load the controller class - mycontroller.class.php
define(\'CMP_MODEL_DIR\', $modx->getOption(\'core_path\',null,MODX_CORE_PATH).\'components/\');//dirname(dirname(__FILE__)).\'/model/\' );
require_once CMP_MODEL_DIR.$package_name.\'/model/\'.$package_name.\'/mycontroller.class.php\';

$cmpController = new myController($modx, $config );
$cmpController->initialize($modx->context->get(\'key\'));
$request = $cmpController->loadRequest();
$calendar = $request->loadCalendar();

$output = $calendar->process($scriptProperties);
$calendar->loadHead();

return $output;',
    ),
  ),
  'a83b82ce97a6239bbc857bebedc2a0fd' => 
  array (
    'criteria' => 
    array (
      'name' => 'ChurchEventsList',
    ),
    'object' => 
    array (
      'id' => 12,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'ChurchEventsList',
      'description' => 'Snippet loads a list of events

Use like: <ul>[[!churchEventsList? &limit=`20` ]]</ul>',
      'editor_type' => 0,
      'category' => 4,
      'cache_type' => 0,
      'snippet' => '/**
 * Snippet loads a list of events
 * 
 * Use like: <ul>[[!churchEventsList? &limit=`20` ]]</ul>
 */
$scriptProperties[\'view\'] = \'list\';

$namespace = $modx->getObject(\'modNamespace\',\'churchevents\');  

$package_name = \'churchevents\';
$config = array( 
        \'packageName\' => $package_name,
    );
// load the controller class - mycontroller.class.php
define(\'CMP_MODEL_DIR\', $modx->getOption(\'core_path\',null,MODX_CORE_PATH).\'components/\');//dirname(dirname(__FILE__)).\'/model/\' );
require_once CMP_MODEL_DIR.$package_name.\'/model/\'.$package_name.\'/mycontroller.class.php\';

$cmpController = new myController($modx, $config );
$cmpController->initialize($modx->context->get(\'key\'));
$request = $cmpController->loadRequest();
$calendar = $request->loadCalendar();

$output = $calendar->process($scriptProperties);
$calendar->loadHead();

return $output;',
      'locked' => 0,
      'properties' => NULL,
      'moduleguid' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '/**
 * Snippet loads a list of events
 * 
 * Use like: <ul>[[!churchEventsList? &limit=`20` ]]</ul>
 */
$scriptProperties[\'view\'] = \'list\';

$namespace = $modx->getObject(\'modNamespace\',\'churchevents\');  

$package_name = \'churchevents\';
$config = array( 
        \'packageName\' => $package_name,
    );
// load the controller class - mycontroller.class.php
define(\'CMP_MODEL_DIR\', $modx->getOption(\'core_path\',null,MODX_CORE_PATH).\'components/\');//dirname(dirname(__FILE__)).\'/model/\' );
require_once CMP_MODEL_DIR.$package_name.\'/model/\'.$package_name.\'/mycontroller.class.php\';

$cmpController = new myController($modx, $config );
$cmpController->initialize($modx->context->get(\'key\'));
$request = $cmpController->loadRequest();
$calendar = $request->loadCalendar();

$output = $calendar->process($scriptProperties);
$calendar->loadHead();

return $output;',
    ),
  ),
  'c4e5de3358251f6e1df5422a1ff1fa6d' => 
  array (
    'criteria' => 
    array (
      'name' => 'ChurchEventsRSS',
    ),
    'object' => 
    array (
      'id' => 13,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'ChurchEventsRSS',
      'description' => 'This will create a RSS feed of the month events.',
      'editor_type' => 0,
      'category' => 4,
      'cache_type' => 0,
      'snippet' => '/**
 * Snippet loads a list of events
 * 
 * Use like: <ul>[[!churchEventsList? &limit=`20` ]]</ul>
 */
$scriptProperties[\'view\'] = \'rss\';

$namespace = $modx->getObject(\'modNamespace\',\'churchevents\');  

$package_name = \'churchevents\';
$config = array( 
        \'packageName\' => $package_name,
    );
// load the controller class - mycontroller.class.php
define(\'CMP_MODEL_DIR\', $modx->getOption(\'core_path\',null,MODX_CORE_PATH).\'components/\');//dirname(dirname(__FILE__)).\'/model/\' );
require_once CMP_MODEL_DIR.$package_name.\'/model/\'.$package_name.\'/mycontroller.class.php\';

$cmpController = new myController($modx, $config );
$cmpController->initialize($modx->context->get(\'key\'));
$request = $cmpController->loadRequest();
$calendar = $request->loadCalendar();

$output = $calendar->process($scriptProperties);
$calendar->loadHead();

return $output;',
      'locked' => 0,
      'properties' => NULL,
      'moduleguid' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '/**
 * Snippet loads a list of events
 * 
 * Use like: <ul>[[!churchEventsList? &limit=`20` ]]</ul>
 */
$scriptProperties[\'view\'] = \'rss\';

$namespace = $modx->getObject(\'modNamespace\',\'churchevents\');  

$package_name = \'churchevents\';
$config = array( 
        \'packageName\' => $package_name,
    );
// load the controller class - mycontroller.class.php
define(\'CMP_MODEL_DIR\', $modx->getOption(\'core_path\',null,MODX_CORE_PATH).\'components/\');//dirname(dirname(__FILE__)).\'/model/\' );
require_once CMP_MODEL_DIR.$package_name.\'/model/\'.$package_name.\'/mycontroller.class.php\';

$cmpController = new myController($modx, $config );
$cmpController->initialize($modx->context->get(\'key\'));
$request = $cmpController->loadRequest();
$calendar = $request->loadCalendar();

$output = $calendar->process($scriptProperties);
$calendar->loadHead();

return $output;',
    ),
  ),
  '1a5adc1699c6dbd65f0139ca5ad3f748' => 
  array (
    'criteria' => 
    array (
      'templatename' => 'ChurchEventsCalendar',
    ),
    'object' => 
    array (
      'id' => 4,
      'source' => 0,
      'property_preprocess' => 0,
      'templatename' => 'ChurchEventsCalendar',
      'description' => 'Template that has the Events Calendar snippet built into it.',
      'editor_type' => 0,
      'category' => 4,
      'icon' => '',
      'template_type' => 0,
      'content' => '<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>My Church Events</title>
    <base href="[[!++site_url]]" />
    <link rel="stylesheet" href="assets/components/churchevents/css/layout.css" />
    
</head>
<body>
  <div id="wrapper">
    <div id="banner">
      <h1>Church Events</h1>
    </div>
    
    <div id="content">
      [[*content]]
      [[!churchEventsCalendar? ]]
    </div>
      
    <div id="footer">
      <h2>Footer Stuff</h2>
      <ul>
        <li><a href="http://modx.com">This site runs on MODX</a></li>
        <li><a href="http://rtfm.modx.com/display/ADDON/Church+Events+Calendar">Read the docs for Church Events Calendar</a></li>
        <li><a href="http://www.joshua19media.com/modx-development/church-events-docs.html">Old docs</a></li>
      </ul>

    </div>
    
  </div>
</body>
</html>',
      'locked' => 0,
      'properties' => 'a:0:{}',
      'static' => 0,
      'static_file' => '',
    ),
  ),
  '8b07d99f8fa42fcb0c76bc858df64bd0' => 
  array (
    'criteria' => 
    array (
      'namespace' => 'churchevents',
      'controller' => 'controllers/index',
    ),
    'object' => 
    array (
      'id' => 79,
      'namespace' => 'churchevents',
      'controller' => 'controllers/index',
      'haslayout' => 1,
      'lang_topics' => 'churchevents:default',
      'assets' => '',
      'help_url' => '',
    ),
  ),
  '96ce38d406754af4c7eb2c3784f2fae4' => 
  array (
    'criteria' => 
    array (
      'text' => 'churchevents',
    ),
    'object' => 
    array (
      'text' => 'churchevents',
      'parent' => 'components',
      'action' => 79,
      'description' => 'churchevents.desc',
      'icon' => '',
      'menuindex' => 0,
      'params' => '',
      'handler' => '',
      'permissions' => '',
    ),
  ),
  '395e752c9762007b21212d2b30376488' => 
  array (
    'criteria' => 
    array (
      'key' => 'churchevents.allowRequests',
    ),
    'object' => 
    array (
      'key' => 'churchevents.allowRequests',
      'value' => '1',
      'xtype' => 'combo-boolean',
      'namespace' => 'churchevents',
      'area' => 'ChurchEvents',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  '23e94385710f59e86e88e17b7e7c5111' => 
  array (
    'criteria' => 
    array (
      'key' => 'churchevents.dateFormat',
    ),
    'object' => 
    array (
      'key' => 'churchevents.dateFormat',
      'value' => '%m/%d/%Y',
      'xtype' => 'textfield',
      'namespace' => 'churchevents',
      'area' => 'Date & Time',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  'b20b281ed3a9b60fa255c9605ad9eb6f' => 
  array (
    'criteria' => 
    array (
      'key' => 'churchevents.useLocations',
    ),
    'object' => 
    array (
      'key' => 'churchevents.useLocations',
      'value' => '0',
      'xtype' => 'combo-boolean',
      'namespace' => 'churchevents',
      'area' => 'Location Management',
      'editedon' => '2014-05-03 09:50:30',
    ),
  ),
  'aa43b44c5e0f108a0f4572339adee3f1' => 
  array (
    'criteria' => 
    array (
      'key' => 'churchevents.extended',
    ),
    'object' => 
    array (
      'key' => 'churchevents.extended',
      'value' => '',
      'xtype' => 'textarea',
      'namespace' => 'churchevents',
      'area' => 'ChurchEvents',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  'bc8de010f7d679467c850be1b744eec1' => 
  array (
    'criteria' => 
    array (
      'key' => 'churchevents.pageID',
    ),
    'object' => 
    array (
      'key' => 'churchevents.pageID',
      'value' => '4',
      'xtype' => 'textfield',
      'namespace' => 'churchevents',
      'area' => 'ChurchEvents',
      'editedon' => '2014-05-03 09:51:06',
    ),
  ),
  '35415421b767006c5a5c983065173122' => 
  array (
    'criteria' => 
    array (
      'key' => 'churchevents.rssPageID',
    ),
    'object' => 
    array (
      'key' => 'churchevents.rssPageID',
      'value' => '',
      'xtype' => 'textfield',
      'namespace' => 'churchevents',
      'area' => 'ChurchEvents',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
);