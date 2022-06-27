@extends('adminLayout')
@section('content')

<center>
    <h2>Customer Login</h2>

    <table class="table table-bordered" style="width: 500px;">
    <form action="{{ route('signinSub') }}" method="post" enctype="multipart/form-data">
    {{@csrf_field()}}

        <tr>
            <td>Email or Phone:</td>
            <td>
                <input type="text" placeholder="Enter Your Email or Phone" name="info"  value="{{old('info')}}"  style="width: 330px">
            </td>
        </tr>
        @error('info')                
            <tr class="table-danger">
                <td colspan = "2">
                    <center>{{$message}}</center>
                </td>
            </tr>
        @enderror


        <tr>
            <td>Password:</td>
            <td>
                <input type="password" placeholder="Enter Your Password" name="pass_word"  value="{{old('pass_word')}}" style="width: 330px">
            </td>
        </tr>
        @error('pass_word')
            <tr class="table-danger">
                <td colspan = "2">
                    <center>{{$message}}</center>
                </td>
            </tr>
        @enderror

        <tr><td colspan="2"><center><input type="submit" value = "Sign In" class="btn btn-primary mb-2" style="width: 160px"></center></td></tr>
        
    </form>

    

    </table>

</center>

@endsection
