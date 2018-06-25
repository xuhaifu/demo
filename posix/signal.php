<?php
/**
 * Created by signal.php
 * Author: XHF
 * Date: 2018/6/25
 * Time: 10:53
 */
pcntl_signal(SIGINT, function () {
    fwrite(STDOUT, "receive signal: SIGINT, do nothing...\n");
});

while (true) {
    pcntl_signal_dispatch();
    sleep(1);
}