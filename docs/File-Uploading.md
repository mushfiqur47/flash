## File Uploading

  Flash Framework provide simplest way to upload files on the server.

### Files Information

  Uploaded files information stored in the `$this->files` object.

  - `$this->files->file_var['name']` : store the original name of uploaded files.
  - `$this->files->file_var['type']` : store mime type of the file, if the browser provided this information. An example would be `image/gif`.
  - `$this->files->file_var['size']` : store size, in bytes, of the uploaded file.
  - `$this->files->file_var['tmp_name']` : store the temporary filename of the file in which the uploaded file was stored on the server.
  - `$this->files->file_var['error']` : store the error code associated with this file upload.

### Example
  
  - Set your media files directory in settings file.

```php
$setting['media'] = '/application/your_media_dir';
```

  media files directory store all uploaded files on the server.

  - Upload files.

```php
class app_view extends Views {
  function file_upload() {
    //source path of uploaded files.
    $source = $this->files->image['tmp_name'];

    //destination path of uploaded files.
    $destination = $this->uri->media('/img/').$this->files->image['name'];

    //upload files
    if($this->files->upload($source, $destination)) {
      return $this->response("File uploaded");
    } else {
      return $this->response("Error: File not uploaded");
    }
  }
}
```
