@extends('admin.layout.admin2')
@section('container')
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">{{$title}}</h1>
<p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
      {{-- <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6> --}}
      <a href="{{$redirect}}/create" class="btn btn-primary btn-icon-split">
        <span class="icon text-white-50">
          <i class="fas fa-plus"></i>
        </span>
        <span class="text">create</span>
      </a>
      <span class="text-success">{{session('msg') ?? ''}}</span>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              @foreach ($cols as $col=>$type)
                <th>{{$col}}</th>
              @endforeach
                <th>tool</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($datas as $data)
              <tr>
                @foreach ($cols as $col=>$type)
                  <td>{!!@$data[$col]!!}</td>
                @endforeach
                <td>
                  <a href="{{$redirect}}/update/{{$data['id']}}" class="btn btn-warning btn-circle btn-sm">
                    <i class="fas fa-pen"></i>
                  </a>
                  <a href="#" class="btn btn-danger btn-circle btn-sm" onclick="del(this,{{$data['id']}})">
                    <i class="fas fa-trash"></i>
                  </a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
@section('footjs')
<!-- Page level plugins -->
<script src="/admin2/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="/admin2/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="/admin2/js/demo/datatables-demo.js"></script>    
<script>

function del(obj,id) { 
  var msg = "您真的確定要刪除嗎？\n\n請確認！"; 
  if (confirm(msg)==true){ 
    $.ajax({
        method: 'post',
        data: {
            "_token" : "{{ csrf_token() }}",
            "_method": 'DELETE',
        },
        url: '{{$redirect}}/delete/'+id,
        success: function (data) {
            console.log("Success", data);
            if (data['status'] == true) {
                $(obj).closest('tr').fadeOut('slow');
            }
            // alert(data['msg']);
        },
        error: function (data) {
            console.log("Error", data);
        }
    });
  }else{ 
    return false; 
  } 
} 
    

</script>
@endsection