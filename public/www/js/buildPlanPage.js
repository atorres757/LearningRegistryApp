Search = {
	resources: new Array(),
	resourceIds: new Array(),
	plan: new models.Plan(),
	appendItem: function(resource){
		var item = $(templates.resourceResult.join(""));
		item.find(".link").attr('href', resource.document);
		item.find(".description").text(resource.description);
		item.find(".title").text(resource.title);
		item.find(".addButton").data('id', resource._id);
		item.find(".addButton").bind("click", Search.addResource);
		item.find(".removeButton").bind('click', Search.removeItem);
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

		curr.showMoreResultsButton();
	},
	showMoreResultsButton: function(){
		$("#moreResults").show();
	},
	loadMoreResults: function() {
		var qry = $('#searchQuery').val();
		qry += "/count/10/toomit/"+Search.resourceIds.join(",");
		store.query(qry, Search.renderResults)
	},
	addResource: function() {
		var res = Search.searchResource($(this).data('id'));
		Search.plan.resources.push(res);
		$(this).remove();
	},
	searchResource: function(id) {
		$.each(Search.resources, function (index, val){
			if(val._id){
				return val;
			}
		});
	},
	removeItem : function (id) {
		console.log($(this).parents('li').remove());
	}
}

$(function () {
	$("#moreResults").bind('click', Search.loadMoreResults);
	$('#searchQuery').bind('keypress', function(e){
		if (e.keyCode == 13){
			$("#results").empty();
			store.query($(this).val(), Search.renderResults)
			return false;
		}
	});
});
