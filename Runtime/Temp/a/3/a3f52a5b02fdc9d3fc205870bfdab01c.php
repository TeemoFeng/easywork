<?php
//000000000000s:184:"SELECT count(tt5.id) as ing FROM dwin_task_table as tt5 WHERE ( tt5.id IN(( SELECT tt1.task_id as id FROM dwin_task_main_table as tt1 WHERE ( tt1.pro_id=t1.id )  )) and tt5.status>9 ) ";
?>