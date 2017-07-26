<?php
//000000000000s:165:"SELECT MIN(tt2.startdate) FROM dwin_task_table as tt2 WHERE ( tt2.id IN(( SELECT tt1.task_id as id FROM dwin_task_main_table as tt1 WHERE ( tt1.pro_id=t1.id )  )) ) ";
?>