@extends('layouts.global')

@section('content')
    <p class="h3">{{ __('messages.file') }}
        <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#Modal">
            {{__('messages.add')}}
        </button>
    </p>
    <p>{{__('messages.only_files')}}.</p>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">{{ __('messages.url') }}</th>
            <th scope="col">{{__('messages.actions')}}</th>

        </tr>
        </thead>
        <tbody>
        @foreach($files as $files)
            <tr>
                <td>{{$files->id}}</td>
                <td><a href="../storage/files/{{$files->link}}" target="_blank">{{$files->link}}</a></td>
                <td>
                    <form method="POST" action="{{ route('files_delete', ['id' => $files->id]) }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Confirm delete?')"><i class="fa-solid fa-trash"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>



    <div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{__('messages.add')}}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3" action="{{route('files_upload')}}" method="POST" enctype="multipart/form-data" >
                        @csrf

                        <div class="md-3">
                            <label for="text" class="form-label">{{__('messages.only_name')}}</label>
                            <input type="text" class="form-control" id="name" name="name" aria-describedby="text" required>
                        </div>
                        <div class="md-3">
                            <label for="text" class="form-label">{{__('messages.file')}}</label>
                            <input type="file" class="form-control" id="file" name="file" aria-describedby="text" required>
                        </div>


                        <div class="col-12">
                        <button type="submit" class="btn btn-dark">{{__('messages.send')}}</button>
                        </div>
                    </form>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('messages.close')}}</button>
                </div>
            </div>
        </div>
    </div>
@endsection
