function switchState()
{
	setTimeout(function(){
		var exdate=new Date();
		exdate.setDate(exdate.getDate()+365);
		document.cookie='iPhone'+ "=" +escape(window.location.hash.replace('#switch-', ''))+
		(";expires="+exdate.toGMTString());
		window.location.reload();
	}, 100);
	return;
}