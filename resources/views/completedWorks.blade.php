@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Completed Works') }} <a href="{{route('home')}}" type="button" class="btn btn-primary btn-sm float-end">To-do List</a>
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Status</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($to_do_list as $list)
                                <tr>
                                    <th>{{$list->id}}</th>
                                    <td>{{$list->name}}</td>
                                    <td>
                                        <input type="checkbox" data-width="40" class="form-check-input"
                                               data-id="{{ $list->id }}" data-toggle="toggle" data-style="slow"
                                               data-onstyle="success" data-offstyle="danger" data-on=1
                                               data-off=0 {{ $list->status == true ? 'checked' : ''}}></td>
                                    <td>
                                        <button type="button" class="btn btn-outline-warning btn-sm">Edit</button>

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{$to_do_list->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

