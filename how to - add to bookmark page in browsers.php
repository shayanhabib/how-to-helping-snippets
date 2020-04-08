<script>
	jQuery(function() {
	  jQuery('#bookmarkme').click(function() {
	    if (window.sidebar && window.sidebar.addPanel) { // Mozilla Firefox Bookmark
	      window.sidebar.addPanel(document.title, window.location.href, '');
	    } else if (window.external && ('AddFavorite' in window.external)) { // IE Favorite
	      window.external.AddFavorite(location.href, document.title);
	    } else if (window.opera && window.print) { // Opera Hotlist
	      this.title = document.title;
	      return true;
	    } else { // webkit - safari/chrome
	      alert('Press ' + (navigator.userAgent.toLowerCase().indexOf('mac') != -1 ? 'Command/Cmd' : 'CTRL') + ' + D to bookmark this page.');
	    }
	  });
	});
</script>
<a id="bookmarkme" href="<?php the_permalink(); ?>" rel="sidebar" title="<?php the_title(); ?>" style="display: inline-block;margin-bottom: 20px;background: #e0b852;color: #111;padding: 4px 10px;font-size: 14px;border-radius: 5px;position: relative;">Add to Bookmark</a>