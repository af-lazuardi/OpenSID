
<div class="content-wrapper">
    <section class="content-header">
        <h1>Validasi Data Penduduk</h1>
        <ol class="breadcrumb">
            <li><a href="<?=site_url('hom_sid')?>"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">Data Penduduk</li>
        </ol>
    </section>
    <section class="content" id="maincontent">
    <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                        <div class="box-header with-border">
                            Validasi Penduduk
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <form action="" id="main" name="main" method="POST" class="form-horizontal">
                                        <div class="form-group">
                                            <label for="nik"  class="col-sm-3 control-label">NIK</label>
                                        
                                            <div class="col-sm-4">
                                                <input class="form-control input-sm" id="nik"  value="<?= $individu['nik']?>" name="nik" style ="width:100%;">
                                            </div>
                                                <div class="col-sm-2">
                                                    <button class="btn btn-sosial btn-flat btn-success btn-sm" onclick="formAction('main')"><i class="fa fa-plus"></i>Validasi</button>
                                                </div>
                                            
                                        </div>
                                    </form>
                                    <form id="validasi" action="<?= $form_action?>" method="POST" target="_blank" class="form-surat form-horizontal">
                                        <?php if ($individu): ?>
                                                <?php include("donjo-app/views/sid/kependudukan/konfirmasi_penduduk.php"); ?>
                                        <?php	endif; ?>
                                   </form>
                                </div>
                            <div>
                        </div>    
                </div>
            </div>
        </div>        
             
  
    </section>
</div>