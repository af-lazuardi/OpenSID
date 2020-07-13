<div class="content-wrapper">
    <section class="content-header">
        <h1>Surat Masuk Elektronik (<span id="belum_dibaca"></span> Belum dibaca, <span id="belum_diagenda"></span> Belum diagenda)</h1>
        <ol class="breadcrumb">
            <li><a href="<?=site_url('hom_sid')?>"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">Surat Masuk Elektronik dari SuratKU </li>
        </ol>
    </section>
    <section class="content" id="maincontent">
        <form id="mainform" name="mainform" action="<?= site_url('laporan')?>" method="post" class="form-horizontal">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-info">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                        <form id="mainform" name="mainform" action="" method="post">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="box-tools">
                                                        <div class="input-group input-group-sm pull-right">
                                                            <input name="cari" id="cari" class="form-control" placeholder="Cari..." type="text" value="<?=$cari?>" onkeypress="if (event.keyCode == 13){$('#'+'mainform').attr('action', '<?=site_url("surat_masuk/search")?>');$('#'+'mainform').submit();}">
                                                            <div class="input-group-btn">
                                                                <button type="submit" class="btn btn-default" onclick="$('#'+'mainform').attr('action', '<?=site_url("surat_masuk/search")?>');$('#'+'mainform').submit();"><i class="fa fa-search"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered dataTable table-hover">
                                                            <thead class="bg-gray disabled color-palette">
                                                                <tr>
                                                                    <th width="5%">No</th>
                                                                    <th width="10%">Aksi</th>
                                                                    <th width="5%">Is Read</th>
                                                                    <th width="5%">Is Agd</th>
                                                                    <th width="20%">Surat Dari</th>
                                                                    <th width="20%">Tgl Surat / Nomor</th>
                                                                    <th width="35%">Perihal</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="table_surat">
                                                                
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </form>
                            </div>
                            <div class='modal fade' id='mdl_detil_surat' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                                <div class='modal-dialog'>
                                    <div class='modal-content'>
                                        <form action="#" method="post" onsubmit="return simpan_nomor();" id="mdl_detil_surat_form">
                                        <input type="hidden" name="mdl_detil_surat_id_surat" id="mdl_detil_surat_id_surat">
                                        <input type="hidden" name="mdl_detil_surat_penerima_id_instansi" id="mdl_detil_surat_penerima_id_instansi">
                                        <input type="hidden" name="mdl_detil_surat_penerima_id_user" id="mdl_detil_surat_penerima_id_user">
                                        <div class='modal-header'>
                                            <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                                            <h4 class='modal-title' id='myModalLabel'><i class='fa fa-search'></i> &nbsp;&nbsp;Detil Surat</h4>
                                        </div>
                                        <div class='modal-body' id="mdl_detil_surat_detil">

                                        </div>
                                        <div class='modal-footer'>
                                            <button type="button" class="btn btn-social btn-flat btn-warning btn-sm" data-dismiss="modal"><i class='fa fa-sign-out'></i> Tutup</button>
                                            <button type="submit" class="btn btn-social btn-flat btn-success btn-sm" id="btn_simpan"><i class='fa fa-check'></i> Simpan Nomor</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
</div>

<script type="text/javascript">
    dt_surat();

    function dt_surat() {
        $.ajax({
            type: "POST",
            data: {},
            url: "<?=base_url('index.php/surat_masuk_suratku/index_ajax');?>",
            beforeSend: function(){
                $("#table_surat").html('<tr><td colspan="5"><i class="fa fa-spin fa-spinner"></i> Memuat...</td></tr>');
            },
            success: function(r, textStatus, jqXHR) {
                let htm = '';   
                let no = 1; 
                let belum_dibaca = 0;
                let belum_diagenda = 0;
                $.each( r.results, function( k, v ) {
                    let tgl = v.tgl_surat;
                    let pc_tgl = tgl.split('-');
                    let new_tgl = pc_tgl[2]+"-"+pc_tgl[1]+"-"+pc_tgl[0];
                    let link_detil = '<a href="#" onclick="return detil_surat('+v.id_surat+', \''+v.penerima_id_instansi+'\', \''+v.penerima_id_user+'\');" class="btn btn-success btn-sm btn-flat"><i class="fa fa-search"></i> Detil</a>';
                    let is_read = (v.is_read == "1") ? '<div class="btn btn-success btn-sm"><i class="fa fa-check"></i></div>' : '<div class="btn btn-warning btn-sm"><i class="fa fa-minus-circle"></i></div>';
                    let is_agenda = (v.is_agenda == "1") ? '<div class="btn btn-success btn-sm"><i class="fa fa-check"></i></div>' : '<div class="btn btn-warning btn-sm"><i class="fa fa-minus-circle"></i></div>';
                    if (v.is_read != "1") {
                        belum_dibaca++;
                    }
                    if (v.is_agenda != "1") {
                        belum_diagenda++;
                    }

                    htm += '<tr>';
                    htm += '<td class="text-center">'+no+'</td>';
                    htm += '<td class="text-center">'+link_detil+'</td>';
                    htm += '<td>'+is_read+'</i></td>';
                    htm += '<td>'+is_agenda+'</i></td>';
                    htm += '<td>'+v.nm_instansi_pengirim+'</td>';
                    htm += '<td>'+new_tgl+'<br><i>No: '+v.nomor_surat+'</i></td>';
                    htm += '<td>'+v.judul+'<br><i>'+v.deskripsi+'</i></td>';
                    htm += '</tr>';
                    no++;
                });

                $("#belum_dibaca").html(belum_dibaca);
                $("#belum_diagenda").html(belum_diagenda);
                $("#table_surat").html(htm);
            },
            error: function(xhr) {
                console.log(xhr)
            }
        });
        
    }

    function detil_surat(id_surat, id_instansi_penerima, id_user_penerima) {
        $("#mdl_detil_surat_id_surat").val(id_surat);
        $("#mdl_detil_surat_penerima_id_instansi").val(id_instansi_penerima);
        $("#mdl_detil_surat_penerima_id_user").val(id_user_penerima);
        
        $.ajax({
            type: "POST",
            data: {id_surat: id_surat, penerima_id_instansi: id_instansi_penerima, penerima_id_user: id_user_penerima},
            url: "<?=base_url('index.php/surat_masuk_suratku/detil_surat');?>",
            success: function(r, textStatus, jqXHR) { 
                let tgl = r.results.tgl_surat;
                let pc_tgl = tgl.split('-');
                let new_tgl = pc_tgl[2]+"-"+pc_tgl[1]+"-"+pc_tgl[0];
                let now_tgl = new Date().toISOString().slice(0, 19).replace('T', ' ');

                let lampiran = r.results.surat_lampiran;
                let html_lampiran = '';

                if (lampiran.length > 0) {
                    html_lampiran += '<tr><td>Lampiran</td><td><ol style="margin-left: -20px; margin-top: 10px">';
                    $.each( lampiran, function( k, v ) {
                        html_lampiran += '<li><a href="'+v.file_lampiran+'" target="_blank">'+v.file_label+'</a>  [tipe: '+v.file_type+', ukuran: '+v.file_size+' KB]</li>';
                    });
                    html_lampiran += '</ol></td></tr>';
                }

                let htm = '<table class="table table-bordered table-hover table-condensed">';
                htm += '<tr><td width="30%">Asal Surat</td><td width="70%">'+r.results.nm_instansi_pengirim+'</td></tr>';
                htm += '<tr><td>Perihal</td><td>'+r.results.judul+'<br><i>'+r.results.deskripsi+'</i></td></tr>';
                htm += '<tr><td>Tgl Surat</td><td>'+new_tgl+'</td></tr>';
                htm += '<tr><td>Nomor Surat</td><td>'+r.results.nomor_surat+'</td></tr>';
                htm += '<tr><td>Nomor Surat Desa</td><td>'+r.nomor_surat_preview+'</td></tr>';
                htm += html_lampiran;
                htm += '</table>';
                htm += '<input type="hidden" name="nomor_urut" value="'+r.nomor_surat_preview+'">';
                htm += '<input type="hidden" name="tanggal_penerimaan" value="'+now_tgl+'">';
                htm += '<input type="hidden" name="kode_surat" value="'+r.results.klasifikasi+'">';
                htm += '<input type="hidden" name="nomor_surat" value="'+r.results.nomor_surat+'">';
                htm += '<input type="hidden" name="tanggal_surat" value="'+r.results.tgl_surat+'">';
                htm += '<input type="hidden" name="pengirim" value="'+r.results.nm_instansi_pengirim+'">';
                htm += '<input type="hidden" name="isi_singkat" value="'+r.results.judul+', '+r.results.deskripsi+'">';



                htm += '<iframe src="'+r.results.filenya_signed+'" width="100%" height="300" frameBorder="0">Browser not compatible.</iframe>';

                $("#mdl_detil_surat_detil").html(htm);

                if (r.results.is_agenda == "1") {
                    $("#btn_simpan").hide();
                }

                $("#mdl_detil_surat").modal('show');
            },
            error: function(xhr) {
                console.log(xhr)
            }
        });

        return false;
    }

    function simpan_nomor() {
        let data = $("#mdl_detil_surat_form").serialize();

        $.ajax({
            type: "POST",
            data: data,
            url: "<?=base_url('index.php/surat_masuk_suratku/simpan_surat_masuk');?>",
            beforeSend: function(){
                $("#btn_simpan").attr("disabled", true);
            },
            success: function(r, textStatus, jqXHR) {   
                $("#btn_simpan").attr("disabled", false);
                if (r.success == false) {
                    alert(r.message);
                } else {
                    alert(r.message);
                    $("#mdl_detil_surat").modal('hide');
                    dt_surat();
                }
            },
            error: function(xhr) {
                $("#btn_simpan").attr("disabled", false);
                console.log(xhr)
            }
        });
        return false;
    }
</script>

