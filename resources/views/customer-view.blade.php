<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport"content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

        <!-- Bootstrap CSS v5.2.1 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    </head>
    

    <body>
        <nav class="nav justify-content-center">
            <a class="nav-link active" href="{{url('/')}}" aria-current="page">Home</a>
            <a class="nav-link" href="{{url('/customer/create')}}">Form</a>
            <a class="nav-link" href="{{url('/customer/view')}}">Table</a>
        </nav>
        <div class="table-responsive">
            <table class="table table-primary">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Email</th>
                        <th scope="col">Name</th>
                        <th scope="col">Password</th>
                        <th>Action </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $customer )
                    <tr class="">
                        <td scope="row">{{$customer->id}}</td>
                        <td>{{$customer->email}}</td>
                        <td>{{$customer->name}}</td>
                        <td>{{$customer->password}}</td>
                        <td>
                            <a href="{{url('/customer/delete')}}/{{$customer->id}}"><button class="btn btn-danger">Delete</button></a> 
                            <a href="{{url('/customer/edit')}}/{{$customer->id}}"><button class="btn btn-primary"> Edit</button></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
    </body>
</html>
