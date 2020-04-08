<?php //how to - close sidenav on clicking beside to it ?>
<script>
jQuery(document).mouseup(function(e) {
    var container = jQuery(".sidenav.toggle");
    if (!container.is(e.target) && container.has(e.target).length === 0) {
        container.removeClass("toggle"); 
        jQuery(".opensidemenu").removeClass("change");
    }
});
</script>