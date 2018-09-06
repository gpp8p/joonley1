<style>
    .fillFrame{
        background-color: #eeeeee;
        height:100%;
        width:100%;
    }
    .editTitle{
        font-size: 32px;
        color:black;
        font-family: 'Fira Sans Condensed', sans-serif;
        text-align: center;
        padding-top: 5px;
    }

    .content_row{
        display: grid;
        grid-template-columns:20% 80%;
        padding:5px;
        margin-left: 10px;
    }
    .explained_label{
        display: grid;
        grid-template-rows: repeat(auto-fill, minmax(30px,0.5fr));
    }
    .accross3{
        display:grid;
        grid-template-columns: 30% 30% 30%;
    }
    .lab{
        font-size: 15px;
        font-family: 'Fira Sans Condensed', sans-serif;
        font-weight: 400;
        color: black;
    }
    .explaination{
        font-size: 10px;
        font-family: 'Fira Sans Condensed', sans-serif;
        font-weight: normal;
        margin-right: 5px;
        color: black;
    }
    .wide_input_field{
        font-size: 18px;
        margin-top: 15px;
    }

    .selinput {
        width: 50%;
        font-size:15pt;
        height:30px;
        margin-bottom: 5px;
    }

    .subCntr{
        margin-left: 30%;
        margin-top: 20px;
    }

</style>

<script language='javascript' type='text/javascript'>

</script>

<div class="fillFrame">
    <div class="content_row">
        <div class="explained_label">
            <div class="lab">
                Last Name:
            </div>
            <div class="explaination">
                Please enter or edit your last name:
            </div>
        </div>
        <div class="input_field">
            <input type="text" name="lname" id="lname" class="wide_input_field" size="40" value ="{{$thisUserData->lname}}"/>
        </div>
    </div>
    <div class="content_row">
        <div class="explained_label">
            <div class="lab">
                First Name:
            </div>
            <div class="explaination">
                Please enter or edit your first name:
            </div>
        </div>
        <div class="input_field">
            <input type="text" name="fname" id="fname" class="wide_input_field" size="40" value ="{{$thisUserData->fname}}"/>
        </div>
    </div>
    <div class="content_row">
        <div class="explained_label">
            <div class="lab">
                Address Line #1
            </div>
            <div class="explaination">
                Please enter or edit the first line of your address:
            </div>
        </div>
        <div class="input_field">
            <input type="text" name="addr1" id="addr1" class="wide_input_field" size="40" value ="{{$thisUserData->addr1}}"/>
        </div>
    </div>
    <div class="content_row">
        <div class="explained_label">
            <div class="lab">
                Address Line #2:
            </div>
            <div class="explaination">
                Please enter or edit the second line of your address (optional):
            </div>
        </div>
        <div class="input_field">
            <input type="text" name="addr2" id="addr2" class="wide_input_field" size="40" value ="{{$thisUserData->addr2}}"/>
        </div>
    </div>
    <div class="content_row">
        <div class="explained_label">
            <div class="lab">
                City:
            </div>
            <div class="explaination">
                Please enter or edit your city, state, and zipcode:
            </div>
        </div>
        <div class="accross3">
            <div>
                <span><input class="wide_input_field" type="text" name="city" id="city" class="wide_input_field" size="20" placeholder="city" value ="{{$thisUserData->city}}"/></span>
            </div>
            <div>
                	<span><span class="lab">State:</span>
                            <select style="margin-top: 12px;" class="selinput" id="strstate" value ="{{$thisUserData->state}}">
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
						</span>
            </div>
            <div>
                <span><span class="lab">Zip:</span><input class="wide_input_field" type="text" name="zip" id="zip" class="wide_input_field" size="15" placeholder="zip" value ="{{$thisUserData->zip}}" /></span>
            </div>
        </div>
    </div>
    <div class="content_row">
        <div class="explained_label">
            <div class="lab">
                Country:
            </div>
            <div class="explaination">
                Please enter or edit your country:
            </div>
        </div>
        <div class="input_field">
            <input type="text" name="country" id="country" class="wide_input_field" size="40" value ="{{$thisUserData->country}}"/>
        </div>
    </div>


    <div class="content_row">
        <div class="explained_label">
            <div class="lab">
                Phone:
            </div>
            <div class="explaination">
                Please enter or edit your phone number:
            </div>
        </div>
        <div class="input_field">
            <input type="text" name="phone" id="phone" class="wide_input_field" size="30" value ="{{$thisUserData->phone}}"/>
        </div>
    </div>
    <div class="content_row">
        <div class="explained_label">
            <div class="lab">
                Email:
            </div>
            <div class="explaination">
                Please enter or edit your email:
            </div>
        </div>
        <div class="input_field">
            <input type="text" name="email" id="email" class="wide_input_field" size="40" value ="{{$thisUserData->email}}"/>
        </div>
    </div>
    <div class="subCntr">
        <button type="button" onclick="submitUserEdit();return false;" class="btn" value="Update User">Update User</button>
        <button type="button" onclick="editCompanyData();return false;" class="btn" value="Edit Company Information">Edit Company Information</button>
    </div>





</div>

