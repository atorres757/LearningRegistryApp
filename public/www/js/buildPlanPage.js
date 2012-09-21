var Search = {
	appendItem: function(resource){
		var item = $(templates.resourceResult.join(""));
		item.find(".link").href(resource.document);
		item.find(".description").text(resource.description);
		item.find(".title").text(resource.title);
		
		$(this.el).append(item);
	},
	renderResults: function(results){
		results = $.parseJSON(results);
		$.each(results, function(index, val){
			console.log(val);
		});
	}
}

$(function () {
	$('#searchQuery').bind('keypress', function(e){
		if (e.keyCode == 13){
			store.query($(this).val(), Search.renderResults)
		}
	});
});
