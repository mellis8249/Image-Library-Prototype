<!--Includes the below in the file it's required in-->
<h2> Instructions: </h2>
<p> 
This Image Upload form uploads three images to a database, one is used as a thumbnail, 
one is watermarked and one is stored as the original and have to be both the same image.
</p>
<p>
It uses two layers of validation,
one being the bulletproof class created by Bivoc (2014) it can be found here:
<a href="https://github.com/bivoc/bulletproof" >Bulletproof.</a>
</p>

<p>
It also uses a PDO connection to a MySQLi database.
</p>
<p>
Thumbnail: Accepts JPG and GIF Image files with a maximium height and width of 1200x1200 pixels and size of 2MB.
</p>
<p>
Watermarked: Accepts the PNG Image file format with a maximium height and width of 3000x3000 pixels and size of 6MB.
</p>
<p>
Original: Accepts PNG Image file format with a maximium height and width of 3000x3000 pixels and size of 6MB.
</p>