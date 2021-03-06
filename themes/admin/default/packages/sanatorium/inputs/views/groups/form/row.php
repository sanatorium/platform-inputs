<script type="text/html" id="form">


    <% _.each(settings, function(row, index) { %>

        <%= _.template( $('#formRow').html() )( {
            fields: row.fields,
            cols: row.fields.length
        } ) %>

    <% }); %>


</script>

<script type="text/html" id="formRow">

    <div class="row form-row" data-row>
    <% _.each(fields, function(item, index) { %>

        <div class="col col-sm-<%= 12/cols %>" data-col>

            <% if ( typeof item.fields != 'undefined' ) { %>

                <%= _.template( $('#formRow').html() )( {
                    fields: item.fields,
                    cols: item.fields.length
                } ) %>

            <% } else { %>

                <%= _.template( $('#formField').html() )( {
                    item: item,
                    index: index
                } ) %>

            <% } %>

        </div>

    <% }); %>

        <button type="button" class="delete-row btn btn-danger">
            <i class="fa fa-minus"></i>
        </button>

    </div>

</script>

<script type="text/html" id="formField">

    <% if ( typeof item.name != 'undefined' && item.attribute != 'undefined' ) { %>
    <div class="panel panel-default" data-name="<%= item.name %>" data-attribute="<%= item.attribute %>">
        <div class="panel-heading">
            <input type="checkbox" data-toggle="tooltip" title="required" class="pull-right"
            <%
            if ( typeof item.required != 'undefined' ) {
                if ( item.required == 1 ) {
                    %>
                    checked="checked"
                    <%
                }
            }
            %> data-required>
            <%= item.name %> <small class="text-muted"><%= item.attribute %></small>
        </div>
    </div>
    <% } else { %>
    <div class="dropzone">

    </div>
    <% } %>

</script>
