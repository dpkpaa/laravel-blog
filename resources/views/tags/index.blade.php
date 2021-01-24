@extends('layouts.admin')

@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Tags</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Tags</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <section class="content">
      <div class="container-fluid">

      
<div class="card">
    <div class="card-header">
      <h3 class="card-title"><a href="{{ route('tags.create') }}" class="btn btn-sm btn-primary">Add Tag</a></h3>

      <div class="card-tools">
        <div class="input-group input-group-sm" style="width: 150px;">
          <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

          <div class="input-group-append">
            <button type="submit" class="btn btn-default">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
      <table class="table table-hover text-nowrap">
        <thead>
          <tr>
            <th>ID</th>
            <th>Created By</th>
            <th>Name</th>
            <th>Created At</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
            @foreach($tags as $tag)
            <tr>
                <td>{{$tag->id}}</td>
                <td>{{ $tag->user->name }}</td>
                <td>{{ $tag->name }}</td>
                <td>{{$tag->created_at}}</td>
                <td></td>
            </tr>
            @endforeach
          
        </tbody>
      </table>
      
    </div>
    
    <!-- /.card-body -->
    <div class="ml-auto mt-4 mr-3" >
        {!! $tags->links() !!}
    </div>
  </div>
  
</div>
</section>
@endsection