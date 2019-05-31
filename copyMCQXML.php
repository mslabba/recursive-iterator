<?php
/**
 * Author 			: M S Labba
 * Created on 		: Dec 31, 2013
 * Last Updated on	: Dec 31, 2013
 * Reviewed On		: Dec 31, 2013
 * Review comments 	:
 *
 */

/**Copy the MCQ xml from the current folder to outside.
 */
$folderName = $_POST['folderName'];
$dir = new RecursiveDirectoryIterator($folderName);
$it  = new RecursiveIteratorIterator($dir);
foreach ($it as $fileinfo) {
	if ($fileinfo->isDir()) {

	}elseif ($fileinfo->isFile()) {
		$fileName = $fileinfo->getFileName();
		if(stripos($fileName, ".xml"))
		{
			$file = $folderName.'/'.$it->getSubPath().'/'.$fileinfo->getFilename();
			$file = str_replace('\\','/',$file);
			$path = $folderName.'/'.$it->getSubPath();
			$path = str_replace('\\','/',$path);
			$pathArray = explode('/',$path);
			$pathRemoved = array_pop($pathArray);
			$pathNew = implode('/',$pathArray);
			$xml= new XMLReader();
			$xml->open($file);
			$names = array();
			while($xml->read()){
				$names[] = $xml->name;
			}
			if(in_array('Quiz',$names) && in_array('Question',$names)){
				$copy = copy($file, $pathNew."/$fileName");
			}
		}
	}
}
if($copy)
	echo "Copied successfully!";
else
	echo "Sorry! Please try after some time";
?>
