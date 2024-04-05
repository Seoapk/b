<?php

// ====== START CONDITIONS  ======
$ALL_DATA  ='data/all-data.php' ;
$ALL_ID    ='data/all-id.txt'   ;
$ONE_ID    ='data/one-id.txt'   ;
$ALL_COUNT ='data/all-count.txt';

$ALL_HEAD  ='all_head.php';
$ALL_VIEW_HEAD  ='all_view_head.php';
$ALL_VIEW_FOOT  ='all_view_foot.php';

if(!file_exists($ALL_DATA))
{
mkdir('data/',0755);
file_put_contents($ALL_DATA,  ''); //make all-data.php
file_put_contents($ALL_ID,   '1'); //make data/all-id.txt
file_put_contents($ONE_ID,   '1'); //make data/one-id.txt
file_put_contents($ALL_COUNT,'0'); //make data/all-count.txt     
}

if(empty($_GET['act']))
{    
echo '<H1>Hidden Page</H1>';    
}
// ====== END CONDITIONS  ======

// ====== START ELSE      ======
else
{
  
// ====== START VIEW ALL  ======
$act = $_GET['act'];

if($act =='home') 
{
	
$allid   = file_get_contents($ALL_ID);
$total=    file_get_contents($ALL_COUNT).' $';
//$total= number_format($one,2,"&nbsp;.",",")."&nbsp;$";
echo '
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SeoApp</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<!-- Fixed Header with Search Input -->
<div class="header">
<input type="text" placeholder="Search by ID, name, or amount...">
</div>

<!-- Table -->
<div class="tablediv">
<table id="sampleTable">
<thead>
<tr>
<th><button id="addButton" class="addButton" onclick="ashowHiddenForm()" title="Click to add new client"><b>+</b></button></th>
<th style="text-align: right;"><strong>Total :</strong></th>
<th style="text-align: right;color: yellow;" class="truncate" >'.$total.'</th> <!-- Updated to display calculated amount -->
</tr>
<tr>
<td style="width:10%;cursor:pointer;" onclick="sortTable(0)" >ID</td>
<td style="width:60%;cursor:pointer;" onclick="sortTable(1)" >Name</td>
<td style="width:20%;text-align: right;cursor:pointer;" onclick="sortTable(2)" >Amount</td>
</tr>
</thead>

<tbody>';

include($ALL_DATA);


echo '
</tbody>
<tfoot>
<td colspan="3"></td>
</tfoot>
</table>
</div>
   
<!-- Hidden form ( New Client ) -->
<div id="aoverlay" class="aoverlay" onclick="ahideHiddenForm()"></div>
<div  id="ahiddenForm" class="ahidden-form">
<button class="close-btn" onclick="ahideHiddenForm()">X</button>
<h2>New Client</h2>
<form method="post" action="./action.php?act=add-all">
<input class="idinputStyle" type="text" value="ID = '.$allid.'" name="id" readonly="true" ></br>
<input class="inputStyle" type="text"   id="H_name"  name="name"  placeholder="Name"  maxlength="30" required></br>
<input class="inputStyle" type="tel" id="H_phone" name="phone" placeholder="Phone" maxlength="14">
<button class="asubmit-btn" >Submit</button>
</form>
</div>

<!-- Hidden form ( Edit Client ) -->
<div id="boverlay" class="aoverlay" onclick="bhideHiddenForm()"></div>
<div  id="bhiddenForm" class="ahidden-form">
<button class="close-btn" onclick="bhideHiddenForm()">X</button>
<h2>Edit Client</h2>
<form  method="post" id="H0" >
<input type="Hidden"   id="H1"   name="id" ></input>
<input type="text"     id="H2"   name="name"  class="inputStyle" maxlength="30" required></input></br>
<input type="tel"      id="H3"   name="phone" class="inputStyle" maxlength="14"></input>
<button class="asubmit-btn" onclick="edit_submit()">Save</button>
</form>
</div>

<!-- Hidden menu ( open-edit-delete ) -->
<div style="display: none;" id="hiddenDiv" onclick="closeOnClickOutside(event)">
<div class="popup-content">
<span class="close-btn" onclick="toggleDiv()">&times;</span>
<h2>Action Required</h2>
<p>Edit, or delete?</p>
<div class="btn-container">

<button class="edit-btn"   onclick="closeOnClickOutside(event);bshowHiddenForm();">Edit</button>
<button class="delete-btn" onclick="delete_submit()">Delete</button>
</div>
</div>
</div> 
             
<script src="function.js"></script>
</body>
</html>';

} 
// ====== END VIEW ALL ======

// ====== START OPEN     ======
if($act =='open')
{
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{	
$id    =$_POST['id']   ;
$name  =$_POST['name'] ;
$phone =$_POST['phone'];
} 
elseif ($_SERVER['REQUEST_METHOD'] === 'GET')
{
$id    =$_GET['id']   ;
$name  =$_GET['name'] ;
$phone =$_GET['phone'];	
}

$creditID='data/'.$id.'.txt';
$total=    file_get_contents($creditID);
//$total= number_format($one,2,"&nbsp;.",",")."&nbsp;$";
$idope  = file_get_contents($ONE_ID);

echo '
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sheet for: '.$name.'</title>
<link href="style.css" rel="stylesheet" media="all" />
</head>
<body>

<!-- Table -->
<div class="tablediv">
<table id="sampleTable">

<thead>
<tr >
<th class="truncate" >Id: <a style="color: yellow;font-weight: bold;">'.$id.'</a></th>
<th class="truncate" style="text-align:right;" >Tot: <a style="color: yellow;font-weight: bold;">'.$total.'</a></th>
</tr>
<tr>
<th colspan="2" class="truncate" style="padding: 7px 15px;" >Name: <a style="color: yellow;font-weight: bold;">'.$name.'</a></th>
</tr>
<tr>
<th colspan="2" class="truncate" style="padding: 7px 15px;" >Phone: <a style="color: yellow;font-weight: bold;">'.$phone.'</a></th>
</tr>

<tr>
<td>Note & date</td>
<td style="text-align:right;">Amount</td>
</tr>
</thead>

<tbody>';

$odtb='data/'.$id.'.php';
include($odtb);

echo '
</tbody>
<tfoot>
<td colspan="2"></td>
</tfoot>
</table>
</div>

<div class="header">
<input  class="edit-btn"   style="background-color:#b0d0d0;color: #406068;" type="button" value="Home"  onclick="window.location=\'action.php?act=home\';"></input>
<input  class="delete-btn" style="background-color:#b0d0d0;color: #406068;" type="button" value="Add +" onclick="ashowHiddenForm()"></input>
<input  class="open-btn"   style="background-color:#b0d0d0;color: #406068;" type="button" value="Payed" onclick="window.location=\'action.php?act=payed&id='.$id.'&name='.$name.'&phone='.$phone.'\';"></input>
</div>


<!-- Hidden form ( New Item ) -->
<div id="aoverlay" class="aoverlay" onclick="ahideHiddenForm()"></div>
<div  id="ahiddenForm" class="ahidden-form">
<button class="close-btn" onclick="ahideHiddenForm()">X</button>
<h2>To: '.$name.'</h2>
<form method="post" id="ADD0" >
<input class="idinputStyle" type="text" value="Item Id : '.$idope.'" readonly="true" ></input></br>
<input class="inputStyle" type="text" value="'.date("d/m/y").'" name="date" ></input></br>
<input class="inputStyle" type="number"   name="amount" placeholder="Amount" maxlength="14" required></input></br>
<input class="inputStyle" type="text"     name="note"  placeholder="Note" maxlength="30"></input>
<input type="hidden" value="'.$id.'"    name="id"></input>
<input type="hidden" value="'.$name.'"  name="name"></input>
<input type="hidden" value="'.$phone.'" name="phone"></input>
<button class="asubmit-btn" onclick="item_submit()">Submit</button>
</form>
</div>

<script src="function.js"></script>
</body>
</html>'; 
} 
// ====== END OPEN        ======

// ====== START EDIT   ======
if($act =='edit')
{

$id        =$_POST['id']   ;
$new_name  =$_POST['name'] ;
$new_phone =$_POST['phone'];

$searchString = "X".$id."X"; // String to search for
$replacementStrings =       // New strings to replace
[
'<tr id="X'.$id.'X" onmouseover="X'.$id.'X()" onmousedown="startPress()" onmouseup="endPress()" ondblclick="open_submit()">',
'<td id="X'.$id.'X">'.$id.'</td>',
'<td id="X'.$id.'X" class="truncate" >'.$new_name.'</td>',
'<td id="X'.$id.'X" style="text-align: right;"  class="truncate" ><?php $num=file_get_contents("data/'.$id.'.txt");$total=number_format($num,2,".","")."$";echo $total; ?></td>',
'<script id="X'.$id.'X"> function X'.$id.'X() {document.getElementById("H1").value = "'.$id.'";document.getElementById("H2").value = "'.$new_name.'";document.getElementById("H3").value = "'.$new_phone.'" ;}</script></tr>'
]; 

// Read the content of the text file
$content = file_get_contents($ALL_DATA);

// Replace lines containing the search string with replacement strings
$lines = explode("\n", $content);
$newContent = '';
$replacementIndex = 0;
foreach ($lines as $line) {
    // Check if the line contains the search string
    if (strpos($line, $searchString) !== false) {
        // Replace the line with the next replacement string
        $newContent .= $replacementStrings[$replacementIndex] . "\n";
        // Increment the index for the next replacement string
        $replacementIndex++;
    } else {
        // If the line does not contain the search string, keep it unchanged
        $newContent .= $line;
        // Add newline character if it's not the last line
        if ($line !== end($lines)) {
            $newContent .= "\n";
        }
    }
}

// Write the updated content back to the text file
file_put_contents($ALL_DATA, $newContent);

echo "<script> location.href='action.php?act=home'; </script>";
	
} 
// ====== END EDIT     ======

// ====== START DELETE ======
if($act =='delete')
{ 
$id =$_POST['id'];

$txt='data/'.$id.'.txt';
$zero=file_get_contents($txt);

if($zero=='0')
{
$lineID   ='id="X'.$id.'X"';

$fc=file($ALL_DATA);
$f=fopen($ALL_DATA,'w');

foreach($fc as $line)
{
if(!strstr($line,$lineID))
fputs($f,$line);  
}
fclose($f);

echo "<script> location.href='action.php?act=home'; </script>";
}
else
{ 
echo 
'<html>
 <head>
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <link rel="stylesheet" href="style.css">
 </head>
 <body>
 <div class="popup-content"><br/><h3>To Delete the Client, Amount must be 00.00$ </h3>
 <input class="edit-btn" type="button" value="OK" onclick="window.location=\'action.php?act=home\';"></input></div>
 </body>
 </html>';
}
}
// ====== END DELETE       ======

// ====== START ADD CLIENT ====== 
if($act =='add-all')
{
$name  =$_POST['name' ];
$phone =$_POST['phone'];
$cid   =$_POST ['id'];
$id=str_replace('ID = ',"",$cid);

$amount='<?php $num=file_get_contents("data/'.$id.'.txt");$total=number_format($num,2,".","")."$";echo $total; ?>';
$lineID ='X'.$id.'X';

if (!$name =='')
{

$HTMLcontent =    '<tr id="'.$lineID.'" onmouseover="'.$lineID.'();"onmousedown="startPress()" onmouseup="endPress()" ondblclick="open_submit()">'."\n";
$HTMLcontent.=    '<td id="'.$lineID.'">'.$id.    '</td>'."\n";
$HTMLcontent.=    '<td id="'.$lineID.'" class="truncate">'.$name.  '</td>'."\n";
$HTMLcontent.=    '<td id="'.$lineID.'" style="text-align: right;" class="truncate">'.$amount.'</td>'."\n"; 
$HTMLcontent.='<script id="'.$lineID.'"> function '.$lineID.'() {document.getElementById("H1").value = "'.$id.'";document.getElementById("H2").value = "'.$name.'";document.getElementById("H3").value = "'.$phone.'" ;}</script></tr>'."\n";

$put  = file_put_contents($ALL_DATA,$HTMLcontent,FILE_APPEND);
$put1 = file_put_contents($ALL_ID,$id+1);

$data4newclient  ='data/'.$id.'.php';
$total4newclient ='data/'.$id.'.txt';

$put2 = file_put_contents($data4newclient,'');
$put3 = file_put_contents($total4newclient,'0');

echo "<script> location.href='action.php?act=home'; </script>";

}
else
{ 
echo 'Please enter a valid name ';
}
}
// ====== END ADD CLIENT ======
 
// ====== START ADD ITEM  ======
 if($act =='additem')
{
$id     =$_POST['id']    ;
$date   =$_POST['date']  ;
$amount =$_POST['amount'];
$name   =$_POST['name']  ;
$phone  =$_POST['phone'] ;
$note   =$_POST['note']  ;



$data4newclient='data/'.$id.'.php';

$idope = file_get_contents($ONE_ID);

$all   = file_get_contents($ALL_COUNT);

$creditID='data/'.$id.'.txt';
$one=    file_get_contents($creditID);

if (!$amount =='')
{

$rowID    ='RX'.$id.'XS'.$idope.'S';
$dateID   ='DX'.$id.'XS'.$idope.'S';
$amountID ='AX'.$id.'XS'.$idope.'S';

$HTMLcontent = "\n".'<tr id="'.$rowID.'" >'."\n" ;
$HTMLcontent.='<td id="'.$dateID.'" class="truncate">( '.$date.' ) '.$note.'</td>'."\n";
$HTMLcontent.='<td id="'.$amountID.'" style="text-align:right;" class="truncate">'.number_format($amount,2,".","").' $'.'</td></tr>';
$HTMLcontent.= file_get_contents($data4newclient);

$putone  = file_put_contents($data4newclient,$HTMLcontent);
$putone1 = file_put_contents($ONE_ID,$idope+1);
$putone2 = file_put_contents($ALL_COUNT,$all+$amount);
$putone3 = file_put_contents('data/'.$id.'.txt',$one+$amount) ;

echo "<script>location.href='action.php?act=open&id=".$id."&name=".$name."&phone=".$phone."';</script>";
}
echo 'Please enter a valid numeric amount value ';
}

// ====== END ADD ITEM ======

// ====== START PAYED  ======
if($act =='payed')
{
$clientname  =$_GET['name'];    
$clientID    =$_GET['id'];
$clientphone =$_GET['phone'];
   
$creditID      ='data/'.$clientID.'.txt';
$data4newclient='data/'.$clientID.'.php';

$NumCreditID=file_get_contents($creditID);
$getcntall=file_get_contents($ALL_COUNT);

$fput  ="\n".'<tr style="background-color:#dcedc8;color:black"><td  class="truncate"><b>'.Date("d/m/y").' [ PAYED ]</b></td><td style="text-align:right" class="truncate"><b>'.' [- '.$NumCreditID.' $]'.'</b></td></tr>';
$fput .= file_get_contents($data4newclient);
$fput .= file_put_contents($data4newclient,$fput);

$min=file_get_contents($ALL_COUNT);
$calc= $min-$NumCreditID;
$put1 = file_put_contents($ALL_COUNT,$calc);
$put2 = file_put_contents($creditID,'0');
echo "<script> location.href='action.php?act=open&id=".$clientID."&name=".$clientname."&phone=".$clientphone."'; </script>";

} 
// ====== END PAYED ======
 
} 
// ====== END ELSE  ======
	 
?>