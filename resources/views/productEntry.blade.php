<style>
    .product_form {
        color:black;
        background:#eeeeee;
    }
    .title_row{
        width: 100%;
        padding:20px;
        margin-left: 10px;
    }
    .content_row{
        display: grid;
        grid-template-columns:20% 80%;
        padding:20px;
        margin-left: 10px;
    }
    .explained_label{
        display: grid;
        grid-template-rows: repeat(auto-fill, minmax(30px,0.5fr));
    }
    .lab{
        font-size: 15px;
        font-family: 'Fira Sans Condensed', sans-serif;
        font-weight: 400;
    }
    .explaination{
        font-size: 10px;
        font-family: 'Fira Sans Condensed', sans-serif;
        font-weight: normal;
        margin-right: 5px;
    }
    .accross3{
        display:grid;
        grid-template-columns: 30% 30% 30%;
    }
    .accross2{
        display:grid;
        grid-template-columns: 15% 15%;
        margin-top: 15px;
        font-family: 'Fira Sans Condensed', sans-serif;
        font-size: 12px;
    }


    .ta_field {
        display: grid;
        grid-template-rows: 100%;
        width: 90%;
    }

    .wideselects {
        font-family: 'Fira Sans Condensed', sans-serif;
        font-size: 20px;
        height: 55%;
        margin-top: 35px;
        margin-right: 3px;
        -webkit-appearance: none;
        appearance: none;
        border: 1px solid #999999;
        line-height: 1;
        outline: 0;
        color: #484848;
        border-color: #999999;

        border-radius: 3px;

        background-color: white;
    }
    .expanding_div{
        display:flex;
        grid-template-columns: repeat(auto-fill, minmax(15%,1fr));

    }
    .ediv{
        background-color: #ff110a;
        margin-right: 1%;
        padding-top: 5px;
        padding-right: 5px;
        padding-left: 5px;
        font-size: 15px;
        font-family: 'Fira Sans Condensed', sans-serif;
        font-weight: normal;
        color:white;
        height: 35%;
    }
    .esdiv{
        display:grid;
        grid-template-rows: repeat(auto-fill, minmax(30px,0.5fr));
    }

</style>

<script language='javascript' type='text/javascript'>
    function getOneRegistrationRequest(clickedElement){
        $.ajax({
            /* the route pointing to the post function */
            url: '/getCats',
            type: 'GET',
            /* send the csrf-token and the input to the controller */
            data: {parentCategoryName:encodeURIComponent(sParameter.trim(clickedElement.id))},
            dataType: 'json',
            /* remind that 'data' is the response of the AjaxController */
            success: function (data) {

            },

            error: function (data) {
                alert('error');
            }
        });
    }

</script>

<div class="product_form">
    <div class="title_row">
        <div class="explained_label">
            <div class="lab">
                Information on your product.
            </div>
            <div class="explaination">
                We need some details about your product to help us market it.
            </div>
        </div>
    </div>
    <div class="content_row">
        <div class="explained_label">
            <div class="lab">
                The product name:
            </div>
            <div class="explaination">
                What do you call your product ?  Think of something that's easy to remember that contains key words that will help people find it.
            </div>
        </div>
        <div class="input_field">
            <input type="text" name="product_name" id="product_name" class="wide_input_field" size="50"/>
        </div>
    </div>
    <div class="content_row">
        <div class="explained_label">
            <div class="lab">
                Product Source:
            </div>
            <div class="explaination">
                Provide us some information about what your product is how and when it came to be produced.
            </div>
        </div>
        <div class="accross3">
            <select class="wideselects" id="product_src">
                <option value="null">Who Produced It?</option>
                <option value="local">Made by Me</option>
                <option value="external">Somebody Else</option>
            </select>
            <select class="wideselects" id="product_what">
                <option value="n">What is It?</option>
                <option value="P">A Product</option>
                <option value="T">Supply or Tool</option>
                <option value="D">Digital Content</option>
            </select>
            <select class="wideselects" id="product_when">
                <option value="n">When Made?</option>
                <option value="notyet">Not prodeuced Yet</option>
                <option value="2018">2018</option>
                <option value="2017">2017</option>
                <option value="2016">2016</option>
                <option value="2015">2015</option>
                <option value="2014">2014</option>
                <option value="old">Before That</option>
            </select>
        </div>
    </div>
    <div class="content_row">
        <div class="explained_label">
            <div class="lab">
                The product type:
            </div>
            <div class="explaination">
                What product ctaegory does your product fall under ?  Use the select pulldowns to refine the category.
            </div>
        </div>
        <div class="expanding_div" id="expanding_container">

        </div>
    </div>
    <div id="disappearing_div">
    </div>
    <div class="content_row">
        <div class="explained_label">
            <div class="lab">
                Description:
            </div>
            <div class="explaination">
                Please describe your product here at length.  Tell us why you think this product is exactly what Joonley stores will want to sell.
            </div>
        </div>
        <div class="ta_field">
            <textarea columns="60" rows="10"></textarea>
        </div>
    </div>
    <div class="content_row">
        <div class="explained_label">
            <div class="lab">
                Price:
            </div>
            <div class="explaination">
                Please provide the suggested price - both q1 and q10:
            </div>
        </div>
        <div class="accross2">
            <div>
                <span><input class="small_input" type="text" name="q1_price" id="q1_price" class="wide_input_field" size="10" placeholder="Q1 price"/></span>
            </div>
            <div>
                <span><input class="small_input" type="text" name="q10_price" id="q10_price" class="wide_input_field" size="10"placeholder="Q10 price"/></span>
            </div>
        </div>
    </div>
    <div class="content_row">
        <div class="explained_label">
            <div class="lab">
                Weight:
            </div>
            <div class="explaination">
                What will your product weight when shipped:
            </div>
        </div>
        <div class="accross2">
            <div>
                <span><input class="small_input" type="text" name="weight_lbs" id="weight_lbs" class="wide_input_field" size="6" placeholder="Lbs."/></span>

            </div>
            <div>
                <span><input class="small_input" type="text" name="weight_oz" id="weight_oz" class="wide_input_field" size="6" placeholder="Oz."/></span>

            </div>
        </div>
    </div>
</div>