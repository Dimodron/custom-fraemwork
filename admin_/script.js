$(".search_window").on("input",function () {
	var act=$(this).attr('name');
	var id=$(this).attr('id');
	var word = $.trim($(this).val());
    $.ajax({type: "POST",url: "index.php?act=ajax",data: {action:'search',act:act,id:id,name:word},success: function (result) {
        $('.folder  tbody').html(result);
	}});
});
