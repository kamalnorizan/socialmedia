@extends('layouts.app')

@section('head')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.1.7/css/dataTables.dataTables.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/3.0.3/css/responsive.dataTables.css" />
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <table class="table" id="posttbl">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Title</th>
                    <th>Desc</th>
                    <th>Comments</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript" src="//cdn.datatables.net/2.1.7/js/dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/3.0.3/js/dataTables.responsive.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/3.0.3/js/responsive.dataTables.js"></script>

<script>
    var posttbl= $('#posttbl').DataTable({
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "ajax": {
            "type": "POST",
            "url": "{{ route('posts.ajaxloadposts') }}",
            "dataType": "json",
            "data": {
                _token: "{{ csrf_token() }}"
            },
            error: function(xhr, error, code) {
                if (xhr.status === 419) {
                    window.location.reload();
                } else {
                    console.error('An error occurred:', error);
                }
            }
        },
        "drawCallback": function(settings) {
            var api = this.api();
            var startIndex = api.context[0]._iDisplayStart;
            api.column(0, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function(cell, i) {
                cell.innerHTML = startIndex + i + 1;
            });
        },
        "columns": [{
                "data": null,
                "orderable": false
            },
            {
                "data": "title",
                "name": "title",
                "className": "editable"
            },
            {
                "data": "description",
                "name": "content"
            },
            {
                "data": "comments"
            },
            {
                "data": "action"
            },
        ]
    });

    posttbl.on('dblclick', 'tbody td.editable', function (e){
        $(this).html('<input type="text" class="form-control" value="'+$(this).text()+'">');
    });
</script>
@endsection
