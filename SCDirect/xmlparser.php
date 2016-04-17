<?php
function GetFratYear()
{

$currdate = getdate();
switch ($currdate['mon']){
	case 1:
	case 2:
	case 3:
	case 4:
	case 5:
	case 6:
		$currfratyear = $currdate['year']-1;
		break;
	default:
		$currfratyear = $currdate['year'];
}

return $currfratyear;
}


/* BEGIN VARIABLE DECLARATIONS */
//global variables for XML parsing
$values = array();
$field = "";
$curTag = "";

/* BEGIN XML PROCESSING */
// XML Parser element start function
function startElement($parser, $name, $attrs)
{
    global $curTag, $field;

    //track the tag we're currently in
    $curTag .= "^$name";

    if( $curTag == "^XFDF^FIELDS^FIELD" )
    {
        //save the name of the field in a global var
        $field = $attrs['NAME'];
    }
}


// XML Parser element end function
function endElement($parser, $name)
{
    global $curTag;

    // remove the tag we're ending from the "tag tracker"
    $caret_pos = strrpos($curTag,'^');
    $curTag = substr($curTag, 0, $caret_pos);
}


// XML Parser characterData function
function characterData( $parser, $data )
{
    global $curTag, $values, $field;
    $valueTag = "^XFDF^FIELDS^FIELD^VALUE";

    if( $curTag == $valueTag )
    {
        // we're in the value tag, so put the value in the array
        $values[$field] = $data;
    }
}

?>