## 01: Create a button, input, and image preview holder if you are going to choose images. Specify the id to the input and image preview by data-input and data-preview.

````
<div class="input-group">
   <span class="input-group-btn">
     <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
       <i class="fa fa-picture-o"></i> Choose
     </a>
   </span>
   <input id="thumbnail" class="form-control" type="text" name="filepath">
 </div>
 <div id="holder" style="margin-top:15px;max-height:100px;"></div>

````

## 02: Import lfm.js(run php artisan vendor:publish if you need).

````
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>

````


## 03: Init filemanager with type. (requires jQuery)

````
$('#lfm').filemanager('image');

````
#### OR

````
$('#lfm').filemanager('file');

````

## 04: Domain can be specified in the second parameter(optional, but will be required when developing on Windows mechines) :

````
var route_prefix = "url-to-filemanager";
$('#lfm').filemanager('image', {prefix: route_prefix});

````
#### example
````
var route_prefix = 'admin/file-manager';
$('#lfm').filemanager('image',{prefix: route_prefix});

````