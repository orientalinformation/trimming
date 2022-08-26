<?php
$allowedExts = array("mp3", "mp4");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);

 if ((($_FILES["file"]["type"] == "audio/mp3") || ($_FILES["file"]["type"] == "audio/mpeg") 
 || ($_FILES["file"]["type"] == "video/mp4")) && in_array($extension, $allowedExts)) {
        
   if ($_FILES["file"]["error"] > 0) {
      echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
   } else {
      echo "Upload: " . $_FILES["file"]["name"] . "<br>";
      echo "Type: " . $_FILES["file"]["type"] . "<br>";
      echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
      echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";
      if (file_exists("data/" . $_FILES["file"]["name"])) {
         echo $_FILES["file"]["name"] . " already exists. ";
      } else {
         $isUpload = move_uploaded_file($_FILES["file"]["tmp_name"], "data/" . $_FILES["file"]["name"]);
         if ($isUpload) {
            echo "Stored in: " . "data/" . $_FILES["file"]["name"]."\n";
            $file  = "data/".$_FILES["file"]["name"];
            $cuts  = gmdate("H:i:s", $_POST['fromTime']);
            $cute  = gmdate("H:i:s", $_POST['endTime']);
            $filerenm = "data/".date("YmdHis").".".$extension;
            //exec("ffmpeg -ss $cuts -i $file -t $cute $filerenm");
            //exec("ffmpeg -i $file -ss $cuts -t $cute $filerenm"); // linux
            exec("D:/softs/ffmpeg/bin/ffmpeg -i $file -ss $cuts -t $cute $filerenm"); // windown
            
            echo "Trim complected";
            
            if ($extension == "mp4") {
                //ffmpeg -i video.mp4 audio.mp3
                $out = "data/".date("YmdHis").".mp3";
                exec("D:/softs/ffmpeg/bin/ffmpeg -i $filerenm $out");
            }
         }
         
      }
   }
}
else
{
    echo "Invalid file";
}