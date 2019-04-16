$(document).ready(function(){
	$('.st-upload').each(function (e) {
        var t = $(this);
        var parent = t.closest('.st-upload-gallery');
        var multi = t.data('multi');
        var frame;
        t.click(function (e) {
            e.preventDefault();

            var galleryBox = t.parent().find('.st-selection');

            if (frame) {
                frame.open();
                return;
            }
            // Create a new media frame
            frame = wp.media({
                title: 'Select image',
                button: {
                    text: 'Use this media'
                },
                multiple: true  // Set to true to allow multiple files to be selected
            });

            frame.on('select', function () {

                // Get media attachment details from the frame state
                var attachment = frame.state().get('selection').toJSON();

                var ids = [];                    

                //Get id ảnh đã có để đưa vào ids;
                $('img', parent).each(function(){
                	var currentID = $(this).data('id');
                	if(currentID !== ''){
                    	if(!ids.includes(currentID)){
                    		ids.push(currentID);

                    	}
                	}
                });



                console.log(123);

             
               
                if (attachment.length > 0) {
                    for (var i = 0; i < attachment.length; i++) {
                    	if(!ids.includes(attachment[i].id)){
                   			ids.push(attachment[i].id);
                   			parent.find('.st-include-image').append('<div class="item" style="display: inline-block;"><img  src="'+ attachment[i].url +'" width="150px" height="150px" style = "margin-left: 10px;"   /><i class="fa fa-times time " ></i></div>');
               			}
                    }
                }

                
                parent.find('.hotel_images').val(ids.toString());
            });
            

            frame.open();

        });
    })
	$(document).on('click',".time" ,function() {
		$(this).parent().remove();
		var ids = [];
		$('.st-upload-gallery .st-include-image .item').each(function(){
			var id = $(this).find('img').data('id');
			if(!ids.includes(id)){
				ids.push(id);
			}
		});
		$('.st-upload-gallery .hotel_images').val(ids.toString());
       	
	});
});