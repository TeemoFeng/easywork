<?php
//000000000000s:183:"SELECT * FROM `dwin_worklog_table` WHERE ( id in (( SELECT worklog_id as id FROM `dwin_worklog_main_table` WHERE ( `task_id` = 10 )  )) and YEAR(addtime)=2017 and MONTH(addtime)=07 ) ";
?>