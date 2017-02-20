<?php
function getSundays($y, $m)
{
    return new DatePeriod(
        new DateTime("first Sunday of $y-$m"),
        DateInterval::createFromDateString('next Sunday'),
        new DateTime("next month $y-$m-01")
    );
}
foreach (getSundays(2017, 1) as $Sunday) {
    $result = $Sunday -> format("jS F, Y");
    echo $result . '<br>';
}
?>