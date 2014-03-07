<?php
$this->load->view('dashboard/header'); 
?>
<div class="grid_7" id="content_wrapper">
    
    <div class="section_wrapper">
        <h3 class="title_black"><?php echo $this->lang->line('list_category'); ?>
            <?php $this->load->view('dashboard/btn_add', array('btn_value'=>$this->lang->line('add_category_btn'))); ?>
        </h3>
        
        <?php $this->load->view('dashboard/system_messages'); ?>
        
        <div class="content toggle no_padding">
            
            <table>
                <tr>
                    <th scope="col" class="first" style="width: 25%;"><?php echo $this->lang->line('id'); ?></th>
                    <th scope="col" style="width: 20%;"><?php echo $this->lang->line('name'); ?></th>
                    <th scope="col" class="last" style="width: 15%;"><?php echo $this->lang->line('actions'); ?></th>
                </tr>
                
                <?php foreach ($categorys as $cate) { ?>
                <tr>
                    <td><?php echo $cate->expense_category_id; ?></td>
                    <td><?php echo $cate->expense_category_name; ?></td>
                    <td>
                        <a href="<?php echo site_url('expenses/category/form/expense_category_id/'.$cate->expense_category_id); ?>" title="<?php echo $this->lang->line('edit'); ?>">
                            <?php echo icon('edit'); ?>
			</a>
			<a href="<?php echo site_url('expenses/category/delete/' . $cate->expense_category_id . '/expense_category_id/' . $cate->expense_category_id); ?>" title="<?php echo $this->lang->line('delete'); ?>" onclick="javascript:if(!confirm('<?php echo $this->lang->line('confirm_delete'); ?>')) return false">
                            <?php echo icon('delete'); ?>
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </table>
            
        </div>
    </div>
    
</div>

<?php $this->load->view('dashboard/sidebar', array('side_block'=>'expenses/sidebar_item')); ?>
<?php $this->load->view('dashboard/footer'); ?>