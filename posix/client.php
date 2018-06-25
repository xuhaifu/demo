<?php
/**
 * Created by client.php
 * Author: XHF
 * Date: 2018/6/25
 * Time: 10:57
 */

$host = "127.0.0.1";
$port = 8000;
$socket = @stream_socket_client("tcp://{$host}:{$port}", $errno, $errMsg);
if ($socket === false) {
    throw new \RuntimeException("unable to create socket: " . $errMsg);
}
stream_set_blocking($socket, false);

fwrite(STDOUT, "success connect to server: [{$host}:{$port}]...\n");

$pid = pcntl_fork();
switch ($pid) {
    case -1:
        fwrite(STDOUT, "fail to fork!\n");
        exit(1);
        break;

    // child
    case 0:
        while (true) {
            $read = [$socket];
            $write = null;
            $except = null;
            @stream_select($read, $write, $except, null);
            if (count($read)) {
                while (true) {
                    $msg = fread($socket, 4096);
                    if ($msg) {
                        fwrite(STDOUT, "receive server: $msg\n");
                    } else {
                        if (feof($socket)) {
                            fwrite(STDOUT, "server closed.\n");
                            posix_kill(posix_getppid(), SIGINT);
                            exit;
                        }
                        break;
                    }
                }
            }
        }
        exit;

    // parent
    default:
        while (true) {
            fwrite(STDOUT, "please enter the input:\n");
            $msg = trim(fgets(STDOUT));
            if ($msg) {
                $args = [$msg];
                $message = json_encode([
                    "method" => "echo",
                    "args" => $args,
                ]);

                fwrite($socket, $message);
            }
        }
}