<!-- A simple form for testing bulletproof image upload -->
<h2> Image Upload: </h2>
<form method="POST" enctype="multipart/form-data">
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
    <br/>
    <input type="hidden" name="MAX_FILE_SIZE" value="6000000" />
    <label for="watermarked">Image to be Watermarked:
    <input type="file" id="watermarked" name="watermarked" />
    </label>
    <br/>
    <input type="hidden" name="MAX_FILE_SIZE" value="6000000" />
    <label for="original">Image Original:
    <input type="file" id="original" name="original" />
    </label>
    <br/>
    <input type="submit" name="upload" value="upload" />
</form>
