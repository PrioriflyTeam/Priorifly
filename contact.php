<?php
	include 'top_boilerplate.html';
?>

<div data-role="page" class="contact_page">

	<?php
		include 'header.html';
	?>
	
	<div data-role="content">
		<div class="text_content">
			<p>This is how you contact us.</p>
		</div>
	</div><! -- /content -->
	
	
	<script type="text/javascript">		
		$('.contact_page').live('pagebeforeshow',function(event, ui){
			$('body').css('background-color', 'white');
			$('body').css('background-image', 'none');
			$('#header_text').text('Contact Us');
			$('.notifications_link').remove();
		});
	</script>

	
	
</div> <!-- /tasks home -->

<?php
	include 'bottom_boilerplate.html';
?>