models = {
	Plan : function (){
		this.type = "Lesson",
		this.id = 0,
		this.category = "Math",
		this.resources = new Array(),
		this.owner = "Vamsi Vidala",
		this.datecreated = new Date()
	},
	
	Resource : function (){
		this.type = "Resource",
		this.id = 0,
		this.document = "http://documentnotfound.com",
		this.description = "",
		this.title = ""
	},
	
	Teacher : function (){
		this.type = "Teacher",
		this.id = 0,
		this.firstName = "",
		this.lastName = "",
		this.eMail = "",
		this.school = "",
		this.location = ""
	},
	
	ResourceComment : function (){
		this.type = "ResourceComment",
		this.resourceid = 0,
		this.content = "",
		this.ratings = new Array()
	},
	
	PlanComment : function (){
		this.type = "PlanComment"
		this.lessonId = 0,
		this.content = "",
		this.ratings = new Array()
	}
}
