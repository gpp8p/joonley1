<style>
    * {
        box-sizing: border-box;
    }
    .myForm {
        display: grid;

        width: 100%;
        grid-template-areas:
                "storeinfo typeinfo"
                "userinfo usercmt"
                "actcontrols actcontrols";


        grid-template-columns: 50% 50%;
        grid-gap: .8em .5em;
        background: #eee;
        padding-bottom: 1.5em;
    }
    #typeinfo{
        grid-area: typeinfo;
        display: grid;
        grid-template-rows: repeat(auto-fill, minmax(60px,1fr));
    }
    #storeinfo {
        grid-area: storeinfo;
    }
    #userinfo {
        grid-area: userinfo;
        display: grid;
        grid-template-rows: repeat(auto-fill, minmax(60px,1fr));

    }

    #usercmt {
        grid-area: usercmt;
    }

    #actcontrols {
        grid-area: actcontrols;
        display:grid;
        grid-template-columns: 25% 50% 25%;
        margin-top: 30px;
    }
    .controls {
        display:grid;
        grid-template-columns: 25% 25% 25% 25%;
        margin-top:20px;
    }

    .formrow {
        display:grid;
        grid-template-columns: repeat(auto-fill, minmax(27%, 1fr));
    }

    .row4 {
        grid-template-columns: 25% 15% 25% 35%;
    }
    .myForm textarea {
        height: calc(100% - 1.5em);
    }
    .myForm button {
        background: gray;
        color: white;
        padding: 1em;
        width:100%;
    }
    .myForm input:not([type=radio]):not([type=checkbox]),
    .myForm select {
        width: 100%;
        border: 0;
        padding: 1em;
    }
    .myForm label {
        color: #26b2ff;
    }

    fieldset {
        border: 0;
    }
    .inpgroup{
        display:grid;
        grid-template-rows: 10px 30px;
        font-size: 15px;
        font-family: 'Fira Sans Condensed', sans-serif;
        margin-top: 5px;
    }
    .tagroup {
        display:grid;
        font-size: 15px;
        font-family: 'Fira Sans Condensed', sans-serif;
    }
    .txtarea{
        display:grid;
        width:95%;
        height:200px;
    }

    .frminputbig {
        font-size: 15px;
        width:15%;
        margin-top: 8px;
    }


</style>

<script language='javascript' type='text/javascript'>
    $( document ).ready(function() {
        $('#submitRegData').on('click',function(){
            $('#regDataForm').attr('action', "/approveReg").submit();
        });
    });
</script>

<form class="myForm" method="POST" id="regDataForm">
    {{ csrf_field() }}
    <fieldset id="typeinfo">
        <div class="formrow">
            <div class="inpgroup">
                <label for="buysale_status">Buyer/Seller:</label>
                <input class="frminputbig" type="text" name="buysale_status" style="width:95%;" id="buysale_status" value="{{$thisRegistration->buysell}}" readonly>
            </div>


            <div class="inpgroup">
                <label for="storetype">Store Type:</label>
                <input class="frminputbig" type="text" name="storetype" style="width:100%;" id="storetype" value="{{$thisRegistration->storeType}}" readonly>
            </div>
        </div>
        <div class="formrow">
            <div class="inpgroup">
                <label for="store_id">Store ID:</label>
                <input class="frminputbig" type="text" name="store_id" style="width:95%;" id="store_id" value="{{$thisRegistration->strid}}" readonly>
            </div>


            <div class="inpgroup">
                <label for="store_estab">Store Established:</label>
                <input class="frminputbig" type="text" name="store_estab" style="width:100%;" id="store_estab" value="{{$thisRegistration->strestab}}" readonly>
            </div>
        </div>

    </fieldset>
    <fieldset id="storeinfo">
        <div class="inpgroup">
            <label for="store_name">Store Name:</label>
            <input class="frminputbig" type="text" name="store_name" style="width:35%;" id="store_name" value="{{$thisRegistration->strname}}" readonly>
        </div>
        <div class="inpgroup">
            <label for="store_website">Store Website:</label>
            <input class="frminputbig" type="text" name="store_website" style="width:75%;" id="store_website" value="{{$thisRegistration->strwebsite}}" readonly>
        </div>
    </fieldset>
    <fieldset id="userinfo">
        <div class="formrow">
            <div class="inpgroup">
                <label for="user_fname">First Name:</label>
                <input class="frminputbig" type="text" name="user_fname" style="width:90%;" id="user_fname" value="{{$thisRegistration->fname}}" readonly>
            </div>
            <div class="inpgroup">
                <label for="user_lname">Last Name:</label>
                <input class="frminputbig" type="text" name="user_lname" style="width:90%;" id="user_lname" value="{{$thisRegistration->fname}}" readonly>
            </div>
            <div></div>
        </div>
        <div class="formrow">
            <div class="inpgroup">
                <label for="user_email">Email:</label>
                <input class="frminputbig" type="text" name="user_email" style="width:200%;" id="user_email" value="{{$thisRegistration->email}}" readonly>
            </div>
        </div>
        <div class="formrow">
            <div class="inpgroup">
                <label for="user_phone">Phone:</label>
                <input class="frminputbig" type="text" name="user_phone" style="width:200%;" id="user_phone" value="{{$thisRegistration->phone}}" readonly>
            </div>
        </div>
        <div class="formrow">
            <div class="inpgroup">
                <label for="user_addr1">Address #1:</label>
                <input class="frminputbig" type="text" name="user_addr1" style="width:200%;" id="user_addr1" value="{{$thisRegistration->straddr1}}" readonly>
            </div>
        </div>
        <div class="formrow">
            <div class="inpgroup">
                <label for="user_addr2">Address #2:</label>
                <input class="frminputbig" type="text" name="user_addr2" style="width:200%;" id="user_addr2" value="{{$thisRegistration->straddr2}}" readonly>
            </div>
        </div>
        <div class="formrow">
            <div class="inpgroup">
                <label for="user_city">City:</label>
                <input class="frminputbig" type="text" name="user_city"  id="user_city" value="{{$thisRegistration->strcity}}" readonly>
            </div>
            <div class="inpgroup">
                <label for="user_state">State:</label>
                <input class="frminputbig" type="text" name="user_state"  id="user_state" value="{{$thisRegistration->strstate}}" readonly>
            </div>
            <div class="inpgroup">
                <label for="user_zip">Zip:</label>
                <input class="frminputbig" type="text" name="user_zip"  id="user_zip" value="{{$thisRegistration->strzip}}" readonly>
            </div>
            <div class="inpgroup">
                <label for="user_country">Country:</label>
                <input class="frminputbig" type="text" name="user_country"  id="user_country" value="{{$thisRegistration->country}}" readonly>
            </div>

        </div>
    </fieldset>
    <fieldset id="usercmt">
        <div class="tagroup">
            <label for="user_comment">Comment:</label>
            <textarea id="user_comment" rows="20" name="user_comment" class="txtarea" readonly>
                {{$thisRegistration->comment}}
            </textarea>
        </div>

    </fieldset>
    <fieldset id="actcontrols">
        <div></div>
        <div>
            <div class="controls">
                <div class="ctlelement">
                    <button type="button" id="submitRegData">Approve As:</button>
                </div>
                <div class="ctlelement">
                    <select id="approveRole" name="approveRole">
                        <option value="admin">Administrator</option>
                        <option value="adminedit">Admin. Editor</option>
                        <option value="adminmarket">Admin. Marketing</option>
                        <option value="adminfeed">Admin. Feed</option>
                        <option value="seller">Seller</option>
                        <option value="buyerowner">Buyer-Owner</option>
                        <option value="buyer">Buyer</option>
                    </select>
                </div>
                <div class="ctlelement">
                    <button type="button">Email Applicant</button>
                </div>
                <div class="ctlelement">
                    <button type="button" onclick="window.location.href ='{{ route('reviewRegistrations') }}';return false;">Cancel</button>
                </div>
            </div>
        </div>
        <div></div>
    </fieldset>

    <input type="hidden" id="applicantId" name="applicantId" value="{{$thisRegistration->id}}" />
</form>



