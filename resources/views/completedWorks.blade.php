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
                                        @include('partials.buttons.delete-btn', ['url' => route('delete', ['id' => $list->id])])
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.4/dist/sweetalert2.all.min.js"></script>
<script>
    $(function () {
        $('.delete-btn').on('click', function () {
            const CSRF_TOKEN = $('meta[name="csrf-token"]:eq(0)').attr('content');
            const btn = $(this);
            const title = btn.data('title') || "Are you sure?";
            const text = btn.data('text') || "This can not be undone";
            const yes = btn.data("yes") || "Yes";
            const no = btn.data("no") || "No";
            const url = btn.data("url");
            Swal.fire({
                title,
                text,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: yes,
                cancelButtonText: no
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "post",
                        url,
                        data: {
                            _token: CSRF_TOKEN
                        },
                        success: (response) => {
                            swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            ).then(function () {
                                location.reload();
                            })
                        }
                    })
                }
            });
        });

        $('.form-check-input').on('change', function() {
            var status = $(this).prop('checked') == true ? 1 : 0;
            var id = $(this).data('id');
            console.log(id);
            const CSRF_TOKEN = $('meta[name="csrf-token"]:eq(0)').attr('content');
            $.ajax({
                type: 'POST',
                dataType: 'JSON',
                url: '/changeStatus',
                data: {
                    'status': status,
                    'id': id,
                    _token: CSRF_TOKEN
                },
                success:function(data) {
                    swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Status Change Made',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function () {
                        location.reload();
                    })
                }
            });
        });
    });
</script>

