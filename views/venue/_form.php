<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Venue */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="venue-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Name']) ?>

    <?= $form->field($model, 'venue_type')->dropDownList(['' => '', 'Amphitheater' => 'Amphitheater', 'Arena' => 'Arena', 'Bandshell' => 'Bandshell', 'Club' => 'Club', 'College' => 'College', 'Concert Hall' => 'Concert Hall', 'Operahouse' => 'Operahouse', 'Other' => 'Other', 'Private' => 'Private', 'Stadium' => 'Stadium', 'Theater' => 'Theater']) ?>

    <?= $form->field($model, 'previous_name')->textInput(['maxlength' => true, 'placeholder' => 'Previous Name']) ?>

    <?= $form->field($model, 'note')->textarea(['maxlength' => true, 'placeholder' => 'Note']) ?>

    <?= $form->field($model, 'ticket_rebate')->textarea(['maxlength' => true, 'placeholder' => 'Ticket Rebate']) ?>

    <?= $form->field($model, 'other_deal')->textarea(['maxlength' => true, 'placeholder' => 'Other Deal']) ?>

    <?= $form->field($model, 'address1')->textInput(['maxlength' => true, 'placeholder' => 'Address1']) ?>

    <?= $form->field($model, 'address2')->textInput(['maxlength' => true, 'placeholder' => 'Address2']) ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => true, 'placeholder' => 'City']) ?>

    <?= $form->field($model, 'state')->textInput(['maxlength' => true, 'placeholder' => 'State']) ?>

    <?= $form->field($model, 'zipcode')->textInput(['maxlength' => true, 'placeholder' => 'Zipcode']) ?>

    <?= $form->field($model, 'country')->textInput(['maxlength' => true, 'placeholder' => 'Country']) ?>

    <?= $form->field($model, 'timezone')->dropDownList(['' => '',
        "ACDT Australian Central Daylight Savings Time" => "ACDT Australian Central Daylight Savings Time",
        "ACST Australian Central Standard Time" => "ACST Australian Central Standard Time",
        "ACT Acre Time" => "ACT Acre Time",
        "ACT ASEAN Common Time" => "ACT ASEAN Common Time",
        "ADT Atlantic Daylight Time" => "ADT Atlantic Daylight Time",
        "AEDT Australian Eastern Daylight Savings Time" => "AEDT Australian Eastern Daylight Savings Time",
        "AEST Australian Eastern Standard Time" => "AEST Australian Eastern Standard Time",
        "AFT Afghanistan Time" => "AFT Afghanistan Time",
        "AKDT Alaska Daylight Time" => "AKDT Alaska Daylight Time",
        "AKST Alaska Standard Time" => "AKST Alaska Standard Time",
        "AMST Amazon Summer Time (Brazil)[1]" => "AMST Amazon Summer Time (Brazil)[1]",
        "AMT Amazon Time (Brazil)[2]" => "AMT Amazon Time (Brazil)[2]",
        "AMT Armenia Time" => "AMT Armenia Time",
        "ART Argentina Time" => "ART Argentina Time",
        "AST Arabia Standard Time" => "AST Arabia Standard Time",
        "AST Atlantic Standard Time" => "AST Atlantic Standard Time",
        "AWDT Australian Western Daylight Time" => "AWDT Australian Western Daylight Time",
        "AWST Australian Western Standard Time" => "AWST Australian Western Standard Time",
        "AZOST Azores Standard Time" => "AZOST Azores Standard Time",
        "AZT Azerbaijan Time" => "AZT Azerbaijan Time",
        "BDT Brunei Time" => "BDT Brunei Time",
        "BDT Bangladesh Daylight Time (Bangladesh Daylight saving time keeps UTC+06 offset) [3]" => "BDT Bangladesh Daylight Time (Bangladesh Daylight saving time keeps UTC+06 offset) [3]",
        "BIOT British Indian Ocean Time" => "BIOT British Indian Ocean Time",
        "BIT Baker Island Time" => "BIT Baker Island Time",
        "BOT Bolivia Time" => "BOT Bolivia Time",
        "BRST Brasilia Summer Time" => "BRST Brasilia Summer Time",
        "BRT Brasilia Time" => "BRT Brasilia Time",
        "BST Bangladesh Standard Time" => "BST Bangladesh Standard Time",
        "BST Bougainville Standard Time[4]" => "BST Bougainville Standard Time[4]",
        "BST British Summer Time (British Standard Time from Feb 1968 to Oct 1971)" => "BST British Summer Time (British Standard Time from Feb 1968 to Oct 1971)",
        "BTT Bhutan Time" => "BTT Bhutan Time",
        "CAT Central Africa Time" => "CAT Central Africa Time",
        "CCT Cocos Islands Time" => "CCT Cocos Islands Time",
        "CDT Central Daylight Time (North America)" => "CDT Central Daylight Time (North America)",
        "CDT Cuba Daylight Time[5]" => "CDT Cuba Daylight Time[5]",
        "CEDT Central European Daylight Time" => "CEDT Central European Daylight Time",
        "CEST Central European Summer Time (Cf. HAEC)" => "CEST Central European Summer Time (Cf. HAEC)",
        "CET Central European Time" => "CET Central European Time",
        "CHADT Chatham Daylight Time" => "CHADT Chatham Daylight Time",
        "CHAST Chatham Standard Time" => "CHAST Chatham Standard Time",
        "CHOT Choibalsan" => "CHOT Choibalsan",
        "ChST Chamorro Standard Time" => "ChST Chamorro Standard Time",
        "CHUT Chuuk Time" => "CHUT Chuuk Time",
        "CIST Clipperton Island Standard Time" => "CIST Clipperton Island Standard Time",
        "CIT Central Indonesia Time" => "CIT Central Indonesia Time",
        "CKT Cook Island Time" => "CKT Cook Island Time",
        "CLST Chile Summer Time" => "CLST Chile Summer Time",
        "CLT Chile Standard Time" => "CLT Chile Standard Time",
        "COST Colombia Summer Time" => "COST Colombia Summer Time",
        "COT Colombia Time" => "COT Colombia Time",
        "CST Central Standard Time (North America)" => "CST Central Standard Time (North America)",
        "CST China Standard Time" => "CST China Standard Time",
        "CST Central Standard Time (Australia)" => "CST Central Standard Time (Australia)",
        "CST Central Summer Time (Australia)" => "CST Central Summer Time (Australia)",
        "CST Cuba Standard Time" => "CST Cuba Standard Time",
        "CT China time" => "CT China time",
        "CVT Cape Verde Time" => "CVT Cape Verde Time",
        "CWST Central Western Standard Time (Australia) unofficial" => "CWST Central Western Standard Time (Australia) unofficial",
        "CXT Christmas Island Time" => "CXT Christmas Island Time",
        "DAVT Davis Time" => "DAVT Davis Time",
        "DDUT Dumont d'Urville Time" => "DDUT Dumont d'Urville Time",
        "DFT AIX specific equivalent of Central European Time[6]" => "DFT AIX specific equivalent of Central European Time[6]",
        "EASST Easter Island Standard Summer Time" => "EASST Easter Island Standard Summer Time",
        "EAST Easter Island Standard Time" => "EAST Easter Island Standard Time",
        "EAT East Africa Time" => "EAT East Africa Time",
        "ECT Eastern Caribbean Time (does not recognise DST)" => "ECT Eastern Caribbean Time (does not recognise DST)",
        "ECT Ecuador Time" => "ECT Ecuador Time",
        "EDT Eastern Daylight Time (North America)" => "EDT Eastern Daylight Time (North America)",
        "EEDT Eastern European Daylight Time" => "EEDT Eastern European Daylight Time",
        "EEST Eastern European Summer Time" => "EEST Eastern European Summer Time",
        "EET Eastern European Time" => "EET Eastern European Time",
        "EGST Eastern Greenland Summer Time" => "EGST Eastern Greenland Summer Time",
        "EGT Eastern Greenland Time" => "EGT Eastern Greenland Time",
        "EIT Eastern Indonesian Time" => "EIT Eastern Indonesian Time",
        "EST Eastern Standard Time (North America)" => "EST Eastern Standard Time (North America)",
        "EST Eastern Standard Time (Australia)" => "EST Eastern Standard Time (Australia)",
        "FET Further-eastern European Time" => "FET Further-eastern European Time",
        "FJT Fiji Time" => "FJT Fiji Time",
        "FKST Falkland Islands Standard Time" => "FKST Falkland Islands Standard Time",
        "FKST Falkland Islands Summer Time" => "FKST Falkland Islands Summer Time",
        "FKT Falkland Islands Time" => "FKT Falkland Islands Time",
        "FNT Fernando de Noronha Time" => "FNT Fernando de Noronha Time",
        "GALT Galapagos Time" => "GALT Galapagos Time",
        "GAMT Gambier Islands" => "GAMT Gambier Islands",
        "GET Georgia Standard Time" => "GET Georgia Standard Time",
        "GFT French Guiana Time" => "GFT French Guiana Time",
        "GILT Gilbert Island Time" => "GILT Gilbert Island Time",
        "GIT Gambier Island Time" => "GIT Gambier Island Time",
        "GMT Greenwich Mean Time" => "GMT Greenwich Mean Time",
        "GST South Georgia and the South Sandwich Islands" => "GST South Georgia and the South Sandwich Islands",
        "GST Gulf Standard Time" => "GST Gulf Standard Time",
        "GYT Guyana Time" => "GYT Guyana Time",
        "HADT Hawaii-Aleutian Daylight Time" => "HADT Hawaii-Aleutian Daylight Time",
        "HAEC Heure Avancée d'Europe Centrale francised name for CEST" => "HAEC Heure Avancée d'Europe Centrale francised name for CEST",
        "HAST Hawaii-Aleutian Standard Time" => "HAST Hawaii-Aleutian Standard Time",
        "HKT Hong Kong Time" => "HKT Hong Kong Time",
        "HMT Heard and McDonald Islands Time" => "HMT Heard and McDonald Islands Time",
        "HOVT Khovd Time" => "HOVT Khovd Time",
        "HST Hawaii Standard Time" => "HST Hawaii Standard Time",
        "IBST International Business Standard Time" => "IBST International Business Standard Time",
        "ICT Indochina Time" => "ICT Indochina Time",
        "IDT Israel Daylight Time" => "IDT Israel Daylight Time",
        "IOT Indian Ocean Time" => "IOT Indian Ocean Time",
        "IRDT Iran Daylight Time" => "IRDT Iran Daylight Time",
        "IRKT Irkutsk Time" => "IRKT Irkutsk Time",
        "IRST Iran Standard Time" => "IRST Iran Standard Time",
        "IST Indian Standard Time" => "IST Indian Standard Time",
        "IST Irish Standard Time[7]" => "IST Irish Standard Time[7]",
        "IST Israel Standard Time" => "IST Israel Standard Time",
        "JST Japan Standard Time" => "JST Japan Standard Time",
        "KGT Kyrgyzstan time" => "KGT Kyrgyzstan time",
        "KOST Kosrae Time" => "KOST Kosrae Time",
        "KRAT Krasnoyarsk Time" => "KRAT Krasnoyarsk Time",
        "KST Korea Standard Time" => "KST Korea Standard Time",
        "LHST Lord Howe Standard Time" => "LHST Lord Howe Standard Time",
        "LHST Lord Howe Summer Time" => "LHST Lord Howe Summer Time",
        "LINT Line Islands Time" => "LINT Line Islands Time",
        "MAGT Magadan Time" => "MAGT Magadan Time",
        "MART Marquesas Islands Time" => "MART Marquesas Islands Time",
        "MAWT Mawson Station Time" => "MAWT Mawson Station Time",
        "MDT Mountain Daylight Time (North America)" => "MDT Mountain Daylight Time (North America)",
        "MET Middle European Time Same zone as CET" => "MET Middle European Time Same zone as CET",
        "MEST Middle European Summer Time Same zone as CEST" => "MEST Middle European Summer Time Same zone as CEST",
        "MHT Marshall Islands" => "MHT Marshall Islands",
        "MIST Macquarie Island Station Time" => "MIST Macquarie Island Station Time",
        "MIT Marquesas Islands Time" => "MIT Marquesas Islands Time",
        "MMT Myanmar Time" => "MMT Myanmar Time",
        "MSK Moscow Time" => "MSK Moscow Time",
        "MST Malaysia Standard Time" => "MST Malaysia Standard Time",
        "MST Mountain Standard Time (North America)" => "MST Mountain Standard Time (North America)",
        "MST Myanmar Standard Time" => "MST Myanmar Standard Time",
        "MUT Mauritius Time" => "MUT Mauritius Time",
        "MVT Maldives Time" => "MVT Maldives Time",
        "MYT Malaysia Time" => "MYT Malaysia Time",
        "NCT New Caledonia Time" => "NCT New Caledonia Time",
        "NDT Newfoundland Daylight Time" => "NDT Newfoundland Daylight Time",
        "NFT Norfolk Time" => "NFT Norfolk Time",
        "NPT Nepal Time" => "NPT Nepal Time",
        "NST Newfoundland Standard Time" => "NST Newfoundland Standard Time",
        "NT Newfoundland Time" => "NT Newfoundland Time",
        "NUT Niue Time" => "NUT Niue Time",
        "NZDT New Zealand Daylight Time" => "NZDT New Zealand Daylight Time",
        "NZST New Zealand Standard Time" => "NZST New Zealand Standard Time",
        "OMST Omsk Time" => "OMST Omsk Time",
        "ORAT Oral Time" => "ORAT Oral Time",
        "PDT Pacific Daylight Time (North America)" => "PDT Pacific Daylight Time (North America)",
        "PET Peru Time" => "PET Peru Time",
        "PETT Kamchatka Time" => "PETT Kamchatka Time",
        "PGT Papua New Guinea Time" => "PGT Papua New Guinea Time",
        "PHOT Phoenix Island Time" => "PHOT Phoenix Island Time",
        "PKT Pakistan Standard Time" => "PKT Pakistan Standard Time",
        "PMDT Saint Pierre and Miquelon Daylight time" => "PMDT Saint Pierre and Miquelon Daylight time",
        "PMST Saint Pierre and Miquelon Standard Time" => "PMST Saint Pierre and Miquelon Standard Time",
        "PONT Pohnpei Standard Time" => "PONT Pohnpei Standard Time",
        "PST Pacific Standard Time (North America)" => "PST Pacific Standard Time (North America)",
        "PST Philippine Standard Time" => "PST Philippine Standard Time",
        "PYST Paraguay Summer Time (South America)[8]" => "PYST Paraguay Summer Time (South America)[8]",
        "PYT Paraguay Time (South America)[9]" => "PYT Paraguay Time (South America)[9]",
        "RET Réunion Time" => "RET Réunion Time",
        "ROTT Rothera Research Station Time" => "ROTT Rothera Research Station Time",
        "SAKT Sakhalin Island time" => "SAKT Sakhalin Island time",
        "SAMT Samara Time" => "SAMT Samara Time",
        "SAST South African Standard Time" => "SAST South African Standard Time",
        "SBT Solomon Islands Time" => "SBT Solomon Islands Time",
        "SCT Seychelles Time" => "SCT Seychelles Time",
        "SGT Singapore Time" => "SGT Singapore Time",
        "SLST Sri Lanka Standard Time" => "SLST Sri Lanka Standard Time",
        "SRET Srednekolymsk Time" => "SRET Srednekolymsk Time",
        "SRT Suriname Time" => "SRT Suriname Time",
        "SST Samoa Standard Time" => "SST Samoa Standard Time",
        "SST Singapore Standard Time" => "SST Singapore Standard Time",
        "SYOT Showa Station Time" => "SYOT Showa Station Time",
        "TAHT Tahiti Time" => "TAHT Tahiti Time",
        "THA Thailand Standard Time" => "THA Thailand Standard Time",
        "TFT Indian/Kerguelen" => "TFT Indian/Kerguelen",
        "TJT Tajikistan Time" => "TJT Tajikistan Time",
        "TKT Tokelau Time" => "TKT Tokelau Time",
        "TLT Timor Leste Time" => "TLT Timor Leste Time",
        "TMT Turkmenistan Time" => "TMT Turkmenistan Time",
        "TOT Tonga Time" => "TOT Tonga Time",
        "TVT Tuvalu Time" => "TVT Tuvalu Time",
        "UCT Coordinated Universal Time" => "UCT Coordinated Universal Time",
        "ULAT Ulaanbaatar Time" => "ULAT Ulaanbaatar Time",
        "USZ1 Kaliningrad Time" => "USZ1 Kaliningrad Time",
        "UTC Coordinated Universal Time" => "UTC Coordinated Universal Time",
        "UYST Uruguay Summer Time" => "UYST Uruguay Summer Time",
        "UYT Uruguay Standard Time" => "UYT Uruguay Standard Time",
        "UZT Uzbekistan Time" => "UZT Uzbekistan Time",
        "VET Venezuelan Standard Time" => "VET Venezuelan Standard Time",
        "VLAT Vladivostok Time" => "VLAT Vladivostok Time",
        "VOLT Volgograd Time" => "VOLT Volgograd Time",
        "VOST Vostok Station Time" => "VOST Vostok Station Time",
        "VUT Vanuatu Time" => "VUT Vanuatu Time",
        "WAKT Wake Island Time" => "WAKT Wake Island Time",
        "WAST West Africa Summer Time" => "WAST West Africa Summer Time",
        "WAT West Africa Time" => "WAT West Africa Time",
        "WEDT Western European Daylight Time" => "WEDT Western European Daylight Time",
        "WEST Western European Summer Time" => "WEST Western European Summer Time",
        "WET Western European Time" => "WET Western European Time",
        "WIT Western Indonesian Time" => "WIT Western Indonesian Time",
        "WST Western Standard Time" => "WST Western Standard Time",
        "YAKT Yakutsk Time" => "YAKT Yakutsk Time",
        "YEKT Yekaterinburg Time" => "YEKT Yekaterinburg Time",
        "Z Zulu Time (Coordinated Universal Time)" => "Z Zulu Time (Coordinated Universal Time)",

    ]) ?>

    <?= $form->field($model, 'owner')->textInput(['maxlength' => true, 'placeholder' => 'Owner']) ?>

    <?= $form->field($model, 'company_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\Company::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
        'options' => ['placeholder' => 'Choose Company'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'general_info_email')->textInput(['maxlength' => true, 'placeholder' => 'General Info Email']) ?>

    <?= $form->field($model, 'main_office_phone')->textInput(['maxlength' => true, 'placeholder' => 'Main Office Phone']) ?>

    <?= $form->field($model, 'box_office_phone')->textInput(['maxlength' => true, 'placeholder' => 'Box Office Phone']) ?>

    <?= $form->field($model, 'fax_phone')->textInput(['maxlength' => true, 'placeholder' => 'Fax Phone']) ?>

    <?= $form->field($model, 'other_phone')->textInput(['maxlength' => true, 'placeholder' => 'Other Phone']) ?>

    <?= $form->field($model, 'primary_ticketing_company_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\Company::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
        'options' => ['placeholder' => 'Choose Company'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'other_seating_capacity')->textInput(['placeholder' => 'Other Seating Capacity']) ?>

    <?= $form->field($model, 'end_stage_seating_capacity')->textInput(['placeholder' => 'End Stage Seating Capacity']) ?>

    <?= $form->field($model, 'full_stage_seating_capacity')->textInput(['placeholder' => 'Full Stage Seating Capacity']) ?>

    <?= $form->field($model, 'half_stage_seating_capacity')->textInput(['placeholder' => 'Half Stage Seating Capacity']) ?>

    <?= $form->field($model, 'in_the_round_seating_capacity')->textInput(['placeholder' => 'In The Round Seating Capacity']) ?>

    <?= $form->field($model, 'other_seating_capacity_name')->textInput(['placeholder' => 'Other Seating Capacity Name']) ?>

    <?= $form->field($model, 'other_seating_capacity_value')->textInput(['placeholder' => 'Other Seating Capacity Value']) ?>

    <?= $form->field($model, 'webpage')->textInput(['maxlength' => true, 'placeholder' => 'Webpage']) ?>

    <?= $form->field($model, 'facebook')->textInput(['maxlength' => true, 'placeholder' => 'Facebook']) ?>

    <?= $form->field($model, 'yahoo')->textInput(['maxlength' => true, 'placeholder' => 'Yahoo']) ?>

    <?= $form->field($model, 'linkedin')->textInput(['maxlength' => true, 'placeholder' => 'Linkedin']) ?>

    <?= $form->field($model, 'twitter')->textInput(['maxlength' => true, 'placeholder' => 'Twitter']) ?>

    <?= $form->field($model, 'instagram')->textInput(['maxlength' => true, 'placeholder' => 'Instagram']) ?>

    <?= $form->field($model, 'google')->textInput(['maxlength' => true, 'placeholder' => 'Google']) ?>

    <?= $form->field($model, 'belong_company_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\Company::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
        'options' => ['placeholder' => 'Choose Company'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'), Yii::$app->request->referrer, ['class' => 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
