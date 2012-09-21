var search = function () {
	var List = Backbone.Collection.extend({
		model: models.Lesson
	});
	
//	var ListView = Backbone.View.extend({
//		el: $("#results"),
//		initialize: function() {
//			_.bindAll(this);
//			
//			this.collection = new List();
//			this.collection.bind("add", this.appendLesson);
//			this.render();
//		}
//	});
}
