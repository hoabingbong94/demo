<?php

foreach ($data as $k => $v) {
    $homeName = $v->HomeName;
    $awayName = $v->AwayName;
    $time = date("d-m-Y H:i:s", strtotime($v->StartTime));
    $matchId=$v->MatchID;
    $matchState=$v->MatchState;
    echo "<li id='info$matchId' onClick='selectMatch($matchId)' data-info='$homeName vs $awayName'>"
    . "<span class='time'>$time</span>"
    . "<span class='match'>$homeName vs $awayName</span>"
    . "</li>";
}