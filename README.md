jsqrcode-html5
==============
Take an image of a QR Code (using HTML5) with your tablet/smartphone, upload it to your server, and then decode it using only JavaScript.


Dependencies
---
  * [megapix] - Fixes iOS subsampling error
  * [jsqrcode] - The JavaScript QR Code reader


Demo
---
  * *Coming soon* - Implemented with [Twitter Bootstrap] and [Jasny Bootstrap]'s fileinput.

Usage
---
**Include the JavaScript:**
``` JavaScript
<!-- jquery -->
<script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>

<!-- megapix -->
<script type="text/javascript" src="js/megapix-image.min.js"></script>

<!-- jsqrcode: must be in this order! -->
<script type="text/javascript" src="grid.js"></script>
<script type="text/javascript" src="version.js"></script>
<script type="text/javascript" src="detector.js"></script>
<script type="text/javascript" src="formatinf.js"></script>
<script type="text/javascript" src="errorlevel.js"></script>
<script type="text/javascript" src="bitmat.js"></script>
<script type="text/javascript" src="datablock.js"></script>
<script type="text/javascript" src="bmparser.js"></script>
<script type="text/javascript" src="datamask.js"></script>
<script type="text/javascript" src="rsdecoder.js"></script>
<script type="text/javascript" src="gf256poly.js"></script>
<script type="text/javascript" src="gf256.js"></script>
<script type="text/javascript" src="decoder.js"></script>
<script type="text/javascript" src="qrcode.js"></script>
<script type="text/javascript" src="findpat.js"></script>
<script type="text/javascript" src="alignpat.js"></script>
<script type="text/javascript" src="databr.js"></script>

<script type="text/javascript">
  $(function() {
  	qrcode.callback = showData;
  	
  	$('#uploadImgBtn').click(function() {
  		var mpImg = new MegaPixImage($('#imageFile')[0].files[0]);
  		var resImg = document.getElementById('qrcode');
  		mpImg.render(resImg, { maxWidth: 250, maxHeight: 250, quality: 0.92 });
  		
  		//Wait half a second for image source to propagate
  		setTimeout(function() {
  			$.ajax({
  				type: 'POST',
  				url: 'ajax/upload-image.php',
  				data: { image: resImg.src},
  				success: function(data) {
  					if (data.success) {
  						console.log("Success! Image uploaded");
  						$("#decodeBtn").prop("disabled", false); //Allow decoding
  					}
  					else {
  						console.error("Error: Image could not be uploaded");
  				  }
  				},
  				error: function(data) {
  				  console.error("AJAX Error");
  				}
  			});
  		}, 500);
  	});
  	
    $("#decodeBtn").click(function() {
      qrcode.decode($("#qrcode").attr("src"));
    });
  });
  
  function showData(data) {
  	$("#output").append(data);
  }
</script>
```
**Include the HTML:**
``` HTML
<input type="file" id="imageFile" name="imageFile" accept="image/*"><br />
<button type="button" id="uploadImgBtn">Upload Image</button>

<img id="qrcode" src=""/><br />
<button type="button" id="decodeBtn" disabled>Decode the QR Code</button>

<div id="output"></div>
```


The MIT License
---
Copyright (c) 2012 Shinichi Tomita <shinichi.tomita@gmail.com>;

Permission is hereby granted, free of charge, to any person obtaining
a copy of this software and associated documentation files (the
'Software'), to deal in the Software without restriction, including
without limitation the rights to use, copy, modify, merge, publish,
distribute, sublicense, and/or sell copies of the Software, and to
permit persons to whom the Software is furnished to do so, subject to
the following conditions:

The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED 'AS IS', WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY
CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE
SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.


[Twitter Bootstrap]:https://github.com/twbs/bootstrap
[Jasny Bootstrap]:http://jasny.github.io/bootstrap/javascript/#fileinput
[jsqrcode]:https://github.com/LazarSoft/jsqrcode
[megapix]:https://github.com/stomita/ios-imagefile-megapixel
