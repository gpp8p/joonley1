@extends('layouts.jheader')


@section('content')
    <body>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <script language='javascript' type='text/javascript'>
        $(document).ready(function() {
            $("#regData").hide();
        });

        function myFunction(x) {
            alert("Row index is: " + x.id);
        }

        function getOneRegistrationRequest(clickedElement){
            $.ajax({
                /* the route pointing to the post function */
                url: '/getReg',
                type: 'GET',
                /* send the csrf-token and the input to the controller */
                data: {regId:clickedElement.id},
                dataType: 'json',
                /* remind that 'data' is the response of the AjaxController */
                success: function (data) {
                    $("#regData").show();
                    if(data['buysell_type']=='B'){
                        $("#buysell").html('Buyer');
                    }else{
                        $("#buysell").html('Seller');
                    }
                    if(data['roleselected']==1){
                        $("#role").html('Owner');
                    }else{
                        $("#role").html('Employee');
                    }
                    $("#fname").html(data['fname']);
                    $("#strname").html(data['strname']);
                    $("#lname").html(data['lname']);
                    $("#strwebsite").html(data['strwebsite']);
                    $("#email").html(data['email']);
                    $("#straddr1").html(data['straddr1']);
                    $("#phone").html(data['phone']);
                    $("#straddr2").html(data['straddr2']);
                    $("#comment").html(data['comment']);
                    $("#strcity").html(data['strcity']);
                    $("#strstate").html(data['strstate']);
                    $("#strzip").html(data['strzip']);
                    $("#country").html(data['country']);
                    $("#strid").html(data['strid']);
                    $("#strestab").html(data['strestab']);
                    $("#applicantId").val(data['id']);
                    $("#storeType").html(data['storeType']);
                },

                error: function (data) {
                    alert('error');
                }
            });
        }
    </script>

    <div class="header">
        @guest
            <span class="logright"><a class="loglink1" href="{{ route('login') }}">Log In</a></span>
            @else
                <div class="nav_icons">
                    <table border="0">
                        <tr>
                            @if($adminView)
                                <td class="icon_cell" onclick="event.preventDefault(); document.getElementById('admin-form').submit();"><i class="fa fa-cogs" aria-hidden="true"></i></td>
                            @endif
                            <td class="icon_cell" onclick="event.preventDefault(); document.getElementById('feed-form').submit();"><i class="fa fa-newspaper fa-1x" aria-hidden="true"></i></td>
                            <td class="icon_cell" onclick="event.preventDefault(); document.getElementById('order-form').submit();"><i class="fas fa-dollar-sign" aria-hidden="true"></i></td>
                            <td class="icon_cell" onclick="event.preventDefault(); document.getElementById('specials-form').submit();"><i class="fa fa-exclamation-circle fa-1x" aria-hidden="true"></i></td>
                            <td class="icon_cell" onclick="event.preventDefault(); document.getElementById('favorites-form').submit();"><i class="fas fa-heart" aria-hidden="true"></i></td>
                            <td class="icon_cell" onclick="event.preventDefault(); document.getElementById('search-form').submit();"><i class="fa fa-search fa-1x" aria-hidden="true"></i></td>
                            <td class="icon_cell" onclick="event.preventDefault(); document.getElementById('messages-form').submit();"><i class="fa fa-envelope-open fa-1x" aria-hidden="true"></i></td>
                            <td class="icon_cell" onclick="event.preventDefault(); document.getElementById('more-form').submit();"><i class="fa fa-ellipsis-h fa-1x" aria-hidden="true"></i></td>
                            <td class="icon_cell" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt 1x"></i></td>
                        </tr>
                        <tr>
                            @if($adminView)
                                <td align="center">Admin</td>
                            @endif
                            <td align="center">Feed</td>
                            <td align="center">Orders</td>
                            <td align="center">Specials</td>
                            <td align="center">Favs</td>
                            <td align="center">Search</td>
                            <td align="center">Message</td>
                            <td align="center">More</td>
                            <td align="center">Log Out</td>
                        </tr>
                    </table>
                </div>






            <!--            <span class="logright"><a href="{{ route('logout') }}" class="loglink1" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></span> -->

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                <form id="feed-form" action="{{ route('feed') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                <form id="order-form" action="{{ route('orders') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                <form id="specials-form" action="{{ route('specials') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                <form id="favorites-form" action="{{ route('favorites') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                <form id="search-form" action="{{ route('search') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                <form id="messages-form" action="{{ route('messages') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                <form id="more-form" action="{{ route('more') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                <form id="admin-form" action="{{ route('admin') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>

                @endguest

    </div>
    <div class="line2px"></div>
    <div class="content">
        <div class="menutable">
            <div class="menuitem1">First</div>
            <div class="menuitem1">Second</div>
            <div class="menuitem1">Third</div>
        </div>
        <div class="contentarea">
            <div id="pageContent">
                <div class="split left">
                    <table border="0" width="100%">
                        @foreach ($outstandingRegistrations as $thisRegistration)
                            <tr class="row1" id="{{$thisRegistration->id}}" onclick="getOneRegistrationRequest(this);">
                                <td class="col1">{{$thisRegistration->email}}</td>
                                <td class="col1">{{$thisRegistration->fname}}</td>
                                <td class="col1">{{$thisRegistration->lname}}</td>
                            </tr>
                        @endforeach
                    </table>
                    <div class="alignright">
                        {{ $outstandingRegistrations->links() }}
                    </div>
                </div>

                <div class="split right">
                    <div class="panelRight1">
                        <div id="regData">
                            <table border="0" width="100%">
                                <tr>
                                    <td width="50%">
                                        <div class="frmlabel">Buyer or Seller:</div>
                                        <div><span id="buysell" class="panelRightData">
                                    </span>
                                        </div>
                                    </td>
                                    <td width="50%">
                                        <div class="frmlabel">Role:</div>
                                        <div><span class="panelRightData" id="role">

                                    </span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="50%">
                                        <div class="frmlabel">First Name:</div>
                                        <div><span id="fname" class="panelRightData">
                                    </span>
                                        </div>
                                    </td>
                                    <td width="50%">
                                        <div class="frmlabel">Store:</div>
                                        <div><span class="panelRightData" id="strname">

                                    </span><br/>
                                            <span class="panelRightData" id="storeType">

                                    </span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="50%">
                                        <div class="frmlabel">Last Name:</div>
                                        <div><span id="lname" class="panelRightData">
                                    </span>
                                        </div>
                                    </td>
                                    <td width="50%">
                                        <div class="frmlabel">Store Website URL:</div>
                                        <div><span class="panelRightData" id="strwebsite">

                                    </span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="50%">
                                        <div class="frmlabel">Email:</div>
                                        <div><span id="email" class="panelRightData">
                                    </span>
                                        </div>
                                    </td>
                                    <td width="50%">
                                        <div class="frmlabel">Store Address:</div>
                                        <div><span class="panelRightData" id="straddr1">

                                    </span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="50%">
                                        <div class="frmlabel">Phone:</div>
                                        <div><span id="phone" class="panelRightData">
                                    </span>
                                        </div>
                                    </td>
                                    <td width="50%">
                                        <div class="frmlabel">Store Address 2:</div>
                                        <div><span class="panelRightData" id="straddr2">

                                    </span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="50%" rowspan="5">
                                        <div class="frmlabel">Comment:</div>
                                        <div><span id="comment" class="panelRightData">
                                    </span>
                                        </div>
                                    </td>
                                    <td width="50%">
                                        <div class="frmlabel">State:</div>
                                        <div><span class="panelRightData" id="strstate">

                                    </span>
                                        </div>

                                    </td>
                                </tr>
                                <tr>
                                    <td width="50%">
                                        <div class="frmlabel">Zip:</div>
                                        <div><span class="panelRightData" id="strzip">

                                    </span>
                                        </div>

                                    </td>
                                </tr>
                                <tr>
                                    <td width="50%">
                                        <div class="frmlabel">Country:</div>
                                        <div><span class="panelRightData" id="country">

                                    </span>
                                        </div>

                                    </td>
                                </tr>
                                <tr>
                                    <td width="50%">
                                        <div class="frmlabel">Reseller ID:</div>
                                        <div><span class="panelRightData" id="strid">

                                    </span>
                                        </div>

                                    </td>
                                </tr>
                                <tr>
                                    <td width="50%">
                                        <div class="frmlabel">Store Established:</div>
                                        <div><span class="panelRightData" id="strestab">

                                    </span>
                                        </div>

                                    </td>

                                </tr>






                            </table>
                            <div align="center">
                                <form method="POST" name="approveReg" action="{{ route('approveReg') }}">
                                    {{ csrf_field() }}
                                    <input type="submit" class="btn"  value="Approve This Registration As:">
                                    <select id="approveRole" name="approveRole">
                                        <option value="admin">Administrator</option>
                                        <option value="adminedit">Admin. Editor</option>
                                        <option value="adminmarket">Admin. Marketing</option>
                                        <option value="adminfeed">Admin. Feed</option>
                                        <option value="seller">Seller</option>
                                        <option value="buyerowner">Buyer-Owner</option>
                                        <option value="buyer">Buyer</option>
                                    </select>
                                    <input type="button" class="btn" value="Cancel" onclick="window.location.href ='{{ route('intro') }}';return false;"/>
                                    <input type="submit" class="btn"  value="Email This Applicant" />
                                    <input type="hidden" id="applicantId" name="applicantId" />
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    </body>

@endsection