@extends('admin.layout.admin2')
@section('container')
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <a href="#" class="btn btn-primary btn-icon-split btn-sm" onclick="window.history.back()">
              <span class="icon text-white-50">
                <i class="fas fa-arrow-left"></i>
              </span>
              <span class="text">上一頁</span>
            </a>
            <h1 class="h3 mb-0 text-gray-800">{{$title}}</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
          </div>

          <!-- Content Row -->
            <form action="" method="POST">
              @csrf
              <div class="form-row">
                @foreach ($cols as $col => $type)
                  @switch($type)
                      @case('text')
                          <div class="form-group col-md-6">
                            <label for="{{$col}}">{{$col}}</label>
                            <input type="{{$type}}" class="form-control" id="{{$col}}" placeholder="{{$col}}" name="{{$col}}" value="{{ $data[$col] ?? old($col) }}">
                          </div>
                          @break
                      @case('number')
                          <div class="form-group col-md-6">
                            <label for="{{$col}}">{{$col}}</label>
                            <input type="{{$type}}" class="form-control" id="{{$col}}" placeholder="{{$col}}" name="{{$col}}" value="{{ $data[$col] ?? old($col) }}">
                          </div>
                          @break
                      @case('checkbox')
                          <div class="form-group col-md-12">
                            <div class="form-check">
                              <input type="hidden" name="{{$col}}" value="0">
                              <input class="form-check-input" type="checkbox" id="{{$col}}" name="{{$col}}" value="1" {{@$data[$col] == 1 ? 'checked' : (old($col) == 1? 'checked' : '')}}>
                              <label class="form-check-label" for="{{$col}}">{{$col}}</label>
                            </div>
                          </div>
                          @break
                      @case('textarea')
                          <div class="form-group col-md-12">
                            <label for="summernote">{{$col}}</label>
                            <textarea id="summernote" class="form-control" name="{{$col}}" rows="3">{!! $data[$col] ?? old($col) !!}</textarea>
                          </div>
                          @break
                      @case('option')
                          <div class="form-group col-md-6">
                            <label for="inputState">{{$col}}</label>
                            <select id="inputState" class="form-control" name="{{$col}}">
                              @foreach ($model->colOption($col) as $key => $option)
                                <option {{@$data[$col] === $key ? 'selected' : (old($col) === $key? 'selected' : '')}} value="{{$key}}">{{$option}}</option>
                              @endforeach
                            </select>
                          </div>
                          @break
                      @default
                        
                  @endswitch
                @endforeach
              </div>
                @if($errors->first())
                    <span class="text-danger">{{$errors->first() ?? ''}}</span>
                @endif
              <button type="submit" class="btn btn-primary">go</button>
            </form>
        </div>
@endsection
@section('footjs')
<link href="/admin2/css/summernote.min.css" rel="stylesheet">
<script src="/admin2/js/summernote.min.js"></script>
<script src="/admin2/css/lang/summernote-zh-TW.js"></script> <script>
      $(document).ready(function() {


        $('#summernote').summernote(
          { height: 300,
            lang: 'zh-TW', // default: 'en-US'
            // minHeight: null,             // set minimum height of editor
            // maxHeight: null,             // set maximum height of editor
            // focus: true,
            callbacks: {
              onImageUpload: function(files) {
                  console.log(files);
                  imageUpload(files).done((data, textStatus, jqXHR)=>{
                    let url = "/uploads/"+data.imageUrl
                    $('#summernote').summernote('insertImage', url, 'newimage');
                  })
              },
            }
          });

          function imageUpload(files){
          let formData = new FormData();
          formData.append('upload', files[0]);
            return $.ajax({
                    type: "POST", 
                    url: '/admin/upload',
                    data:formData,
                    beforeSend: function(xhr) {xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'))},
                    cache       : false,
                    contentType : false,
                    processData : false,
              
                  });
        }
      });
    </script>
@endsection