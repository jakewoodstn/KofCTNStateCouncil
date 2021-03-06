<?php
$xpdo_meta_map['councilMeeting']= array (
  'package' => 'kofctn',
  'version' => '1.1',
  'table' => 'kofctn_councilMeeting',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'councilId' => NULL,
    'meetingId' => NULL,
    'weekOfMonth' => NULL,
    'dayOfWeek' => NULL,
    'dayOfMonth' => NULL,
    'timeOfDay' => NULL,
    'notes' => NULL,
  ),
  'fieldMeta' => 
  array (
    'councilId' => 
    array (
      'dbtype' => 'int',
      'precision' => '8',
      'phptype' => 'integer',
      'null' => false,
    ),
    'meetingId' => 
    array (
      'dbtype' => 'int',
      'precision' => '8',
      'phptype' => 'integer',
      'null' => false,
    ),
    'weekOfMonth' => 
    array (
      'dbtype' => 'int',
      'precision' => '8',
      'phptype' => 'integer',
      'null' => true,
    ),
    'dayOfWeek' => 
    array (
      'dbtype' => 'int',
      'precision' => '8',
      'phptype' => 'integer',
      'null' => true,
    ),
    'dayOfMonth' => 
    array (
      'dbtype' => 'int',
      'precision' => '8',
      'phptype' => 'integer',
      'null' => true,
    ),
    'timeOfDay' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => true,
    ),
    'notes' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => true,
    ),
  ),
  'aggregates' => 
  array (
    'councilMeetingMeeting' => 
    array (
      'class' => 'meeting',
      'local' => 'meetingId',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
    'councilMeetingCouncil' => 
    array (
      'class' => 'council',
      'local' => 'councilId',
      'foreign' => 'id',
      'cardinality' => 'many',
      'owner' => 'foreign',
    ),
  ),
);
