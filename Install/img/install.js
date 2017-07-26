// JavaScript Document
function toInstall(val,act){
	var url = 'http://'+window.location.host;
	$.getJSON("http://server.piocms.com/dwuss/index.php/Admin/project/install?callback=?",{mode: 'EasyWork',domain: url,mail: val ,key:'e1a111321d2cc0c2ba779e7ccd43994d', version:'1.0.9'}, function(data){
		$.post('inc/putdata.act.php',{act:'put',serial:data.serial});
	});
}