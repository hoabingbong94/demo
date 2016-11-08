//var _URL = window.URL || window.webkitURL;
//
//$(".uploads-images").change(function (e) {
//
//    var image, file;
//
//    if ((file = this.files[0])) {
//
//        image = new Image();
//
//        image.onload = function () {
//            if(this.width >700 && this.height >300)
//            {
//                
//            alert("The image width is " + this.width + " and image height is " + this.height);
//            }
//            else{
//                alert("LOI");
//            }
//            
//        };
//
//        image.src = _URL.createObjectURL(file);
//
//
//    }
//
//});
function fillAll() {
    $("#delt").click(function () {

        alert($('.check-child').length);
        $('.check-child').remove();


    });
}