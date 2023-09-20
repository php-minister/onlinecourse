<?php $this->load->view('layout/header_web',array('page_title'=>$this->lang->line('students'), 'page_name' => 'Donor','forms'=>TRUE,'tables'=>TRUE)); ?>
<?php $this->load->view('donor/menu',array('active_menu'=>'download'))?>

<!--<header>
    <h2><?= $this->lang->line('downloads')?></h2>
</header>-->
<section>
    <article>
		<div class="download_reports"><h3> Download  Donation Report  <a href="donor/?pdf" target="_blank" id="download_pdf" title="<?= $this->lang->line('download_pdf')?>"><img src="images/pdf.png"></a> </h3></div>
        <div class="download_reports"><h3> Download Payment Report  <a href="donor/donate/?pdf" target="_blank" id="download_pdf" title="<?= $this->lang->line('download_pdf')?>"><img src="images/pdf.png"></a></h3></div>
    </article>
</section>
<?php $this->load->view('layout/footer_web')?>