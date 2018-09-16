<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
<style>
    .fillFrame{
        background-color: #eeeeee;
        height:100%;
        width:100%;
    }

    .pager{
        display:grid;
        grid-template-columns:70% 10% 20%;
    }
    .buyerViewWrapper{
        display:grid;
        grid-template-rows: 50px 100px 85%;
    }
    .optionSelect {
        width:35%;
    }
    .pageTitle{

        display:grid;
        grid-template-columns: repeat(auto-fill, 30%);
        color: black;
        align-items: center;
        padding-left: 20px;
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
        font-size: 12px;
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

    .optionExplaination{
        display:grid;
        grid-template-rows: 40px 40px;
    }
    .optionControls{
        display:grid;
        grid-template-columns: 120px 90px;
    }
    .optionButtons{
        height:30px;
        font-size: 12px;
        margin-right: 5px;
    }



    .filterControls{
        display:grid;
        grid-template-columns: repeat(auto-fill, 25%);
        align-items: center;
        padding-left: 10%;
        font-size: 12px;
        font-family: 'Fira Sans Condensed', sans-serif;
        font-weight: normal;
        height:100px;
        color: black;
    }
    .optionSelect {
        width:35%;
    }
    .selectLabel{

    }
    .selectOptions{
        display:grid;
        grid-template-rows: 20px 85%;
    }
    .flushLeft{
        justify-self: start;
        font-size: 12px;
        font-family: 'Fira Sans Condensed', sans-serif;
        font-weight: normal;
    }
    .titleCentered{
        justify-self: center;
        font-size: 24px;
        font-family: 'Fira Sans Condensed', sans-serif;
        font-weight: normal;
    }
    .flushRight{
        justify-self: end;
        font-size: 12px;
        font-family: 'Fira Sans Condensed', sans-serif;
        font-weight: normal;
    }
    .productView{

    }
    .submitButton{
        width:70px;
    }
</style>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script language='javascript' type='text/javascript'>
    var lastAddedCat = [];
    var lastAddedCatName =[];
    $( document ).ready(function() {
        lastAddedCatName.push('Select Product Category');
        lastAddedCat.push(0);
        getNextCats('Select Product Category');
        getOptionTypes();
    });


    function getNextCats(parentCatName){
        var childNodes = [];
        if(lastAddedCatName.length>1) {
            childNodes.push(['select sub-category of:'+lastAddedCatName[lastAddedCatName.length-1], 0]);
        }else{
            childNodes.push(['all categories - select one', 0]);
        }
;
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
                    $("#categoryControl").html(selHtml);

                }else{
                    var selHtml = createLeafSelect();
                    $("#categoryControl").html(selHtml);
                }
            },

            error: function (data) {
                alert('error');
            }
        });
    }

    function getOptionTypes(){
        $.ajax({
            /* the route pointing to the post function */
            url: '/optionTypes',
            type: 'GET',
            /* send the csrf-token and the input to the controller */
            data: {},
            dataType: 'json',
            /* remind that 'data' is the response of the AjaxController */
            success: function (data) {
                var optionSelectElement = createSimpleSelect('optionTypeSelect', 'selectThisOption(this);', data, 'Select Type' );
                $("#optSelect").append(optionSelectElement);
                console.log(optionSelectElement);
            },

            error: function (data) {
                alert('error');
            }
        });
    }

    function selectThisOption(elem){
        var selectedOptionId = elem.selectedOptions[0].value;
        $.ajax({
            /* the route pointing to the post function */
            url: '/optionValues',
            type: 'GET',
            /* send the csrf-token and the input to the controller */
            data: {optionTypeId:selectedOptionId},
            dataType: 'json',
            /* remind that 'data' is the response of the AjaxController */
            success: function (data) {
                var allOptionsDiv = "<div class='allOptions'>";

                var itemsDiv = "<div class='itemsDiv'>";
                for(d=0;d<data.length;d++){
                    var thisItemId = data[d].id;
                    var thisItemValue = data[d].name;
                    var thisItemCheckbox = "<div class='optionCheckBoxDiv'>"
                    thisItemCheckbox = thisItemCheckbox+"<input type='checkbox' name='option"+thisItemId+"' id='option"+thisItemId+"'/>";
                    thisItemCheckbox = thisItemCheckbox + "<label class='optionLabel'  for='option"+thisItemId+"'>"+thisItemValue+"</label>";
                    thisItemCheckbox = thisItemCheckbox + "</div>";
                    itemsDiv = itemsDiv+thisItemCheckbox;
                }
                itemsDiv = itemsDiv+"</div>";
                allOptionsDiv = allOptionsDiv+itemsDiv;

                allOptionsDiv = allOptionsDiv+"</div>";
                console.log(allOptionsDiv);
            },

            error: function (data) {
                alert('error');
            }
        });
    }

    function newSubCat(elem){
        if(elem.selectedOptions[0].innerText == 'Select Parent'){
            gotoParent(elem);
        } else{
            var selectedOptionName = elem.selectedOptions[0].innerText;
            lastAddedCat.push(elem.value);
            lastAddedCatName.push(selectedOptionName);
            getNextCats(selectedOptionName);
        }

    }

    function gotoParent(elem){
        lastAddedCat.pop();
        lastAddedCatName.pop();


        if(lastAddedCatName.length==0){
            getNextCats('Select Product Category')
        }else{
            getNextCats(lastAddedCatName[lastAddedCatName.length-1]);
        }



    }

    function createNextSelect(optNames){
        var thisDivHtml = "<select id ='categorySelect' onchange='newSubCat(this);'>";
        for(i=0;i<optNames.length;i++){
            var newOpt = "<option value='"+optNames[i][1]+"'>"+optNames[i][0]+"</option>";
            thisDivHtml = thisDivHtml+newOpt;
        }
        thisDivHtml = thisDivHtml + "<option value='-1'>Select Parent</option>"
        thisDivHtml = thisDivHtml+"</select>";
        return thisDivHtml;
    }

    function createSimpleSelect(selectId, selectOnChange, optNames, optPrompt){
        var thisDivHtml = "<select id ='"+selectId+"' onchange='"+selectOnChange+"'>";
        var promptOption = "<option value='0'>"+optPrompt+"</option>";
        thisDivHtml = thisDivHtml+promptOption;
        for(i=0;i<optNames.length;i++){
            var newOpt = "<option value='"+optNames[i].id+"'>"+optNames[i].name+"</option>";
            thisDivHtml = thisDivHtml+newOpt;
        }
        thisDivHtml = thisDivHtml+"</select>";
        return thisDivHtml;
    }

    function createLeafSelect(){
        var thisDivHtml = "<select id ='categorySelect' onchange='gotoParent(this);'>";
        var newOpt = "<option value='0'>No Sub-Categories Under:"+lastAddedCatName[lastAddedCatName.length-1]+"</option>";
        var newOpt = newOpt+"<option value='-1'>Select Parent</option>";
        thisDivHtml = thisDivHtml+newOpt;
        thisDivHtml = thisDivHtml+"</select>";
        return thisDivHtml;
    }

    function createSubmitButton(){
        var buttonHtml = "<button id='subb' onclick='submitData();return false;' class='submitButton'>Search</button>";
        $("#filters").append(buttonHtml);
    }

    function removeSubmitButton(){
        $("#subb").remove();
    }



</script>
<div class="fillFrame">
    <div class="content_row">
        <div class="explained_label">
            <div class="lab">
                Category:
            </div>
            <div class="explaination">
                Please select a category to which you wish to add a sub-category.  You may navigate up and down the category/sub-category tree by either selecting a sub-category or picking 'select parent'
            </div>
        </div>
        <div class="filterControls" id="filters">
            <span id="categoryControl">

            </span>
        </div>
    </div>
    <div class="content_row">
        <div class="explained_label">
            <div class="lab">
                New Sub-Category:
            </div>
            <div class="explaination">
                Please enter the name of the new sub-category you wish to add to the category you have selected above
            </div>
        </div>
        <div class="input_field">
            <input type="text" name="subcategory_name" id="subcategory_name" class="wide_input_field" size="32" />
        </div>

    </div>
    <div class="content_row">
        <div class="explained_label">
            <div class="lab">
                Options:
            </div>
            <div class="optionExplaination">
                <div class="explaination">
                    Please select appropriate options for this category or enter a new option type.
                </div>
                <div class="optionControls">
                    <button class ='btn optionButtons' id="addOptionType" name="addOptionType" onClick="addExistingOptionType();">Add Existing Type</button>
                    <button class ='btn optionButtons' id="addOptionType" name="addOptionType" onClick="createNewOptionType();">New Type</button>
                </div>

            </div>
        </div>

        <div class="filterControls">
            <span id="optSelect">

            </span>
        </div>



    </div>

</div>