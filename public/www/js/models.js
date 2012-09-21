models = {
	Lesson : Backbone.Model.extend({
		defaults: {
			id: 0,
			category: "Other",
			resources: new Array(),
			owner: "",
			datecreated: new Date()
		}
	}),
	
	Resource : Backbone.Model.extend({
		defaults: {
			id: 0,
			document: "http://documentnotfound.com",
			description: "",
			title: ""
		}
	}),
	
	Teacher : Backbone.Model.extend({
		defaults: {
			id: 0,
			firstName: "",
			lastName: "",
			eMail: "",
			school: "",
			location: ""
		}
	}),
	
	ResourceComment : Backbone.Model.extend({
		defaults: {
			resourceid: 0,
			content: "",
			ratings: new Array()
		}
	}),
	
	LessonComment : Backbone.Model.extend({
		defaults: {
			lessonId: 0,
			content: "",
			ratings: new Array()
		}
	})
}
