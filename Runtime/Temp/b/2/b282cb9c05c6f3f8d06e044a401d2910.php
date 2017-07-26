<?php
//000000000000s:188:"SELECT count(tt4.id) as comple FROM dwin_task_table as tt4 WHERE ( tt4.id IN(( SELECT tt1.task_id as id FROM dwin_task_main_table as tt1 WHERE ( tt1.pro_id=t1.id )  )) and tt4.status=51 ) ";
?>