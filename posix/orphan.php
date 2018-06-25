<?php
/**
 * Created by orphan.php
 * Author: XHF
 * Date: 2018/6/25
 * Time: 10:42
 */

$pid = pcntl_fork();
if ($pid === 0) {
    $myid = posix_getpid();
    $parentId = posix_getppid();
    fwrite(STDOUT, "my pid: $myid, parentId: $parentId\n");
    sleep(5);
    $myid = posix_getpid();
    $parentId = posix_getppid();
    fwrite(STDOUT, "my pid: $myid, parentId: $parentId\n");
} else {
    fwrite(STDOUT, "parent exit\n");
}