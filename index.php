<!DOCTYPE html>
<html><head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<?php
$cmdArr=array(
		"phpinfo"=>array("title"=>"PHP Info","cmdtype"=>"eval","data"=>"phpinfo();"),
		"showini"=>array("title"=>"Show PHP INI","cmdtype"=>"eval","data"=>"printArray(ini_get_all());"),
		"server"=>array("title"=>"Show Server INFO","cmdtype"=>"eval","data"=>'printServerInfo();'),
		"testmail"=>array("title"=>"Mail Testing","cmdtype"=>"eval","data"=>"testMail();"),
	);

if(isset($_POST['cmd']) && array_key_exists($_POST['cmd'],$cmdArr)) {
	$cmd=$cmdArr[$_POST['cmd']];
	
	echo "<title>CMD :: {$cmd['title']}</title>";
	echo "</head><body>";
	if($cmd['cmdtype']=="eval" && strlen($cmd['data'])>0) eval($cmd['data']);
} else {
	echo "<title>Server Command Center</title>";
	echo "</head><body>";
	?>
	<style>
	html,body {
		background:black;
		color:green;
		font-family:monospace;
	}
	input,select {
		width:100%;height:23px;
		border:1px solid #aaa;
	}
	button {
		width:100px;height:26px;
		font-weight:bold;
	}
	</style>
	<?php
	if(isset($_REQUEST['cmd']) && !array_key_exists($_REQUEST['cmd'],$cmdArr)) {
		echo "<h3 align=center style='color:red;'>`<i>{$_REQUEST['cmd']}</i>' Is Not Command.</h3>";
	}
	?>
	<form method=POST action='<?=basename(__FILE__)?>' enctype='multipart/form-dat'>
		<table width=500px style='margin:auto;border:1px solid #AAA;padding:0px;font-size:15px;' cellspacing=0 cellpadding=2>
			<tr><th colspan=10 align=center style='font-family:arial;'>
				<h3>Script Command Center<hr/></h3>
				
			</th></tr>
			<tr>
				<th align=left>CMD</th>
				<td><input id=frmCmd name=cmd value='' /></td>
				<td><select onchange="document.getElementById('frmCmd').value=this.value;this.value='';">
					<option value=''>Select CMD</option>
					<?php
						foreach($cmdArr as $a=>$b) {
							echo "<option value='$a'>{$b['title']}</option>";
						}
					?>
				</select></td>
			</tr>
			
			<tr><td colspan=10 align=center>
				<br/><hr/>
				<button type='reset'>Reset</button>
				<button type='submit'>Submit</button>
				<button type='button' onclick='document.location.reload();'>Reload</button>
				<br/><br/>
			</td></tr>
		</table>
	</form>
	<?
}
function printArray($arr) {
	echo "<pre>";
	if(is_array($arr)) {
		print_r($arr);
	} elseif(is_object($arr)) {
		var_dump($arr);
	} else {
		echo $arr;
	}
	echo "</pre>";
}
function printServerInfo() {
	printArray($_SERVER);
}
function testMail() {
	if(mail('bismay4u@gmail.com','Test Mail '.date('Y/m/d H:i:s'),'Benchmarking Mail'))
		echo "Mail Sent Successfully";
	else echo "Mail Sent Failed";
}
?>
</body>
</html>
