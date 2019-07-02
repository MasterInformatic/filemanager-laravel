

### In the 'config/mifilemanager.php'

## Startup Views:

| Key                   | Type   | Description                                                     |
|-----------------------|--------|-----------------------------------------------------------------|
| showImagesOnly		| boolean | Only show images and folders.	                		   	   |
| showInView			| boolean | Hidde the folders in the view.							   	   |
| FILE_VIEW				| boolean | Show or not files in the view(except images ).			   	   |


## Upload / Validation:

| Key                        | Type    | Description                                                               |
|----------------------------|---------|---------------------------------------------------------------------------|
| maxSize           		 | int     | Specify max size of uploading image or file.                              |
| allowedExtensions			 | array   | Specify the files allowed to upload.      			                       |
| deniedExtensions			 | array   | Specify the files not allowed to upload.      			                   |
| FOLDER_CREATE				 | boolean | Allowed create folders.      			                       			   |
| FILE_UPLOAD				 | boolean | Allowed or denied file upload(all files and images).	     			   |


## File Extension Information

| Key               | Type  | Description                                 |
|-------------------|-------|---------------------------------------------|
| file\_type\_array | array | Map file extension with display names.      |
| file\_icon\_array | array | Map file extension with icons(font-awsome). |
| file\_urls\_array | array | Map file extension with images. 			  |


## Folder configuration (Not available)

| Key               | Type  | Description                                 |
|-------------------|-------|---------------------------------------------|
| folder\_settings  | array | Map the directories with his rules.    	  |


---


## License

[![License](http://img.shields.io/:license-mit-blue.svg?style=flat-square)](http://badges.mit-license.org)

- **[MIT license](http://opensource.org/licenses/mit-license.php)**
- Copyright 2019 © <a href="http://masterinformatic.com" target="_blank">MasterInformatic</a>.