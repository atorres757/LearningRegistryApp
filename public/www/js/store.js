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
	query: function(qryObj) {
		return false;
	}
}