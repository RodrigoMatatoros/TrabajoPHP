<?php
/*function uploadFile($file, $target_dir, $image)
{
    $errors = array();
    $evOK = 1;
    $fileExist = false;
    if ($image) {
        // Upload an image
        if ($file['size'] > 0) {
            $target_file = $target_dir . basename($file["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Check if image file is a actual image or fake image
            $check = getimagesize($file["tmp_name"]);
            if ($check === false) {
                $errors[] = "File is not an image.";
                $evOK = false;
            }

            // Check if file already exists
            if (file_exists($target_file)) {
                $fileExist = true;
            }

            // Check file size
            if ($file["size"] > 500000) {
                $errors[] = "Sorry, your file is too large.";
                $evOK = false;
            }

            // Allow certain file formats
            if (
                $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif"
            ) {
                $errors[] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $evOK = false;
            }

            // Check if $evOK is set to 0 by an error
            if ($evOK == false) {
                $errors[] = "Sorry, your file was not uploaded.";
                return $errors;
                // if everything is ok, try to upload file
            } else if ($fileExist) {
                return $target_file;
            } else {
                $tryUpload = move_uploaded_file($file["tmp_name"], $target_file);
                if (!$tryUpload) {
                    $errors[] = "Sorry, there was an error uploading your file.";
                } else {
                    return $target_file;
                }
            }
        }
    } else {
        $target_file = $target_dir . basename($file["name"]);
        $docFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        // Upload a document
        // Check file size
        if ($file["size"] > 500000) {
            $errors[] = "Sorry, your file is too large.";
            $evOK = false;
        }

        // Allow certain file formats
        if ($docFileType != "pdf") {
            $errors[] = "Sorry, only PDFs files are allowed.";
            $evOK = false;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            $fileExist = true;
        }

        // Check if $evOK is set to 0 by an error
        if ($evOK == false) {
            $errors[] = "Sorry, your file was not uploaded.";
            return $errors;
            // if everything is ok, try to upload file
        } else if ($fileExist) {
            return $target_file;
        } else {
            $tryUpload = move_uploaded_file($file["tmp_name"], $target_file);
            if (!$tryUpload) {
                $errors[] = "Sorry, there was an error uploading your file.";
            } else {
                return $target_file;
            }
        }
    }
}*/
function upload()
{
    $target_dir = "upload/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
/*if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}*/

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
  return $target_file;
}
}
