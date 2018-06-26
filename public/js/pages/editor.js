//[editor Javascript]

//Project:	Minimal Admin - Responsive Admin Template
//Version:  1.1.0
//Last change:  18/09/2017
//Primary use:   Used only for the wysihtml5 Editor 


//Add text editor
    $(function () {
    "use strict";

    // Replace the <textarea id="editor1"> with a CKEditor
	// instance, using default configuration.
	// CKEDITOR.replace('incidentDescriptionInput');
	CKEDITOR.replace('emailBodyInput');
	//bootstrap WYSIHTML5 - text editor
	$('.textarea').wysihtml5();		
	
  });

