<head>
    <style>
        #success{
          background-color: rgb(51, 185, 122);
          color: black;
          border: 2px solid rgb(0, 0, 0);
          padding: 5px 10px;
          text-align: center;
          text-decoration: none;
          display: inline-block;
        }
        
        #success a:hover, a:active {
          background-color: rgb(40, 92, 66);
          color: white;
        }

        #danger{
          background-color: rgb(240, 136, 136);
          color: black;
          border: 2px solid rgb(0, 0, 0);
          padding: 5px 10px;
          text-align: center;
          text-decoration: none;
          display: inline-block;
        }
        
        #danger :hover, :active {
          background-color: rgb(136, 13, 13);
          color: white;
        }
    </style>
</head>

<h3 style="display: inline;">
Good Day {{ $name }}, <br>
Welcome to GNT Grocery. Please Enter</h3> <h2 style="display: inline;">{{ $verification }}</h2> <h3 style="display: inline;">as your verification code. Or click the below button. <br>

<center><a id="success" href="{{ route('verifyMail', [encrypt($id), $verification]) }}">&#10003; Yes, It's Me.</a></center> <br><br>
If you think this mail is sent to you mistakenly. please click below button. <br>
<center><a id="danger" href="{{ route('deleteVerifyMail', encrypt($id)) }}" role="button"> &#10060; No, It's NOT Me.</a></center> <br><br>
Best Regards, <br>
GNT Grocery Team
</h3>
            




        