renderer = function(obj, tmpl) {
	var el = tmpl.join("");
	$(el).find(".fill").each {
		function(){
			var value = obj.get($(this).attr("id"));
			if(value !== undefined) {
				
				$(this).text( value );
			}
		}
	}
}