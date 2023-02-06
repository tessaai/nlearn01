        $(document).ready(function(){
            //if user focus out from the input field
            $("#field").on("focusout", function()
                //getting user entered img URL
                var imgURL = $("#field").val();
                if(imgURL != ""){ //if input field isn't blank
                    var regPattern = /\.(jpe?g|png|gif|bmp)$/i; 
                    if(regPattern.test(imgURL)){ //if pattern matched to image url
                        var imgTag = '<img src="'+ imgURL +'" alt="">'; //creating a new img tag to show img
                        $(".img-preview").append(imgTag); //appending img tag with user entered img url
                        // adding new class which i've created in css
                        $(".preview-box").addClass("imgActive");
                        $("#button").addClass("active");
                        $("#field").addClass("disabled");
                        $(".cancel-icon").on("click", function(){
                            //we'll remove all new added class on cancel icon click
                            $(".preview-box").removeClass("imgActive");
                            $("#button").removeClass("active");
                            $("#field").removeClass("disabled");
                            $(".img-preview img").remove();
                        });
                    }else{
                        alert("Invalid img URL - " + imgURL);
                        $("#field").val('');
                }
            );
        });
    