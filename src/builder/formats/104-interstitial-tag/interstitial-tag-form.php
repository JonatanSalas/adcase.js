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
    <p class="h5 left" style='margin-top:14px'>#104 - Interstitial - External Tag</p>
</div></div>

<div class="row">
<div class='col-lg-6 col-md-6'>
<form id=builderForm enctype="multipart/form-data" onsubmit="return false">
<br>

	<table>
		<input type="hidden" name="format" value='interstitial-tag'>


	<tr><td>HTML tag:</td></tr>
	<tr><td colspan=2><textarea name='html_tag' style='height:300px'>
<center>
This is an example.

The creative should not have a close button.
</center>
</textarea></td></tr>

		<tr><td>Size:</td>
			<td><select type="text" id='interstitial_size' name="size" class="form-control">
				<option value='800x600'>800x600 (desktop)</option>
				<option value='1040x480'>1040x480</option>
				<option value='1000x540'>1000x540</option>
				<option value='300x416'>300x416 (mobile)</option>
				<option value='320x480'>320x480</option>
				<option value='518x690'>518x690 (tablet)</option>
				<!--<option value='fullscreen'>Fullscreen</option>-->
			    </select> 
			</td></tr>

		<tr><td>Clicktag URL:</td>
			<td><input type="text" value='www.google.com' name='clicktag_url'></td></tr>

  	    <tr><td>Autoclose timeout:</td>
			<td><input type="text" value='8' name='autoclose'></td></tr>

  	    <tr><td>Background Color:</td>
			<td><input type="text" value='white' name='bgcolor'></td></tr>

	</table>

    <div class="text-center">
        <button onclick='w.builder.submit()' class="btn btn-primary">Upload and generate creative</button>
        <div id='downloadButton'></div>
    </div>

</form>
</div>
</div><!-- mainPage -->


</div>
</main>