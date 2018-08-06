<style>
    * {
        box-sizing: border-box;
    }
    .myForm {
        display: grid;
        grid-template-areas:
                "typeinfo"
                "storeinfo"
                "userinfo"


                "customer taxi"
                "customer extras"
                "pickup dropoff"
                "instructions instructions"
                "submit submit";
        grid-template-columns: auto auto;
        grid-template-rows: auto auto auto auto;
        grid-gap: .8em .5em;
        background: #eee;
        padding: 1.2em;
    }
</style>

<div class="regaction" align="center">
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
