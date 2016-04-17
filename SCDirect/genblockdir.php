<?php


function formatphone($Phone){
   if(isset($Phone))
   {  
   	    $remchar = array(" ","(", ")","-",".",",","[","]","/","|");
        $Phone = str_replace($remchar,'',$Phone);
		$fphone = ""; 
		switch(strlen($Phone)){
			case 7:
				$pf = substr($Phone,0,3);
				$num = substr($Phone,3,4);
				$fphone = $Pf ."-" .$num;
				break;
			default:
				$ac = substr($Phone,0,3);
				$Pf = substr($Phone,3,3);
				$num = substr($Phone,6,4);
				$fphone = "(" .$ac .") " .$Pf ."-" .$num;	
				break;
		}
		return $fphone;
   }
}

function checkformat($nstr){
		$nstr = trim($nstr);
		if (strlen($nstr)==1){
			$nstr = str_replace('.','',$nstr);
			$nstr .= ".";
		}
		return $nstr;
		
}

function subPrefix($pfx){
	switch ($pfx){
		case "Mr":
			$pfx = "Mr.";
	  		break;
		case "Rev Dr":
			$pfx = "Rev. Dr.";
			break;
		case "RMr":
			$pfx = "Rev. Mr.";
			break;
		case "Rev":
			$pfx = "Rev.";
			break;
		case "RDr":
			$pfx = "Rev. Dr.";
			break;
		case "MRev":
			$pfx = "Most Rev.";
			break;
		case "Dr":
			$pfx = "Dr.";
			break;
		default:
			$pfx = $pfx;
	}
	return $pfx;
}

function PageHeader($hdrstr,$doc){
	
	$doc->SetFont("helvetica",'B',24);
	$doc->Cell(0, 12, $hdrstr, 1, 1, 'C');
	$doc->SetFont('helvetica', '', 10);

	
}
function GenBlock($infoarr,$carr, $sect){
			$wtitle = subPrefix($infoarr['ctitle']);
		
			
			$name = trim($wtitle) ." ". trim(checkformat($infoarr['cfname'])) ." " .trim(checkformat($infoarr['cmi'])) ." " .trim($infoarr['clname']);
			if (trim($infoarr['csuffix']) != ''){
				$name .= ", " .trim($infoarr['csuffix']);
			}
			if (trim($infoarr['cnname']) !=""){
				$name .= "  (" .$infoarr['cnname'] .")";
			}
			if ($infoarr['ccspouse'] != ''){
				$spouse = "Spouse: " .trim($infoarr['ccspouse']);
				if ($infoarr['csnname'] !=''){
					$spouse .=" (" .$infoarr['csnname'] .")";
				}
			} else {
				$spouse = '';
			}
			$address1 = trim($infoarr['caddress1']);
			$address2 = trim($infoarr['caddress2']);
			$cityline = trim($infoarr['ccity']) .", " .trim($infoarr['cstate']) ." " .trim($infoarr['czip']);
			$hphone = $infoarr['chphone'];
			$wphone = $infoarr['cwphone'];
			$cphone = $infoarr['ccphone'];
			$fphone = $infoarr['cfphone'];
			$email = $infoarr['cemail'];
			$wemail = $infoarr['cwemail'];
			$position = $infoarr['cposition'];
			$council = $infoarr['icouncil'];
			$assembly = $infoarr['iassembly'];
			$psdterm = $infoarr['cpsdterm'];
			$deceased = $infoarr['bdeceased'];
			$seclev = $infoarr['tseclevel'];
			$fratyear = $infoarr['cfratyear'];
			
			$coltab = "&nbsp;&nbsp;";
			$blines = 0;
			
			switch($sect){
				case "DS":
				case "SS":
				case "SO":
					$block ='<span style="font-weight: bold; font-size: 14;">' .$position ."</span><br>";
					$lastline = "";
					
					break;
				case "PSD":
					$block ='<span style="font-weight: bold; font-size: 14;">' .$psdterm ."</span><br>";
					$lastline = "";
					if ($position == "Immediate Past State Deputy") {
						$name .=", Chairman";
					}
					
					break;
				case "DD":
					$block ='<span style="font-weight: bold; font-size: 14;">' .$position ."</span><br>";
					$lastline = "Councils:<br>";
					while ($counc = mysql_fetch_array($carr)){
						if ($counc['ccouncil'] == $council){
							$lastline .= sprintf("<B>%s </b>,&nbsp;",$counc['ccouncil']);
						} else {
							if($counc['bsuspended'] ==1){
								$lastline .= sprintf("<i>%s(D)</i>,&nbsp;",$counc['ccouncil']);								
							} else {
								$lastline .= sprintf("%s,&nbsp;",$counc['ccouncil']);
							}
						}
					}
					$lastline = substr($lastline,0, -7);
					
					
					break;
				case "FN":
				case "FC":
					$asmname = $infoarr['cname'];
					$block ='<span style="font-weight: bold; font-size: 14;">Assembly:&nbsp;&nbsp;' .$assembly ."</span><br>";;
					$block .='<span style="font-weight: bold; font-size: 12;">' .$asmname ."</span><br>";
					$lastline = "";
					
					break;
				

				default :
					$block ='<span style="font-weight: bold; font-size: 14;">Council:&nbsp;&nbsp;' .$council ."</span><br>";;
					$lastline = "";
					
					break;
			}
			
			$block .= "&nbsp;&nbsp;".$name ."<br>";
			$blines++;
			if (strlen($address1)>0){
				$block .= $coltab .$address1 ."<br>";
				$blines++;
			}
			if (strlen($address2)>0){
				$block .= $coltab .$address2 ."<br>";
				$blines++;
			}
			if (strlen(trim($cityline))>0){
				$block .= $coltab .$cityline ."<br>";
				$blines++;
			}
			if (strlen(trim($hphone))>6){
				$block .= $coltab ."Home Phone:" .$coltab .formatphone($hphone) ."<br>";
				$blines++;
			}
			if (strlen(trim($wphone))>6){
				$block .= $coltab ."Work Phone:" .$coltab .formatphone($wphone) ."<br>";
				$blines++;
			}
			if (strlen(trim($cphone))>6){
				$block .= $coltab ."Mobile Phone:" .$coltab .formatphone($cphone) ."<br>";
				$blines++;
			}
			if (strlen(trim($fphone))>6){
				$block .= $coltab ."Fax Phone:" .$coltab .formatphone($fphone) ."<br>";
				$blines++;
			}
			if (strlen($email)>5){
				$block .= $coltab ."Pri. Email:" .$coltab	.$email ."<br>";
				$blines++;
			}
			if (strlen($wemail)>5){
				$block .= $coltab ."Sec. Email:" .$coltab	.$wemail ."<br>";
				$blines++;
			}
			if (strlen($spouse)>0){
				$block .= $coltab .$spouse ."<br>";
				$blines++;
			}
			switch($sect){
				case "DD":
					if (strlen($lastline)> 94) {
						$block .= '<span style="font-size: 8;">' .$lastline  ."</span>";
					} else{
						$block .= '<span style="font-size: 10;">' .$lastline ."</span>";
					}
					break;
				case "SO":
				case "SS":
				
					$block .= $coltab ."Home Council:" .$coltab .$council ."<br> ";
					$blines++;
					break;
			}
			
			for ($n1=$blines; $n1<11;$n1++){
				$block .=" <br>";
			}
		return $block;
}


function GenCouncilBlock($infoarr,$carr,$counc, $sect){
			$council = trim($infoarr['ccouncil']);
			$name = trim($infoarr['cname']);
			$address1 = trim($infoarr['caddress1']);
			$address2 = trim($infoarr['caddress2']);
			$cityline = trim($infoarr['ccity']) .", " .trim($infoarr['cstate']) ." " .trim($infoarr['czip']);
			$district = $infoarr['tdistrict'];
			$meet1 = $infoarr['meeting1'];
			$mtime1 = $infoarr['mtime1'];
			$meet2 = $infoarr['meeting2'];
			$mtime2 = $infoarr['mtime2'];
			$offmeet = $infoarr['officers'];
			$offtime = $infoarr['offtime'];
			$suspended = $infoarr['bsuspended'];
			$coltab = "&nbsp;&nbsp;";
			$block ='<span style="font-weight: bold; font-size: 11;">' ."Council" .$coltab .$council .",".$coltab .$name .$coltab .", District:" .$coltab .$district;
			if($suspended == 1) {
				$block .= $coltab ."(Suspended/Dormant)";
			} 
			$blines++;
		    $block .= '</span><br><span style="font-weight: normal; font-size: 11;">';
			if (strlen($address1)>0){
				$block .= $coltab .$address1;
				if (strlen($address2)>0){
					$block .= "," .$coltab .$address2;
				}
			}
			if (strlen(trim($cityline))>0){
				$block .= $coltab .$cityline;
			}
			$block .= "<br>";
			$blines++;
			if (strlen($meet1)>5){
				if (strlen($meet2)>5){
					$block .= $coltab ."Business Meeting: "  .$coltab .trim($mtime1) .$coltab .trim($meet1);
					$block .="<br>";
					$blines++;
					$block .= $coltab ."Additional Meeting:" .$coltab .trim($mtime2) .$coltab .trim($meet2) ;
					$block .= "<br>";
					$blines++;
				} else {
					$block .= $coltab ."Business Meeting:" .$coltab .trim($mtime1) .$coltab .trim($meet1) ."<br>";
					$blines++;
				}
			}
			if (strlen($offmeet)>5){
				$block .= $coltab ."Officers Meeting:" .$coltab .$coltab .trim($offtime) .$coltab .trim($offmeet);
				$block .= "<br>";
				$blines++;
			}
			
			$block .=" <br>";
			$blines++;
			
			$block .= "</span>";
		return array($block,$blines,$council);
}

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

function GetNextFratYear()
{

$currdate = getdate();
switch ($currdate['mon']){
	case 1:
	case 2:
	case 3:
	case 4:
	case 5:
	case 6:
		$currfratyear = $currdate['year'];
		break;
	default:
		$currfratyear = $currdate['year']+1;
}


return $currfratyear;

}

require_once('./tcpdf/config/lang/eng.php');
require_once('./tcpdf/tcpdf.php');

class MYPDF extends TCPDF {
	public function Header() {
		if ($this->header_xobjid < 0) {
			// start a new XObject Template
			$this->header_xobjid = $this->startTemplate($this->w, $this->tMargin);
			$headerfont = $this->getHeaderFont();
			$headerdata = $this->getHeaderData();
			$this->y = $this->header_margin;
			if ($this->rtl) {
				$this->x = $this->w - $this->original_rMargin;
			} else {
				$this->x = $this->original_lMargin;
			}
			if (($headerdata['logo']) AND ($headerdata['logo'] != K_BLANK_IMAGE)) {
				$imgtype = $this->getImageFileType(K_PATH_IMAGES.$headerdata['logo']);
				if (($imgtype == 'eps') OR ($imgtype == 'ai')) {
					$this->ImageEps(K_PATH_IMAGES.$headerdata['logo'], '', '', $headerdata['logo_width']);
				} elseif ($imgtype == 'svg') {
					$this->ImageSVG(K_PATH_IMAGES.$headerdata['logo'], '', '', $headerdata['logo_width']);
				} else {
					$this->Image(K_PATH_IMAGES.$headerdata['logo'], '', '', $headerdata['logo_width']);
				}
				$imgy = $this->getImageRBY();
			} else {
				$imgy = $this->y;
			}
			$cell_height = round(($this->cell_height_ratio * $headerfont[2]) / $this->k, 2);
			// set starting margin for text data cell
			if ($this->getRTL()) {
				$header_x = $this->original_rMargin + ($headerdata['logo_width'] * 1.1);
			} else {
				$header_x = $this->original_lMargin + ($headerdata['logo_width'] * 1.1);
			}
			$cw = $this->w - $this->original_lMargin - $this->original_rMargin - ($headerdata['logo_width'] * 1.1);
			$this->SetTextColor(0, 0, 0);
			// header title
			$this->SetFont($headerfont[0], 'B', $headerfont[2] + 1);
			$this->SetX($header_x);
			$this->Cell($cw, $cell_height, $headerdata['title'], 0, 1, '', 0, '', 0);
			// header string
			$this->SetFont($headerfont[0], $headerfont[3], $headerfont[4]);
			$this->SetX($header_x);
			$this->MultiCell($cw, $cell_height, $headerdata['string'], 0, '', 0, 1, '', '', true, 0, false, true, 0, 'T', false);
			// print an ending header line
			$this->SetLineStyle(array('width' => 0.85 / $this->k, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
			$this->SetY((2.835 / $this->k) + max($imgy, $this->y));
			if ($this->rtl) {
				$this->SetX($this->original_rMargin);
			} else {
				$this->SetX($this->original_lMargin);
			}
			$this->Cell(($this->w - $this->original_lMargin - $this->original_rMargin), 0, '', 'T', 0, 'C');
			$this->endTemplate();
		}
		// print header template
		$x = 0;
		$dx = 0;
		if ($this->booklet AND (($this->page % 2) == 0)) {
			// adjust margins for booklet mode
			$dx = ($this->original_lMargin - $this->original_rMargin);
		}
		if ($this->rtl) {
			$x = $this->w + $dx;
		} else {
			$x = 0 + $dx;
		}
		$this->printTemplate($this->header_xobjid, $x, 0, 0, 0, '', '', false);
		if ($this->header_xobj_autoreset) {
			// reset header xobject template at each page
			$this->header_xobjid = -1;
		}
	}
	
	public function getPageBreakTrigger(){
		return $this->PageBreakTrigger;	
	}
	
}

$cfy = GetFratYear();
$nfy = GetNextFratYear();

$starttime= time();
// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Tennessee State Council');
$pdf->SetTitle('Tennessee State Council Directory');
$pdf->SetSubject('State Council Membership Directory');
$pdf->SetKeywords('Directory, block, telephone');


// set default header data
$pdf->SetHeaderData("3rddegree.png", 20	, "Tennessee State Council Directory", "Contact statesecretary@kofc-tn.org with Corrections");
// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', 24,'',14));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);


$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
$pdf->SetAutoPageBreak(FALSE,0);
//$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 10);

// Turn off Headers and add cover page 

$pdf->setPrintFooter(false);
$pdf->setPrintHeader(false);


$pdf->AddPage();

// calculate location for bottom row of emblems
$h1 = $pdf->getPageBreakTrigger()-45;

//Generate Cover

$pdf->Image('./tcpdf/images/3rddegree.png',20,'',40,40,'PNG','','',true,300,'L',false,false,0,true,false,false);
$pdf->Image('./tcpdf/images/4thdegree.png',20,'',40,40,'PNG','','',true,300,'R',false,false,0,true,false,false);
$pdf->Image('./tcpdf/images/squires.png',20,$h1,40,40,'PNG','','',true,300,'L',false,false,0,true,false,false);
$pdf->Image('./tcpdf/images/agency.png',20,$h1,40,40,'PNG','','',true,300,'R',false,false,0,true,false,false);
$pdf->SetFont("helvetica",'B',24);

$pdf->writeHTMLCell(0,40,0,110,"Tennessee State Council Directory <br> Fraternal Year " .$cfy ."-" .$nfy,0,0,0,true,"C",true);

$pdf->AddPage();

//Enable Header before adding Next Page
$pdf->startPageGroup();
$pdf->setPrintHeader(true);

$pdf->AddPage();

//enable the Footer for the remainder of the Document
$pdf->setPrintFooter(true);

// Gen the Supreme council page
$pdf->Bookmark('Supreme Council', 0, 0, '', 'B', array(0,0,0));
// Page Header
$pdf->Cell(0, 12, 'Supreme Council', 1, 1, 'C');
$pdf->SetFont('helvetica', '', 9);

// Supreme Officers List

$supremeofficers = "<strong>Supreme Knight</strong><br/>Carl A. Anderson<br /><br/><strong>Supreme Chaplain</strong><br>Bishop William E. Lori, S.T.D.<br/><br/><strong>Deputy Supreme Knight</strong><br>Logan T. Ludwig<br/><br/><strong>Supreme Secretary</strong><br>Charles E. Maurer, Jr.<br/><br/><strong>Supreme Treasurer</strong><br>Michael J. O'Conner<br/><br/><strong>Supreme Advocate</strong><br>John A. Marrella<br/>";

// Supreme Phone Directory

$supremedir = "				<strong>General Phone Number:</strong> (203) 752-4000<br />
<strong>Customer Service (Insurance Matters):</strong> (800) 380-9995<br /> 
<strong>Archives:</strong> (203) 752-4578<br /><strong>Catholic Information Service:</strong> (203) 752-4267<br /><strong>Cause for Father McGivney:</strong> (203) 752-4087<br /><strong>Ceremonials:</strong> (203) 752-4347<br /><strong>Certificate Service:</strong> (203) 752-4062<br /><strong>Columbia:</strong> (203) 752-4398<br /><strong>Columbian Squires:</strong> (203) 752-4571<br /><strong>Council Accounts:</strong> (203) 752-4392<br /><strong>Council Growth and Development:</strong>
<ul>
<li>New Council Development - (203) 752-4473</li> 
<li>Council Reactivation - (203) 752-4250</li> 
<li>College Councils - (203) 752-4671</li> 
<li>Spanish Speaking Councils - (203) 752-4426</li> 
</ul> 
<strong>Financial Secretary Appointments:</strong> (203) 752-4717<br /><strong>Fourth Degree:</strong> (203) 752-4437<br /><strong>Fraternal Services:</strong> (203) 752-4270<br /><strong>General Office:</strong>
<ul> 
<li>Expenses State/District Deputies - (203) 752-4034</li> 
<li>District Deputy Appointments - (203) 752-4379</li> 
<li>Supreme Convention Information - (203) 752-4334</li> 
</ul> 
<strong>Insurance Member - Claims:</strong> (203) 752-4394<br /><strong>Insurance Member - Settlement Options:</strong> (203) 752-4370<br /><strong>Investments:</strong> (203) 752-4385<br /><strong>Knightline:</strong> (203) 752-4398<br /><strong>Medical:</strong> (203) 752-4639<br /><strong>Membership Records:</strong> (203) 752-4210<br /><strong>Museum:</strong> (203) 865-0326<br /><strong>New Insurance Business:</strong> (203) 752-4408<br /><strong>Payment Receipts:</strong> (203) 752-4238<br /><strong>Program Supplement:</strong> (203) 752-4577<br /><strong>Scholarships:</strong> (203) 752-4332<br /><strong>Supplies and Printing Plant:</strong>
<ul> 
<li>Council, Assembly and Squires Print Orders - (203) 752-4244</li> 
<li>General Supply Inquiries - (203) 752-4214 or (203) 752-4451</li> 
<li>Promotional and Gift Orders - (203) 752-4216</li> 
</ul> 
<strong>Web Site:</strong> 
<ul> 
<li>Login Access Help (Agents and Fraternal Leaders) - (800) 380-9995<br /> 
    </li> 
<li>Reporting Errors - (203) 752-4242</li> 
</ul> ";

// Set the Font size for the Supreme Officers List

$pdf->SetFont('helvetica', '', 18);

$y = $pdf->getY();

// set color for background
$pdf->SetFillColor(255, 255, 255);

// set color for text
$pdf->SetTextColor(0, 0, 0);

// write the first column
$pdf->writeHTMLCell(90, '', '', $y, $supremeofficers, 0, 0, 1, true, 'L', true);

// Reset Font size for the Phone list

$pdf->SetFont('helvetica', '', 10);

// write the second column
$pdf->writeHTMLCell(100, '', '', '', $supremedir, 0, 0, 1, true, 'L', true);

// Create the State Officers page

$pdf->AddPage();
$pdf->Bookmark('State Officers', 0, 0, '', 'B', array(0,0,0));

$cfy = GetFratYear();

PageHeader('State Officers',$pdf);
// Retrieve the State officers info from the database

$qry = "Select * from members left outer join fratpos on members.cuserid = fratpos.cuserid where fratpos.dirgroup=1 and fratpos.cfratyear=" .$cfy  ." order by fratpos.secorder";
include 'configdb.php';
include 'opendb.php';
	
$data = mysql_query($qry);
if (!$data) {
	echo 'Could not run query: ' . mysql_error() ."</br> Please use Back Button";
	die;
}

// set up Variables  for page generation

$blockrows = 0;
$blockcnt=0;
$ccol = "l";
$rcol = "";
$lcol = '';
#If something was returned
if ($data){
	# then make sure that we have at least one record
	if (mysql_num_rows($data)>0){
		while ($info = mysql_fetch_array( $data )) {
			$block = GenBlock($info,$info,"SO");
			switch ($ccol){
				case "r":
					$rcol .=$block;
					$ccol = "l";
					$blockcnt++;		
					break;
				case "l":
					$lcol .=$block;
					$ccol = "r";
					$blockcnt++;
					break;
			}
			if ($blockcnt == 8){
				$y = $pdf->getY();
				$pdf->SetFillColor(255, 255, 255);
				$pdf->SetTextColor(0, 0, 0);
				$pdf->writeHTMLCell(80, '', '', $y, $lcol, 0, 0, 1, true, 'J', true);
				$pdf->writeHTMLCell(80, '', '', '', $rcol, 0, 0, 1, true, 'J', true);
				$pdf->AddPage();			
				$blockcnt = 0;
				$lcol='';
				$rcol='';
			}
			
		}
	}
}

//mysql_free_result($data);

//include 'closedb.php';

// we have finished output the last page of data if there is anything left to output
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)
// get current vertical position
if ($blockcnt >0){
	$y = $pdf->getY();
	$pdf->SetFillColor(255, 255, 255);
	$pdf->SetTextColor(0, 0, 0);
	$pdf->writeHTMLCell(80, '', '', $y, $lcol, 0, 0, 1, true, 'J', true);
	$pdf->writeHTMLCell(80, '', '', '', $rcol, 0, 0, 1, true, 'J', true);
	
}

// Output Program Staff

$pdf->AddPage();
$pdf->Bookmark('Program Staff', 0, 0, '', 'B', array(0,0,0));

PageHeader('Program Staff',$pdf);

// Retrieve the Program Staff info from the database

$qry = "Select * from members left outer join fratpos on members.cuserid=fratpos.cuserid where fratpos.dirgroup=2 and fratpos.cfratyear=".$cfy  ." order by fratpos.secorder";
//include 'configdb.php';
//include 'opendb.php';
	
$data = mysql_query($qry);
if (!$data) {
	echo 'Could not run query: ' . mysql_error() ."</br> Please use Back Button";
	die;
}

// set up Variables  for page generation

$blockrows = 0;
$blockcnt=0;
$ccol = "l";
$rcol = "";
$lcol = '';
#If something was returned
if ($data){
	# then make sure that we have at least one record
	if (mysql_num_rows($data)>0){
		while ($info = mysql_fetch_array( $data )) {
			$block = GenBlock($info,$info,"SS");
			switch ($ccol){
				case "r":
					$rcol .=$block;
					$ccol = "l";
					$blockcnt++;		
					break;
				case "l":
					$lcol .=$block;
					$ccol = "r";
					$blockcnt++;
					break;
			}
			if ($blockcnt == 8){
				$y = $pdf->getY();
				$pdf->SetFillColor(255, 255, 255);
				$pdf->SetTextColor(0, 0, 0);
				$pdf->writeHTMLCell(80, '', '', $y, $lcol, 0, 0, 1, true, 'J', true);
				$pdf->writeHTMLCell(80, '', '', '', $rcol, 0, 0, 1, true, 'J', true);
				$pdf->AddPage();
				PageHeader('Program Staff',$pdf);			
				$blockcnt = 0;
				$lcol='';
				$rcol='';
			}
			
		}
	}
}

//mysql_free_result($data);
//include 'closedb.php';

// we have finished output the last page of data if there is anything left to output
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)
// get current vertical position
if ($blockcnt >0){
	$y = $pdf->getY();
	$pdf->SetFillColor(255, 255, 255);
	$pdf->SetTextColor(0, 0, 0);
	$pdf->writeHTMLCell(80, '', '', $y, $lcol, 0, 0, 1, true, 'J', true);
	$pdf->writeHTMLCell(80, '', '', '', $rcol, 0, 0, 1, true, 'J', true);
}


// Output Membership Staff

$pdf->AddPage();
$pdf->Bookmark('Membership and Ceremonials Staff', 0, 0, '', 'B', array(0,0,0));
PageHeader('Membership and Ceremonials Staff',$pdf);

// Retrieve the Membership Staff info from the database

$qry = "Select * from members left outer join fratpos on members.cuserid=fratpos.cuserid where fratpos.dirgroup=3 and fratpos.cfratyear=".$cfy  ." order by fratpos.secorder";
//include 'configdb.php';
//include 'opendb.php';
	
$data = mysql_query($qry);
if (!$data) {
	echo 'Could not run query: ' . mysql_error() ."</br> Please use Back Button";
	die;
}

// set up Variables  for page generation

$blockrows = 0;
$blockcnt=0;
$ccol = "l";
$rcol = "";
$lcol = '';
#If something was returned
if ($data){
	# then make sure that we have at least one record
	if (mysql_num_rows($data)>0){
		while ($info = mysql_fetch_array( $data )) {
			$block = GenBlock($info,$info,"SS");
			switch ($ccol){
				case "r":
					$rcol .=$block;
					$ccol = "l";
					$blockcnt++;		
					break;
				case "l":
					$lcol .=$block;
					$ccol = "r";
					$blockcnt++;
					break;
			}
			if ($blockcnt == 8){
				$y = $pdf->getY();
				$pdf->SetFillColor(255, 255, 255);
				$pdf->SetTextColor(0, 0, 0);
				$pdf->writeHTMLCell(80, '', '', $y, $lcol, 0, 0, 1, true, 'J', true);
				$pdf->writeHTMLCell(80, '', '', '', $rcol, 0, 0, 1, true, 'J', true);
				$pdf->AddPage();
			
				PageHeader('Membership Staff',$pdf);
				$blockcnt = 0;
				$lcol='';
				$rcol='';
			}
			
		}
	}
}

//mysql_free_result($data);

//include 'closedb.php';

// we have finished output the last page of data if there is anything left to output
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)
// get current vertical position
if ($blockcnt >0){
	$y = $pdf->getY();
	$pdf->SetFillColor(255, 255, 255);
	$pdf->SetTextColor(0, 0, 0);
	$pdf->writeHTMLCell(80, '', '', $y, $lcol, 0, 0, 1, true, 'J', true);
	$pdf->writeHTMLCell(80, '', '', '', $rcol, 0, 0, 1, true, 'J', true);
}
//***********************************//
// Past State Deputies
//***********************************//

$pdf->AddPage();
$pdf->Bookmark('Past State Deputies', 0, 0, '', 'B', array(0,0,0));
PageHeader('Past State Deputies',$pdf);

$qry = "Select * from members left outer join fratpos on members.cuserid=fratpos.cuserid where fratpos.dirgroup=8 and fratpos.cfratyear=".$cfy  ." order by members.cpsdterm DESC";
//include 'configdb.php';
//include 'opendb.php';
	
$data = mysql_query($qry);
if (!$data) {
	echo 'Could not run query: ' . mysql_error() ."</br> Please use Back Button";
	die;
}
$ccol = "l";
$rcol = "";
$lcol = '';
$blockcnt=0;
#If something was returned
if ($data){
	# then make sure that we have at least one record
	if (mysql_num_rows($data)>0){
		while ($info = mysql_fetch_array( $data )) {
			$block = GenBlock($info,$info,"PSD");
			switch ($ccol){
				case "r":
					$rcol .=$block;
					$ccol = "l";
					$blockcnt++;		
					break;
				case "l":
					$lcol .=$block;
					$ccol = "r";
					$blockcnt++;
					break;
			}
			if ($blockcnt == 8){
				$y = $pdf->getY();
				$pdf->SetFillColor(255, 255, 255);
				$pdf->SetTextColor(0, 0, 0);
				$pdf->writeHTMLCell(80, '', '', $y, $lcol, 0, 0, 1, true, 'J', true);
				$pdf->writeHTMLCell(80, '', '', '', $rcol, 0, 0, 1, true, 'J', true);
				$pdf->AddPage();
				PageHeader('Past State Deputies',$pdf);			
				$blockcnt = 0;
				$ccol = "l";
				$rcol = "";
				$lcol = '';
			}

		}
	}


}

//mysql_free_result($data);

$rcol = '';

// we have finished output the last page of data
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)
// get current vertical position
if ($blockcnt > 0) {
	$y = $pdf->getY();
	$pdf->SetFillColor(255, 255, 255);
	$pdf->SetTextColor(0, 0, 0);
	$pdf->writeHTMLCell(80, '', '', $y, $lcol, 0, 0, 1, true, 'J', true);
	$pdf->writeHTMLCell(80, '', '', '', $rcol, 0, 0, 1, true, 'J', true);
}


/*--------------------------------------------------------------------------
// Output DD Portion of the Directory
//-------------------------------------------------------------------------*/

$pdf->AddPage();
$pdf->Bookmark('District Deputies', 0, 0, '', 'B', array(0,0,0));
PageHeader("District Deputies",$pdf);

// Retrieve the DD's info from the database

$qry = "Select * from members left outer join fratpos on members.cuserid=fratpos.cuserid where fratpos.dirgroup=4 and fratpos.cfratyear=".$cfy  ." and fratpos.secorder >0 order by fratpos.secorder";
//include 'configdb.php';
//include 'opendb.php';
mysql_free_result($data);	
$data = mysql_query($qry);
if (!$data) {
	echo 'Could not run query: ' . mysql_error() ."</br> Please use Back Button";
	die;
}

// set up Variables  for page generation

$blockrows = 0;
$blockcnt = 0;
$ccol = "l";
$rcol = '';
$lcol = '';
$block = "";
#If something was returned
if ($data){
	# then make sure that we have at least one record
	if (mysql_num_rows($data)>0){
		while ($info = mysql_fetch_array( $data )) {
			
			$qry2 = "Select ccouncil, bsuspended from council where tdistrict=" .$info['secorder'] ." and bcouncil=1";
			$data2=mysql_query($qry2);
			$councillist = array();
			if($data2){
				if(mysql_num_rows($data2)>0){
//					while ($info2 = mysql_fetch_array($data2)){
//						$councillist[] = $info2['ccouncil'];
//					}
//				}
//			}
			
//			$block = GenBlock($info,$councillist,"DD");
					$block = GenBlock($info,$data2,"DD");
				}
			}
	
			switch ($ccol){
				case "r":
					$rcol .=$block;
					$ccol = "l";
					$blockcnt++;		
					break;
				case "l":
					$lcol .=$block;
					$ccol = "r";
					$blockcnt++;
					break;
			}
			if ($blockcnt == 8){
				$y = $pdf->getY();
				$pdf->SetFillColor(255, 255, 255);
				$pdf->SetTextColor(0, 0, 0);
				$pdf->writeHTMLCell(80, '', '', $y, $lcol, 0, 0, 1, true, 'J', true);
				$pdf->writeHTMLCell(80, '', '', '', $rcol, 0, 0, 1, true, 'J', true);
				$pdf->AddPage();			
				PageHeader('District Deputies',$pdf);
				$blockcnt = 0;
				$lcol='';
				$rcol='';
				$ccol = 'l';
			}
			
		}
	}
}

//mysql_free_result($data);


//include 'closedb.php';

// we have finished output the last page of data if there is anything left to output
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)
// get current vertical position
if ($blockcnt >0){
	$y = $pdf->getY();
	$pdf->SetFillColor(255, 255, 255);
	$pdf->SetTextColor(0, 0, 0);
	$pdf->writeHTMLCell(80, '', '', $y, $lcol, 0, 0, 1, true, 'J', true);
	$pdf->writeHTMLCell(80, '', '', '', $rcol, 0, 0, 1, true, 'J', true);
}




// Output District Wardens


$pdf->AddPage();
$pdf->Bookmark('District Wardens', 0, 0, '', 'B', array(0,0,0));
PageHeader('District Wardens',$pdf);

// Retrieve the State officers info from the database

$qry = "Select * from members left outer join fratpos on members.cuserid=fratpos.cuserid where fratpos.dirgroup=5 and fratpos.cfratyear=".$cfy  ." order by fratpos.secorder";
//include 'configdb.php';
//include 'opendb.php';
	
$data = mysql_query($qry);
if (!$data) {
	echo 'Could not run query: ' . mysql_error() ."</br> Please use Back Button";
	die;
}

// set up Variables  for page generation

$blockrows = 0;
$blockcnt=0;
$ccol = "l";
$rcol = "";
$lcol = '';
#If something was returned
if ($data){
	# then make sure that we have at least one record
	if (mysql_num_rows($data)>0){
		while ($info = mysql_fetch_array( $data )) {
			$block = GenBlock($info,$info,"SO");
			switch ($ccol){
				case "r":
					$rcol .=$block;
					$ccol = "l";
					$blockcnt++;		
					break;
				case "l":
					$lcol .=$block;
					$ccol = "r";
					$blockcnt++;
					break;
			}
			if ($blockcnt == 8){
				$y = $pdf->getY();
				$pdf->SetFillColor(255, 255, 255);
				$pdf->SetTextColor(0, 0, 0);
				$pdf->writeHTMLCell(80, '', '', $y, $lcol, 0, 0, 1, true, 'J', true);
				$pdf->writeHTMLCell(80, '', '', '', $rcol, 0, 0, 1, true, 'J', true);
				$pdf->AddPage();			
				PageHeader('District Wardens',$pdf);
				$blockcnt = 0;
				$lcol='';
				$rcol='';
			}
			
		}
	}
}
//mysql_free_result($data);

//include 'closedb.php';

// we have finished output the last page of data if there is anything left to output
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)
// get current vertical position
if ($blockcnt >0){
	$y = $pdf->getY();
	$pdf->SetFillColor(255, 255, 255);
	$pdf->SetTextColor(0, 0, 0);
	$pdf->writeHTMLCell(80, '', '', $y, $lcol, 0, 0, 1, true, 'J', true);
	$pdf->writeHTMLCell(80, '', '', '', $rcol, 0, 0, 1, true, 'J', true);
}


// Time for GK's

$pdf->AddPage();
$pdf->Bookmark('Grand Knights', 0, 0, '', 'B', array(0,0,0));
PageHeader('Grand Knights',$pdf);
$pgnum = 1;

// ---------------------------------------------------------

// print TEXT
$qry = "Select * from members left outer join fratpos on members.cuserid=fratpos.cuserid where fratpos.cposition = 'Grand Knight' and fratpos.cfratyear=".$cfy  ." order by members.icouncil";
//include 'configdb.php';
//include 'opendb.php';
	
$data = mysql_query($qry);
if (!$data) {
	echo 'Could not run query: ' . mysql_error() ."</br> Please use Back Button";
	die;
}
$ccol = "l";
$rcol = "";
$lcol = '';
$blockcnt=0;
#If something was returned
if ($data){
	# then make sure that we have at least one record
	if (mysql_num_rows($data)>0){
		while ($info = mysql_fetch_array( $data )) {
			$block = GenBlock($info,$info,"GK");
			switch ($ccol){
				case "r":
					$rcol .=$block;
					$ccol = "l";
					$blockcnt++;		
					break;
				case "l":
					$lcol .=$block;
					$ccol = "r";
					$blockcnt++;
					break;
			}
			if ($blockcnt == 8){
				$y = $pdf->getY();
				$pdf->SetFillColor(255, 255, 255);
				$pdf->SetTextColor(0, 0, 0);
				$pdf->writeHTMLCell(80, '', '', $y, $lcol, 0, 0, 1, true, 'J', true);
				$pdf->writeHTMLCell(80, '', '', '', $rcol, 0, 0, 1, true, 'J', true);
				$pdf->AddPage();			
				$pdf->Bookmark('Grand Knights Page ' .$pgnum, 1, 0, '', 'B', array(0,0,0));
				PageHeader('Grand Knights',$pdf);
				$blockcnt = 0;
				$lcol = '';
				$rcol = '';
				$pgnum++;
			}

		}
	}


}

//mysql_free_result($data);

//include 'closedb.php';

// we have finished output the last page of data
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)
// get current vertical position
if ($blockcnt >0){
	$y = $pdf->getY();
	$pdf->SetFillColor(255, 255, 255);
	$pdf->SetTextColor(0, 0, 0);
	$pdf->writeHTMLCell(80, '', '', $y, $lcol, 0, 0, 1, true, 'J', true);
	$pdf->writeHTMLCell(80, '', '', '', $rcol, 0, 0, 1, true, 'J', true);
}
// Now for the FS's


$pdf->AddPage();
$pdf->Bookmark('Financial Secretaries', 0, 0, '', 'B', array(0,0,0));
PageHeader('Financial Secretaries',$pdf);
$pgnum = 1;
// ---------------------------------------------------------

// print TEXT
$qry = "Select * from members left outer join fratpos on members.cuserid=fratpos.cuserid where fratpos.cposition = 'Financial Secretary' and fratpos.cfratyear=".$cfy  ." order by members.icouncil";
//include 'configdb.php';
//include 'opendb.php';
	
$data = mysql_query($qry);
if (!$data) {
	echo 'Could not run query: ' . mysql_error() ."</br> Please use Back Button";
	die;
}
$ccol = "l";
$rcol = "";
$lcol = '';
$blockcnt=0;
#If something was returned
if ($data){
	# then make sure that we have at least one record
	if (mysql_num_rows($data)>0){
		while ($info = mysql_fetch_array( $data )) {
			$block = GenBlock($info,$info,"FS");
			switch ($ccol){
				case "r":
					$rcol .=$block;
					$ccol = "l";
					$blockcnt++;		
					break;
				case "l":
					$lcol .=$block;
					$ccol = "r";
					$blockcnt++;
					break;
			}
			if ($blockcnt == 8){
				$y = $pdf->getY();
				$pdf->SetFillColor(255, 255, 255);
				$pdf->SetTextColor(0, 0, 0);
				$pdf->writeHTMLCell(80, '', '', $y, $lcol, 0, 0, 1, true, 'J', true);
				$pdf->writeHTMLCell(80, '', '', '', $rcol, 0, 0, 1, true, 'J', true);
				$pdf->AddPage();
				$pdf->Bookmark('Financial Secretaries Page ' .$pgnum, 1, 0, '', 'B', array(0,0,0));
				PageHeader('Financial Secretaries',$pdf);			
				$blockcnt = 0;
				$lcol='';
				$rcol='';
				$pgnum++;
			}

		}
	}


}

//mysql_free_result($data);


//include 'closedb.php';

// we have finished output the last page of data
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)
// get current vertical position
if ($blockcnt>0) {
	$y = $pdf->getY();
	$pdf->SetFillColor(255, 255, 255);
	$pdf->SetTextColor(0, 0, 0);
	$pdf->writeHTMLCell(80, '', '', $y, $lcol, 0, 0, 1, true, 'J', true);
	$pdf->writeHTMLCell(80, '', '', '', $rcol, 0, 0, 1, true, 'J', true);
}

// Output Council Meeting Locations



$pdf->AddPage();
$pdf->Bookmark('Council Meetings', 0, 0, '', 'B', array(0,0,0));
PageHeader('Council Meetings',$pdf);
$pgnum = 1;
// ---------------------------------------------------------

// print TEXT
$qry = "Select * from council where bcouncil = 1 order by ccouncil ASC";
//include 'configdb.php';
//include 'opendb.php';
	
$data = mysql_query($qry);
if (!$data) {
	echo 'Could not run query: ' . mysql_error() ."</br> Please use Back Button";
	die;
}
$ccol = "l";
$rcol = "";
$lcol = '';
$blockcnt=0;
$blockline=0;
$pagelins=0;
$cngn = "";
#If something was returned
if ($data){
	# then make sure that we have at least one record
	if (mysql_num_rows($data)>0){
		while ($info = mysql_fetch_array( $data )) {
			
			$blockarr = GenCouncilBlock($info,$info,$info,"CL");
			$block = $blockarr[0];
			$blockline = $blockarr[1];
//			$cngn .= $blockarr[2] ."  ";
			
						
		    if ($pagelins + $blockline >= 47) {
				$y = $pdf->getY();
//					$headers = "From: tstaller@aol.com\r\n";
//					$headers .= "Reply-To: tstaller@aol.com \r\n";
//					$headers .= "MIME-Version: 1.0\r\n";
//					$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
//		
//					$message = '<html><body>';
//					$message .="<br>";
//					
//					$message .= $cngn;
//					$message .= $pagedat;
//					$message .= '</body></html>';
//					mail("tstaller@aol.com","Council list Diag",$message,$headers);


				$pdf->SetFillColor(255, 255, 255);
				$pdf->SetTextColor(0, 0, 0);
				$pdf->writeHTML($pagedat,true,false,false,'L');
                $pdf->AddPage();
				$pdf->Bookmark('Council Meetings Page ' .$pgnum, 1, 0, '', 'B', array(0,0,0));
				PageHeader('Council Meetings',$pdf);	
//				$cngn="";				
				$pagelins = $blockline;
				$pagedat = $block;
				
				$lcol='';
				$rcol='';
				$pgnum++;
			}else{
				$pagedat .= $block;
				$pagelins = $pagelins + $blockline;
			}
	
		}
			//	$pdf->writeHTML($pagedat,true,false,false,'L');
        
	}
	// we have finished is there any data not already sent...
	if ($pagelins > 0) {
		PageHeader('Council Meetings',$pdf);
		$y = $pdf->getY();
		$pdf->SetFillColor(255, 255, 255);
		$pdf->SetTextColor(0, 0, 0);
		$pdf->writeHTML($pagedat,true,false,false,'L');

	}
	
	


}

//mysql_free_result($data);


//include 'closedb.php';



// 4th Degree State
$pdf->SetHeaderData("4thdegree.png", 20	, "Tennessee State Council Directory", "Contact statesecretary@kofc-tn.org with Corrections");


$pdf->AddPage();
$pdf->Bookmark('Tennessee District Staff', 0, 0, '', 'B', array(0,0,0));
PageHeader('Tennessee District Staff (4th Degree)',$pdf);

// Retrieve the State officers info from the database

$qry = "Select * from members left outer join fratpos on members.cuserid=fratpos.cuserid where fratpos.dirgroup=9 and fratpos.cfratyear=".$cfy  ." order by fratpos.secorder";
//include 'configdb.php';
//include 'opendb.php';
	
$data = mysql_query($qry);
if (!$data) {
	echo 'Could not run query: ' . mysql_error() ."</br> Please use Back Button";
	die;
}

// set up Variables  for page generation

$blockrows = 0;
$blockcnt=0;
$ccol = "l";
$rcol = "";
$lcol = '';
#If something was returned
if ($data){
	# then make sure that we have at least one record
	if (mysql_num_rows($data)>0){
		while ($info = mysql_fetch_array( $data )) {
			$block = GenBlock($info,$info,"DS");
			switch ($ccol){
				case "r":
					$rcol .=$block;
					$ccol = "l";
					$blockcnt++;		
					break;
				case "l":
					$lcol .=$block;
					$ccol = "r";
					$blockcnt++;
					break;
			}
			if ($blockcnt == 8){
				$y = $pdf->getY();
				$pdf->SetFillColor(255, 255, 255);
				$pdf->SetTextColor(0, 0, 0);
				$pdf->writeHTMLCell(80, '', '', $y, $lcol, 0, 0, 1, true, 'J', true);
				$pdf->writeHTMLCell(80, '', '', '', $rcol, 0, 0, 1, true, 'J', true);
				$pdf->AddPage();			
				PageHeader('Tennessee District Staff',$pdf);
				$blockcnt = 0;
				$lcol='';
				$rcol='';
			}
			
		}
	}
}
//mysql_free_result($data);

//include 'closedb.php';

// we have finished output the last page of data if there is anything left to output
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)
// get current vertical position
if ($blockcnt >0){
	$y = $pdf->getY();
	$pdf->SetFillColor(255, 255, 255);
	$pdf->SetTextColor(0, 0, 0);
	$pdf->writeHTMLCell(80, '', '', $y, $lcol, 0, 0, 1, true, 'J', true);
	$pdf->writeHTMLCell(80, '', '', '', $rcol, 0, 0, 1, true, 'J', true);
}



// Faithful Navigators



$pdf->AddPage();
$pdf->Bookmark('Faithful Navigators', 0, 0, '', 'B', array(0,0,0));
PageHeader('Faithful Navigators',$pdf);

// Retrieve the Faithful navigators info from the database

$qry = "Select members.cuserid, members.ctitle,members.cfname,members.cmi, members.clname,members.csuffix, members.cnname,members.ccspouse, members.csnname, members.caddress1, members.caddress2, members.ccity, members.cstate, members.czip, members.chphone, members.cwphone, members.ccphone, members.cemail, members.cwemail, members.icouncil, members.iassembly,members.cpsdterm,members.tseclevel, fratpos.cposition, fratpos.cfratyear, fratpos.dirgroup, fratpos.secorder, council.cname from members left outer join fratpos on members.cuserid=fratpos.cuserid left join council on members.iassembly=council.ccouncil where fratpos.dirgroup=10 and fratpos.cfratyear=".$cfy  ." and council.bcouncil=0 order by members.iassembly";

//$qry = "Select * from members left outer join fratpos on members.cuserid=fratpos.cuserid where fratpos.dirgroup=10 order by members.iassembly";
//include 'configdb.php';
//include 'opendb.php';
	
$data = mysql_query($qry);
if (!$data) {
	echo 'Could not run query: ' . mysql_error() ."</br> Please use Back Button";
	die;
}

// set up Variables  for page generation

$blockrows = 0;
$blockcnt=0;
$ccol = "l";
$rcol = "";
$lcol = '';
#If something was returned
if ($data){
	# then make sure that we have at least one record
	if (mysql_num_rows($data)>0){
		while ($info = mysql_fetch_array( $data )) {

			$block = GenBlock($info,$info,"FN");
			switch ($ccol){
				case "r":
					$rcol .=$block;
					$ccol = "l";
					$blockcnt++;		
					break;
				case "l":
					$lcol .=$block;
					$ccol = "r";
					$blockcnt++;
					break;
			}
			if ($blockcnt == 8){
				$y = $pdf->getY();
				$pdf->SetFillColor(255, 255, 255);
				$pdf->SetTextColor(0, 0, 0);
				$pdf->writeHTMLCell(80, '', '', $y, $lcol, 0, 0, 1, true, 'J', true);
				$pdf->writeHTMLCell(80, '', '', '', $rcol, 0, 0, 1, true, 'J', true);
				$pdf->AddPage();			
				$pdf->Bookmark('Faithful Navigators Page ' .$pgnum, 1, 0, '', 'B', array(0,0,0));

				PageHeader('Faithful Navigators',$pdf);
				$blockcnt = 0;
				$lcol='';
				$rcol='';
			}
			
		}
	}
}
//mysql_free_result($data);

//include 'closedb.php';

// we have finished output the last page of data if there is anything left to output
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)
// get current vertical position
if ($blockcnt >0){
	$y = $pdf->getY();
	$pdf->SetFillColor(255, 255, 255);
	$pdf->SetTextColor(0, 0, 0);
	$pdf->writeHTMLCell(80, '', '', $y, $lcol, 0, 0, 1, true, 'J', true);
	$pdf->writeHTMLCell(80, '', '', '', $rcol, 0, 0, 1, true, 'J', true);
}


// Faithful Comptrollers



$pdf->AddPage();
$pdf->Bookmark('Faithful Comptroller', 0, 0, '', 'B', array(0,0,0));
PageHeader('Faithful Comptrollers',$pdf);

// Retrieve the Comptrollers info from the database

$qry = "Select members.cuserid, members.ctitle,members.cfname,members.cmi, members.clname,members.csuffix, members.cnname,members.ccspouse, members.csnname, members.caddress1, members.caddress2, members.ccity, members.cstate, members.czip, members.chphone, members.cwphone, members.ccphone, members.cemail, members.cwemail, members.icouncil, members.iassembly,members.cpsdterm,members.tseclevel, fratpos.cposition, fratpos.cfratyear, fratpos.dirgroup, fratpos.secorder, council.cname from members left outer join fratpos on members.cuserid=fratpos.cuserid left join council on members.iassembly=council.ccouncil where fratpos.dirgroup=11 and fratpos.cfratyear=".$cfy  ." and council.bcouncil=0 order by members.iassembly";
//include 'configdb.php';
//include 'opendb.php';
	
$data = mysql_query($qry);
if (!$data) {
	echo 'Could not run query: ' . mysql_error() ."</br> Please use Back Button";
	die;
}

// set up Variables  for page generation

$blockrows = 0;
$blockcnt=0;
$ccol = "l";
$rcol = "";
$lcol = '';
#If something was returned
if ($data){
	# then make sure that we have at least one record
	if (mysql_num_rows($data)>0){
		while ($info = mysql_fetch_array( $data )) {
			$block = GenBlock($info,$info,"FC");
			switch ($ccol){
				case "r":
					$rcol .=$block;
					$ccol = "l";
					$blockcnt++;		
					break;
				case "l":
					$lcol .=$block;
					$ccol = "r";
					$blockcnt++;
					break;
			}
			if ($blockcnt == 8){
				$y = $pdf->getY();
				$pdf->SetFillColor(255, 255, 255);
				$pdf->SetTextColor(0, 0, 0);
				$pdf->writeHTMLCell(80, '', '', $y, $lcol, 0, 0, 1, true, 'J', true);
				$pdf->writeHTMLCell(80, '', '', '', $rcol, 0, 0, 1, true, 'J', true);
				$pdf->AddPage();			
				$pdf->Bookmark('Faithful Comptrollers ' .$pgnum, 1, 0, '', 'B', array(0,0,0));

				PageHeader('Faithful Comptrollers',$pdf);
				$blockcnt = 0;
				$lcol='';
				$rcol='';
			}
			
		}
	}
}
//mysql_free_result($data);

//include 'closedb.php';

// we have finished output the last page of data if there is anything left to output
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)
// get current vertical position
if ($blockcnt >0){
	$y = $pdf->getY();
	$pdf->SetFillColor(255, 255, 255);
	$pdf->SetTextColor(0, 0, 0);
	$pdf->writeHTMLCell(80, '', '', $y, $lcol, 0, 0, 1, true, 'J', true);
	$pdf->writeHTMLCell(80, '', '', '', $rcol, 0, 0, 1, true, 'J', true);
}


// Former District Masters

// Agency

// MR Foundation

// Squires Chief Counselors

//


include 'closedb.php';


// reset pointer to the last page
$pdf->lastPage();


// ---------------------------------------------------------
if ($_COOKIE['validlogin']== 'true'){
	$userid = $_COOKIE['userid'];
	//Close and output PDF document
	$pdf->Output('TN State Council Directory.pdf', 'I');
	//$pdf->PrintChapter(1, 'State Officers', '', false);
	$ttg = (time()-$starttime);
	$ttgmsg = "Block Directory Generated in " .$ttg ." seconds\n Requested by: " .$userid;

	mail("tstaller@aol.com","Block Directory PDF Generated",$ttgmsg);
}


//============================================================+
// END OF FILE
//============================================================+
?>
