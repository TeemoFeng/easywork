<?php
//000000000000s:164:"SELECT SUM(worktime) as total FROM `dwin_worklog_table` WHERE ( id in (( SELECT worklog_id as id FROM `dwin_worklog_main_table` WHERE ( `pro_id`=8 )  )) ) LIMIT 1  ";
?>