<?php
header('Content-Type: application/json');

$content = "";
$success = false;

if (!empty($_POST['image'])) {
  $directory = "images/";
	$filename = date('Y-m-d_H\hi\ms\s') . '.jpg';
	
	//Remove mediatype, we only care about the image data
	$parts = explode(',', $_POST['image']);
	$img = $parts[1];
	$data = base64_decode($img);
	
	$file = $directory . $filename;
	$success = file_put_contents($file, $data);
	
	$content = $success ? 'Picture successfully saved' : 'Unable to save the picture';
}
else {
	$content = 'Error! Invalid image.';
}

echo json_encode(array('success' => $success, 'image' => $filename, 'content' => $content));
exit;
?>
