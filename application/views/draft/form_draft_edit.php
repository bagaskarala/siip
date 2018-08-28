<div class="row">
    <div class="col-10 no-margin">
        <h2>Draft</h2>
    </div>
</div>
<?= form_open_multipart($form_action) ?>

    <?= isset($input->draft_id) ? form_hidden('draft_id', $input->draft_id) : '' ?>

    <!-- work_unit_id -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('Category Name', 'category_name', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <?= form_dropdown('category_id', getDropdownList('category', ['category_id', 'category_name']), $input->category_id, 'id="category"') ?>
        </div>
        <div class="col-4">
            <?= form_error('category_id') ?>
        </div>
    </div>
    
        <!-- theme_id -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('Theme Name', 'theme_name', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <?= form_dropdown('theme_id', getDropdownList('theme', ['theme_id', 'theme_name']), $input->theme_id, 'id="theme"') ?>
        </div>
        <div class="col-4">
            <?= form_error('theme_id') ?>
        </div>
    </div>

        <!-- draft_title -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('Draft Title', 'draft_title', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <?= form_input('draft_title', $input->draft_title) ?>
        </div>
        <div class="col-4">
            <?= form_error('draft_title') ?>
        </div>
    </div>
        
    <!-- draft_file -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('Draft File', 'draft_file', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <?= form_upload('draft_file') ?>
        </div>
        <div class="col-4">
            <?= fileFormError('draft_file', '<p class="form-error">', '</p>'); ?>
        </div>
    </div>

    <!--  draft_file preview -->
    <?php if (!empty($input->draft_file)): ?>
        <div class="row form-group">
            <div class="col-2">&nbsp;</div>
            <div class="col-4">
                <img src="<?= site_url("/draftfile/$input->draft_file") ?>" alt="<?= $input->draft_title ?>">
            </div>
            <div class="col-4">&nbsp;</div>
        </div>
    <?php endif ?>
    

        <!-- proposed_fund -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('Proposed Fund (Rp.)', 'proposed_fund', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <?= form_input('proposed_fund', $input->proposed_fund) ?>
        </div>
        <div class="col-4">
            <?= form_error('proposed_fund') ?>
        </div>
    </div>
        
        <!-- approved_fund -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('Approved Fund (Rp.)', 'approved_fund', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <?= form_input('approved_fund', $input->approved_fund) ?>
        </div>
        <div class="col-4">
            <?= form_error('approved_fund') ?>
        </div>
    </div>

        
<!-- finish_date -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('Finish Date (yyyy-mm-dd)', 'finish_date', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <?= form_input('finish_date', $input->finish_date, ['class' => 'date date-picker']) ?>
        </div>
        <div class="col-4">
            <?= form_error('finish_date') ?>
        </div>
    </div>
        
<!-- print_date -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('Print Date (yyyy-mm-dd)', 'print_date', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <?= form_input('print_date', $input->print_date, ['class' => 'date date-picker']) ?>
        </div>
        <div class="col-4">
            <?= form_error('print_date') ?>
        </div>
    </div>
        
        <!-- is_reviewed -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('Review Status', 'is_reviewed', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <label class="block-label">
                <?= form_radio('is_reviewed', 'y',
                    isset($input->is_reviewed) && ($input->is_reviewed == 'y') ? true : false)
                ?> Reviewed
            </label>
            <label class="block-label">
                <?= form_radio('is_reviewed', 'n',
                    isset($input->is_reviewed) && ($input->is_reviewed == 'n') ? true : false)
                ?> Not Reviewed
            </label>
        </div>
        <div class="col-4">
            <?= form_error('is_reviewed') ?>
        </div>
    </div>
        
        <!-- review_notes -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('Review Notes', 'review_notes', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <?= form_textarea('review_notes', $input->review_notes, ['class' => 'form-input']) ?>
        </div>
        <div class="col-4">
            <?= form_error('review_notes') ?>
        </div>
    </div>
        
        <!-- author_review_notes -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('Author Review Notes', 'author_review_notes', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <?= form_textarea('author_review_notes', $input->author_review_notes, ['class' => 'form-input']) ?>
        </div>
        <div class="col-4">
            <?= form_error('author_review_notes') ?>
        </div>
    </div> 
                
                
        <!-- review_start_date -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('Review Start Date (yyyy-mm-dd)', 'review_start_date', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <?= form_input('review_start_date', $input->review_start_date, ['class' => 'date date-picker']) ?>
        </div>
        <div class="col-4">
            <?= form_error('review_start_date') ?>
        </div>
    </div>
                        
        <!-- review_end_date -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('Review End Date (yyyy-mm-dd)', 'review_end_date', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <?= form_input('review_end_date', $input->review_end_date, ['class' => 'date date-picker']) ?>
        </div>
        <div class="col-4">
            <?= form_error('review_end_date') ?>
        </div>
    </div> 
        
        <!-- is_revised -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('Revise Status', 'is_revised', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <label class="block-label">
                <?= form_radio('is_revised', 'y',
                    isset($input->is_revised) && ($input->is_revised == 'y') ? true : false)
                ?> Revised
            </label>
            <label class="block-label">
                <?= form_radio('is_revised', 'n',
                    isset($input->is_revised) && ($input->is_revised == 'n') ? true : false)
                ?> Not Revised
            </label>
        </div>
        <div class="col-4">
            <?= form_error('is_revised') ?>
        </div>
    </div>
        
        <!-- revise_notes -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('Revise Notes', 'revise_notes', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <?= form_textarea('revise_notes', $input->revise_notes, ['class' => 'form-input']) ?>
        </div>
        <div class="col-4">
            <?= form_error('revise_notes') ?>
        </div>
    </div>      
        
        <!-- is_edited -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('Edit Status', 'is_edited', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <label class="block-label">
                <?= form_radio('is_edited', 'y',
                    isset($input->is_edited) && ($input->is_edited == 'y') ? true : false)
                ?> Edited
            </label>
            <label class="block-label">
                <?= form_radio('is_edited', 'n',
                    isset($input->is_edited) && ($input->is_edited == 'n') ? true : false)
                ?> Not Edited
            </label>
        </div>
        <div class="col-4">
            <?= form_error('is_edited') ?>
        </div>
    </div>
        
        <!-- edit_notes -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('Edit Notes', 'edit_notes', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <?= form_textarea('edit_notes', $input->edit_notes, ['class' => 'form-input']) ?>
        </div>
        <div class="col-4">
            <?= form_error('edit_notes') ?>
        </div>
    </div>         

        <!-- author_edit_notes -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('Author Edit Notes', 'author_edit_notes', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <?= form_textarea('author_edit_notes', $input->author_edit_notes, ['class' => 'form-input']) ?>
        </div>
        <div class="col-4">
            <?= form_error('author_edit_notes') ?>
        </div>
    </div> 
                
                
        <!-- edit_start_date -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('Edit Start Date (yyyy-mm-dd)', 'edit_start_date', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <?= form_input('edit_start_date', $input->edit_start_date, ['class' => 'date date-picker']) ?>
        </div>
        <div class="col-4">
            <?= form_error('edit_start_date') ?>
        </div>
    </div>
                        
        <!-- edit_end_date -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('Edit End Date (yyyy-mm-dd)', 'edit_end_date', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <?= form_input('edit_end_date', $input->edit_end_date, ['class' => 'date date-picker']) ?>
        </div>
        <div class="col-4">
            <?= form_error('edit_end_date') ?>
        </div>
    </div> 
        
        <!-- is_layouted -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('Layout Status', 'is_layouted', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <label class="block-label">
                <?= form_radio('is_layouted', 'y',
                    isset($input->is_layouted) && ($input->is_layouted == 'y') ? true : false)
                ?> Layouted
            </label>
            <label class="block-label">
                <?= form_radio('is_layouted', 'n',
                    isset($input->is_layouted) && ($input->is_layouted == 'n') ? true : false)
                ?> Not Layouted
            </label>
        </div>
        <div class="col-4">
            <?= form_error('is_layouted') ?>
        </div>
    </div>
        
        <!-- layout_notes -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('Layout Notes', 'layout_notes', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <?= form_textarea('layout_notes', $input->layout_notes, ['class' => 'form-input']) ?>
        </div>
        <div class="col-4">
            <?= form_error('layout_notes') ?>
        </div>
    </div> 

        <!-- author_layout_notes -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('Author Layout Notes', 'author_layout_notes', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <?= form_textarea('author_layout_notes', $input->author_layout_notes, ['class' => 'form-input']) ?>
        </div>
        <div class="col-4">
            <?= form_error('author_layout_notes') ?>
        </div>
    </div> 
                
                
        <!-- layout_start_date -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('Layout Start Date (yyyy-mm-dd)', 'layout_start_date', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <?= form_input('layout_start_date', $input->layout_start_date, ['class' => 'date date-picker']) ?>
        </div>
        <div class="col-4">
            <?= form_error('layout_start_date') ?>
        </div>
    </div>
                        
        <!-- layout_end_date -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('Layout End Date (yyyy-mm-dd)', 'layout_end_date', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <?= form_input('layout_end_date', $input->layout_end_date, ['class' => 'date date-picker']) ?>
        </div>
        <div class="col-4">
            <?= form_error('layout_end_date') ?>
        </div>
    </div>         
        
        <!-- is_reprint -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('Reprint Status', 'is_reprint', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <label class="block-label">
                <?= form_radio('is_reprint', 'y',
                    isset($input->is_reprint) && ($input->is_reprint == 'y') ? true : false)
                ?> Reprint
            </label>
            <label class="block-label">
                <?= form_radio('is_reprint', 'n',
                    isset($input->is_reprint) && ($input->is_reprint == 'n') ? true : false)
                ?> Not Reprint
            </label>
        </div>
        <div class="col-4">
            <?= form_error('is_reprint') ?>
        </div>
    </div>
        
        <!-- draft_notes -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('Draft Notes', 'draft_notes', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <?= form_textarea('draft_notes', $input->draft_notes, ['class' => 'form-input']) ?>
        </div>
        <div class="col-4">
            <?= form_error('draft_notes') ?>
        </div>
    </div>        


        <!-- proofread_notes -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('Proofread Notes', 'proofread_notes', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <?= form_textarea('proofread_notes', $input->proofread_notes, ['class' => 'form-input']) ?>
        </div>
        <div class="col-4">
            <?= form_error('proofread_notes') ?>
        </div>
    </div> 

        <!-- author_proofread_notes -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('Author Proofread Notes', 'author_proofread_notes', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <?= form_textarea('author_proofread_notes', $input->author_proofread_notes, ['class' => 'form-input']) ?>
        </div>
        <div class="col-4">
            <?= form_error('author_proofread_notes') ?>
        </div>
    </div> 
                
                
        <!-- proofread_start_date -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('Proofread Start Date (yyyy-mm-dd)', 'proofread_start_date', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <?= form_input('proofread_start_date', $input->proofread_start_date, ['class' => 'date date-picker']) ?>
        </div>
        <div class="col-4">
            <?= form_error('proofread_start_date') ?>
        </div>
    </div>
                        
        <!-- proofread_end_date -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('Proofread End Date (yyyy-mm-dd)', 'proofread_end_date', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <?= form_input('proofread_end_date', $input->proofread_end_date, ['class' => 'date date-picker']) ?>
        </div>
        <div class="col-4">
            <?= form_error('proofread_end_date') ?>
        </div>
    </div>
        
    <!-- submit button -->
    <div class="row">
        <div class="col-2">&nbsp;</div>
        <div class="col-8"><?= form_button(['type' => 'submit', 'content' => 'Save', 'class' => 'btn-primary']) ?></div>
    </div>
 <?= form_close() ?>
