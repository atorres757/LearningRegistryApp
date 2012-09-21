store = {
	save: function(className, obj) {
		var saveService = "/plan/save";
		var getUrl = "";
		$.ajax({
			url: getUrl,
			method: 'get',
			success: function(data){
				return true;
			}
		});
	},
	query: function(qry, callback) {
		var searchEndpoint="/search/index/query/"+qry;
		$.ajax({
			url: searchEndpoint,
			method: 'get',
			success: function(data){
				callback( data );
			},
			failure: function(date){
				console.log(data);
			}
		});
	}
}