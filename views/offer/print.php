<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
//use kartik\time\TimePicker;
use vakorovin\datetimepicker\Datetimepicker;

/* @var $this yii\web\View */
/* @var $model app\models\Offer */
/* @var $form app\views\widgets\ActiveForm */

$booked_by = $model->user ? $model->user->username : '';
?>

    <? //= print_r($model->attributes);?>
    <div class="row">
        <label class="col-xs-1">Booked By</label>
        <span class="col-xs-2"><?= $booked_by ?></span>
        <label class="col-xs-1">Offer Type</label>
        <span class="col-xs-2"><?= $model->offer_type ?></span>
        <label class="col-xs-1">Co Pro Promoter</label>
        <span class="col-xs-2"><?= $model->coproPromoter ? $model->coproPromoter->name : '' ?></span>
    </div>
    <div class="row">
        <label class="col-xs-1">Co Pro Venue</label>
        <span class="col-xs-2"><?= $model->coproVenue ? $model->coproVenue->name : '' ?></span>
        <label class="col-xs-1">Event ID</label>
        <span class="col-xs-2"><?= $model->event_id ?></span>
        <label class="col-xs-1">Show #</label>
        <span class="col-xs-2"><?= $model->show_number ?> of <?= $model->show_total_num ?></span>
    </div>
    <div class="row">
        <label class="col-xs-1">Agency</label>
        <span class="col-xs-2"><?= $model->agency ? $model->agency->name : '' ?></span>
        <label class="col-xs-1">Agent</label>
        <span class="col-xs-2"><?= $model->agent ? ($model->agent->first_name . ' ' . $model->agent->last_name) : '' ?></span>
        <label class="col-xs-1">Status</label>
        <span class="col-xs-2"><?= $model->status ?></span>
    </div>
    <div class="row">
        <label class="col-xs-1">Artist</label>
        <span class="col-xs-2"><?= $model->artist ? ($model->artist->first_name . ' ' . $model->artist->last_name) : '' ?></span>
        <label class="col-xs-1">Venue</label>
        <span class="col-xs-2"><?= $model->venue ? $model->venue->name : '' ?></span>
        <label class="col-xs-1">Show Date</label>
        <span class="col-xs-1"><?= $model->is_tbd_date ? 'Is TBD' : '' ?></span>
        <span class="col-xs-2"><?= $model->show_date??'' ?></span>
    </div>
    <div class="row">
        <label class="col-xs-1">Show Type</label>
        <span class="col-xs-2"><?= $model->show_type ?></span>
        <label class="col-xs-1">Door time</label>
        <span class="col-xs-2"><?= $model->doors ?></span>
        <label class="col-xs-1">Showtime</label>
        <span class="col-xs-2"><?= $model->showtime ?></span>
    </div>
    <div class="row">
        <label class="col-xs-1">Notes</label>
        <span title="notes" class="col-xs-11"><?= $model->notes ?></span>
    </div>
    <div class="row">
        <label class="col-xs-1">L1 Gross Ticket</label>
        <span class="col-xs-2"><?= $model->l1_gross_ticket ?></span>
        <label class="col-xs-1">L1 Kill</label>
        <span class="col-xs-2"><?= $model->l1_kill ?></span>
        <label class="col-xs-1">L1 Price</label>
        <span class="col-xs-2"><?= $model->l1_price ?></span>
    </div>
    <div class="row">
        <label class="col-xs-1">L2 Gross Ticket</label>
        <span class="col-xs-2"><?= $model->l2_gross_ticket ?></span>
        <label class="col-xs-1">L2 Kill</label>
        <span class="col-xs-2"><?= $model->l2_kill ?></span>
        <label class="col-xs-1">L2 Price</label>
        <span class="col-xs-2"><?= $model->l2_price ?></span>
    </div>
    <div class="row">
        <label class="col-xs-1">L3 Gross Ticket</label>
        <span class="col-xs-2"><?= $model->l3_gross_ticket ?></span>
        <label class="col-xs-1">L3 Kill</label>
        <span class="col-xs-2"><?= $model->l3_kill ?></span>
        <label class="col-xs-1">L3 Price</label>
        <span class="col-xs-2"><?= $model->l3_price ?></span>
    </div>

    <div class="row">
        <label class="col-xs-1">L4 Gross Ticket</label>
        <span class="col-xs-2"><?= $model->l4_gross_ticket ?></span>
        <label class="col-xs-1">L4 Kill</label>
        <span class="col-xs-2"><?= $model->l4_kill ?></span>
        <label class="col-xs-1">L4 Price</label>
        <span class="col-xs-2"><?= $model->l4_price ?></span>
    </div>
    <div class="row">
        <label class="col-xs-1">L5 Gross Ticket</label>
        <span class="col-xs-2"><?= $model->l5_gross_ticket ?></span>
        <label class="col-xs-1">L5 Kill</label>
        <span class="col-xs-2"><?= $model->l5_kill ?></span>
        <label class="col-xs-1">L5 Price</label>
        <span class="col-xs-2"><?= $model->l5_price ?></span>
    </div>
    <div class="row">
        <label class="col-xs-1">On Sale Date</label>
        <span class="col-xs-1"><?= $model->is_on_sale_date_tbd ? 'TBD' : '' ?></span>
        <span class="col-xs-1"><?= $model->on_sale_date ?></span>
        <label class="col-xs-1">Ticketing Company</label>
        <span class="col-xs-2"><?= $model->ticketingCompany ? $model->ticketingCompany->name : '' ?></span>
        <label class="col-xs-1">Seating Plan</label>
        <span class="col-xs-2"><?= $model->seating_plan ?></span>
    </div>
    <div class="page_break"></div>

    <div class="row">
        <label class="col-xs-1">Tax</label>
        <span class="col-xs-2"><?= $model->tax ?></span>
        <label class="col-xs-1">Tax Note</label>
        <span class="col-xs-2"><?= $model->tax_note ?></span>
        <label class="col-xs-1">Tax Per Ticket</label>
        <span class="col-xs-2"><?= $model->tax_per_ticket ?></span>
    </div>
<!--    <div class="row">-->
<!--        <label class="col-xs-1">Facility Fee</label>-->
<!--        <span class="col-xs-2">--><?//= $model->facility_fee ?><!--</span>-->
<!--        <span class="col-xs-3">&nbsp;</span>-->
<!--        <label class="col-xs-1">Facility Fee Note</label>-->
<!--        <span class="col-xs-2">--><?//= $model->facility_fee_note ?><!--</span>-->
<!--    </div>-->
    <div class="row">
        <label class="col-xs-1">Artist Guarantee</label>
        <span class="col-xs-2"><?= $model->artist_guarantee ?></span>
        <label class="col-xs-1">Artist Deposit</label>
        <span class="col-xs-2"><?= $model->artist_deposit ?></span>
        <label class="col-xs-1">Artist Offer Type</label>
        <span class="col-xs-2"><?= $model->artist_offer_type ?></span>
    </div>
<!--    <div class="row">-->
<!--        <label class="col-xs-1">Is Artist Production Buyout?</label>-->
<!--        <span class="col-xs-2">--><?//= $model->is_artist_production_buyout ? 'Yes' : 'No' ?><!--</span>-->
<!--        <label class="col-xs-1">Artist Split</label>-->
<!--        <span class="col-xs-2">--><?//= $model->artist_split ?><!--</span>-->
<!--        <label class="col-xs-1">Promoter Profit</label>-->
<!--        <span class="col-xs-2">--><?//= $model->promoter_profit ?><!--</span>-->
<!--    </div>-->
<!--    <div class="row">-->
<!--        <label class="col-xs-1">Expense Application</label>-->
<!--        <span class="col-xs-2">--><?//= $model->expense_application ?><!--</span>-->
<!--        <label class="col-xs-1">Sponsorship</label>-->
<!--        <span class="col-xs-2">--><?//= $model->sponsorship ?><!--</span>-->
<!--        <label class="col-xs-1">Radius Clause</label>-->
<!--        <span class="col-xs-1">--><?//= $model->radius_clause ?><!--</span>-->
<!--        <span class="col-xs-1">--><?//= $model->radius_clause_metric ?><!--</span>-->
<!--    </div>-->
<!--    <div class="row">-->
<!--        <label class="col-xs-1">Pre Show Lockout</label>-->
<!--        <span class="col-xs-1">--><?//= $model->pre_show_lockout ?><!--</span>-->
<!--        <span class="col-xs-1">--><?//= $model->pre_show_lockout?$model->pre_show_lockout_unit:'' ?><!--</span>-->
<!--        <label class="col-xs-1">Post Show Lockout</label>-->
<!--        <span class="col-xs-1">--><?//= $model->post_show_lockout ?><!--</span>-->
<!--        <span class="col-xs-1">--><?//= $model->post_show_lockout?$model->post_show_lockout_unit:'' ?><!--</span>-->
<!--        <label class="col-xs-1">Artist Deal Note</label>-->
<!--        <span class="col-xs-2">--><?//= $model->artist_deal_note ?><!--</span>-->
<!--    </div>-->

    <!---->
    <!--    --><? //= $form->field($model, 'pre_show_lockout', ['options' => ['class' => 'form-group col-sm-2']])->textInput(['placeholder' => 'Pre Show Lockout']) ?>
    <!---->
    <!--    --><? //= $form->field($model, 'pre_show_lockout_unit', ['options' => ['class' => 'form-group col-sm-3']])->dropDownList(['Days' => 'Days', 'Months' => 'Months',]) ?>
    <!---->
    <!--    --><? //= $form->field($model, 'post_show_lockout', ['options' => ['class' => 'form-group col-sm-5']])->textInput(['placeholder' => 'Post Show Lockout']) ?>
    <!---->
    <!--    --><? //= $form->field($model, 'post_show_lockout_unit', ['options' => ['class' => 'form-group col-sm-5']])->dropDownList(['Days' => 'Days', 'Months' => 'Months',]) ?>
    <!---->
    <!--    --><? //= $form->field($model, 'artist_deal_note', ['options' => ['class' => 'form-group col-sm-10']])->textarea(['maxlength' => true, 'placeholder' => 'Artist Deal Note']) ?>
    <!---->
    <!--    --><? //= $form->field($model, 'support_artist_1_id', ['options' => ['class' => 'form-group col-sm-5']])->widget(\kartik\widgets\Select2::classname(), [
    //        'data' => \yii\helpers\ArrayHelper::map(\app\models\User::find()->orderBy('id')->asArray()->all(), 'id', 'username'),
    //        'options' => ['placeholder' => 'Choose User'],
    //        'pluginOptions' => [
    //            'allowClear' => true
    //        ],
    //    ]); ?>
    <!---->
    <!--    --><? //= $form->field($model, 'support_artist_1_total', ['options' => ['class' => 'form-group col-sm-5']])->textInput(['maxlength' => true, 'placeholder' => 'Support Artist 1 Total']) ?>
    <!---->
    <!--    --><? //= $form->field($model, 'support_artist_2_id', ['options' => ['class' => 'form-group col-sm-5']])->widget(\kartik\widgets\Select2::classname(), [
    //        'data' => \yii\helpers\ArrayHelper::map(\app\models\User::find()->orderBy('id')->asArray()->all(), 'id', 'username'),
    //        'options' => ['placeholder' => 'Choose User'],
    //        'pluginOptions' => [
    //            'allowClear' => true
    //        ],
    //    ]); ?>
    <!---->
    <!--    --><? //= $form->field($model, 'support_artist_2_total', ['options' => ['class' => 'form-group col-sm-5']])->textInput(['maxlength' => true, 'placeholder' => 'Support Artist 2 Total']) ?>
    <!---->
    <!--    --><? //= $form->field($model, 'support_artist_3_id', ['options' => ['class' => 'form-group col-sm-5']])->widget(\kartik\widgets\Select2::classname(), [
    //        'data' => \yii\helpers\ArrayHelper::map(\app\models\User::find()->orderBy('id')->asArray()->all(), 'id', 'username'),
    //        'options' => ['placeholder' => 'Choose User'],
    //        'pluginOptions' => [
    //            'allowClear' => true
    //        ],
    //    ]); ?>
    <!---->
    <!--    --><? //= $form->field($model, 'support_artist_3_total', ['options' => ['class' => 'form-group col-sm-5']])->textInput(['maxlength' => true, 'placeholder' => 'Support Artist 3 Total']) ?>
    <!---->
    <!--    --><? //= $form->field($model, 'general_expense', ['options' => ['class' => 'form-group col-sm-10']])->textarea(['maxlength' => true, 'placeholder' => 'General Expense', 'readonly' => true, 'rows' => 10]) ?>
    <!---->
    <!--    --><? //= $form->field($model, 'production_expense', ['options' => ['class' => 'form-group col-sm-10']])->textarea(['maxlength' => true, 'placeholder' => 'Production Expense', 'readonly' => true, 'rows' => 3]) ?>
    <!---->
    <!--    --><? //= $form->field($model, 'housenut_total', ['options' => ['class' => 'form-group col-sm-5']])->textInput(['maxlength' => true, 'placeholder' => 'Housenut Total']) ?>
    <!---->
    <!--    --><? //= $form->field($model, 'housenut_expense', ['options' => ['class' => 'form-group col-sm-5']])->textInput(['maxlength' => true, 'placeholder' => 'Housenut Expense']) ?>
    <!---->
    <!--    --><? //= $form->field($model, 'general_expense_note', ['options' => ['class' => 'form-group col-sm-10']])->textarea(['maxlength' => true, 'placeholder' => 'General Expense Note']) ?>
    <!---->
    <!--    --><? //= $form->field($model, 'variable_expense', ['options' => ['class' => 'form-group col-sm-10']])->textarea(['maxlength' => true, 'placeholder' => 'Variable Expense', 'readonly' => true, 'rows' => 5]) ?>
    <!--    <div class="clearfix"></div>-->
    <!---->
    <!--    --><? //= $form->field($model, 'merch_buyout_venue_sell', ['options' => ['class' => 'form-group col-sm-2']])->textInput(['maxlength' => true, 'placeholder' => 'Merch Buyout Venue Sell']) ?>
    <!---->
    <!--    --><? //= $form->field($model, 'merch_buyout_artist_sell', ['options' => ['class' => 'form-group col-sm-2']])->textInput(['maxlength' => true, 'placeholder' => 'Merch Buyout Artist Sell']) ?>
    <!---->
    <!--    --><? //= $form->field($model, 'merch_artist_split_venue_sell', ['options' => ['class' => 'form-group col-sm-2 col-sm-offset-2']])->textInput(['maxlength' => true, 'placeholder' => 'Merch Artist Split Venue Sell']) ?>
    <!---->
    <!--    --><? //= $form->field($model, 'merch_artist_split_artist_sell', ['options' => ['class' => 'form-group col-sm-2']])->textInput(['maxlength' => true, 'placeholder' => 'Merch Artist Split Artist Sell']) ?>
    <!---->
    <!--    <div class="clearfix"></div>-->
    <!---->
    <!---->
    <!--    --><? //= $form->field($model, 'merch_venue_split_venue_sell', ['options' => ['class' => 'form-group col-sm-2']])->textInput(['maxlength' => true, 'placeholder' => 'Merch Venue Split Venue Sell']) ?>
    <!---->
    <!--    --><? //= $form->field($model, 'merch_venue_split_artist_sell', ['options' => ['class' => 'form-group col-sm-2']])->textInput(['maxlength' => true, 'placeholder' => 'Merch Venue Split Artist Sell']) ?>
    <!---->
    <!--    --><? //= $form->field($model, 'merch_artist_split_media_venue_sell', ['options' => ['class' => 'form-group col-sm-2 col-sm-offset-2']])->textInput(['maxlength' => true, 'placeholder' => 'Merch Venue Split Artist Sell']) ?>
    <!---->
    <!--    --><? //= $form->field($model, 'merch_artist_split_media_artist_sell', ['options' => ['class' => 'form-group col-sm-2 ']])->textInput(['maxlength' => true, 'placeholder' => 'Merch Artist Split Media Artist Sell']) ?>
    <!---->
    <!--    <div class="clearfix"></div>-->
    <!---->
    <!--    --><? //= $form->field($model, 'merch_venue_split_media_venue_sell', ['options' => ['class' => 'form-group col-sm-2']])->textInput(['maxlength' => true, 'placeholder' => 'Merch Venue Split Media Venue Sell']) ?>
    <!--    --><? //= $form->field($model, 'merch_venue_split_media_artist_sell', ['options' => ['class' => 'form-group col-sm-2']])->textInput(['maxlength' => true, 'placeholder' => 'Merch Venue Split Media Artist Sell']) ?>
    <!---->
    <!--    --><? //= $form->field($model, 'merch_note', ['options' => ['class' => 'form-group col-sm-6']])->textarea(['maxlength' => true, 'placeholder' => 'Merch Note']) ?>
    <!---->
    <!--    --><? //= $form->field($model, 'artist_comp', ['options' => ['class' => 'form-group col-sm-5']])->textInput(['placeholder' => 'Artist Comp']) ?>
    <!---->
    <!--    --><? //= $form->field($model, 'artist_comp_note', ['options' => ['class' => 'form-group col-sm-5']])->textarea(['maxlength' => true, 'placeholder' => 'Artist Comp Note']) ?>
    <!---->
    <!--    --><? //= $form->field($model, 'production_comp', ['options' => ['class' => 'form-group col-sm-5']])->textInput(['placeholder' => 'Production Comp']) ?>
    <!---->
    <!--    --><? //= $form->field($model, 'production_comp_note', ['options' => ['class' => 'form-group col-sm-5']])->textarea(['maxlength' => true, 'placeholder' => 'Production Comp Note']) ?>
    <!---->
    <!--    --><? //= $form->field($model, 'promotional_comp', ['options' => ['class' => 'form-group col-sm-5']])->textInput(['placeholder' => 'Promotional Comp']) ?>
    <!---->
    <!--    --><? //= $form->field($model, 'promotional_comp_note', ['options' => ['class' => 'form-group col-sm-5']])->textarea(['maxlength' => true, 'placeholder' => 'Promotional Comp Note']) ?>
    <!---->
    <!--    --><? //= $form->field($model, 'house_comp', ['options' => ['class' => 'form-group col-sm-5']])->textInput(['placeholder' => 'House Comp']) ?>
    <!---->
    <!--    --><? //= $form->field($model, 'house_comp_note', ['options' => ['class' => 'form-group col-sm-5']])->textarea(['maxlength' => true, 'placeholder' => 'House Comp Note']) ?>
    <!---->
    <!--    --><? //= $form->field($model, 'kill', ['options' => ['class' => 'form-group col-sm-5']])->textInput(['placeholder' => 'Kill']) ?>
    <!---->
    <!--    --><? //= $form->field($model, 'kill_note', ['options' => ['class' => 'form-group col-sm-5']])->textarea(['maxlength' => true, 'placeholder' => 'Kill Note']) ?>
    <!---->
    <!--    --><? //= $form->field($model, 'comp_kill_note', ['options' => ['class' => 'form-group col-sm-10']])->textarea(['maxlength' => true, 'placeholder' => 'Comp Kill Note']) ?>
    <!--    <div class="clearfix"></div>-->
    <!---->
    <!--    --><? //= $form->field($model, 'ascap_0_2500', ['options' => ['class' => 'form-group col-sm-2']])->textInput(['maxlength' => true, 'placeholder' => 'Ascap 0 2500']) ?>
    <!--    --><? //= $form->field($model, 'ascap_2501_5000', ['options' => ['class' => 'form-group col-sm-2']])->textInput(['maxlength' => true, 'placeholder' => 'Ascap 2501 5000']) ?>
    <!--    --><? //= $form->field($model, 'ascap_5001_10000', ['options' => ['class' => 'form-group col-sm-2']])->textInput(['maxlength' => true, 'placeholder' => 'Ascap 5001 10000']) ?>
    <!--    --><? //= $form->field($model, 'ascap_10001_25000', ['options' => ['class' => 'form-group col-sm-2']])->textInput(['maxlength' => true, 'placeholder' => 'Ascap 10001 25000']) ?>
    <!--    --><? //= $form->field($model, 'ascap_25001_x', ['options' => ['class' => 'form-group col-sm-2 ']])->textInput(['maxlength' => true, 'placeholder' => 'Ascap 25001 X']) ?>
    <!--    <div class="clearfix"></div>-->
    <!---->
    <!--    --><? //= $form->field($model, 'bmi_0_2500', ['options' => ['class' => 'form-group col-sm-2']])->textInput(['maxlength' => true, 'placeholder' => 'Bmi 0 2500']) ?>
    <!--    --><? //= $form->field($model, 'bmi_2501_5000', ['options' => ['class' => 'form-group col-sm-2']])->textInput(['maxlength' => true, 'placeholder' => 'Bmi 2501 5000']) ?>
    <!--    --><? //= $form->field($model, 'bmi_5001_10000', ['options' => ['class' => 'form-group col-sm-2']])->textInput(['maxlength' => true, 'placeholder' => 'Bmi 5001 10000']) ?>
    <!--    --><? //= $form->field($model, 'bmi_10001_25000', ['options' => ['class' => 'form-group col-sm-2']])->textInput(['maxlength' => true, 'placeholder' => 'Bmi 10001 25000']) ?>
    <!--    --><? //= $form->field($model, 'bmi_25001_x', ['options' => ['class' => 'form-group col-sm-2 ']])->textInput(['maxlength' => true, 'placeholder' => 'Bmi 25001 X']) ?>
    <!--    <div class="clearfix"></div>-->
    <!--    <div class="form-group">-->
    <!--        --><? //= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    <!--        --><? //= Html::a(Yii::t('app', 'Cancel'), Yii::$app->request->referrer, ['class' => 'btn btn-danger']) ?>
    <!--    </div>-->

