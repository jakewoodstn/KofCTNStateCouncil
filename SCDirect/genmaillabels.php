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
	
	$doc->SetFont("helvetica",'B',24);
	$doc->Cell(0, 12, $hdrstr, 1, 1, 'C');
	$doc->SetFont('helvetica', '', 14);

	
}
function GenBlock($infoarr,$carr, $sect){
	
	
			$name = trim(subPrefix($infoarr['ctitle'])) ." ". trim(checkformat($infoarr['cfname'])) ." " .trim(checkformat($infoarr['cmi'])) ." " .trim($infoarr['clname']);
			if ($infoarr['csuffix'] != ''){
				$name .= ", " .trim($infoarr['csuffix']);
			}
			$address1 = trim($infoarr['caddress1']);
			$address2 = trim($infoarr['caddress2']);
			$cityline = trim($infoarr['ccity']) .", " .trim($infoarr['cstate']) ." " .trim($infoarr['czip']);
			$position = trim($infoarr['cposition']) ." Council: " .trim($infoarr['icouncil']);
			
			$coltab = "  ";
			$blines = 0;
			
			$block .= "  ".$name ."\n";
			if (strlen($position)>0){
				$block .= $coltab .$position ."\n";
			}
			if (strlen($address1)>0){
				$block .= $coltab .$address1 ."\n";
			}
			if (strlen($address2)>0){
				$block .= $coltab .$address2 ."\n";
			}
			if (strlen(trim($cityline))>0){
				$block .= $coltab .$cityline ."\n";
				$blines++;
			}
		return $block;
}

function GenCouncilBlock($infoarr,$carr, $sect){
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
			$offmeet = $infoarr['oficers'];
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
					$block .= $coltab ."First Meeting: "  .$coltab .trim($mtime1) .$coltab .trim($meet1);
					$block .= $coltab ."," .$coltab ."Second Meeting:" .$coltab .trim($mtime2) .$coltab .trim($meet2) ;
					$block .= "<br>";
					$blines++;
				} else {
					$block .= $coltab ."Meeting:" .$coltab .trim($mtime1) .$coltab .trim($meet1) ."<br>";
					$blines++;
				}
			}
			if (strlen($offmeet)>5){
				$block .= $coltab ."Officers Meeting:" .$coltab .$coltab .trim($offtime) .$coltab .trim($offmeet) .$coltab .trim($offtime);
				$block .= "<br>";
				$blines++;
			}
			
			$block .=" <br>";
			$blines++;
			
			$block .="</span>";
		return array($block,$blines);
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

//-----------------------------End function definitions -------------------------------


include "config.php";
if(!empty($_POST['submit'])){
	
	
	
	foreach($printcat as $pelem){
		if (!empty($_POST[$pelem['name']])){
			$drgrp = $_POST[$pelem['name']];
			$whr .= "fratpos1.dirgroup=" .$drgrp ." or " ;
		}
	}
	$whr = substr($whr,0,-4);
}else{
	die;
}




$cfy = GetFratYear();

$starttime= time();
// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Tennessee State Council');
$pdf->SetTitle('Tennessee State Council Directory');
$pdf->SetSubject('State Council Membership Directory');
$pdf->SetKeywords('Directory, block, telephone');
$preferences = array(
    'FitWindow' => false,
    'CenterWindow' => false,
    'PrintScaling' => 'None', // None, AppDefault
);

// Check the example n. 60 for advanced page settings

// set pdf viewer preferences
$pdf->setViewerPreferences($preferences);

$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetMargins(5, 13, 1,true);

//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);


//set auto page breaks
$pdf->SetAutoPageBreak(FALSE, 0);

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
$pdf->SetFont('helvetica', '', 10);

// add a page
//$pdf->AddPage();


// set cell padding
$pdf->setCellPaddings(0, 0, 0, 0);
// set cell margins
$pdf->setCellMargins(0, 0, 0, 0);
// MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)

//Enable Header before adding Next Page
$pdf->startPageGroup();

$pdf->AddPage();
//$pdf->Bookmark('State Officers', 0, 0, '', 'B', array(0,0,0));

//PageHeader('State Officers',$pdf);
// Retrieve the State officers info from the database

$qry = "Select members.*, fratpos1.*, council.bsuspended from members left join (SELECT cuserid, cposition as cposition ,  min(dirgroup) AS dirgroup, secorder AS secorder, cfratyear AS cfratyear FROM fratpos where cfratyear=" .$cfy ." GROUP BY cuserid) as fratpos1 on members.cuserid = fratpos1.cuserid join council on members.icouncil=council.ccouncil where council.bsuspended = 0 and " .$whr ." and fratpos1.cfratyear= " .$cfy ." order by fratpos1.dirgroup, fratpos1.secorder, members.icouncil";


//$qry = "Select members.*, fratpos1.*, council.bsuspended from members join (SELECT cuserid, cposition as cposition , MIN( dirgroup ) AS dirgroup, secorder AS secorder, cfratyear AS cfratyear FROM fratpos GROUP BY cuserid order by fratpos.dirgroup ) as fratpos1 on members.cuserid = fratpos1.cuserid join council on members.icouncil=council.ccouncil where council.bsuspended = 0 and (" .$whr .") and fratpos1.cfratyear= " .$cfy ." order by fratpos1.dirgroup, fratpos1.secorder";

//$qry = "Select * from members left outer join fratpos on members.cuserid=fratpos.cuserid where fratpos.cposition = 'Grand Knight' and fratpos.cfratyear=".$cfy  ." order by members.icouncil";

include 'configdb.php';
include 'opendb.php';
	
$data = mysql_query($qry);
if (!$data) {
	echo 'Could not run query: ' . mysql_error() ."</br> Please use Back Button";
	die;
}

// set cell padding
$pdf->setCellPaddings(1, 1, 1, 1);
// set cell margins
// nction setCellMargins($left='', $top='', $right='', $bottom='')
$pdf->setCellMargins(1, 1, 3, 1);

// set color for background
$pdf->SetFillColor(255, 255, 127);
$bcells = 1;
if ($data){
	# then make sure that we have at least one record
	if (mysql_num_rows($data)>0){
		while ($info = mysql_fetch_array( $data )) {
			$block = GenBlock($info,$info,"SO");
			// MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)
			// Multicell tes
			$pline = intval($bcells/3);
			//$block .= $pline;
			if ($bcells % 3 ==0 && ($bcells>0)){
				$pline = 1;
			} else {
				$pline = 0;
			}
			
			$pdf->MultiCell(66.6, 25.4, $block, 0, 'L', 0, $pline, '', '', true,1,false,false,25.4,false,false);
			$bcells++;
			if (($bcells % 31)==0){
				$pdf->AddPage();
				$bcells = 1;

			}
		}
	}
}

include 'closedb.php';


// reset pointer to the last page
$pdf->lastPage();
$pdf->Output('TNSCMailLabels.pdf', 'D');


// ---------------------------------------------------------
if ($_COOKIE['validlogin']== 'true'){
	$userid = $_COOKIE['userid'];
	//Close and output PDF document
	//$pdf->PrintChapter(1, 'State Officers', '', false);
	$ttg = (time()-$starttime);
	$ttgmsg = "Block Directory Generated in " .$ttg ." seconds\n Requested by: " .$userid;

	mail("tstaller@aol.com","Mailing Label PDF Generated",$ttgmsg);
}


//============================================================+
// END OF FILE
//============================================================+
?>
