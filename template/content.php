<div class="ad_links"><?php ad_link(); ?></div>
<div id="content">
    Dev site is still under development.

<pre>
<?php
/**
 * @var TimingsMaster $timingsData
 */
$timingsData = TimingsMaster::getInstance();
$totalTime = 0;
$totalTimings = 0;
foreach ($timingsData->data as $data) {
    $totalTime += $data->totalTime;
    foreach ($data->handlers as $handler) {
        $totalTimings += $handler->count;
    }
}
$cost = $timingsData->system->timingcost;
echo "totalTime: $totalTime - Timings cost: $cost - " . ($cost * $totalTimings) . " - Pct: "
    . (($cost * $totalTimings) / ($timingsData->sampletime * 1000000000)) * 100;

echo "<br />\n\n";
foreach ($timingsData->data as $handlers) {
    $lag = array_filter($handlers->handlers, function ($e) {

        return $e->lagTotal > 10;
    });
    usort($lag, function ($a, $b) {
        return $a->lagTotal > $b->lagTotal ? -1 : 1;
    });
    if (!empty($lag))print_r($lag);
}

?>
</pre>
</div>

<hr/>
<div class="ad_links"><?php ad_link(); ?></div>
