$(document).ready(function(){
    var table = $('#product-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: listURL,
            type: 'GET',
            data: function (d) {
                d.per_page = d.length;
                d.page = (d.start / d.length) + 1;
                d.column = d.order[0].name;
                d.sortdir = d.order[0].dir;
                d.search = d.search.value;
            },
            dataSrc: function(json) {
                    json.recordsTotal = json.meta.total;
                    json.recordsFiltered = json.meta.total;
                    return json.data;
                }
        },
        order: [[0, 'desc']],
        columnDefs: [
            { orderable: false, targets: [0,3,4] }, // Disables sorting 
        ],
       
        columns: [
            {data : 'id', name : 'id'},
            { data: 'name', name : 'name' },
            { data: 'price', name : 'price' },
            { data: 'description', name : 'description' },
            { 
                data: 'action',
                render: function (data, type, row) {
                    var Url = window.location.pathname+"/" + row.id;
                    var action = '<a href="'+Url+'" class="edit-user1 btn btn-sm btn-primary">Buy Now</a>';
                    return action;
                }
            }
        ],
        createdRow: function(row, data, dataIndex) {
            var pageInfo = table.page.info();
            $('td:eq(0)', row).html(pageInfo.start + dataIndex + 1);
           

            $(row).on('click', '.edit-user', (function() {
                console.log(data.id);
                $.ajax({
                    method: "GET",
                    url: window.location.pathname+"/" + data.id + "/edit",
                    success: function(response) {
                        console.log(response);                            
                        try {
                            $("#app-form").modal('show');
                        } catch (error) {
                            console.error('Error updating Model-Box:', error);
                        }
                    },
                    error: function(e) {
                        
                    }
                })
            }))
        }
    });
});