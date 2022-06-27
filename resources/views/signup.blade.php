@extends('adminLayout')
@section('content')

<center>
    <h2>Customer Registration</h2>

    <table class="table table-bordered" style="width: 500px;">
    <form action="{{ route('signupSub') }}" method="post" enctype="multipart/form-data">
    {{@csrf_field()}}

        <tr>
            <td>Name:</td>
            <td>
                <input type="text" placeholder="Enter Your Name" name="name"  value="{{old('name')}}"  style="width: 330px">
            </td>
        </tr>
        @error('name')                
            <tr class="table-danger">
                <td colspan = "2">
                    <center>{{$message}}</center>
                </td>
            </tr>
        @enderror


        <tr>
            <td>Phone:</td>
            <td>
                <input type="number" placeholder="Enter Your Phone Number" name="phone"  value="{{old('phone')}}" style="width: 330px">
            </td>
        </tr>
        @error('phone')
            <tr class="table-danger">
                <td colspan = "2">
                    <center>{{$message}}</center>
                </td>
            </tr>
        @enderror


        <tr>
            <td>Email:</td>
            <td>
                <input type="email" placeholder="Enter Your Email Address" name="email"  value="{{old('email')}}" style="width: 330px">
            </td>
        </tr>
            @error('email')
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


        <tr>
            <td>Confirm Password:</td>
            <td>
                <input type="password" placeholder="Confirm Your Password" name="confirm_password"  value="{{old('confirm_password')}}" style="width: 330px">
            </td>
        </tr>
        @error('confirm_password')
            <tr class="table-danger">
                <td colspan = "2">
                    <center>{{$message}}</center>
                </td>
            </tr>
        @enderror


        <tr>
                <td>Image:</td>
                <td>
                    <input type="file" name="file" class="form-control" value="{{old('file')}}" style="width: 330px">
                </td>
        </tr>
        @error('file')
            <tr class="table-danger">
                <td colspan = "2">
                    <center>{{$message}}</center>
                </td>
            </tr>
        @enderror


        <tr>
                <td>Address:</td>
                <td>
                    <!-- <input type="text" placeholder="Enter Product Description" name="desc"> -->
                    <textarea  placeholder="Enter Your Address" name="address" style="resize: none; height: 85px; width: 330px;" ></textarea>
                </td>
        </tr>        
        @error('address')
            <tr class="table-danger">
                <td colspan = "2">
                    <center>{{$message}}</center>
                </td>
            </tr>
        @enderror

        <tr><td colspan="2"><center><input type="submit" value = "Register Now" class="btn btn-primary mb-2" style="width: 160px"></center></td></tr>
        
    </form>

    

    </table>

</center>

@endsection
