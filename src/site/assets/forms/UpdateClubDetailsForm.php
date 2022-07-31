<?php
$message = "";
if (isset($_POST['submit_btn'])){ // Check if form was submitted
    JSession::checkToken() or die('Invalid Token');
    $message = "TODO, Implement form handling";
    JFactory::getApplication()->enqueueMessage($message);
}
?>

<form id="update_club" method="post">
    <div class="rendered-form">
        <div class="">
            <p access="false" id="control-5833132">Every year we ask you to check and update your club’s contact
                details. These will only be used by SWA committee members to contact you and your committee with
                important information about issues that directly affect your club and occasionally about events that
                your club and its members are eligible to attend. Please remember to promote newly elected senior
                committee members to committee status on your ‘club page’ on the SWA website so they will have access to
                this form at the beginning of their term.</p>
        </div>
        <div class="formbuilder-text form-group field-text-1653743614582">
            <label for="text-1653743614582" class="formbuilder-text-label">Club Name<span
                        class="formbuilder-required">*</span></label>
            <input type="text" class="form-control" name="text-1653743614582" access="false" id="text-1653743614582"
                   required="required" aria-required="true">
        </div>
        <div class="formbuilder-textarea form-group field-textarea-1653743670732">
            <label for="textarea-1653743670732" class="formbuilder-textarea-label">SU/AU Postal Address<span
                        class="formbuilder-required">*</span></label>
            <textarea type="textarea" class="form-control" name="textarea-1653743670732" access="false"
                      id="textarea-1653743670732" required="required" aria-required="true"></textarea>
        </div>
        <div class="">
            <p access="false" id="control-3119673">Please provide a general club email address that multiple committee
                members have access to, and an email address that is regularly monitored by a senior committee member –
                they may be the same email address</p>
        </div>
        <div class="formbuilder-text form-group field-text-1653743720113">
            <label for="text-1653743720113" class="formbuilder-text-label">Email 1<span
                        class="formbuilder-required">*</span></label>
            <input type="text" class="form-control" name="text-1653743720113" access="false" id="text-1653743720113"
                   required="required" aria-required="true">
        </div>
        <div class="formbuilder-text form-group field-text-1653743737288">
            <label for="text-1653743737288" class="formbuilder-text-label">Confirm Email 1<span
                        class="formbuilder-required">*</span></label>
            <input type="text" class="form-control" name="text-1653743737288" access="false" id="text-1653743737288"
                   required="required" aria-required="true">
        </div>
        <div class="formbuilder-text form-group field-text-1653743736883">
            <label for="text-1653743736883" class="formbuilder-text-label">Email 2<span
                        class="formbuilder-required">*</span></label>
            <input type="text" class="form-control" name="text-1653743736883" access="false" id="text-1653743736883"
                   required="required" aria-required="true">
        </div>
        <div class="formbuilder-text form-group field-text-1653743782119">
            <label for="text-1653743782119" class="formbuilder-text-label">Confirm Email 2<span
                        class="formbuilder-required">*</span></label>
            <input type="text" class="form-control" name="text-1653743782119" access="false" id="text-1653743782119"
                   required="required" aria-required="true">
        </div>
        <div class="">
            <p access="false" id="control-597674">Please nominate a member of your committee to act as a point of
                contact between the SWA and your club. We usually want to contact the president/chair or the treasurer,
                but you may nominate any member of your committee.</p>
        </div>
        <div class="formbuilder-text form-group field-text-1653743833365">
            <label for="text-1653743833365" class="formbuilder-text-label">Name<span
                        class="formbuilder-required">*</span></label>
            <input type="text" class="form-control" name="text-1653743833365" access="false" id="text-1653743833365"
                   required="required" aria-required="true">
        </div>
        <div class="formbuilder-radio-group form-group field-radio-group-1653743872136">
            <label for="radio-group-1653743872136" class="formbuilder-radio-group-label">What is your nominated point of
                contact’s most reliable and preferred method of communication for the SWA to contact them via?<span
                        class="formbuilder-required">*</span></label>
            <div class="radio-group">
                <div class="formbuilder-radio-inline">
                    <input name="radio-group-1653743872136" access="false" id="radio-group-1653743872136-0"
                           required="required" aria-required="true" value="option-1" type="radio">
                    <label for="radio-group-1653743872136-0">Email</label>
                </div>
                <div class="formbuilder-radio-inline">
                    <input name="radio-group-1653743872136" access="false" id="radio-group-1653743872136-1"
                           required="required" aria-required="true" value="option-2" type="radio">
                    <label for="radio-group-1653743872136-1">Facebook Messenger</label>
                </div>
                <div class="formbuilder-radio-inline">
                    <input name="radio-group-1653743872136" access="false" id="radio-group-1653743872136-2"
                           required="required" aria-required="true" value="option-3" type="radio">
                    <label for="radio-group-1653743872136-2">Instagram Direct</label>
                </div>
                <div class="formbuilder-radio-inline">
                    <input name="radio-group-1653743872136" access="false" id="radio-group-1653743872136-3"
                           required="required" aria-required="true" value="option-4" type="radio">
                    <label for="radio-group-1653743872136-3">Whatsapp</label>
                </div>
                <div class="formbuilder-radio-inline">
                    <input name="radio-group-1653743872136" access="false" id="radio-group-1653743872136-4"
                           required="required" aria-required="true" value="option-5" type="radio">
                    <label for="radio-group-1653743872136-4">SMS</label>
                </div>
            </div>
        </div>
        <div class="formbuilder-text form-group field-text-1653743952336">
            <label for="text-1653743952336" class="formbuilder-text-label">Username/Email/Phone Number<span
                        class="formbuilder-required">*</span></label>
            <input type="text" class="form-control" name="text-1653743952336" access="false" id="text-1653743952336"
                   required="required" aria-required="true">
        </div>
        <div class="formbuilder-text form-group field-text-1653743973289">
            <label for="text-1653743973289" class="formbuilder-text-label">Confirm Above<span
                        class="formbuilder-required">*</span></label>
            <input type="text" class="form-control" name="text-1653743973289" access="false" id="text-1653743973289"
                   required="required" aria-required="true">
        </div>
        <div class="">
            <p access="false" id="control-3039380">Finally, please ensure your committee members have joined the SWA
                Presidents Group (for club committee members only), contact the Student Windsurf Facebook page if you
                need the first member of you committee to be invited to the page. Please ensure that your members have
                liked and followed the SWA Facebook Page https://www.facebook.com/studentwindsurf and Instagram account
                @studentwindsurf</p>
        </div>
        <div class="formbuilder-checkbox-group form-group field-checkbox-group-1653743386370">
            <label for="checkbox-group-1653743386370" class="formbuilder-checkbox-group-label"><span
                        class="formbuilder-required">*</span></label>
            <div class="checkbox-group">
                <div class="formbuilder-checkbox-inline">
                    <input name="checkbox-group-1653743386370[]" access="false" id="checkbox-group-1653743386370-0"
                           aria-required="true" value="option-1" type="checkbox" >
                    <label for="checkbox-group-1653743386370-0">I agree the above information is correct.</label>
                </div>
                <div class="formbuilder-checkbox-inline">
                    <input name="checkbox-group-1653743386370[]" access="false" id="checkbox-group-1653743386370-1"
                           aria-required="true" type="checkbox" >
                    <label for="checkbox-group-1653743386370-1">I agree to the agreement.</label>
                </div>
            </div>
        </div>
        <div class="formbuilder-button form-group field-button-1653743378819">
            <input form="update_club" type="submit" value="submit" name="submit_btn">
        </div>
        <?php echo JHtml::_('form.token'); ?>
    </div>
</form>
