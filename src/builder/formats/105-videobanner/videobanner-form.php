<!-- Contact form -->
<style>
td {height:50px;}
table { width:90%;}
.site-content {background-image:url(img/blue-bg.jpg);width:100%;
		height:200px;padding-top:90px;font-size:20px }
</style>
<main>
<div class="container">

<div class="row mt-5">
<div class='col-lg-12 col-md-12'>
    <p class="h5 left" style='margin-top:14px'>#105 - MP4 Video Banner</p>
</div></div>

<div class="row">
<div class='col-lg-6 col-md-6'>
<form id=builderForm enctype="multipart/form-data" onsubmit="return false">
<br>

	<table>
		<input type="hidden" name="format" value='videobanner'>

		<tr><td>Size:</td>
			<td><select type="text" id='size' name="size" class="form-control">
				<option value='300x250'>300x250</option>
				<option value='300x600'>300x600</option>
				<option value='920x250'>920x250</option>
				<option value='950x200'>950x200</option>
				<option value='950x300'>950x300</option>
				<option value='360x300'>360x300</option>
				<option value='360x100'>360x100</option>
				<option value='360x50'>360x50</option>
				<option value='300x450'>300x450</option>
				<option value='640x360'>640x360</option>
				<option value='300x162'>300x162</option>
				<!--<option value='fullscreen'>Fullscreen</option>-->
			    </select> 
			</td></tr>

<!--
		<tr><td>Collapsed Size:</td>
			<td><select type="text" name="collapsed_size" class="form-control">
				<option>970x90</option></select>
			</td></tr>

		<tr><td>Expanded Size:</td>
			<td><select type="text" name="expanded_size" class="form-control">
				<option>970x250</option></select>
			</td></tr>
-->		
		<tr><td>MP4 Video file</td>
			<td><input type="file" name='videofile'></td></tr>
<!--
		<tr><td>Background image:</td>
			<td><input type="file" name='backgroundimage'></td></tr>
-->
<!--
		<tr><td>Expand button text or base64 image:</td>
			<td><input type="text" value='Abrir' name='expand_button'></td></tr>

		<tr><td>Collapse button text or base64 image:</td>
			<td><input type="text" value='Cerrar' name='collapse_button'></td></tr>
-->
		<input name='clicktag_layer' type="hidden" value="1">

		<tr><td>Clicktag URL:</td>
			<td><input type="text" value='www.google.com' name='clicktag_url'></td></tr>

<!--		<tr><td>Background Color:</td>
			<td><input type="text" value='white'></td></tr>
-->

	</table>

    <div class="text-center">
        <button onclick='w.builder.submit()' class="btn btn-primary">Upload and generate Creative</button>
         <div id='downloadButton'></div>
    </div>

</form>
</div>
</div><!-- mainPage -->


</div>
</main>