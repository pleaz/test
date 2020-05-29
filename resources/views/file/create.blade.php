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

                        @if($errors->any())
                            {!! implode('', $errors->all('<div class="alert alert-warning">:message</div>')) !!}
                        @endif

                            <form method="post" action="{{route('file.store')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="file">Upload your file</label>
                                    <input type="file" name="file" class="form-control-file" id="file">
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
