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
    var submitUserEdit = function(event){
        $('#userEditForm').attr('action', "/userProfileEditSubmit").submit();
        return false;
    }

    var editCompanyData = function(event){
        $('#showCompanyInfo').attr('action', '/showUserCompany').submit();
        return false;
    }

</script>
<div class="fillFrame">
    <form id="userEditForm" method="POST">
        {{ csrf_field() }}

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
                                    <select style="margin-top: 12px;" class="selinput" id="strstate" name="state" value ="{{$thisUserData->state}}">
                                        @foreach($states as $thisState)
                                            @if(strcmp($thisState[0], $thisUserData->state)==0)
                                                <option value="{{$thisState[0]}}" selected>{{$thisState[1]}}</option>
                                            @else
                                                <option value="{{$thisState[0]}}">{{$thisState[1]}}</option>
                                            @endif
                                        @endforeach

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
        <input type="hidden" name="userId" id="userId" value="{{$thisUserData->uid}}"/>
    </form>
    <form id="showCompanyInfo" method="POST">
        {{ csrf_field() }}
        <input type="hidden" name="userId" id="userId" value="{{$thisUserData->uid}}"/>
    </form>
    <div class="subCntr">
        <button type="button" onclick="submitUserEdit();return false;" class="btn" value="Update User">Update User</button>
        <button type="button" onclick="editCompanyData();return false;" class="btn" value="Edit Company Information">Edit Company Information</button>
    </div>
</div>

