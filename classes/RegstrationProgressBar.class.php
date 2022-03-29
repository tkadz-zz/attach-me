<?php

class RegstrationProgressBar extends Users
{
    public function viewProgressBar($id)
    {
    $rows = parent::GetUser($id);

    $active = 'primary';
    $inactive = 'dark';
    $de_active = 'danger';

    $regS = $rows[0]['regStatus'];

    if($regS == NULL ){
        $one = $active;
        $two = $inactive;
        $three = $inactive;
        $four = $inactive;
    }

    elseif($regS == 1 ){
        $one = $active;
        $two = $inactive;
        $three = $inactive;
        $four = $inactive;
    }
    elseif ($regS == 2){
        $one = $active;
        $two = $active;
        $three = $inactive;
        $four = $inactive;
    }
    elseif ($regS == 3){
        $one = $active;
        $two = $active;
        $three = $active;
        $four = $inactive;
    }
    elseif ($regS == 4){
        $one = $active;
        $two = $active;
        $three = $active;
        $four = $active;
    }
    else{
        $one = $de_active;
        $two = $de_active;
        $three = $de_active;
        $four = $de_active;
    }

   ?>
    <style>
        .steps-form {
            display: table;
            width: 100%;
            position: relative; }
        .steps-form .steps-row {
            display: table-row; }
        .steps-form .steps-row:before {
            top: 14px;
            bottom: 0;
            position: absolute;
            content: " ";
            width: 100%;
            height: 1px;
            background-color: #ccc; }
        .steps-form .steps-row .steps-step {
            display: table-cell;
            text-align: center;
            position: relative; }
        .steps-form .steps-row .steps-step p {
            margin-top: 0.5rem; }
        .steps-form .steps-row .steps-step button[disabled] {
            opacity: 1 !important;
            filter: alpha(opacity=100) !important; }
        .steps-form .steps-row .steps-step .btn-circle {
            width: 30px;
            height: 30px;
            text-align: center;
            padding: 6px 0;
            font-size: 12px;
            line-height: 1.428571429;
            border-radius: 15px;
            margin-top: 0; }
    </style>


        <div class="steps-form text-left">
            <div class="steps-row setup-panel">
                <div class="steps-step">
                    <a href="#step-1" type="button" class="btn btn-<?php echo $one ?> shadow btn-circle">1</a>
                    <p>Account Creation</p>
                </div>
                <div class="steps-step">
                    <a href="#step-2" type="button" class="btn btn-<?php echo $two ?> shadow btn-circle" disabled="disabled">2</a>
                    <p>Personal details</p>
                </div>
                <div class="steps-step">
                    <a href="#step-3" type="button" class="btn btn-<?php echo $three ?> shadow btn-circle" disabled="disabled">3</a>
                    <p>Education details</p>
                </div>
                <div class="steps-step">
                    <a href="#step-4" type="button" class="btn btn-<?php echo $four ?> shadow btn-circle" disabled="disabled">4</a>
                    <p>FINISH <span class="fa fa-check"></span></p>
                </div>
            </div>
        </div>

    <script>
        $(document).ready(function () {
            var navListItems = $('div.setup-panel div a'),
                allWells = $('.setup-content'),
                allNextBtn = $('.nextBtn'),
                allPrevBtn = $('.prevBtn');

            allWells.hide();

            navListItems.click(function (e) {
                e.preventDefault();
                var $target = $($(this).attr('href')),
                    $item = $(this);

                if (!$item.hasClass('disabled')) {
                    navListItems.removeClass('btn-indigo').addClass('btn-default');
                    $item.addClass('btn-indigo');
                    allWells.hide();
                    $target.show();
                    $target.find('input:eq(0)').focus();
                }
            });

            allPrevBtn.click(function(){
                var curStep = $(this).closest(".setup-content"),
                    curStepBtn = curStep.attr("id"),
                    prevStepSteps = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().prev().children("a");

                prevStepSteps.removeAttr('disabled').trigger('click');
            });

            allNextBtn.click(function(){
                var curStep = $(this).closest(".setup-content"),
                    curStepBtn = curStep.attr("id"),
                    nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
                    curInputs = curStep.find("input[type='text'],input[type='url']"),
                    isValid = true;

                $(".form-group").removeClass("has-error");
                for(var i=0; i< curInputs.length; i++){
                    if (!curInputs[i].validity.valid){
                        isValid = false;
                        $(curInputs[i]).closest(".form-group").addClass("has-error");
                    }
                }

                if (isValid)
                    nextStepWizard.removeAttr('disabled').trigger('click');
            });

            $('div.setup-panel div a.btn-indigo').trigger('click');
        });
    </script>
   <?php
    }

}