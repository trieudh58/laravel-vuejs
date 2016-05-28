@extends('main.app')

@section('main_content')
<div class="container" id="main">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form method="post" action="{{ url('/todos/create') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="todo-name">Name</label>
                            <input v-model="todo.name" type="text" class="form-control" name="name" placeholder="What are you about to do?" autofocus>
                        </div>
                        <div class="form-group">
                            <label for="todo-description">Description</label>
                            <input v-model="todo.description" type="text" class="form-control" name="description" placeholder="Describe it...">
                        </div>
                        <button v-on:click.prevent="save" type="submit" class="btn btn-primary pull-right">Save</button>
                    </form>
                </div>
            </div>
            <div v-for="todo in todos" class="list-group">
                <div class="list-group-item">
                    <h3 class="list-group-item-heading">
                        @{{ todo.name }}
                    </h3>
                    <div class="list-group-item-text">
                        @{{ todo.description }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('partial_script')
    <script>
        var name = '', description = '';
        var csrf_token = $('input[name="_token"]').attr('value');
        var vm = new Vue({
            el: '#main',
            data: {
                todo: {
                    name: name,
                    description: description
                },
                todos : [],
                returnedTodo: {}
            },
            ready: function () {
                $.getJSON('/todos/get', function (todos) {
                    this.todos = todos;
//                    console.log(todos);
                }.bind(this));
            },
            watch : {
                returnedTodo: function (val) {
                   this.todos.unshift(JSON.parse(val));
//                   console.log(val);
//                   console.log(this.todos);
                },
                todos: function (val) {
                    console.log(val);
//                    this.todos = JSON.parse(val);
                }
            },
            methods: {
                save: function () {
                    $.ajax({
                        url: '/todos/create',
                        type: 'post',
                        data: {
                            _token: csrf_token,
                            name: this.todo.name,
                            description: this.todo.description
                        },
                        success: function (returnedTodo) {
                            this.returnedTodo = returnedTodo;
                            console.log(JSON.parse(returnedTodo));
                        }.bind(this)
                    });
                }
            }
        });
    </script>
@endsection