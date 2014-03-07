<?php $this->load->view('dashboard/header'); ?>

<?php // $this->load->model('mdl_expense_file'); ?>

<?php $this->load->view('dashboard/jquery_date_picker'); ?>

<div class="grid_10" id="content_wrapper">
    <div class="section_wrapper">
        <h3 class="title_black"><?php echo $this->lang->line('list_expense'); ?>
            <?php $this->load->view('dashboard/btn_add', array('btn_value'=>$this->lang->line('add_expense_btn'))); ?>
        </h3>
    
        <?php $this->load->view('dashboard/system_messages'); ?>
        
       <div class="search">
           <form id="" name="search" method="POST" action="<?php echo site_url($this->uri->uri_string()); ?>">
                            <?php echo $this->lang->line('from_date'); ?>
                            <input type="text" id="from_date" name="from_date" class="datepicker" value="">
                            <?php echo $this->lang->line('to_date'); ?>
                            <input type="text" name="to_date" id="to_date" class="datepicker" value="">
                            <a href="#" id="btn_search" name="btn_search" title="<?php echo $this->lang->line('search'); ?>">
                                <?php echo icon('search'); ?>
                            </a>
                            
           </form>
        </div>
        <div id="message"></div>
        <div class="content toggle no_padding" id="results">
        <table style="width: 100%;">
            <tr>
                <th scope="col" class="first" style="width: 25%;"><?php echo $this->lang->line('name'); ?></th>
                <th scope="col" style="width: 15%;"><?php echo $this->lang->line('category'); ?></th>
                <th scope="col" style="width: 15%;"><?php echo $this->lang->line('date'); ?></th>
                <th scope="col" style="width: 10%;"><?php echo $this->lang->line('amount'); ?></th>
                <th scope="col" style="width: 25%;"><?php echo $this->lang->line('note'); ?></th>
                <th scope="col" style="width: 15%;"><?php echo $this->lang->line('client'); ?></th>
                <th scope="col" style="width: 20%;"><?php echo $this->lang->line('pay_to'); ?></th>
                <th scope="col" style="width: 20%;"><?php echo $this->lang->line('attactment'); ?></th>
                <th scope="col" class="last" style="width: 20%;"><?php echo $this->lang->line('actions'); ?></th>
            </tr>
                <?php foreach ($expenses as $expen) { ?>
                <tr>
                    <td class="first"><span class="expense_name" id="expense_name" title="click to edit"><?php echo $expen->mcb_expense_name; ?></span></td>
                    <td><?php echo $expen->expense_category_name; ?></td>
                    <td><?php echo format_date($expen->mcb_expense_date); ?></td>
                    <td><?php echo $expen->mcb_expense_amount; ?></td>
                    <td><?php echo $expen->mcb_expense_note; ?></td>
                    <td><?php echo $client_name = $this->mdl_expense_file->get_client_name($expen->client_id); ?></td>
                    <td><?php echo $expen->mcb_expense_payto; ?></td>
                    <td><a href="javascript:void(0)" class="popup_file" id="<?php echo $expen->mcb_expense_id; ?>" onclick="return false;">
                        <?php 
                               $files = $this->mdl_expense_file->get_files($expen->mcb_expense_id);
                               ?>
                            <table style="width: 100%;">
                                <?php
                                    foreach ($files as $row) {

                                        ?>
                                            <tr>
                                                <td>
                                                    <?php echo base64_decode(basename($row->mcb_expense_file_title)); ?>
                                                </td>
                                            </tr>
                                    <?php    
                                    }
                            ?>
                            </table> 
                            <?php
                         ?>
                        </a>
                    </td>
                    <td>
                        <a href="<?php echo site_url('expenses/form/mcb_expense_id/' . $expen->mcb_expense_id); ?>" title="<?php echo $this->lang->line('edit'); ?>">
                            <?php echo icon('edit'); ?>
			</a>
			<a href="<?php echo site_url('expenses/delete/mcb_expense_id/'. $expen->mcb_expense_id); ?>" title="<?php echo $this->lang->line('delete'); ?>" onclick="javascript:if(!confirm('<?php echo $this->lang->line('confirm_delete'); ?>')) return false">
                            <?php echo icon('delete'); ?>
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </table>
        </div>
    </div>
</div>

<div id="popup_files" style="display: inline;"></div>

<script type="text/javascript">
    
    $(function() {
       $('#btn_search').click(function() {
           if ($('#from_date').val() != '' || $('#to_date').val() != '') {
           $('#results').html('<font color="#00FF33"><?php echo icon('indicator'); ?><i>Loading...</i></font>');
            $.ajax({
                    type:"POST",
                    url:"<?php echo site_url('expenses/expenses/ajax_search'); ?>", // trang cần xử lý (tức là controller là category có function là search)
                    data:"date_form="+$('#from_date').val()+"&to_date="+$('#to_date').val(), // Lấy dữ liệu của txt gửi đi
                    success:function(x){
                        $('#results').html(x);
                    }
                });  
            } else {
                return false;
            }

       });
    });
    
    $(function() {
        $('.popup_file').click(function() {
            
            expense_id = $(this).attr('id');
            
            $.ajax({
                type: "POST",
                url:"<?php echo site_url('expenses/expenses/files_options'); ?>",
                data: "expense_id="+expense_id,
                success: function(x) {
                    $('#popup_files').html(x).dialog({
                     autoOpen: true,
                     bgiframe: true,
                     resizable: false,
                     width: 500,
                     modal: true,
                     title: 'Files upload',
                     overlay: {
                         backgroundColor: '#000000',
                         opacity: 1
                     },
                     buttons: {
                         
                         'Cancel': function() {
                             $(this).dialog('close');
                         }
                }
            });
            $('.popup_files').dialog('open');
          }
                
        });
      });
    });
    
    
$(function() {
   
   $('#add_more').click(function() {
       count_assign = parseInt($('#count_assign').val());
       count_more = count_assign + 1;
       
       $('#add-more').append('<dl id="assign_more_'+count_more+'"><dt></dt><dd><input type="file" name="userfile" id="userfile'+count_more+'" multiple="multiple" /><a href="#" onclick="return false;" id="remove"><?php echo icon('delete'); ?></a></dd></dl>');
       $('#count_assign').val(count_more);
       
        $('#remove').click(function() {
            $('#assign_more_'+count_more).remove();
        });
   });
   
   
});
</script>

<?php // $this->load->view('dashboard/sidebar', array('side_block'=>'expenses/sidebar')); ?>

<?php $this->load->view('dashboard/footer'); ?>