<!DOCTYPE html>
<html lang="en">

<head>
    <title>GNT Grocery Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css"/>
    <style>
        .dropdown .dropbtn {
      font-size: 16px;
      border: none;
      outline: none;
      color: rgb(0, 0, 0);
      /* padding: 14px 16px; */
      background-color: inherit;
      font-family: inherit; /* Important for vertical align on mobile phones */
      margin: 0; /* Important for vertical align on mobile phones */
    }
    
    /* Add a red background color to navbar links on hover */
    .navbar a:hover, .dropdown:hover .dropbtn {
                  background-color: rgb(228, 228, 228);
                  transform: scale(1.04);}
    
    /* Dropdown content (hidden by default) */
    .dropdown-content {
      display: none;
      position: absolute;
      background-color: #f9f9f9;
      min-width: 180px;
      box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
      z-index: 1;
    }
    
    /* Links inside the dropdown */
    .dropdown-content a  {
      float: none;
      color: black;
      /* padding: 12px 16px; */
      text-decoration: none;
      display: block;
      text-align: left;
    }
    
    /* Add a grey background color to dropdown links on hover */
    .dropdown-content a:hover {
      background-color: #ddd;
    }
    
    /* Show the dropdown menu on hover */
    .dropdown:hover .dropdown-content {
      display: block;
    }
    </style>
</head>

<body>
<div style="position: fixed; width: 100%; z-index: 1000;">
    <nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('allProduct')}}"><i class="bi bi-list-check"></i> All Products &emsp;</a>
                </li>
            @if(Session()->get('usertype') == "admin")
                <li class="nav-item">
                    <a class="nav-link" href="{{route('addProduct')}}"><i class="bi bi-node-plus-fill"></i> Add Product &emsp;</a>
                </li>
            @endif
            @if(Session()->has('id'))
                <li class="nav-item">
                    <a class="nav-link" href="{{route('sellProduct')}}"><i class="bi bi-cart-check-fill"></i> Sell Product &emsp;</a>
                </li>
            @endif
            @if(Session()->get('usertype') == "admin")
                <li class="nav-item">
                    <a class="nav-link" href="{{route('invoices')}}"><i class="bi bi-list-task"></i> Invoices &emsp;</a>
                </li>
            @elseif(Session()->get('usertype') == "customer")
            <li class="nav-item">
                <a class="nav-link" href="{{route('invoices')}}"><i class="bi bi-list-task"></i> Invoices Customer &emsp;</a>
            </li>
            @endif
            @if(Session()->get('usertype') == "admin")
                <li class="nav-item">
                    <a class="nav-link" href="{{route('restockProduct')}}"><i class="bi bi-bag-plus-fill"></i> Restock Product &emsp;</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('invoicesDataTable')}}"><i class="bi bi-list-stars"></i> Invoices DataTable &emsp;</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('stat')}}"><i class="bi bi-file-bar-graph-fill"></i> Stat &emsp;&emsp;&emsp;&emsp;</a>
                </li>
            @endif
            
            
        </ul>
        </div>

        <div class="topnav-right collapse navbar-collapse" id="navbarNav" style="right:0px; position: absolute;">
        @if(Session()->has('id'))
        
        



        <div class="dropdown" style="right: 10px">
            <button class="dropbtn"> 
                <table>
                    <td width="30px" height="30px">
                        <img src="{{asset('public/profile images/'.Session::get('image'))}}" height="30px" alt="image">
                    </td>
                    <td width="140px" height="30px" style="text-align: left;">
                        {{Session::get('name')}}   
                    </td>    
                </table>
            </button>

            <div class="dropdown-content">
                <a href="#"><i class="bi bi-person-square"></i> My Profile(remain)</a>
                <a href="#"><i class="bi bi-person-check-fill"></i> Edit Profile(remain)</a>
                <a href="{{route('signout')}}"><i class="bi bi-person-x-fill"></i> Sign Out(Use Modal)</a>
            </div>
      </div>




            {{-- <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('signout')}}"><i class="bi bi-person-x-fill"></i> Sign Out(Use Modal) &emsp;</a>
                </li>
            </ul> --}}
        @else
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('signup')}}"><i class="bi bi-person-plus-fill"></i> Sign Up &emsp;</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('signin')}}"><i class="bi bi-person-lines-fill"></i> Sign In &emsp;</a>
                </li>
            </ul>
        @endif
        </div>

    </div>
    </nav>
</div> <br><br><br>

    <div class="container">
        @yield('content')
    </div>


   

</body>
</html>



{{-- Session()->get('id') == 2 --}}