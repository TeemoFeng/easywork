<?php
//000000000000s:214:"SELECT to_id as user_id FROM `dwin_task_table` WHERE ( `pro_id`=6 and `to_id`<>8 ) UNION ( SELECT from_id as user_id FROM `dwin_task_table` WHERE ( `pro_id`=6 and `from_id`<>8 ) GROUP BY from_id ORDER BY from_id  )";
?>