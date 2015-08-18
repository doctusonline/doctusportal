<?php
function format_interval($datetime = "2015-04-21 8:00:00") {
    //$timezone = new DateTimeZone('Asia/Manila');
    $first_date = new \DateTime();
    $second_date = new \DateTime($datetime);
    //$first_date->setTimezone($timezone);
    $interval = $first_date->diff($second_date);
    $result = "";
    if ($interval->y) { $result .= $interval->format(($interval->y == 1) ? '%y year':'%y years'); }
    elseif ($interval->m) { $result .= $interval->format(($interval->m == 1) ? '%m month':'%m months'); }
    elseif ($interval->d) { $result .= $interval->format(($interval->d == 1) ? '%d day':'%d days'); }
    elseif ($interval->h) { $result .= $interval->format(($interval->h == 1) ? '%h hour':'%h hours'); }
    elseif ($interval->i) { $result .= $interval->format(($interval->i == 1) ? '%i minute':'%i minutes'); }
    elseif ($interval->s) { $result .= $interval->format(($interval->s == 1) ? '%s second':'%s seconds'); }

    return $result;
}


function get_avatar($userId){
    $filename = asset('/images/profile_pic/'.$userId.'.png');
    $file_headers = @get_headers($filename);
    if($file_headers[0] == 'HTTP/1.0 404 Not Found')
    {
        $filename = url('/images/profile_pic/person-icon.png'); 
    }
    return $filename;
}

?>