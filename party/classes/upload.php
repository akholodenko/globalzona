<?
	class Upload
	{
		var $file = array();
		var $file_upload = true;
		var $message = "";

		function Upload ($file)
		{
			$this->file = $file;
		}

		function UploadImage ()
		{
			if($this->IsValidFile())
			{
				$newFileName="images/upload/".date('YmdHis').".jpg";

				if(move_uploaded_file ($this->file['tmp_name'], $newFileName))
				{
					echo "<img src='http://www.globalzona.com/party/".$newFileName."' width='225'>";
				}
				else
				{
					echo "Failed to upload file. Contact Site admin to fix the problem";
				}
			}
		}

		function IsValidFile ()
		{
			if ($this->file['size'] > 250000)
			{ 
				echo "Your uploaded file size is more than 250KB so please reduce the file size and then upload. Visit the help page to know how to reduce the file size.<BR>";
				$this->file_upload = false;
			}

			if (!($this->file['type'] == "image/bmp" OR $this->file['type'] =="image/pjpeg" OR $this->file['type'] =="image/jpeg" OR $this->file['type']=="image/gif" OR $this->file['type']=="image/png"))
			{
				echo "Your uploaded file must be of JPG, Bitmap (BMP), PNG or GIF. Other file types are not allowed<BR>";
				$this->file_upload = false;
			}

			if($this->file_upload) return true;
			else return false;
		}
	}
?>