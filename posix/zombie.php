<?php
/**
 * Created by zombie.php
 * Author: XHF
 * Date: 2018/6/25
 * Time: 10:44
 */
foreach (range(1, 10) as $i) {
    $pid = pcntl_fork();
    if ($pid === 0) {
        fwrite(STDOUT, "child exit\n");
        exit;
    }
}
sleep(200);
exit;