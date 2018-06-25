<?php
/**
 * Created by fork-signal.php
 * Author: XHF
 * Date: 2018/6/25
 * Time: 10:56
 */
pcntl_async_signals(true);

pcntl_signal(SIGCLD, function () {
    $pid = pcntl_wait($status, WUNTRACED);
    fwrite(STDOUT, "child: $pid exited\n");
});

$pid = pcntl_fork();
if ($pid === 0) {
    fwrite(STDOUT, "child exit\n");
} else {
    // mock busy work
    sleep(1);
}