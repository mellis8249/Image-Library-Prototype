<!--Used with Pure CSS for forms/buttons-->
<style>
form {
    display:inline;
}
 .button-upload,
        .button-secondary {
            color: white;
            text-shadow: 0 0px 0px rgba(0, 0, 0, 0.2);
        }

        .button-upload {
            background: #23353e; /* this is a green */
        }

        .test {
            color:red;
            display:inline;
        }


</style>
<!-- A simple form for testing bulletproof image upload -->
<h2> Image Upload: </h2>
<form class="pure-form" method="POST" enctype="multipart/form-data">
    <fieldset>
	<label for="ImageName">Image Name: 
    <input type="text" id="ImageName" name="ImageName"/>
    </label>
    <label for="ImageDescription">Image Description: 
    <input type="text" id="ImageDescription" name="ImageDescription"/>
    </label>
    <label for="category">Category: 
    <input type="text" id="category" name="category"/>
    </label>
    <input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
    <label for="thumbnail">Image to be used as Thumbnail:
    <input type="file" id="thumbnail" name="thumbnail" />
    </label>
    <input type="hidden" name="MAX_FILE_SIZE" value="6000000" />
    <label for="watermarked">Image to be Watermarked:
    <input type="file" id="watermarked" name="watermarked" />
    </label>
    <input type="hidden" name="MAX_FILE_SIZE" value="6000000" />
    <label for="original">Image Original:
    <input type="file" id="original" name="original" />
    </label>
    <br/>
    <button id="button-upload" type="submit" name="upload" value="Upload" class="button-upload pure-button">Upload</button>
</fieldset>
</form>