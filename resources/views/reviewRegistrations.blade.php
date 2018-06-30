@extends('layouts.jheader')


@section('content')
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
                },

                error: function (data) {
                    alert('error');
                }
            });
        }
    </script>
    <div>
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
                                <div class="frmlabel">First Name:</div>
                                <div><span id="fname" class="panelRightData">
                                    </span>
                                </div>
                            </td>
                            <td width="50%">
                                <div class="frmlabel">Store:</div>
                                <div><span class="panelRightData" id="strname">

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
                            <select id="approveRole">
                                <option value="admin">Administrator</option>
                                <option value="adminedit">Admin. Editor</option>
                                <option value="seller">Seller</option>
                                <option value="buyer">Buyer</option>
                            </select>
                            <input type="button" class="btn" value="Cancel" onclick="window.location.href ='{{ route('intro') }}';return false;"/>
                            <input type="submit" class="btn"  value="Email This Applicant">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection