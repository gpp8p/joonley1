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

    .accross1 {
        display:grid;
        grid-template-columns: 50%;
        margin-top: 15px;
        font-family: 'Fira Sans Condensed', sans-serif;
        font-size: 15px;
    }


    .ta_field {
        display: grid;
        grid-template-rows: 100%;
        width: 90%;
    }

    .wideselects {
        font-family: 'Fira Sans Condensed', sans-serif;
        font-size: 15px;
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
        background-color: #07eefa;
        margin-right: 1%;
        padding-top: 5px;
        padding-right: 5px;
        padding-left: 5px;
        font-size: 15px;
        font-family: 'Fira Sans Condensed', sans-serif;
        font-weight: normal;
        color:#000000;
        height: 45%;
    }
    .backdiv{
        background-color: #faa66e;
        border-radius:9px 0px 0px 9px;
        margin-right: 1%;
        padding-top: 5px;
        padding-right: 5px;
        padding-left: 5px;
        font-size: 15px;
        font-family: 'Fira Sans Condensed', sans-serif;
        font-weight: normal;
        color:#000000;
        height: 45%;
    }

    .esdiv{
        display:grid;
        grid-template-rows: repeat(auto-fill, minmax(30px,0.5fr));
    }

    .allOptions{
        font-family: 'Fira Sans Condensed', sans-serif;
        padding:20px;
        margin-left: 10px;
    }
    .optionHeader{
        font-size: 15px;
    }
    .optionCheckBoxDiv[type="checkbox"]{
        font-size:12px;
    }
    .optionLabel {
        font-size:12px;
        margin-left: 3px;
    }
    .termCheckBoxDiv{
        margin-top: 20px;
    }
    .termDiv {
        font-family: 'Fira Sans Condensed', sans-serif;
        font-size:12px;
        margin-left: 3px;
    }
    .errorItem{
        font-family: 'Fira Sans Condensed', sans-serif;
        font-size:12px;
        margin-left: 8px;
        color:red;
    }

</style>

<script language='javascript' type='text/javascript'>

    var lastAddedCat = "";
    $( document ).ready(function() {
        $("#options_div").hide();
        $("#errorDiv").hide();
        getNextCats('Select Product Category')
    });

    function getNextCats(parentCatName){
        var childNodes = [];
        childNodes.push(['select category',0]);
        $.ajax({
            /* the route pointing to the post function */
            url: '/getCats',
            type: 'GET',
            /* send the csrf-token and the input to the controller */
            data: {parentCategoryName:parentCatName},
            dataType: 'json',
            /* remind that 'data' is the response of the AjaxController */
            success: function (data) {
                for(i=0;i<data.length;i++){
                    childNodes.push(data[i]);
                }
                if(data.length>0){
                    var selHtml = createNextSelect(childNodes);
                    $('#seldiv').remove();
                    $('#expanding_container').append(selHtml);
                    $('#expanding_container').append(selectdiv);
                }else{
                    $('#seldiv').remove();
                    showDefaultOptions(lastAddedCat);
                    $('#expanding_container').append(createBackButton ());
                }
            },

            error: function (data) {
                alert('error');
            }
        });
    }

    function showDefaultOptions(catId){
        $.ajax({
            /* the route pointing to the post function */
            url: '/getOptions',
            type: 'GET',
            /* send the csrf-token and the input to the controller */
            data: {categoryId:catId},
            dataType: 'json',
            /* remind that 'data' is the response of the AjaxController */
            success: function (data) {
                var allOptionsDiv = "<div class='allOptions'>";
                for(i=0;i<data.length;i++){
                    var optionHeader = data[i][0];
                    var thisOptionHeaderDiv = "<div class='optionHeader'>"+optionHeader+"</div>";
                    var optionItems = data[i][1];
                    var itemsDiv = "<div class='itemsDiv'>";
                    for(d=0;d<optionItems.length;d++){
                        var thisItemValue = optionItems[d][0];
                        var thisItemId = optionItems[d][1];
                        var thisItemCheckbox = "<div class='optionCheckBoxDiv'>"
                        thisItemCheckbox = thisItemCheckbox+"<input type='checkbox' name='option"+thisItemId+"' id='option"+thisItemId+"'/>";
                        thisItemCheckbox = thisItemCheckbox + "<label class='optionLabel'  for='option"+thisItemId+"'>"+thisItemValue+"</label>";
                        thisItemCheckbox = thisItemCheckbox + "</div>";
                        itemsDiv = itemsDiv+thisItemCheckbox;
                    }
                    itemsDiv = itemsDiv+"</div>";
                    allOptionsDiv = allOptionsDiv+thisOptionHeaderDiv+itemsDiv;
                }
                allOptionsDiv = allOptionsDiv+"</div>";
                $("#disappearing_div").html(allOptionsDiv);
                $("#options_div").show();
            },

            error: function (data) {
                alert('error');
            }
        });

    }

    function createNextSelect(optNames){
        var thisDivHtml = "<div class='esdiv' id='seldiv'><select id ='categorySelect' onchange='addCat(this);' id='nxt_selector'>";
        for(i=0;i<optNames.length;i++){
            var newOpt = "<option value='"+optNames[i][1]+"'>"+optNames[i][0]+"</option>";
            thisDivHtml = thisDivHtml+newOpt;
        }
        $("#backButton").remove();
        thisDivHtml = thisDivHtml+"</select></div>"+createBackButton();
        return thisDivHtml;

    }

    function createBackButton (){
        var backButton = "<div class='backdiv' id = 'backButton' onclick='removeCat(lastAddedCat);'>Go Back</div>";
        return backButton;
    }

    function  addCat(elem){
        $("#backButton").remove();
        var selectedOptionName = elem.selectedOptions[0].innerText;
        lastAddedCat = elem.value;
        var new_box = "<div class='ediv' id='cat"+elem.value+"'>"+selectedOptionName+"</div>";
        $('#expanding_container').append(new_box);
        getNextCats(selectedOptionName);
    }

    function removeCat(){
        $("#options_div").hide();
        $('#seldiv').remove();
        $("#backButton").remove();
        var childern = document.getElementById('expanding_container').children;
        var numCats = childern.length;
        $("#cat"+lastAddedCat).remove();
        var childern = document.getElementById('expanding_container').children;
        if(numCats<2){
            clength = childern.length;
            if (clength == 0) {
                getNextCats('Select Product Category')
            }else{
                var lastNode = childern[clength-1];
                var lastNodeId = lastNode.id;
                $("#"+lastNodeId).remove();
                getNextCats('Select Product Category')
            }
        }else{
            clength = childern.length;
            var lastNode = childern[clength-1];
            var lastNodeName = lastNode.innerText;
            getNextCats(lastNodeName);
        }

    }

    function submitNewProductForm(){
        var errorsHaveBeenDetected = 0;
        if($("#product_name").val()==""){
            $("#errorList").append("<li>You must enter a product name</li>");
            errorsHaveBeenDetected = 1;
        }
        if($("#product_src").val()=='n'){
            $("#errorList").append("<li>You must select a value detailing who produced your product</li>");
            errorsHaveBeenDetected = 1;
        }
        if($("#product_what").val()=='n'){
            $("#errorList").append("<li>You must select a value detailing what your product is</li>");
            errorsHaveBeenDetected = 1;
        }
        if($("#product_when").val()=='n'){
            $("#errorList").append("<li>You must select a value detailing when your product was made</li>");
            errorsHaveBeenDetected = 1;
        }
        if($("#categorySelect").val()=='0'){
            $("#errorList").append("<li>You must select a category for your product</li>");
            errorsHaveBeenDetected = 1;
        }
        if($("#product_description").val()==""){
            $("#errorList").append("<li>You must enter a product description</li>");
            errorsHaveBeenDetected = 1;
        }
        if($("#q1_price").val()==""){
            $("#errorList").append("<li>You must enter a quantity one price</li>");
            errorsHaveBeenDetected = 1;
        }
        if($("#q10_price").val()==""){
            $("#errorList").append("<li>You must enter a quantity ten price</li>");
            errorsHaveBeenDetected = 1;
        }
        if($("#weight_lbs").val()==""){
            $("#errorList").append("<li>You must enter a weight (lbs)</li>");
            errorsHaveBeenDetected = 1;
        }
        if($("#weight_oz").val()==""){
            $("#errorList").append("<li>You must enter a weight (ounces)</li>");
            errorsHaveBeenDetected = 1;
        }
        if($("#product_catalog").val()==0){
            $("#errorList").append("<li>You must select a catalog</li>");
            errorsHaveBeenDetected = 1;
        }
        if(errorsHaveBeenDetected>0){
            $("#errorDiv").show();
        }else{
            $("#lastAddedCat").val(lastAddedCat);
            $("#newProductForm").submit();
        }

    }

</script>
<form id="newProductForm" method="post" action="{{ url('/newProductSubmit') }}">
    {{ csrf_field() }}



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

        <div class="content_row" id="errorDiv">
            <div class="explained_label">
                <div class="lab">
                    Entry errors:
                </div>
                <div class="explaination">
                    You must correct all the errors before submitting the form
                </div>
            </div>
            <div class="input_field">
                <ul id="errorList" class="errorItem">
                </ul>
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
                <select class="wideselects" name="product_src" id="product_src">
                    <option value="n">Who Produced It?</option>
                    <option value="local">Made by Me</option>
                    <option value="external">Somebody Else</option>
                </select>
                <select class="wideselects" name="product_what" id="product_what">
                    <option value="n">What is It?</option>
                    <option value="P">A Product</option>
                    <option value="T">Supply or Tool</option>
                    <option value="D">Digital Content</option>
                </select>
                <select class="wideselects" name="product_when" id="product_when">
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
        <div class="content_row" id="options_div">
            <div class="explained_label">
                <div class="lab">
                    Possible product options:
                </div>
                <div class="explaination">
                    Please check the options that will apply apply for your product.
                </div>
            </div>
            <div class="expanding_div" id="disappearing_div">

            </div>
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
                <textarea name="product_description" id="product_description" columns="60" rows="10"></textarea>
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
        <div class="content_row">
            <div class="explained_label">
                <div class="lab">
                    Catalog:
                </div>
                <div class="explaination">
                    Please select which of your company's existing catalogs you wish to include this product.
                </div>
            </div>
            <div class="across1">
                <select class="wideselects" name="product_catalog" id="product_catalog">
                    <option value="0">Select Catalog</option>
                    @foreach ($thisUsersCollections as $collection)
                        <option value="{{$collection->id}}">{{$collection->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="content_row">
            <div class="explained_label">
                <div class="lab">
                    Available Terms:
                </div>
                <div class="explaination">
                    Please select which of your company's terms you wish to include this product.
                </div>
            </div>
            <div class="termCheckBoxDiv">
                @foreach($thisCompanyTerms as $companyTerms)
                    @foreach($companyTerms as $thisTerm)
                        <div class="termDiv">
                            <input type="checkbox" id="term{{$thisTerm->id}}" name="term{{$thisTerm->id}}"/>
                            <label class="optionLabel" for="term{{$thisTerm->id}}">{{$thisTerm->specification}}</label>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
    <div class="subCntr">
        <button type="button" onclick="submitNewProductForm();return false;" class="btn" value="Next">Next->></button>
    </div>
    <input type="hidden" id="lastAddedCat" name="lastAddedCat"/>

</form>
