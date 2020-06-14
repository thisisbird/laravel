@extends('admin.layout.admin2')
@section('container')
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
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
                            <label for="{{$col}}">{{$col}}</label>
                            <textarea class="form-control" id="{{$col}}" name="{{$col}}" rows="3">{{ $data[$col] ?? old($col) }}</textarea>
                          </div>
                          @break
                      @default
                        <div class="form-group col-md-6">
                          <label for="inputState">State</label>
                          <select id="inputState" class="form-control">
                            <option selected>Choose...</option>
                            <option>...</option>
                          </select>
                        </div>
                  @endswitch
                @endforeach
              </div>
                @if($errors->first())
                    <span class="text-danger">{{$errors->first() ?? 'afaffaf'}}</span>
                @endif
              <button type="submit" class="btn btn-primary">Sign in</button>
            </form>
        </div>
@endsection
