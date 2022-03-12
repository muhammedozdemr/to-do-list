@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('To-Do List') }} <a href="{{route('completedWorks')}}" type="button" class="btn btn-primary btn-sm float-end">Completed Works</a></div>

                    <div class="card-body">
                        <div class="input-group mb-3">
                            <input type="text" id="new_task" class="form-control" placeholder="Add New Task" aria-label="Add New Task"
                                   aria-describedby="button-addon2">
                            <button class="btn btn-outline-primary add-task" type="button">Add</button>
                        </div>

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
                                    <td>{{$list->name}} <div class="input-group mb-3 mt-2 edit-task-input">
                                            <input type="text" class="form-control taskValue" data-id="{{ $list->id }}">
                                            <button class="btn btn-outline-primary taskSave" type="button">Save</button>
                                        </div></td>
                                    <td>
                                        <input type="checkbox" data-width="40" class="form-check-input"
                                               data-id="{{ $list->id }}" data-toggle="toggle" data-style="slow"
                                               data-onstyle="success" data-offstyle="danger" data-on=1
                                               data-off=0 {{ $list->status == true ? 'checked' : ''}}></td>
                                    <td>
                                        <button type="button" class="btn btn-outline-warning btn-sm edit-task">Edit</button>
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
        $(".add-task").on('click',function (e) {
            var new_task = $('#new_task').val();
            const CSRF_TOKEN = $('meta[name="csrf-token"]:eq(0)').attr('content');
            $.ajax({
                type: 'POST',
                dataType: 'JSON',
                url: '/insertData',
                data: {
                    'new_task': new_task,
                    _token: CSRF_TOKEN
                },
                success:function(data) {
                    swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Yeni Görev Eklendi',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function () {
                        location.reload();
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

        $('.edit-task-input').hide();
        $('tbody').each(function (i, data) {
            $('.edit-task').on('click', function (e) {
                e.preventDefault();
                $(this).closest('tr').find('.edit-task-input').toggle();
            });

            $(".taskSave").on('click',function (e) {
                e.preventDefault();
                var value = $(this).closest('.edit-task-input').find('.taskValue').val();
                var id = $(this).closest('.edit-task-input').find('.taskValue').data('id')
                const CSRF_TOKEN = $('meta[name="csrf-token"]:eq(0)').attr('content');
                $.ajax({
                    type: 'POST',
                    dataType: 'JSON',
                    url: '/editData',
                    data: {
                        'value': value,
                        'id': id,
                        _token: CSRF_TOKEN
                    },
                    success:function(data) {
                        swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Görev Düzenlendi',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function () {
                            location.reload();
                        })
                    }
                });
            });
        });

    });
</script>
