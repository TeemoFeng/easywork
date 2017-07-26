<?php
//000000000000s:168:"SELECT SUM(worktime) as total FROM `dwin_worklog_table` WHERE ( id in (( SELECT worklog_id as id FROM `dwin_worklog_main_table` WHERE ( `task_id` = 10 )  )) ) LIMIT 1  ";
?>