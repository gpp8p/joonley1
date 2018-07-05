@extends('layouts.jheader')


@section('content')

    <form method="POST" name="regBuyerForm" action="{{ route('regBuyer') }}">
        <script language='javascript' type='text/javascript'>
            function checkId(input) {
                $.ajax({
                    /* the route pointing to the post function */
                    url: '/checkId',
                    type: 'GET',
                    /* send the csrf-token and the input to the controller */
                    data: {message:input.value},
                    dataType: 'json',
                    /* remind that 'data' is the response of the AjaxController */
                    success: function (data) {
                        input.setCustomValidity('');
                    },

                    error: function (data) {
                        input.setCustomValidity('Please try a different email This one is taken.');
                    }
                });
            }
            function check(input) {
                if (input.value != document.getElementById('password').value) {
                    input.setCustomValidity('Password Must be Matching.');
                } else {
                    // input is valid -- reset the error message
                    input.setCustomValidity('');
                }
            }
        </script>

        {{ csrf_field() }}
        <table class="table2col">
            <tr>
                <td width="50%">
                    <div class="frmentry">
                        <div align="left">
                            <label for="fname" class = "frmlabel">First Name:</label>
                            <input id="fname" type="text" class="frminput" name="fname"  required autofocus>
                        </div>
                        <div align="left">
                            <label for="lname" class = "frmlabel">Last Name:</label>
                            <input id="fname" type="text" class="frminput" name="lname"  required>
                        </div>
                        <div align="left">
                            <label for="email" class = "frmlabel">Email:</label>
                            <input id="email" type="email" class="frminput" name="email" onchange="checkId(this)" required>
                        </div>
                        <div align="left">
                            <label for="phone" class = "frmlabel">Phone:</label>
                            <input id="phone" type="text" class="frminput" name="phone"  required>
                        </div>
                        <div>
                            <label for="password" class="frmlabel">Password:</label>
                            <input id="password" type="password" class="frminput"  name="password" required>
                        </div>
                        <div>
                            <label for="password_confirm" class="frmlabel">Password (confirm):</label>
                            <input id="password_confirm" type="password" class="frminput"  name="password_confirm" oninput="check(this)" required>
                        </div>
                        <div align="left">
                            <label for="comment" class = "frmlabel">Comment:</label>
                            <textarea class="frminputta" id="comment" name="comment" rows="10"  cols="30"></textarea>
                        </div>
                    </div>
                </td>
                <td width="50%">
                    <div class="frmentry">
                        <div>
                            <label for="strname" class = "frmlabel">Store Name:</label>
                            <input id="strname" type="text" class="frminput" name="strname"  required autofocus>
                        </div>
                        <div>
                            <label for="roleSelect" class = "frmlabel">Your Role:</label>
                            <select id="roleSelect" name="roleSelect" class="selinput">
                                <option value="1">Owner</option>
                                <option value="2">Employee</option>
                            </select>
                        </div>
                        <div>
                            <label for="strwebsite" class = "frmlabel">Store Website:</label>
                            <input id="strwebsite" type="text" class="frminput" name="strwebsite"  required>
                        </div>
                        <div>
                            <label for="stradr1" class = "frmlabel">Store Address 1:</label>
                            <input id="stradr1" type="text" class="frminput" name="stradr1">
                        </div>
                        <div>
                            <label for="stradr2" class = "frmlabel">Store Address 2:</label>
                            <input id="stradr2" type="text" class="frminput" name="stradr2">
                        </div>
                        <div>
                            <label for="strcity" class = "frmlabel">City:</label>
                            <input id="strcity" type="text" class="frminput" name="strcity">
                        </div>
                        <div>
                            <select class="selinput" id="strstate">
                                <option value="">State</option>
                                <option value="AL">Alabama</option>
                                <option value="AK">Alaska</option>
                                <option value="AZ">Arizona</option>
                                <option value="AR">Arkansas</option>
                                <option value="CA">California</option>
                                <option value="CO">Colorado</option>
                                <option value="CT">Connecticut</option>
                                <option value="DE">Delaware</option>
                                <option value="DC">District Of Columbia</option>
                                <option value="FL">Florida</option>
                                <option value="GA">Georgia</option>
                                <option value="HI">Hawaii</option>
                                <option value="ID">Idaho</option>
                                <option value="IL">Illinois</option>
                                <option value="IN">Indiana</option>
                                <option value="IA">Iowa</option>
                                <option value="KS">Kansas</option>
                                <option value="KY">Kentucky</option>
                                <option value="LA">Louisiana</option>
                                <option value="ME">Maine</option>
                                <option value="MD">Maryland</option>
                                <option value="MA">Massachusetts</option>
                                <option value="MI">Michigan</option>
                                <option value="MN">Minnesota</option>
                                <option value="MS">Mississippi</option>
                                <option value="MO">Missouri</option>
                                <option value="MT">Montana</option>
                                <option value="NE">Nebraska</option>
                                <option value="NV">Nevada</option>
                                <option value="NH">New Hampshire</option>
                                <option value="NJ">New Jersey</option>
                                <option value="NM">New Mexico</option>
                                <option value="NY">New York</option>
                                <option value="NC">North Carolina</option>
                                <option value="ND">North Dakota</option>
                                <option value="OH">Ohio</option>
                                <option value="OK">Oklahoma</option>
                                <option value="OR">Oregon</option>
                                <option value="PA">Pennsylvania</option>
                                <option value="RI">Rhode Island</option>
                                <option value="SC">South Carolina</option>
                                <option value="SD">South Dakota</option>
                                <option value="TN">Tennessee</option>
                                <option value="TX">Texas</option>
                                <option value="UT">Utah</option>
                                <option value="VT">Vermont</option>
                                <option value="VA">Virginia</option>
                                <option value="WA">Washington</option>
                                <option value="WV">West Virginia</option>
                                <option value="WI">Wisconsin</option>
                                <option value="WY">Wyoming</option>
                            </select>
                        </div>
                        <div>
                            <label for="strzip" class = "frmlabel">Zipcode:</label>
                            <input id="strzip" type="text" class="frminput" name="strzip">
                        </div>
                        <div>
                            <label for="country" class = "frmlabel">Country:</label>
                            <input id="country" type="text" class="frminput" name="country">
                        </div>
                        <div>
                            <label for="strid" class = "frmlabel">Reseller Id:</label>
                            <input id="strid" type="text" class="frminput" name="strid">
                        </div>
                        <div>
                            <label for="strestab" class = "frmlabel">Established In:</label>
                            <select id="strestab" class="selinput">
                                <option>2018</option>
                                <option>2017</option>
                                <option>2016</option>
                                <option>2015</option>
                                <option>2014</option>
                                <option>2013</option>
                                <option>2012</option>
                                <option>2011</option>
                                <option>earlier</option>
                            </select>
                        </div>
                        <div>
                            <label for="strtype" class = "frmlabel">Store Type:</label>
                            <select id="strtype" name="strtype" class="selinput">
                                <option value ="rshop">Retail Shop - Brick and Mortar</option>
                                <option value ="online">Online Only</option>
                                <option value ="catalog">Catalog</option>
                                <option value ="popup">Pop-Up Retail</option>
                            </select>
                        </div>

                        <div align="left">
                            <input type="submit" class="btn"  value="Sign Up!">
                            <input type="button" class="btn" value="Cancel" onclick="window.location.href ='{{ route('intro') }}';return false;"/>
                        </div>
                    </div>
                </td>
            </tr>
        </table>

    </form>

@endsection