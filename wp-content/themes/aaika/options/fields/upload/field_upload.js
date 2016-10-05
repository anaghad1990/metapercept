jQuery(document).ready(function( $ ){

	
	/*
	 *
	 * devn_options_upload function
	 * Adds media upload functionality to the page
	 *
	 */
	 
	 $('.king-upload-image').on( 'click', function(e){
		 e.preventDefault();
		 $( this ).closest('.king-upload-wrp').find('.king-upload-button').click();
		 return false;
	 });
	 
	 $('.king-upload-button-remove').on( 'click', function(e){
		 e.preventDefault();
		 $( this ).closest('.king-upload-wrp').find('.king-upload-input').val( '' );
		 $( this ).closest('.king-upload-wrp').find('.king-upload-image').attr({ src : '' }).hide();
		 $( this ).closest('.king-upload-wrp').find('.king-upload-button-remove').hide();
		 return false;
	 });
	 
	 $('.king-upload-button').on( 'click', function(e){
		 
		e.preventDefault();
		
		document.devn_uploader_elm = this;
				
        //If the uploader object has already been created, reopen the dialog
        if ( document.devn_uploader ) {
           document.devn_uploader.open();
           return;
        }
		
        //Extend the wp.media object
        document.devn_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false,
			editing:   true,
			allowLocalEdits: true,
            displaySettings: true,
            displayUserSettings: true,
            
        });
 
        document.devn_uploader.on('select', function() {
        
            attachments = document.devn_uploader.state().get('selection');
            attachments.map( function( attachment ) {
		     	 attachment = attachment.toJSON();
		     	 var elm = document.devn_uploader_elm;
		     	 $( elm ).closest('.king-upload-wrp').find('.king-upload-input').val( attachment.url );
		     	 $( elm ).closest('.king-upload-wrp').find('.king-upload-image').attr({ src : attachment.url }).show();
		     	 $( elm ).closest('.king-upload-wrp').find('.king-upload-button-remove').show();
		    });

        });
 
        //Open the uploader dialog
        document.devn_uploader.open();

	 })
	 
});