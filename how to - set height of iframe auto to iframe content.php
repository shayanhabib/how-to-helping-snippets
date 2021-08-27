<?php //how to - set height of iframe auto to iframe content ?>


<iframe src="#" frameborder="0" allowfullscreen scrolling="auto" id="myIframe" style="overflow:hidden;height:100%;width:100%;" height="100%" width="100%"></iframe>


<script type="text/javascript">
var framefenster = document.getElementsByTagName("iframe");
var auto_resize_timer = window.setInterval("autoresize_frames()", 400);
function autoresize_frames() {
	for (var i = 0; i < framefenster.length; ++i) {
	   if(framefenster[i].contentWindow.document.body){
	     var framefenster_size = framefenster[i].contentWindow.document.body.offsetHeight;
	     if(document.all && !window.opera) {
	       framefenster_size = framefenster[i].contentWindow.document.body.scrollHeight;
	     }
	     framefenster[i].style.height = framefenster_size + 'px';
	   }
	}
}
</script>