{% extends "system/layouts/dashboard.php" %}
{% block title %}Blast{% endblock %}
{% block head %}
    {{ parent() }}
{% endblock %}

{# header #}

{% block header %}

{% endblock %}

{# content #}

{% block content %}
    <h1>GENESIS</h1>
    <div id="jsGrid"></div>

    <script>

        var val = JSON.parse('{{ data|raw }}');

        /*
        $("#jsGrid").jsGrid({
            width: "100%",
            height: "400px",

            inserting: true,
            filtering: true,
            editing: true,
            sorting: true,
            paging: true,
            // verify if data is a single object or an array
            data: $.isArray(val) ? val : [val],

            fields: [
                { name: "name", title: "Name", type: "text", width: 50 },
                { name: "Apps", type: "select", items: $.isArray(val) ? val : [val], valueField: "id", textField: "name" },
                { type: "control" }
            ],

            loadData: function(filter) {
                return $.ajax({
                    type: "GET",
                    url: "/items",
                    data: filter,
                    dataType: "json"
                });
            },

            insertItem: function(item) {
                return $.ajax({
                    type: "POST",
                    url: "/items",
                    data: item,
                    dataType: "json"
                });
            },

            updateItem: function(item) {
                return $.ajax({
                    type: "PUT",
                    url: "/items",
                    data: item,
                    dataType: "json"
                });
            },

            deleteItem: function(item) {
                return $.ajax({
                    type: "DELETE",
                    url: "/items",
                    data: item,
                    dataType: "json"
                });
            }

        });
    */
    </script>



{% endblock %}

{# footer #}
{% block footer %}

<p><a href="http://fx.org/">By Filipe Fernandes</a></p>



{% endblock %}



