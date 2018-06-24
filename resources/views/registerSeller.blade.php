@extends('layouts.jheader')


@section('content')

    <form method="POST" name="regSellerForm" action="{{ route('regSeller') }}">
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
                            <input id="email" type="text" class="frminput" name="email"  required>
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
                            <label for="passconfirm" class="frmlabel">Password (confirm):</label>
                            <input id="passconfirm" type="password" class="frminput"  name="password" required>
                        </div>
                        <div align="left">
                            <label for="comment" class = "frmlabel">Comment:</label>
                            <textarea class="frminputta" rows="10"  cols="30"></textarea>
                        </div>
                    </div>
                </td>
                <td width="50%">
                    <div class="frmentry">
                        <div>
                            <label for="strname" class = "frmlabel">Company Name:</label>
                            <input id="strname" type="text" class="frminput" name="strname"  required autofocus>
                        </div>
                        <div>
                            <label for="strwebsite" class = "frmlabel">Company Website:</label>
                            <input id="strwebsite" type="text" class="frminput" name="strwebsite"  required>
                        </div>
                        <div>
                            <label for="stradr1" class = "frmlabel">Company Address 1:</label>
                            <input id="stradr1" type="text" class="frminput" name="stradr1">
                        </div>
                        <div>
                            <label for="stradr2" class = "frmlabel">Company Address 2:</label>
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
                        <div align="left">
                            <input type="submit" class="btn"  value="Submit Application!">
                            <input type="button" class="btn" value="Cancel" onclick="window.location.href ='{{ route('intro') }}';return false;"/>
                        </div>
                    </div>
                </td>
            </tr>
        </table>

    </form>

@endsection