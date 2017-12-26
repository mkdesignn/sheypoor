jQuery(function($){
    //
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // append home class to the first li element
    if($(".breadcrumb li:first-child").find("a")){
        var a = $(".breadcrumb li:first-child").find("a");
        a.html("<span class='icomoon-uniE00B'></span>")
    }else{
        $(".breadcrumb li:first-child").html("").append("<span class='icomoon-uniE00B'></span>");
    }

    // open menu on clicking the parent
    $(".sub-menu-li").click(function(){
        $(this).parent().find("ul").slideToggle(300);
    })

    // if the course was near the left page then
    // open the panel
    $(document).mousemove(function(e){
        if(e.clientX < 10 ){
            $(".left-bar").stop().animate({"left":"0px"}, 200, 'expoout');
        }
    });
    $(".left-bar").mouseleave(function(){
        $(this).stop().animate({"left":"-270px"}, 200, 'expoout');
    })


    /**
     * copy the link from the left side to the content
     */
    $("body").on("click", ".copy_file_link", function(){
        $(".file_address_input").val($(this).attr("data-clipboard-text"));
        $(".file_address_image").attr("src", $(this).attr("data-clipboard-text"));
        var parent = $("[name=file]").parent()
        var clone = $("[name=file]").clone();
        $("[name=file]").remove();
        parent.append(clone);
    })


    /**
     * fill the thumbnail on change the file input
     */
    $("[name=file]").on("change", function(e){
        var file    = $(this)[0].files[0];
        var thumbnail = $(this).attr("fill");
        var reader  = new FileReader();

        reader.onloadend = function () {
            $(thumbnail).attr("src", reader.result)
        }

        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.src = "";
        }
    })

    //$.fn.notification = function (type, text, stay) {
    //    var curr_element = $(this);
    //    if( type == "danger" ){
    //        curr_element.html(text).style({"position":"fixed", "top":"100px",
    //            "left":"0px", "padding":"10px","color":"#fff",
    //            "border-radius":"2px", "background":"rgba(220, 76, 76, 0.74)",
    //            "z-index":"1000000", "opacity":"0", "font-size":"11px"});
    //        console.log(stay);
    //        if( stay != undefined ){
    //            curr_element
    //                .style("left", -curr_element.width())
    //                .stop()
    //                .animate({"left":"0px", "opacity":"1"}, 300)
    //        }else{
    //            curr_element
    //                .style("left", -curr_element.width())
    //                .stop()
    //                .animate({"left":"0px", "opacity":"1"}, 300)
    //                .delay(3000)
    //                .animate({"left":-curr_element.width(), "opacity":"0"}, 300)
    //        }
    //    }else if( type == "success" ){
    //        curr_element.html(text).style({"position":"fixed", "top":"100px",
    //            "left":"0px", "padding":"10px","color":"#fff",
    //            "border-radius":"2px", "background-color":"rgba(27, 188, 155, 0.74)",
    //            "z-index":"100000", "opacity":"0", "font-size":"11px"});
    //        if( stay != undefined ){
    //            curr_element.style("left", -curr_element.width())
    //                .stop()
    //                .animate({"left":"0px", "opacity":"1"}, 300)
    //        }else{
    //            curr_element.style("left", -curr_element.width())
    //                .stop()
    //                .animate({"left":"0px", "opacity":"1"}, 300)
    //                .delay(3000)
    //                .animate({"left":-curr_element.width(), "opacity":"0"}, 300)
    //        }
    //    } else if( type == "hide" ){
    //        var width = curr_element.style("width")
    //        curr_element.animate({"left":"-"+width, "opacity":"0"}, 300);
    //    }
    //}
    //
    //$.fn.block = function (type){
    //    var current_element = this;
    //    var width = current_element.style("width");
    //    var height = current_element.style("height");
    //    var top = current_element.offset().top;
    //    var left = current_element.offset().left;
    //
    //    if( type == "show" ){
    //        var block = $("<div/>", {"style":"background-color:#c1bebe;display:none;position:absolute;width:"+width+";height:"+height+";top:"+top+"px;left:"+left+"px", "class":"blockui"});
    //
    //        var loader = $('<div class="bubblingG"><span id="bubblingG_1"></span>' +
    //            '<span id="bubblingG_2"></span><span id="bubblingG_3"></span></div>');
    //        if( block.find(".bubblingG").length == 0 )
    //            block.append(loader);
    //
    //        current_element.parent().append(block);
    //        $(".blockui").fadeIn(500);
    //    }else{
    //        //console.log("blockui");
    //        $(".blockui").fadeOut(500, function(){
    //            $(".blockui").remove();
    //        })
    //    }
    //}

})

//function triggerSearch(wrapper){
//    $(wrapper+" .search-input").keydown(function (e) {
//        if (e.keyCode == 13)
//            return false;
//    })
//
//    $("body").on("click", ".pagination li a", function(e){
//        e.preventDefault();
//        var page_id = $(this).text();
//        $(wrapper+" .search-input").trigger("keyup", page_id);
//    })
//
//    $(wrapper+" .search-input").trigger("keyup");
//}

function number(event){
    var ew = event.which;
    if(ew == 32)
        return true;
    if(48 <= ew && ew <= 57)
        return true;
    if(65 <= ew && ew <= 90)
        return true;
    if(97 <= ew && ew <= 122)
        return true;
    return false;
}

function getFileSizeName(length){

    var size_grade = "";
    if( (length / 1000) > 1 ){ // larger than 1 kilobyte
        size_grade = "Kb"
        length = (length / 1000);
        if( (length / 1000) > 1 ){ // larger than 1 megabyte
            size_grade = "Mb"
            length = (length / 1000);
            if( (length / 1000) > 1 ){ // larger than 1 gigabyte
                size_grade = "GB"
                length = (length / 1000);
            }
        }
    }
    return parseFloat(length).toFixed(2)+" "+size_grade;
}