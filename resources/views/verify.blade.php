@extends('adminLayout')
@section('content')

<center>
    <h2>Account Verify</h2>

    <table class="table table-bordered" style="width: 600px;">
    <form action="{{ route('verifySub') }}" method="post">
    {{@csrf_field()}}

        <tr>
            <td>One Time Password:</td>
            <td>
                <input type="hidden" value="{{ $id }}" name="id">
                <input type="text" placeholder="Enter 6 Digit OTP" name="otp" style="width: 300px;">
            </td>
        </tr>
        
        @error('otp')                
            <tr class="table-danger">
                <td colspan = "2">
                    <center>{{$message}}</center>
                </td>
            </tr>
        @enderror
        

        <tr><td colspan="2"><center><input type="submit" value = "Verify" class="btn btn-primary mb-2" style="width: 160px"></center></td></tr>
        
    </form>

    

    </table>

</center>

@endsection
