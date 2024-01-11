//*slideslow*//
var count = 0;
$('.slideshow li').css('width',function(){return window.innerWidth});
for (var i = 0; i < $('.slideshow ul').children().length; i++) {
	$(".count").append('<li></li>');
	$('.count li').eq(0).css('background-color','red');
}
$(".count").css('left',function(){return ($(window).width()-$(".count").width())/2})
$(".right").click(function () {
	if(count == $('.slideshow ul').children().length){
		$('.slideshow ul').css('right',function(){return -1*parseInt($(".slideshow ul li").css("width"))});
		$(".slideshow ul").animate({right:0},"fast");
	}
	$(".slideshow ul").animate({right:"+="+$(".slideshow ul li").css("width")},"normal",function complete() {
		if(count == $('.slideshow ul').children().length){
			$('.slideshow ul').css('right',function(){return -1*parseInt($(".slideshow ul li").css("width"))});
			$(".slideshow ul").animate({right:0},"fast");
			count = 0;
		}
	;})
	console.log(count+=1);
	$('.count li').eq(count).css('background-color','red');
	$('.count li').eq(count-1).css('background-color','');
});
$(".left").click(function () {
	$(".slideshow ul").animate({right:"-="+$(".slideshow ul li").css("width")},"normal",function complete() {
		if(count == -1){
			$('.slideshow ul').css('right',function(){return $('.slideshow ul').children().length*parseInt($(".slideshow ul li").css("width"))});
			$(".slideshow ul").animate({right:"-="+$(".slideshow ul li").css("width")},"fast");
			count = $('.slideshow ul').children().length-1;
		}
	});
	console.log(count-=1);
	$('.count li').eq(count).css('background-color','red');
	$('.count li').eq(count+1).css('background-color','');
});
//*manga page*//
$('.count li').click(function(){
	var index = $(this).index();
	count = index;
	$('.count li').each(function(){
		$(this).css('background-color','');
	})
	$(".slideshow ul").animate({right:index*parseInt($(".slideshow ul li").css("width"))},"normal");
$('.count li').eq(index).css('background-color','red');
});
//*manga chapter*//
$(".manga_chapter").change(function () {
location.href=$(this).val();});
$('.manga_reader img').css('height',function(){return window.innerHeight ;});
$(".manga_reader select").change(function () {
location.href=$(this).val();});
//*anime series*//
$(".anime_series").change(function () {
location.href=$(this).val();});
//*search*//
$("#search_window").on("input",function () {
var word = $.trim($(this).val());
if(word.length > 1){
$.ajax({type: "POST",url: "index.php?act=ajax",data: {action:'search',name:word},success: function (result) {
if (result != ''){
$('.drop_list ul').html(result);$(".drop_list").fadeIn("slow");
}else{
$(".drop_list").fadeOut("slow");
}
}});

}else{
$(".drop_list").fadeOut("slow");}
});
$("#search_window").on("focusout",function () {
$(".drop_list").fadeOut("slow");});
$(".screen img").on('click',function () {
$("#zoom").css('display','block');
$('#zoom img').attr('src',$(this).attr('src'));
$('#zoom img').css('left',function(){return (parseInt(window.innerWidth) - parseInt($('#zoom img').css('width')))/2;});
$('#zoom img').css('top',function(){return (parseInt(window.innerHeight) - parseInt($('#zoom img').css('height')))/2;});});
$("#zoom").on('click',function () {$("#zoom").css('display','none');})
/*bot*/
$(document).delegate('.answer ul li a','click',function(){
var bot_id=$(this).attr('data');
var url=$(this).attr('href');
$.ajax({type: "POST",url: "index.php?act=ajax",
data: {action:'bot',bot_id:bot_id},
success: function (result) {$('.bot').replaceWith(result);},
complete: setTimeout(function(){if(url == '#'){return false;}else{return location.href=url;}}, 3000)
});
return false;
})
$("#login").on('click',function(){
$('.user_autoriz').css('display','block');
$('.user_registration').css('display','none');
});
$("#registr").on('click',function(){
$('.user_registration').css('display','block');
$('.user_autoriz').css('display','none');
});
