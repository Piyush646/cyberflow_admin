 
<?php
if(isset($_COOKIE['themeMode']))
{
	$dark="";
	$light="";
	switch($_COOKIE['themeMode'])
	{
		case 'darkmode':
			$dark="checked";
			?>
				<script>
					$(function()
					{

						$("html").addClass("dark-theme");	
					})
					
 
				</script>
			<?php
			break;
		case 'lightmode':
			$light="checked";
			break;
	}
}


if(isset($_COOKIE['darksidebar']))
{
	$darkDS="";
	
	switch($_COOKIE['darksidebar'])
	{
		case 'yes':
			$darkDS="checked";
			?>
				<script>
					$(function()
					{

						$("html").addClass("dark-sidebar");	
					})
					
 
				</script>
			<?php
			break;
			case 'no':
				
				$darkDS="unchecked";
			?>
				<script>
					$(function()
					{

						$("html").removeClass("dark-sidebar");	
					})
					
 
				</script>
			<?php
				
				break;
	}
}
if(isset($_COOKIE['ColorLessIcons']))
{
	
	$colorless="";
	switch($_COOKIE['ColorLessIcons'])
	{
		case 'yes':
			$colorless="checked";
			?>
				<script>
					$(function()
					{

						$("html").addClass("ColorLessIcons");	
					})
					
 
				</script>
			<?php
			break;
				case 'no':
					
					$colorless="unchecked";
			?>
				<script>
					$(function()
					{

						$("html").removeClass("ColorLessIcons");	
					})
					
 
				</script>
			<?php
					break;
	}
}
?>
<div class="footer">
			<p class="mb-0">Cyberflow @2021 | Developed By : <a style="color:#1fcecb;"href="https://cyberflow.in" target="_blank">cyberflow</a>
			</p>
		</div>
        <div class="switcher-wrapper">
		<div style="background-color:#1fcecb;" class="switcher-btn"> <i style="color:none;"class='bx bx-cog bx-spin'></i>
		</div>
		<div class="switcher-body">
			<h5 class="mb-0 text-uppercase">Theme Customizer</h5>
			<hr/>
			<h6 class="mb-0">Theme Styles</h6>
			<hr/>
			<div class="d-flex align-items-center justify-content-between">
				<div class="custom-control custom-radio">
					<input type="radio" id="darkmode" name="customRadio" <?=$dark?>  class="custom-control-input">
					<label class="custom-control-label" for="darkmode">Dark Mode</label>
				</div>
				<div class="custom-control custom-radio">
					<input type="radio" id="lightmode" name="customRadio" <?=$light?> class="custom-control-input">
					<label class="custom-control-label" for="lightmode">Light Mode</label>
				</div>
			</div>
			<hr/>
			<div class="custom-control custom-switch">
				<input type="checkbox" class="custom-control-input" id="DarkSidebar" <?=$darkDS?>>
				<label class="custom-control-label" for="DarkSidebar">Dark Sidebar</label>
			</div>
			<hr/>
			<div class="custom-control custom-switch">
				<input type="checkbox" class="custom-control-input" id="ColorLessIcons"<?=$colorless?>>
				<label class="custom-control-label" for="ColorLessIcons">Color Less Icons</label>
			</div>
		</div>
	</div>
	 
