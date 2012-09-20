var searchResults = function () {
    var Property = Backbone.Model.extend({
        defaults: {
            id: 0,
            name: "Test Apt",
            city: "Norfolk",
            state: "VA",
            image: "http://images.forrent.com/sites/frcMobile/design/image-missing.jpg"
        }
    });

    var List = Backbone.Collection.extend({
        model: Property
    });

    var ListView = Backbone.View.extend({
        el: $("#resultsList"),
        initialize: function () {
            _.bindAll(this, "render", "appendProp");

            this.collection = new List();
            this.collection.bind("add", this.appendProp);

            this.render();
        },
        render: function () {
            // $(this.el).append("<li>Hello, world!</li>");
            localStorage.setItem("resultsUrl", window.location);
            _(results.Results).each(function (prop) {
                //console.log(JSON.stringify(prop));
                localStorage.setItem(prop.property_id, JSON.stringify(prop))

                var item = new Property();
                item.set("id", prop.property_id);
                item.set("name", prop.property_name);
                item.set("image", prop.main_image);
                item.set("city", prop.city);
                item.set("state", prop.state);
                this.collection.add(item);
            }, this);

        },
        appendProp: function (property) {

            var li = $("<li />");
            var link = $("<a />").attr("href", "detailsPage.html?id=" + property.get("id"));
            var image = $("<img />").attr("src", property.get("image"));
            var propName = $("<h3>" + property.get("name") + "</h3>");
            var addr = $("<p>" + property.get("city") + ", " + property.get("state") + "</p>");
           
            link.append(image).append(propName).append(addr);
            li.append(link);
            $(this.el).append(li);
            //console.log(property.get("city") + property.get("state") + property.get("name") + property.get("image"));
        }
    });

    var list = new ListView();
};

$('#resultsmainpage').live('pagecreate', function (event, ui) {
    var results = new searchResults();
});