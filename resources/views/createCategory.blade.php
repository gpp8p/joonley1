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
        color: black;
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
    .optionValues{
        display:flex;
        flex-direction: row;
        justify-content: flex-start;

    }
    .optionList{
        color:black;
    }
    .optList{

    }
    .optListHdr{
        font-size: 12px;

    }
    .optListItem{
        font-size: 10px;
        margin-left: 2px;
        font-weight: normal;
    }



    .filterControls{
        display:grid;
        grid-template-columns:20% 80%;
        font-size: 12px;
        font-family: 'Fira Sans Condensed', sans-serif;
        font-weight: normal;
        height:100px;
        color: black;
    }

    .optionCheckBoxes{
        display:grid;
        grid-template-columns:auto;
        grid-template-rows: 50%;
        font-size: 12px;
        font-family: 'Fira Sans Condensed', sans-serif;
        font-weight: normal;
        height:100px;
        color: black;
    }
    .optionValueBox{
        display:grid;
        grid-template-rows: auto;
        font-size: 12px;
        font-family: 'Fira Sans Condensed', sans-serif;
        font-weight: normal;
        color: black;
    }
    .optsNowClass{
        display:flex;
        flex-direction: row;
        justify-content: space-around;

    }

    .categorySelect{

    }
    .optionSelect {

    }
    .selectLabel{

    }
    .selectOptions{
        display:grid;
        grid-template-rows: 20px 85%;
    }
    .optionLabel{
        font-size: 12px;
        font-family: 'Fira Sans Condensed', sans-serif;
        font-weight: normal;

    }
    .optionSelectGroup{
        display:grid;
        grid-template-rows: 50% 50%;
        margin-right: 20px;

    }
    .optionTypeSelector{

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

    input[type="file"] {
        display: none;
    }
    .custom-file-upload {
        border: 1px solid #ccc;
        display: inline-block;
        padding: 3px 9px;
        cursor: pointer;
        color:black;
        font-size: 12px;
        font-family: 'Fira Sans Condensed', sans-serif;
        font-weight: normal;
    }
    .imgupload{
        display:grid;
        grid-template-columns: 30% 30%;
    }
    .uplButton{
        height: 30%;
        width:50%;
    }
    .uplImage{

    }
    .submitForm{
        margin-left: 40%;
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

    function showDefaultOptions(catId){
        $.ajax({
            /* the route pointing to the post function */
            url: '/getOptionsWithParents',
            type: 'GET',
            /* send the csrf-token and the input to the controller */
            data: {categoryId:catId},
            dataType: 'json',
            /* remind that 'data' is the response of the AjaxController */
            success: function (data) {
                for(i=0;i<data.length;i++){
                    var optionHeader = data[i][0];
                    var optionItems = data[i][1];
                    var thisOptionListing = "<span class='optionList' id='olist"+optionHeader+"'>";
                    thisOptionListing = thisOptionListing+"<dl class='optList'><dt class='optListHdr'>"+optionHeader+"<a id='olremove"+optionHeader+"' class='optListControl' onclick='removeOptionType(this);' >\<--remove</a></dt>";
                    for(d=0;d<optionItems.length;d++){
                        var thisItemValue = optionItems[d][0];
                        thisOptionListing = thisOptionListing+"<dt class='optListItem'> - "+thisItemValue+"</dt>";
                    }
                    thisOptionListing = thisOptionListing+"</dl></span>";
                    $("#optsNow").append(thisOptionListing);
                    console.log(thisOptionListing);
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
                var numberOfSelects = $("#optSelect select").length+$("#optSelect input").length;
                var optionSelectElement = createSimpleSelect('osl_'+numberOfSelects, 'selectThisOption(this);', data, 'Select Type' );
                var optionSelectGroup = "<span class='optionSelectGroup' id='osg"+numberOfSelects+"'>";
                optionSelectGroup = optionSelectGroup+"<span class='optionTypeSelector' id='osl_"+numberOfSelects+"'>";
                optionSelectGroup = optionSelectGroup+optionSelectElement;
                optionSelectGroup = optionSelectGroup+"</span><span class='optionCheckBox' id='ocb"+numberOfSelects+"'></span>";
                optionSelectGroup = optionSelectGroup+"</span>";
                $("#optSelect").append(optionSelectGroup);
                console.log(optionSelectGroup);
            },

            error: function (data) {
                alert('error');
            }
        });
    }



    function addOptionValue(elem){
        var newTypeInputElementId = elem.id;
        var target = 'ocb'+newTypeInputElementId.substring(3);
        var existingValueInputs = $("#"+target+" input").length;
        var newInputId = 'inf'+newTypeInputElementId.substring(3)+'_'+existingValueInputs;
        var newInputField = createNewOptionInput(newInputId, "", 'showOptionValueInput(this);', 'Option Value');
        $("#"+target).append(newInputField);

    }

    function createOptionTypes(){
        var numberOfSelects = $("#optSelect select").length+$("#optSelect input").length;
        var createElement = createNewOptionInput('optionTypeSelect'+numberOfSelects, 'showOptionValueInput(this);', "", 'Option Name' )
        var optionSelectGroup = "<span class='optionSelectGroup' id='osg"+numberOfSelects+"'>";
        optionSelectGroup = optionSelectGroup+"<span class='optionTypeSelector' id='osl_"+numberOfSelects+"'>";
        optionSelectGroup = optionSelectGroup+createElement+"<i id='opv"+numberOfSelects+"' class='fa fa-plus-circle fa-lg' onclick='addOptionValue(this);' true'></i>";
        optionSelectGroup = optionSelectGroup+"</span><span class='optionValueBox' id='ocb_"+numberOfSelects+"'></span>";
        optionSelectGroup = optionSelectGroup+"</span>";
        $("#optSelect").append(optionSelectGroup);
        console.log(optionSelectGroup);
    }



    function selectThisOption(elem){
        var parentId = elem.parentElement.id;
        var selectedOptionId = elem.selectedOptions[0].value;
        var targetElement = parentId.substring(4);
        $.ajax({
            /* the route pointing to the post function */
            url: '/optionValues',
            type: 'GET',
            /* send the csrf-token and the input to the controller */
            data: {optionTypeId:selectedOptionId},
            thisParentId: parentId,
            thisSelectedOptionId:selectedOptionId,
            dataType: 'json',
            /* remind that 'data' is the response of the AjaxController */
            success: function (data) {
                var allOptionsDiv = "<span class='allOptions'>";

                var itemsDiv = "<span class='itemsDiv'>";
                for(d=0;d<data.length;d++){
                    var thisItemId = data[d].id;
                    var thisItemValue = data[d].name;
                    var thisItemCheckbox = "<span class='optionCheckBoxDiv'>"
                    thisItemCheckbox = thisItemCheckbox+"<input type='checkbox' name='"+this.thisSelectedOptionId+"_"+thisItemId+"' id='option"+thisItemId+"'/>";
                    thisItemCheckbox = thisItemCheckbox + " - <label class='optionLabel'  for='option"+thisItemId+"'>"+thisItemValue+"</label></br>";
                    thisItemCheckbox = thisItemCheckbox + "</span>";
                    itemsDiv = itemsDiv+thisItemCheckbox;
                }
                itemsDiv = itemsDiv+"</span>";
                allOptionsDiv = allOptionsDiv+itemsDiv;

                allOptionsDiv = allOptionsDiv+"</span>";
                console.log(allOptionsDiv);
//                console.log("ocb"+targetElement);
                $("#ocb"+targetElement).append(allOptionsDiv);
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
            showDefaultOptions(elem.value);
            getNextCats(selectedOptionName);
        }

    }

    function gotoParent(elem){
        lastAddedCat.pop();
        lastAddedCatName.pop();
        $(".optionList").remove();

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

    function createNewOptionInput(newOptionId, newOptionOnBlur, optNames, newOptPrompt){
        var newOptionInput = "<input type='text' class='newOptionInputClass' size = '12' onblur='"+newOptionOnBlur+"' name='"+newOptionId+"' id='"+newOptionId+"' placeholder='"+newOptPrompt+"'/>";
        return newOptionInput;
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

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah')
                    .attr('src', e.target.result)
                    .width(200)
                    .height(200);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }



</script>
<div class="fillFrame">
    <form method="post" action="{{ url('/createSubCategory') }}">
        {{ csrf_field() }}
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
            <span id="categoryControl" class="categorySelect">

            </span>
                <span id="optsNow" class="optsNowClass">

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
                    Upload Example Photo:
                </div>
                <div class="explaination">
                    Please select a photo of an example product for this category
                </div>
            </div>
            <div class = 'imgupload'>
            <span class="uplButton">
                <label class="custom-file-upload">
                    <input type="file" name="example_image" onchange="readURL(this);" />
                    Upload Example Photo
                 </label>
            </span>
                <span class="uplImage">
                <img id="blah" src="#" alt=" " />
            </span>

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
                    <div class="optionControle">
                        <button class ='btn optionButtons' id="addOptionType" name="addOptionType" onClick="getOptionTypes();return false;">Add Existing Type</button>
                        <button class ='btn optionButtons' id="addOptionType" name="addOptionType" onClick="createOptionTypes();return false;">New Type</button>
                    </div>

                </div>
            </div>

            <div class="optionCheckBoxes">
                <span id="optSelect" class="optionValues">

                </span>
            </div>
        </div>
        <div class="submitForm">
            <button class ='btn optionButtons' id="submitForm" name="submitForm" type="submit">Create New Suib-Category</button>
        </div>
    </form>
</div>