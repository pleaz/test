@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {!! session('status') !!}
                            </div>
                        @endif

                        @if($files)
                            @foreach($files as $file)
                                    <div class="d-flex flex-row">
                                        <div class="p-2"><img width="100" src="{{  Storage::disk('public')->url($file->src) }}"></div>
                                        <div class="p-2">{{$file->name}}</div>
                                        <div class="p-2">
                                            <form action="{{route('file.destroy', ['file' => $file->id])}}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-danger">delete</button>
                                            </form>
                                        </div>
                                    </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
