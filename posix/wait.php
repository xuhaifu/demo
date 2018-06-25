<?php
/**
 * Created by wait.php
 * Author: XHF
 * Date: 2018/6/25
 * Time: 10:46
 */
$pid = pcntl_fork();
if ($pid === 0) {
    $myid = posix_getpid();
    fwrite(STDOUT, "child $myid exited\n");
} else {
    sleep(5);
    $status = 0;
    $pid = pcntl_wait($status, WUNTRACED);
    if ($pid > 0) {
        fwrite(STDOUT, "child: $pid exited\n");
    }

    sleep(5);
    fwrite(STDOUT, "parent exit\n");
}