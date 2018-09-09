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

    .select_narrow {
        width:30%;
    }

    .subCntr{
        margin-left: 30%;
        margin-top: 20px;
    }

</style>

<script language='javascript' type='text/javascript'>

</script>

<div class="fillFrame">
    <form id="companyEditForm" method="POST">
        {{ csrf_field() }}

        <div class="content_row">
            <div class="explained_label">
                <div class="lab">
                    Company Name:
                </div>
                <div class="explaination">
                    Please enter or edit your company's name:
                </div>
            </div>
            <div class="input_field">
                <input type="text" name="name" id="name" class="wide_input_field" size="50" value ="{{$thisCompanyData->name}}"/>
            </div>
        </div>

        <div class="content_row">
            <div class="explained_label">
                <div class="lab">
                    Company Role:
                </div>
                <div class="explaination">
                    Please enter or edit role in company:
                </div>
            </div>
            <div class="input_field select_narrow">
                <span><span class="lab">{{$userName}} is </span>
                    <select style="margin-top: 12px;" class="selinput" id="companyrole" name="companyrole" value ="{{$thisCompanyData->companyrole_name}}">
                        @foreach($companyRoles as $thisRole)
                            @if(strcmp($thisRole[0], $thisCompanyData->companyrole_slug)==0)
                                <option value="{{$thisRole[0]}}" selected>{{$thisRole[1]}}</option>
                            @else
                                <option value="{{$thisRole[0]}}">{{$thisRole[1]}}</option>
                            @endif
                        @endforeach
                    </select>
                </span>
            </div>
        </div>


        <div class="content_row">
            <div class="explained_label">
                <div class="lab">
                    Company Address:
                </div>
                <div class="explaination">
                    Please enter or edit line #1 of your company's address:
                </div>
            </div>
            <div class="input_field">
                <input type="text" name="addr1" id="addr1" class="wide_input_field" size="50" value ="{{$thisCompanyData->addr1}}"/>
            </div>
        </div>

        <div class="content_row">
            <div class="explained_label">
                <div class="lab">
                    Company Address (line #2):
                </div>
                <div class="explaination">
                    Please enter or edit line #2 of your company's address:
                </div>
            </div>
            <div class="input_field">
                <input type="text" name="addr2" id="addr2" class="wide_input_field" size="50" value ="{{$thisCompanyData->addr2}}"/>
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
                    <span><input class="wide_input_field" type="text" name="city" id="city" class="wide_input_field" size="20" placeholder="city" value ="{{$thisCompanyData->city}}"/></span>
                </div>
                <div>
                            <span><span class="lab">State:</span>
                                    <select style="margin-top: 12px;" class="selinput" id="strstate" name="state" value ="{{$thisCompanyData->state}}">
                                        @foreach($states as $thisState)
                                            @if(strcmp($thisState[0], $thisCompanyData->state)==0)
                                                <option value="{{$thisState[0]}}" selected>{{$thisState[1]}}</option>
                                            @else
                                                <option value="{{$thisState[0]}}">{{$thisState[1]}}</option>
                                            @endif
                                        @endforeach

                                    </select>
                                </span>
                </div>
                <div>
                    <span><span class="lab">Zip:</span><input class="wide_input_field" type="text" name="zip" id="zip" class="wide_input_field" size="15" placeholder="zip" value ="{{$thisCompanyData->zip}}" /></span>
                </div>
            </div>
        </div>
    </form>






</div>