<dl>
    <dt>
    <label><?php echo $this->lang->line('expense_name'); ?></label>
    </dt>
    <dd>
        <input type="text" name="mcb_expense_name" id="mcb_expense_name" value="<?php echo $this->mdl_expenses->form_value('mcb_expense_name'); ?>">
    </dd>
</dl>
<dl>
    <dt>
        <label><?php echo $this->lang->line('expense_category'); ?></label>
    </dt>
    <dd>
        <select name="expense_category_id">
            <option value=""></option>
            <?php foreach ($expenses_category as $expense) { ?>
            <option value="<?php echo $expense->expense_category_id; ?>" <?php if ($this->mdl_expenses->form_value('expense_category_id') == $expense->expense_category_id) { ?> selected="selected" <?php } ?>><?php echo $expense->expense_category_name ; ?></option>
            <?php } ?>
        </select>
    </dd>
</dl>
<dl>
    <dt>
        <label><?php echo $this->lang->line('expense_date'); ?></label>
    </dt>
    <dd>
        <input type="text" name="mcb_expense_date" class="datepicker" value="<?php echo $this->mdl_expenses->form_value('mcb_expense_date'); ?>">
    </dd>
</dl>
<dl>
    <dt>
        <label><?php echo $this->lang->line('expense_amount'); ?></label>
    </dt>
    <dd>
        <input type="text" name="mcb_expense_amount" id="mcb_expense_amount" value="<?php echo format_number($this->mdl_expenses->form_value('mcb_expense_amount')); ?>">
    </dd>
</dl>
<dl>
    <dt>
        <label><?php echo $this->lang->line('expense_note'); ?></label>
    </dt>
    <dd>
        <input type="text" name="mcb_expense_note" id="mcb_expense_note" value="<?php echo $this->mdl_expenses->form_value('mcb_expense_note'); ?>">
    </dd>
</dl>
<dl>
    <dt>
        <label><?php echo $this->lang->line('expense_client'); ?></label>
    </dt>
    <dd>
        <?php if (!uri_assoc('client_id')) { ?>
        <select name="client_id" id="client_id">
            <option value=""></option>
            <?php foreach ($clients as $client) { ?>
            <option value="<?php echo $client->client_id; ?>" <?php if ($this->mdl_expenses->form_value('client_id') == $client->client_id) { ?> selected="selected" <?php } ?>><?php echo $client->client_name; ?></option>
            <?php } ?>
        </select>
        <?php } ?>
    </dd>
</dl>
<dl>
        <dt>
            <label><?php echo $this->lang->line('expense_pay'); ?></label>
        </dt>
        <dd>
            <input type="text" name="mcb_expense_payto" id="mcb_expense_payto" value="<?php echo $this->mdl_expenses->form_value('mcb_expense_payto'); ?>">
        </dd>
</dl>
<div id="upload_file">
<dl>
    <dt><label><?php echo $this->lang->line('upload_file'); ?></label></dt>
    <dd>
        <input type="hidden" name="count_assign" id="count_assign" value="1" />
        <input type="file" name="userfile" id="mcb_expense_file_title" multiple="multiple" value="<?php echo $this->mdl_expenses->form_value('mcb_expense_file_title') ?>" /> <!--<a href="#" id="add_more" name="add_more" onclick="return false;"><?php //echo $this->lang->line('add_more'); ?></a>-->
    </dd>
</dl>
</div>
<div style="clear: both;">&nbsp;</div>

<input type="submit" id="btn_submit" name="btn_submit" value="<?php echo $this->lang->line('submit'); ?>" />
<input type="submit" id="btn_cancel" name="btn_cancel" value="<?php echo $this->lang->line('cancel'); ?>" />

<div style="clear: both;">&nbsp;</div>

