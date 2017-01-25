<?php
/*
   Criado Por Pablo Santhus
   Data: 25/01/2017
   https://www.facebook.com/pablosanthus
   @pablo_santhus
   https://www.youtube.com/0xsec
*/

	error_reporting(0);


if(isset($argv[2])){
echo "
______          _     _____                 
| ___ \        | |   /  ___|                
| |_/ /__  _ __| |_  \ `--.  ___ __ _ _ __  
|  __/ _ \| '__| __|  `--. \/ __/ _` | '_ \ 
| | | (_) | |  | |_  /\__/ / (_| (_| | | | |
\_|  \___/|_|   \__| \____/ \___\__,_|_| |_|
                                            
                           Criado by Pablo Santhus
\n\n";
}
if(!isset($argv[2])){
echo "
______          _     _____                 
| ___ \        | |   /  ___|                
| |_/ /__  _ __| |_  \ `--.  ___ __ _ _ __  
|  __/ _ \| '__| __|  `--. \/ __/ _` | '_ \ 
| | | (_) | |  | |_  /\__/ / (_| (_| | | | |
\_|  \___/|_|   \__| \____/ \___\__,_|_| |_|
                                            
                           Criado by Pablo Santhus

  [+] Autor: Pablo Santhus
  [+] Github: 
  [+] Help: $argv[0] -h
\n\n";
}

if($argv[1] == "-t" or $argv[2] == "-t"){
	if(isset($argv[3])){
		$ip = $argv[3];
	}else{
		$ip = $argv[2];
	}
	$portinicial 	= 1;
	$portafinal 	= 65536;
	$scan = 0;
	sleep(3);
	date_default_timezone_set("America/Sao_Paulo");
	$hora = date("h:i:s", time());
	echo "[$hora] Iniciando Verificacao ...\n\n";
	for($p = $portinicial; $p <= $portafinal; $p++){
		$scan = 1;
		$ock = fsockopen($ip, $p, $errnum,$errstr, 1);
		$fp = fopen("portscan.txt", "a");
		
			if($ock){
				$serv1 = getservbyport($p, "tcp");
				$serv2 = getservbyport($p, "udp");
$write = "
Porta                      Host               Servico
{$p} esta Aberta          {$ip}         {$serv1}{$serv2}\n";
				fwrite($fp, $write);
			}
			if($argv[1] == "-v" or $argv[2] == "-v"){
				if($ock){
					echo "[$hora][+] Porta {$p} esta Aberta {$ip} \n";
				}else{
					echo "[$hora][-] Porta {$p} esta Fechada {$ip} \n";
				}
			}
		}
		sleep(2);
		echo "\n\n[$hora] Portas Encontradas . . .\n";
		$file = file_get_contents("portscan.txt");
		echo $file;
		$limp = fopen("portscan.txt", "w");
		fwrite($limp, "");
		fclose($fp);
	}

if($argv[1] == "-p" or $argv[2] == "-p"){
	if(isset($argv[3])){
		$ip = $argv[3];
	}else{
		$ip = $argv[2];
	}
	date_default_timezone_set("America/Sao_Paulo");
	$hora = date("h:i:s", time());
	echo "[$hora] Host {$ip} \n";
	sleep(2);
	echo "[$hora] Iniciando Verificacao ...\n\n";
	$ports = array(21, 22, 23, 25, 53, 63, 66, 67, 69, 80, 110, 123, 135, 139, 143, 156, 161, 179, 554, 902, 912, 2869, 5357, 389, 443, 445, 587, 1433, 1723, 1863, 3128, 3306,3389);
	$result_port = array();
	foreach($ports as $port){
		if($p = fsockopen($ip, $port, $errnum, $errstr, 1)){
			$result_port[$port] = true;
		}else{
			$result_port[$port] = false;
		}
	}
	$fp = fopen("portscan.txt", "a");
	foreach($result_port as $port => $resul){
		if($resul){
				$serv1 = getservbyport($port, "tcp");
				$serv2 = getservbyport($port, "udp");

$write = "
PORTA                       HOST                  SERVICO
{$port} esta Aberta         {$ip}           {$serv1} {$serv2} \n";
				fwrite($fp, $write);
		}
		if($argv[1] == "-v" or $argv[2] == "-v"){
			if($resul){
				echo "[$hora][+] Porta {$port} esta Aberta {$ip} \n";
			}else{
				echo "[$hora][-] Porta {$port} esta Fechada {$ip} \n";
			}
		}
	}

		sleep(2);
		echo "\n\n[$hora] Portas Encontradas . . .\n";
		
		$file = file_get_contents("portscan.txt");
		echo $file;
		$limp = fopen("portscan.txt", "w");
		fwrite($limp, "");
		fclose($fp);

}

if($argv[1] == "-l"){
	date_default_timezone_set("America/Sao_Paulo");
	$hora = date("h:i:s", time());

	echo "

[$hora] Lista de Principais Portas e Seus Servicos\n
[$hora] TCP / UDP

+-----------------------------+
+ PORTA | PROTOCOLO | SERVICO +
+-----------------------------+
+ 21    |   TCP     |  FTP    +
+-----------------------------+
+ 22    |   TCP     |  SSH    +
+-----------------------------+
+ 23    |   TCP     |  TELNET +
+-----------------------------+
+ 25    |   TCP     |  SMTP   +
+-----------------------------+
+ 53    |   UDP     |  DNS    +
+-----------------------------+
+ 69    |   UDP     |  TFTP   +
+-----------------------------+
+ 80    |   TCP     |  HTTP   +
+-----------------------------+
+ 110   |   TCP     |  POP3   +
+-----------------------------+
+ 123   |   UDP     |  NTP    +
+-----------------------------+ 
+ 143   |   TCP     |  IMAP   +
+-----------------------------+ 
+ 389   |   TCP     |  LDAP   +
+-----------------------------+
+ 443   |   TCP     |  HTTPS  +
+-----------------------------+
+ 587   |   TCP     |  SMTP   +
+-----------------------------+
";}

if($argv[1] == "-h" or $argv[1] == "-help"){
	echo "

Use: $argv[0] [opcoes] [target]

Opcoes:
   -h, -help                   Mostra um painel de ajuda
   -v VERBOSE                  Mostra todos os passos do scan
   -t                          Faz scan em todas as portas(65536)
   -p                          Faz scan nas principais portas
   -l                          Lista as principais portas seus protocolos e servicos

   Ex: 
      $argv[0] -t 127.0.0.1
      $argv[0] -t -v 127.0.0.1
      $argv[0] -p 127.0.0.1
      $argv[0] -p -v 127.0.0.1

";
}

?>
