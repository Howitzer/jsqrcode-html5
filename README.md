jsqrcode-html5
==============
Take an image of a QR Code with your tablet/smartphone using HTML5, upload it to your server using PHP, and then decode it using only JavaScript.


Dependencies
---
  * [megapix] - Fixes iOS subsampling error
  * [jsqrcode] - The JavaScript QR Code reader


Demo
---
  * **[The jsqrcode-html5 Demo]** - *You must have your own server!*
  * *Implemented with [Twitter Bootstrap] and [Jasny Bootstrap]'s fileinput.*

Usage
---
**Include the HTML:**
``` HTML
<!-- jquery -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<!-- megapix -->
<script type="text/javascript" src="js/megapix-image.min.js"></script>

<!-- jsqrcode: must be in this order! -->
<script type="text/javascript" src="js/grid.js"></script>
<script type="text/javascript" src="js/version.js"></script>
<script type="text/javascript" src="js/detector.js"></script>
<script type="text/javascript" src="js/formatinf.js"></script>
<script type="text/javascript" src="js/errorlevel.js"></script>
<script type="text/javascript" src="js/bitmat.js"></script>
<script type="text/javascript" src="js/datablock.js"></script>
<script type="text/javascript" src="js/bmparser.js"></script>
<script type="text/javascript" src="js/datamask.js"></script>
<script type="text/javascript" src="js/rsdecoder.js"></script>
<script type="text/javascript" src="js/gf256poly.js"></script>
<script type="text/javascript" src="js/gf256.js"></script>
<script type="text/javascript" src="js/decoder.js"></script>
<script type="text/javascript" src="js/qrcode.js"></script>
<script type="text/javascript" src="js/findpat.js"></script>
<script type="text/javascript" src="js/alignpat.js"></script>
<script type="text/javascript" src="js/databr.js"></script>


<input type="file" id="imageFile" name="imageFile" accept="image/*"><br />
<button type="button" id="uploadImgBtn">Upload Image</button>

<img id="qrcode" src=""/><br />
<button type="button" id="decodeBtn" disabled>Decode the QR Code</button>

<div id="output"></div>
```

**Include the JavaScript:**
``` JavaScript
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


[The jsqrcode-html5 Demo]:http://howitzer.github.io/jsqrcode-html5
[Twitter Bootstrap]:https://github.com/twbs/bootstrap
[Jasny Bootstrap]:http://jasny.github.io/bootstrap/javascript/#fileinput
[jsqrcode]:https://github.com/LazarSoft/jsqrcode
[megapix]:https://github.com/stomita/ios-imagefile-megapixel
