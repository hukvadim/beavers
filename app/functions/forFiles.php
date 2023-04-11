<?php
defined('security') or die('Access denied'); // Add light protection against file access

/**
 * Uploads image and resizes image
 */
function uploadImage($fileInputName, $filename, $uploadDir, $newWidth = 500, $newHeight = 500, $crop = true)
{
	// Check if the file was uploaded without errors
	if(isset($_FILES[$fileInputName]) && $_FILES[$fileInputName]['error'] == 0) {

		// Check if the file is an image
		$fileType = exif_imagetype($_FILES[$fileInputName]['tmp_name']);

		// Get the current dimensions of the image
		list($width, $height) = getimagesize($_FILES[$fileInputName]['tmp_name']);

		// Calculate the ratio of the original image
		$ratio = $width / $height;
		$ratioWidth  = $newWidth;
		$ratioHeight = $newHeight;

		// Calculate the new dimensions for the image
		$newRatio = $newWidth / $newHeight;

		// Need to keep the width and height as we want if need to crop
		if ($crop) {
			if ($newRatio > $ratio)
				$ratioHeight = ceil($newWidth / $ratio);
			else
				$ratioWidth  = ceil($newHeight * $ratio);
		} else {
			if ($newRatio > $ratio)
				$ratioWidth  = ceil($newHeight * $ratio);
			else
				$ratioHeight = ceil($newWidth / $ratio);
		}

		// Load the image
		switch($fileType) {
			case IMAGETYPE_JPEG:
				$image = imagecreatefromjpeg($_FILES[$fileInputName]['tmp_name']);
				break;
			case IMAGETYPE_PNG:
				$image = imagecreatefrompng($_FILES[$fileInputName]['tmp_name']);
				break;
			default:
				return false;
		}

		// Create a new image with the desired dimensions
		$newImage = imagecreatetruecolor($ratioWidth, $ratioHeight);

		// Resize the image
		imagecopyresampled($newImage, $image, 0, 0, 0, 0, $ratioWidth, $ratioHeight, $width, $height);

		// Check if you need to trim to the right size
		if ($crop) {

			// Crop data from new witdh and height
			$cropX = ($ratioWidth - $newWidth) / 2;
			$cropY = ($ratioHeight - $newHeight) / 2;

			// Crop the image to the desired dimensions
			$newImage = imagecrop($newImage, ['x' => $cropX, 'y' => $cropY, 'width' => $newWidth, 'height' => $newHeight]);
		}

		// Get the file upload extension
		$ext = strtolower(pathinfo($_FILES[$fileInputName]['name'], PATHINFO_EXTENSION));

		// Save the image to the upload directory
		$filename    = $filename . '.' . $ext;
		$destination = $uploadDir . $filename;

		switch($fileType) {
			case IMAGETYPE_JPEG:
				$result = imagejpeg($newImage, $destination);
				break;
			case IMAGETYPE_PNG:
				$result = imagepng($newImage, $destination);
				break;
			default:
				return false;
		}

		// Free up memory
		imagedestroy($image);
		imagedestroy($newImage);

		return ($result) ? $filename : false;
	}

	return false;
}

