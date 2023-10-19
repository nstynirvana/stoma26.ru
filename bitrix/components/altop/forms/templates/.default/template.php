<?if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED !== true) die();

$this->setFrameMode(true);

use Bitrix\Main\Localization\Loc;

if($arResult["ELEMENT"]["ID"] > 0):?>
    <div class="info">
        <div class="image">
            <?if(is_array($arResult["ELEMENT"]["PREVIEW_PICTURE"])):?>
                <img src="<?=$arResult['ELEMENT']['PREVIEW_PICTURE']['SRC']?>" width="<?=$arResult['ELEMENT']['PREVIEW_PICTURE']['WIDTH']?>" height="<?=$arResult['ELEMENT']['PREVIEW_PICTURE']['HEIGHT']?>" alt="<?=$arResult['ELEMENT']['NAME']?>" title="<?=$arResult['ELEMENT']['NAME']?>" />
            <?else:?>
                <img src="<?=SITE_TEMPLATE_PATH?>/images/no-photo.jpg" width="150" height="150" alt="<?=$arResult['ELEMENT']['NAME']?>" title="<?=$arResult['ELEMENT']['NAME']?>" />
            <?endif;?>
        </div>
        <div class="name"><?=$arResult["ELEMENT"]["NAME"]?></div>
    </div>
<?endif;?>
<form action="<?=$this->__component->__path?>/script.php" id="<?=$arResult['ELEMENT_AREA_ID']?>_form" enctype="multipart/form-data">
    <span id="alert" class="alert"></span>
    <?foreach($arResult["IBLOCK"]["PROPERTIES"] as $arProp):
        if($arProp["CODE"] != "PRODUCT" && $arProp["CODE"] != "PRODUCT_PRICE"):?>
            <div class="row">
                <div class="span1"><?=($arProp["CODE"] == "PRICE" ? Loc::getMessage("FORMS_PRICE") : $arProp["NAME"]).($arProp["IS_REQUIRED"] == "Y" ? "<span class='mf-req'>*</span>" : "");?></div>
                <div class="span2">
                    <?if($arProp["PROPERTY_TYPE"] == "S") {
                    if($arProp["USER_TYPE"] != "HTML") {?>
                    <input type="text" name="<?=$arProp['CODE']?>" value="<?=($arProp['CODE'] == 'NAME' ? $arResult['USER']['NAME'] : ($arProp['CODE'] == 'EMAIL' ? $arResult['USER']['EMAIL'] : ''));?>" />
                    <?} else {?>
                        <textarea name="<?=$arProp['CODE']?>" rows="3" style="height:<?=$arProp['USER_TYPE_SETTINGS']['height']?>px; min-height:<?=$arProp['USER_TYPE_SETTINGS']['height']?>px; max-height:<?=$arProp['USER_TYPE_SETTINGS']['height']?>px;"></textarea>
                    <?}
                    } elseif($arProp["PROPERTY_TYPE"] == "F" ) {
                    ?>
                    <input type="file" id="fileselect" name="fileselect[]" multiple="multiple"/>

                        <div class="filedrag-wrap">
                            <div id="fileinput-item"></div>
                            <div id="filedrag">
                                <?= Loc::getMessage("FORMS_ADD_PHOTO") ?>
                            </div>
                        </div>
                        <script>
                            (function () {

                                function $id(id) {
                                    return document.getElementById(id);
                                }

                                function FileDragHover(e) {
                                    e.stopPropagation();
                                    e.preventDefault();
                                    e.target.className = (e.type == "dragover" ? "hover" : "");
                                }

                                function FileSelectHandler(e) {
                                    countImg=getCookie("count");
                                    FileDragHover(e);
                                    var files = e.target.files || e.dataTransfer.files;

                                    form = new FormData();

                                    if(countImg<=5) {

                                        for (var i = 0, f; f = files[i]; i++) {

                                            countImg++;
                                            if(countImg>5){
                                                alert(" <?= Loc::getMessage('FORMS_WARNING_MORE_5') ?>");
                                                countImg--;
                                                break;
                                            }else {
                                                var upload_file = files[i];
                                                form.append("fil" + i, upload_file);
                                            }
                                        }
                                        document.getElementById("alert").innerHTML = "<span class='alertMsg load-file'><i class='fa fa-spinner'></i><span class='text'> <?= Loc::getMessage("FORMS_WARNING_WAIT") ?></span></span>";
                                        $.ajax({
                                            url: "/bitrix/components/altop/forms/script2.php",
                                            type: "post",
                                            data: form,
                                            processData: false,
                                            contentType: false,
                                            cache: false,
                                            success: function (data) {
                                                document.getElementById("alert").innerHTML="";
                                                var sp = $id("fileinput-item");
                                                $(sp).append(data);
                                                delete form;
                                            },
                                            error: function (error) {

                                            }
                                        });
                                    }else{
                                        alert(" <?= Loc::getMessage('FORMS_WARNING_MORE_5') ?>");
                                    }
                                    setCookie("count", countImg, 10000);
                                }


                                $('#filedrag').on('click', function() {
                                    $('#fileselect').trigger('click');
                                });

                                function Init() {

                                    var fileselect = $id("fileselect"),
                                        filedrag = $id("filedrag");

                                    fileselect.addEventListener("change", FileSelectHandler, false);

                                    var xhr = new XMLHttpRequest();
                                    if (xhr.upload) {

                                        // file drop
                                        filedrag.addEventListener("dragover", FileDragHover, false);
                                        filedrag.addEventListener("dragleave", FileDragHover, false);
                                        filedrag.addEventListener("drop", FileSelectHandler, false);
                                        filedrag.style.display = "block";
                                    }
                                }

                                if (window.File && window.FileList && window.FileReader) {
                                    Init();
                                }
                            })();
                        </script>
                    <?}?>
                </div>
            </div>
        <?endif;
    endforeach;
    if($arParams["USE_CAPTCHA"] == "Y"):?>
        <div class="row">
            <div class="span1"><?=Loc::getMessage("FORMS_CAPTCHA")?><span class="mf-req">*</span></div>
            <div class="span2">
                <input type="text" name="CAPTCHA_WORD" maxlength="5" value="" />
                <img src="" width="127" height="30" alt="CAPTCHA" style="display:none;" />
                <input type="hidden" name="CAPTCHA_SID" value="" />
            </div>
        </div>
    <?endif;?>
    <input type="hidden" name="PARAMS_STRING" value="<?=$arParams['PARAMS_STRING']?>" />
    <input type="hidden" name="IBLOCK_STRING" value="<?=$arResult['IBLOCK']['STRING']?>" />
    <?//AGREEMENT//
    if($arParams["SHOW_PERSONAL_DATA"] == "Y") {?>
        <div class="hint_agreement">
            <input type="hidden" name="PERSONAL_DATA" id="PERSONAL_DATA_<?=$arResult['ELEMENT_AREA_ID']?>" value="N">
            <div class="checkbox">
                <span class="input-checkbox" id="input-checkbox_<?=$arResult['ELEMENT_AREA_ID']?>"></span>
            </div>
            <div class="label">
                <?=$arParams["TEXT_PERSONAL_DATA"]?>
            </div>
        </div>
    <?}?>
    <div class="submit">
        <button type="button" id="<?=$arResult['ELEMENT_AREA_ID']?>_btn" class="btn_buy popdef"><?=Loc::getMessage("FORMS_SEND")?></button>
    </div>
</form>

<script type="text/javascript">
    //TITLE//
    BX.adjust(BX("popup-window-titlebar-<?=$arResult['ELEMENT_AREA_ID']?>"), {html: "<?=$arResult['IBLOCK']['NAME']?>"});

    <?foreach($arResult["IBLOCK"]["PROPERTIES"] as $arProp):
    //MASK//
    if($arProp["CODE"] == "PHONE" && !empty($arParams["PHONE_MASK"])):?>
    var input = $("#<?=$arResult['ELEMENT_AREA_ID']?>_form").find("[name='<?=$arProp['CODE']?>']");
    if(!!input)
        input.inputmask({
            mask:"<?=$arParams['PHONE_MASK']?>",
            positionCaretOnClick: "radixFocus",

            definitions:{
                'X':{
                    validator: "9",
                    placeholder: "9"
                }
            }
        });
    <?endif;
    endforeach;?>

    //FORM_SUBMIT//
    BX.bind(BX("<?=$arResult['ELEMENT_AREA_ID']?>_btn"), "click", BX.delegate(BX.PopupFormSubmit, BX));

    //CHEKED//
    BX.bind(BX("input-checkbox_<?=$arResult['ELEMENT_AREA_ID']?>"),"click",function(){
        if(!BX.hasClass(BX("input-checkbox_<?=$arResult['ELEMENT_AREA_ID']?>"),"cheked")){
            BX.addClass(BX("input-checkbox_<?=$arResult['ELEMENT_AREA_ID']?>"),"cheked");
            BX.adjust(BX("input-checkbox_<?=$arResult['ELEMENT_AREA_ID']?>"),{
                children:[
                    BX.create("i",{
                        props:{
                            className:"fa fa-check"
                        }
                    })
                ]
            });
            BX.adjust(BX("PERSONAL_DATA_<?=$arResult['ELEMENT_AREA_ID']?>"),{
                props:{
                    "value":"Y"
                }
            });
        } else {
            BX.removeClass(BX("input-checkbox_<?=$arResult['ELEMENT_AREA_ID']?>"),"cheked");
            BX.remove(BX.findChild(BX("input-checkbox_<?=$arResult['ELEMENT_AREA_ID']?>"),{
                className:"fa fa-check"
            }));
            BX.adjust(BX("PERSONAL_DATA_<?=$arResult['ELEMENT_AREA_ID']?>"),{
                props:{
                    "value":"N"
                }
            });
        }
    });
</script>