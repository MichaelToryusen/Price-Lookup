<?php
//***************************************
//Html table design from https://mottie.github.io/tablesorter/ By Christian Bach
//*****************************************

require "config2.php"; // Your Database details 
include '../Constants/navbar.php';
?>

<!doctype html public "-//w3c//dtd html 3.2//en">

<html>
<style type="text/css">
	.TFtable{
		width:100%; 
		border-collapse:collapse; 
	}
	.TFtable td{ 
		padding:7px; border:#4e95f4 1px solid;
	}
	/* provide some minimal visual accomodation for IE8 and below */
	.TFtable tr{
		background: #b8d1f3;
	}
	/*  Define the background color for all the ODD background rows  */
	.TFtable tr:nth-child(odd){ 
		background: #b8d1f3;
	}
	/*  Define the background color for all the EVEN background rows  */
	.TFtable tr:nth-child(even){
		background: #dae5f4;
	}
</style>

<head>
<title>PriceLookup</title>
<meta name="GENERATOR" content="Arachnophilia 4.0">
<meta name="FORMATTER" content="Arachnophilia 4.0">

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="http://mottie.github.io/tablesorter/js/jquery.tablesorter.js"></script>
<script src="http://mottie.github.io/tablesorter/js/jquery.tablesorter.widgets.js"></script>
<link rel="stylesheet" type="text/css" href="http://mottie.github.io/tablesorter/css/theme.blue.css">

<SCRIPT language=JavaScript>
function reload(form)
{
var val=form.cat.options[form.cat.options.selectedIndex].value; 
self.location='index.php?cat=' + val ;

}

function reload2(form)
{
var val=form.cat.options[form.cat.options.selectedIndex].value; 
var val2=form.subcat.options[form.subcat.options.selectedIndex].value; 

self.location='index.php?cat=' + val + '&cat2=' + val2 ;
}

function reload3(form)
{
var val=form.cat.options[form.cat.options.selectedIndex].value; 
var val2=form.subcat.options[form.subcat.options.selectedIndex].value; 
var val3=form.subcat2.options[form.subcat2.options.selectedIndex].value; 

self.location='index.php?cat=' + val + '&cat2=' + val2 + '&cat3=' + val3 ;
}

function reload4(form)
{
var val=form.cat.options[form.cat.options.selectedIndex].value; 
var val2=form.subcat.options[form.subcat.options.selectedIndex].value; 
var val3=form.subcat2.options[form.subcat2.options.selectedIndex].value; 
var val4=form.subcat3.options[form.subcat3.options.selectedIndex].value; 

self.location='index.php?cat=' + val + '&cat2=' + val2 + '&cat3=' + val3 + '&cat4=' + val4 ;
}

function reload5(form)
{
var val=form.cat.options[form.cat.options.selectedIndex].value; 
var val2=form.subcat.options[form.subcat.options.selectedIndex].value; 
var val3=form.subcat2.options[form.subcat2.options.selectedIndex].value; 
var val4=form.subcat3.options[form.subcat3.options.selectedIndex].value; 
var val5=form.subcat4.options[form.subcat4.options.selectedIndex].value; 

self.location='index.php?cat=' + val + '&cat2=' + val2 + '&cat3=' + val3 + '&cat4=' + val4  + '&cat5=' + val5 ;
}

function reload6(form)
{
var val=form.cat.options[form.cat.options.selectedIndex].value; 
var val2=form.subcat.options[form.subcat.options.selectedIndex].value; 
var val3=form.subcat2.options[form.subcat2.options.selectedIndex].value; 
var val4=form.subcat3.options[form.subcat3.options.selectedIndex].value; 
var val5=form.subcat4.options[form.subcat4.options.selectedIndex].value; 
var val6=form.subcat5.options[form.subcat5.options.selectedIndex].value; 

self.location='index.php?cat=' + val + '&cat2=' + val2 + '&cat3=' + val3 + '&cat4=' + val4  + '&cat5=' + val5  + '&cat6=' + val6 ;
}


</script>
</head>

<body>
<?Php


///////// Getting the data from Mysql table for first list box//////////
$quer2= mssql_query("SELECT DISTINCT [product description],[product code] FROM [Denton_Multi].[dbo].[JH_TblFurniture1ProductGroup] order by [product code]");///////////// End of query for first list box////////////



/////// for second drop down list we will check if category is selected else we will display all the subcategory///// 
$cat=$_GET['cat']; // This line is added to take care if your global variable is off
if(isset($cat) and strlen($cat) > 0){
$quer=mssql_query("SELECT DISTINCT [supplier name],ID 
FROM [Denton_Multi].[dbo].[JH_TblFurniture2Supplier] 
JOIN suppliers ON [Denton_Multi].[dbo].[JH_TblFurniture2Supplier].[supplier code] = [Denton_Multi].[dbo].[suppliers] .[supplier code] 
where [Denton_Multi].[dbo].[JH_TblFurniture2Supplier].[product group]=$cat  AND [Denton_Multi].[dbo].[JH_TblFurniture2Supplier].[Delete] = 0 order by [supplier name]
"); 
}else{$quer="SELECT DISTINCT supplier_name,ID FROM `TABLE 2` JOIN suppliers ON `TABLE2`.supplier_code = `suppliers`.supplier_code order by supplier_name"; } 
////////// end of query for second subcategory drop down list box ///////////////////////////


/////// for Third drop down list we will check if sub category is selected else we will display all the subcategory3///// 
$cat2=$_GET['cat2']; // This line is added to take care if your global variable is off
if(isset($cat2) and strlen($cat2) > 0){
$quer3=mssql_query("SELECT DISTINCT [model description],[Denton_Multi].[dbo].[JH_TblFurniture3Range].[ID] 
FROM [Denton_Multi].[dbo].[JH_TblFurniture3Range] 
JOIN [Denton_Multi].[dbo].[JH_TblFurniture2Supplier] 
ON [Denton_Multi].[dbo].[JH_TblFurniture2Supplier].[supplier code] = [Denton_Multi].[dbo].[JH_TblFurniture3Range].[supplier code]
WHERE [Denton_Multi].[dbo].[JH_TblFurniture3Range].[product group]=$cat AND [JH_TblFurniture2Supplier].[ID]=$cat2 AND [Denton_Multi].[dbo].[JH_TblFurniture3Range].[Delete]=0 
order by [Denton_Multi].[dbo].[JH_TblFurniture3Range].[model description]"); 
}else{$quer3="SELECT DISTINCT subcat2 FROM subcategory2 order by subcat2"; } 
//////////end of query for third subcategory drop down list box ///////////////////////////


/////// for Forth drop down list we will check if sub category is selected else we will display all the subcategory3///// 
$cat3=$_GET['cat3']; // This line is added to take care if your global variable is off
if(isset($cat3) and strlen($cat3) > 0){
$quer4=mssql_query("SELECT DISTINCT [item description],[item code] ,[Denton_Multi].[dbo].[JH_TblFurniture4Item].[ID]
FROM [Denton_Multi].[dbo].[JH_TblFurniture4Item]  
join [Denton_Multi].[dbo].[JH_TblFurniture2Supplier] 
ON [Denton_Multi].[dbo].[JH_TblFurniture2Supplier].[supplier code] = [Denton_Multi].[dbo].[JH_TblFurniture4Item].[supplier code]
join [Denton_Multi].[dbo].[JH_TblFurniture3Range] 
ON [Denton_Multi].[dbo].[JH_TblFurniture3Range].[model code] = [Denton_Multi].[dbo].[JH_TblFurniture4Item].[model code]
where [Denton_Multi].[dbo].[JH_TblFurniture4Item].[product group]=$cat AND 
[Denton_Multi].[dbo].[JH_TblFurniture2Supplier].[ID]=$cat2 AND 
[Denton_Multi].[dbo].[JH_TblFurniture3Range].[ID]=$cat3 AND
[Denton_Multi].[dbo].[JH_TblFurniture4Item].[Delete]=0 
order by [item code]"); 
}else{$quer4="SELECT DISTINCT subcat2 FROM subcategory2 order by subcat2"; } 
////////// end of query for forth subcategory drop down list box ///////////////////////////


/////// for Fifth drop down list we will check if sub category is selected else we will display all the subcategory3///// 
$cat4=$_GET['cat4']; // This line is added to take care if your global variable is off
if(isset($cat4) and strlen($cat4) > 0){

$quer5=mssql_query("SELECT DISTINCT [Denton_Multi].[dbo].[JH_TblFurniture5Grade].[description],[Denton_Multi].[dbo].[JH_TblFurniture5Grade].[colour code],[Denton_Multi].[dbo].[JH_TblFurniture5Grade].[ID] 
FROM [Denton_Multi].[dbo].[JH_TblFurniture5Grade] 
join [Denton_Multi].[dbo].[JH_TblFurniture2Supplier] ON [Denton_Multi].[dbo].[JH_TblFurniture2Supplier].[supplier code] = [Denton_Multi].[dbo].[JH_TblFurniture5Grade].[supplier code] 
join [Denton_Multi].[dbo].[JH_TblFurniture3Range] ON [Denton_Multi].[dbo].[JH_TblFurniture3Range].[model code] = [Denton_Multi].[dbo].[JH_TblFurniture5Grade].[model code] 
join [Denton_Multi].[dbo].[JH_TblFurniture4Item] ON [Denton_Multi].[dbo].[JH_TblFurniture4Item].[item code]  = [Denton_Multi].[dbo].[JH_TblFurniture5Grade].[item code] 
where [Denton_Multi].[dbo].[JH_TblFurniture5Grade].[product group]=$cat AND 
[Denton_Multi].[dbo].[JH_TblFurniture2Supplier].[ID]=$cat2 AND 
[Denton_Multi].[dbo].[JH_TblFurniture3Range].[ID]=$cat3 AND 
[Denton_Multi].[dbo].[JH_TblFurniture4Item].[ID]=$cat4 AND
[Denton_Multi].[dbo].[JH_TblFurniture5Grade].[Delete]=0 
ORDER BY [description]"); 
}else{$quer5="SELECT DISTINCT subcat2 FROM subcategory2 order by subcat2"; } 


////////// end of query for Fifth subcategory drop down list box ///////////////////////////




/////// for Sixth drop down list we will check if sub category is selected else we will display all the subcategory3///// 
$cat5=$_GET['cat5']; // This line is added to take care if your global variable is off
if(isset($cat5) and strlen($cat5) > 0){
$quer6=mssql_query("SELECT DISTINCT [Denton_Multi].[dbo].[JH_TblFurniture6Colour].[description] ,[Denton_Multi].[dbo].[JH_TblFurniture6Colour].[ID]
FROM [Denton_Multi].[dbo].[JH_TblFurniture6Colour] 
join [Denton_Multi].[dbo].[JH_TblFurniture2Supplier] ON [Denton_Multi].[dbo].[JH_TblFurniture2Supplier].[supplier code] = [Denton_Multi].[dbo].[JH_TblFurniture6Colour].[supplier code] 
join [Denton_Multi].[dbo].[JH_TblFurniture3Range] ON [Denton_Multi].[dbo].[JH_TblFurniture3Range].[model code] = [Denton_Multi].[dbo].[JH_TblFurniture6Colour].[model code] 
join [Denton_Multi].[dbo].[JH_TblFurniture4Item] ON [Denton_Multi].[dbo].[JH_TblFurniture4Item].[item code]  = [Denton_Multi].[dbo].[JH_TblFurniture6Colour].[item code]
join [Denton_Multi].[dbo].[JH_TblFurniture5Grade] ON [Denton_Multi].[dbo].[JH_TblFurniture5Grade].[colour code]  = [Denton_Multi].[dbo].[JH_TblFurniture6Colour].[colour]
where 
[Denton_Multi].[dbo].[JH_TblFurniture6Colour].[product group]=$cat AND 
[Denton_Multi].[dbo].[JH_TblFurniture2Supplier].[ID]=$cat2 AND 
[Denton_Multi].[dbo].[JH_TblFurniture3Range].[ID]=$cat3 AND 
[Denton_Multi].[dbo].[JH_TblFurniture4Item].[ID]=$cat4 AND
[Denton_Multi].[dbo].[JH_TblFurniture5Grade].[ID]=$cat5 AND
[Denton_Multi].[dbo].[JH_TblFurniture6Colour].[Delete]=0 
ORDER BY [JH_TblFurniture6Colour].[description]"); 
}else{$quer6="SELECT DISTINCT subcat2 FROM subcategory2 order by subcat2"; } 
////////// end of query for Sixth subcategory drop down list box ///////////////////////////


$cat6=$_GET['cat6']; // This line is added to take care if your global variable is off




echo "<form method=post name=f1 action='customer.php'>";

//////////        Starting of first drop downlist /////////
echo "<select name='cat' onchange=\"reload(this.form)\"><option value=''>Select one</option>";
 
for ($i = 0; $i < mssql_num_rows($quer2); ++$i) {
	$proddesc = mssql_result($quer2,$i, 'product description');
	$prodid = mssql_result($quer2,$i, 'product code');
	
	if($prodid==@$cat)
		{echo "<option selected value='$prodid'>$proddesc</option>"."<BR>";}
	else{echo  "<option value='$prodid'>$proddesc</option>";}
}
echo "</select><br>";
//////////////////  This will end the first drop down list ///////////



//////////        Starting of second drop downlist /////////
echo "<select name='subcat' onchange=\"reload2(this.form)\"><option value=''>Select one</option>";

for ($i = 0; $i < mssql_num_rows($quer); ++$i) {
	$suppname= mssql_result($quer,$i, 'supplier name');
	$suppid = mssql_result($quer,$i, 'ID');
	
	if($suppid==@$cat2)
		{echo "<option selected value='$suppid'>$suppname</option>"."<BR>";}
	else{echo  "<option value='$suppid'>$suppname</option>";}
}

echo "</select>      Please be patient for large suppliers<br>";
//////////////////  This will end the second drop down list ///////////



//////////        Starting of third drop downlist /////////
echo "<select name='subcat2' onchange=\"reload3(this.form)\"><option value=''>Select one</option>";

for ($i = 0; $i < mssql_num_rows($quer3); ++$i) {
	$modeldesc= mssql_result($quer3,$i, 'model description');
	$modid = mssql_result($quer3,$i, 'ID');
	
	if($modid==@$cat3)
		{echo "<option selected value='$modid'>$modeldesc</option>"."<BR>";}
	else{echo  "<option value='$modid'>$modeldesc</option>";}
}

echo "</select><br>";
//////////////////  This will end the third drop down list ///////////


//////////        Starting of Forth drop downlist /////////
echo "<select name='subcat3' onchange=\"reload4(this.form)\"><option value=''>Select one</option>";

for ($i = 0; $i < mssql_num_rows($quer4); ++$i) {
	$itemdesc= mssql_result($quer4,$i, 'item description');
	$itemid = mssql_result($quer4,$i, 'ID');
	$itemcode = mssql_result($quer4,$i, 'item code');
	
	if($itemid==@$cat4)
		{echo "<option selected value='$itemid'>$itemcode | $itemdesc</option>"."<BR>";}
	else{echo  "<option value='$itemid'>$itemcode | $itemdesc</option>";}
}



echo "</select><br>";
//////////////////  This will end the Forth drop down list ///////////



//////////        Starting of Fifth drop downlist /////////
echo "<select name='subcat4' onchange=\"reload5(this.form)\"><option value=''>Select one</option>";

for ($i = 0; $i < mssql_num_rows($quer5); ++$i) {
	$gradedesc= mssql_result($quer5,$i, 'description');
	$gradeid = mssql_result($quer5,$i, 'ID');
	$gradecode = mssql_result($quer5,$i, 'colour code');
	
	if($gradeid==@$cat5)
		{echo "<option selected value='$gradeid'>$gradecode | $gradedesc</option>"."<BR>";}
	else{echo  "<option value='$gradeid'>$gradecode | $gradedesc</option>";}
}

echo "</select><br>";
//////////////////  This will end the Fifth drop down list ///////////

//////////        Starting of SIXTH drop downlist /////////
echo "<select name='subcat5' onchange=\"reload6(this.form)\"><option value=''>Select one</option>";

for ($i = 0; $i < mssql_num_rows($quer6); ++$i) {
	$colourdesc= mssql_result($quer6,$i, 'description');
	$colourid = mssql_result($quer6,$i, 'ID');
	
	if($colourid==@$cat6)
		{echo "<option selected value='$colourid'>$colourdesc</option>"."<BR>";}
	else{echo  "<option value='$colourid'>$colourdesc</option>";}
}

echo "</select><br>";
//////////////////  This will end the SIXTH drop down list ///////////

//////results query////////

//////  This will start the specialist where statements which only apply at each level of drop down ////////////
if (empty($cat6)) {}else{
$wherestats='[Denton_Multi].[dbo].[JH_TblFurniture6Colour].[product group]='.$cat.' AND 
[Denton_Multi].[dbo].[JH_TblFurniture2Supplier].[ID]='.$cat2.' AND 
[Denton_Multi].[dbo].[JH_TblFurniture3Range].[ID]='.$cat3.' AND 
[Denton_Multi].[dbo].[JH_TblFurniture4Item].[ID]='.$cat4.' AND
[Denton_Multi].[dbo].[JH_TblFurniture5Grade].[ID]='.$cat5.' AND
[Denton_Multi].[dbo].[JH_TblFurniture6Colour].[ID]='.$cat6.' AND';};

if (empty($cat6)) {$wherestats='[Denton_Multi].[dbo].[JH_TblFurniture6Colour].[product group]='.$cat.' AND 
[Denton_Multi].[dbo].[JH_TblFurniture2Supplier].[ID]='.$cat2.' AND 
[Denton_Multi].[dbo].[JH_TblFurniture3Range].[ID]='.$cat3.' AND 
[Denton_Multi].[dbo].[JH_TblFurniture4Item].[ID]='.$cat4.' AND
[Denton_Multi].[dbo].[JH_TblFurniture5Grade].[ID]='.$cat5.' AND';};

if (empty($cat5)) {$wherestats='[Denton_Multi].[dbo].[JH_TblFurniture6Colour].[product group]='.$cat.' AND 
[Denton_Multi].[dbo].[JH_TblFurniture2Supplier].[ID]='.$cat2.' AND 
[Denton_Multi].[dbo].[JH_TblFurniture3Range].[ID]='.$cat3.' AND 
[Denton_Multi].[dbo].[JH_TblFurniture4Item].[ID]='.$cat4.' AND';};

if (empty($cat4)) {$wherestats='[Denton_Multi].[dbo].[JH_TblFurniture6Colour].[product group]='.$cat.' AND 
[Denton_Multi].[dbo].[JH_TblFurniture2Supplier].[ID]='.$cat2.' AND 
[Denton_Multi].[dbo].[JH_TblFurniture3Range].[ID]='.$cat3.' AND ';};

if (empty($cat3)) {$wherestats='[Denton_Multi].[dbo].[JH_TblFurniture6Colour].[product group]='.$cat.' AND 
[Denton_Multi].[dbo].[JH_TblFurniture2Supplier].[ID]='.$cat2.' AND ';};

if (empty($cat2)) {$wherestats='15';};

if (empty($cat)) {$wherestats='14';};

//////  This will end the specialist where statements which only apply at each level of drop down ////////////
//// Main sql code is below ////////
$code1='SELECT  
[Denton_Multi].[dbo].[JH_TblFurniture1ProductGroup].[product description] ,
[Denton_Multi].[dbo].[suppliers].[supplier name],
[Denton_Multi].[dbo].[JH_TblFurniture3Range].[model description],
[Denton_Multi].[dbo].[JH_TblFurniture3Range].[deBranded],
[Denton_Multi].[dbo].[JH_TblFurniture3Range].[deBranded_Desc],
[Denton_Multi].[dbo].[JH_TblFurniture4Item].[item description],
[Denton_Multi].[dbo].[JH_TblFurniture4Item].[item code],
[Denton_Multi].[dbo].[JH_TblFurniture5Grade].[description] as description1,
[Denton_Multi].[dbo].[JH_TblFurniture5Grade].[colour code],
[Denton_Multi].[dbo].[JH_TblFurniture6Colour].[trim code],
[Denton_Multi].[dbo].[JH_TblFurniture6Colour].[description] as description2,
[Denton_Multi].[dbo].[JH_TblFurniture6Colour].[RRP],
[Denton_Multi].[dbo].[JH_TblFurniture6Colour].[Normal Price],
[Denton_Multi].[dbo].[JH_TblFurniture6Colour].[Sale Price],
[Denton_Multi].[dbo].[stores_tblFurniture6].[AvWhQty],
[Denton_Multi].[dbo].[stores_tblFurniture6].[AvShopQty],
[Denton_Multi].[dbo].[JH_TblFurniture6Colour].[AvBackQty],
[Denton_Multi].[dbo].[stores_tblFurniture6].[shopDisplay],
[Denton_Multi].[dbo].[JH_TblFurniture6Colour].[ID]
FROM [Denton_Multi].[dbo].[JH_TblFurniture6Colour]
join [Denton_Multi].[dbo].[JH_TblFurniture1ProductGroup] ON [Denton_Multi].[dbo].[JH_TblFurniture1ProductGroup].[product code] = [Denton_Multi].[dbo].[JH_TblFurniture6Colour].[product group] 
join [Denton_Multi].[dbo].[suppliers] ON [Denton_Multi].[dbo].[suppliers].[supplier code] = [JH_TblFurniture6Colour].[supplier code] 
join [Denton_Multi].[dbo].[JH_TblFurniture2Supplier] ON [Denton_Multi].[dbo].[JH_TblFurniture2Supplier].[supplier code] = [Denton_Multi].[dbo].[JH_TblFurniture6Colour].[supplier code] 
join [Denton_Multi].[dbo].[JH_TblFurniture3Range] ON [Denton_Multi].[dbo].[JH_TblFurniture3Range].[model code] = [Denton_Multi].[dbo].[JH_TblFurniture6Colour].[model code] 
join [Denton_Multi].[dbo].[JH_TblFurniture4Item] ON [Denton_Multi].[dbo].[JH_TblFurniture4Item].[item code]  = [Denton_Multi].[dbo].[JH_TblFurniture6Colour].[item code]
join [Denton_Multi].[dbo].[JH_TblFurniture5Grade] ON [Denton_Multi].[dbo].[JH_TblFurniture5Grade].[colour code]  = [Denton_Multi].[dbo].[JH_TblFurniture6Colour].[colour]
left join [Denton_Multi].[dbo].[stores_tblFurniture6] ON [Denton_Multi].[dbo].[stores_tblFurniture6].[ID]  = [Denton_Multi].[dbo].[JH_TblFurniture6Colour].[ID]
where';

$code2='
[Denton_Multi].[dbo].[JH_TblFurniture1ProductGroup].[product code]=[JH_TblFurniture6Colour].[product group] AND 
[Denton_Multi].[dbo].[JH_TblFurniture1ProductGroup].[product code]=[JH_TblFurniture5Grade].[product group] AND 
[Denton_Multi].[dbo].[JH_TblFurniture1ProductGroup].[product code]=[JH_TblFurniture4Item].[product group] AND 
[Denton_Multi].[dbo].[JH_TblFurniture1ProductGroup].[product code]=[JH_TblFurniture3Range].[product group] AND 
[Denton_Multi].[dbo].[JH_TblFurniture1ProductGroup].[product code]=[JH_TblFurniture2Supplier].[product group] AND 
[Denton_Multi].[dbo].[JH_TblFurniture2Supplier].[supplier code]= [JH_TblFurniture6Colour].[supplier code] AND 
[Denton_Multi].[dbo].[JH_TblFurniture2Supplier].[supplier code]= [JH_TblFurniture5Grade].[supplier code] AND 
[Denton_Multi].[dbo].[JH_TblFurniture2Supplier].[supplier code]= [JH_TblFurniture4Item].[supplier code] AND 
[Denton_Multi].[dbo].[JH_TblFurniture2Supplier].[supplier code]= [JH_TblFurniture3Range].[supplier code] AND 
[Denton_Multi].[dbo].[JH_TblFurniture3Range].[model code]=[JH_TblFurniture4Item].[model code] AND 
[Denton_Multi].[dbo].[JH_TblFurniture3Range].[model code]=[JH_TblFurniture5Grade].[model code] AND 
[Denton_Multi].[dbo].[JH_TblFurniture3Range].[model code]=[JH_TblFurniture6Colour].[model code] AND 
[Denton_Multi].[dbo].[JH_TblFurniture4Item].[item code]=[JH_TblFurniture5Grade].[item code] AND 
[Denton_Multi].[dbo].[JH_TblFurniture4Item].[item code]=[JH_TblFurniture6Colour].[item code] AND 
[Denton_Multi].[dbo].[JH_TblFurniture5Grade].[colour code]=[JH_TblFurniture6Colour].[colour] AND 

[Denton_Multi].[dbo].[JH_TblFurniture6Colour].[Delete]=0 AND
[Denton_Multi].[dbo].[JH_TblFurniture5Grade].[Delete]=0 AND
[Denton_Multi].[dbo].[JH_TblFurniture4Item].[Delete]=0 AND
[Denton_Multi].[dbo].[JH_TblFurniture3Range].[delete]=0 AND
[Denton_Multi].[dbo].[stores_tblFurniture6].[StoreID]=1 AND
[Denton_Multi].[dbo].[JH_TblFurniture2Supplier].[Delete]=0 


ORDER BY [JH_TblFurniture1ProductGroup].[product description],
[suppliers].[supplier name],
[JH_TblFurniture3Range].[model description],
[JH_TblFurniture4Item].[item description],
[JH_TblFurniture5Grade].[description],
[JH_TblFurniture6Colour].[description] ';

////////End of the main sql code //////////////////////////

$result=$code1.$wherestats.$code2;


//////// Run the statement against the database and populate a table to hold the data ///////////			

$resultquery=mssql_query($result);
echo "<input type=submit value='Customer Copy'>";
echo(mssql_num_rows($resultquery).' Results<br>');
echo'<table class="tablesorter">';
/////////////// Sets the header for the table with columns being searchable ////////////////////
echo('<thead><tr>
<th><center><b>Range</b><br><input name="inputrange"  class="search" placeholder="Range" data-column="0" type="search"></center></th>
<th><center><b>Code</b></center></th>
<th><center><b>Item</b><br><input name="inputitem"  class="search" placeholder="Item" data-column="2" type="search"></center></th>
<th><center><b>Code</b></center></th>
<th><center><b>Grade</b><br><input name="inputgrade"  class="search" placeholder="Grade" data-column="4" type="search"></center></th>
<th><center><b>Code</b><br><input name="inputcode"  class="search" placeholder="Code" data-column="5" type="search"></center></th>
<th><center><b>Colour</b><br><input name="inputcolour"  class="search" placeholder="Colour" data-column="6" type="search"></center></th>
<th><center><b>RRP</b></center></th>
<th><center><b>Normal</b></center></th>
<th><center><b>Sale</b></center></th>
<th><center><b>WH</b></center></th>
<th><center><b>Shop</b></center></th>
<th><center><b>BO</b></center></th>
<th><center><b>DO</b></center></th>
<th><center><b>ID</b></center></th>
</tr></b></thead>');

//////////////////assigns the results of the query to variables //////////////////////
echo'<tbody>';
for ($i = 0; $i < mssql_num_rows($resultquery); ++$i) {
	$productdescription = mssql_result($resultquery,$i, 'product description');
	$suppliername = mssql_result($resultquery,$i, 'supplier name');
	$modeldescription  = mssql_result($resultquery,$i, 'model description');
	$deBranded = mssql_result($resultquery,$i, 'deBranded');
	$deBrandedDesc = mssql_result($resultquery,$i, 'deBranded_Desc');
	$itemdescription = mssql_result($resultquery,$i, 'item description');
	$itemcode= mssql_result($resultquery,$i, 'item code');
	$description1 = mssql_result($resultquery,$i, 'description1');
	$colourcode = mssql_result($resultquery,$i, 'colour code');
	$trimcode = mssql_result($resultquery,$i, 'trim code');
	$description2 = mssql_result($resultquery,$i, 'description2');
	$RRP = mssql_result($resultquery,$i, 'RRP');
	$NormalPrice = mssql_result($resultquery,$i, 'Normal Price');
	$SalePrice = mssql_result($resultquery,$i, 'Sale Price');
	$AvWhQty = mssql_result($resultquery,$i, 'AvWhQty');
	$AvShopQty = mssql_result($resultquery,$i, 'AvShopQty');
	$AvBackQty = mssql_result($resultquery,$i, 'AvBackQty');
	$shopDisplay = mssql_result($resultquery,$i, 'shopDisplay');
	$ID = mssql_result($resultquery,$i, 'ID');
	
	if($deBranded==1){$range=$deBrandedDesc;}else{$range=$modeldescription;};

if ($cat < "10"){$zero='0';}else{$zero='';};


//////////////// puts the results from the query into the table ////////////////////////
echo('<tr>
<td>'.$range.'</td>
<td>'.$itemcode.'</td>
<td>'.$itemdescription.'</td>
<td>'.$colourcode.'</td>
<td>'.$description1. '</td>
<td>'.$trimcode. '</td>
<td>'.$description2. '</td>
<td>'.$RRP. '</td>
<td>'.$NormalPrice . '</td>
<td>'.$SalePrice . '</td>
<td>'.$AvWhQty . '</td>
<td>'.$AvShopQty . '</td>
<td>'.$AvBackQty . '</td>
<td>'.$shopDisplay . '</td>
<td>'.$zero.$cat.$ID. '</td>
</tr>');


}
echo'</tbody>';
echo'</table>';





echo "</form>";

?>
<br><br>

<script type="text/javascript">
	
$(function() {

  var $table = $('table').tablesorter({
    theme: 'blue',
    widgets: ["zebra", "filter"],
    widgetOptions : {
      // if true overrides default find rows behaviours and if any column matches query it returns that row
      // filter_anyMatch : true,
      filter_columnFilters: false,
      filter_reset: '.reset'
    }
  });

  // Target the $('.search') input using built in functioning
  // this binds to the search using "search" and "keyup"
  // Allows using filter_liveSearch or delayed search &
  // pressing escape to cancel the search
  $.tablesorter.filter.bindSearch( $table, $('.search') );

});


</script>

</body>

</html>








