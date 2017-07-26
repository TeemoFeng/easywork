<?php
//000000000000s:268:"SELECT t2.text as name,concat_ws('',( SELECT SUM(tt1.worktime) FROM dwin_worklog_table as tt1 WHERE ( tt1.task_id=t1.id )  )) as worktime FROM dwin_task_table as t1 LEFT JOIN  dwin_linkage as t2 on t2.id=t1.type WHERE ( t1.pro_id=4 ) GROUP BY t1.type ORDER BY t1.type ";
?>