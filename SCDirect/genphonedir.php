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
		case "RMr":
			$pfx = "Rev. Mr.";
			break;
		case "Rev":
			$pfx = "Rev.";
			break;
		case "MRev":
			$pfx = "Most Rev.";
			break;
		case "Dr":
			$pfx = "Dr.";
			break;
		default:
			$pfx = " ";
	}
	return $pfx;
}

function PageHeader($hdrstr,$doc){
	
	$doc->SetFont("times",'B',24);
	$doc->Cell(0, 12, $hdrstr, 1, 1, 'C');
	$doc->SetFont('times', '', 10);

	
}
function GenBlock($infoarr,$carr, $sect){
			$name = trim($infoarr['clname']) .", " .trim(subPrefix($infoarr['ctitle'])) ." ". trim(checkformat($infoarr['cfname'])) ." " ;
			if ($infoarr['csuffix'] != ''){
				$name .= ", " .trim($infoarr['csuffix']);
			}
			if ($infoarr['cnname'] !=""){
				$name .= "  (" .$infoarr['cnname'] .")";
			}
			$address = trim($infoarr['caddress1']).", ";
			$address .= trim($infoarr['caddress2']);
			$cityline = trim($infoarr['ccity']) .", " .trim($infoarr['cstate']) ." " .trim($infoarr['czip']);
			$hphone = $infoarr['chphone'];
			$wphone = $infoarr['cwphone'];
			$cphone = $infoarr['ccphone'];
			$email = $infoarr['cemail'];
			$position = $carr;
			$fratyear = $infoarr['cfratyear'];
			
			$coltab = "&nbsp;&nbsp;";
			$block ='<span style="font-weight: bold; font-size: 12;">' .$name ."</span>, " .trim($position) ."<br>";
			$blines++;
		    $block .= '<span style="font-weight: normal; font-size: 10;">';
			if (strlen(trim($address))>0){
				$block .= $coltab .$address;
				$blines++;
			}
			if (strlen(trim($cityline))>0){
				$block .= ", " .$cityline;
				$blines++;
			}
			if (strlen($email)>5){
				$block .= $coltab ."Pri. Email:" .$coltab	.$email;
			}
			$block .= "<br>";
			$phone = "";
			if (strlen(trim($hphone))>6){
				$phone .= $coltab ."Home:" .$coltab .formatphone($hphone);
			}
			if (strlen(trim($wphone))>6){
				$phone .= $coltab ."Work:" .$coltab .formatphone($wphone);
			}
			if (strlen(trim($cphone))>6){
				$phone .= $coltab ."Mobile:" .$coltab .formatphone($cphone);
			}
			if (strlen(trim($phone))>6){
				$phone .= "<br>";
				$block .= $phone;
			}
			$block .="</span>";
		return $block;
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

include 'config.php';

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
$pdf->SetHeaderData("3rddegree.png", 20	, "Tennessee State Council Directory", "Contact stateadvocate@kofc-tn.org with Corrections");
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
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------

// set font
$pdf->SetFont('times', '', 10);

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
$pdf->SetFont("times",'B',24);

$pdf->writeHTMLCell(0,40,0,110,"Tennessee State Council Directory <br> Fraternal Year " .$cfy ."-" .$nfy,0,0,0,true,"C",true);

$pdf->AddPage();

//Enable Header before adding Next Page
$pdf->startPageGroup();
$pdf->setPrintHeader(true);

$pdf->AddPage();

//enable the Footer for the remainder of the Document
$pdf->setPrintFooter(true);

// Gen the Supreme council page

// Page Header
$pdf->Cell(0, 12, 'Supreme Council', 1, 1, 'C');
$pdf->SetFont('times', '', 10);

// Supreme Officers List

$supremeofficers = "<strong>Supreme Knight</strong><br/>Carl A. Anderson<br /><br/><strong>Supreme Chaplain</strong><br>Bishop William E. Lori, S.T.D.<br/><br/><strong>Deputy Supreme Knight</strong><br>Dennis A. Savoie<br/><br/><strong>Supreme Secretary</strong><br>Charles E. Maurer, Jr.<br/><br/><strong>Supreme Treasurer</strong><br>Logan T. Ludwig<br/><br/><strong>Supreme Advocate</strong><br>John A. Marrella<br/>";

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

$pdf->SetFont('times', '', 18);

$y = $pdf->getY();

// set color for background
$pdf->SetFillColor(255, 255, 255);

// set color for text
$pdf->SetTextColor(0, 0, 0);

// write the first column
$pdf->writeHTMLCell(70, '', '', $y, $supremeofficers, 0, 0, 1, true, 'L', true);

// Reset Font size for the Phone list

$pdf->SetFont('times', '', 10);

// write the second column
$pdf->writeHTMLCell(90, '', '', '', $supremedir, 0, 0, 1, true, 'L', true);

// Create the State Officers page

$pdf->AddPage();
//PageHeader('State Officers',$pdf);

// Retrieve the State officers info from the database

$qry = "Select * from members left outer join fratpos on members.cuserid = fratpos.cuserid where fratpos.cfratyear = $cfy order by CONCAT(clname,', ',cfname)";
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
			$qry2 = "select cuserid, cposition from fratpos where cuserid='" .$info['cuserid'] ."' and cuserid <> 'admin' and cfratyear=" .$cfy ;
			$posstr = "";
			$data2 = mysql_query($qry2);
			if($data2){
				if (mysql_num_rows($data2)>0){
					while($info2=mysql_fetch_array($data2)){
						$posstr .= $info2['cposition'] .", ";
					}
				}
				$posstr = substr($posstr,0,-2);
			}
			$block = GenBlock($info,$posstr,"SO");
			$pagedat .=$block;
			$blockcnt++;		
			if ($blockcnt == 17){
				$y = $pdf->getY();
				$pdf->SetFillColor(255, 255, 255);
				$pdf->SetTextColor(0, 0, 0);
				$pdf->writeHTML($pagedat,true,false,false,'L');
//				$pdf->writeHTMLCell(80, '', '', $y, $lcol, 0, 0, 1, true, 'J', true);
//				$pdf->writeHTMLCell(80, '', '', '', $rcol, 0, 0, 1, true, 'J', true);
				$pdf->AddPage();			
				$blockcnt = 0;
				$pagedat='';
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
	$pdf->writeHTML($pagedat,true,false,false,'L');
	
}

// Output Program Staff

include 'closedb.php';


// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

if ($_COOKIE['validlogin']== 'true'){
	$userid = $_COOKIE['userid'];

	//Close and output PDF document
	$pdf->Output('TN State Council Phone Directory.pdf', 'I');
	//$pdf->PrintChapter(1, 'State Officers', '', false);


	$ttg = (time()-$starttime);
	$ttgmsg = "Phone List Generated in " .$ttg ."seconds\n Requested by: " .$userid;

	mail("tstaller@aol.com","Phonelist PDF Generated",$ttgmsg);
}


//============================================================+
// END OF FILE
//============================================================+
?>
