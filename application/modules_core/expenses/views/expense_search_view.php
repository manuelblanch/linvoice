<?php 
?>

<table style="width: 100%;">
            <tr>
                <th scope="col" class="first" style="width: 25%;"><?php echo $this->lang->line('name'); ?></th>
                <th scope="col" style="width: 15%;"><?php echo $this->lang->line('category'); ?></th>
                <th scope="col" style="width: 15%;"><?php echo $this->lang->line('date'); ?></th>
                <th scope="col" style="width: 20%;"><?php echo $this->lang->line('amount'); ?></th>
                <th scope="col" style="width: 15%;"><?php echo $this->lang->line('note'); ?></th>
                <th scope="col" style="width: 15%;"><?php echo $this->lang->line('client'); ?></th>
                <th scope="col" style="width: 20%;"><?php echo $this->lang->line('pay_to'); ?></th>
                <th scope="col" style="width: 20%;"><?php echo $this->lang->line('attactment'); ?></th>
                <th scope="col" class="last" style="width: 20%;"><?php echo $this->lang->line('actions'); ?></th>
            </tr>
                <?php 
                if (count($expenses) > 0) {
                foreach ($expenses as $expen) { ?>
                <tr>
                    <td class="first"><?php echo $expen->mcb_expense_name; ?></td>
                    <td><?php echo $expen->expense_category_name; ?></td>
                    <td><?php echo format_date($expen->mcb_expense_date); ?></td>
                    <td><?php echo $expen->mcb_expense_amount; ?></td>
                    <td><?php echo $expen->mcb_expense_note; ?></td>
                    <td><?php echo $expen->client_name; ?></td>
                    <td><?php echo $expen->mcb_expense_payto; ?></td>
                    <td></td>
                    <td>
                        <a href="<?php echo site_url('expenses/form/mcb_expense_id/'.$expen->mcb_expense_id); ?>" title="<?php echo $this->lang->line('edit'); ?>">
                            <?php echo icon('edit'); ?>
			</a>
			<a href="<?php echo site_url('expenses/delete/' . $expen->mcb_expense_id . '/mcb_expense_id/' . $expen->mcb_expense_id); ?>" title="<?php echo $this->lang->line('delete'); ?>" onclick="javascript:if(!confirm('<?php echo $this->lang->line('confirm_delete'); ?>')) return false">
                            <?php echo icon('delete'); ?>
                        </a>
                    </td>
                </tr>
                <?php } ?>
</table>
            <?php } else {?>
                <table>
                    <tr>
                        <td>no result found</td>
                    </tr>
                </table>
                <?php } ?>
