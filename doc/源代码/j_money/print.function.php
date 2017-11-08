<?php

function print_fun(){
	global $_W;
	switch($printType){
		case "":
			$PRINTER_SN=$parama['printer_sn'];
			$KEY=$parama['key'];
			$IP=$parama['ip'];
			$PORT=$parama['port'];
			$HOSTNAME="/FeieServer";
		break;
	}
}
?>