<?php /*How to - Delete Files and Folders via SSH

Sometimes you would need to remove a file or a folder from the system. To do so using SSH, you would need to execute the appropriate command – rm.

The command in its simplest form looks like:

rm myFile.txt myFile1.txt myFile2.txt


However, listing all files/folders that need to be deleted can be quite time-consuming. Fortunately, rm accepts several arguments which can ease your task. In the above example, you could type:

rm myFile*.txt


This will match all files starting with ‘myFile’ and ending in ‘.txt’ and delete them.

To delete a whole folder and its content recursively, you can use:

rm -rf foldername/


To delete all files/folders in the current directory, without deleting the directory itself, you would need to use:

rm -rf **/