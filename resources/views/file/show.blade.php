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

                        @if($file)
                            <div class="d-flex flex-column">
                                <div id="download-area" class="p-2"><img width="400" src="{{  Storage::disk('public')->url($file->src) }}"></div>
                                <div class="p-2">{{$file->name}}</div>
                                <div class="p-2">{{$file->created_at}}</div>
                                <div class="p-2"><button onclick="downloadPNGImage(document.createElement('a'))" class="btn btn-danger">download image</button></div>
                            </div>
                            <script type="application/javascript">
                                function downloadPNGImage(linkElement) {
                                    var myDiv = document.getElementById('download-area');
                                    var myImage = myDiv.children[0];
                                    let downloadLink = myImage.src;
                                    linkElement.setAttribute('download', downloadLink);
                                    linkElement.href = downloadLink;
                                    linkElement.click();
                                }
                            </script>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
