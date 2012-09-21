Search = {
	resources: new Array(),
	resourceIds: new Array(),
	appendItem: function(resource){
		var item = $(templates.resourceResult.join(""));
		item.find(".link").attr('href', resource.document);
		item.find(".description").text(resource.description);
		item.find(".title").text(resource.title);
		
		$("#results").append(item);
	},
	renderResults: function(results){
		results = $.parseJSON(results);
		var curr = this.Search;
		$.each(results, function(index, val){
			var valid = val._id;
			curr.resources.push( val );
			curr.resourceIds.push(val._id);
			curr.appendItem(val);
		});
		curr.addMoreResultsButton();
	},
	addMoreResultsButton: function(){
		$("#results").append($(templates.moreResultsButton.join("")));
		$("#moreResults").bind('click', Search.loadMoreResults);
	},
	loadMoreResults: function() {
		$("#moreResults").remove();
		var qry = $('#searchQuery').val();
		qry += "/count/10/toomit/"+Search.resourceIds.join(",");
		store.query(qry, Search.renderResults)
	},
	searchResource: function(id) {
		var curr = this.Search;
		$.each(curr, function (index, val){
			if(val._id){
				return val;
			}
		});
	}
}

$(function () {
	$('#searchQuery').bind('keypress', function(e){
		if (e.keyCode == 13){
			store.query($(this).val(), Search.renderResults)
			return false;
		}
	});
});
