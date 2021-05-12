jQuery(document).ready(function(){
    
    jQuery(".lightboxlink").parent()
                .css("float", "left")
                .css("margin", "2px");
        
    jQuery("#showimages").click(function(){
        
//        console.log(jQuery("#image-fold").css("height"));
        
        if (jQuery("#image-fold").css("height") != "180px"){
            jQuery("#image-fold").css("height", "180px");
        }
        else{
            jQuery("#image-fold").css("height", "100%");
        }
        
    });

});