<style>
    * {
        box-sizing: border-box;
    }
    .myForm {
        display: grid;

        width: 100%;
        grid-template-areas:
                "storeinfo typeinfo"
                "userinfo userinfo"
                "actcontrols actcontrols";


        grid-template-columns: 50% 50%;
        grid-gap: .8em .5em;
        background: #eee;
        padding: 2.5em;
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
        grid-template-columns: repeat(auto-fill, minmax(25%, 1fr));
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
    .myForm textarea,
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

    .frminputbig {
        font-size: 15px;
        width:15%;
        margin-top: 5px;
    }


</style>

<form class="myForm">
    <fieldset id="typeinfo">
        <div class="formrow">
            <div class="inpgroup">
                <label for="buysale_status">Buyer/Seller:</label>
                <input class="frminputbig" type="text" name="buysale_status" style="width:95%;" id="buysale_status" value="Buyer" readonly>
            </div>


            <div class="inpgroup">
                <label for="storetype">Store Type:</label>
                <input class="frminputbig" type="text" name="storetype" style="width:100%;" id="storetype" value="Retail" readonly>
            </div>
        </div>
        <div class="formrow">
            <div class="inpgroup">
                <label for="store_id">Store ID:</label>
                <input class="frminputbig" type="text" name="store_id" style="width:95%;" id="store_id" value="234-56789" readonly>
            </div>


            <div class="inpgroup">
                <label for="store_estab">Store Established:</label>
                <input class="frminputbig" type="text" name="store_estab" style="width:100%;" id="store_estab" value="2006" readonly>
            </div>
        </div>

    </fieldset>
    <fieldset id="storeinfo">
        <div class="inpgroup">
            <label for="store_name">Store Name:</label>
            <input class="frminputbig" type="text" name="store_name" style="width:35%;" id="store_name" value="Little Shop of Horrors" readonly>
        </div>
        <div class="inpgroup">
            <label for="store_website">Store Website:</label>
            <input class="frminputbig" type="text" name="store_website" style="width:75%;" id="store_website" value="http://horrorshop.org" readonly>
        </div>
    </fieldset>
    <fieldset id="userinfo">
        <div class="formrow">
            <div class="inpgroup">
                <label for="user_fname">First Name:</label>
                <input class="frminputbig" type="text" name="user_fname" style="width:90%;" id="user_fname" value="Suddenly" readonly>
            </div>
            <div class="inpgroup">
                <label for="user_lname">Last Name:</label>
                <input class="frminputbig" type="text" name="user_lname" style="width:90%;" id="user_lname" value="Seymour" readonly>
            </div>
            <div></div>
        </div>
        <div class="formrow">
            <div class="inpgroup">
                <label for="user_email">Email:</label>
                <input class="frminputbig" type="text" name="user_email" style="width:200%;" id="user_email" value="seymour@gmail.com" readonly>
            </div>
        </div>
        <div class="formrow">
            <div class="inpgroup">
                <label for="user_phone">Phone:</label>
                <input class="frminputbig" type="text" name="user_phone" style="width:200%;" id="user_phone" value="(333)-333-3333" readonly>
            </div>
        </div>
        <div class="formrow">
            <div class="inpgroup">
                <label for="user_addr1">Address #1:</label>
                <input class="frminputbig" type="text" name="user_addr1" style="width:200%;" id="user_addr1" value="1041 Big Street" readonly>
            </div>
        </div>
        <div class="formrow">
            <div class="inpgroup">
                <label for="user_addr2">Address #2:</label>
                <input class="frminputbig" type="text" name="user_addr2" style="width:200%;" id="user_addr2" value="Apt #2" readonly>
            </div>
        </div>
        <div class="formrow">
            <div class="inpgroup">
                <label for="user_city">City:</label>
                <input class="frminputbig" type="text" name="user_city" style="width:95%;" id="user_city" value="Charlottesville" readonly>
            </div>
            <div class="inpgroup">
                <label for="user_state">State:</label>
                <input class="frminputbig" type="text" name="user_state" style="width:70%;" id="user_state" value="Virginia" readonly>
            </div>
            <div class="inpgroup">
                <label for="user_zip">Zip:</label>
                <input class="frminputbig" type="text" name="user_zip" style="width:30%;" id="user_zip" value="22920" readonly>
            </div>
            <div class="inpgroup">
                <label for="user_country">Address #2:</label>
                <input class="frminputbig" type="text" name="user_country" style="width:100%;" id="user_country" value="Apt #2" readonly>
            </div>

        </div>
    </fieldset>
    <fieldset id="actcontrols">
        <div></div>
        <div>
            <div class="controls">
                <div class="ctlelement">
                    <button type="button">Approve As:</button>
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
                    <button type="button">Cancel</button>
                </div>
            </div>
        </div>
        <div></div>
    </fieldset>


</form>



