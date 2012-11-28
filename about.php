<?php
	include 'top_boilerplate.html';
?>

<div data-role="page" class="about_page">

	<?php
		include 'header.html';
	?>
	
	<div data-role="content">
		<div style="text-align:center">
			<iframe width="280" height="157.5" src="http://www.youtube.com/embed/54zpFh0KuK0" frameborder="0" allowfullscreen></iframe>
		</div>
		<div class="text_content">
			<p>This is a paragraph.  This is a paragraph.  This is a paragraph.</p>
			<p>This is another paragraph.  This is another paragraph.  This is another paragraph.  </p>
		</div>
	</div><! -- /content -->
	
	
	<script type="text/javascript">		
		$('.about_page').live('pagebeforeshow',function(event, ui){
			$('body').css('background-color', 'white');
			$('body').css('background-image', 'none');
			$('#header_text').text('About Us');
			$('.notifications_link').remove();
		});
	</script>

	
	
</div> <!-- /tasks home -->

<?php
	include 'bottom_boilerplate.html';
?>